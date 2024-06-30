<?php
include "class/discount_class.php";
include "header.php";
include "sidebar.php";

$discount = new discount;

$admin_show_discount = $discount -> admin_show_discount();
?>


<div class="admin-content-right">
    <section class="admin-content">
        <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách chiết khấu</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>Id</th>
                        <th>ID sản phẩm</th>
                        <th>Mức thay đổi chiết khấu</th>
                        <th>Phần trăm chiết khấu</th>
                        <th>Email người bán</th>
                    </tr>
                    <?php
                    if($admin_show_discount){
                        $i = 0;
                        while($result = $admin_show_discount -> fetch_assoc()){
                            $i++
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $result['discount_id']?></td>
                        <td><?php echo $result['product_id']?></td>
                        <td><?php echo $result['discount_point']?></td>
                        <td><?php echo $result['discount_value']?>%</td>
                        <td><?php echo $result['user_email']?></td>
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