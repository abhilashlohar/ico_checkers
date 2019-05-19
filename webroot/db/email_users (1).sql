-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2019 at 05:46 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jupiter`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_users`
--

CREATE TABLE `email_users` (
  `id` int(10) NOT NULL,
  `sent_email_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` enum('Sent','Pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_users`
--

INSERT INTO `email_users` (`id`, `sent_email_id`, `user_id`, `status`) VALUES
(10, 6, 1, 'Pending'),
(11, 6, 2, 'Pending'),
(12, 6, 3, 'Pending'),
(13, 6, 4, 'Pending'),
(14, 6, 5, 'Pending'),
(15, 6, 6, 'Pending'),
(18, 7, 3, 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_users`
--
ALTER TABLE `email_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_users`
--
ALTER TABLE `email_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
