<?php
include_once "navbar.php";
include_once "admin/class/order_class.php";
include_once "admin/class/user_class.php";
include_once "admin/helpers/format.php";

if (!isset($_GET['user_id']) || $_GET['user_id'] == NULL) {
    echo "<script>window.location = 'login.php'</script>";
} else {
    $user_id = $_GET['user_id'];
}
$user = new user;
$order = new order;
$fm = new format;

$history = $order -> sum_history($user_id);
$get_user = $user -> get_user($user_id);

$result = $get_user -> fetch_assoc();
$temp = $history -> fetch_assoc();
?>


<!-- Custom Css -->
<link rel="stylesheet" href="css/user.css">

<!-- FontAwesome 5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1 style="font-family: 'Dancing Script', cursive;">Thông tin người dùng</h1>
        </div>

        <!-- Navbar -->
        <ul>
            <li>
                <a href="#message">
                    <span class="icon-count">29</span>
                    <i class="fa fa-envelope fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="login.php">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
        <!-- End -->
    </div>
    <!-- End -->

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <img src="https://th.bing.com/th/id/OIP.ZT-Tw8tYy38htqch69vsGQAAAA?rs=1&pid=ImgDetMain" alt="" width="100" height="100">

            <div class="name">
                <?php echo $result['user_name']?>
            </div>
            <div class="job">
                <?php if($result['user_type'] == 0){echo "Người bán";}else if($result['user_type']==1){echo "Người mua";}else{echo "Admin";} ?>
            </div>
        </div>

        <div class="sidenav-url">
            <div class="url">
                <a href="user_buyer.php?user_id=<?php echo $user_id?>" class="active">Cá nhân</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="change_password.php?user_id=<?php echo $user_id?>">Bảo mật</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="#settings">Cài đặt</a>
                <hr align="center">
            </div>
        </div>
    </div>
    <!-- End -->

    <!-- Main -->
    <div class="main">
        <h2>Trang cá nhân</h2>
        <div class="card">
            <div class="card-body">
                <a class="edit_user" href="user_buyer_edit.php?user_id=<?php echo $user_id?>"><i class="fa fa-pen fa-xs edit"></i></a>
                <table>
                    <tbody>
                        <tr>
                            <td>Tên</td>
                            <td>:</td>
                            <td><?php echo $result['user_name']?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>:</td>
                            <td><?php echo $result['user_address']?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $result['user_email']?></td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td>:</td>
                            <td><?php echo $result['user_phone']?></td>
                        </tr>
                        <tr>
                            <td>Ngày sinh</td>
                            <td>:</td>
                            <td><?php echo $result['user_dob']?></td>
                        </tr>
                        <tr>
                            <td>Số giao dịch đã hoàn thành</td>
                            <td>:</td>
                            <td><?php echo $temp['total']?></td>
                        </tr>
                        <tr>
                            <td>Tổng giá trị các giao dịch</td>
                            <td>:</td>
                            <td><?php echo $fm -> format_currency($temp['total_price']) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h2>SOCIAL MEDIA</h2>
        <div class="card">
            <div class="card-body">
            <a class="edit_user" href=""><i class="fa fa-pen fa-xs edit"></i></a>
                <div class="social-media">
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-invision fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-whatsapp fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-snapchat fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- End -->
</body>