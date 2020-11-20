-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: ictstu-db1.cc.swin.edu.au
-- Generation Time: Nov 20, 2020 at 09:33 AM
-- Server version: 5.5.60-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ABCLimited_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ABC_CompTable`
--

CREATE TABLE `ABC_CompTable` (
  `compNo` int(7) NOT NULL,
  `datePurchased` varchar(28) NOT NULL,
  `brand` varchar(64) NOT NULL,
  `compType` enum('Desktop','Laptop') NOT NULL,
  `os` enum('Windows','Mac') NOT NULL,
  `osVersion` varchar(28) NOT NULL,
  `ram` varchar(8) NOT NULL,
  `storage` varchar(16) NOT NULL,
  `staffName` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ABC_CompTable`
--

INSERT INTO `ABC_CompTable` (`compNo`, `datePurchased`, `brand`, `compType`, `os`, `osVersion`, `ram`, `storage`, `staffName`) VALUES
(20, '2019-03-22', 'Apple iMac', 'Desktop', 'Mac', 'Mac OS X Yosemite', '8 GB', 'HHD 1 TB', 'Fosem'),
(21, '2019-04-30', 'Apple Mac Book Pro', 'Laptop', 'Mac', 'Mac OS Catalina', '16 GB', 'SSD 512 GB', 'Jeffrey'),
(22, '2017-06-12', 'Apple Mac Book', 'Laptop', 'Mac', 'Mac OS', '8 GB', 'SSD 512 GB', 'Georgie'),
(23, '2018-07-16', 'Apple Mac Book', 'Laptop', 'Mac', 'Mac OS', '8 GB', 'SSD 256 GB', 'Jeffrey'),
(27, '2017-07-17', 'Asus ROG', 'Laptop', 'Windows', 'Win 10', '8 GB', 'SSD 512 GB', 'Lekema'),
(28, '2018-07-17', 'Razer Blade Advance', 'Laptop', 'Windows', 'Win 10 Home', '16 GB', 'SSD 256 GB', 'Fosem'),
(29, '2019-11-04', 'HP All in One', 'Desktop', 'Windows', 'Win 10 Home', '8 GB', 'HHD 1 TB', 'Joel'),
(31, '2017-07-29', 'Microsoft Surface Studio', 'Desktop', 'Windows', 'Win 10 Pro', '32 GB', 'SSD 2 TB', 'Vihif'),
(34, '2015-11-08', 'Acer Nitro 50', 'Desktop', 'Windows', 'Win 10 Pro', '16 GB', 'SSD 1156 GB', 'Quin'),
(35, '2014-11-21', 'Lenovo Idea Centre', 'Desktop', 'Windows', 'Win 10 Home', '8 GB', 'HHD 1 TB', 'Georgie'),
(37, '2012-05-17', 'iMac 2012', 'Desktop', 'Mac', 'Mac OS X', '8 GB', 'SSD 2 TB', 'Jeffrey'),
(38, '2008-08-18', 'Mac Pro', 'Desktop', 'Mac', 'Mac OS High Sierra', '16 GB', 'SSD 256 TB', 'Quin'),
(39, '2019-11-07', 'Apple iMac', 'Desktop', 'Mac', 'Mac OS X', '32 GB', 'SSD 256 GB', 'Lekema');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ABC_CompTable`
--
ALTER TABLE `ABC_CompTable`
  ADD PRIMARY KEY (`compNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ABC_CompTable`
--
ALTER TABLE `ABC_CompTable`
  MODIFY `compNo` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
