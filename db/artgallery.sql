-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 06:45 PM
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
-- Database: `artgallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `art`
--

CREATE TABLE `art` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `description` longtext NOT NULL,
  `phone` int(255) NOT NULL,
  `status` int(255) NOT NULL DEFAULT 1,
  `sellerid` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `artid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `art`
--

INSERT INTO `art` (`id`, `name`, `price`, `description`, `phone`, `status`, `sellerid`, `created_at`, `image`, `artid`) VALUES
(3, 'Mermaid', 2300, 'Fresh from the farm this morning', 112163919, 1, 'lW9SuPLG', '2024-02-12 13:31:02', '884140966.jpeg', 'm1AcctR2'),
(4, 'Colorful', 120000, 'Photo realistic cabbag isolated on white', 112163919, 1, 'lW9SuPLG', '2024-02-12 14:29:59', '1188675360.jpg', '66trXUMK'),
(5, 'New product', 2000, 'Photo realistic cabbag isolated on white', 112163919, 1, 'lW9SuPLG', '2024-02-15 20:50:40', '787424380.jpg', 'aCiBsXvP'),
(6, 'Nissan GTR', 1, 'Lates Art', 114068777, 1, 'J4WU0FPH', '2024-02-18 00:53:30', '1346088585.jpeg', 'pL8qTU1u'),
(7, 'Testing', 1, 'The best', 114068776, 1, 'GmrviPsb', '2024-11-12 11:48:32', '1200932989.jpg', '7DqjdmDU'),
(8, 'Product X', 1, 'Still looking for art', 114068776, 1, 'GmrviPsb', '2024-11-12 18:41:47', '1468044082.png', 'RYrUnJmA');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `buyerphone` varchar(255) NOT NULL,
  `artid` varchar(255) NOT NULL,
  `sellerid` varchar(255) NOT NULL,
  `order_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testorder`
--

CREATE TABLE `testorder` (
  `id` int(11) NOT NULL,
  `artid` varchar(255) NOT NULL,
  `sellerid` varchar(255) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `bought` int(11) NOT NULL DEFAULT 0,
  `orderid` varchar(255) NOT NULL,
  `tracking_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testorder`
--

INSERT INTO `testorder` (`id`, `artid`, `sellerid`, `buyer`, `bought`, `orderid`, `tracking_id`) VALUES
(19, 'pL8qTU1u', 'J4WU0FPH', 'dev.jimin02@gmail.com', 1, '', '005fc6a7-1b2e-46be-aea3-dc869e906b50'),
(21, 'RYrUnJmA', 'GmrviPsb', 'dev.jimin02@gmail.com', 1, '', '005fc6a7-1b2e-46be-aea3-dc869e906b50'),
(22, 'RYrUnJmA', 'GmrviPsb', 'dev.jimin02@gmail.com', 1, '', '6e0e169f-4cd2-4660-a4d1-dc86ccc195e2'),
(24, 'pL8qTU1u', 'J4WU0FPH', 'dev.jimin02@gmail.com', 1, '', '1716a51f-08c2-44fc-a61e-dc864f13a57d'),
(25, 'RYrUnJmA', 'GmrviPsb', 'dev.jimin02@gmail.com', 1, '', '1716a51f-08c2-44fc-a61e-dc864f13a57d'),
(26, 'RYrUnJmA', 'GmrviPsb', 'dev.jimin02@gmail.com', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `verified` int(255) NOT NULL DEFAULT 0,
  `otp` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `location`, `phone`, `user_type`, `userid`, `verified`, `otp`) VALUES
(6, 'Meyer', 'maya@gmail.com', '96e79218965eb72c92a549dd5a330112', 'xyludu', 112163919, 'seller', 'lW9SuPLG', 0, 0),
(9, 'Eric', 'herculean@gmail.com', '96e79218965eb72c92a549dd5a330112', 'Boston', 114068777, 'seller', 'J4WU0FPH', 0, 0),
(14, 'SellerX', 'jameswafula2002@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Kiambu', 114068776, 'seller', 'GmrviPsb', 1, 983749),
(15, 'Jimmy', 'dev.jimin02@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'nairobi', 112163919, 'buyer', '1KuZliXC', 1, 981742);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `art`
--
ALTER TABLE `art`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testorder`
--
ALTER TABLE `testorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `art`
--
ALTER TABLE `art`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testorder`
--
ALTER TABLE `testorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
