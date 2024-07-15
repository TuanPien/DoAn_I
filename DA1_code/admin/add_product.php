<?php
include "class/product_class.php";
include "header.php";
?>

<?php
    $product = new product;

    if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
        echo "<script>window.location = '../login.php'</script>";
    }else{
        $user_id = $_GET['user_id'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $insert_product = $product -> insert_product($user_id, $_POST, $_FILES);
        $create_discount = $product -> create_discount_new_product($user_id);
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
                <form action="" method="post" enctype="multipart/form-data">
                    <h1 style="margin-top: 20px;">Thêm Sản Phẩm</h1>
                    <div class="button_container">
                        <div class="text_fields brand_selection">
                            <label for="brand_id">Chọn loại sản phẩm</label>
                            <select required name="brand_id">
                                <?php
                                    $show_brand = $product -> show_brand();
                                    if($show_brand){
                                        while($temp_result_show_brand = $show_brand -> fetch_assoc()){                                            
                                ?>
                                <option value="<?php echo $temp_result_show_brand['brand_id'] ?>">
                                    <?php echo $temp_result_show_brand['brand_name']?>
                                </option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="text_fields">
                            <label for="product_name">Nhập tên sản phẩm</label>
                            <input required type="text" name="product_name" id="product_name" placeholder="Tên sản phẩm">
                        </div>
                    </div>
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="product_price">Nhập giá sản phẩm</label>
                            <input required type="text" name="product_price" id="" placeholder="Giá sản phẩm">
                        </div>
                        <div class="text_fields">
                            <label for="product_sale_price">Nhập giá khuyến mãi</label>
                            <input required type="text" name="product_sale_price" id="" placeholder="Giá khuyến mãi">
                        </div>
                    </div>
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="product_description">Nhập mô tả sản phẩm</label>
                            <textarea required name="product_description" placeholder="Mô tả sản phẩm"></textarea>
                        </div>
                    </div>
                    <div class="button_container input_file_container">
                        <div class="text_fields img_fields">
                            <label for="main_img">Chọn ảnh mô tả</label>
                            <input required type="file" name="main_img" id="main_img">
                        </div>
                        <div class="text_fields">
                            <label for="product_prior">Chọn mức độ ưu tiên</label>
                            <select required name="product_prior" id="product_prior">
                                <option value="0">Không ưu tiên</option>
                                <option value="1">Ưu tiên</option>
                            </select>
                        </div>
                        <!-- <div class="text_fields img_fields">
                            <label for="sub_img">Chọn ảnh mô tả phụ</label>
                            <input multiple type="file" name="sub_img[]" id="sub_img">
                        </div> -->
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