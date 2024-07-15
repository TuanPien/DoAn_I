<?php
include "class/category_class.php";
include "header.php";
include "sidebar.php";
?>

<?php
$category = new category;

if(!isset($_GET['category_id']) || $_GET['category_id'] == NULL){
    echo "<script>window.location = 'admin_categorylist.php'</script>";
}
else{
    $category_id = $_GET['category_id'];
}
$get_category = $category -> get_category($category_id);
if($get_category){
    $result = $get_category -> fetch_assoc();
}
?>

<?php
$category = new category;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $category_name = $_POST['category_name'];
    $update_cateogry = $category -> update_category($category_name, $category_id);
}
?>


        <div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Cập Nhật Danh Mục</h1>
                <form action="" method="post">
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="category_name">Nhập tên danh mục</label>
                            <input required type="text" name="category_name" id="category_name" 
                                value="<?php echo $result['category_name'] ?>">
                        </div>
                    </div>

                    <button type="submit" class="button">Cập Nhật</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>