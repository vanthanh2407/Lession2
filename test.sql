-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2022 at 07:18 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `madm` int(11) NOT NULL,
  `tendm` text NOT NULL,
  PRIMARY KEY (`madm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`madm`, `tendm`) VALUES
(1, '\nĐiện thoại'),
(3, 'Laptop'),
(4, 'Phụ kiện');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `masp` int(11) NOT NULL AUTO_INCREMENT,
  `tensp` text NOT NULL,
  `madm` int(11) NOT NULL,
  `hinh` text NOT NULL,
  PRIMARY KEY (`masp`),
  KEY `fk_sp_dm` (`madm`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`masp`, `tensp`, `madm`, `hinh`) VALUES
(1, 'Samsung Galaxy S22', 1, 'SamsungS22.jpg'),
(2, 'Iphone 13 pro max 256GB', 1, 'Iphone13.jpg'),
(3, 'Macbook Pro 14 inch 2021', 3, 'Macbook Pro 14 inch 2021.jpg'),
(4, 'Macbook Pro 16 inch 2021', 3, 'Macbook Pro 16 inch 2021.jpg'),
(5, 'Laptop Lenovo Thinkbook 15 G2 ITL', 3, 'LenovoThinkbook.jpg'),
(6, 'Laptop Lenovo Legion 5 15ACH6 82JU00DFVN', 3, 'LenovoLegion.jpg'),
(7, 'Laptop Asus Gaming Rog Strix Scar 17 G733ZX LL016W', 3, 'Laptop Asus Gaming Rog Strix Scar 17 G733ZX LL016W.jpg'),
(8, 'Laptop Asus Rog Flow X13 GV301QC K6082T', 3, 'Laptop Asus Rog Flow X13 GV301QC K6082T.jpg'),
(9, 'Pin dự phòng Apple Magsafe', 4, 'Pin dự phòng Apple Magsafe.jpg'),
(10, 'Pin dự phòng Anker PowerCore Select 10000mAh A1223', 4, 'Pin dự phòng Anker PowerCore Select 10000mAh A1223.jpg'),
(11, 'Bàn phím Bluetooth Logitech K380', 4, 'Bàn phím Bluetooth Logitech K380.jpg'),
(12, 'Chuột không dây Logitech M331', 4, 'Chuột không dây Logitech M331.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_sp_dm` FOREIGN KEY (`madm`) REFERENCES `category` (`madm`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
