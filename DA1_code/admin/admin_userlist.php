<?php
    include "class/user_class.php";
    include "header.php";
    include "sidebar.php";

    $user = new user;

    $show_user = $user -> show_user();
?>


<div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách người dùng</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Email</th>
                        <th>Loại người dùng</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                    <?php
                    if($show_user){
                        $i = 0;
                        while($result = $show_user -> fetch_assoc()){
                            $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $result['user_id'] ?></td>
                            <td><?php echo $result['user_name'] ?></td>
                            <td><?php echo $result['user_phone'] ?></td>
                            <td><?php echo $result['user_dob'] ?></td>
                            <td><?php echo $result['user_email'] ?></td>
                            <td> 
                                <?php 
                                if($result['user_type'] == 1){ 
                                    echo "Người mua";
                                }elseif($result['user_type'] == 2)
                                    echo "Admin";
                                else{
                                    echo "Người bán";
                                } 
                                ?>
                            </td>
                            <td><a class="normal_link" href="delete_user.php?user_id=<?php echo $result['user_id'] ?>">Xoá</a></td>
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