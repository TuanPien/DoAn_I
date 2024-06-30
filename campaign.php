<?php
include_once "admin/class/campaign_class.php";
include_once "navbar.php";

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL || 
!isset($_GET['product_id']) || $_GET['product_id'] == NULL){
    echo "<script>window.location = 'login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
    $product_id = $_GET['product_id'];
}

$campaign = new campaign;

$show_campaign_by_product = $campaign -> show_campaign_by_product($product_id);

?>


        <section>
            <h2 style="margin-left: 10%; margin-top: 5%;">Danh sách chiến dịch</h2>
            <p style="margin-left: 10%; margin-top: 12px;">Tên sản phẩm #mã sản phẩm</p>
            <div class="cart-content-left">
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
                    if($show_campaign_by_product){
                        while($result = $show_campaign_by_product -> fetch_assoc()){
                    ?>
                    <tr>
                        <td>#<?php echo $result['campaign_id']?></td>
                        <td><img width="100px" src="admin/uploads/<?php echo $result['product_main_image']?>"></td>
                        <td><?php echo $result['product_name']?></td>
                        <td><?php echo $result['product_sum']?></td>
                        <td><?php echo $result['discount_value']?>%</td>
                        <td><?php echo $result['time_start']?></td>
                        <td><?php echo $result['time_end']?></td>
                        <td><a href="joincampaign.php?campaign_id=<?php echo $result['campaign_id']?>&user_id=<?php echo $user_id?>" class="show_link button">Chi tiết</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </section>  
    </main>
    <script src="javascript/homepage.js"> </script>
</body>