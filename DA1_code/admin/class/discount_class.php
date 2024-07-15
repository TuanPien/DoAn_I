<?php
include_once "database.php";

class discount{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }

    public function insert_discount($user_id){

        $product_id = $_POST['product_id'];
        $discount_point = $_POST['discount_point'];
        $discount_value = $_POST['discount_value'];

        $query = "INSERT INTO discount (
            user_id,
            product_id,
            discount_point, 
            discount_value) VALUES (
                '$user_id',
                '$product_id', 
                '$discount_point', 
                '$discount_value')";
        $result = $this -> db -> insert($query);
        return $result;
    }

    public function show_discount($user_id){
        $query = "SELECT discount.*, product.product_name FROM discount INNER JOIN product ON discount.product_id = product.product_id WHERE discount.user_id = '$user_id' ORDER BY discount.product_id ASC, discount.discount_point ASC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_discount_by_product($product_id){
        $query = "SELECT * FROM discount WHERE product_id = '$product_id' ORDER BY discount_point ASC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function admin_show_discount(){
        $query = "SELECT discount.*, user.user_email, product.product_name FROM discount INNER JOIN user ON discount.user_id = user.user_id INNER JOIN product ON discount.product_id = product.product_id
                ORDER BY discount.user_id ASC, discount.product_id ASC, discount.discount_point ASC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function get_discount($discount_id){
        $query = "SELECT * FROM discount WHERE discount_id = '$discount_id'";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function update_discount($discount_id){

        //Lay user_id de co url cho header
        $query = "SELECT * FROM discount WHERE discount_id = '$discount_id'";
        $temp_result = $this -> db -> select($query) ->fetch_assoc();
        $user_id = $temp_result['user_id'];

        $product_id = $_POST['product_id'];
        $discount_point = $_POST['discount_point'];
        $discount_value = $_POST['discount_value'];

        $query = "UPDATE discount SET 
            product_id = '$product_id',
            discount_point = '$discount_point', 
            discount_value = '$discount_value' WHERE discount_id = '$discount_id'";
        $result = $this -> db -> update($query);
        header('location:list_discount.php'.'?'.'user_id='.$user_id);
        return $result;
    }

    public function delete_discount($discount_id){
        //Lay user_id de co url cho header
        $query = "SELECT * FROM discount WHERE discount_id = $discount_id";
        $result = $this -> db -> select($query)->fetch_assoc();
        $user_id = $result['user_id'];

        $query ="DELETE FROM discount WHERE discount_id = '$discount_id'";
        $result = $this -> db -> delete($query);
        header('location:list_discount.php'.'?'.'user_id='.$user_id);
        return $result;
    }

}
?>