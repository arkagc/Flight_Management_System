-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 07:17 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `name`, `short_name`, `location`, `status`, `created_at`, `modified_at`) VALUES
(1, 'Kolkata Airport', 'CCU', 'Kolkata', 'Y', '2021-05-07 18:10:06', '2021-05-07 12:39:49'),
(2, 'Bangalore Airport', 'BIA', 'Bangalore', 'Y', '2021-05-07 18:33:02', '2021-05-07 13:02:36'),
(4, 'Hydrabad Airport', 'HIA', 'Hydrabad', 'Y', '2021-05-10 14:12:28', '2021-05-10 08:41:56'),
(5, 'Chennai Airport', 'CA', 'Chennai', 'N', '2021-05-13 12:35:57', '2021-05-13 07:04:51'),
(6, 'kolkata', 'ccuu', 'kolkata', 'Y', '2021-05-13 14:23:17', '2021-05-13 08:52:40'),
(8, 'puri airport', 'puri', 'puri', 'N', '2021-05-13 15:18:03', '2021-05-13 09:47:44'),
(9, 'Vizag Airport', 'VA', 'Vizag', 'Y', '2021-05-13 15:21:31', '2021-05-13 09:51:22'),
(10, 'hgchh', 'txfgxgh', 'chhvu', 'Y', '2021-05-13 15:27:26', '2021-05-13 09:57:12'),
(11, 'asasacsasc', 'caccsca', 'cascascasc', 'Y', '2021-05-13 15:48:12', '2021-05-13 10:18:03'),
(14, 'assssssssssasa', 'cascaccac', 'asdas', 'Y', '2021-05-14 12:02:15', '2021-05-14 06:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL DEFAULT 0 COMMENT '`passenger_id` from passengers table',
  `flight_id` int(11) NOT NULL DEFAULT 0 COMMENT '`flight_id` from flights table',
  `booking_date` date NOT NULL DEFAULT current_timestamp(),
  `deperture_date` date DEFAULT NULL,
  `status` enum('Booked','Cancelled','Waiting') NOT NULL DEFAULT 'Waiting',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `passenger_id`, `flight_id`, `booking_date`, `deperture_date`, `status`, `created_at`, `modified_at`) VALUES
(1, 1, 6, '2021-05-20', '2021-05-31', 'Cancelled', '2021-05-20 09:03:56', '2021-05-20 09:03:56'),
(9, 1, 11, '2021-05-24', '2021-05-31', 'Cancelled', '2021-05-24 12:41:46', '2021-05-24 12:41:46'),
(12, 1, 5, '2021-05-24', '2021-05-01', 'Cancelled', '2021-05-24 14:56:16', '2021-05-24 14:56:16'),
(13, 1, 1, '2021-05-25', '2021-05-25', 'Waiting', '2021-05-25 11:29:44', '2021-05-25 11:29:44'),
(14, 1, 6, '2021-05-25', '2021-05-31', 'Booked', '2021-05-25 12:07:38', '2021-05-25 12:07:38'),
(23, 11, 6, '2021-05-25', '2021-05-25', 'Waiting', '2021-05-25 17:56:49', '2021-05-25 17:56:49'),
(24, 11, 5, '2021-05-25', '2021-05-31', 'Booked', '2021-05-25 17:57:01', '2021-05-25 17:57:01'),
(25, 11, 6, '2021-05-25', '2021-05-30', 'Booked', '2021-05-25 19:21:38', '2021-05-25 19:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_no` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `source_id` int(11) NOT NULL DEFAULT 0 COMMENT '`source_id` from `airports` table',
  `destination_id` int(11) DEFAULT 0 COMMENT '`destination_id` from `airports` table',
  `total_seat` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `distance` varchar(255) DEFAULT NULL,
  `deprt_time` time DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_no`, `name`, `source_id`, `destination_id`, `total_seat`, `duration`, `distance`, `deprt_time`, `status`, `created_at`, `modified_at`) VALUES
(5, 'AF1001', 'Air France', 9, 2, '100', '3 hrs', '1025 km', '17:42:21', 'Y', '2021-05-13 17:42:24', '2021-05-13 12:11:38'),
(6, 'AR3500', 'Air France', 1, 4, '100', '42 hrs', '1025 km', '18:16:13', 'Y', '2021-05-13 18:16:16', '2021-05-13 12:44:39'),
(8, 'AF1010', 'Air France', 9, 4, '2', '30 hrs', '1025 km', '11:05:46', 'Y', '2021-05-14 11:05:49', '2021-05-14 05:35:26'),
(9, '1111111', 'Air France', 9, 4, '100', '20 hrs', '1025 km', '11:15:24', 'Y', '2021-05-14 11:15:28', '2021-05-14 05:45:02'),
(10, '222222', 'Air France', 9, 4, '50', '5 hrs', '1025 km', '11:16:01', 'Y', '2021-05-14 11:16:05', '2021-05-14 05:45:46'),
(11, '333333', 'Air India', 9, 4, '100', '8 hrs', '1025 km', '11:16:31', 'N', '2021-05-14 11:16:36', '2021-05-14 05:46:11'),
(12, 'asaacaassc', 'scacscsca', 15, 11, '20', '7 hrs', '50 km', '12:10:38', 'Y', '2021-05-14 12:10:41', '2021-05-14 06:39:59'),
(13, 'csdcs', 'cscsc', 6, 10, '5', '50 hrs', '25 km', '12:11:15', 'Y', '2021-05-14 12:11:18', '2021-05-14 06:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE `passengers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`id`, `username`, `password`, `name`, `email`, `phone_no`, `date_of_birth`, `address`, `country`, `state`, `city`, `pincode`, `status`, `created_at`, `modified_at`) VALUES
(1, 'arka12345', '$2y$10$HsrilwXFnt9Gj6O5d6n74OweVV83AMkozZmJoWkAlPjww2zI63uai', 'Arka Ghosh Chowdhury', 'arka@gmail.com', '8274805236', '2021-05-01', '11/16 Balai Mistry Lane', 'India', 'West Bengal', 'Howrah', '711103', 'Active', '2021-05-20 09:01:32', '2021-05-20 09:01:32'),
(11, 'sandip0000', '$2y$10$/xONgojrAZSmotVDHrLKuOBY9G6D9G6bdpmuWDbIhpdG8mMFhgfwC', 'Sandip', 'sandip@gmail.com', '9874569874', '2021-05-25', 'Kolkata', 'India', 'Himachal Pradesh', 'Kolkata', '712145', 'Active', '2021-05-25 17:46:58', '2021-05-25 17:46:58'),
(12, 'arnab123', '$2y$10$HjHpQMo2fc02QxqQBruYqe5QFg9nlz3X5gYrk94Jl2tHP6qrfIBRG', 'Arnab', 'arnab@gmail.com', '9874512563', '2021-05-01', 'Kolkata', 'United State of America', 'Arunachal Pradesh', 'Kolkata', '712145', 'Inactive', '2021-05-26 05:14:59', '2021-05-26 05:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `status`, `created_at`, `modified_at`) VALUES
(1, 'arka123456', '$2y$10$ZZDecqvdbDxqXfQcpohRGeurv.Mj9xJzkonG9JkuJhn9ugqtB8wfC', 'arka@gmail.com', 'Y', '2021-05-11 06:37:59', '2021-05-11 10:08:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
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
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
