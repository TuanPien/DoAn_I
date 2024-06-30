<?php
include_once "header.php";
include_once "class/campaign_class.php";
include_once "class/product_class.php";

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

$campaign = new campaign;
$product = new product;

$show_product = $product -> show_product($user_id);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $insert_campaign = $campaign -> create_campaign();
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
                    <h1 style="margin-top: 20px;">Thêm chiến dịch</h1>
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="product_id">Chọn sản phẩm thực hiện chiến dịch</label>
                            <select name="product_id">
                                <?php
                                if($show_product){
                                    while($temp = $show_product -> fetch_assoc()){
                                ?>
                                <option value="<?php echo $temp['product_id']?>">
                                    <?php echo $temp['product_name']?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div> 
                    </div>
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="time_start">Nhập thời gian bắt đầu</label>
                            <input type="date" name="time_start" required placeholder="Thời gian kết thúc">
                        </div>
                        <div class="text_fields discount_value">
                            <label for="time_end">Nhập thời gian kết thúc</label>
                            <input type="date" name="time_end" required placeholder="Thời gian kết thúc">
                        </div>
                    </div>
                    <div class="button_container">
                        <button type="submit" class="button">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>