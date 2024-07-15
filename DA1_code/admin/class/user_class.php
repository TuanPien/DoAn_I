<?php
include_once "database.php";

class user{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }

    public function show_user(){
        $query = "SELECT * FROM  user ORDER BY user_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function delete_user($user_id){
        $query ="DELETE FROM user WHERE user_id = '$user_id'";
        $result = $this -> db -> delete($query);
        header('location:admin_userlist.php');
        return $result;
    }

    public function insert_user(){

        $user_name = $_POST['user_name'];
        $user_phone = $_POST['user_phone'];
        $user_dob = $_POST['user_dob'];
        $user_type = $_POST['user_type'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_password = md5($_POST['user_password']);
        $confirmPassword = md5($_POST['confirmPassword']);

        $query = "SELECT * FROM user WHERE user_email = '$user_email'";
        $temp_result = $this -> db -> select($query);

        if($temp_result != false){
            $result = 0;
        }else{
            if($user_password != $confirmPassword){
                $result = 1;
            }else{
                $query = "INSERT INTO user (
                    user_name, 
                    user_phone, 
                    user_dob, 
                    user_type, 
                    user_email, 
                    user_address, 
                    user_password) VALUES (
                        '$user_name',
                        '$user_phone', 
                        '$user_dob', 
                        '$user_type', 
                        '$user_email', 
                        '$user_address', 
                        '$user_password')";
                $result = $this -> db -> insert($query);
                $query = "SELECT * FROM user ORDER BY user_id DESC LIMIT 1";
                $result = $this -> db -> select($query) -> fetch_assoc();
                $user_id = $result['user_id'];
                if($user_type == 0){
                    header('location:admin/add_product.php'.'?'.'user_id='.$user_id);
                }else{
                    header('location:homepage.php'.'?'.'user_id='.$user_id);
                }
            }
        }
        return $result;
    }

    public function user_login($user_email, $user_password){
        $query = "SELECT * FROM user WHERE user_email = '$user_email' AND user_password = '$user_password' LIMIT 1";
        $temp_result = $this -> db -> select($query);
        if($temp_result != false){
            $result = $temp_result -> fetch_assoc();
            $user_id = $result['user_id'];
            if($result['user_type'] == '1'){
                header('location:homepage.php'.'?'.'user_id='.$user_id);
            }
            elseif($result['user_type'] == '2'){
                header('location:admin/admin_productlist.php');
            }else{
                header('location:admin/add_product.php'.'?'.'user_id='.$user_id);
            }
        }else{
            $result = false;
        }
        return $result;
    }

    public function get_user($user_id){
        $query = "SELECT * FROM user WHERE user_id = '$user_id'";
        $result = $this -> db -> select($query);
        if($result == false){
            die("<h3 style=\"color: red;\">Không tìm thấy người dùng</h3>");
        }
        return $result;
    }

    public function update_user($user_id){
        $user_name = $_POST['user_name'];
        $user_phone = $_POST['user_phone'];
        $user_dob = $_POST['user_dob'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_password = md5($_POST['user_password']);

        //Đối chiếu với mật khẩu trong csdl
        $get_user = $this -> get_user($user_id);
        $temp = $get_user -> fetch_assoc();
        $password = $temp['user_password'];
        $user_type = $temp['user_type'];
        if($user_password != $password){
            return false;
        }else{
            $query = "UPDATE user SET user_name = '$user_name', user_phone = '$user_phone', user_dob = '$user_dob', user_email = '$user_email', user_address = '$user_address' WHERE user_id = $user_id";
            $result = $this -> db -> select($query);
            switch($user_type){
                case "0":
                    header("location:");
                    exit();
                    break;
                case "1":
                    header("location:user_buyer.php?user_id=".$user_id);
                    exit();
                    break;
                default:
                    header("location:");
                    exit();
                    break;
            }
            return $result;
        }
    }

    public function change_password($user_id){
        $user_email = $_POST['user_email'];
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //Đối chiếu với mật khẩu trong csdl
        $get_user = $this -> get_user($user_id);
        $temp = $get_user -> fetch_assoc();
        $password = $temp['user_password'];
        $email = $temp['user_email'];
        $user_type = $temp['user_type'];
        if($old_password != $password || $user_email != $email){
            return 0;
        }elseif($new_password != $confirm_password){
            return 1;
        }elseif($new_password == $old_password){
            return 2;
        }
        else{
            $query = "UPDATE user SET user_password = '$new_password' WHERE user_id = $user_id";
            $result = $this -> db -> select($query);
            switch($user_type){
                case "0":
                    header("location:");
                    exit();
                    break;
                case "1":
                    header("location:user_buyer.php?user_id=".$user_id);
                    exit();
                    break;
                default:
                    header("location:");
                    exit();
                    break;
            }
            return $result;
        }
    }
}
?>