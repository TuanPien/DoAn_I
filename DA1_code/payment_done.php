<?php
include_once "navbar.php";

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}
?>


<section class="cart">
    <div class="container">
        <div class="cart-top-wrap">
            <div class="cart-top">
                <div style="border: 1px solid #ddd;" class="cart-top-cart cart-top-item ">
                    <i style="color: #ddd; " class="fa-solid fa-cart-shopping "></i>
                </div>
                <div class="cart-top-address cart-top-item">
                    <i class="fa-solid fa-location-dot "></i>
                </div>
                <div style="border: 1px solid rgb(6, 228, 210); " class="cart-top-payment cart-top-item">
                    <i style="color: aqua;" class="fa-solid fa-credit-card "></i>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-left: 5%;" class="container">
        <div class="payment-content row">
            <div style="display: flex; justify-content: center;" class="payment-content-left column">
                <h1 style="align-self: center; color: #ee4e2e;">Thanh toán thành công</h1>
            </div>
            <div class="payment-content-right">
                <div class="payment-content-right-button">
                    <h3>Mã giảm giá đã sử dụng</h3>
                </div>
                <div style="margin-top: 10px;">
                    <img style="width: 100%; cursor: pointer;" src="images/ma-mien-phi-van-chuyen-shopee.jpg">
                </div>
            </div>
        </div>
        <div style="display: flex;" class="payment-content-right-payment">
            <a class="button" style="margin-left: 21%;" href="homepage.php?user_id=<?php echo $user_id?>"> Tiếp tục mua sắm </a>
        </div>
    </div>
</section>

</body>

<script src="javascript/homepage.js"> </script>