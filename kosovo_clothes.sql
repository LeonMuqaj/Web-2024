-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 01:27 AM
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
-- Database: `kosovo_clothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_access`
--

CREATE TABLE `admin_access` (
  `ID_Admin` int(11) NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_access`
--

INSERT INTO `admin_access` (`ID_Admin`, `Email`, `Password`) VALUES
(1, 'leoni@gmail.com', 'Leoni123'),
(2, 'bleroni@gmail.com', 'Bleroni123');

-- --------------------------------------------------------

--
-- Table structure for table `porosite`
--

CREATE TABLE `porosite` (
  `ID_Porosit` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Sasia` int(11) NOT NULL DEFAULT 1,
  `Data` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('Pending','Ordered') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `porosite`
--

INSERT INTO `porosite` (`ID_Porosit`, `User_ID`, `Product_ID`, `Sasia`, `Data`, `Status`) VALUES
(43, 1, 4, 1, '2025-01-23 00:25:16', 'Pending'),
(44, 1, 5, 1, '2025-01-23 00:25:51', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `produktet`
--

CREATE TABLE `produktet` (
  `ID_Produktit` int(11) NOT NULL,
  `Emri_Produktit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Qmimi` decimal(10,2) DEFAULT NULL,
  `Stok` int(11) NOT NULL,
  `Imazhi` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produktet`
--

INSERT INTO `produktet` (`ID_Produktit`, `Emri_Produktit`, `Qmimi`, `Stok`, `Imazhi`) VALUES
(1, 'Maice per Meshkuj Golden State Warriors', 80.00, 0, 'golden-state-warriors-courtside-statement-edition-mens-jordan-nba-max90-t-shirt-HnWHMD.png'),
(2, 'Air Jordan 4 Seafom Edition', 180.00, 0, 'air-jordan-4-seafoam.jpg'),
(3, 'Duks per femra Nike', 80.00, 0, 'NIKEFEMRADW+NSW+ESSNTL+COZY+JKT.png'),
(4, 'Duks me menge te gjata Nike', 45.00, 0, 'NikePro MOCK long sleeve.jpg'),
(5, 'Duks per Meshkuj Nike Nocta te verdhe', 70.00, 0, 'DuksNOCTA-M+NRG+NOCTA+TCH+JKT+HD.png'),
(6, 'Atlete per Femra Nike SHOX-RIDE 2', 200.00, 0, 'NIKESHOX+RIDE+2.png'),
(7, 'Duks per Meshkuj Nike Terma Fit', 100.00, 0, 'TermaFitHOODIE-M+J+FLIGHT+SHERPA+JKT-Meshkuj.png'),
(8, 'Air Jordan 1 MID', 280.00, 0, 'airjordan1.jpg'),
(9, 'Trenerke per Meshkuj Jordan Warmup', 60.00, 0, 'jordan-essentials-mens-warmup-jacket-bHlr9B.png'),
(10, 'Air Jordan 4 Thunder', 200.00, 0, 'air-jordan-4-thunder.jpg'),
(11, 'Trenerka per Femra Nike', 75.00, 0, 'NIKEPHOENIXFEMRAW+NSW+PHNX+FLC+HR+OS+PANT+2.png'),
(12, 'Maice per Meshkuj Brooklyn Jersey', 120.00, 0, 'BROKLYNJERSEY+MNK+DF+SWGMN+JSY+ICN+22.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_Klientit` int(11) NOT NULL,
  `Emri` varchar(100) NOT NULL,
  `Mbiemri` varchar(100) NOT NULL,
  `Gjinia` enum('male','female','other') NOT NULL,
  `Numri` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Data_Regjistrimit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_Klientit`, `Emri`, `Mbiemri`, `Gjinia`, `Numri`, `Email`, `Password`, `Data_Regjistrimit`) VALUES
(1, 'Leon', 'Muqaj', 'male', '38349465905', 'leon.muqaj@gmail.com', 'Leoni123*', '2025-01-20 17:43:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_access`
--
ALTER TABLE `admin_access`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Indexes for table `porosite`
--
ALTER TABLE `porosite`
  ADD PRIMARY KEY (`ID_Porosit`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `porosite_ibfk_2` (`Product_ID`);

--
-- Indexes for table `produktet`
--
ALTER TABLE `produktet`
  ADD PRIMARY KEY (`ID_Produktit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_Klientit`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_access`
--
ALTER TABLE `admin_access`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `porosite`
--
ALTER TABLE `porosite`
  MODIFY `ID_Porosit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `produktet`
--
ALTER TABLE `produktet`
  MODIFY `ID_Produktit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_Klientit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `porosite`
--
ALTER TABLE `porosite`
  ADD CONSTRAINT `porosite_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`ID_Klientit`),
  ADD CONSTRAINT `porosite_ibfk_2` FOREIGN KEY (`Product_ID`) REFERENCES `produktet` (`ID_Produktit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
