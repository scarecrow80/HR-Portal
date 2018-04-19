-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19. Apr, 2018 12:24 PM
-- Server-versjon: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hr_portal`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `usertype` varchar(10) DEFAULT NULL COMMENT 'Leder/fadder etc',
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`idUsers`, `firstname`, `lastname`, `username`, `usertype`, `password`) VALUES
  (2, 'Dag-Roar', 'Aks', 'Dag-R', 'admin', '440aa7896891b295d14b9e3830a87377'),
  (4, 'Karl', 'Hansen', 'Karli', 'mentor', '3a6af38bf9f736b5a40439f2fa128a16'),
  (5, 'Sarah', 'Fox', 'Sarahi', 'HR', '3fbb450fc9906929513d784cef8845ee'),
  (6, 'Kari', 'Nilsen', 'Kari2', 'leader', '531d61dbedbd283c20e937857eccfcd2'),
  (7, 'Marianne', 'Lauritsen', 'Mario', 'admin', '46c977d719dd1852817c1d4a7db8322d'),
  (8, 'Oda', 'Selmer', 'Odali', 'mentor', '061c93d63ce2f0806a912e9e7f024ed9'),
  (9, 'Sigurd', 'Falkenberg', 'Falk', 'mentor', 'ee3d98bb65407eb8ed17a535b36c2706');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`),
  ADD UNIQUE KEY `idBrukere_UNIQUE` (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

