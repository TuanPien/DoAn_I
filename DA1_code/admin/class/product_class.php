<?php
include_once "database.php";
include_once "campaign_class.php";

class product{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }

    public function show_brand(){
        $query = "SELECT * FROM brand ORDER BY brand.brand_name";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function insert_product($user_id, $data, $files){

        $product_name = mysqli_escape_string($this->db->link, $data['product_name']);
        $brand_id = $data['brand_id'];
        $product_price = mysqli_escape_string($this->db->link, $data['product_price']);
        $product_sale_price = mysqli_escape_string($this->db->link, $data['product_sale_price']);
        $product_description = mysqli_escape_string($this->db->link, $data['product_description']);
        $product_prior = $data['product_prior'];

        $permited = array('jpg', 'jpeg'. 'png', 'gif');
        $file_name = $files['main_img']['name'];
        $file_temp = $files['main_img']['tmp_name'];
        $file_size = $files['main_img']['size'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/product/".$unique_image;

        move_uploaded_file($file_temp, $uploaded_image);

        $query = "INSERT INTO product (
            user_id,
            product_name, 
            brand_id, 
            product_price, 
            product_sale_price, 
            product_description, 
            product_main_image, 
            product_priority) VALUES (
                '$user_id', 
                '$product_name',
                '$brand_id',
                '$product_price',
                '$product_sale_price',
                '$product_description',
                '$unique_image',
                '$product_prior')";
        $result = $this -> db -> insert($query);

        // if($result){
        //     $query = "SELECT * FROM product ORDER BY product_id DESC LIMIT 1";
        //     $temp_result = $this -> db -> select($query) -> fetch_assoc();
        //     $product_id = $temp_result['product_id'];
        //     $filename = $_FILES['sub_img']['name'];
        //     $filetmp_name = $_FILES['sub_img']['tmp_name'];

        //     foreach($filename as $key => $value){
        //         move_uploaded_file($filetmp_name[$key], 'uploads/product_sub_img/'.$value);
        //         $query = "INSERT INTO product_sub_img (product_id, product_sub_immage) VALUES ('$product_id','$value')";
        //         $result = $this -> db -> insert($query);
        //     }
        // }

        return $result;
    }

    public function create_discount_new_product($user_id){
        $query = "SELECT * FROM product WHERE user_id = $user_id ORDER BY product_id DESC";
        $result = $this -> db -> select($query) -> fetch_assoc();
        $product_id = $result['product_id'];

        $query = "INSERT INTO discount (user_id, product_id, discount_point, discount_value) VALUES ('$user_id', '$product_id', '0', '0')";
        $result = $this -> db -> insert($query);

        header('location:list_product.php'.'?'.'user_id='.$user_id);
        return $result;
    }

    public function show_product($user_id){
        $query = "SELECT product.*, brand.brand_name FROM product INNER JOIN brand ON 
                product.brand_id = brand.brand_id WHERE product.user_id = $user_id 
                ORDER BY product.product_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_product_by_id($product_id){
        $query = "SELECT *FROM product WHERE product_id = $product_id ORDER BY product_id DESC LIMIT 1";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_all_product(){
        $query = "SELECT product.*, brand.brand_name, user.user_email FROM product INNER JOIN brand ON 
                product.brand_id = brand.brand_id INNER JOIN user ON product.user_id = user.user_id
                ORDER BY product.product_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_all_product_homepage(){
        $query = "SELECT product.*, brand.brand_name, user.user_email FROM product INNER JOIN brand ON 
                product.brand_id = brand.brand_id INNER JOIN user ON product.user_id = user.user_id
                ORDER BY product.product_priority DESC, product.product_name DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_product_brand_sort($brand_id){
        $query = "SELECT product.*, brand.brand_name, user.user_email FROM product INNER JOIN brand ON 
                product.brand_id = brand.brand_id INNER JOIN user ON product.user_id = user.user_id WHERE product.brand_id = $brand_id
                ORDER BY product.product_priority DESC, product.product_name DESC";
        $result = $this -> db -> select($query);
        if($result == false){
            return false;
        }else{
            return $result;
        }
    }

    public function show_product_hot(){
        $query = "SELECT product.*, user.user_email FROM product 
                INNER JOIN user ON product.user_id = user.user_id WHERE product.product_priority = 1
                ORDER BY product.product_id DESC LIMIT 5";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_relevant_product($product_id){
        $query = "SELECT * FROM product WHERE product_id = $product_id";
        $temp = $this -> db -> select($query) -> fetch_assoc();
        $relevant = $temp['brand_id'];

        $query = "SELECT * FROM product WHERE brand_id = $relevant AND product_id != $product_id 
                ORDER BY product_priority DESC, product_id DESC LIMIT 5";
        $result = $this -> db -> select($query);
        return $result;
    }
    
    public function get_product($product_id){
        $query = "SELECT * FROM product WHERE product_id = '$product_id'";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function update_product($product_id){

        $product_name = $_POST['product_name'];
        $brand_id = $_POST['brand_id'];
        $product_price = $_POST['product_price'];
        $product_sale_price = $_POST['product_sale_price'];
        $product_description = mysqli_escape_string($this->db->link, $_POST['product_description']);
        $product_prior = $_POST['product_prior'];

        $permited = array('jpg', 'jpeg'. 'png', 'gif');
        $file_name = $_FILES['main_img']['name'];
        $file_temp = $_FILES['main_img']['tmp_name'];
        $file_size = $_FILES['main_img']['size'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/product/".$unique_image;

        if(!empty($file_name)){
            $query = "UPDATE product SET 
                product_name = '$product_name',
                brand_id = '$brand_id',
                product_price = '$product_price',
                product_sale_price = '$product_sale_price',
                product_description = '$product_description',
                product_main_image = '$unique_image',
                product_priority = '$product_prior'
            WHERE product_id = '$product_id'";
            move_uploaded_file($file_temp, $uploaded_image);
        }else{
            $query = "UPDATE product SET 
                product_name = '$product_name',
                brand_id = '$brand_id',
                product_price = '$product_price',
                product_sale_price = '$product_sale_price',
                product_description = '$product_description',
                product_priority = '$product_prior'
            WHERE product_id = '$product_id'";
        }
        $result = $this -> db -> update($query);
        
        //Lay user_id de co url cho header
        $query = "SELECT * FROM product WHERE product_id = $product_id";
        $result = $this -> db -> select($query) -> fetch_assoc();
        $user_id = $result['user_id'];

        header('location:list_product.php?user_id='.$user_id);
        return $result;
    }

    public function delete_product($product_id){
        //Lay user_id de co url cho header, lay path file main img
        
        $query = "SELECT * FROM product WHERE product_id = $product_id";
        $temp = $this -> db -> select($query);
        if($temp){
            $temp = $temp-> fetch_assoc();
            $imgname = $temp['product_main_image'];
            $user_id = $temp['user_id'];
            $path = "uploads/product/".$imgname;
            if(file_exists($path)){
                unlink($path);
            }
            //Lấy những chiến dịch của sản phẩm này
            $query = "SELECT * FROM campaign WHERE product_id = $product_id";
            $check = $this -> db -> select($query);
            if($check != false){
                while($bin = $check -> fetch_assoc()){
                    $campaign_id = $bin['campaign_id'];
                    $query = "SELECT * FROM order_tbl WHERE campaign_id = $campaign_id";
                    $check2 = $this -> db -> select($query);
                    if($check2 != false){
                        while($bin2 = $check2 -> fetch_assoc()){
                            $order_id = $bin2['order_id'];
                            $query = "DELETE FROM delivery WHERE order_id = $order_id";
                            $result = $this -> db -> delete($query);
                        }
                    }
                    $query = "DELETE FROM order_tbl WHERE campaign_id = $campaign_id";
                    $result = $this -> db -> delete($query);
                }
            }

            //Xoá chiến dịch của những sản phẩm này 
            $query = "DELETE FROM campaign WHERE product_id = '$product_id'";
            $result = $this -> db -> delete($query);

            //Xoá chiết khấu của những sản phẩm này 
            $query = "DELETE FROM discount WHERE product_id = '$product_id'";
            $result = $this -> db -> delete($query);

            //Xoá sản phẩm
            $query = "DELETE FROM product WHERE product_id = '$product_id'";
            $result = $this -> db -> delete($query);
            header('location:list_product.php'.'?'.'user_id='.$user_id);
            return $result;
        }else{
            echo "<h3 style=\"color: red;\">Không tồn tại sản phẩm</h3>";
        }
    }

    public function admin_delete_product($product_id){
        $query = "SELECT * FROM product WHERE product_id = $product_id";
        $temp = $this -> db -> select($query);
        if($temp){
            $temp = $temp-> fetch_assoc();
            $imgname = $temp['product_main_image'];
            $user_id = $temp['user_id'];
            $path = "uploads/product/".$imgname;
            if(file_exists($path)){
                unlink($path);
            }

            //Xoá chiến dịch của những sản phẩm này (nếu có)
            $query = "SELECT * FROM campaign WHERE product_id = '$product_id'";
            $result = $this -> db -> select($query);
            if($result != false){
                $campaign = new campaign;
                while($temp = $result -> fetch_assoc()){
                    $campaign_id = $temp['campaign_id'];
                    $delete_campaign = $campaign -> delete_campaign_product($campaign_id);
                }
            }

            //Xoá chiết khấu của những sản phẩm này 
            $query = "DELETE FROM discount WHERE product_id = '$product_id'";
            $result = $this -> db -> delete($query);

            //Xoá sản phẩm
            $query = "DELETE FROM product WHERE product_id = '$product_id'";
            $result = $this -> db -> delete($query);
            header('location:admin_productlist.php');
            return $result;
        }else{
            echo "<h3 style=\"color: red;\">Không tồn tại sản phẩm</h3>";
        }
    }

    public function product_search($search_key){
        $query = "SELECT product.*, brand.brand_name, user.user_email FROM product INNER JOIN brand ON product.brand_id = brand.brand_id INNER JOIN user ON product.user_id = user.user_id WHERE product.product_name LIKE '%$search_key%' OR brand.brand_name LIKE '%$search_key%'";
        $result = $this -> db -> select($query);
        return $result;
    }
}
?>