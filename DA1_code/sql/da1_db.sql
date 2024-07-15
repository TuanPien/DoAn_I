-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 11:38 AM
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
(18, 48, 36, 60, 1939600, 116376000, '2024-07-13', '2024-07-17');

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
(27, 'Nguyễn Tuấn Anh', '091231234', '12 tqbdc');

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
(24, 20, 45, 0, 0),
(25, 20, 45, 15, 50),
(28, 20, 46, 0, 0),
(29, 20, 46, 5, 25),
(32, 20, 47, 0, 0),
(33, 20, 48, 0, 0),
(34, 20, 47, 10, 15),
(35, 20, 48, 20, 40),
(36, 20, 48, 50, 60),
(37, 20, 53, 0, 0),
(38, 20, 54, 0, 0),
(39, 20, 55, 0, 0),
(40, 20, 56, 0, 0),
(41, 20, 57, 0, 0),
(42, 20, 58, 0, 0),
(43, 20, 59, 0, 0);

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
(27, 23, 18, 60, 116376000, 58188000, 3);

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
(45, 39, 20, 'Nike G.T. Hustle 3 EP', 6000000, 5589000, 'The G.T. Hustle 3 can help you thrive at crunch time. With double-stacked Air Zoom cushioning providing bouncy horsepower, it helps save you energy over the course of the game. It\'s designed for those who want to outlast their opponent and stay fresh through to the final buzzer. Who\'s got next? You do. With its extra-durable rubber outsole, this version gives you traction for outdoor courts.', '2dfa78d09e.png', 1),
(46, 39, 20, 'Jordan One Take 5 PF', 2929000, 2343199, 'Accelerate, bank, shoot, score—then repeat. Russell Westbrook\'s latest shoe is here to assist your speed game so you can stay unstoppable on the break. The lateral eyestay and wraparound toe piece help you feel contained on the court. Underfoot, you get energy-returning Zoom Air cushioning in the forefoot so you can keep sinkin\' \'em from the first to the fourth.', '6df23f2657.jfif', 0),
(47, 39, 20, 'Jordan Stay Loyal 3', 3500000, 3369000, 'You gotta know where you\'ve been to know where you\'re going. We took that to heart when creating the Stay Loyal 3, a modern shoe built on the Air Jordan legacy. Inside and out, they\'re made for versatility, with minimalist looks, cloud-like cushioning and design elements that echo the AJ4. In other words, style with proven lasting power.\r\n\r\n', '8487d8dc88.jfif', 1),
(48, 39, 20, 'Jumpman MVP', 5000000, 4849000, 'We didn\'t invent the remix—but considering the material we get to sample, this one\'s a no-brainer. We took elements from the AJ6, 7 and 8, making them into a completely new shoe that celebrates MJ\'s first 3-peat championship run. With leather, textile and nubuck details, these sneakers honour one legacy while encouraging you to cement your own.\r\n\r\n', '28104e1f0d.png', 1),
(53, 39, 20, 'Luka 2 PF', 3829000, 3829000, 'You bring the speed. We\'ll bring the stability. The Luka 2 is built to support your skills, with an emphasis on step-backs, side-steps and quick-stop action. A stacked midsole features firm, flexible cushioning for added responsiveness as you shift back and forth on the court. Up top, the full-foot wrapped cage design helps you stay contained whether you\'re faking out a defender or driving down the lane. With all that tech in a lightweight package, we\'ve got efficiency covered. The rest is up to you.\r\n\r\n', 'ceacd5b214.png', 0),
(54, 37, 20, 'Jordan Flight Essentials 85', 1069000, 1000000, 'Basic shouldn\'t mean boring. The heavyweight cotton gives this classic-cut tee a stiff drape and structured feel. The woven patch adds sophisticated style, ideal for everyday wear. See, nothing boring about it.', '90380ba36e.png', 1),
(55, 37, 20, 'Men\'s French Terry Short-Sleeve Top', 1478000, 1479000, 'A Y2K-inspired twist on a classic, this tee is made from soft, French terry fabric.', 'd7f21dd0a4.jfif', 0),
(56, 38, 20, 'Zion', 1279000, 1279000, 'Your mesh shorts get an upgrade with an all-over jacquard pattern that\'s woven into the fabric. And speaking of fabric—it\'s enhanced with sweat-wicking technology, so they\'re perfect for running a casual game.\r\n\r\n', '4a2cd9b82c.png', 0),
(57, 40, 20, 'Nike Sportswear Club Essentials', 609000, 609000, 'We updated our Club Essentials T-shirts to give them an easy fit and modern look perfect for everyday wear. A little wider, a touch shorter in the body and a slightly curved hem give this always-comfortable top its updated look.', '7d3becc009.png', 0),
(58, 40, 20, 'Air Jordan', 3419000, 3419000, 'Gilets rarely get the credit they deserve. Powerful enough to anchor any outfit, this knit gilet is made from marbled yarn for a premium look and feel. Already thinking about how you\'ll style it? A V-neck silhouette, 4-button design and roomy fit allow you to throw it over anything—go wild.', 'e214b1813c.png', 1),
(59, 41, 20, 'NikeCourt Heritage', 1579000, 1579000, 'Bring classic style back to the court in these textured shorts. Their midweight terry fabric and loose, roomy fit help keep you cosy through your full swing.', 'a92d9a5a30.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_title` varchar(255) NOT NULL,
  `slider_img` varchar(255) NOT NULL,
  `slider_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_img`, `slider_link`) VALUES
(24, 'HOT', '93d6279aa2.jpeg', 'http://localhost/DA1_code/product.php?product_id=44'),
(30, 'Giảm giá sốc', '7322956d94.jpeg', ''),
(31, 'Hàng mới về', '1026e6f766.jpeg', ''),
(32, 'Free ship ', 'c893399163.jpeg', ''),
(33, 'Đơn 0đ', '99941506b3.webp', ''),
(34, 'MTP', 'c88ec0d075.png', '');

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
(24, 'Nguyentuan anh', '91231234', '2024-06-07', 1, 'tadz123@gmail.com', '12 tqb', '1bbd886460827015e5d605ed44252251'),
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
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
