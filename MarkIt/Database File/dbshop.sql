-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 06:31 PM
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
-- Database: `dbshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(5) NOT NULL,
  `userid` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productImage` varchar(250) NOT NULL,
  `price` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `dateAdded` date NOT NULL DEFAULT current_timestamp(),
  `archive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `userid`, `productName`, `productImage`, `price`, `stock`, `category`, `dateAdded`, `archive`) VALUES
(3, 1, 'Oreo', 'Oreo Original 128g.jpg', 10, 30, 'Biscuit', '2024-05-09', 0),
(5, 1, 'Mogu Mogu', 'Mogu Mogu Strawberry.jpg', 40, 5, 'Drinks', '2024-05-09', 0),
(6, 1, 'Moby', 'Moby Caramel Puffs by Weee!.jpg', 1, 1, 'Junkfood', '2024-05-09', 0),
(7, 1, 'Mentos', 'Mentos Candy Mint Flavor Pouch 20 pcs.jpg', 5, 100, 'Candy', '2024-05-09', 0),
(8, 1, 'Cheetos', 'Cheetos!.jpg', 120, 25, 'Junkfood', '2024-05-09', 0),
(13, 1, 'Lays', 'download (6).jpg', 120, 20, 'Junkfood', '2024-05-10', 0),
(14, 1, 'Fanta / Royal', 'Fanta orange blikje.jpg', 45, 50, 'Drinks', '2024-05-10', 0),
(15, 1, 'Monster Energy Drink', 'Power engineer.jpg', 50, 10, 'Drinks', '2024-05-10', 0),
(16, 1, 'Red Bull Energy Drink', 'Products pictures for graphic designers.jpg', 50, 10, 'Drinks', '2024-05-10', 0),
(17, 1, 'Pringles SC', 'Pringles-Sour Cream & Onion.jpg', 89, 100, 'Junkfood', '2024-05-10', 0),
(18, 1, 'Snickers', 'Mov01159_Avi.jpg', 40, 50, 'Chocolate', '2024-05-10', 0),
(19, 1, 'KitKat', 'Nestlé KitKat Chocolate Bar.jpg', 120, 5, 'Chocolate', '2024-05-10', 0),
(20, 1, 'M&Ms', 'M&M\'s - Chocolate 220 g.jpg', 30, 40, 'Chocolate', '2024-05-10', 0),
(21, 1, 'Nutella', 'Nutella Chocolate Hazelnut Spread, Perfect Topping for Pancakes, 26_5 Oz (Pack of 1).jpg', 130, 10, 'Spread', '2024-05-10', 0),
(22, 1, 'Maltesers', 'Search - british   maltesers case of 40 x 37g bags 1373 p.jpg', 40, 1, 'Chocolate', '2024-05-10', 0),
(23, 1, 'Kinder Joy', 'bday wishlist.jpg', 50, 12, 'Chocolate', '2024-05-10', 0),
(24, 1, 'Pocky Choco', 'I\'m sharing the deliciously original dark….jpg', 42, 16, 'Chocolate', '2024-05-10', 0),
(25, 1, 'Toblerone', 'Toblerone Chocolate _ M Awais Butt.jpg', 120, 62, 'Chocolate', '2024-05-10', 0),
(26, 1, 'Mini Oreo', '07bb0c68-12b4-4c33-8494-59ad63af97e5.jpg', 30, 20, 'Biscuit', '2024-05-10', 0),
(27, 1, 'Hershey\'s', '812e6e3a-1c0a-49b8-ba03-9274d58dd31a.jpg', 140, 23, 'Chocolate', '2024-05-10', 0),
(28, 1, 'Nabati Wafer', '057873fc-a430-4d6e-a247-544fd3fe5417.jpg', 200, 11, 'Wafer', '2024-05-10', 0),
(29, 1, 'Nutella Vanilla', '73fdf131-22ae-4af5-a6e2-c7999c61b225.jpg', 140, 10, 'Spread', '2024-05-10', 0),
(30, 1, 'Gardenia', 'Classic White Bread Thick Slice 600g  The ideal….jpg', 80, 55, 'Bread', '2024-05-10', 0),
(31, 1, 'Cracklings', 'cracklings.png', 15, 100, 'Junkfood', '2024-05-13', 0),
(32, 5, 'Test 1', 'speech-bubble (1).png', 1, 5, 'Test', '2024-05-18', 0),
(33, 5, 'Test 2', 'video-player (1).png', 25, 1, 'Test', '2024-05-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaction`
--

CREATE TABLE `tbltransaction` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `transID` varchar(10) NOT NULL,
  `transDate` date NOT NULL DEFAULT current_timestamp(),
  `transTime` time NOT NULL DEFAULT current_timestamp(),
  `prodName` varchar(50) NOT NULL,
  `prodPrice` float NOT NULL,
  `prodQty` int(11) NOT NULL,
  `totalPrice` float NOT NULL,
  `totalQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltransaction`
--

INSERT INTO `tbltransaction` (`id`, `userid`, `transID`, `transDate`, `transTime`, `prodName`, `prodPrice`, `prodQty`, `totalPrice`, `totalQty`) VALUES
(99, 1, '1000000006', '2024-05-13', '14:35:35', 'Mogu Mogu', 40, 1, 43, 4),
(100, 1, '1000000006', '2024-05-13', '14:35:35', 'Moby ni Daddy Tyga', 1, 3, 43, 4),
(101, 1, '1000000008', '2024-05-13', '14:35:58', 'Nabati Wafer', 200, 1, 290, 3),
(102, 1, '1000000008', '2024-05-13', '14:35:58', 'Kinder Joy', 50, 1, 290, 3),
(103, 1, '1000000008', '2024-05-13', '14:35:58', 'Maltesers', 40, 1, 290, 3),
(104, 1, '1000000011', '2024-05-13', '14:36:58', 'Lays', 120, 1, 1000120, 2),
(105, 1, '1000000011', '2024-05-13', '14:36:58', 'John Gangster', 1000000, 1, 1000120, 2),
(106, 1, '1000000012', '2024-05-13', '14:39:17', 'Fanta / Royal', 45, 1, 165, 2),
(107, 1, '1000000012', '2024-05-13', '14:39:17', 'Lays', 120, 1, 165, 2),
(108, 1, '1000000013', '2024-05-13', '14:39:29', 'John Gangster', 1000000, 1, 1000090, 2),
(109, 1, '1000000013', '2024-05-13', '14:39:29', 'Pringles SC', 89, 1, 1000090, 2),
(113, 1, '1000000014', '2024-05-13', '15:33:23', 'Moby ni Daddy Tyga', 1, 5, 165, 7),
(114, 1, '1000000014', '2024-05-13', '15:33:23', 'Mogu Mogu', 40, 1, 165, 7),
(115, 1, '1000000014', '2024-05-13', '15:33:23', 'KitKat', 120, 1, 165, 7),
(116, 1, '1000000015', '2024-05-13', '15:34:28', 'Moby ni Daddy Tyga', 1, 2, 47, 4),
(117, 1, '1000000015', '2024-05-13', '15:34:28', 'Mogu Mogu', 40, 1, 47, 4),
(118, 1, '1000000015', '2024-05-13', '15:34:28', 'Mentos', 5, 1, 47, 4),
(119, 1, '1000000016', '2024-05-13', '15:35:05', 'Cheetos', 120, 1, 121, 2),
(120, 1, '1000000016', '2024-05-13', '15:35:05', 'Moby ni Daddy Tyga', 1, 1, 121, 2),
(121, 1, '1000000017', '2024-05-13', '15:36:56', 'Fanta / Royal', 45, 1, 1000160, 3),
(122, 1, '1000000017', '2024-05-13', '15:36:56', 'Lays', 120, 1, 1000160, 3),
(123, 1, '1000000017', '2024-05-13', '15:36:56', 'John Gangster', 1000000, 1, 1000160, 3),
(124, 1, '1000000018', '2024-05-14', '11:48:28', 'Red Bull Energy Drink', 50, 1, 50, 1),
(125, 1, '1000000019', '2024-05-17', '19:07:28', 'Cheetos', 120, 1, 587, 9),
(126, 1, '1000000019', '2024-05-17', '19:07:28', 'Red Bull Energy Drink', 50, 1, 587, 9),
(127, 1, '1000000019', '2024-05-17', '19:07:28', 'Monster Energy Drink', 50, 1, 587, 9),
(128, 1, '1000000019', '2024-05-17', '19:07:28', 'M&Ms', 30, 2, 587, 9),
(129, 1, '1000000019', '2024-05-17', '19:07:28', 'KitKat', 120, 1, 587, 9),
(130, 1, '1000000019', '2024-05-17', '19:07:28', 'Pocky Choco', 42, 1, 587, 9),
(131, 1, '1000000019', '2024-05-17', '19:07:28', 'Nutella', 130, 1, 587, 9),
(132, 1, '1000000019', '2024-05-17', '19:07:28', 'Cracklings', 15, 1, 587, 9),
(133, 1, '1000000020', '2024-05-17', '19:10:09', 'Mogu Mogu', 40, 1, 41, 2),
(134, 1, '1000000020', '2024-05-17', '19:10:09', 'Moby ni Daddy Tyga', 1, 1, 41, 2),
(135, 1, '1000000021', '2024-05-17', '19:41:23', 'Mentos', 5, 2, 60, 3),
(136, 1, '1000000021', '2024-05-17', '19:41:23', 'Monster Energy Drink', 50, 1, 60, 3),
(137, 1, '1000000022', '2024-05-17', '21:04:25', 'Cheetos', 120, 1, 126, 3),
(138, 1, '1000000022', '2024-05-17', '21:04:25', 'Mentos', 5, 1, 126, 3),
(139, 1, '1000000022', '2024-05-17', '21:04:25', 'Moby', 1, 1, 126, 3),
(140, 1, '1000000023', '2024-05-17', '21:06:17', 'Monster Energy Drink', 50, 1, 50, 1),
(141, 1, '1000000024', '2024-05-17', '22:00:53', 'Nutella', 130, 2, 310, 3),
(142, 1, '1000000024', '2024-05-17', '22:00:53', 'Red Bull Energy Drink', 50, 1, 310, 3),
(143, 1, '1000000025', '2024-05-17', '22:03:01', 'Red Bull Energy Drink', 50, 1, 100, 2),
(144, 1, '1000000025', '2024-05-17', '22:03:01', 'Monster Energy Drink', 50, 1, 100, 2),
(145, 1, '1000000026', '2024-05-17', '22:04:19', 'Cheetos', 120, 3, 360, 3),
(146, 1, '1000000027', '2024-05-17', '22:05:03', 'KitKat', 120, 1, 240, 4),
(147, 1, '1000000027', '2024-05-17', '22:05:03', 'Snickers', 40, 3, 240, 4),
(148, 1, '1000000028', '2024-05-18', '14:23:29', 'Oreo', 10, 1, 51, 3),
(149, 1, '1000000028', '2024-05-18', '14:23:29', 'Mogu Mogu', 40, 1, 51, 3),
(150, 1, '1000000028', '2024-05-18', '14:23:29', 'Moby', 1, 1, 51, 3),
(151, 5, '1000000029', '2024-05-18', '19:49:32', 'Test 1', 1, 1, 1, 1),
(152, 5, '1000000030', '2024-05-18', '20:00:07', 'Test 2', 25, 9, 226, 10),
(153, 5, '1000000030', '2024-05-18', '20:00:07', 'Test 1', 1, 1, 226, 10),
(154, 1, '1000000031', '2024-05-18', '22:21:43', 'Oreo', 10, 4, 80, 5),
(155, 1, '1000000031', '2024-05-18', '22:21:43', 'Mogu Mogu', 40, 1, 80, 5),
(156, 1, '1000000032', '2024-05-18', '22:47:28', 'Oreo', 10, 2, 438, 10),
(157, 1, '1000000032', '2024-05-18', '22:47:28', 'Pringles SC', 89, 2, 438, 10),
(158, 1, '1000000032', '2024-05-18', '22:47:28', 'M&Ms', 30, 2, 438, 10),
(159, 1, '1000000032', '2024-05-18', '22:47:28', 'Fanta / Royal', 45, 4, 438, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`userid`, `username`, `email`, `password`) VALUES
(1, 'larsdesu', 'larsdesu@gmail.com', '$2y$10$Z2HFvEMNkgunuaAP8JtbxeEkrGreKI0ymfpVmytftvkF8FJO.GQiW'),
(5, 'jmonsters', 'jmarans@gmail.com', '$2y$10$oOIXD6grkTa6iVNRp5UOO.5j1Y2evTvm0IcOagCHPPd6P5VruQvnK'),
(6, 'jhonllord', 'jll@gmail.com', '$2y$10$YHoCOQXS.txmdtdZOTrXe.72f4uCk100xTnUxx/BWsvCN4skkDeYS'),
(7, 'joshua', 'joshuajavier@gmail.com', '$2y$10$8TvqCKw19Chjm.XwizZpFe4JlbGE2nEjdXh6Dc7jIkHmaGga3tb4a'),
(8, 'asd', 'asd@gmail.com', '$2y$10$oN454HkLE4hI4HonbIEmjOD9RVRFXsRFE6H2zP2t5/IkToQjemlZi'),
(9, 'qwe', 'qweqwe@gmail.com', '$2y$10$k/QBMcuQpj9rz6ubONddGeI2DCifSDQox6WzhcayMW14mD3hsJGei');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
