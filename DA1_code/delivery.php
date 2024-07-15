<?php
include_once "admin/class/delivery_class.php";
include_once "admin/class/user_class.php";
include_once "admin/class/order_class.php";
include_once "admin/class/product_class.php";
include_once "admin/class/campaign_class.php";
include_once "admin/helpers/format.php";

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL || !isset($_GET['order_id']) || $_GET['order_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
    $order_id = $_GET['order_id'];
}

$delivery = new delivery;
$user = new user;
$order = new order;
$product = new product;
$campaign = new campaign;
$fm = new format;

$get_user = $user -> get_user($user_id);
$temp_user = $get_user -> fetch_assoc();

$get_order = $order -> get_order($order_id);
$temp_order = $get_order -> fetch_assoc();
$campaign_id = $temp_order['campaign_id'];

$get_campaign = $campaign -> get_campaign($campaign_id);
$temp_campaign = $get_campaign -> fetch_assoc();
$product_id = $temp_campaign['product_id'];
$discount_value = $temp_campaign['discount_value'];

$get_product = $product -> get_product($product_id);
$temp_product = $get_product -> fetch_assoc();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $insert_delivery = $delivery -> insert_delivery($order_id);
    if($insert_delivery != false){
        header('location:payment.php?user_id='.$user_id.'&order_id='.$order_id);
        exit();
    } 
}

?>

<!-- Phần này là cho nav bar -->
<?php
include "admin/class/brand_class.php";

$brand = new brand;

$show_category = $brand -> show_category();
$user_name = $temp_user['user_name'];

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
        <span><a href="homepage.php?user_id=<?php echo $user_id?>" class="BuyTogether"> Buy Together</a></span>
    </header>
    <main>
        <nav>
            <div class="con3">
                <ul>
                    <li> <a href=""> <img class="logosan" src="images/logo sàn .png" alt="" width="80px"></a></li>
                    <li> <a href=""> <i class="fa-solid fa-bell"></i> Thông Báo </a></li>

                    <li> <input type="text" placeholder="Bạn muốn mua gì?" name="Search" id="Search"> <i
                            class="fa-solid fa-magnifying-glass"></i> </li>
                    <li> <a href=""> Khuyến Mãi </a></li>
                    <li> <button> <i class="fa-solid fa-chevron-down"></i> Loại Sản Phẩm </button>
                        <div class="content" style=" flex-direction:column; flex-wrap:wrap; height: 55vh;">
                            <?php
                            while($result1 = $show_category->fetch_assoc()){
                            ?>
                            <a href="" style="font-size: 1rem; margin-bottom: -6px;">
                                <?php echo $result1['category_name']?>
                            </a>
                            <?php
                            $show_brand = $brand -> show_brand_by_category($result1['category_id']);
                                while($result2 = $show_brand -> fetch_assoc()){
                            ?>
                                <a href="" style="line-height: 0.5rem; margin-left: 12px;">
                                    <?php echo $result2['brand_name']?>
                                </a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <li> <a href="cart.php?user_id=<?php echo $user_id?>"> <button> <i class="fa-solid fa-cart-shopping"></i> Giỏ Hàng </button></a>
                    </li>
                    <li> <a href="history.php?user_id=<?php echo $user_id?>"> <i class="fa-solid fa-file-invoice"></i> Lịch Sử Đơn Hàng </a></li>
                    <li> <a href=""> <i class="fa-solid fa-question"></i> Hỗ Trợ </a></li>
                    <li> <button>  <i class="fa-solid fa-user"></i> <?php echo $user_name?>  </button>
                        <div class="content">
                            <a href=""> Thông tin người dùng </a>
                            <a href=""> Cài Đặt </a>
                            <a href="change_password.php?user_id=<?php echo $user_id?>">Đổi mật khẩu</a>
                            <a href="login.php"> Đăng xuất </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
<!-- Hết nav bar -->

<?php
if(isset($insert_delivery) && $insert_delivery == false){
    ?>
        <div class="alert" style="margin-top: 0.5%;">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Thông tin vận chuyển đã tồn tại!</strong> Vui lòng chờ đơn hàng được xác nhận
        </div>
    <?php
}
?>

<section class="delivery">
    <div class="container">
        <div class="delivery-top-wrap">
             <div class="delivery-top">
                    <div class="delivery-top-cart delivery-top-item ">
                        <i class="fa-solid fa-cart-shopping "></i>
                    </div>
                    <div class="delivery-top-address delivery-top-item">
                         <i class="fa-solid fa-location-dot "></i>
                     </div>
                    <div class="delivery-top-payment delivery-top-item">
                        <i class="fa-solid fa-credit-card "></i>
                    </div>
            </div>
        </div>
     </div>
<div class="container">
    <form action="" method="POST">
        <div class="delivery-content row">
            <div class="delivery-content-left">
                <div class="delivery-content-left-input-top row">
                        <div class="delivery-content-left-input-top-item">
                            <label for="user_name">Họ tên người nhận<span style="color: red;">*</span> </label>
                            <input type="text" name="user_name" value="<?php echo $temp_user['user_name']?>">
                        </div>
                        <div class="delivery-content-left-input-top-item">
                            <label for="">Điện thoại người nhận<span style="color: red;">*</span> </label>
                            <input type="text" name="user_phone" value="<?php echo $temp_user['user_phone']?>">
                        </div>
                    </div>

                    <div class="delivery-content-left-input-bottom">
                        <label for="">Địa chỉ nhận hàng<span style="color: red;">*</span> </label>
                        <input type="text" name="user_address" value="<?php echo $temp_user['user_address']?>">
                    </div>
                    
            <div class="delivery-content-left-button row">
                <a href="cart.php?user_id=<?php echo $user_id?>"> &#60; Quay lại giỏ hàng</a>
                <button class="button" type="submit">Thanh toán </button>
            </div>
        </div>
    </form>
    <div class="delivery-content-right">
        <table>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Chiết khấu</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            <tr>
                <td><?php echo $temp_product['product_name']?> #<?php echo $temp_product['product_id']?></td>
                <td><?php echo $discount_value?>%</td>
                <td><?php echo $temp_order['quantity']?></td>
                <td><?php echo $fm -> format_currency($temp_order['price_discount'])?><sup>đ</sup></td>
            </tr>
            <tr>
                <td colspan="3" style="font-weight: bold; color: red;">Tiền cọc</td>
                <td style="font-weight: bold; color: red;"><p><?php echo $fm -> format_currency($temp_order['down_payment'])?><sup>đ</sup></p></td>
            </tr>
            <tr>
                <td colspan="3" style="font-weight: bold;">Thanh toán còn lại</td>
                <td style="font-weight: bold;"><p><?php echo $fm -> format_currency($temp_order['price_discount']-$temp_order['down_payment']) ?><sup>đ</sup></p></td>
            </tr>
        </table>
    </div>
</div>
</div>
</div>     
</section>
</body>



        <script src="javascript/homepage.js"> </script>