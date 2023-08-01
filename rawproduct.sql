-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 02:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rawproduct`
--

-- --------------------------------------------------------

--
-- Table structure for table `finished_product`
--

CREATE TABLE `finished_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `count` int(11) NOT NULL,
  `raw_material_name` varchar(100) DEFAULT NULL,
  `raw_material_required` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finished_product`
--

INSERT INTO `finished_product` (`id`, `product_name`, `count`, `raw_material_name`, `raw_material_required`) VALUES
(1, 'FP-1', 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE `raw_material` (
  `id` int(11) NOT NULL,
  `raw_material_name` varchar(100) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raw_material`
--

INSERT INTO `raw_material` (`id`, `raw_material_name`, `count`) VALUES
(1, 'RF-1', 6),
(2, 'RF-2', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finished_product`
--
ALTER TABLE `finished_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finished_product`
--
ALTER TABLE `finished_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
