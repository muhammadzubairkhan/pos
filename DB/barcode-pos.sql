-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2017 at 11:31 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barcode-pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(5) NOT NULL,
  `customer_ord_id` varchar(255) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_datetime` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_ord_id`, `customer_name`, `customer_contact`, `customer_datetime`) VALUES
(1, '1496642686736', 'Zubair', '03343660911', '2017-06-05'),
(2, '1496642686736', 'Zubair', '03343660911', '2017-06-05'),
(3, '1496642686736', 'Zubair', '03343660911', '2017-06-05'),
(4, '1496642686736', 'Zubair', '03343660911', '2017-06-05'),
(5, '1496642686736', 'Zubair', '03343660911', '2017-06-05'),
(6, '1496642686736', 'Zubair', '03343660911', '2017-06-05'),
(7, '1496643643600', 'Zubair', '03343660911', '2017-06-05'),
(8, '1496643643600', 'Zubair', '03343660911', '2017-06-05'),
(9, '1496643643600', 'Zubair', '03343660911', '2017-06-05'),
(10, '1496644846801', 'Uzair', '03343660911', '2017-06-05'),
(11, '1496651210488', 'Osama', '03343660911', '2017-06-05'),
(12, '1496651210488', 'osama', '03343660911', '2017-06-05'),
(13, '1496654971235', 'Talal', '03343660911', '2017-06-05'),
(14, '1496729013686', 'Zubair', '0334313123123', '2017-06-06'),
(15, '1496729225450', 'Zohaib', '03343660911', '2017-06-06'),
(16, '1496729462883', 'Sajjad', '03343660911', '2017-06-06'),
(17, '1496729597406', 'asdasdasd', '123123123', '2017-06-06'),
(18, '1496729801759', 'aaaaa', '1123123123', '2017-06-06'),
(19, '1496729874841', 'dfgdfg', '123123', '2017-06-06'),
(20, '1496813844385', 'Amir', '03343660911', '2017-06-07'),
(21, '1496814030133', 'Order', '123123123', '2017-06-07'),
(22, '1496833006226', 'Sajjad', '03343660911', '2017-06-07'),
(23, '1497248467556', '', '', '2017-06-12'),
(24, '1497254657468', 'Zohaib', '03343660911', '2017-06-12'),
(25, '1497261118605', 'asdasd', 'asdasdasdasd', '2017-06-12'),
(26, '1497262101761', 'asdasd', '123123', '2017-06-12'),
(27, '1497334782495', 'Zubair', '03343660911', '2017-06-13'),
(28, '1497335220127', 'Syed Zohaib', '03343660911', '2017-06-13'),
(29, '1497336501360', 'asd', '123123', '2017-06-13'),
(30, '1497338886764', '', '', '2017-06-13'),
(31, '1497340713065', 'Syed Zohaib Ali', '03343660911', '2017-06-13'),
(32, '1497341577346', 'Zubair Khan ', '03343660911', '2017-06-13'),
(33, '1497349029866', '', '', '2017-06-13'),
(34, '1497349140779', 'asdasd', '123123', '2017-06-13'),
(35, '1497349654176', '', '', '2017-06-13'),
(36, '1497349672506', 'sfs', '234234', '2017-06-13'),
(37, '1497351123348', '', '', '2017-06-13'),
(38, '1497351875459', 'dfgdfg', '3453453', '2017-06-13'),
(39, '1497353274118', 'Osama Iqbal', '03343660911', '2017-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `damage`
--

CREATE TABLE `damage` (
  `id` int(10) NOT NULL,
  `workperiod_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `no_of_damages` int(50) NOT NULL,
  `date_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `workperiod_id` int(50) NOT NULL,
  `discount_price` int(50) NOT NULL,
  `total_price` int(50) NOT NULL,
  `date_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `workperiod_id`, `discount_price`, `total_price`, `date_time`) VALUES
(1, 15, 44, 440, '2017-05-25'),
(2, 15, 30, 295, '2017-05-25'),
(3, 15, 30, 295, '2017-05-25'),
(4, 15, 22, 440, '2017-05-25'),
(5, 15, 225, 2250, '2017-05-26'),
(6, 15, 38, 750, '2017-05-26'),
(7, 15, 38, 750, '2017-05-26'),
(8, 15, 38, 750, '2017-05-26'),
(9, 15, 31, 445, '2017-05-26'),
(10, 15, 27, 445, '2017-05-26'),
(11, 15, 31, 445, '2017-05-26'),
(12, 15, 24, 295, '2017-05-26'),
(13, 16, 15, 295, '2017-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `quantity` float NOT NULL,
  `status` int(5) DEFAULT NULL,
  `notify` int(2) DEFAULT '0',
  `lastupdated_on` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `name`, `quantity`, `status`, `notify`, `lastupdated_on`) VALUES
(1, 'Item 1', -140, 0, 1, '2017-05-20 16:55:23');

-- --------------------------------------------------------

--
-- Table structure for table `manageinventory`
--

CREATE TABLE `manageinventory` (
  `id` int(12) NOT NULL,
  `inventory_id` int(12) NOT NULL,
  `product_id` int(12) NOT NULL,
  `deducted_qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manageinventory`
--

INSERT INTO `manageinventory` (`id`, `inventory_id`, `product_id`, `deducted_qty`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `category_id` int(11) NOT NULL,
  `cat_name` varchar(40) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`category_id`, `cat_name`, `created_at`) VALUES
(1, 'Item 11', NULL),
(2, 'Item 2', NULL),
(3, 'Item 2', NULL),
(4, 'Item 3', NULL),
(5, 'Item 4', NULL),
(6, 'Item 5', NULL),
(7, 'Item 4', NULL),
(8, 'Item 5', NULL),
(9, 'Item 6', NULL),
(10, 'Item 6', NULL),
(11, 'Item 7', NULL),
(12, 'Item 8', NULL),
(14, 'Item 9', NULL),
(15, 'Item 10', NULL),
(16, 'Item 2', NULL),
(18, 'Item 5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_products`
--

CREATE TABLE `menu_products` (
  `p_id` int(5) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_price` varchar(20) NOT NULL,
  `discount_percent` varchar(255) NOT NULL,
  `cat_id` varchar(20) NOT NULL,
  `p_barcode` varchar(255) NOT NULL,
  `is_available` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_products`
--

INSERT INTO `menu_products` (`p_id`, `p_name`, `p_price`, `discount_percent`, `cat_id`, `p_barcode`, `is_available`) VALUES
(1, 'Product 1', '150', '40', '1', '1234567899992', NULL),
(2, 'Product 2', '145', '10', '2', '1234567890128', NULL),
(3, 'Product 3', '200', '20', '1', '1234567890121', NULL),
(4, 'New Product', '150', '50', '2', '123541111', NULL),
(5, 'New Product 1', '150', '40', '1', '123123123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `workperiod_id` int(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_time` varchar(255) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `customer_id`, `workperiod_id`, `quantity`, `date_time`, `status`) VALUES
(1, 1, '', 11, 2, '2017-05-21', '2'),
(2, 1, '1495362067109', 12, 1, '2017-05-21', '2'),
(3, 1, '1495362124847', 13, 0, '2017-05-21', '2'),
(4, 1, '1495362359583', 13, 1, '2017-05-21', '2'),
(5, 1, '1495432343198', 13, 1, '2017-05-22', '2'),
(6, 2, '1495432343198', 13, 1, '2017-05-22', '2'),
(7, 1, '1495432667461', 13, 2, '2017-05-22', '2'),
(8, 1, '1495432667461', 13, 2, '2017-05-22', '2'),
(9, 2, '1495432667461', 13, 1, '2017-05-22', '2'),
(10, 1, '1495434869938', 13, 2, '2017-05-22', '2'),
(11, 2, '1495434869938', 13, 2, '2017-05-22', '2'),
(12, 1, '1495437151901', 14, 2, '2017-05-22', '2'),
(13, 1, '1495704866107', 14, 1, '2017-05-25', '2'),
(14, 1, '1495704915843', 15, 2, '2017-05-25', '2'),
(15, 2, '1495704915843', 15, 2, '2017-05-25', '2'),
(16, 1, '1495722705882', 15, 1, '2017-05-25', '2'),
(17, 2, '1495722705882', 15, 1, '2017-05-25', '2'),
(18, 1, '1495722894400', 15, 1, '2017-05-25', '2'),
(19, 2, '1495722894400', 15, 2, '2017-05-25', '2'),
(20, 2, '1495722894400', 15, 2, '2017-05-25', '2'),
(21, 1, '1495724599441', 15, 1, '2017-05-25', '2'),
(22, 2, '1495724599441', 15, 2, '2017-05-25', '2'),
(23, 1, '1495727205312', 15, 3, '2017-05-25', '2'),
(24, 1, '1495782057210', 15, 7, '2017-05-26', '2'),
(25, 1, '1495782057210', 15, 7, '2017-05-26', '2'),
(26, 1, '1495800201666', 15, 1, '2017-05-26', '2'),
(27, 2, '1495800201666', 15, 2, '2017-05-26', '2'),
(28, 1, '1495800603085', 15, 1, '2017-05-26', '2'),
(29, 2, '1495800603085', 15, 2, '2017-05-26', '2'),
(30, 1, '1495800951741', 15, 1, '2017-05-26', '2'),
(31, 2, '1495800951741', 15, 2, '2017-05-26', '2'),
(32, 1, '1495801260637', 15, 2, '2017-05-26', '2'),
(33, 2, '1495801260637', 15, 1, '2017-05-26', '2'),
(34, 1, '1495801260637', 15, 2, '2017-05-26', '2'),
(35, 2, '1495801260637', 15, 1, '2017-05-26', '2'),
(36, 1, '1495803029388', 15, 3, '2017-05-26', '2'),
(37, 2, '1495803029388', 15, 2, '2017-05-26', '2'),
(38, 1, '1495803029388', 15, 3, '2017-05-26', '2'),
(39, 2, '1495803029388', 15, 3, '2017-05-26', '2'),
(40, 1, '1495807425335', 15, 1, '2017-05-26', '2'),
(41, 2, '1495807425335', 15, 1, '2017-05-26', '2'),
(42, 1, '1495810715374', 16, 2, '2017-05-26', '2'),
(43, 2, '1495810715374', 16, 2, '2017-05-26', '2'),
(44, 1, '1495811441110', 16, 1, '2017-05-26', '2'),
(45, 2, '1495811441110', 16, 2, '2017-05-26', '2'),
(46, 1, '1495811958267', 16, 1, '2017-05-26', '2'),
(47, 2, '1495811958267', 16, 2, '2017-05-26', '2'),
(48, 1, '1495812214269', 16, 1, '2017-05-26', '2'),
(49, 2, '1495812214269', 16, 1, '2017-05-26', '2'),
(50, 1, '1495893037487', 16, 1, '2017-05-27', '2'),
(51, 2, '1495893037487', 16, 1, '2017-05-27', '2'),
(52, 2, '1495893037487', 16, 1, '2017-05-27', '2'),
(53, 2, '1495893037487', 16, 1, '2017-05-27', '2'),
(54, 1, '1495893037487', 16, 1, '2017-05-27', '2'),
(55, 1, '1495893037487', 16, 1, '2017-05-27', '2'),
(56, 2, '1495893037487', 16, 1, '2017-05-27', '2'),
(57, 1, '1495893456384', 17, 1, '2017-05-27', '2'),
(58, 2, '1495893456384', 17, 1, '2017-05-27', '2'),
(59, 1, '1496036216898', 17, 1, '2017-05-29', '2'),
(60, 2, '1496036216898', 17, 1, '2017-05-29', '2'),
(61, 1, '1496036273710', 17, 5, '2017-05-29', '2'),
(62, 1, '1496036327518', 18, 2, '2017-05-29', '2'),
(63, 1, '1496037618875', 19, 1, '2017-05-29', '2'),
(64, 2, '1496037618875', 19, 1, '2017-05-29', '2'),
(65, 1, '1496038121562', 20, 1, '2017-05-29', '2'),
(66, 1, '1496038156914', 21, 1, '2017-05-29', '2'),
(67, 1, '1496038599746', 22, 1, '2017-05-29', '2'),
(68, 2, '1496038599746', 22, 1, '2017-05-29', '2'),
(69, 1, '1496038783951', 23, 1, '2017-05-29', '2'),
(70, 2, '1496038783951', 23, 1, '2017-05-29', '2'),
(71, 1, '1496039472185', 24, 1, '2017-05-29', '2'),
(72, 2, '1496039472185', 24, 1, '2017-05-29', '2'),
(73, 1, '1496039713980', 25, 1, '2017-05-29', '2'),
(74, 2, '1496039713980', 25, 1, '2017-05-29', '2'),
(75, 2, '1496041464698', 25, 1, '2017-05-29', '2'),
(76, 1, '1496041464698', 25, 1, '2017-05-29', '2'),
(77, 1, '1496041759858', 25, 4, '2017-05-29', '2'),
(78, 2, '1496041759858', 25, 1, '2017-05-29', '2'),
(79, 1, '1496641687969', 25, 1, '2017-06-05', '2'),
(80, 3, '1496641687969', 25, 1, '2017-06-05', '2'),
(81, 1, '1496642686736', 25, 1, '2017-06-05', '2'),
(82, 3, '1496642686736', 25, 2, '2017-06-05', '2'),
(83, 1, '1496643643600', 25, 1, '2017-06-05', '2'),
(84, 3, '1496643643600', 25, 2, '2017-06-05', '2'),
(85, 1, '1496644846801', 25, 1, '2017-06-05', '2'),
(86, 3, '1496644846801', 25, 1, '2017-06-05', '2'),
(87, 1, '1496650255433', 25, 3, '2017-06-05', '2'),
(88, 5, '1496650255433', 25, 2, '2017-06-05', '2'),
(89, 1, '1496650585415', 25, 1, '2017-06-05', '2'),
(90, 3, '1496650585415', 25, 3, '2017-06-05', '2'),
(91, 1, '1496650673953', 25, 1, '2017-06-05', '2'),
(92, 3, '1496650673953', 25, 2, '2017-06-05', '2'),
(93, 1, '1496651016964', 25, 1, '2017-06-05', '2'),
(94, 3, '1496651016964', 25, 3, '2017-06-05', '2'),
(95, 1, '1496651210488', 25, 2, '2017-06-05', '2'),
(96, 3, '1496651210488', 25, 1, '2017-06-05', '2'),
(97, 1, '1496654971235', 25, 3, '2017-06-05', '2'),
(98, 3, '1496654971235', 25, 1, '2017-06-05', '2'),
(99, 1, '1496655717173', 25, 1, '2017-06-05', '2'),
(100, 3, '1496655717173', 25, 1, '2017-06-05', '2'),
(101, 1, '1496728773743', 25, 1, '2017-06-06', '2'),
(102, 3, '1496728773743', 25, 1, '2017-06-06', '2'),
(103, 1, '1496729013686', 25, 1, '2017-06-06', '2'),
(104, 3, '1496729013686', 25, 2, '2017-06-06', '2'),
(105, 1, '1496729225450', 25, 1, '2017-06-06', '2'),
(106, 3, '1496729225450', 25, 2, '2017-06-06', '2'),
(107, 1, '1496729462883', 25, 1, '2017-06-06', '2'),
(108, 3, '1496729462883', 25, 3, '2017-06-06', '2'),
(109, 1, '1496729597406', 25, 4, '2017-06-06', '2'),
(110, 3, '1496729597406', 25, 3, '2017-06-06', '2'),
(111, 1, '1496729801759', 25, 2, '2017-06-06', '2'),
(112, 3, '1496729801759', 25, 2, '2017-06-06', '2'),
(113, 1, '1496729874841', 25, 1, '2017-06-06', '2'),
(114, 3, '1496729874841', 25, 1, '2017-06-06', '2'),
(115, 1, '1496813844385', 25, 1, '2017-06-07', '2'),
(116, 5, '1496813844385', 25, 1, '2017-06-07', '2'),
(117, 1, '1496814030133', 25, 1, '2017-06-07', '2'),
(118, 2, '1496814030133', 25, 1, '2017-06-07', '2'),
(119, 5, '1496814030133', 25, 1, '2017-06-07', '2'),
(120, 1, '1496833006226', 25, 1, '2017-06-07', '2'),
(121, 3, '1496833006226', 25, 1, '2017-06-07', '2'),
(122, 1, '1497248467556', 25, 1, '2017-06-12', '2'),
(123, 3, '1497248467556', 25, 2, '2017-06-12', '2'),
(124, 1, '1497253776055', 25, 1, '2017-06-12', '2'),
(125, 3, '1497253776055', 25, 2, '2017-06-12', '2'),
(126, 1, '1497254657468', 26, 2, '2017-06-12', '2'),
(127, 3, '1497254657468', 26, 1, '2017-06-12', '2'),
(128, 3, '1497261118605', 26, 2, '2017-06-12', '2'),
(129, 1, '1497262101761', 26, 1, '2017-06-12', '2'),
(130, 3, '1497262101761', 26, 1, '2017-06-12', '2'),
(131, 5, '1497262101761', 26, 1, '2017-06-12', '2'),
(132, 1, '1497334782495', 26, 1, '2017-06-13', '2'),
(133, 3, '1497334782495', 26, 1, '2017-06-13', '2'),
(134, 5, '1497334782495', 26, 2, '2017-06-13', '2'),
(135, 1, '1497335220127', 26, 2, '2017-06-13', '2'),
(136, 3, '1497335220127', 26, 3, '2017-06-13', '2'),
(137, 1, '1497336501360', 26, 1, '2017-06-13', '2'),
(138, 3, '1497336501360', 26, 1, '2017-06-13', '2'),
(139, 1, '1497338886764', 26, 2, '2017-06-13', '2'),
(140, 3, '1497338886764', 26, 2, '2017-06-13', '2'),
(141, 5, '1497338886764', 26, 2, '2017-06-13', '2'),
(142, 1, '1497340713065', 26, 2, '2017-06-13', '2'),
(143, 3, '1497340713065', 26, 3, '2017-06-13', '2'),
(144, 5, '1497340713065', 26, 2, '2017-06-13', '2'),
(145, 1, '1497341577346', 26, 2, '2017-06-13', '2'),
(146, 3, '1497341577346', 26, 3, '2017-06-13', '2'),
(147, 5, '1497341577346', 26, 2, '2017-06-13', '2'),
(148, 1, '1497349140779', 26, 1, '2017-06-13', '2'),
(149, 1, '1497349672506', 26, 2, '2017-06-13', '2'),
(150, 5, '1497349672506', 26, 2, '2017-06-13', '2'),
(151, 1, '1497351252052', 26, 1, '2017-06-13', '2'),
(152, 3, '1497351252052', 26, 1, '2017-06-13', '2'),
(153, 5, '1497351252052', 26, 1, '2017-06-13', '2'),
(154, 1, '1497351422255', 26, 1, '2017-06-13', '2'),
(155, 3, '1497351422255', 26, 1, '2017-06-13', '2'),
(156, 5, '1497351422255', 26, 1, '2017-06-13', '2'),
(157, 1, '1497351509794', 26, 1, '2017-06-13', '2'),
(158, 3, '1497351509794', 26, 1, '2017-06-13', '2'),
(159, 5, '1497351509794', 26, 1, '2017-06-13', '2'),
(160, 1, '1497351556042', 26, 1, '2017-06-13', '2'),
(161, 3, '1497351556042', 26, 1, '2017-06-13', '2'),
(162, 5, '1497351556042', 26, 1, '2017-06-13', '2'),
(163, 1, '1497351875459', 26, 1, '2017-06-13', '2'),
(164, 3, '1497351875459', 26, 1, '2017-06-13', '2'),
(165, 5, '1497351875459', 26, 1, '2017-06-13', '2'),
(166, 1, '1497353274118', 26, 1, '2017-06-13', '1'),
(167, 2, '1497353274118', 26, 1, '2017-06-13', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pos_config`
--

CREATE TABLE `pos_config` (
  `id` int(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_image` varchar(255) NOT NULL,
  `company_pdf_image` varchar(255) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  `last_updated` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_config`
--

INSERT INTO `pos_config` (`id`, `company_name`, `company_image`, `company_pdf_image`, `is_deleted`, `last_updated`) VALUES
(1, 'Catchy Attire', 'icons/pos_logo.png', 'reports/logo.png', '0', '2017-05-22 12:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `pos_printer`
--

CREATE TABLE `pos_printer` (
  `id` int(10) NOT NULL,
  `printer_name` varchar(255) NOT NULL,
  `printer_ip` varchar(255) NOT NULL,
  `printer_port` varchar(255) NOT NULL,
  `last_updated` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pos_printer`
--

INSERT INTO `pos_printer` (`id`, `printer_name`, `printer_ip`, `printer_port`, `last_updated`) VALUES
(1, 'POS80', '172.16.1.244', '9100', '2017-05-25 14:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_tables`
--

CREATE TABLE `restaurant_tables` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `takeaway`
--

CREATE TABLE `takeaway` (
  `id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `workperiod_id` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `date_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) NOT NULL,
  `USER_NAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `USER_NAME`, `PASSWORD`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `waiters`
--

CREATE TABLE `waiters` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(5) DEFAULT '25'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_periods`
--

CREATE TABLE `work_periods` (
  `workperiod_id` int(20) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_periods`
--

INSERT INTO `work_periods` (`workperiod_id`, `status`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damage`
--
ALTER TABLE `damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `manageinventory`
--
ALTER TABLE `manageinventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `menu_products`
--
ALTER TABLE `menu_products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pos_config`
--
ALTER TABLE `pos_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_printer`
--
ALTER TABLE `pos_printer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_tables`
--
ALTER TABLE `restaurant_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `takeaway`
--
ALTER TABLE `takeaway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `waiters`
--
ALTER TABLE `waiters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_periods`
--
ALTER TABLE `work_periods`
  ADD PRIMARY KEY (`workperiod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `damage`
--
ALTER TABLE `damage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `manageinventory`
--
ALTER TABLE `manageinventory`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `menu_products`
--
ALTER TABLE `menu_products`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT for table `pos_config`
--
ALTER TABLE `pos_config`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pos_printer`
--
ALTER TABLE `pos_printer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `work_periods`
--
ALTER TABLE `work_periods`
  MODIFY `workperiod_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
