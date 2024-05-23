-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 03:10 PM
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
-- Database: `login database`
--

-- --------------------------------------------------------

--
-- Table structure for table `user list`
--

CREATE TABLE `user list` (
  `ID` int(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user list`
--

INSERT INTO `user list` (`ID`, `Username`, `Email`, `Password`) VALUES
(8, 'admin', 'admin@gmail.com', '$2y$10$2oUrWQi4yv0qiFfoEDLLh.4Mxd9b0jIeIZ5eEIzpnhwcAmN5uU3gi'),
(10, 'vien', 'vien@gmail.com', '$2y$10$DaL2WPRi.ybgnpYKS2cO1.Gha9D2TjqvYqqB4I3oQqIitfHLdjLHG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user list`
--
ALTER TABLE `user list`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user list`
--
ALTER TABLE `user list`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
