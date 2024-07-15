-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 08:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `da1_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `category_id`, `brand_name`) VALUES
(7, 8, 'Áo phông'),
(11, 12, 'Điện thoại'),
(17, 18, 'Rau củ '),
(18, 18, 'Hoa quả'),
(19, 18, 'Thịt'),
(20, 17, 'Son'),
(21, 17, 'Phấn'),
(22, 17, 'Kẻ mắt'),
(23, 17, 'Bộ mỹ phẩm'),
(27, 7, 'Đồ dùng nhà vệ sinh'),
(28, 7, 'Đồ dùng bếp'),
(29, 7, 'Đồ dùng phòng ngủ'),
(30, 5, 'Máy tính'),
(31, 5, 'Laptop'),
(32, 5, 'Phụ kiện điện tử'),
(33, 5, 'Điện thoại'),
(34, 4, 'Áo trẻ em'),
(35, 4, 'Quần trẻ em'),
(36, 4, 'Giày trẻ em'),
(37, 3, 'Áo nam'),
(38, 3, 'Quần nam'),
(39, 3, 'Giày nam'),
(40, 2, 'Áo nữ'),
(41, 2, 'Quần nữ'),
(42, 2, 'Giày nữ'),
(43, 2, 'Váy');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `campaign_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `product_sum` int(11) NOT NULL,
  `product_value_discount` int(50) NOT NULL,
  `total_value_discount` int(50) NOT NULL,
  `time_start` date DEFAULT NULL,
  `time_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaign_id`, `product_id`, `discount_id`, `product_sum`, `product_value_discount`, `total_value_discount`, `time_start`, `time_end`) VALUES
(18, 48, 36, 77, 1939600, 149349200, '2024-07-13', '2024-07-17'),
(23, 61, 49, 100, 800000, 80000000, '2024-07-14', '2024-07-22'),
(25, 61, 47, 0, 2000000, 0, '2024-07-06', '2024-07-08'),
(27, 67, 57, 0, 37500000, 0, '2024-07-17', '2024-07-30'),
(28, 66, 56, 0, 41000000, 0, '2024-07-16', '2024-07-27'),
(29, 64, 61, 80, 64400000, 2147483647, '2024-07-14', '2024-07-18'),
(31, 53, 37, 0, 3829000, 0, '2024-07-17', '2024-07-20'),
(32, 44, 21, 0, 5589000, 0, '2024-07-15', '2024-07-23'),
(34, 46, 28, 0, 2343199, 0, '2024-07-01', '2024-07-31'),
(35, 47, 34, 15, 2863650, 42954750, '2024-07-02', '2024-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'Thời trang nữ'),
(3, 'Thời trang nam'),
(4, 'Thời trang trẻ em'),
(5, 'Đồ điện tử'),
(7, 'Đồ gia dụng'),
(17, 'Mỹ phẩm'),
(18, 'Thực phẩm');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `order_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`order_id`, `user_name`, `user_phone`, `user_address`) VALUES
(27, 'Nguyễn Tuấn Anh', '091231234', '12 tqbdc'),
(31, 'Người Mua 1', '090000001', '12 tqb'),
(36, 'Người Mua 1', '090000001', '12 tqb'),
(39, 'Nguyễn Tuấn Anh', '091231234', '12 tqbdc');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_point` int(9) NOT NULL,
  `discount_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `user_id`, `product_id`, `discount_point`, `discount_value`) VALUES
(21, 20, 44, 0, 0),
(22, 20, 44, 10, 25),
(23, 20, 44, 20, 50),
(28, 20, 46, 0, 0),
(29, 20, 46, 5, 25),
(32, 20, 47, 0, 0),
(33, 20, 48, 0, 0),
(34, 20, 47, 10, 15),
(35, 20, 48, 20, 40),
(36, 20, 48, 50, 60),
(37, 20, 53, 0, 0),
(47, 26, 61, 0, 0),
(48, 26, 61, 10, 50),
(49, 26, 61, 20, 60),
(54, 26, 64, 0, 0),
(55, 26, 65, 0, 0),
(56, 26, 66, 0, 0),
(57, 26, 67, 0, 0),
(58, 26, 67, 10, 10),
(59, 26, 66, 10, 20),
(60, 26, 65, 10, 15),
(61, 26, 64, 15, 20),
(62, 20, 53, 10, 10),
(63, 20, 53, 20, 25);

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_discount` int(50) NOT NULL,
  `down_payment` int(50) NOT NULL,
  `order_condition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `user_id`, `campaign_id`, `quantity`, `price_discount`, `down_payment`, `order_condition`) VALUES
(27, 23, 18, 60, 116376000, 58188000, 2),
(30, 24, 29, 50, 2147483647, 1610000000, 0),
(31, 24, 18, 17, 32973200, 16486600, 3),
(32, 24, 35, 15, 42954750, 21477375, 0),
(36, 24, 23, 100, 80000000, 40000000, 2),
(39, 23, 29, 30, 1932000000, 966000000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(25) NOT NULL,
  `product_sale_price` int(25) NOT NULL,
  `product_description` varchar(5000) NOT NULL,
  `product_main_image` varchar(255) NOT NULL,
  `product_priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `brand_id`, `user_id`, `product_name`, `product_price`, `product_sale_price`, `product_description`, `product_main_image`, `product_priority`) VALUES
(44, 39, 20, 'Nike G.T. Hustle 3 Blueprint EP', 6000000, 5589000, 'The G.T. Hustle 3 can help you thrive at crunch time. Engineered to the exact specifications of championship athletes, double-stacked Air Zoom cushioning provides bouncy horsepower. It helps save you energy over the course of the game. It\'s designed for those who want to outlast their opponent and stay fresh through to the final buzzer. Who\'s got next? You do. With its extra-durable rubber outsole, this version gives you traction for outdoor courts.', 'ee78a48c97.jfif', 1),
(46, 39, 20, 'Jordan One Take 5 PF', 2929000, 2343199, 'Accelerate, bank, shoot, score—then repeat. Russell Westbrook\'s latest shoe is here to assist your speed game so you can stay unstoppable on the break. The lateral eyestay and wraparound toe piece help you feel contained on the court. Underfoot, you get energy-returning Zoom Air cushioning in the forefoot so you can keep sinkin\' \'em from the first to the fourth.', '6df23f2657.jfif', 0),
(47, 39, 20, 'Jordan Stay Loyal 3', 3500000, 3369000, 'You gotta know where you\'ve been to know where you\'re going. We took that to heart when creating the Stay Loyal 3, a modern shoe built on the Air Jordan legacy. Inside and out, they\'re made for versatility, with minimalist looks, cloud-like cushioning and design elements that echo the AJ4. In other words, style with proven lasting power.\r\n\r\n', '8487d8dc88.jfif', 1),
(48, 39, 20, 'Jumpman MVP', 5000000, 4849000, 'We didn\'t invent the remix—but considering the material we get to sample, this one\'s a no-brainer. We took elements from the AJ6, 7 and 8, making them into a completely new shoe that celebrates MJ\'s first 3-peat championship run. With leather, textile and nubuck details, these sneakers honour one legacy while encouraging you to cement your own.\r\n\r\n', '28104e1f0d.png', 1),
(53, 39, 20, 'Luka 2 PF', 3829000, 3829000, 'You bring the speed. We\'ll bring the stability. The Luka 2 is built to support your skills, with an emphasis on step-backs, side-steps and quick-stop action. A stacked midsole features firm, flexible cushioning for added responsiveness as you shift back and forth on the court. Up top, the full-foot wrapped cage design helps you stay contained whether you\'re faking out a defender or driving down the lane. With all that tech in a lightweight package, we\'ve got efficiency covered. The rest is up to you.\r\n\r\n', 'ceacd5b214.png', 0),
(61, 40, 26, 'NikeCourt Heritage', 2039000, 2000000, 'Bring classic style back to the court in this cropped sweatshirt. Its midweight terry fabric and dramatic, oversized fit help keep you cosy through your full swing.\r\n\r\n', '111eaf9959.png', 0),
(64, 37, 26, 'Áo Khoác Denim Họa Tiết Damier', 80500000, 80500000, 'Mẫu áo khoác quen thuộc được nâng tầm với họa tiết Damier hiệu ứng 3D trên bề mặt vải Denim tẩy màu, lồng ghép dòng chữ \"Marque L.Vuitton déposée\". Lớp phủ màu Patina thể hiện phong cách cao bồi miền viễn Tây của bộ sưu tập Thu-Đông 2024, trong khi hàng khuy cài hiệu ứng ngọc trai tạo điểm nhấn thanh lịch cho thiết kế. Sản phẩm có thể kết hợp hài hòa với quần đồng điệu để tạo nên tổng thể ấn tượng.', '9fdc71f83c.avif', 1),
(65, 38, 26, 'Quần Jean Họa Tiết Damier', 50000000, 48000000, 'Sở hữu phom dáng suôn dễ mặc, quần Denim nổi bật với đinh tán hiệu ứng ngọc trai cùng họa tiết Damier hiệu ứng 3D do Giám đốc Sáng tạo Pharrell Williams thiết kế, lồng ghép dòng chữ \"Marque L.Vuitton déposée\". Bề mặt vải hiệu ứng sờn và tẩy màu giúp thể hiện phong cách cao bồi miền viễn Tây của bộ sưu tập Thu-Đông 2024. Sản phẩm có thể kết hợp hài hòa với áo khoác đồng điệu.', '6943a751f8.avif', 1),
(66, 42, 26, 'Xăng-đan LV Sunset Platform Comfort', 41500000, 41000000, 'Xăng-đan LV Sunset Platform Comfort là thiết kế dễ mang nhờ sở hữu hai quai dán dễ điều chỉnh độ rộng làm từ da cừu mềm có lớp đệm. Cả hai quai đều được tô điểm các đinh tán hình trái tim và logo LV. Đế ngoài mỏng nhẹ hoàn thiện tổng thể, giúp sản phẩm thêm thời thượng.', 'e877c65cad.avif', 0),
(67, 39, 26, 'Giày Lười Academy', 37500000, 37500000, 'Giày lười Academy bằng da bê mềm mịn gây ấn tượng với vẻ đẹp cá tính mà không kém phần thanh lịch. Dây giày được tô điểm với đinh tán màu vàng ánh kim có khắc các dấu ấn biểu tượng của Louis Vuitton, gồm hoa Monogram và logo LV Twist. Thiết kế được hoàn thiện với đế ngoài to bản mà nhẹ tênh, giúp tăng chiều cao một cách tinh tế.', '708bc792cc.avif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(255) NOT NULL,
  `slider_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_img`) VALUES
(24, 'HOT', '93d6279aa2.jpeg'),
(30, 'Giảm giá sốc', '7322956d94.jpeg'),
(31, 'Hàng mới về', '1026e6f766.jpeg'),
(32, 'Free ship ', 'c893399163.jpeg'),
(33, 'Đơn 0đ', '99941506b3.webp'),
(34, 'MTP', 'c88ec0d075.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_dob` date NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_phone`, `user_dob`, `user_type`, `user_email`, `user_address`, `user_password`) VALUES
(20, 'Nguyen bao khoi', '091231234', '2024-06-29', 0, 'abcxyz123456@gmail.com', '123 tdt', '1bbd886460827015e5d605ed44252251'),
(22, 'Nguyen Bao Khoi', '0936473560', '2024-02-08', 2, 'Khoi.NB213975@sis.hust.edu.vn', '123 tqb', '1bbd886460827015e5d605ed44252251'),
(23, 'Nguyễn Tuấn Anh', '091231234', '2024-06-01', 1, 'ta123123@gmail.com', '12 tqbdc', '1bbd886460827015e5d605ed44252251'),
(24, 'Người Mua 1', '090000001', '2024-06-07', 1, 'nguoimua1@gmail.com', '12 tqb', '1bbd886460827015e5d605ed44252251'),
(25, 'Nguyentuan anh', '91231234', '2024-06-07', 1, 'tadz123456@gmail.com', '12 tqb', '1bbd886460827015e5d605ed44252251'),
(26, 'nguyen quang anh', '0932112345', '2024-06-12', 0, 'qa123@gmail.com', '123 tdt', '1bbd886460827015e5d605ed44252251');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
