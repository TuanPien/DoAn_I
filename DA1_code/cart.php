<?php
include_once "navbar.php";
include_once "admin/class/order_class.php";
include_once "admin/class/product_class.php";
include_once "admin/class/campaign_class.php";
include_once "admin/helpers/format.php";

if (!isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}

$order = new order;
$campaign = new campaign;
$product = new product;
$fm = new format;

$get_order = $order->get_order_buyer($user_id);
$count = $order->count($user_id)->fetch_assoc();
$sum_price = $order->sum_buyer_price_discount($user_id)->fetch_assoc();

$sum_down_payment = $order->sum_buyer_down_payment($user_id);
if ($sum_down_payment != false) {
    $sum_down_payment = $sum_down_payment->fetch_assoc();
    $sum_down_payment = $sum_down_payment['total_payment'];
} else {
    $sum_down_payment = 0;
}

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
                    if ($get_order == false) {
                        echo "Bạn không có đơn hàng nào đang trong thời gian giao dịch";
                    } else {
                    ?>
                </span>
                <table>
                    <tr>
                        <th>Id đơn hàng</th>
                        <th>Id chiến dịch</th>
                        <th>Sản phẩm</th>
                        <th>Chiết khấu</th>
                        <th>Số lượng mua</th>
                        <th>Thành tiền</th>
                        <th>Tiền cọc</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                    <?php
                        if ($get_order && $get_order != false) {
                            while ($temp = $get_order->fetch_assoc()) {
                                $campaign_id = $temp['campaign_id'];
                                // Lấy product_id theo campaign_id
                                $get_campaign = $campaign->get_campaign($campaign_id)->fetch_assoc();
                                $discount_value = $get_campaign['discount_value'];
                                $product_id = $get_campaign['product_id'];
                                //Lấy thông tin sản phẩm
                                $get_product = $product->show_product_by_id($product_id)->fetch_assoc();
                    ?>
                            <tr>
                                <td>#<?php echo $temp['order_id'] ?></td>
                                <td>#<?php echo $campaign_id ?></td>
                                <td><a href="product.php?product_id=<?php echo $product_id ?>&user_id=<?php echo $user_id ?>"><img src="admin/uploads/product/<?php echo $get_product['product_main_image'] ?>"></a></td>
                                <td style="color: #e60000;"><?php echo $discount_value ?>%</td>
                                <td><?php echo $temp['quantity'] ?></td>
                                <td><?php echo $fm->format_currency($temp['price_discount']) ?><sup>đ</sup></td>
                                <td style="color: #e60000;"><?php echo $fm->format_currency($temp['down_payment']) ?><sup>đ</sup></td>
                                <td>
                                    <?php
                                    switch ($temp['order_condition']) {
                                        case "0":
                                            echo "Chưa cọc";
                                            break;
                                        case "1":
                                            echo "Đã cọc";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $time_check = $campaign->time_check($campaign_id);
                                    if (is_bool($time_check) && $time_check == false && $temp['order_condition'] == 0) {
                                        echo "Quá hạn";
                                    } else {
                                        switch ($temp['order_condition']) {
                                            case "0":
                                    ?>
                                                <a class="button" href="delivery.php?order_id=<?php echo $temp['order_id'] ?>&user_id=<?php echo $temp['user_id'] ?>">Thanh toán</a>
                                            <?php
                                                break;
                                            case "1":
                                            ?>
                                                <a class="button" href="payment.php?order_id=<?php echo $temp['order_id'] ?>&user_id=<?php echo $temp['user_id'] ?>">Thanh toán</a>
                                    <?php
                                                break;
                                        }
                                    }
                                    ?>
                                </td>
                                <td><a class="show_link normal_link" href="delete_order.php?order_id=<?php echo $temp['order_id'] ?>&user_id=<?php echo $user_id ?>">Xoá</a></td>
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
                        <td><?php echo $count['total'] ?></td>
                    </tr>
                    <tr>
                        <td>Tổng tiền đơn hàng</td>
                        <td><?php echo $fm->format_currency($sum_price['total_price']) ?><sup>đ</sup></td>
                    </tr>
                    <tr>
                        <td>Tổng tiền cọc còn thiếu</td>
                        <td style="color: red; font-weight: 600;"><?php echo $fm->format_currency($sum_down_payment) ?><sup>đ</sup></td>
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
    <p class="caution">*Nếu huỷ đơn hàng khi đã cọc sẽ không được hoàn trả tiền cọc<br>*Nếu chiến dịch kết thúc mà chưa đóng tiền cọc, đơn hàng sẽ bị huỷ</p>
</section>
</body>

<script src="javascript/homepage.js"> </script>