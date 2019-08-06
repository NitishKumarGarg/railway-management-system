-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2019 at 07:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `Index` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`Index`, `username`, `password`) VALUES
(1, 'Nitish', '12345'),
(2, 'Ayush', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `TrainNumber` int(11) NOT NULL,
  `StopNumber` int(11) NOT NULL,
  `StationName` varchar(15) NOT NULL,
  `ArrivalTime` datetime NOT NULL,
  `DepartureTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`TrainNumber`, `StopNumber`, `StationName`, `ArrivalTime`, `DepartureTime`) VALUES
(100000, 1, 'New Delhi', '2017-03-23 20:30:00', '2017-03-23 20:35:00'),
(100000, 2, 'Aligarh Junc', '2017-03-23 22:32:00', '2017-03-23 22:34:00'),
(100000, 3, 'Kanpur Central', '2017-03-24 02:40:00', '2017-03-24 02:45:00'),
(100000, 4, 'Allahabad Junc', '2017-03-24 05:30:00', '2017-03-24 05:55:00'),
(100000, 5, 'Gyanpur Road', '2017-03-24 07:02:00', '2017-03-24 07:04:00'),
(100000, 6, 'Bhulanpur', '2017-03-24 08:00:00', '2017-03-24 08:01:00'),
(100000, 7, 'Varanasi Junc', '2017-03-24 08:25:00', '2017-03-24 08:35:00'),
(100000, 8, 'Aunrihar Junc', '2017-03-24 09:18:00', '2017-03-24 09:20:00'),
(100000, 9, 'Ghazipur City', '2017-03-24 09:50:00', '2017-03-24 09:55:00'),
(100000, 10, 'Yusufpur', '2017-03-24 10:15:00', '2017-03-24 10:17:00'),
(100000, 11, 'Ballia', '2017-03-24 11:05:00', '2017-03-24 11:10:00'),
(100000, 12, 'Suraimanpur', '2017-03-24 11:43:00', '2017-03-24 11:45:00'),
(100000, 13, 'Chhapra', '2017-03-24 12:45:00', '2017-03-24 13:00:00'),
(100000, 14, 'Sonpur Junc', '2017-03-24 13:53:00', '2017-03-24 13:55:00'),
(100000, 15, 'Hajipur Junc', '2017-03-24 14:08:00', '2017-03-24 14:10:00'),
(100000, 16, 'MuzaffarpurJunc', '2017-03-24 15:25:00', '2017-03-24 15:30:00'),
(100000, 17, 'Samastipur Junc', '2017-03-24 16:35:00', '2017-03-24 17:00:00'),
(100000, 18, 'Darbhanga Junc', '2017-03-24 17:50:00', '2017-03-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `pnr` int(11) NOT NULL,
  `passenger_name` varchar(40) NOT NULL,
  `TrainNumber` int(11) NOT NULL,
  `no_of_seats` int(11) NOT NULL,
  `train_status` varchar(20) NOT NULL,
  `booking_date` date NOT NULL,
  `booked_on` datetime NOT NULL,
  `flexible` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `TrainNumber` int(6) NOT NULL,
  `TrainName` varchar(50) NOT NULL,
  `Start` varchar(20) NOT NULL,
  `End` varchar(20) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`TrainNumber`, `TrainName`, `Start`, `End`, `Category`, `price`) VALUES
(13542, 'LKO-Delhi Rajdhani', 'Lucknow', 'Delhi', 'Express', 800),
(13541, 'Delhi-LKO Rajdhani', 'Delhi', 'Lucknow', 'Express', 875),
(15521, 'Gorukhpur-Gonda Intercity', 'Gorukhpur', 'Gonda', 'Intercity', 350);

-- --------------------------------------------------------

--
-- Table structure for table `train_status`
--

CREATE TABLE `train_status` (
  `TrainNumber` int(11) NOT NULL,
  `available_seats` int(11) NOT NULL,
  `booked_seats` int(11) NOT NULL,
  `available_Date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `train_status`
--

INSERT INTO `train_status` (`TrainNumber`, `available_seats`, `booked_seats`, `available_Date`) VALUES
(15521, 10, -6, '2019-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `UserEmail` varchar(60) NOT NULL,
  `UserPass` varchar(255) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `Age` int(11) NOT NULL,
  `Mobile` bigint(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `UserName`, `UserEmail`, `UserPass`, `Gender`, `Age`, `Mobile`, `City`, `State`) VALUES
(20, 'Nitish', 'abc@gmail.com', '12345', 'M', 20, 1234567890, 'Lucknow', 'Uttar Pradesh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`Index`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`TrainNumber`,`StopNumber`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`pnr`);

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`TrainNumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `userEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `Index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `StopNumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
