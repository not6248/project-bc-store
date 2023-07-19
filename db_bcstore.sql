-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2023 at 11:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bcstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_tb`
--

CREATE TABLE `cart_tb` (
  `cart_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `cart_create_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_tb`
--

INSERT INTO `cart_tb` (`cart_id`, `user_id`, `cart_create_datetime`) VALUES
(2, 2, '2022-10-06 05:30:31'),
(3, 3, '2022-10-06 05:31:18'),
(4, 4, '2022-10-16 09:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `key_tb`
--

CREATE TABLE `key_tb` (
  `key_id` int NOT NULL,
  `key_serial` varchar(50) DEFAULT NULL,
  `key_status` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `key_tb`
--

INSERT INTO `key_tb` (`key_id`, `key_serial`, `key_status`, `order_id`, `product_id`) VALUES
(1, 'FJHJ8-C5TXV-JEDED', 1, 29, 3),
(2, '5D7Y8-NDXRJ-F25H8', 0, NULL, 3),
(3, 'UL49P-ZUFG2-SXK8X', 1, 34, 1),
(4, 'Y275A-QXEXD-V3QLN', 2, NULL, 1),
(5, 'V0H9W-5YKZ6-RX3HQ', 0, NULL, 6),
(6, 'QU0O9-ZD9H6-EZTZT', 2, 26, 6),
(7, 'KCAAX-9NDP3-J0ZYE', 0, NULL, 6),
(8, 'X7YYE-AOGGE-5G0J3', 0, NULL, 2),
(9, 'QF3JO-FWJCF-JX6NC', 0, NULL, 2),
(11, 'YDA40-T8667-KPBQF', 0, NULL, 9),
(12, 'MIZ8J-23B4U-55C59', 0, NULL, 5),
(13, 'SKJPY-T4W1J-RW0D7', 0, NULL, 5),
(14, 'PJ6KZ-R6CCN-N2EN9', 0, NULL, 4),
(15, '1VLDW-AOH5Z-SJSV2', 0, NULL, 4),
(16, 'CVSHB-GL9GJ-76SBQ', 0, NULL, 9),
(17, 'WX5KI-PKUJ3-9GV8R', 0, NULL, 9),
(18, '6DX0F-D03G9-NI5GP', 0, NULL, 8),
(19, '4Q745-6K557-JAY1O', 0, NULL, 8),
(20, '3Z5YQ-6KJS0-3YLXW', 1, 31, 7),
(21, 'Z1ZZO-C84CL-VWNOA', 0, NULL, 7),
(22, 'Q8689-2ITI8-T8MMA', 0, NULL, 1),
(25, 'adad-dada-dada', 0, NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `order_tb`
--

CREATE TABLE `order_tb` (
  `order_id` int NOT NULL,
  `order_price` int NOT NULL,
  `order_details` text NOT NULL,
  `order_status` int DEFAULT NULL,
  `order_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cart_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_tb`
--

INSERT INTO `order_tb` (`order_id`, `order_price`, `order_details`, `order_status`, `order_create_date`, `cart_id`) VALUES
(21, 1642, 'a:2:{i:0;a:5:{s:10:\"product_id\";s:1:\"2\";s:7:\"cart_id\";s:1:\"2\";s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}i:1;a:5:{s:10:\"product_id\";s:1:\"4\";s:7:\"cart_id\";s:1:\"2\";s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-15 19:01:09', 2),
(23, 1458, 'a:2:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:12:\"Doom Eternal\";s:13:\"product_price\";s:3:\"899\";}i:1;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:17:\"Bioshock Infinite\";s:13:\"product_price\";s:3:\"559\";}}', 2, '2022-10-15 19:02:18', 2),
(24, 899, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:12:\"Doom Eternal\";s:13:\"product_price\";s:3:\"899\";}}', 2, '2022-10-16 09:36:15', 2),
(25, 1290, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:10:\"God of war\";s:13:\"product_price\";s:4:\"1290\";}}', 2, '2022-10-16 09:36:18', 2),
(26, 1290, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:10:\"God of war\";s:13:\"product_price\";s:4:\"1290\";}}', 1, '2022-10-16 17:25:11', 2),
(27, 353, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-16 09:36:21', 2),
(28, 353, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-16 09:36:24', 2),
(29, 560, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:34:\"Minecraft ID แท้มือ 1 \";s:13:\"product_price\";s:3:\"560\";}}', 0, '2022-10-16 10:12:25', 2),
(30, 1290, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:10:\"God of war\";s:13:\"product_price\";s:4:\"1290\";}}', 2, '2022-10-16 19:12:30', 2),
(31, 1899, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:15:\"Forza Horizon 5\";s:13:\"product_price\";s:4:\"1899\";}}', 0, '2022-10-16 17:35:27', 2),
(32, 1290, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:10:\"God of war\";s:13:\"product_price\";s:4:\"1290\";}}', 2, '2022-10-17 02:49:01', 2),
(33, 50, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:9:\"หมู\";s:13:\"product_price\";s:2:\"50\";}}', 2, '2022-10-17 09:55:50', 2),
(34, 899, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:12:\"Doom Eternal\";s:13:\"product_price\";s:3:\"899\";}}', 0, '2022-10-17 17:53:19', 2),
(35, 560, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:34:\"Minecraft ID แท้มือ 1 \";s:13:\"product_price\";s:3:\"560\";}}', 2, '2022-10-18 19:24:31', 2),
(36, 560, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:34:\"Minecraft ID แท้มือ 1 \";s:13:\"product_price\";s:3:\"560\";}}', 2, '2022-10-18 20:03:13', 2),
(37, 913, 'a:2:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:34:\"Minecraft ID แท้มือ 1 \";s:13:\"product_price\";s:3:\"560\";}i:1;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-18 20:03:39', 2),
(38, 560, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:34:\"Minecraft ID แท้มือ 1 \";s:13:\"product_price\";s:3:\"560\";}}', 2, '2022-10-18 20:06:49', 2),
(39, 560, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:34:\"Minecraft ID แท้มือ 1 \";s:13:\"product_price\";s:3:\"560\";}}', 2, '2022-10-18 20:11:14', 2),
(40, 560, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:34:\"Minecraft ID แท้มือ 1 \";s:13:\"product_price\";s:3:\"560\";}}', 2, '2022-10-18 20:11:41', 2),
(46, 560, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:34:\"Minecraft ID แท้มือ 1 \";s:13:\"product_price\";s:3:\"560\";}}', 2, '2022-10-18 20:43:04', 2),
(47, 353, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-18 20:47:25', 2),
(48, 353, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-18 20:47:23', 2),
(49, 1, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 20:49:53', 2),
(50, 1, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 20:50:05', 2),
(51, 353, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-18 20:51:20', 2),
(52, 353, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-18 20:52:45', 2),
(61, 353, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:5:\"GTA V\";s:13:\"product_price\";s:3:\"353\";}}', 2, '2022-10-18 20:57:32', 2),
(62, 1, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 20:57:55', 2),
(63, 1, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 20:58:20', 2),
(64, 1, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 20:58:50', 2),
(65, 1, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 21:00:22', 2),
(66, 1, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 21:00:50', 2),
(67, 1, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 21:00:58', 2),
(68, 1289, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"1\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-18 21:03:22', 2),
(69, 2578, 'a:1:{i:0;a:3:{s:16:\"product_cart_qty\";s:1:\"2\";s:12:\"product_name\";s:21:\"Resident Evil Village\";s:13:\"product_price\";s:4:\"1289\";}}', 2, '2022-10-20 09:48:01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `paymentdetail_tb`
--

CREATE TABLE `paymentdetail_tb` (
  `pay_id` int NOT NULL,
  `pat_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bankname` varchar(40) DEFAULT NULL,
  `pay_slip` varchar(200) DEFAULT NULL,
  `order_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paymentdetail_tb`
--

INSERT INTO `paymentdetail_tb` (`pay_id`, `pat_datetime`, `bankname`, `pay_slip`, `order_id`) VALUES
(10, '2022-10-16 16:10:51', 'กรุงไทย', 'Order_id_26.jpg', 26),
(13, '2022-10-16 19:26:25', 'กรุงไทย', 'Order_id_31.jpg', 31),
(14, '2022-10-17 02:40:51', 'กสิกร', 'Order_id_32.jpeg', 32),
(17, '2022-10-17 09:55:19', 'กรุงไทย', 'Order_id_33.jpg', 33),
(18, '2022-10-17 17:53:32', 'กรุงไทย', 'Order_id_34.png', 34);

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

CREATE TABLE `product_cart` (
  `product_id` int DEFAULT NULL,
  `cart_id` int DEFAULT NULL,
  `product_cart_qty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_cart`
--

INSERT INTO `product_cart` (`product_id`, `cart_id`, `product_cart_qty`) VALUES
(2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_tb`
--

CREATE TABLE `product_tb` (
  `product_id` int NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_detail` text,
  `product_price` int DEFAULT NULL,
  `product_img` varchar(200) DEFAULT NULL,
  `product_status` int DEFAULT NULL,
  `product_create_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `protype_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_tb`
--

INSERT INTO `product_tb` (`product_id`, `product_name`, `product_detail`, `product_price`, `product_img`, `product_status`, `product_create_datetime`, `protype_id`) VALUES
(1, 'Doom Eternal', 'รอใส่ทีหลัง', 899, 'img1.png', 0, '2022-10-01 18:22:54', 1),
(2, 'Resident Evil Village', 'รอใส่ทีหลัง', 1289, 'img2.png', 0, '2022-10-04 02:51:53', 3),
(3, 'Minecraft ID แท้มือ 1 ', 'รอใส่ทีหลัง', 560, 'img3.png', 0, '2022-09-25 13:21:06', 4),
(4, 'GTA V', 'รอใส่ทีหลัง', 353, 'img4.png', 0, '2023-07-16 06:14:29', 1),
(5, 'Stray', 'รอใส่ทีหลัง', 399, 'img5.png', 0, '2022-09-24 01:44:05', 1),
(6, 'God of war', 'รอใส่ทีหลัง', 1290, 'img6.png', 0, '2022-10-02 13:02:27', 1),
(7, 'Forza Horizon 5', 'รอใส่ทีหลัง', 1899, 'img7.png', 0, '2022-10-02 13:02:03', 3),
(8, 'Bioshock Infinite', 'รอใส่ทีหลัง', 559, 'img8.png', 0, '2022-09-26 04:03:00', 1),
(9, 'หมู', 'หมูราคาย่อมเยา', 50, 'ปัง.png', 0, '2023-07-16 06:15:14', 2),
(13, 'แมว', 'แมวขาว', 50, '3dfa53fec8cd648be8b8f86dcc6ebf66.jpg', 0, '2023-07-16 06:14:22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `protype_tb`
--

CREATE TABLE `protype_tb` (
  `protype_id` int NOT NULL,
  `protype_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `protype_tb`
--

INSERT INTO `protype_tb` (`protype_id`, `protype_name`) VALUES
(1, 'Steam'),
(2, 'Epic Game'),
(3, 'Origin'),
(4, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_type` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `user_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `username`, `password`, `firstname`, `lastname`, `email`, `user_type`, `status`, `user_create_date`) VALUES
(1, 'not6248', '1407800005407', 'aekkapob', 'pangtan', 'not-6248@hotmail.com', 1, 0, '2022-10-20 11:20:06'),
(2, 'user2', '123456', 'เอกๆ', 'แพงๆ', 'user2@com.com', 2, 0, '2022-10-20 11:19:48'),
(3, 'user1', '123456', 'nn', 'nnn', 'user1@com.com', 2, 0, '2023-07-16 06:10:31'),
(4, 'user3', '123456', '123', '123', 'user3@hotmail.com', 2, 0, '2022-10-20 11:20:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_tb`
--
ALTER TABLE `cart_tb`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `key_tb`
--
ALTER TABLE `key_tb`
  ADD PRIMARY KEY (`key_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `paymentdetail_tb`
--
ALTER TABLE `paymentdetail_tb`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `product_tb`
--
ALTER TABLE `product_tb`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `protype_id` (`protype_id`);

--
-- Indexes for table `protype_tb`
--
ALTER TABLE `protype_tb`
  ADD PRIMARY KEY (`protype_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_tb`
--
ALTER TABLE `cart_tb`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `key_tb`
--
ALTER TABLE `key_tb`
  MODIFY `key_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `paymentdetail_tb`
--
ALTER TABLE `paymentdetail_tb`
  MODIFY `pay_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_tb`
--
ALTER TABLE `product_tb`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `protype_tb`
--
ALTER TABLE `protype_tb`
  MODIFY `protype_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_tb`
--
ALTER TABLE `cart_tb`
  ADD CONSTRAINT `cart_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`);

--
-- Constraints for table `key_tb`
--
ALTER TABLE `key_tb`
  ADD CONSTRAINT `key_tb_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_tb` (`order_id`),
  ADD CONSTRAINT `key_tb_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_tb` (`product_id`);

--
-- Constraints for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD CONSTRAINT `order_tb_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart_tb` (`cart_id`);

--
-- Constraints for table `paymentdetail_tb`
--
ALTER TABLE `paymentdetail_tb`
  ADD CONSTRAINT `paymentdetail_tb_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_tb` (`order_id`);

--
-- Constraints for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD CONSTRAINT `product_cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_tb` (`product_id`),
  ADD CONSTRAINT `product_cart_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `cart_tb` (`cart_id`);

--
-- Constraints for table `product_tb`
--
ALTER TABLE `product_tb`
  ADD CONSTRAINT `product_tb_ibfk_1` FOREIGN KEY (`protype_id`) REFERENCES `protype_tb` (`protype_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
