<?php
include_once "database.php";

class brand{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }

    public function insert_brand($category_id, $brand_name){
        $query = "INSERT INTO brand (category_id, brand_name) VALUES ('$category_id', '$brand_name')";
        $result = $this -> db -> insert($query);
        // header('location:admin_brandlist.php');
        return $result;
    }

    public function show_category(){
        $query = "SELECT * FROM  category ORDER BY category_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function show_brand(){
        $query = "SELECT brand.*, category.category_name FROM brand INNER JOIN category
        ON brand.category_id = category.category_id ORDER BY brand.brand_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function get_brand($brand_id){
        $query = "SELECT * FROM brand WHERE brand_id = '$brand_id'";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function update_brand($brand_name, $brand_id, $category_id){
        $query = "UPDATE brand SET brand_name = '$brand_name', category_id = '$category_id' WHERE brand_id = '$brand_id'";
        $result = $this -> db -> update($query);
        header('location:admin_brandlist.php');
        return $result;
    }

    public function delete_brand($brand_id){
        $query ="DELETE FROM brand WHERE brand_id = '$brand_id'";
        $result = $this -> db -> delete($query);
        header('location:admin_brandlist.php');
        return $result;
    }

    public function show_brand_by_category($category_id){
        $query = "SELECT * FROM brand WHERE category_id = '$category_id' ORDER BY brand_name";
        $result = $this -> db -> select($query);
        return $result;
    }
}
?>