<?php
include_once "class/order_class.php";
include_once "header.php";
include_once "sidebar.php";
include_once "helpers/format.php";

$order = new order;
$fm = new format;

$show_all_order = $order -> show_all_order();
?>

        <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách đơn hàng</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>Id đơn hàng</th>
                        <th>Id chiến dịch</th>
                        <th>Id người mua</th>
                        <th>Số lượng</th>
                        <th>Giá trị hoá đơn</th>
                        <th>Tiền cọc</th>
                        <th>Tình trạng hoá đơn</th>
                    </tr>
                    <?php
                        if($show_all_order){
                            $i=0;
                            while($result = $show_all_order -> fetch_assoc()){
                                $i++
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $result['order_id']?></td>
                        <td><?php echo $result['campaign_id']?></td>
                        <td><?php echo $result['user_id']?></td>
                        <td><?php echo $result['quantity']?></td>
                        <td><?php echo $fm -> format_currency($result['price_discount'])?></td>
                        <td><?php echo $fm -> format_currency($result['down_payment'])?></td>
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
                    </tr>
                    <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </section>
</div>
</body>
</html>