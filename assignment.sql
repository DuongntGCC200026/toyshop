-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2022 at 04:09 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` varchar(6) NOT NULL,
  `CategoryName` varchar(20) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `DescriptionCate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `Country`, `DescriptionCate`) VALUES
('CA00', 'Dior', 'France', 'Dior is one of the most luxurious fashion and cosmetics brands in the world today.'),
('CA01', 'Chanel', 'France', 'Chanel perfume is a famous perfume line of luxury, sophistication and class.'),
('CA02', 'Gucci', 'Italia', 'Gucci is one of the leading luxury fashion brands in the world');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Cusname` varchar(50) NOT NULL,
  `Identitycard` varchar(20) NOT NULL,
  `Cusphone` varchar(12) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `State` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Username`, `Password`, `Cusname`, `Identitycard`, `Cusphone`, `Address`, `State`) VALUES
('AdminTDshop', '0192023a7bbd73250516f069df18b500', 'Nguyen Thai Duong', '441982765', '0328292270', 'An Binh, Long Ho, Vinh Long', '1'),
('Username', '7fa8282ad93047a4d6fe6111c93b308a', 'Nguyen Thai Duong', '432686888', '0385741165', 'An Binh, Long Ho, Vinh Long', '0');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(6) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `DeliveryDate` datetime NOT NULL,
  `AddressDeli` varchar(100) NOT NULL,
  `PayMethod` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `OrderID` varchar(6) NOT NULL,
  `ProductID` varchar(6) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` varchar(6) NOT NULL,
  `ProductName` varchar(30) NOT NULL,
  `CategoryID` varchar(6) NOT NULL,
  `Price` bigint(20) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `SmallDes` varchar(30) NOT NULL,
  `DetailDes` varchar(100) NOT NULL,
  `ProDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `CategoryID`, `Price`, `Quantity`, `Image`, `SmallDes`, `DetailDes`, `ProDate`) VALUES
('P002', 'Dior Sauvage', 'CA00', 300, 12, '277f47b959573fa274f68ee2c763d916.jpg', 'Man', '<p>\r\n	Inspired by wild, open spaces; The vast and clear sky covers the rocky landscapes.</p>\r\n', '2022-05-13 07:29:27'),
('P003', 'Miss Dior', 'CA00', 124, 21, 'Dior1.jpg', 'Woman', '<p>\r\n	Pursuing a gentle style charmed by lovely sweet pink tones.</p>\r\n', '2022-05-13 07:32:24'),
('P004', 'Mademoiselle', 'CA01', 123, 43, 'download.jpg', 'Woman', '<p>\r\n	The scent of a free and seductive woman.</p>\r\n', '2022-05-13 07:40:43'),
('P005', 'Dior Hypnotic', 'CA00', 321, 32, 'Dior - Hypnotic Poison.jpg', 'Woman', '<p>\r\n	The product belongs to the group of seductive oriental floral fragrances.</p>\r\n', '2022-05-13 07:35:34'),
('P006', 'Bleu De Chanel', 'CA01', 400, 19, 'Chanel - Bleu.jpg', 'Man', '<p>\r\n	BLEU DE CHANEL Parfum is a passionate and vibrant woody scent.</p>\r\n', '2022-05-13 07:24:38'),
('P007', 'Gucci Flora', 'CA02', 399, 15, 'GucciFlora.jpg', 'Woman', '<p>\r\n	<span class=\"JLqJ4b ChMk0b\" data-language-for-alternatives=\"en\" data-language-to-translate-int', '2022-05-14 09:34:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `Index_Username` (`Username`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD UNIQUE KEY `Index_OrderID` (`OrderID`),
  ADD KEY `Index_ProductID` (`ProductID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `Index_Cate` (`CategoryID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `customer` (`Username`);

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
