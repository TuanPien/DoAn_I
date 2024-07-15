<?php

include "admin/class/user_class.php";

$user = new user;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_email = $_POST['user_email'];
    $user_password = md5($_POST['user_password']);

    $user_login = $user->user_login($user_email, $user_password);
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="css/dangky_dangnhap.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container">
        <div class="signup-link">
            <div class="logo">
                <a href="homepage.php">
                    <i class='bx bx-cart'></i>
                    <span class="text">BUY TOGETHER</span>
                </a>
            </div>
            <p class="side-big-heading">Chưa có tài khoản?</p>
            <p class="primary-big-text">Để có thể tham gia giao dịch, vui lòng tạo tài khoản của bạn</p>
            <a href="signup.php" class="loginbtn">Đăng Ký</a>
        </div>
        <form action="" method="POST" class="login-form-container">
            <p class="big-heading">Đăng Nhập</p>
            <div class="social-media-platform">
                <a href="#"><i class='bx bx-sm bxl-facebook'></i></a>
                <a href="#"><i class='bx bx-sm bxl-google'></i></a>
            </div>
            <div class="login-form-contents">
                <div class="text-fields email">
                    <label for="user_email"><i class='bx bx-user'></i></label>
                    <input type="email" name="user_email" id="email" placeholder="Nhập Email">
                </div>
                <div class="text-fields password">
                    <label for="user_password"><i class='bx bx-lock-alt'></i></label>
                    <input type="password" name="user_password" id="password" placeholder="Nhập mật khẩu">
                </div>
            </div>
            <input type="submit" name="submit" value="Đăng Nhập" class="nextPage submit">
            <?php
            if (isset($user_login) && $user_login == false) {
            ?>
                <div class="alert" style="margin: 5% 0; width: 500px;">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Sai email hoặc mật khẩu!</strong> Vui lòng đăng nhập lại
                </div>
            <?php
            }
            ?>
        </form>
</body>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</html>