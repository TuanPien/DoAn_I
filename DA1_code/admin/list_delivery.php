<?php
include_once "class/delivery_class.php";
include_once "header.php";

$delivery = new delivery;

if(!isset($_GET['user_id']) || $_GET['user_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}else{
    $user_id = $_GET['user_id'];
}

if(!isset($_GET['order_id']) || $_GET['order_id'] == NULL){
    echo "<script>window.location = '../login.php'</script>";
}else{
    $order_id = $_GET['order_id'];
}

$get_delivery = $delivery -> get_delivery($order_id);

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
                <h1>Thông tin vận chuyển</h1>
                <?php
                if($get_delivery ==  false){
                    echo "Chưa có thông tin vận chuyển";
                }else{
                ?>
                <table>
                    <tr>
                        <th>ID đơn hàng</th>
                        <th>Tên người nhận</th>
                        <th>Địa chỉ người nhận</th>
                        <th>Số điện thoại người nhận</th>
                    </tr>
                    <?php
                    while($result = $get_delivery -> fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $result['order_id']?></td>
                        <td><?php echo $result['user_name']?></td>
                        <td><?php echo $result['user_address']?></td>
                        <td><?php echo $result['user_phone']?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>