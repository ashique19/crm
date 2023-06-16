-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2019 at 05:04 PM
-- Server version: 10.2.21-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mywhole_booksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(255) NOT NULL,
  `content_city` text NOT NULL,
  `content_state` text NOT NULL,
  `content_country` text NOT NULL,
  `content_url` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `content_city`, `content_state`, `content_country`, `content_url`, `status`) VALUES
(1, 'Adamana', 'Arizona', '', 'Adamana-Arizona', 1),
(2, 'Adobe', 'Arizona', '', 'Adobe-Arizona', 1),
(3, 'Agua Fria', 'Arizona', '', 'Agua-Fria-Arizona', 1),
(4, 'Aguila', 'Arizona', '', 'Aguila-Arizona', 1),
(5, 'Ajo', 'Arizona', '', 'Ajo-Arizona', 1),
(6, 'Alhambra', 'Arizona', '', 'Alhambra-Arizona', 1),
(7, 'Ali Chuk', 'Arizona', '', 'Ali-Chuk-Arizona', 1),
(8, 'Allenville', 'Arizona', '', 'Allenville-Arizona', 1),
(9, 'Anegam', 'Arizona', '', 'Anegam-Arizona', 1),
(10, 'Apache Flats', 'Arizona', '', 'Apache-Flats-Arizona', 1);



--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
-- ALTER TABLE `cities`
--   MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278215;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
