-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2020 at 01:05 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `concertplannerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `first_name`, `surname`, `password`) VALUES
('Admin1', 'John', 'Smith', 'Password1'),
('Admin2', 'Jane', 'Doe', 'Password2');

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--

CREATE TABLE `attendee` (
  `mobile_phone` varchar(15) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`mobile_phone`, `first_name`, `surname`, `dob`, `password`) VALUES
('+49 439 654 547', 'Edward', 'Elric', '2003-02-28', 'FullMetal'),
('+61 412 702 671', 'Anisha', 'Easton', '1992-05-27', 'drowssaP'),
('+61 420 997 716', 'Caine', 'Myers', '1990-01-01', 'MyStore'),
('+61 451 781 270', 'Yoga', 'Pants', '2002-10-19', 'ITS YOLKO!'),
('+61 488 858 011', 'Jacob', 'Mills', '1957-09-24', 'J4C0Bm1lLs'),
('+61 497 995 623', 'Kazuto', 'Kirigaya', '2004-01-12', 'KiritoIsAlwaysRightFoundation');

-- --------------------------------------------------------

--
-- Table structure for table `band`
--

CREATE TABLE `band` (
  `band_id` int(10) UNSIGNED NOT NULL,
  `band_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `band`
--

INSERT INTO `band` (`band_id`, `band_name`) VALUES
(1, 'Makari'),
(2, 'Spiritbox'),
(3, 'Periphery'),
(4, 'Monuments'),
(5, 'Tesseract'),
(6, 'WVNDER'),
(7, 'Termina'),
(8, 'Veil of Maya'),
(9, 'STARSET'),
(10, 'Breaking Benjamin'),
(11, 'Flux Conduct');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `mobile_phone` varchar(15) NOT NULL,
  `concert_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `concert`
--

CREATE TABLE `concert` (
  `concert_id` int(11) NOT NULL,
  `band_id` int(10) UNSIGNED NOT NULL,
  `venue_id` int(11) NOT NULL,
  `concert_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`concert_id`, `band_id`, `venue_id`, `concert_date`) VALUES
(1, 10, 2, '2021-03-12 20:30:00'),
(2, 1, 6, '2021-05-15 19:30:00'),
(3, 4, 5, '2021-07-16 22:30:00'),
(4, 3, 1, '2015-02-13 22:00:00'),
(5, 11, 4, '2021-11-13 23:15:00'),
(6, 7, 6, '2021-04-10 20:45:00'),
(7, 5, 4, '2021-07-07 15:00:00'),
(8, 9, 3, '2021-07-14 13:00:00'),
(9, 9, 4, '2021-07-15 16:30:00'),
(10, 9, 1, '2021-07-16 21:30:00'),
(11, 6, 6, '2022-01-14 20:45:00'),
(12, 8, 7, '2021-11-12 19:30:00'),
(13, 4, 4, '2021-04-20 10:30:00'),
(14, 10, 5, '2021-11-19 21:30:00'),
(15, 1, 2, '2022-01-20 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL,
  `venue_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `venue_name`) VALUES
(1, 'The Fillmore'),
(2, 'House of Blues'),
(3, 'The Showbox'),
(4, 'Summit'),
(5, 'Capitol'),
(6, 'Amplifier'),
(7, 'Metropolis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `attendee`
--
ALTER TABLE `attendee`
  ADD PRIMARY KEY (`mobile_phone`);

--
-- Indexes for table `band`
--
ALTER TABLE `band`
  ADD PRIMARY KEY (`band_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `mobile_phone` (`mobile_phone`),
  ADD KEY `concert_id` (`concert_id`);

--
-- Indexes for table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`concert_id`),
  ADD KEY `band_id` (`band_id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `band`
--
ALTER TABLE `band`
  MODIFY `band_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `concert`
--
ALTER TABLE `concert`
  MODIFY `concert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`concert_id`) REFERENCES `concert` (`concert_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`mobile_phone`) REFERENCES `attendee` (`mobile_phone`);

--
-- Constraints for table `concert`
--
ALTER TABLE `concert`
  ADD CONSTRAINT `concert_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`venue_id`),
  ADD CONSTRAINT `concert_ibfk_2` FOREIGN KEY (`band_id`) REFERENCES `band` (`band_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
