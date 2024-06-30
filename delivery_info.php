<?php
include_once "navbar.php";
include_once "admin/class/delivery_class.php";

if(!isset($_GET['order_id']) || $_GET['order_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $order_id = $_GET['order_id'];
}

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

$delivery = new delivery;

$get_delivery = $delivery -> get_delivery($order_id);

?>

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
                // if($get_delivery == false){
                //     echo "Đơn hàng của bạn chưa được duyệt";
                // }else{
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
                    // $count = 0;
                    // while($result = $get_delivery -> fetch_assoc()){
                    //     $count++;
                    ?>
                    <tr>
                        <td>2</td>
                        <td><input class="" type="text" value="Tuan Anh"></td>
                        <td><input class="" type="text" value="0936363636"></td>
                        <td><input class="" type="text" value="123 Ta Quang Buu"></td>
                        <td><a class="normal_link" href="delivery_edit?user_id=<?php echo $user_id?>&order_id=<?php echo $reslut['order_id']?>">Sửa</a></td>
                    </tr>
                    <?php
                    // }
                    ?>
                </table>
                <?php
                // }
                ?>
            </div>
            <div class="cart-content-right">
                <table>
                    <tr>
                        <th colspan="2">Thống kê</th>
                    </tr>
                    <tr>
                        <td>Số đơn hàng đã duyệt</td>
                        <td>2</td>
                    </tr>
                </table>
                <div class="cart-content-right-text">
                </div>
                <div class="cart-content-right-button">
                    <a class="button" href="homepage.php?user_id=<?php echo $user_id?>">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </div>
</section>
</body>



        <script src="javascript/homepage.js"> </script>