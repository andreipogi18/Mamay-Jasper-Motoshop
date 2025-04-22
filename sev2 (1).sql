-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 02:19 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sev2`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(60) NOT NULL,
  `CategoryName` varchar(60) DEFAULT NULL,
  `CategoryCode` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `CategoryName`, `CategoryCode`) VALUES
(1, 'Cold Brew', 'Cold'),
(2, 'Milk Tea', 'Milk'),
(3, 'Fruit Tea', 'Frui'),
(4, 'Milk Series', 'Mies'),
(5, 'Frappe', 'Frap'),
(6, 'Premium', 'Prem');

-- --------------------------------------------------------

--
-- Table structure for table `order_price`
--

CREATE TABLE `order_price` (
  `price_id` int(60) NOT NULL,
  `category_id` int(60) NOT NULL,
  `cupsize` varchar(60) NOT NULL,
  `price` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_price`
--

INSERT INTO `order_price` (`price_id`, `category_id`, `cupsize`, `price`) VALUES
(1, 1, 'Medium', 45),
(2, 1, 'Large', 55),
(3, 2, 'Medium', 38),
(4, 2, 'Large', 48),
(5, 3, 'Medium', 35),
(6, 3, 'Large', 45),
(7, 4, 'Medium', 55),
(8, 4, 'Large', 65),
(9, 5, 'Medium', 45),
(10, 5, 'Large', 55),
(11, 6, 'Large', 88),
(16, 9, 'Medium', 45),
(17, 9, 'Large', 55);

-- --------------------------------------------------------

--
-- Table structure for table `order_slip`
--

CREATE TABLE `order_slip` (
  `order_id` int(100) NOT NULL,
  `user_id` int(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `status` varchar(60) DEFAULT NULL,
  `product_id` int(60) NOT NULL,
  `price_id` int(60) NOT NULL,
  `Quantity` int(60) NOT NULL,
  `payment` varchar(60) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_slip`
--

INSERT INTO `order_slip` (`order_id`, `user_id`, `email`, `username`, `status`, `product_id`, `price_id`, `Quantity`, `payment`, `date`) VALUES
(1, 13, 'glenn@gmail.com', 'glenn', '3', 3, 6, 10, 'Cash', '2024-02-20'),
(2, 13, 'glenn@gmail.com', 'glenn', '1', 2, 3, 10, 'Cash', '2024-02-20'),
(3, 13, 'glenn@gmail.com', 'glenn', '1', 2, 4, 10, 'Cash', '2024-02-20'),
(4, 13, 'glenn@gmail.com', 'glenn', '1', 4, 8, 10, 'Cash', '2024-02-20'),
(5, 13, 'glenn@gmail.com', 'glenn', '1', 8, 4, 10, 'Cash', '2024-02-20'),
(6, 13, 'glenn@gmail.com', 'glenn', '1', 24, 6, 10, 'Cash', '2024-02-20'),
(7, 13, 'glenn@gmail.com', 'glenn', '1', 8, 3, 10, 'Cash', '2024-02-20'),
(8, 13, 'glenn@gmail.com', 'glenn', '1', 27, 9, 5, 'Cash', '2024-02-20'),
(9, 13, 'glenn@gmail.com', 'glenn', '1', 24, 6, 10, 'Cash', '2024-02-20'),
(10, 13, 'glenn@gmail.com', 'glenn', '1', 24, 5, 10, 'Cash', '2024-02-20'),
(11, 13, 'glenn@gmail.com', 'glenn', '1', 20, 5, 3, 'Cash', '2024-02-20'),
(12, 13, 'glenn@gmail.com', 'glenn', '1', 21, 5, 2, 'Cash', '2024-02-20'),
(13, 13, 'glenn@gmail.com', 'glenn', '1', 17, 2, 8, 'Cash', '2024-02-20'),
(14, 13, 'glenn@gmail.com', 'glenn', '1', 35, 7, 2, 'Cash', '2024-02-20'),
(15, 13, 'glenn@gmail.com', 'glenn', '1', 46, 11, 10, 'Cash', '2024-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(60) NOT NULL,
  `productCode` varchar(60) NOT NULL,
  `product` varchar(60) NOT NULL,
  `poster` varchar(60) NOT NULL,
  `category` varchar(60) NOT NULL,
  `hidden` tinyint(4) NOT NULL COMMENT '0 = show 1 = hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `productCode`, `product`, `poster`, `category`, `hidden`) VALUES
(2, 'Milk', 'Wintermelon', 'Wintermelon.png', '2', 1),
(3, 'Milk', 'Dark Chocolate', 'Dark-Chocolate.png', '2', 1),
(4, 'Milk', 'Okinawa', 'Okinawa.png', '2', 1),
(5, 'Milk', 'Salted Caramel', 'Salted-Caramel.png', '2', 1),
(6, 'Milk', 'Taro', 'Taro.png', '2', 1),
(7, 'Milk', 'Red Velvet', 'Red-Velvet.png', '2', 1),
(8, 'Milk', 'Matcha', 'Matcha.png', '2', 1),
(9, 'Milk', 'Cookies and Cream', 'Cookies-and-Cream.png', '2', 1),
(10, 'Milk', 'Choco Strawberry', 'Choco-Strawberry.png', '2', 1),
(11, 'Cold', 'Caramel Macchiato', 'Caramel-Macchiato.png', '1', 1),
(12, 'Cold', 'Salted Caramel Latte', 'Salted-Caramel-Latte.png', '1', 1),
(13, 'Cold', 'Spanish Latte', 'Spanish-Latte.png', '1', 1),
(14, 'Cold', 'Mocha Latte', 'Mocha-Latte.png', '1', 1),
(15, 'Cold', 'French Vanilla', 'French-Vanilla.png', '1', 1),
(16, 'Cold', 'White Mocha', 'White-Mocha.png', '1', 1),
(17, 'Cold', 'Iced Chocolate', 'Iced-Chocolate.png', '1', 1),
(18, 'Cold', 'Iced Americano', 'Iced-Amerikano.png', '1', 1),
(19, 'Frui', 'Strawberry', 'Strawberry.png', '3', 1),
(20, 'Frui', 'Blueberry', 'Blueberry.png', '3', 1),
(21, 'Frui', 'Lemon', 'Lemon.png', '3', 1),
(22, 'Frui', 'Green Apple', 'Green-Apple.png', '3', 1),
(23, 'Frui', 'Mango', 'Mango.png', '3', 1),
(24, 'Frui', 'Passion Fruit', 'Passion-Fruit.png', '3', 1),
(25, 'Frui', 'Kiwi', 'Kiwi.png', '3', 1),
(26, 'Frap', 'Java Chip', 'Java-Chip.png', '5', 1),
(27, 'Frap', 'Dark Mocha', 'Dark-Mocha.png', '5', 1),
(28, 'Frap', 'Dark Caramel', 'Dark-Caramel.png', '5', 1),
(29, 'Frap', 'Macha Frappe', 'Macha-Frappe.png', '5', 1),
(30, 'Frap', 'Dark Choco Berry', 'Dark-Choco-Berry.png', '5', 1),
(31, 'Frap', 'Triple Chocolate', 'Triple-Chocolate.png', '5', 1),
(32, 'Frap', 'Strawberries and Cream', 'Strawberries-and-Cream.png', '5', 1),
(33, 'Frap', 'Blueberries and Cream', 'Blueberries-and-Cream.png', '5', 1),
(34, 'Mies', 'Strawberries and Milk', 'Strawberries-and-Milk.png', '4', 1),
(35, 'Mies', 'Blueberries and Milk', 'Blueberries-and-Milk.png', '4', 1),
(36, 'Mies', 'Mango and Milk', 'Mango-and-Milk.png', '4', 1),
(37, 'Prem', 'Dark Choco Lava', 'Dark-Choco-Lava.png', '6', 1),
(38, 'Prem', 'Red Velvet Cheese and Cream', 'Red-Velvet-Cheese-and-Cream.png', '6', 1),
(39, 'Prem', 'KOPI Caramel', 'KOPI-Caramel.png', '6', 1),
(40, 'Prem', 'Dark Forest', 'Dark-Forest.png', '6', 1),
(41, 'Prem', 'Mango Cheesecake', 'Mango-Cheesecake.png', '6', 1),
(42, 'Prem', 'Lava Cheesecake', 'Lava-Cheesecake.png', '6', 1),
(43, 'Prem', 'Strawberry Cheesecake', 'Strawberry-Cheesecake.png', '6', 1),
(44, 'Prem', 'Oreo Cheesecake', 'Oreo-Cheesecake.png', '6', 1),
(45, 'Prem', 'White Choco Mocha', 'White-Choco-Mocha.png', '6', 1),
(46, 'Prem', 'Dark Choco Cream Cheese', 'Dark-Choco-Cream-Cheese.png', '6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(60) NOT NULL,
  `user_id` int(60) NOT NULL,
  `status` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(60) NOT NULL,
  `datein` date NOT NULL,
  `product_id` int(60) NOT NULL,
  `quantity` int(60) NOT NULL,
  `remaining` int(60) NOT NULL,
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `datein`, `product_id`, `quantity`, `remaining`, `expiration_date`) VALUES
(2, '2024-02-19', 2, 100, 80, '2024-03-20'),
(3, '2024-02-20', 3, 100, 90, '2024-03-20'),
(4, '2024-02-21', 4, 100, 90, '2024-03-20'),
(5, '2024-02-22', 5, 100, 100, '2024-03-20'),
(6, '2024-02-23', 6, 100, 100, '2024-03-20'),
(7, '2024-02-24', 7, 100, 100, '2024-03-20'),
(8, '2024-02-25', 8, 100, 80, '2024-03-20'),
(9, '2024-02-26', 9, 100, 100, '2024-03-20'),
(10, '2024-02-27', 10, 100, 100, '2024-03-20'),
(11, '2024-02-28', 11, 100, 100, '2024-03-20'),
(12, '2024-02-29', 12, 100, 100, '2024-03-20'),
(13, '2024-03-01', 13, 100, 100, '2024-03-20'),
(14, '2024-03-02', 14, 100, 100, '2024-03-20'),
(15, '2024-03-03', 15, 100, 100, '2024-03-20'),
(16, '2024-03-04', 16, 100, 100, '2024-03-20'),
(17, '2024-03-05', 17, 100, 92, '2024-03-20'),
(18, '2024-03-06', 18, 100, 100, '2024-03-20'),
(19, '2024-03-07', 19, 100, 100, '2024-03-20'),
(20, '2024-03-08', 20, 100, 97, '2024-03-20'),
(21, '2024-03-09', 21, 100, 98, '2024-03-20'),
(22, '2024-03-10', 22, 100, 100, '2024-03-20'),
(23, '2024-03-11', 23, 100, 100, '2024-03-20'),
(24, '2024-03-12', 24, 100, 70, '2024-03-20'),
(25, '2024-03-13', 25, 100, 100, '2024-03-20'),
(26, '2024-03-14', 26, 100, 100, '2024-03-20'),
(27, '2024-03-15', 27, 100, 95, '2024-03-20'),
(28, '2024-03-16', 28, 100, 100, '2024-03-20'),
(29, '2024-03-17', 29, 100, 100, '2024-03-20'),
(30, '2024-03-18', 30, 100, 100, '2024-03-20'),
(31, '2024-03-19', 31, 100, 100, '2024-03-20'),
(32, '2024-03-20', 32, 100, 100, '2024-03-20'),
(33, '2024-03-21', 33, 100, 100, '2024-03-20'),
(34, '2024-03-22', 34, 100, 100, '2024-03-20'),
(36, '2024-03-24', 36, 100, 100, '2024-03-20'),
(37, '2024-03-25', 37, 100, 100, '2024-03-20'),
(38, '2024-03-26', 38, 100, 100, '2024-03-20'),
(39, '2024-03-27', 39, 100, 100, '2024-03-20'),
(40, '2024-03-28', 40, 100, 100, '2024-03-20'),
(41, '2024-03-29', 41, 100, 100, '2024-03-20'),
(42, '2024-03-30', 42, 100, 100, '2024-03-20'),
(43, '2024-03-31', 43, 100, 100, '2024-03-20'),
(44, '2024-04-01', 44, 100, 100, '2024-03-20'),
(45, '2024-04-02', 45, 100, 100, '2024-03-20'),
(46, '2024-04-03', 46, 200, 90, '2024-03-20'),
(51, '0000-00-00', 0, 0, 0, '0000-00-00'),
(52, '2024-02-19', 2, 100, 100, '2024-03-20'),
(53, '2024-02-20', 3, 100, 100, '2024-03-20'),
(54, '2024-02-21', 4, 100, 100, '2024-03-20'),
(55, '2024-02-22', 5, 100, 100, '2024-03-20'),
(56, '2024-02-23', 6, 100, 100, '2024-03-20'),
(57, '2024-02-24', 7, 100, 100, '2024-03-20'),
(58, '2024-02-25', 8, 100, 100, '2024-03-20'),
(59, '2024-02-26', 9, 100, 100, '2024-03-20'),
(60, '2024-02-27', 10, 100, 100, '2024-03-20'),
(61, '2024-02-28', 11, 100, 100, '2024-03-20'),
(62, '2024-02-29', 12, 100, 100, '2024-03-20'),
(63, '2024-03-01', 13, 100, 100, '2024-03-20'),
(64, '2024-03-02', 14, 100, 100, '2024-03-20'),
(65, '2024-03-03', 15, 100, 100, '2024-03-20'),
(66, '2024-03-04', 16, 100, 100, '2024-03-20'),
(67, '2024-03-05', 17, 100, 100, '2024-03-20'),
(68, '2024-03-06', 18, 100, 100, '2024-03-20'),
(69, '2024-03-07', 19, 100, 100, '2024-03-20'),
(70, '2024-03-08', 20, 100, 100, '2024-03-20'),
(71, '2024-03-09', 21, 100, 100, '2024-03-20'),
(72, '2024-03-10', 22, 100, 100, '2024-03-20'),
(73, '2024-03-11', 23, 100, 100, '2024-03-20'),
(74, '2024-03-12', 24, 100, 100, '2024-03-20'),
(75, '2024-03-13', 25, 100, 100, '2024-03-20'),
(76, '2024-03-14', 26, 100, 100, '2024-03-20'),
(77, '2024-03-15', 27, 100, 100, '2024-03-20'),
(78, '2024-03-16', 28, 100, 100, '2024-03-20'),
(79, '2024-03-17', 29, 100, 100, '2024-03-20'),
(80, '2024-03-18', 30, 100, 100, '2024-03-20'),
(81, '2024-03-19', 31, 100, 100, '2024-03-20'),
(82, '2024-03-20', 32, 100, 100, '2024-03-20'),
(83, '2024-03-21', 33, 100, 100, '2024-03-20'),
(84, '2024-03-22', 34, 100, 100, '2024-03-20'),
(85, '2024-03-23', 35, 100, 98, '2024-03-20'),
(86, '2024-03-24', 36, 100, 100, '2024-03-20'),
(87, '2024-03-25', 37, 100, 100, '2024-03-20'),
(88, '2024-03-26', 38, 100, 100, '2024-03-20'),
(89, '2024-03-27', 39, 100, 100, '2024-03-20'),
(90, '2024-03-28', 40, 100, 100, '2024-03-20'),
(91, '2024-03-29', 41, 100, 100, '2024-03-20'),
(92, '2024-03-30', 42, 100, 100, '2024-03-20'),
(93, '2024-03-31', 43, 100, 100, '2024-03-20'),
(94, '2024-04-01', 44, 100, 100, '2024-03-20'),
(95, '2024-04-02', 45, 100, 100, '2024-03-20'),
(96, '2024-04-03', 46, 200, 100, '2024-03-20'),
(97, '0000-00-00', 0, 0, 0, '0000-00-00'),
(98, '0000-00-00', 0, 0, 0, '0000-00-00'),
(99, '0000-00-00', 0, 0, 0, '0000-00-00'),
(100, '0000-00-00', 0, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `avatar` varchar(60) DEFAULT NULL,
  `firstName` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `role` varchar(60) NOT NULL,
  `user_status` tinyint(1) NOT NULL COMMENT 'if 0 then user inactive when 1 user is active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `avatar`, `firstName`, `lastName`, `username`, `password`, `email`, `role`, `user_status`) VALUES
(3, 'aizy.jfif', 'Aizilyn', 'Capillanes', 'aizy', 'YWl6eQ==', 'aizy@yahoo.com', 'Client', 0),
(4, 'claire.gif', 'Claire', 'Salazar', 'claire', 'Y2xhaXJl', 'claire@gmail.com', 'Client', 0),
(9, 'admin.jpg', 'Admin', 'Administrator', 'admin', 'YWRtaW4=', 'admin@yahoo.com', 'Admin', 0),
(13, 'glenn.jpg', 'Glenn Christian', 'Terrible', 'glenn', 'Z2xlbm4=', 'glenn@gmail.com', 'Client', 0),
(41, NULL, 'John', 'Doe', 'john', 'am9obg==', 'john@gmail.com', 'Client', 0),
(43, NULL, 'Robby', 'Protomartir', 'robby', 'MTIz', 'robby@gmail.com', 'Client', 0),
(44, NULL, 'staff', 'staff', 'staff', 'c3RhZmY=', 'staff@yahoo.com', 'Staff', 0),
(46, NULL, 'Ronny', 'Mcnanny', 'Ronny', 'cm9ubnk=', 'ronny@gmail.com', 'Client', 0),
(47, NULL, 'Bonnie', 'Terrible', 'bonnie', 'Ym9ubmll', 'bonnie@gmail.com', 'Client', 0),
(48, NULL, 'Kimmy', 'Dora', 'kimmy', 'a2ltbXk=', 'kimmy@yahoo.com', 'Client', 0),
(49, NULL, 'Tinny', 'Dora', 'tinny', 'dGlubnk=', 'tinny@gmail.com', 'Client', 0),
(50, NULL, 'Nanny', 'Omaewo', 'nani', 'bmFuaQ==', 'nanny@gmail.com', 'Client', 0),
(51, NULL, 'staff', 'staff', 'staff1', 'Z2xlbm4=', 'staff1@yahoo.com', 'Staff', 0),
(52, NULL, 'asd', 'asdasd', 'asdasdddasd', 'YXNkYXNkYXNk', 'asdasdasdasd@gmail.com', 'Client', 0),
(53, 'chris.png', 'Christian', 'Terribleasd', 'chris', 'Y2hyaXN0aWFu', 'chris@yahoo.com', 'Client', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `CategoryCode` (`CategoryCode`);

--
-- Indexes for table `order_price`
--
ALTER TABLE `order_price`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `order_slip`
--
ALTER TABLE `order_slip`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_price` (`price_id`),
  ADD KEY `order_product` (`product_id`),
  ADD KEY `order_user` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_price`
--
ALTER TABLE `order_price`
  MODIFY `price_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_slip`
--
ALTER TABLE `order_slip`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_slip`
--
ALTER TABLE `order_slip`
  ADD CONSTRAINT `order_price` FOREIGN KEY (`price_id`) REFERENCES `order_price` (`price_id`),
  ADD CONSTRAINT `order_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
