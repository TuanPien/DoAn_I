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

$get_order = $order -> get_buyer_history($user_id);
$sum = $order -> sum_history($user_id) -> fetch_assoc();

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
                if($get_order == false){
                    echo "Bạn chưa hoàn thành giao dịch nào";
                }else{
                ?>
                </span>
                <table>
                    <tr>
                        <th>Id đơn hàng</th>
                        <th>Id chiến dịch</th>
                        <th>Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng mua</th>
                        <th>Tổng giá trị hoá đơn</th>
                        <th>Thông tin vận chuyển</th>
                        <th>Trạng thái</th>
                    </tr>
                    <?php
                    while($temp = $get_order -> fetch_assoc()){
                        $campaign_id = $temp['campaign_id'];
                        // Lấy product_id theo campaign_id
                        $get_campaign = $campaign->get_campaign($campaign_id)->fetch_assoc();
                        $product_id = $get_campaign['product_id'];
                        //Lấy thông tin sản phẩm
                        $get_product = $product->show_product_by_id($product_id)->fetch_assoc();
                    ?>
                    <tr>
                        <td>#<?php echo $temp['order_id']?></td>
                        <td>#<?php echo $campaign_id?></td>
                        <td><img src="admin/uploads/<?php echo $get_product['product_main_image']?>"></td>
                        <td><?php echo $get_product['product_name']?></td>
                        <td><?php echo $temp['quantity']?></td>
                        <td><?php echo $temp['price_discount']?><sup>đ</sup></td>
                        <td><a href="delivery_info.php?user_id=<?php echo $user_id?>&order_id=<?php echo $temp['order_id']?>" class="normal_link">Chi tiết</a></td>
                        <td>
                            <?php 
                            switch($temp['order_condition']){
                                case "0": echo "Chưa cọc"; break;
                                case "1": echo "Đã cọc"; break;
                                case "2": echo "Chờ vận chuyển"; break;
                                case "3": echo "Đã nhận"; break;
                            }
                            ?>
                        </td>
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
                        <th colspan="2">Thống kê giỏ hàng</th>
                    </tr>
                    <tr>
                        <td>Số giao dịch</td>
                        <td><?php echo $sum['total']?></td>
                    </tr>
                    <tr class="hr">
                        <td>Tổng tiền đã chi</td>
                        <td><?php echo $sum['total_price']?><sup>đ</sup></td>
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