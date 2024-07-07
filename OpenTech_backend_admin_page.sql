-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2024 at 08:00 PM
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
-- Database: `tests`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `name`, `email`, `password`) VALUES
(1, 'mahmoud', 'emailak@gmail.com', 'pass'),
(8, 'Karim Alakkad', 'checking@gmail.com', 'pass'),
(9, 'Karim', 'check@gmail.com', 'pass'),
(10, 'Karim Alakkad', 'try@gmail.com', 'pass'),
(11, 'Hadi', 'hadi@gmail.com', 'pass'),
(12, 'Fares', 'mail@gmail.com', 'pass'),
(13, 'Kasem', 'kasem@gmail.com', 'pass'),
(14, 'Aref', 'aref@gmail.com', 'pass'),
(15, 'Amir', 'amir@gmail.com', 'pass'),
(16, 'Salwa', 'salwa@gmail.com', 'pass'),
(17, 'Hadil', 'hadil@gmail.com', '1a1dc91c907325c69271ddf0c944bc72'),
(18, 'Kamal', 'kamal@gmail.com', '1a1dc91c907325c69271ddf0c944bc72');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `auth_id` int(11) NOT NULL,
  `nationality_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `name`, `phone`, `email`, `date`, `auth_id`, `nationality_id`) VALUES
(25, 'Salim Hamed', 'pass', 'salim@gmail.com', '1970-01-01', 8, 0),
(27, 'hosam', '0123123123', 'hosam@gmail.com', '1970-01-01', 9, 0),
(33, 'Salim', '03131313', 'salim@gmail.com', '1970-01-01', 1, 0),
(35, 'Rafik', '03123132', 'rafik@gmail.com', '1970-01-01', 14, 0),
(38, 'Mahmoud', '03131313', 'mahmoud@gmail.com', '1970-01-01', 1, 0),
(60, 'Salim', '03645714', 'safi@gmail.com', '2024-04-05', 17, 0),
(61, 'Salim', '70892666', 'salim@gmail.com', '2024-04-17', 17, 0),
(62, 'asdkf', '123', 'ajdfkl@gmail.com', '2024-04-19', 18, 0),
(63, 'Ahmad', '0313213', 'ahmad@gmail.com', '2024-04-19', 18, 4),
(64, 'Ahmad', '03132132', 'ahmad@gmail.com', '2024-04-24', 17, 5),
(65, 'kfjkas', '03132132', 'kajfksal2@gmail.com', '2024-04-21', 17, 5);

-- --------------------------------------------------------

--
-- Table structure for table `nationality`
--

CREATE TABLE `nationality` (
  `nationality_id` int(11) NOT NULL,
  `nationality_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`nationality_id`, `nationality_name`) VALUES
(4, 'Lebanon'),
(5, 'Syria');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `barcode` varchar(17) NOT NULL,
  `auth_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `barcode`, `auth_id`) VALUES
(12, 'banana', 3.22, '123rjkdfj', 17),
(13, 'Apple', 8.00, '234123412jkl', 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`nationality_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `nationality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
