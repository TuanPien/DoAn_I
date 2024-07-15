<?php
include "admin/class/user_class.php";

$user = new user;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $insert_user = $user->insert_user($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="css/dangky_dangnhap.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="container">
        <div class="login-link">
            <div class="logo">
                <a href="homepage.php">
                    <i class='bx bx-cart'></i>
                    <span class="text">BUY TOGETHER</span>
                </a>
            </div>
            <p class="side-big-heading">Đã có tài khoản?</p>
            <p class="primary-big-text">Để có thể tham gia giao dịch, vui lòng đăng nhập vào tài khoản của bạn</p>
            <a href="login.php" class="loginbtn">Đăng nhập</a>
        </div>
        <form action="" method="post" class="signup-form-container">
            <p class="big-heading">Tạo Tài Khoản</p>
            <div class="social-media-platform">
                <a href="#"><i class='bx bx-sm bxl-facebook'></i></a>
                <a href="#"><i class='bx bx-sm bxl-google'></i></a>
            </div>
            <div class="progress-bar">
                <div class="stage">
                    <p class="tool-tip">Cá Nhân</p>
                    <p class="stageno stageno-1">1</p>
                </div>
                <div class="stage">
                    <p class="tool-tip">Liên Lạc</p>
                    <p class="stageno stageno-2">2</p>
                </div>
                <div class="stage">
                    <p class="tool-tip">Đăng Ký</p>
                    <p class="stageno stageno-3">3</p>
                </div>
            </div>
            <div class="signup-form-content">
                <div class="stage1-content">
                    <div class="button-container">
                        <div class="text-fields name">
                            <label for="user_name"><i class='bx bx-user'></i></label>
                            <input type="text" name="user_name" id="name" required placeholder="Nhập họ và tên">
                        </div>
                        <div class="text-fields phone">
                            <label for="user_phone"><i class='bx bx-phone'></i></label>
                            <input type="text" name="user_phone" id="phone" required placeholder="Nhập số điện thoại">
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="text-fields dob">
                            <input type="date" name="user_dob" reqired id="dob">
                        </div>
                        <div class="user-type-selection">
                            <p class="field-heading">Người dùng:</p>
                            <label for="buyer">
                                <input type="radio" name="user_type" id="buyer" value="1">Mua
                            </label>
                            <label for="seller">
                                <input type="radio" name="user_type" id="seller" value="0">Bán
                            </label>
                        </div>
                    </div>
                    <div class="pagination-btns">
                        <input type="button" value="Sau" class="nextPage stagebtn1b" onclick="stage1to2()">
                    </div>
                </div>
                <div class="stage2-content">
                    <div class="button-container">
                        <div class="text-fields email">
                            <label for="user_email"><i class='bx bx-envelope'></i></label>
                            <input type="email" name="user_email" id="email" required placeholder="Nhập Email">
                        </div>
                        <div class="text-fields address">
                            <label for="user_address"><i class='bx bx-user'></i></label>
                            <input type="text" name="user_address" id="address" required placeholder="Nhập địa chỉ">
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="text-fields password">
                            <label for="user_password"><i class='bx bx-lock-alt'></i></label>
                            <input type="password" name="user_password" id="password" required placeholder="Nhập mật khẩu">
                        </div>
                        <div class="text-fields confirmPassword">
                            <label for="confirmPassword"><i class='bx bx-lock-alt'></i></label>
                            <input type="password" name="confirmPassword" id="confirmPassword" required placeholder="Nhập mật khẩu">
                        </div>
                    </div>
                    <div class="pagination-btns">
                        <input type="button" value="Trước" class="previousPage stagebtn2a" onclick="stage2to1()">
                        <input type="button" value="Sau" class="nextPage stagebtn2b" onclick="stage2to3()">
                    </div>
                </div>
                <div class="stage3-content">
                    <div class="tc-container">
                        <label for="tc">
                            <input type="checkbox" name="tc" id="tc" required>
                            Bằng việc đăng kí, bạn đã đồng ý với BuyTogether về <a href="#">Điều khoản dịch vụ</a>
                        </label>
                    </div>
                    <div class="pagination-btns">
                        <input type="button" value="Trước" class="previousPage stagebtn3a" onclick="stage3to2()">
                        <input type="submit" name='submit' value="Đăng Ký" class="nextPage submit">
                    </div>
                </div>
            </div>
            <?php
            if (isset($insert_user)) {
                if ($insert_user = 0) {
            ?>
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>Người dùng đã tồn tại!</strong> Vui lòng chuyển sang trang đăng nhập
                    </div>
                <?php
                } else if ($insert_user = 1) {
                ?>
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>Mật khẩu và xác nhận mật khẩu không trùng khớp!</strong> Vui lòng nhập lại
                    </div>
            <?php
                }
            }
            ?>
        </form>
    </div>
</body>
<script>
    let signupContent = document.querySelector(".signup-form-container"),
        stagebtn1b = document.querySelector(".stagebtn1b"),
        stagebtn2a = document.querySelector(".stagebtn2a"),
        stagebtn2b = document.querySelector(".stagebtn2b"),
        stagebtn3a = document.querySelector(".stagebtn3a"),
        stagebtn3b = document.querySelector(".stagebtn3b"),
        signupContent1 = document.querySelector(".stage1-content"),
        signupContent2 = document.querySelector(".stage2-content"),
        signupContent3 = document.querySelector(".stage3-content");

    signupContent2.style.display = "none"
    signupContent3.style.display = "none"

    function stage1to2() {
        signupContent1.style.display = "none"
        signupContent2.style.display = "block"
        signupContent3.style.display = "none"
        document.querySelector(".stageno-1").innerText = "✓"
        document.querySelector(".stageno-1").style.backgroundColor = "#52ec61"
        document.querySelector(".stageno-1").style.color = "#fff"
    }

    function stage2to1() {
        signupContent1.style.display = "block"
        signupContent2.style.display = "none"
        signupContent3.style.display = "none"
    }

    function stage2to3() {
        signupContent1.style.display = "none"
        signupContent2.style.display = "none"
        signupContent3.style.display = "block"
        document.querySelector(".stageno-2").innerText = "✓"
        document.querySelector(".stageno-2").style.backgroundColor = "#52ec61"
        document.querySelector(".stageno-2").style.color = "#fff"
    }

    function stage3to2() {
        signupContent1.style.display = "none"
        signupContent2.style.display = "block"
        signupContent3.style.display = "none"
    }
</script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</html>