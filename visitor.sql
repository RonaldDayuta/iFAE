-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 11:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `visitor_logs`
--

CREATE TABLE `visitor_logs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `room` varchar(50) NOT NULL,
  `floor` varchar(50) NOT NULL,
  `visit_year` int(11) NOT NULL,
  `visit_month` int(11) NOT NULL,
  `visit_day` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `visitor_logs`
--

INSERT INTO `visitor_logs` (`id`, `name`, `room`, `floor`, `visit_year`, `visit_month`, `visit_day`, `created_at`) VALUES
(1, 'RONALD CRISTIAN DAYUTA', '1438', '12', 2025, 6, 23, '2025-06-23 07:45:35'),
(2, 'RONALD CRISTIAN DAYUTA', '1438', '15', 2025, 6, 23, '2025-06-23 07:49:12'),
(3, 'RONALD CRISTIAN', '1234', '13', 2025, 6, 23, '2025-06-23 07:56:38'),
(4, 'RONALD CRISTIAN DAYUTA', '400', '11', 2025, 6, 23, '2025-06-23 07:57:57'),
(5, 'RONALD CRISTIAN DAYUTA', '400', '11', 2025, 6, 23, '2025-06-23 08:01:16'),
(6, 'TEST', '304', '111', 2025, 6, 24, '2025-06-24 08:57:02'),
(7, 'TEST', '304', '111', 2025, 6, 24, '2025-06-24 08:57:09'),
(8, 'TEST', '304', '111', 2025, 6, 24, '2025-06-24 08:57:22'),
(9, 'TEST', '21', 'QWE', 2025, 6, 26, '2025-06-26 04:37:13'),
(10, 'TEST', '21', 'QWE', 2025, 6, 26, '2025-06-26 04:37:29'),
(11, 'TEST', '21', 'QWE', 2025, 6, 26, '2025-06-26 04:37:33'),
(12, 'TEST', '1212', '212', 2025, 6, 26, '2025-06-26 04:37:52'),
(13, 'TEST', '1212', '212', 2025, 6, 26, '2025-06-26 04:42:28'),
(14, 'TESTTE', '1111', '11', 2025, 6, 26, '2025-06-26 04:45:55'),
(15, 'TESTTE', '1111', '11', 2025, 6, 26, '2025-06-26 04:47:28'),
(16, 'TEST', '11111', '11', 2025, 6, 26, '2025-06-26 04:48:10'),
(17, 'LOURIE MAI ABLAY', '301', '3', 2025, 6, 26, '2025-06-26 04:50:16'),
(18, 'LOURIE MAI ABLAY', '301', '3', 2025, 6, 26, '2025-06-26 04:50:19'),
(19, 'TEST', 'TEST', '111', 2025, 6, 26, '2025-06-26 05:23:23'),
(20, 'TEST', '1111', '111', 2025, 6, 26, '2025-06-26 08:56:38'),
(21, 'TEST', '1111', '111', 2025, 6, 26, '2025-06-26 08:56:41'),
(22, 'TEST', '1234', '121', 2025, 6, 26, '2025-06-26 09:07:52'),
(23, 'TEST', '1234', '121', 2025, 6, 26, '2025-06-26 09:07:56'),
(24, 'EDMAR EUSTAQUIO', '123', '11', 2025, 6, 26, '2025-06-26 09:08:56'),
(25, 'EDMAR EUSTAQUIO', '123', '11', 2025, 6, 26, '2025-06-26 09:09:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visitor_logs`
--
ALTER TABLE `visitor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
