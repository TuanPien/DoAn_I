<?php
include "class/category_class.php";
include "header.php";
include "sidebar.php";

$category = new category;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $category_name = $_POST['category_name'];
    $insert_category = $category -> insert_category($category_name);
}
?>


        <div class="admin-content-right">
            <div class="admin-content-right-category-add">
                <h1>Thêm Danh Mục</h1>
                <form action="" method="post">
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="category_name">Nhập tên danh mục</label>
                            <input required type="text" name="category_name" id="category_name" placeholder="Tên danh mục">   
                        </div>
                    </div>
                    <button type="submit" class="button">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>