<?php
include "class/slider_class.php";
include "header.php";
include "sidebar.php";
?>


        <div class="admin-content-right">
            <?php
                $slider = new slider;
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $insert_slider = $slider -> insert_slider($_POST, $_FILES);
                }
            ?>
            <div class="admin-content-right-product-add">
                <form action="" method="post" enctype="multipart/form-data">
                    <h1 style="margin-top: 20px;">Thêm quảng cáo</h1>
                    <div class="button_container">
                        <div class="text_fields">
                            <label for="slider_title">Nhập tiêu đề quảng cáo</label>
                            <input required type="text" name="slider_title" value="HOT">
                        </div>
                    </div>
                    <div class="button_container input_file_container">
                        <div class="text_fields img_fields">
                            <label for="slider_img">Chọn ảnh mô tả</label>
                            <input required type="file" name="slider_img" id="slider_img">
                        </div>
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