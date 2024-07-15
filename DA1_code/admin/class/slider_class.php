<?php
include_once "database.php";

class slider{
    private $db;

    public function __construct(){
        $this -> db = new Database();
    }
    
    public function num_slider(){
        $query = "SELECT COUNT(*) as count FROM slider";
        $result = $this -> db -> select($query) -> fetch_assoc();
        if($result['count'] >= 6){
            return false;
        }else{
            return true;
        }
    }

    public function insert_slider($data, $files){
        // Kiểm tra số lượng slide
        $check = $this -> num_slider();
        if($check == false){
            echo "<h3 style=\"color: red;\">Số lượng slider vượt giới hạn, vui lòng xoá bớt</h3>";
        }else{
            $slider_title = mysqli_escape_string($this->db->link, $data['slider_title']);
    
            $permited = array('jpg', 'jpeg'. 'png', 'gif');
            $file_name = $files['slider_img']['name'];
            $file_temp = $files['slider_img']['tmp_name'];
            $file_size = $files['slider_img']['size'];
    
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/slider/".$unique_image;
    
            move_uploaded_file($file_temp, $uploaded_image);
    
            $query = "INSERT INTO slider (slider_title, slider_img) VALUES ('$slider_title', '$unique_image')";
            $result = $this -> db -> insert($query);
    
            header('location:admin_listslider.php');
            return $result;
        }
    }

    public function show_slider(){
        $query = "SELECT * FROM slider ORDER BY slider_id DESC";
        $result = $this -> db -> select($query);
        return $result;
    }

    public function delete_slider($slider_id){
        $query = "SELECT * FROM slider WHERE slider_id = $slider_id";
        $temp = $this -> db -> select($query);
        if($temp){
            $temp = $temp-> fetch_assoc();
            $imgname = $temp['slider_img'];
            $path = "uploads/slider/".$imgname;
            if(file_exists($path)){
                unlink($path);
            }
            $query = "DELETE FROM slider WHERE slider_id = $slider_id";
            $result = $this -> db -> delete($query);
            header("location:admin_listslider.php");
            return $result;
        }else{
            echo "<h3 style=\"color: red;\">Không tồn tại slider</h3>";
        } 
    }
}
?>