<?php
include_once "admin/class/user_class.php";

if (!isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}
$user = new user;

$get_user = $user->get_user($user_id);

$result = $get_user->fetch_assoc();
$user_name = $result['user_name'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $change_password = $user->change_password($user_id);
}
?>

<!--nav bar-->
<?php
include "admin/class/brand_class.php";

$brand = new brand;
$user = new user;

$show_category = $brand->show_category();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Buy Together </title>
    <link rel="stylesheet" href="css/homepage.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="css/user.css">
    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/4eeba4c535.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <span><a href="homepage.php?user_id=<?php echo $user_id ?>" class="BuyTogether"> Buy Together</a></span>
    </header>
    <main>
        <nav>
            <div class="con3">
                <ul>
                    <li> <a href=""> <img class="logosan" src="images/logo sàn .png" alt="" width="80px"></a></li>
                    <li> <a href=""> <i class="fa-solid fa-bell"></i> Thông Báo </a></li>

                    <li> <input type="text" placeholder="Bạn muốn mua gì?" name="Search" id="Search"> <i class="fa-solid fa-magnifying-glass"></i> </li>
                    <li> <a href=""> Khuyến Mãi </a></li>
                    <li> <button> <i class="fa-solid fa-chevron-down"></i> Loại Sản Phẩm </button>
                        <div class="content" style=" flex-direction:column; flex-wrap:wrap; height: 55vh;">
                            <?php
                            while ($result1 = $show_category->fetch_assoc()) {
                            ?>
                                <a style="font-size: 1rem; margin-bottom: -6px;">
                                    <?php echo $result1['category_name'] ?>
                                </a>
                                <?php
                                $show_brand = $brand->show_brand_by_category($result1['category_id']);
                                while ($result2 = $show_brand->fetch_assoc()) {
                                ?>
                                    <a href="homepage_brand_sort.php?brand_id=<?php echo $result2['brand_id'] ?>&user_id=<?php echo $user_id ?>" style="line-height: 0.5rem; margin-left: 12px;">
                                        <?php echo $result2['brand_name'] ?>
                                    </a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <li> <a href="cart.php?user_id=<?php echo $user_id ?>"> <button> <i class="fa-solid fa-cart-shopping"></i> Giỏ Hàng </button></a>
                    </li>
                    <li> <a href="history.php?user_id=<?php echo $user_id ?>"> <i class="fa-solid fa-file-invoice"></i> Lịch Sử Đơn Hàng </a></li>
                    <li> <a href=""> <i class="fa-solid fa-question"></i> Hỗ Trợ </a></li>
                    <li> <button> <i class="fa-solid fa-user"></i> <?php echo $user_name ?></button>
                        <div class="content">
                            <a href="user_buyer.php?user_id=<?php echo $user_id ?>"> Thông tin người dùng </a>
                            <a href=""> Cài Đặt </a>
                            <a href="login.php"> Đăng xuất </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </main>
</body>


<!--Start page-->

<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1 style="font-family: 'Dancing Script', cursive;">Đổi mật khẩu</h1>
        </div>
        <!-- Navbar -->
        <ul>
            <li>
                <a href="#message">
                    <span class="icon-count">29</span>
                    <i class="fa fa-envelope fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="login.php">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
        <!-- End -->
    </div>
    <!-- End -->
    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <img src="https://th.bing.com/th/id/OIP.ZT-Tw8tYy38htqch69vsGQAAAA?rs=1&pid=ImgDetMain" alt="" width="100" height="100">

            <div class="name">
                <?php echo $result['user_name'] ?>
            </div>
            <div class="job">
                <?php if ($result['user_type'] == 0) {
                    echo "Người bán";
                } else if ($result['user_type'] == 1) {
                    echo "Người mua";
                } else {
                    echo "Admin";
                } ?>
            </div>
        </div>
        <div class="sidenav-url">
            <div class="url">
                <a href="user_buyer.php?user_id=<?php echo $user_id ?>">Cá nhân</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="change_password.php?user_id=<?php echo $user_id ?>" class="active">Bảo mật</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="#settings">Cài đặt</a>
                <hr align="center">
            </div>
        </div>
    </div>
    <!-- End -->
    <form action="" method="POST">
        <!-- Main -->
        <div class="main">
            <h2>Thay đổi mật khẩu</h2>
            <div class="card">
                <div class="card-body">
                    <table>
                        <tbody>
                            <tr>
                                <td>Nhập email</td>
                                <td>:</td>
                                <td><input class="text_input" type="email" name="user_email" placeholder="Nhập email" required></td>
                            </tr>
                            <tr>
                                <td>Nhập mật khẩu cũ</td>
                                <td>:</td>
                                <td><input class="text_input" type="password" name="old_password" placeholder="Nhập mật khẩu" required></td>
                            </tr>
                            <tr>
                                <td>Nhập mật khẩu mới</td>
                                <td>:</td>
                                <td><input class="text_input" type="password" name="new_password" placeholder="Tạo mật khẩu mới" required></td>
                            </tr>
                            <tr>
                                <td>Xác nhận mật khẩu mới</td>
                                <td>:</td>
                                <td><input class="text_input" type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="button_container">
                <button type="submit" class="button">
                    Cập nhật
                </button>
            </div>
    </form>
    <?php
    if (isset($change_password)) {
        if ($change_password == 0) {
    ?>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Sai email hoặc mật khẩu!</strong> Vui lòng nhập lại
            </div>
        <?php
        } elseif ($change_password == 1) {
        ?>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Mật khẩu và xác nhận mật khẩu không trùng khớp</strong> Vui lòng nhập lại
            </div>
        <?php
        } elseif ($change_password == 2) {
        ?>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Mật khẩu mới trùng với mật khẩu cũ</strong> Vui lòng nhập lại
            </div>
    <?php
        }
    }
    ?>
    </div>
    <!-- End -->
</body>