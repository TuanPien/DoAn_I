<?php
include "class/campaign_class.php";
include "header.php";
include "sidebar.php";

$campaign = new campaign;
$show_campaign = $campaign -> show_all_campaign();
?>


        <div class="admin-content-right">
                <div class="admin-content-right-category-list">
                <h1>Danh sách chiến dịch</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>ID</th>
                        <th>ID SP</th>
                        <th>Chiết khấu áp dụng</th>
                        <th>Tổng sản phẩm</th>
                        <th>Giá chiết khấu</th>
                        <th>Tổng hoá đơn chiết khấu</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                    </tr>
                    <?php
                    if($show_campaign){
                        $i = 0;
                        while($result = $show_campaign -> fetch_assoc()){
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['campaign_id'] ?></td>
                        <td><?php echo $result['product_id'] ?></td>
                        <td><?php echo $result['discount_value'] ?>%</td>
                        <td><?php echo $result['product_sum'] ?></td>
                        <td><?php echo $result['product_value_discount'] ?></td>
                        <td><?php echo $result['total_value_discount'] ?></td>
                        <td><?php echo $result['time_start'] ?></td>
                        <td><?php echo $result['time_end'] ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>