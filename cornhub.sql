-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 04:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cornhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(25) NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `item_img` varchar(255) NOT NULL,
  `item_img2` varchar(255) NOT NULL,
  `item_img3` varchar(255) NOT NULL,
  `item_img4` varchar(255) NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `item_status` char(1) NOT NULL DEFAULT 'A' COMMENT 'A - Active\r\nO - Out of Stock\r\nR - Removed',
  `item_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_category`, `item_img`, `item_img2`, `item_img3`, `item_img4`, `item_price`, `item_status`, `item_desc`) VALUES
(1, 'White CornHub Shirt', 'Shirts', 'whiteshirt1.jpg', 'whiteshirt1.jpg', 'whiteshirt1.jpg', 'whiteshirt1.jpg', 140.00, 'A', 'White CornHub T-shirt w/ small logo left side'),
(2, 'White CornHub Shirt 2', 'Shirts', 'whiteshirt2.jpg', 'whiteshirt2.jpg', 'whiteshirt2.jpg', 'whiteshirt2.jpg', 150.00, 'A', 'White CornHub T-shirt w/ Big Logo Middle'),
(3, 'White CornHub Shirt 3', 'Shirts', 'whiteshirt3.jpg', 'whiteshirt3.jpg', 'whiteshirt3.jpg', 'whiteshirt3.jpg', 155.00, 'A', 'White CornHub T-shirt w/ Logo no Corn Middle'),
(4, 'White CornHub Hoodie ', 'Hoodies', 'whitehood1.jpg', 'whitehood1.jpg', 'whitehood1.jpg', 'whitehood1.jpg', 150.00, 'A', 'White CornHub Hoodie w/ Small Logo Left Side'),
(5, 'White CornHub Hoodie 2', 'Hoodies', 'whitehood2.jpg', 'whitehood2.jpg', 'whitehood2.jpg', 'whitehood2.jpg', 160.00, 'A', 'White CornHub Hoodie w/ Big Logo Middle'),
(6, 'White CornHub Hoodie 3', 'Hoodies', 'whitehood3.jpg', 'whitehood3.jpg', 'whitehood3.jpg', 'whitehood3.jpg', 170.00, 'A', 'White CornHub Hoodie w/ Logo no corn Middle'),
(7, 'White CornHub Cap ', 'Caps', 'whitecap1.jpg', 'whitecap1.jpg', 'whitecap1.jpg', 'whitecap1.jpg', 100.00, 'A', 'White CornHub Cap w/ Logo middle'),
(8, 'White CornHub Cap 2', 'Caps', 'whitecap2.jpg', 'whitecap2.jpg', 'whitecap2.jpg', 'whitecap2.jpg', 85.00, 'A', 'White CornHub Cap w/ Small Logo left side'),
(9, 'White CornHub Cap 3', 'Caps', 'whitecap3.jpg', 'whitecap3.jpg', 'whitecap3.jpg', 'whitecap3.jpg', 120.00, 'A', 'White CornHub Cap w/ Logo no corn middle'),
(10, 'Black CornHub Shirt ', 'Shirts', 'blackshirt1.jpg', 'blackshirt1.jpg', 'blackshirt1.jpg', 'blackshirt1.jpg', 160.00, 'A', 'Black CornHub Shirt w/ small logo left side'),
(11, 'Black CornHub Shirt 2', 'Shirts', 'blackshirt2.jpg', 'blackshirt2.jpg', 'blackshirt2.jpg', 'blackshirt2.jpg', 180.00, 'A', 'Black CornHub Shirt w/ Big logo middle'),
(12, 'Black CornHub Shirt 3', 'Shirts', 'blackshirt3.jpg', 'blackshirt3.jpg', 'blackshirt3.jpg', 'blackshirt3.jpg', 190.00, 'A', 'Black CornHub Shirt w/ logo no corn middle'),
(13, 'Black CornHub Hoodie ', 'Hoodies', 'blackhood1.jpg', 'blackhood1.jpg', 'blackhood1.jpg', 'blackhood1.jpg', 220.00, 'A', 'Black CornHub Hoodie w/ small logo left side'),
(14, 'Black CornHub Hoodie 2', 'Hoodies', 'blackhood2.jpg', 'blackhood2.jpg', 'blackhood2.jpg', 'blackhood2.jpg', 240.00, 'A', 'Black CornHub Hoodie w/ big logo middle'),
(15, 'Black CornHub Hoodie 3', 'Hoodies', 'blackhood3.jpg', 'blackhood3.jpg', 'blackhood3.jpg', 'blackhood3.jpg', 280.00, 'A', 'Black CornHub Hoodie w/ logo no corn middle'),
(16, 'Black CornHub Cap ', 'Caps', 'blackcap1.jpg', 'blackcap1.jpg', 'blackcap1.jpg', 'blackcap1.jpg', 120.00, 'A', 'Black CornHub Cap w/ logo middle'),
(17, 'Black CornHub Cap 2', 'Caps', 'blackcap2.jpg', 'blackcap2.jpg', 'blackcap2.jpg', 'blackcap2.jpg', 100.00, 'A', 'Black CornHub Cap w/ small logo left side'),
(18, 'Black CornHub Cap 3', 'Caps', 'blackcap3.jpg', 'blackcap3.jpg', 'blackcap3.jpg', 'blackcap3.jpg', 140.00, 'A', 'Black CornHub Cap w/ logo no corn middle'),
(19, 'CornHub PHub Shirt ', 'Shirts', 'phshirt1.jpg', 'phshirt1.jpg', 'phshirt1.jpg', 'phshirt1.jpg', 180.00, 'A', 'Black PHub Shirt w/ small logo left side'),
(20, 'CornHub PHub Shirt 2', 'Shirts', 'phshirt2.jpg', 'phshirt2.jpg', 'phshirt2.jpg', 'phshirt2.jpg', 220.00, 'A', 'Black PHub Shirt w/ logo middle'),
(21, 'CornHub PHub Hoodie ', 'Hoodies', 'phhood1.jpg', 'phhood1.jpg', 'phhood1.jpg', 'phhood1.jpg', 280.00, 'A', 'Black PHub Hoodie w/ small logo left side'),
(22, 'CornHub PHub Hoodie 2', 'Hoodies', 'phhood2.jpg', 'phhood2.jpg', 'phhood2.jpg', 'phhood2.jpg', 350.00, 'A', 'Black PHub Hoodie w/ logo middle'),
(23, 'CornHub PHub Cap ', 'Caps', 'phcap1.jpg', 'phcap1.jpg', 'phcap1.jpg', 'phcap1.jpg', 120.00, 'A', 'Black PHub Cap w/ logo middle'),
(24, 'CornHub PHub Cap 2', 'Caps', 'phcap2.jpg', 'phcap2.jpg', 'phcap2.jpg', 'phcap2.jpg', 100.00, 'A', 'Black PHub Cap w/ small logo left side'),
(25, 'CornHub Pants ', 'Pants', 'pants2.png', 'pants2.png', 'pants2.png', 'pants2.png', 100.00, 'A', 'CornHub Pants Black'),
(26, 'CornHub Pants 2', 'Pants', 'pants3.png', 'pants3.png', 'pants3.png', 'pants3.png', 120.00, 'A', 'CornHub Pants Brown'),
(27, 'CornHub Pants 3', 'Pants', 'pants4.png', 'pants4.png', 'pants4.png', 'pants4.png', 100.00, 'A', 'CornHub Pants Jeans'),
(28, 'Original CornHub Pants', 'Pants', 'origpants.jpg', 'origpants.jpg', 'origpants.jpg', 'origpants.jpg', 150.00, 'A', 'Origanal CornHub Pants Green'),
(29, 'Original CornHub Shirt', 'Shirts', 'origtsh1.jpg', 'origtsh1.jpg', 'origtsh1.jpg', 'origtsh1.jpg', 150.00, 'A', 'Original CornHub Tshirt'),
(30, 'Original CornHub Hoodie', 'Hoodies', 'origjack1.jpg', 'origjack1.jpg', 'origjack1.jpg', 'origjack1.jpg', 180.00, 'A', 'Original CornHub Hoodie'),
(31, 'Original CornHub Caps', 'Caps', 'origcap1.png', 'origcap1.png', 'origcap1.png', 'origcap1.png', 65.00, 'A', 'Original CornHub Caps');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_contact` int(11) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` char(1) NOT NULL DEFAULT 'P' COMMENT 'P - Pending\r\nD - Delivered\r\nC - Cancelled\r\n',
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `oitem_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_img` varchar(255) NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_email` varchar(500) NOT NULL,
  `user_pass` char(60) NOT NULL,
  `user_add` text NOT NULL,
  `user_contact` varchar(12) NOT NULL,
  `user_fullname` varchar(200) NOT NULL,
  `user_control` char(1) NOT NULL DEFAULT 'U' COMMENT 'A- Admin\r\nU - User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_add`, `user_contact`, `user_fullname`, `user_control`) VALUES
(1, 'Admin', 'geng@gmail.com', '$2y$10$OXNT0UQkoLXf2tMwhbUFNuIFMSzsE4PJWDlyaEnXy2Vb7gBKGDAt.', 'Null', '123456789', 'admin123', 'A'),
(2, 'SeggsMonster', 'gg@gmail.com', '$2y$10$kQ0xq.KpGiTOYQjDtjguj.QhJrbVD41qEf8m.GV4edsfaqjiJnlZC', 'Houses', '123213213', 'lopo', 'U'),
(3, 'Fred', 'ljmangampo@yahoo.com', '$2y$10$g2mXxFXMzqCc5SRFGooXR.yVOaUVTZfH6S6S3EQ68pqyWaXbpziu2', 'House', '1234256', 'Fred Junior', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `variant_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `variant_name` varchar(255) NOT NULL,
  `variant_price` decimal(6,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`variant_id`, `item_id`, `variant_name`, `variant_price`, `image`) VALUES
(1, 1, 'White CornHub Shirt 2', 150.00, 'whiteshirt2.jpg'),
(2, 1, 'White CornHub Shirt 3', 155.00, 'whiteshirt3.jpg'),
(3, 4, 'White CornHub Hoodie 2', 160.00, 'whitehood2.jpg'),
(4, 4, 'White CornHub Hoodie 3', 170.00, 'whitehood3.jpg'),
(5, 7, 'White CornHub Cap 2', 85.00, 'whitecap2.jpg'),
(6, 7, 'White CornHub Cap 3', 120.00, 'whitecap3.jpg'),
(7, 10, 'Black CornHub Shirt 2', 180.00, 'blackshirt2.jpg'),
(8, 10, 'Black CornHub Shirt 3', 190.00, 'blackshirt3.jpg'),
(9, 13, 'Black CornHub Hoodie 2', 240.00, 'blackhood2.jpg'),
(10, 13, 'Black CornHub Hoodie 3', 280.00, 'blackhood3.jpg'),
(11, 16, 'Black CornHub Cap 2', 100.00, 'blackcap2.jpg'),
(12, 16, 'Black CornHub Cap 3', 140.00, 'blackcap3.jpg'),
(13, 19, 'CornHub PHub Shirt 2', 220.00, 'phshirt2.jpg'),
(14, 21, 'CornHub PHub Hoodie 2', 350.00, 'phhood2.jpg'),
(15, 23, 'CornHub PHub Cap 2', 100.00, 'phcap2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`oitem_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`variant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `oitem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
