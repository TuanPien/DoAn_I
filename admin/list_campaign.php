<?php
include_once "class/campaign_class.php";
include_once "header.php";

$campaign = new campaign;

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

$show_campaign = $campaign -> show_campaign_by_seller($user_id);

?>


<section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li><a href="">Sản phẩm</a>
                    <ul>
                        <li><a href="add_product.php?user_id=<?php echo $user_id?>">Thêm sản phẩm</a></li>
                        <li><a href="list_product.php?user_id=<?php echo $user_id?>">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="">Chiết khấu
                    <ul>
                        <li><a href="add_discount.php?user_id=<?php echo $user_id?>">Thêm thiết lập chiết khấu</a></li>
                        <li><a href="list_discount.php?user_id=<?php echo $user_id?>">Danh sách chiết khấu</a></li>
                    </ul>
                </li>
                <li><a href="">Chiến dịch</a>
                    <ul>
                        <li><a href="add_campaign.php?user_id=<?php echo $user_id?>">Thêm chiến dịch</a></li>
                        <li><a href="list_campaign.php?user_id=<?php echo $user_id?>">Danh sách chiến dịch</a></li>
                    </ul>
                </li>
                <li><a href="">Đơn hàng</a>
                    <ul>
                        <li><a href="list_order.php?user_id=<?php echo $user_id?>">Danh sách đơn hàng</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="admin-content-right">
            <div class="admin-content-right-category-list" style="width: 98%;">
                <h1>Danh sách chiến dịch</h1>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Tên SP #ID</th>
                        <th>Chiết khấu</th>
                        <th>Tổng sản phẩm</th>
                        <th>Giá chiết khấu</th>
                        <th>Tổng hoá đơn chiết khấu</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                    <?php
                    if($show_campaign){
                        while($result = $show_campaign -> fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $result['campaign_id']?></td>
                        <td><?php echo $result['product_name']?> #<?php echo $result['product_id']?></td>
                        <td><?php echo $result['discount_value']?>%</td>
                        <td><?php echo $result['product_sum']?></td>
                        <td><?php echo $result['product_value_discount']?></td>
                        <td><?php echo $result['total_value_discount']?></td>
                        <td><?php echo $result['time_start']?></td>
                        <td><?php echo $result['time_end']?></td>
                        <td><a href="edit_campaign.php?user_id=<?php echo $user_id?>&campaign_id=<?php echo $result['campaign_id']?>">Sửa</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
                <div class="button_container">
                    <a href="add_campaign.php?user_id=<?php echo $user_id?>" class="button">Thêm chiến dịch</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>