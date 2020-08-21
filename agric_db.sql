-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2017 at 07:14 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agric_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE IF NOT EXISTS `bids` (
`bid_id` int(11) NOT NULL,
  `Farm_Id` int(11) NOT NULL,
  `Buyer_Id` int(11) NOT NULL,
  `b_m_id` int(11) NOT NULL,
  `bid_read` int(1) NOT NULL DEFAULT '0',
  `bid_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE IF NOT EXISTS `buyer` (
`Buyer_Id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact_number` varchar(45) NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`Buyer_Id`, `username`, `password`, `full_name`, `contact_number`, `region`, `district`, `town`) VALUES
(1, 'CBCGh', '6eea9b7ef19179a06954edd0f6c05ceb', 'Cocoa Buying Company', '0261213122', 'Eastern Region', 'Akuapem South', 'Adowso');

-- --------------------------------------------------------

--
-- Table structure for table `buyer_market`
--

CREATE TABLE IF NOT EXISTS `buyer_market` (
`b_m_id` int(11) NOT NULL,
  `deadline_day` int(2) NOT NULL,
  `deadline_month` varchar(20) NOT NULL,
  `deadline_year` int(4) NOT NULL,
  `description` text NOT NULL,
  `time_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Buyer_Id` int(11) NOT NULL,
  `quantity` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buyer_market`
--

INSERT INTO `buyer_market` (`b_m_id`, `deadline_day`, `deadline_month`, `deadline_year`, `description`, `time_posted`, `Buyer_Id`, `quantity`) VALUES
(3, 2, 'July', 2017, 'Agric and local Palm nut', '2017-04-04 16:58:46', 1, '10 baskets');

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE IF NOT EXISTS `farmer` (
`Farm_Id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `gender` varchar(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`Farm_Id`, `username`, `password`, `full_name`, `contact_number`, `region`, `district`, `town`, `gender`) VALUES
(1, 'maryasabre', '6eea9b7ef19179a06954edd0f6c05ceb', 'Mary Asabre', '0231212212', 'Eastern Region', 'Akuapem South', 'Adowso', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_market`
--

CREATE TABLE IF NOT EXISTS `farmer_market` (
`f_m_id` int(11) NOT NULL,
  `Farm_Id` int(11) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `farmer_market`
--

INSERT INTO `farmer_market` (`f_m_id`, `Farm_Id`, `quantity`, `description`, `date_posted`) VALUES
(1, 1, '100 boxes', 'Okro fresh from the farm', '2017-03-31 15:50:45'),
(2, 1, '400 bags', 'Fresh of the farm pepper with just two days of storage.', '2017-03-31 21:24:30'),
(3, 1, '4000 kilos', 'Locally grown pineapple', '2017-04-01 07:07:27'),
(6, 1, '20 baskets', 'Cucumber and assorted vegetables fresh of the farm.', '2017-04-01 16:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_pictures`
--

CREATE TABLE IF NOT EXISTS `product_pictures` (
`pic_id` int(11) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `f_m_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_pictures`
--

INSERT INTO `product_pictures` (`pic_id`, `file_name`, `f_m_id`) VALUES
(1, 'okro.jpg', 1),
(2, 'Agriculture.jpg', 1),
(3, '1001181246_1_644x461_green-pepper-bag-of-green-pepper-agric-produce-farm-produce-odi-olowo-ojuwoye.jpg', 2),
(4, '1001181279_1_261x203_pepper-atarodo-basket-of-fresh-pepper-farm-produce-agric-products-ikeja.jpg', 2),
(5, 'farmers.jpg', 3),
(7, '1001181411_1_644x461_cucumber-bag-of-cucumber-of-fresh-farm-produce-agric-produce-ikeja.jpg', 6),
(10, 'agric-produce-2.jpg', 0),
(11, 'agric-produce-2.jpg', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
 ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
 ADD PRIMARY KEY (`Buyer_Id`);

--
-- Indexes for table `buyer_market`
--
ALTER TABLE `buyer_market`
 ADD PRIMARY KEY (`b_m_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
 ADD PRIMARY KEY (`Farm_Id`);

--
-- Indexes for table `farmer_market`
--
ALTER TABLE `farmer_market`
 ADD PRIMARY KEY (`f_m_id`);

--
-- Indexes for table `product_pictures`
--
ALTER TABLE `product_pictures`
 ADD PRIMARY KEY (`pic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
MODIFY `Buyer_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `buyer_market`
--
ALTER TABLE `buyer_market`
MODIFY `b_m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
MODIFY `Farm_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `farmer_market`
--
ALTER TABLE `farmer_market`
MODIFY `f_m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product_pictures`
--
ALTER TABLE `product_pictures`
MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
