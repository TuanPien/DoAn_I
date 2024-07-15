<?php
include "class/slider_class.php";
include "header.php";
include "sidebar.php";

$slider = new slider;

$check = $slider -> num_slider();
$show_slider = $slider -> show_slider();
?>

        <div class="admin-content-right">
            <div class="admin-content-right-category-list">
                <h1>Danh sách đơn hàng</h1>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>Ảnh quảng cáo</th>
                        <th>Tiêu đề quảng cáo</th>
                        <th>Tuỳ chọn</th>
                    </tr>
                    <?php
                        if($show_slider){
                            $i=0;
                            while($result = $show_slider -> fetch_assoc()){
                                $i++
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><img src="uploads/slider/<?php echo $result['slider_img']?>" style="width: 300px;"></td>
                        <td><?php echo $result['slider_title']?></td>
                        <td><a class="normal_link" href="admin_deleteslider.php?slider_id=<?php echo $result['slider_id']?>">Xoá</a></td>
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