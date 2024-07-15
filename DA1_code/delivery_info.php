<?php
include_once "admin/class/delivery_class.php";

if (!isset($_GET['order_id']) || $_GET['order_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $order_id = $_GET['order_id'];
}

if (!isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}

$delivery = new delivery;

$get_delivery = $delivery->get_delivery($order_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update_delivery = $delivery->update_delivery($order_id, $user_id);
}

?>

<!-- Đây là phần của navbar-->
<?php
include "admin/class/brand_class.php";

$brand = new brand;

$show_category = $brand->show_category();

if (!isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}

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

                    <li> <input type="text" placeholder="Bạn muốn mua gì?" name="Search" id="Search"> <i class="fa-solid fa-magnifying-glass"></i> </li>
                    <li> <a href=""> Khuyến Mãi </a></li>
                    <li> <button> <i class="fa-solid fa-chevron-down"></i> Loại Sản Phẩm </button>
                        <div class="content">
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
                    <li> <button> <i class="fa-solid fa-user"></i> User </button>
                        <div class="content">
                            <a href=""> Thông tin người dùng </a>
                            <a href=""> Cài Đặt </a>
                            <a href="login.php"> Đăng xuất </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!--Kết thúc phần của navbar-->

        <section class="cart">
            <div class="container">
                <h1>Lịch sử đơn hàng</h1>
            </div>
            </div>
            <div class="container ">
                <div class="cart-content row">
                    <div class="cart-content-left">
                        <span class="container" style="font-size: 1.2rem; padding-left: 6px;">
                            <?php
                            if ($get_delivery == false) {
                                echo "Đơn hàng của bạn chưa được duyệt";
                            } else {
                            ?>
                        </span>
                        <table>
                            <tr>
                                <th>ID đơn hàng</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ người nhận</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                            <?php
                                $count = 0;
                                while ($result = $get_delivery->fetch_assoc()) {
                                    $count++;
                            ?>
                                <tr>
                                    <form action="" method="POST">
                                        <td><?php echo $result['order_id'] ?></td>
                                        <td><input class="delivery_info_update name" type="text" name="user_name" value="<?php echo $result['user_name'] ?>"></td>
                                        <td><input class="delivery_info_update phone" type="text" name="user_phone" value="<?php echo $result['user_phone'] ?>"></td>
                                        <td><input class="delivery_info_update address" type="text" name="user_address" value="<?php echo $result['user_address'] ?>"></td>
                                        <td><button type="submit" class="button delivery_info_update">Cập nhật</button></td>
                                    </form>
                                </tr>
                            <?php
                                }
                            ?>
                        </table>
                    <?php
                            }
                    ?>
                    </div>
                    <div class="cart-content-right">
                        <table>
                            <tr>
                                <th colspan="2">Tính toán phí vận chuyển</th>
                            </tr>
                            <tr>
                                <td>Phí vận chuyển</td>
                                <td>0<sup>đ</sup></td>
                            </tr>
                        </table>
                        <div class="cart-content-right-text">
                        </div>
                        <div class="cart-content-right-button">
                            <a class="button" href="homepage.php?user_id=<?php echo $user_id ?>">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</body>



<script src="javascript/homepage.js"> </script>