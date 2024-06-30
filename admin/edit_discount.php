<?php
include "class/discount_class.php";
include "header.php";
include_once "class/product_class.php";
?>

<?php
    $discount = new discount;
    $product = new product;

    if(!isset($_GET['discount_id']) || $_GET['discount_id'] == NULL){
        echo "<script>window.location = '../login.php'</script>";
    }else{
        $discount_id = $_GET['discount_id'];
    }
    
    $get_discount = $discount -> get_discount($discount_id);
    if($get_discount){
        $result = $get_discount -> fetch_assoc();
        $user_id = $result['user_id'];
    }

    $show_product = $product -> show_product($user_id);
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $update_discount = $discount -> update_discount($discount_id);
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
                    <h1 style="margin-top: 20px;">Thêm thiết lập chiết khấu</h1>
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="product_id">Chọn sản phẩm sử dụng thiết lập chiết khấu</label>
                            <select name="product_id">
                                <?php
                                if($show_product){
                                    while($temp = $show_product -> fetch_assoc()){
                                ?>
                                <option <?php if($result['product_id'] == $temp['product_id']){ echo "selected";} ?>
                                     value="<?php echo $temp['product_id']?>">
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
                            <label for="discount_point">Nhập mức thay đổi chiết khấu</label>
                            <input type="number" name="discount_point" required value="<?php echo $result['discount_point'] ?>">
                        </div>
                        <div class="text_fields discount_value">
                            <label for="discount_value">Nhập phần trăm chiết khấu</label>
                            <input type="number" name="discount_value" step="0.01" min="0" max="100" 
                                value="<?php echo $result['discount_value'] ?>" required>
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