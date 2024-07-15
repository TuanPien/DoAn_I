<?php
include_once "header.php";
include_once "class/campaign_class.php";
include_once "class/product_class.php";

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

if(!isset($_GET['campaign_id']) || $_GET['campaign_id'] == NULL){
    echo "<script>window.location = 'list_campaign.php'</script>";
}else{
    $campaign_id = $_GET['campaign_id'];
}


$campaign = new campaign;
$product = new product;

$get_campaign = $campaign -> get_campaign($campaign_id) -> fetch_assoc();
$product_id = $get_campaign['product_id'];
$time_start = $get_campaign['time_start'];
$time_end = $get_campaign['time_end'];

$get_product = $product -> show_product_by_id($product_id) -> fetch_assoc();
$product_name = $get_product['product_name'];
$product_id = $get_product['product_id'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $update_campaign = $campaign -> update_campaign($campaign_id, $user_id);
}
?>


<section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li><a href="">Sản phẩm</a>
                    <ul>
                        <li><a href="add_product.php?user_id=<?php echo $user_id?>">Thêm sản phẩm</a></li>
                        <li><a href="list_product.php?user_id=<?php echo $user_id?>">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="">Chiết khấu
                    <ul>
                        <li><a href="add_discount.php?user_id=<?php echo $user_id?>">Thêm thiết lập chiết khấu</a></li>
                        <li><a href="list_discount.php?user_id=<?php echo $user_id?>">Danh sách chiết khấu</a></li>
                    </ul>
                </li>
                <li><a href="">Chiến dịch</a>
                    <ul>
                        <li><a href="add_campaign.php?user_id=<?php echo $user_id?>">Thêm chiến dịch</a></li>
                        <li><a href="list_campaign.php?user_id=<?php echo $user_id?>">Danh sách chiến dịch</a></li>
                    </ul>
                </li>
                <li><a href="">Đơn hàng</a>
                    <ul>
                        <li><a href="list_order.php?user_id=<?php echo $user_id?>">Danh sách đơn hàng</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="admin-content-right">
            <div class="admin-content-right-product-add">
                <form action="" method="post">
                    <h1 style="margin-top: 20px;">Cập nhật thông tin chiến dịch</h1>
                    <h3><?php echo $product_name?>#<?php echo $product_id?></h3>
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="time_start">Nhập thời gian bắt đầu</label>
                            <input type="date" name="time_start" value="<?php echo $time_start?>" 
                            required placeholder="Thời gian kết thúc">
                        </div>
                        <div class="text_fields discount_value">
                            <label for="time_end">Nhập thời gian kết thúc</label>
                            <input type="date" name="time_end" value="<?php echo $time_end?>" 
                            required placeholder="Thời gian kết thúc">
                        </div>
                    </div>
                    <div class="button_container">
                        <button type="submit" class="button">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>