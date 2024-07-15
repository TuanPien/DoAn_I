<?php
include "admin/class/order_class.php";

$order = new order;

if (!isset($_GET['order_id']) || $_GET['order_id'] == NULL || !isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $order_id = $_GET['order_id'];
    $user_id = $_GET['user_id'];
}
$delete_order = $order->delete_order($order_id, $user_id);
?>