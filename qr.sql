-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2015 at 07:45 AM
-- Server version: 5.5.41-log
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qr`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `queue_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `number`, `queue_id`, `token`) VALUES
(1, 6, 15, ''),
(2, 8, 15, ''),
(3, 9, 15, ''),
(4, 1, 17, ''),
(5, 2, 17, ''),
(6, 2, 24, ''),
(7, 3, 24, ''),
(8, 4, 24, ''),
(9, 3, 17, ''),
(10, 1, 27, ''),
(11, 2, 25, ''),
(12, 2, 26, ''),
(13, 2, 27, ''),
(14, 1, 28, ''),
(15, 1, 12, ''),
(16, 1, 29, ''),
(17, 1, 30, ''),
(18, 1, 31, ''),
(19, 1, 32, ''),
(20, 2, 32, ''),
(21, 3, 32, ''),
(22, 1, 21, ''),
(23, 1, 33, ''),
(24, 2, 33, ''),
(25, 3, 33, ''),
(26, 2, 36, ''),
(27, 3, 36, ''),
(28, 4, 36, ''),
(29, 5, 36, ''),
(30, 6, 36, ''),
(31, 7, 36, ''),
(32, 8, 36, ''),
(33, 9, 36, ''),
(34, 10, 36, ''),
(35, 11, 36, ''),
(36, 12, 36, ''),
(37, 13, 36, ''),
(38, 14, 36, ''),
(39, 1, 0, ''),
(40, 1, 0, ''),
(41, 1, 0, ''),
(42, 15, 36, ''),
(43, 1, 0, ''),
(44, 2, 37, ''),
(45, 3, 37, ''),
(46, 4, 37, ''),
(47, 16, 36, ''),
(48, 2, 38, ''),
(49, 3, 38, ''),
(50, 2, 39, ''),
(51, 3, 39, ''),
(52, 4, 39, ''),
(53, 1, 40, ''),
(54, 2, 40, ''),
(55, 1, 41, ''),
(56, 2, 41, ''),
(57, 1, 42, ''),
(58, 2, 42, ''),
(59, 3, 42, ''),
(60, 1, 43, ''),
(61, 2, 43, ''),
(62, 3, 43, ''),
(63, 4, 43, ''),
(64, 5, 43, ''),
(65, 6, 43, ''),
(66, 7, 43, ''),
(67, 8, 43, ''),
(68, 9, 43, ''),
(69, 10, 43, ''),
(70, 1, 44, ''),
(71, 2, 44, '');

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE IF NOT EXISTS `queues` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `estimated_service_time` double NOT NULL,
  `current_number` int(11) NOT NULL,
  `last_customer_number` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `last_service_time` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `queues`
--

INSERT INTO `queues` (`id`, `name`, `estimated_service_time`, `current_number`, `last_customer_number`, `token`, `last_service_time`) VALUES
(29, 'asdf', 5, 1, 1, 'd7008f82235f182fc10c230b57412a8a', '0000-00-00 00:00:00'),
(30, 'asdf', 5, 2, 1, 'bb1659548b251d5d1b077bf6dc2ad07a', '2015-04-12 01:06:08'),
(31, 'asdf', 5, 2, 1, 'f1eadc4ddbc6d711ebba0d381278f6f7', '2015-04-12 01:09:25'),
(32, 'asdf', 0.2, 3, 3, 'bb20fb64d70bb4175a06c52c5b3dcd45', '2015-04-12 01:39:05'),
(33, 'asdf', 5.4666666666667, 4, 3, '9243d466f217a9bcacadaab02d107f1c', '2015-04-12 05:32:07'),
(34, 'test', 20, 1, 0, '0d4f9b09a9fe55152d4bd9a3b35ad8c9', '2015-04-12 02:04:25'),
(35, 'test', 20, 1, 1, '66b92a90ee36f88718af20726cd86457', '2015-04-12 03:05:59'),
(36, 'test', 20, 1, 16, 'a73ff642d7514b1e58ef5c35ac9e67c5', '2015-04-12 03:06:49'),
(37, 'test', 20, 1, 4, 'ba64ef583b11a3dfef0449aca705c757', '2015-04-12 05:22:55'),
(38, 'asdf', 5, 1, 3, '42801288a4a44151ec4704ddb7544dcb', '2015-04-12 06:07:35'),
(39, 'asdf', 5, 0, 4, 'ff9ce3dba096c828261c16379feffe1e', '2015-04-12 06:16:02'),
(40, 'asdf', 5, 0, 2, '190b19f26d93612a73fcc098a6e902c5', '2015-04-12 06:18:41'),
(41, 'asdf', 0.2, 3, 2, '2c3618f0dd2c3f65fe12d8c21df8fa4f', '2015-04-12 06:45:09'),
(42, 'asdf', 1.1166666666667, 2, 3, 'ab769bd0954caca13093b2cb64137f82', '2015-04-12 06:46:33'),
(43, 'test', 0.26666666666667, 6, 10, 'a4de0d266e672bea78960b55e52b7a0e', '2015-04-12 07:06:30'),
(44, 'asdf', 5, 1, 2, 'cc7b2db54f2229277a7df92be8cfd8ce', '2015-04-12 07:43:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queues`
--
ALTER TABLE `queues`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `queues`
--
ALTER TABLE `queues`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
