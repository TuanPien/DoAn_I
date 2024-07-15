<?php
include "class/order_class.php";
include "header.php";
include_once "class/product_class.php";
?>

<?php
    $order = new order;

    if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
        echo "<script>window.location = '../login.php'</script>";
    }else{
        $user_id = $_GET['user_id'];
    }

    if(!isset($_GET['order_id']) || $_GET['order_id'] == NULL){
        echo "<script>window.location = 'list_order.php?user_id=$user_id'</script>";
    }else{
        $order_id = $_GET['order_id'];
    }
    
    $get_order = $order -> get_order($order_id);
    $result = $get_order -> fetch_assoc();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $update_order = $order -> update_order($order_id, $user_id);
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
                    <h1 style="margin-top: 20px;">Cập nhật trạng thái đơn hàng #<?php echo $order_id?></h1>
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="order_condition">Chọn trạng thái đơn hàng</label>
                            <select name="order_condition">
                                <option value="0" <?php if($result['order_condition'] == 0){ echo "selected";} ?>>Chưa cọc</option>
                                <option value="1" <?php if($result['order_condition'] == 1){ echo "selected";} ?>>Đã cọc</option>
                                <option value="2" <?php if($result['order_condition'] == 2){ echo "selected";} ?>>Đã trả tiền</option>
                            </select>
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