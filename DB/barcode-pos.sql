-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2018 at 12:08 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `category_id` int(11) NOT NULL,
  `cat_name` varchar(40) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 'Pizza Yumm\'s', 'icons/pos_logo.png', 'reports/logo.png', '0', '2017-05-22 12:18:52');

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
(1, 'POS9', '172.16.1.244', '9100', '2017-05-25 14:11:09');

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage`
--
ALTER TABLE `damage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manageinventory`
--
ALTER TABLE `manageinventory`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_products`
--
ALTER TABLE `menu_products`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `workperiod_id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
