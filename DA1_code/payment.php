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
            <div class="payment-content-left column">
                <div class="payment-content-left-method-delivery">
                    <p style="font-weight: bold; font-size: 20px;">Phương thức giao hàng </p>
                    <div style="margin-top: 10px;" class="payment-content-left-method-delivery-item">
                        <input checked type="radio">
                        <label for="">Giao hàng chuyển phát nhanh </label>
                    </div>
                </div>
                <div style="margin-top: 10px;" class="payment-content-left-method-payment">
                    <p style="font-weight: bold; font-size: 20px;">Phương thức thanh toán</p>
                    <p style="margin-top: 10px;">Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng không bao gio được lưu lại.</p>
                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment" type="radio">
                        <label for="">Thanh toán bằng thẻ tín dụng</label>
                    </div>
                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment" type="radio">
                        <label for="">Thanh toán bằng thẻ ATM</label>
                    </div>
                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment" type="radio">
                        <label for="">Thanh toán bằng Momo</label>
                    </div>
                    <div class="payment-content-left-method-payment-item">
                        <input name="method-payment" type="radio">
                        <label for="">Thanh toán khi nhận hàng</label>
                    </div>
                </div>

            </div>
            <div class="payment-content-right">
                <div class="payment-content-right-button">
                    <input type="text" placeholder="Mã Giảm Giá">
                    <button><i class="fas fa-check"></i></button>
                </div>
                <div style="margin-top: 10px;">
                    <img style="width: 100%; cursor: pointer;" src="images/ma-mien-phi-van-chuyen-shopee.jpg">
                </div>
            </div>
        </div>
        <div style="margin-left: 30%;" class="payment-content-right-payment">
            <a class="button" href="payment_done.php?user_id=<?php echo $user_id?>"> Tiếp tục thanh toán </a>
        </div>
    </div>
</section>

</body>

<script src="javascript/homepage.js"> </script>