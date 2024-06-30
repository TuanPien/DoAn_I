<?php
include "class/brand_class.php";
include "header.php";
include "sidebar.php";


$brand = new brand;
$show_brand = $brand -> show_brand();
?>


        <div class="admin-content-right">
                <div class="admin-content-right-category-list">
                <h1>Danh sách loại sản phẩm</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>ID</th>
                        <th>Danh mục</th>
                        <th>Loại sản phẩm</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                    <?php
                    if($show_brand){
                        $i = 0;
                        while($result = $show_brand -> fetch_assoc()){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['brand_id'] ?></td>
                        <td><?php echo $result['category_name'] ?></td>
                        <td><?php echo $result['brand_name'] ?></td>
                        <td><a href="admin_edit_brand.php?brand_id=<?php echo $result['brand_id'] ?>">Sửa</a> | 
                        <a href="delete_brand.php?brand_id=<?php echo $result['brand_id'] ?>">Xoá</a></td>
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