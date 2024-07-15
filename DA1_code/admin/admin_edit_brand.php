<?php
include "class/brand_class.php";
include "header.php";
include "sidebar.php";


$brand = new brand;

if(!isset($_GET['brand_id']) || $_GET['brand_id'] == NULL){
    echo "<script>window.location = 'admin_brandlist.php'</script>";
}
else{
    $brand_id = $_GET['brand_id'];
}

$get_brand = $brand -> get_brand($brand_id);
if($get_brand){
    $result = $get_brand -> fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $category_id = $_POST['category_id'];
    $brand_name = $_POST['brand_name'];
    $update_brand = $brand -> update_brand($brand_name, $brand_id, $category_id);
}
?>


        <div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Cập Nhật Loại Sản Phẩm</h1>
                <form action="" method="post">
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="category_id">Chọn danh mục</label>
                            <select required name="category_id" id="">
                                <?php
                                    $show_category = $brand -> show_category();
                                    if($show_category){
                                        while($temp_result = $show_category -> fetch_assoc()){      
                                ?>
                                    <option <?php if($result['category_id'] == $temp_result['category_id']){ echo "selected";} ?> 
                                    value="<?php echo $temp_result['category_id'] ?>">
                                        <?php echo $temp_result['category_name'] ?>
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
                            <input required type="text" name="brand_name" id="brand_name" value="<?php echo $result['brand_name']?>">
                        </div>
                    </div>
                    <button type="submit" class="button">Cập Nhật</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>