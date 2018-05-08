-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28. Feb, 2018 13:13 PM
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
-- Database: `personer`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `dine_nyansatte`
--

CREATE TABLE `dine_nyansatte` (
  `Fornvavn` varchar(20) NOT NULL,
  `Etternavn` varchar(20) NOT NULL,
  `Avdeling` varchar(15) NOT NULL,
  `Ansatttype` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `dine_nyansatte`
--

INSERT INTO `dine_nyansatte` (`Fornvavn`, `Etternavn`, `Avdeling`, `Ansatttype`) VALUES
('Karl', 'Martinsen', 'IT', 'Vanlig ansatt'),
('Keith', 'Leadger', 'Social Studies', 'International '),
('Lena', 'Norensen', 'Økonomi', 'Leder');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dine_nyansatte`
--
ALTER TABLE `dine_nyansatte`
  ADD PRIMARY KEY (`Fornvavn`,`Ansatttype`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
