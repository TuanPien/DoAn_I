<?php
include "class/brand_class.php";
include "header.php";
include "sidebar.php";

$brand = new brand;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $category_id = $_POST['category_id'];
    $brand_name = $_POST['brand_name'];
    $insert_brand = $brand -> insert_brand($category_id, $brand_name);
}
?>


        <div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm Loại Sản Phẩm</h1>
                <form action="" method="post">
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="category_id">Chọn danh mục</label>
                            <select required name="category_id">
                                <?php
                                    $show_category = $brand -> show_category();
                                    if($show_category){
                                        while($result = $show_category -> fetch_assoc()){      
                                ?>
                                    <option value="<?php echo $result['category_id'] ?>">
                                        <?php echo $result['category_name'] ?>
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
                                <label for="brand_name">Nhập tên loại sản phẩm</label>
                                <input required type="text" name="brand_name" id="brand_name" placeholder="Tên loại sản phẩm">                 
                            </div>
                        </div>
                    <button type="submit" class="button">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>