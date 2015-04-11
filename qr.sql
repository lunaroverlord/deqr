-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2015 at 07:27 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE IF NOT EXISTS `queues` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `estimated_service_time` int(11) NOT NULL,
  `current_number` int(11) NOT NULL,
  `last_customer_number` int(11) NOT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `queues`
--

INSERT INTO `queues` (`id`, `name`, `estimated_service_time`, `current_number`, `last_customer_number`, `token`) VALUES
(7, 'whatever', 5, 1, 11, '8cb8deb916d963115338128a3c27631b'),
(8, 'asdf', 5, 1, 1, '8519c0482e73b75ef6f17249cfdffb00'),
(9, 'asdf', 6, 1, 1, 'f5454312b5d90edc8ceae8038b66334a');

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
-- AUTO_INCREMENT for table `queues`
--
ALTER TABLE `queues`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
