<?php
include_once "class/order_class.php";
include_once "header.php";
include_once "helpers/format.php";

$order = new order;
$fm = new format;

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

$show_order = $order -> show_order_seller($user_id);

?>

<style>
    .hidden{
        display: none;
    }
</style>

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
            <div class="admin-content-right-category-list">
                <h1>Danh sách danh mục</h1>
                <?php
                if(!is_string($show_order)){
                ?>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>Id đơn hàng</th>
                        <th>Id chiến dịch</th>
                        <th>Email người mua</th>
                        <th>Tiền cần trả</th>
                        <th>Tiền cọc</th>
                        <th>Vận chuyển</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Cập nhật trạng thái</th>
                    </tr>
                    <?php
                    if($show_order){
                        $i = 0;
                        while($result = $show_order -> fetch_assoc()){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $result['order_id']?></td>
                        <td><?php echo $result['campaign_id']?></td>
                        <td><?php echo $result['user_email']?></td>
                        <td><?php echo $fm -> format_currency($result['price_discount']) ?></td>
                        <td><?php echo $fm -> format_currency($result['down_payment']) ?></td>
                        <td><a class="normal_link" href="list_delivery.php?order_id=<?php echo $result['order_id']?>&user_id=<?php echo $user_id?>">Chi tiết</a></td>
                        <td>
                            <?php 
                            switch($result['order_condition']){
                                case "0": echo "Chưa cọc"; break;
                                case "1": echo "Đã cọc"; break;
                                case "2": echo "Đã trả tiền"; break;
                                case "3": echo "Đã nhận"; break;
                            }
                            ?>
                        </td>
                        <td style="display: flex; justify-content: center;">
                            <?php
                            if($result['order_condition']==3){
                            ?>
                                <button onclick="hideRow(this)" class="button" style="width: 50%;">
                                    Ẩn
                                </button>
                            <?php
                            }else{
                            ?>
                            <a class="normal_link" href="edit_order.php?order_id=<?php echo $result['order_id']?>&user_id=<?php echo $user_id?>">Sửa trạng thái</a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
                <?php
                }else{
                    echo $show_order;
                }
                ?>
            </div>
        </div>
    </section>
</div>
</body>
</html>

<script>
    function hideRow(button) {
        // Tìm đến phần tử cha của nút bấm, đó là thẻ <tr>
        var row = button.parentNode.parentNode;
        // Ẩn hàng bằng cách thêm lớp CSS
        row.classList.add('hidden');
    }
</script>