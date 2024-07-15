<?php
include_once "class/slider_class.php";

$slider = new slider;

if(!isset($_GET['slider_id']) || $_GET['slider_id'] == NULL){
    echo "<script>window.location = 'admin_productlist.php'</script>";
}else{
    $slider_id = $_GET['slider_id'];
}
$delete_slider = $slider -> delete_slider($slider_id);

?>