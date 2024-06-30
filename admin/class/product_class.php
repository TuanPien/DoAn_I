<?php

include_once "database.php";

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
        $uploaded_image = "uploads/".$unique_image;

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
                ORDER BY product.product_name DESC LIMIT 5";
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
        $uploaded_image = "uploads/".$unique_image;

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
        //Lay user_id de co url cho header
        $query = "SELECT * FROM product WHERE product_id = $product_id";
        $result = $this -> db -> select($query)->fetch_assoc();
        $user_id = $result['user_id'];

        $query = "DELETE FROM product WHERE product_id = '$product_id'";
        $result = $this -> db -> delete($query);
        header('location:list_product.php'.'?'.'user_id='.$user_id);
        return $result;
    }

    public function admin_delete_product($product_id){
        $query ="DELETE FROM product WHERE product_id = '$product_id'";
        $result = $this -> db -> delete($query);
        header('location:admin_productlist.php');
        return $result;
    }
}
?>