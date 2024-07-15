<?php

use LDAP\ResultEntry;

include_once "database.php";

class order{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }

    public function show_all_order(){
        $query = "SELECT * FROM  order_tbl ORDER BY order_id DESC, campaign_id DESC, user_id ASC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_order_seller($seller_id){
        // Lấy sản phẩm của người bán và lưu ID sản phẩm vào 1 mảng
        $query = "SELECT * FROM product WHERE user_id = $seller_id ORDER BY product_id DESC";
        $temp = $this -> db -> select($query);
        if($temp != false){
            while($row = $temp-> fetch_assoc()){
                $product_id[] = $row['product_id'];
            }
    
            if(!empty($product_id)){
                // Chuyển đổi mảng thành chuỗi các giá trị phân tách bằng dấu phẩy
                $product_id_list = implode(",", $product_id);
    
                // Thực hiện lệnh select chiến dịch có ID sản phẩm nằm trong mảng đã lấy
                $query = "SELECT * FROM campaign WHERE campaign.product_id IN ($product_id_list) 
                        ORDER BY campaign_id ASC";
                $temp = $this -> db -> select($query);
                if($temp != false){
                    while($row = $temp-> fetch_assoc()){
                        $campaign_id[] = $row['campaign_id'];
                    }
                    if(!empty($campaign_id)){
                        // Chuyển đổi mảng thành chuỗi các giá trị phân tách bằng dấu phẩy
                        $campaign_id_list = implode(",", $campaign_id);
                        $query = "SELECT order_tbl.*, user.user_email FROM order_tbl INNER JOIN user ON order_tbl.user_id = user.user_id  WHERE campaign_id IN ($campaign_id_list) ORDER BY order_id ASC";
                        $result = $this -> db -> select($query);
                        if($result != false){
                            return $result;
                        }else{
                            return "Bạn chưa có đơn hàng nào";
                        }
                    }
                }else{
                    return "Bạn chưa có chiến dịch nào";
                }
            }
        }else{
            return "Bạn chưa có sản phẩm nào";
        }
    }

    public function update_order($order_id, $user_id){
        $order_condition = $_POST['order_condition'];
        $query = "UPDATE order_tbl SET order_condition = $order_condition WHERE order_id = $order_id";
        $result = $this -> db -> update($query);
        header('location:list_order.php?user_id='.$user_id);
        return $result;
    }

    public function customer_confirm($order_id, $user_id){;
        $query = "UPDATE order_tbl SET order_condition = 3 WHERE order_id = $order_id";
        $result = $this -> db -> update($query);
        return $result;
    }

    public function get_order($order_id){
        $query = "SELECT * FROM order_tbl WHERE order_id = '$order_id'";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function get_order_buyer($buyer_id){
        $query = "SELECT * FROM order_tbl WHERE user_id = $buyer_id AND order_condition IN (0,1) ORDER BY order_condition DESC, order_id DESC ";
        $result = $this -> db -> select($query);
        if($result == false){
            return false;
        }else{
            return $result;
        }
    }
    
    public function count($buyer_id){
        $query = "SELECT COUNT(*) as total FROM order_tbl WHERE user_id = $buyer_id AND order_condition IN (0,1)";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function sum_buyer_price_discount($buyer_id){
        $query = "SELECT SUM(price_discount) as total_price FROM order_tbl WHERE user_id = $buyer_id AND order_condition IN (0,1)";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function sum_buyer_down_payment($buyer_id){
        //Kiểm tra xem người dùng có đơn hàng nào chưa đặt cọc không, nếu không trả về 0
        $query = "SELECT * FROM order_tbl WHERE user_id = $buyer_id AND order_condition = 0";
        $check = $this -> db -> select($query);
        if($check == false){
            return false;
        }else{
            $query = "SELECT SUM(down_payment) as total_payment FROM order_tbl WHERE user_id = $buyer_id AND order_condition = 0";
            $result = $this -> db -> select($query);
            return $result;
        }
    }

    public function get_buyer_history($buyer_id){
        $query = "SELECT * FROM order_tbl WHERE user_id = $buyer_id AND order_condition IN (2,3) ORDER BY order_id DESC";
        $result = $this -> db -> select($query);
        if($result == false){
            return false;
        }else{
            return $result;
        }
    }

    public function sum_history($buyer_id){
        $query = "SELECT SUM(price_discount) as total_price, COUNT(*) as total FROM order_tbl WHERE user_id = $buyer_id AND order_condition IN (2,3)";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function delete_order($order_id, $user_id){
        // Lấy ID chiến dịch từ ID đơn hàng
        $query = "SELECT * FROM order_tbl WHERE order_id = $order_id";
        $temp = $this -> db -> select($query) -> fetch_assoc();
        $campaign_id = $temp['campaign_id'];
        $quantity = $temp['quantity'];

        // Cập nhật số lượng sản phẩm trong chiến dịch
        $query = "UPDATE campaign SET product_sum = (product_sum - $quantity) WHERE campaign_id = $campaign_id";
        $result = $this -> db -> update($query);

        // Gọi hàm tính toán chiết khấu để tính toán lại chiến dịch
        include_once "campaign_class.php";
        $campaign = new campaign;
        $cal_discount = $campaign -> cal_discount($campaign_id);

        // Xoá thông tin vận chuyển của đơn hàng khỏi csdl
        $query = "DELETE FROM delivery WHERE order_id = '$order_id'";
        $result = $this -> db -> delete($query);

        // Xoá đơn hàng khỏi csdl
        $query = "DELETE FROM order_tbl WHERE order_id = '$order_id'";
        $result = $this -> db -> delete($query);
        
        header('location:cart.php'.'?'.'user_id='.$user_id);
        return $result;
    }

}
?>