<?php

use LDAP\ResultEntry;

include_once "database.php";

class delivery{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }

    public function insert_delivery($order_id){
        $user_name = $_POST['user_name'];
        $user_phone = $_POST['user_phone'];
        $user_address = $_POST['user_address'];

        $query = "INSERT INTO temp_delivery (user_name, user_phone, user_address, order_id) VALUES ('$user_name', '$user_phone', '$user_address', '$order_id')";
        $result = $this -> db -> insert($query);
        return $result;
    }

    public function get_delivery($order_id){
        $query = "SELECT *, COUNT(*) as total FROM delivery WHERE order_id = $order_id ORDER BY order_id DESC";
        $result = $this -> db -> select($query);
        if($result == false){
            return false;
        }else{
            return $result;
        }
    }
}
?>