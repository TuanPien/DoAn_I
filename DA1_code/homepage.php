<?php
include_once "navbar.php";
include_once "admin/class/brand_class.php";
include_once "admin/class/product_class.php";
include_once "admin/class/slider_class.php";
include_once "admin/helpers/format.php";

if (!isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}


$brand = new brand;
$product = new product;
$slider = new slider;
$fm = new format;

$show_slider = $slider->show_slider();
$show_category = $brand->show_category();
$show_product = $product->show_all_product_homepage();
$show_product_hot = $product->show_product_hot();

?>


<section class="slider">
    <div class="container">
        <div class="slider-content">
            <div class="slider-content-left">
                <div class="slider-content-left-top-container">
                    <div class="slider-content-left-top">
                        <?php
                        while ($slider_result = $show_slider->fetch_assoc()) {
                        ?>
                            <a> <img src="admin/uploads/slider/<?php echo $slider_result['slider_img'] ?>"></a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="slider-content-left-top-btn">
                        <i class="fa-solid fa-chevron-left"></i>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
                <div class="slider-content-left-bottom">
                    <?php
                    $show_slider = $slider->show_slider();
                    $i = 0;
                    while ($slider_result = $show_slider->fetch_assoc()) {
                    ?>
                        <li class="<?php if ($i == 0) {
                                        echo "active";
                                    } ?>"> <?php echo $slider_result['slider_title'] ?> </li>
                    <?php
                        $i++;
                    }
                    ?>
                </div>
            </div>
            <div class="slider-content-right">
                <li><a href=""><img src="images/slide7.jpeg" alt=""></a></li>
                <li><a href=""><img src="images/slide8.png" alt=""></a></li>
                <li><a href=""><img src="images/slide9.jpeg" alt=""></a></li>
                <li><a href=""><img src="images/slide10.jpeg" alt=""></a></li>
            </div>
        </div>
    </div>
</section>


<section class="banner-one">
    <div class="container">
        <img src="images/banner.webp" alt="">
    </div>
</section>
<!--slider-product-->
<section class="slider-product-one">
    <div class="container">
        <div class="slider-product-one-content">
            <div class="slider-product-one-content-title">
                <h2>Sản phẩm HOT</h2>
            </div>
            <div class="slider-product-one-content-container">
                <div class="slider-product-one-content-items-content">
                    <div class="slider-product-one-content-items">
                        <?php
                        if ($show_product_hot) {
                            while ($temp1 = $show_product_hot->fetch_assoc()) {
                        ?>
                                <a href="product.php?product_id=<?php echo $temp1['product_id'] ?>&user_id=<?php echo $user_id ?>">
                                    <div class="slider-product-one-content-item">
                                        <img src="admin/uploads/product/<?php echo $temp1['product_main_image'] ?>">
                                        <div class="slider-product-one-content-item-text">
                                            <?php
                                            if ($temp1['product_priority'] == 1) {
                                            ?>
                                                <li>HOT</li>
                                            <?php
                                            }
                                            ?>
                                            <li>
                                                <a href="" style="font-size: 1.2rem; font-weight: 600;">
                                                    <?php echo $temp1['product_name'] ?>
                                                </a>
                                            </li>
                                            <li style="font-size: 0.9rem;"><?php echo $temp1['user_email'] ?></li>
                                            <li><s><?php echo $fm -> format_currency($temp1['product_price']) ?></s><sup>đ</sup></li>
                                            <li><?php echo $fm -> format_currency($temp1['product_sale_price']) ?><sup>đ</sup></li>
                                            <li>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </li>
                                        </div>
                                    </div>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
<br>
<!------------------Product------------->
<secction class="cartegory">
    <div class="container">
        <div class="cartegory-top row">
            <p>Trang chủ</p> <span>&#8594;</span>
            <p>Danh mục sản phẩm</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="cartegory-left">
                <ul>
                    <?php
                    while ($result1 = $show_category->fetch_assoc()) {
                    ?>
                        <li style="font-size: 1.1rem;" class="cartegory-left-li"><?php echo $result1['category_name'] ?>
                            <?php
                            $show_brand = $brand->show_brand_by_category($result1['category_id']);
                            while ($result2 = $show_brand->fetch_assoc()) {
                            ?>
                                <ul>
                                    <a href="homepage_brand_sort.php?brand_id=<?php echo $result2['brand_id'] ?>&user_id=<?php echo $user_id ?>" style="line-height: 2rem; margin: 0 0 0 12px; display: flex; flex-direction: column" class="show_link">
                                        <?php echo $result2['brand_name'] ?>
                                    </a>
                                </ul>
                            <?php
                            }
                            ?>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="cartegory-right row">
                <div class="cartegory-right-top-item">
                    <p style="font-size: 1.5rem;">Top Sản Phẩm</p>
                </div>
                <div class="cartegory-right-top-item">
                    <button><span>Bo loc</span><i class="fa-solid fa-caret-down"></i></button>
                </div>
                <div class="cartegory-right-top-item">
                    <select name="" id="">
                        <option value="">Sap xep</option>
                        <option value="">Gia cao den thap</option>
                        <option value="">Gia thap den cao</option>
                    </select>
                </div>
                <div class="cartegory-right-content row">
                    <?php
                    while ($result = $show_product->fetch_assoc()) {
                    ?>
                        <a href="product.php?product_id=<?php echo $result['product_id'] ?>&user_id=<?php echo $user_id ?>">
                            <div class="cartegory-right-content-item">
                                <img src="admin/uploads/product/<?php echo $result['product_main_image'] ?>">
                                <div class="cartegory-right-content-item-text">
                                    <?php
                                    if ($result['product_priority'] == 1) {
                                    ?>
                                        <li>HOT</li>
                                    <?php
                                    }
                                    ?>
                                    <li>
                                        <a style="font-size: 1.2rem; font-weight: 600;">
                                            <?php echo $result['product_name'] ?>
                                        </a>
                                    </li>
                                    <li style="font-size: 0.9rem;"><?php echo $result['user_email'] ?></li>
                                    <li><s><?php echo $fm -> format_currency($result['product_price']) ?></s><sup>đ</sup></li>
                                    <li><?php echo $fm -> format_currency($result['product_sale_price']) ?><sup>đ</sup></li>
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                </div>
                <div class="cartegory-right-bottom row">
                    <div class="cartegory-right-bottom-items">
                        <p>Hien thi 2 <span> | </span> 4 san pham</p>
                    </div>
                    <div class="cartegory-right-bottom-items">
                        <p><span>&#60;</span>1 2 3 4 5<span>&#62;</span> Trang cuoi </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</secction>
<script src="javascript/homepage.js"> </script>
</body>

