<?php
include "class/product_class.php";
include "helpers/format.php";
include "header.php";
include "sidebar.php";

$product = new product;
$fm = new Format;

$show_product = $product -> show_all_product();
?>


        <div class="admin-content-right">
                <div class="admin-content-right-category-list">
                <h1>Danh sách sản phẩm</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>ID</th>
                        <th>Loại SP</th>
                        <th>Email người bán</th>
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
                        <td><?php echo $result['user_email'] ?></td>
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
                        
                        <td><a class="normal_link" href="admin_delete_product.php?product_id=<?php echo $result['product_id'] ?>">Xoá</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>