<?php
include "class/discount_class.php";
include "header.php";

$discount = new discount;

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

$show_discount = $discount -> show_discount($user_id);


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
            <div class="admin-content-right-category-list">
                <h1>Danh sách chiết khấu</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>Id</th>
                        <th>Id sản phẩm</th>
                        <th>Mức thay đổi</th>
                        <th>Phần trăm chiết khấu</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                    <?php
                    if($show_discount){
                        $i = 0;
                        while($result = $show_discount -> fetch_assoc()){
                            $i++
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $result['discount_id']?></td>
                        <td><?php echo $result['product_id']?></td>
                        <td><?php echo $result['discount_point']?></td>
                        <td><?php echo $result['discount_value']?> %</td>
                        <td><a href="edit_discount.php?discount_id=<?php echo $result['discount_id'] ?>">Sửa</a> | 
                        <a href="delete_discount.php?discount_id=<?php echo $result['discount_id'] ?>">Xoá</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
                <div class="button_container">
                    <a href="add_discount.php?user_id=<?php echo $user_id?>" class="button">Thêm chiết khấu</a>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>