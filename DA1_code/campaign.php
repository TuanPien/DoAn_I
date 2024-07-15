<?php
include_once "admin/class/campaign_class.php";
include_once "admin/class/product_class.php";
include_once "navbar.php";

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL || 
!isset($_GET['product_id']) || $_GET['product_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
    $product_id = $_GET['product_id'];
}

$campaign = new campaign;
$product = new product;

$get_product = $product -> get_product($product_id);
$show_campaign_by_product = $campaign -> show_campaign_by_product($product_id);

?>


        <section>
            <h2 style="margin-left: 10%; margin-top: 5%;">Danh sách chiến dịch</h2>
            <?php
            if($get_product){
                $temp = $get_product -> fetch_assoc();
                $product_name = $temp['product_name'];
                $product_id = $temp['product_id'];
            }
            ?>
            <p style="margin-left: 10%; margin-top: 12px;"><?php echo $product_name.' #'.$product_id?></p>
            <div class="cart-content-left">
                <?php
                if(!is_string($show_campaign_by_product)){
                ?>
                <table style="width: 80%; margin-left: 10%; margin-top: 5%; border: 1px solid #ddd; padding: 2%; border-radius: 35px;">
                    <tr>
                        <th>ID</th>
                        <th>Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng hiện bán</th>
                        <th>Phần trăm chiết khấu</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Tuỳ chọn</th>

                    </tr>
                    <?php
                        while($result = $show_campaign_by_product -> fetch_assoc()){
                    ?>
                    <tr>
                        <td>#<?php echo $result['campaign_id']?></td>
                        <td><img width="100px" src="admin/uploads/product/<?php echo $result['product_main_image']?>"></td>
                        <td><?php echo $result['product_name']?></td>
                        <td><?php echo $result['product_sum']?></td>
                        <td><?php echo $result['discount_value']?>%</td>
                        <td><?php echo $result['time_start']?></td>
                        <td><?php echo $result['time_end']?></td>
                        <td>
                            <?php
                            $campaign_id = $result['campaign_id'];
                            $time_check = $campaign -> time_check($campaign_id);
                            if(isset($time_check) && is_bool($time_check) && $time_check == true){
                            ?>
                                <a href="joincampaign.php?campaign_id=<?php echo $result['campaign_id']?>&user_id=<?php echo $user_id?>" class="show_link button">Chi tiết</a>
                            <?php
                            }elseif(isset($time_check) && is_bool($time_check) && $time_check == false){
                            ?>
                                <p class="campaign_msg"><?php echo "Chiến dịch đã kết thúc"?></p>
                            <?php
                            }else{
                            ?>
                                <p class="campaign_msg"><?php echo "Chiến dịch chưa bắt đầu" ?></p>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                }else{
                ?>
                <p style="margin-left: 10%; margin-top: 1%; font-size: 1.5rem;">
                <?php
                    echo $show_campaign_by_product;
                ?>
                </p>
                <?php
                }
                ?>
            </div>
        </section>  
    </main>
    <script src="javascript/homepage.js"> </script>
</body>