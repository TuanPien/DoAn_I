<?php
include_once "navbar.php";
include_once "admin/class/brand_class.php";
include_once "admin/class/product_class.php";

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

if(!isset($_GET['brand_id']) || $_GET['brand_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $brand_id = $_GET['brand_id'];
}


$brand = new brand;
$product = new product;

$show_category = $brand -> show_category();
$show_product = $product -> show_product_brand_sort($brand_id);
$show_product_hot = $product -> show_product_hot();

?>


        <section class="slider">
            <div class="container">
                <div class="slider-content">
                    <div class="slider-content-left">
                        <div class="slider-content-left-top-container">
                            <div class="slider-content-left-top">
                                <a href=""> <img src="images/slide1.jpeg" alt=""></a>
                                <a href=""> <img src="images/slide2.jpeg" alt=""></a>
                                <a href=""> <img src="images/slide3.jpeg" alt=""></a>
                                <a href=""> <img src="images/slide4.jpeg" alt=""></a>
                                <a href=""> <img src="images/slide5.webp" alt=""></a>
                                <a href=""> <img src="images/slide6.png" alt=""></a>
                            </div>
                            <div class="slider-content-left-top-btn">
                                <i class="fa-solid fa-chevron-left"></i>
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>
                        </div>
                        <div class="slider-content-left-bottom">
                            <li class="active"> Tieu de 1 </li>
                            <li> Tieu de 2 </li>
                            <li> Tieu de 3 </li>
                            <li> Tieu de 4 </li>
                            <li> Tieu de 5 </li>
                            <li> Tieu de 6 </li>
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
                                if($show_product_hot){
                                    while($temp1 = $show_product_hot -> fetch_assoc()){
                                ?>
                                <a href="product.php?product_id=<?php echo $temp1['product_id']?>&user_id=<?php echo $user_id?>">
                                    <div class="slider-product-one-content-item">
                                        <img src="admin/uploads/<?php echo $temp1['product_main_image']?>">
                                        <div class="slider-product-one-content-item-text">
                                        <?php
                                        if($temp1['product_priority'] == 1){
                                        ?>
                                        <li>HOT</li>
                                        <?php
                                        }
                                        ?>
                                        <li>
                                            <a href="" style="font-size: 1.2rem; font-weight: 600;">
                                                <?php echo $temp1['product_name']?>
                                            </a>
                                        </li>
                                        <li style="font-size: 0.9rem;"><?php echo $temp1['user_email']?></li>
                                        <li><s><?php echo $temp1['product_price'] ?></s><sup>đ</sup></li>
                                        <li><?php echo $temp1['product_sale_price'] ?><sup>đ</sup></li>
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
                        while($result1 = $show_category->fetch_assoc()){
                        ?>
                        <li style="font-size: 1.1rem;" class="cartegory-left-li"><?php echo $result1['category_name']?>
                            <?php
                            $show_brand = $brand -> show_brand_by_category($result1['category_id']);
                            while($result2 = $show_brand -> fetch_assoc()){
                            ?>
                            <ul>
                                <a href="homepage_brand_sort.php?brand_id=<?php echo $result2['brand_id']?>&user_id=<?php echo $user_id?>" style="line-height: 2rem; margin: 0 0 0 12px;" class="show_link">
                                    <?php echo $result2['brand_name']?>
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
                    <?php
                    if($show_product == false){
                    ?>
                    <div class="msg">
                        <p>
                            <?php
                                echo "Chưa có sản phẩm nào loại này";
                            ?>
                        </p>
                    </div>
                    <?php
                    }else{
                    ?>
                    <div class="cartegory-right-content row">
                        <?php
                        while($result = $show_product -> fetch_assoc()){
                        ?>
                        <a href="product.php?product_id=<?php echo $result['product_id']?>&user_id=<?php echo $user_id?>">
                            <div class="cartegory-right-content-item">
                                <img src="admin/uploads/<?php echo $result['product_main_image']?>">
                                <div class="cartegory-right-content-item-text">
                                    <?php
                                    if($result['product_priority'] == 1){
                                    ?>
                                    <li>HOT</li>
                                    <?php
                                    }
                                    ?>
                                    <li>
                                        <a style="font-size: 1.2rem; font-weight: 600;">
                                            <?php echo $result['product_name']?>
                                        </a>
                                    </li>
                                    <li style="font-size: 0.9rem;"><?php echo $result['user_email']?></li>
                                    <li><s><?php echo $result['product_price'] ?></s><sup>đ</sup></li>
                                    <li><?php echo $result['product_sale_price'] ?><sup>đ</sup></li>
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
                    <?php
                    }
                    ?>
                    <!-- <div class="cartegory-right-bottom row">
                        <div class="cartegory-right-bottom-items">
                            <p>Hien thi 2 <span> | </span> 4 san pham</p>
                        </div>
                        <div class="cartegory-right-bottom-items">
                            <p><span>&#60;</span>1 2 3 4 5<span>&#62;</span> Trang cuoi </p>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </secction>
    <script src="javascript/homepage.js"> </script>
</body>
<main>

</main>