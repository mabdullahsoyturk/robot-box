-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2018 at 11:28 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ros_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `mes_types`
--

CREATE TABLE `mes_types` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf16_turkish_ci NOT NULL,
  `x_par` varchar(255) COLLATE utf16_turkish_ci NOT NULL,
  `y_par` varchar(255) COLLATE utf16_turkish_ci NOT NULL,
  `t_par` varchar(255) COLLATE utf16_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_turkish_ci;

--
-- Dumping data for table `mes_types`
--

INSERT INTO `mes_types` (`id`, `user_id`, `name`, `x_par`, `y_par`, `t_par`) VALUES
(2, 1, 'turtlesim/Pose', 'x', 'y', 'theta');

-- --------------------------------------------------------

--
-- Table structure for table `robots`
--

CREATE TABLE `robots` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(50) COLLATE utf16_turkish_ci NOT NULL,
  `port` varchar(8) COLLATE utf16_turkish_ci NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_turkish_ci;

--
-- Dumping data for table `robots`
--

INSERT INTO `robots` (`id`, `user_id`, `ip_address`, `port`, `topic_id`) VALUES
(1, 1, '167.99.201.200', '9090', 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf16_turkish_ci NOT NULL,
  `mes_id` int(11) NOT NULL,
  `max_x` double NOT NULL,
  `min_x` double NOT NULL,
  `max_y` double NOT NULL,
  `min_y` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_turkish_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `user_id`, `name`, `mes_id`, `max_x`, `min_x`, `max_y`, `min_y`) VALUES
(1, 1, '/turtle1/pose', 2, 11.088889122009, 0, 11.088889122009, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf16_turkish_ci NOT NULL,
  `password` varchar(255) COLLATE utf16_turkish_ci NOT NULL,
  `activation_code` varchar(40) COLLATE utf16_turkish_ci NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `forgotten_password_code` varchar(40) COLLATE utf16_turkish_ci DEFAULT NULL,
  `first_name` varchar(45) COLLATE utf16_turkish_ci DEFAULT NULL,
  `last_name` varchar(45) COLLATE utf16_turkish_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_turkish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `activation_code`, `activated`, `forgotten_password_code`, `first_name`, `last_name`, `created`, `modified`) VALUES
(1, 'root@root.com', '$2y$10$Xm36CwWM3j/QlxGSdnoFt.YYJ4w2KDcw6JVmVUxOPEfnQGhyTX6ci', 'JpnAvkNsmQygJ3UTByxFrrHqdi5wodVNWNVAk8kK', 1, NULL, 'root', 'cemal', '2018-04-10 22:07:31', '2018-04-10 22:07:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mes_types`
--
ALTER TABLE `mes_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `robots`
--
ALTER TABLE `robots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mes_id` (`mes_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emaill_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mes_types`
--
ALTER TABLE `mes_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `robots`
--
ALTER TABLE `robots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mes_types`
--
ALTER TABLE `mes_types`
  ADD CONSTRAINT `mes_types_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `robots`
--
ALTER TABLE `robots`
  ADD CONSTRAINT `robots_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `robots_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`mes_id`) REFERENCES `mes_types` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
