<?php
include_once "admin/class/brand_class.php";
include_once "admin/class/user_class.php";

$brand = new brand;
$user = new user;

$show_category = $brand->show_category();

if (!isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}

$get_user = $user->get_user($user_id);
$temp = $get_user->fetch_assoc();
$user_name = $temp['user_name'];

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Buy Together </title>
    <link rel="stylesheet" href="css/homepage.css">
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
                    <li>
                        <form action="homepage_search.php?user_id=<?php echo $user_id?>" method="POST">
                            <input type="text" placeholder="Bạn muốn mua gì?" name="search_key" id="Search"> 
                            <button type="submit" class="seatch_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </li>
                    <li> <a href=""> Khuyến Mãi </a></li>
                    <li> <button> <i class="fa-solid fa-chevron-down"></i> Loại Sản Phẩm </button>
                        <div class="content" style=" flex-direction:column; flex-wrap:wrap; height: 55vh;" >
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
                            <a href="change_password.php?user_id=<?php echo $user_id ?>">Đổi mật khẩu</a>
                            <a href="login.php"> Đăng xuất </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>