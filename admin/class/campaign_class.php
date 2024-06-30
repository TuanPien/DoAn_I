<?php
include_once "database.php";

class campaign{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }

    public function cal_discount($campaign_id){
        $query = "SELECT * FROM  campaign WHERE campaign_id = '$campaign_id' ORDER BY campaign_id DESC";
        $camp = $this -> db -> select($query) -> fetch_assoc();
        $product_id = $camp['product_id'];
        $product_sum = $camp['product_sum'];

        $query = "SELECT * FROM product WHERE product_id = $product_id ORDER BY product_id DESC";
        $prod = $this -> db -> select($query) -> fetch_assoc();
        $product_sale_price = $prod['product_sale_price'];

        $query = "SELECT * FROM discount WHERE product_id = $product_id ORDER BY discount_point ASC";
        $dis = $this -> db -> select($query);
        $discount_point = 0;

        while($result = $dis -> fetch_assoc()){
            if($product_sum >= $result['discount_point']){
                $discount_point = $result['discount_point'];
            }
        }

        $query = "SELECT * FROM discount WHERE product_id = '$product_id' AND discount_point = '$discount_point'";
        $temp = $this -> db -> select($query) -> fetch_assoc();
        $discount_id = $temp['discount_id'];
        $discount_value = $temp['discount_value'];
        $product_value_discount = $product_sale_price - $product_sale_price*($discount_value/100);
        $total_value_discount = $product_value_discount*$product_sum;

        $query = "UPDATE campaign SET 
                    discount_id = $discount_id, 
                    product_value_discount = '$product_value_discount',
                    total_value_discount = '$total_value_discount' WHERE campaign_id = $campaign_id";
        $result = $this -> db -> update($query);
    }

    public function show_all_campaign(){
        $query = "SELECT campaign.*, discount.discount_value FROM campaign INNER JOIN discount ON
        campaign.discount_id = discount.discount_id ORDER BY campaign_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_campaign_by_product($product_id){
        $query = "SELECT campaign.*, discount.discount_value, product.* FROM campaign INNER JOIN discount ON
        campaign.discount_id = discount.discount_id INNER JOIN product ON campaign.product_id = product.product_id 
        WHERE campaign.product_id = '$product_id' ORDER BY campaign.campaign_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_campaign_by_seller($seller_id){
        // Lấy sản phẩm của người bán và lưu ID sản phẩm vào 1 mảng
        $query = "SELECT * FROM product WHERE user_id = $seller_id ORDER BY product_id DESC";
        $temp = $this -> db -> select($query);
        while($row = $temp-> fetch_assoc()){
            $product_id[] = $row['product_id'];
        }

        if(!empty($product_id)){
            // Chuyển đổi mảng thành chuỗi các giá trị phân tách bằng dấu phẩy
            $product_id_list = implode(",", $product_id);

            // Thực hiện lệnh select chiến dịch có ID sản phẩm nằm trong mảng đã lấy
            $query = "SELECT campaign.*, discount.discount_value, product.* FROM campaign INNER JOIN discount ON
            campaign.discount_id = discount.discount_id INNER JOIN product ON campaign.product_id = product.product_id 
            WHERE campaign.product_id IN ($product_id_list) ORDER BY campaign.campaign_id ASC";
            $result = $this -> db -> select($query);
            return $result;
        }
    }

    public function get_campaign($campaign_id){
        $query = "SELECT campaign.*, discount.discount_value FROM campaign INNER JOIN discount 
                ON campaign.discount_id = discount.discount_id WHERE campaign_id = $campaign_id 
                ORDER BY campaign_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function create_campaign(){
        $product_id = $_POST['product_id'];
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];

        $query = "SELECT * FROM discount WHERE product_id = $product_id ORDER BY discount_point ASC LIMIT 1";
        $temp = $this -> db -> select($query) -> fetch_assoc();
        $discount_id = $temp['discount_id'];

        $query = "SELECT * FROM product WHERE product_id = $product_id";
        $temp = $this -> db -> select($query) -> fetch_assoc();
        $product_value_discount = $temp['product_sale_price'];

        $query = "INSERT INTO campaign (
                product_id,
                discount_id,
                product_sum, 
                product_value_discount, 
                total_value_discount, 
                time_start, 
                time_end) VALUES (
                    '$product_id', 
                    '$discount_id',
                    '0',
                    '$product_value_discount',
                    '0',
                    '$time_start',
                    '$time_end')";
        $result = $this -> db -> insert($query);
        return $result;
    }

    public function update_campaign($campaign_id, $user_id){
        $time_start = $_POST['time_start'];
        $time_end = $_POST['time_end'];

        $query = "UPDATE campaign SET time_start = '$time_start', time_end = '$time_end' WHERE campaign_id = $campaign_id";
        $result = $this -> db -> update($query);
        header("location:list_campaign.php?user_id=".$user_id);
        return $result;
    }

    public function create_order($campaign_id, $user_id, $quantity){
        $query = "SELECT * FROM campaign WHERE campaign_id = $campaign_id ORDER BY campaign_id DESC";
        $get_campaign = $this -> db -> select($query) -> fetch_assoc();
        $price = $get_campaign['product_value_discount'];
        $price_discount = $price*$quantity;
        $down_payment = $price_discount/2;

        $query = "INSERT INTO order_tbl (
            campaign_id, 
            user_id, 
            quantity, 
            price_discount, 
            down_payment,
            order_condition) VALUES (
                '$campaign_id', 
                '$user_id', 
                '$quantity', 
                '$price_discount', 
                '$down_payment', 
                '0')";
        $result = $this -> db -> insert($query);
        return $result;
    }

    public function update_order($campaign_id){
        // Lấy những đơn hàng của chiến dịch có id này
        $query = "SELECT * FROM order_tbl WHERE campaign_id = $campaign_id ORDER BY campaign_id ASC";
        $get_order = $this -> db -> select($query);

        // Lấy giá 1 sản phẩm đã chiết khấu của chiến dịch này
        $query = "SELECT * FROM campaign WHERE campaign_id = $campaign_id ORDER BY campaign_id DESC";
        $get_campaign = $this -> db -> select($query) -> fetch_assoc();
        $price = $get_campaign['product_value_discount'];

        // Với từng đơn hàng, cập nhật lại các giá trị
        while($temp = $get_order->fetch_assoc()){
            $order_id = $temp['order_id'];
            $quantity = $temp['quantity'];
            // Các giá trị cần cập nhật
            $price_discount = $price*$quantity;
            $down_payment = $price_discount/2;

            $query = "UPDATE order_tbl SET price_discount = '$price_discount',
            down_payment = $down_payment WHERE order_id = $order_id";
            $result = $this -> db -> update($query);
        }
        return $result;
    }

    public function join_campaign($campaign_id, $user_id){
        // Kiểm tra xem người dùng đã tham gia chiến dịch chưa
        $query = "SELECT * FROM order_tbl WHERE user_id = $user_id AND campaign_id = $campaign_id";
        $check = $this -> db -> select($query);
        if($check != false){
            $result = false;
            return $result;
        }else{
            // Kiểm tra xem chiến dịch đã có ai tham gia chưa
            $query = "SELECT * FROM campaign WHERE campaign_id = $campaign_id";
            $get_campaign = $this->db-> select($query)->fetch_assoc();
            $check = $get_campaign['product_sum'];

            // Cập nhật số lượng sản phẩm trong chiến dịch
            $quantity = $_POST['quantity'];
            $query = "UPDATE campaign SET product_sum = product_sum + $quantity WHERE campaign_id = $campaign_id";
            $result = $this -> db -> update($query);

            // Cập nhật lại các giá trị trong chiến dịch sau khi có người mới tham gia
            $temp = $this -> cal_discount($campaign_id);
            if($check != 0){
                $temp =$this -> update_order($campaign_id);
            }
            $temp = $this -> create_order($campaign_id, $user_id, $quantity);
            return $result;
        }
    }

    public function time_check($campaign_id){
        $query = "SELECT * FROM "
        function manage_campaign($time_start, $time_end) {
            $current_time = time();
    
            if ($current_time >= $time_start && $current_time < $time_end) {
                echo "Chiến dịch đang diễn ra.";
                // Gọi hàm bắt đầu chiến dịch
                start_campaign();
            } elseif ($current_time >= $time_end) {
                echo "Chiến dịch đã kết thúc.";
                // Gọi hàm kết thúc chiến dịch
                end_campaign();
            } else {
                echo "Chiến dịch chưa bắt đầu.";
            }
        }
    }

}
?>