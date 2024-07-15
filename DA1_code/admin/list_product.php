<?php
include "class/product_class.php";
include "helpers/format.php";
include "header.php";

$product = new product;
$fm = new Format;

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

$show_product = $product -> show_product($user_id);
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
            <div class="admin-content-right-category-list">
                <h1>Danh sách sản phẩm</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>ID</th>
                        <th>Loại SP</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá gốc</th>
                        <th>Khuyến mãi</th>
                        <th>Ưu tiên</th>
                        <th>Mô tả sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                    <?php
                    if($show_product){
                        $i = 0;
                        while($result = $show_product -> fetch_assoc()){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['product_id'] ?></td>
                        <td><?php echo $result['brand_name'] ?></td>
                        <td><?php echo $result['product_name'] ?></td>
                        <td><?php echo $fm -> format_currency($result['product_price']) ?></td>
                        <td><?php echo $fm -> format_currency($result['product_sale_price']) ?></td>
                        <td>
                            <?php 
                                if($result['product_priority']){
                                    echo "Có";
                                }else{
                                    echo "Không";
                                }
                            ?>
                         </td>
                        <td><?php echo $fm -> textShorten($result['product_description'], 20) ?></td>
                        <td> <img style="width: 100px;" src="uploads/product/<?php echo $result['product_main_image'] ?>"> </td>
                        
                        <td><a class="normal_link" href="edit_product.php?product_id=<?php echo $result['product_id'] ?>">Sửa</a> | 
                        <a class="normal_link" href="delete_product.php?product_id=<?php echo $result['product_id'] ?>">Xoá</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
                <div class="button_container">
                        <a href="add_product.php?user_id=<?php echo $user_id?>" class="button">Thêm sản phẩm</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>