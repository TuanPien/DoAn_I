<?php
include "class/discount_class.php";

$discount = new discount;

if(!isset($_GET['discount_id']) || $_GET['discount_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}
else{
    $discount_id = $_GET['discount_id'];
}
    $delete_discount = $discount -> delete_discount($discount_id);
?>