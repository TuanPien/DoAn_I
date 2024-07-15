<?php
include_once "admin/class/campaign_class.php";
include_once "admin/class/product_class.php";
include_once "admin/class/discount_class.php";
include_once "admin/helpers/format.php";

if (
    !isset($_GET['user_id']) || $_GET['user_id'] == NULL ||
    !isset($_GET['campaign_id']) || $_GET['campaign_id'] == NULL
) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $user_id = $_GET['user_id'];
    $campaign_id = $_GET['campaign_id'];
}

$product = new product;
$campaign = new campaign;
$discount = new discount;
$fm = new format;

$time_check = $campaign->time_check($campaign_id);
if (!is_bool($time_check) || $time_check == false) {
    echo "<script>window.location = 'login.php'</script>";
}

$cal_discount = $campaign->cal_discount($campaign_id);

$get_campaign = $campaign->get_campaign($campaign_id)->fetch_assoc();
$product_id = $get_campaign['product_id'];

$get_seller = $product->show_product_by_id($product_id)->fetch_assoc();
$seller_id = $get_seller['user_id'];

$show_product_by_id = $product->show_product_by_id($product_id);
$show_discount_by_product = $discount->show_discount_by_product($product_id);
$relevant_product = $product -> show_relevant_product($product_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $join_campaign = $campaign->join_campaign($campaign_id, $user_id);
    if (isset($join_campaign) && $join_campaign != false) {
        header('location:cart.php?user_id=' . $user_id);
        exit();
    }
}

include_once "navbar.php";
?>


        <section class="product">
            <div class="container">
                <div class="product-top row">
                    <p>Trang chủ</p> <span>&#8594;</span>
                    <p>Tên loại sản phẩm</p> <span>&#8594;</span>
                    <p>Tên sản phẩm</p>
                </div>
                <?php
                if ($show_product_by_id) {
                    $result = $show_product_by_id->fetch_assoc();
                ?>
                    <div class="product-content row">
                        <div class="product-content-left row">
                            <div class="product-content-left-big-img">
                                <img src="admin/uploads/product/<?php echo $result['product_main_image'] ?>">
                            </div>
                        </div>
                        <div class="product-content-right">
                            <div class="product-content-right-product-name">
                                <h1><?php echo $result['product_name'] ?></h1>
                                <?php
                                if ($result['product_priority'] == 1) {
                                ?>
                                    <h2>HOT!!!</h2>
                                <?php
                                }
                                ?>
                                <p>##<?php echo $result['product_id'] ?></p>
                            </div>
                            <div class="product-content-right-product-star row">
                                <div style="color: orange;" class="product-content-right-product-star-item row">
                                    <p>5.0</p> &nbsp; <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div> &nbsp;
                                <!-- <div class="product-content-right-product-star-item row">
                                <p>62,9k</p> &nbsp; <p>Da Ban</p>          
                            </div>| &nbsp;
                            <div class="product-content-right-product-star-item row">
                                <i class="fa-solid fa-clock"></i>&nbsp;<p>Thoi Gian Con Lai</p>
                            </div> -->
                            </div>
                            <?php
                            if (isset($join_campaign) && $join_campaign == false) {
                            ?>
                                <div class="alert" style="margin: 2% 0;">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Bạn đã tham gia chiến dịch này</strong> Vui lòng chờ chiến dịch tiếp theo
                                </div>
                            <?php
                            }
                            ?>
                            <div class="product-content-right-product-price">
                                <li><?php echo $fm -> format_currency($result['product_price']) ?><sup>đ</sup></li>
                                <li><?php echo $fm -> format_currency($result['product_sale_price']) ?><sup>đ</sup></li>
                            </div>
                            <div class="product-content-right-product-discount row">
                                <p style="padding: 6px 12px">Chiết khấu <?php echo $get_campaign['discount_value'] ?><sup>%</sup></p>
                                <p style="padding: 6px 12px">Giá sau chiết khấu <?php echo $fm -> format_currency($get_campaign['product_value_discount']) ?><sup>đ</sup></p>
                            </div>
                            <p>Hiện tại chiến dịch có <?php echo $get_campaign['product_sum'] ?> sản phẩm</p><br>
                            <div class="product-content-right-product-properties">
                                <p style="font-weight: bold;">Chiết khấu:</p>
                                <div class="properties">
                                    <?php
                                    if ($show_discount_by_product) {
                                        while ($temp = $show_discount_by_product->fetch_assoc()) {
                                    ?>
                                            <li style="margin-top: 6px;">Từ <?php echo $temp['discount_point'] ?> sp, chiết khấu <?php echo $temp['discount_value'] ?>%</li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div> <br>
                            <form action="" method="POST">
                                <div class="quantity">
                                    <label for="quantity" style="font-weight: bold; font-size: 1rem; margin-right: 6px;">Số lượng: </label> &nbsp;
                                    <input type="number" min="0" value="1" name="quantity">
                                </div>
                                <div class="product-content-right-product-button">
                                    <button type="submit"><i class="fa-solid fa-cart-shopping"></i>
                                        <p>Tham gia mua</p>
                                    </button>
                                </div>
                            </form>
                            <div class="product-content-right-product-icon">
                                <div class="product-content-right-product-icon-item">
                                    <i class="fa-solid fa-phone"></i> &nbsp;<p>Hotline</p>
                                </div>
                                <div class="product-content-right-product-icon-item">
                                    <i class="fa-solid fa-comment"></i>&nbsp; <p>Comment</p>
                                </div>
                                <div class="product-content-right-product-icon-item">
                                    <i class="fa-solid fa-store"></i>&nbsp;<p>Dia Chi Kho</p>
                                </div>
                            </div> <br>
                            <div class="product-content-right-bottom">
                                <div class="product-content-right-bottom-top">
                                    <p>V</p>
                                </div>
                                <div class="product-content-right-bottom-content-big">
                                    <div class="product-content-right-bottom-content-title row">
                                        <div class="product-content-right-bottom-content-title-item thongtin">
                                            <p>Mô tả sản phẩm</p>
                                        </div>
                                        <!-- <div class="product-content-right-bottom-content-title-item script">
                                            <p>Mo Ta San Pham</p>
                                        </div>
                                        <div class="product-content-right-bottom-content-title-item">
                                            <p>Danh Gia</p>
                                        </div> -->
                                    </div>
                                    <div class="product-content-right-bottom-content">
                                        <div class="product-content-right-bottom-content-thongtin">
                                            <p style="font-size: 1rem;"><?php echo $result['product_description'] ?></p>
                                        </div>
                                        <!-- <div class="product-content-right-bottom-content-script">
                                            abcabcabcabcabc abcabc abcabcabc abcabc abcabc abc abc <br>
                                            babababagaga babagaa bbag babag babag babag babag 
                                        </div>
                                        <div class="product-content-right-bottom-content-danhgia">
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
        <section class="product-related container">
            <div class="product-related-title">
                <h3>San Pham Lien Quan</h3>
            </div>
            <div class="product-content row">
                <?php
                if($relevant_product){
                    while($temp = $relevant_product->fetch_assoc()){
                ?>
                <a href="product.php?product_id=<?php echo $temp['product_id']?>&user_id=<?php echo $user_id?>">
                    <div class="product-related-item">
                        <img src="admin/uploads/product/<?php echo $temp['product_main_image']?>">
                        <h1><?php echo $temp['product_name']?></h1>
                        <p style="color: black"><?php echo $fm -> format_currency($temp['product_price'])?><sup>đ</sup></p> <p><?php echo $fm -> format_currency($temp['product_sale_price'])?><sup>đ</sup></p>
                    </div>
                </a>
                <?php
                    }
                }
                ?>
            </div>

        </section>


        <script src="javascript/homepage.js"> </script>