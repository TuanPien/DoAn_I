<?php
include "class/user_class.php";

$user = new user;

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = 'admin_userlist.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}
    $delete_user = $user -> delete_user($user_id);
?>