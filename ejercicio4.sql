-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 09:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ejercicio4`
--

-- --------------------------------------------------------

--
-- Table structure for table `mediciones`
--

CREATE TABLE `mediciones` (
  `id_medicion` int(5) NOT NULL,
  `pozo` int(5) NOT NULL,
  `medicion` int(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mediciones`
--

INSERT INTO `mediciones` (`id_medicion`, `pozo`, `medicion`, `fecha`) VALUES
(1, 1, 145, '2023-03-15'),
(2, 1, 123, '2023-03-01'),
(3, 1, 109, '2023-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `pozos`
--

CREATE TABLE `pozos` (
  `id_pozo` int(5) NOT NULL,
  `numberp` int(5) DEFAULT NULL,
  `locationp` varchar(20) DEFAULT NULL,
  `depth` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pozos`
--

INSERT INTO `pozos` (`id_pozo`, `numberp`, `locationp`, `depth`) VALUES
(1, 123, 'Occidente Zulia', 132);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mediciones`
--
ALTER TABLE `mediciones`
  ADD PRIMARY KEY (`id_medicion`);

--
-- Indexes for table `pozos`
--
ALTER TABLE `pozos`
  ADD PRIMARY KEY (`id_pozo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mediciones`
--
ALTER TABLE `mediciones`
  MODIFY `id_medicion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pozos`
--
ALTER TABLE `pozos`
  MODIFY `id_pozo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
