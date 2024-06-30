<?php
include_once "navbar.php";
include_once "admin/class/order_class.php";
include_once "admin/class/product_class.php";
include_once "admin/class/campaign_class.php";

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

$order = new order;
$campaign = new campaign;
$product = new product;

$get_order = $order -> get_order_buyer($user_id);
$count = $order -> count($user_id) -> fetch_assoc();
$sum_price = $order -> sum_buyer_price_discount($user_id) -> fetch_assoc();
$sum_down_payment = $order -> sum_buyer_down_payment($user_id) -> fetch_assoc();

?>

<section class="cart">
    <div class="container">
       <div class="cart-top-wrap">
            <div class="cart-top">
             <div class="cart-top-cart cart-top-item ">
                <i class="fa-solid fa-cart-shopping "></i>
            </div>
            <div class="cart-top-address cart-top-item">
                <i class="fa-solid fa-location-dot "></i>
            </div>
            <div class="cart-top-payment cart-top-item">
                <i class="fa-solid fa-credit-card "></i>
            </div>
        </div>
       </div>
    </div>
    <div class="container ">
        <div class="cart-content row">
            <div class="cart-content-left">
                <span class="container" style="font-size: 1.2rem;">
                <?php
                if($get_order == false){
                    echo "Bạn không có đơn hàng nào đang trong thời gian giao dịch";
                }else{
                ?>
                </span>
                <table>
                    <tr>
                        <th>Id đơn hàng</th>
                        <th>Id chiến dịch</th>
                        <th>Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Chiết khấu</th>
                        <th>Số lượng mua</th>
                        <th>Thành tiền</th>
                        <th>Tiền cọc</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                    </tr>
                    <?php
                    if($get_order && $get_order != false){
                        while($temp = $get_order -> fetch_assoc()){
                            $campaign_id = $temp['campaign_id'];
                            // Lấy product_id theo campaign_id
                            $get_campaign = $campaign->get_campaign($campaign_id)->fetch_assoc();
                            $discount_value = $get_campaign['discount_value'];
                            $product_id = $get_campaign['product_id'];
                            //Lấy thông tin sản phẩm
                            $get_product = $product->show_product_by_id($product_id)->fetch_assoc();
                    ?>
                    <tr>
                        <td>#<?php echo $temp['order_id']?></td>
                        <td>#<?php echo $campaign_id?></td>
                        <td><img src="admin/uploads/<?php echo $get_product['product_main_image']?>"></td>
                        <td><?php echo $get_product['product_name']?></td>
                        <td style="color: #e60000;"><?php echo $discount_value?>%</td>
                        <td><?php echo $temp['quantity']?></td>
                        <td><?php echo $temp['price_discount']?><sup>đ</sup></td>
                        <td style="color: #e60000;"><?php echo $temp['down_payment']?><sup>đ</sup></td>
                        <td>
                            <?php 
                            switch($temp['order_condition']){
                                case "0": echo "Chưa cọc"; break;
                                case "1": echo "Đã cọc"; break;
                                case "2": echo "Đã trả tiền"; break;
                                case "3": echo "Đã nhận"; break;
                            }
                            ?>
                        </td>
                        <td><a class="button" href="delivery.php?order_id=<?php echo $temp['order_id']?>&user_id=<?php echo $temp['user_id']?>">Thanh toán</a></td>
                    </tr>
                    <?php
                        }
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
                        <th colspan="2" style="font-size: 1rem;">Thống kê giỏ hàng</th>
                    </tr>
                    <tr>
                        <td>Số đơn hàng</td>
                        <td><?php echo $count['total']?></td>
                    </tr>
                    <tr>
                        <td>Tổng tiền đơn hàng</td>
                        <td><?php echo $sum_price['total_price']?><sup>đ</sup></td>
                    </tr>
                    <tr>
                        <td>Tổng tiền cọc còn thiếu</td>
                        <td style="color: red; font-weight: 600;"><?php echo $sum_down_payment['total_payment']?><sup>đ</sup></td>
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
