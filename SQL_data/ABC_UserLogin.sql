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
-- Table structure for table `ABC_UserLogin`
--

CREATE TABLE `ABC_UserLogin` (
  `userID` varchar(8) NOT NULL,
  `email` varchar(35) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(35) NOT NULL,
  `role` enum('Admin','Viewer') NOT NULL,
  `passwd` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ABC_UserLogin`
--

INSERT INTO `ABC_UserLogin` (`userID`, `email`, `firstName`, `lastName`, `role`, `passwd`) VALUES
('Cha2528', 'jeffchan112@dmailpro.net', 'Jeffrey', 'Chan', 'Viewer', 'Cha9507O'),
('Dir3880', 'fosem35252@mail8app.com', 'Fosem', 'Dirken', 'Viewer', 'Dir4974g'),
('Gan1455', 'jolega6789@netmail8.com', 'Joel', 'Gandha', 'Viewer', 'Gan5049r'),
('Hid3744', 'hidoge5707@imailto.net', 'Georgie', 'Hidkenmurkh', 'Admin', 'Hid9216n'),
('jac4370', 'jack@gs.sq', '\'test\'', 'jack;', 'Viewer', 'jac8641L'),
('McC1911', 'bihifi1856@7dmail.com', 'Jack', 'McCliffton', 'Viewer', 'McC1931k'),
('McD1996', 'vihif11384@7dmail.com', 'Vihif', 'McDoon', 'Admin', 'McD2173H'),
('Ras2250', 'nayar54851@3dmail.top', 'Nayaramna', 'Rashj', 'Viewer', 'Ras2634j'),
('Tap2177', 'qtap0092@dmailpro.net', 'Quin', 'Taple', 'Admin', 'Tap5620f'),
('Xem3393', 'lekexe7844@imailto.net', 'Lekema', 'Xem', 'Viewer', 'Xem1528V');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ABC_UserLogin`
--
ALTER TABLE `ABC_UserLogin`
  ADD PRIMARY KEY (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
