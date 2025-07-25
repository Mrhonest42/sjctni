-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 12:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminarform`
--

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `programid` varchar(50) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `program` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`programid`, `title`, `program`, `department`, `startdate`, `enddate`, `starttime`, `endtime`) VALUES
('abs', 'jadjfosdnfk', 'sfjaonfodi', 'djfdjofjdo', '2025-07-03', '2025-07-03', '12:30:00', '13:30:00'),
('COMTECH24', 'Python Programming', 'Programming in Python', 'Computer Science', '2025-06-30', '2025-06-30', '14:30:00', '16:30:00'),
('ITPROGRAM25', 'Faculty Development Programme', 'Invigilation techniques', 'Commerce', '2025-06-30', '2025-06-30', '14:00:00', '16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `program_fields`
--

CREATE TABLE `program_fields` (
  `id` int(11) NOT NULL,
  `programid` varchar(50) DEFAULT NULL,
  `fieldname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_fields`
--

INSERT INTO `program_fields` (`id`, `programid`, `fieldname`) VALUES
(76, 'COMTECH24', 'uname'),
(77, 'COMTECH24', 'email'),
(78, 'COMTECH24', 'mobilenumber'),
(79, 'COMTECH24', 'city'),
(80, 'COMTECH24', 'state'),
(81, 'COMTECH24', 'multiple'),
(82, 'ITPROGRAM25', 'uname'),
(83, 'ITPROGRAM25', 'email'),
(84, 'ITPROGRAM25', 'mobilenumber'),
(85, 'ITPROGRAM25', 'institution'),
(86, 'ITPROGRAM25', 'city'),
(87, 'ITPROGRAM25', 'state'),
(88, 'ITPROGRAM25', 'multiple'),
(89, 'abs', 'uname'),
(90, 'abs', 'email'),
(91, 'abs', 'mobilenumber'),
(92, 'abs', 'city'),
(93, 'abs', 'state'),
(94, 'abs', 'multiple');

-- --------------------------------------------------------

--
-- Table structure for table `program_payment_categories`
--

CREATE TABLE `program_payment_categories` (
  `id` int(11) NOT NULL,
  `programid` varchar(50) DEFAULT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_payment_categories`
--

INSERT INTO `program_payment_categories` (`id`, `programid`, `category_name`, `amount`) VALUES
(26, 'COMTECH24', 'Professor', 1000.00),
(27, 'COMTECH24', 'Student', 500.00),
(28, 'COMTECH24', 'Research Scholar', 750.00),
(29, 'COMTECH24', 'Industry Professional', 1500.00),
(30, 'ITPROGRAM25', 'Professor', 200.00),
(31, 'ITPROGRAM25', 'Research Scholar', 100.00),
(32, 'ITPROGRAM25', 'Industry Professional', 500.00),
(33, 'abs', 'Professor', 1000.00),
(34, 'abs', 'Student', 500.00),
(35, 'abs', 'Research Scholar', 800.00),
(36, 'abs', 'Industry Professional', 1500.00);

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `programid` varchar(100) NOT NULL,
  `uname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobilenumber` varchar(15) DEFAULT NULL,
  `classification` varchar(50) DEFAULT NULL,
  `institution` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `programid`, `uname`, `email`, `mobilenumber`, `classification`, `institution`, `city`, `state`, `category`, `amount`, `registered_at`) VALUES
(10, 'COMTECH24', 'WILLIAM JAMES A', 'williamjames4219@gmail.com', '8056560315', NULL, NULL, 'Manapparai', 'Tamil Nadu', 'Student', 500.00, '2025-06-30 07:32:53'),
(14, 'COMTECH24', 'Harish', 'harish@gmail.com', '8527419635', NULL, NULL, 'Dindigul', 'Tamil Nadu', 'Student', 500.00, '2025-07-04 08:00:32'),
(15, 'COMTECH24', 'Anand', 'anand@gmail.com', '8475966547', NULL, NULL, 'Palakarai', 'Tamil Nadu', 'Professor', 1000.00, '2025-07-04 08:13:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`programid`);

--
-- Indexes for table `program_fields`
--
ALTER TABLE `program_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programid` (`programid`);

--
-- Indexes for table `program_payment_categories`
--
ALTER TABLE `program_payment_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programid` (`programid`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_program_mobile` (`programid`,`mobilenumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `program_fields`
--
ALTER TABLE `program_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `program_payment_categories`
--
ALTER TABLE `program_payment_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `program_fields`
--
ALTER TABLE `program_fields`
  ADD CONSTRAINT `program_fields_ibfk_1` FOREIGN KEY (`programid`) REFERENCES `programs` (`programid`) ON DELETE CASCADE;

--
-- Constraints for table `program_payment_categories`
--
ALTER TABLE `program_payment_categories`
  ADD CONSTRAINT `program_payment_categories_ibfk_1` FOREIGN KEY (`programid`) REFERENCES `programs` (`programid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
