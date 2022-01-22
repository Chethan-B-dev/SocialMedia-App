-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 29, 2020 at 02:07 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `caption` varchar(1024) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_tweet` tinyint(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `caption`, `image`, `is_tweet`, `name`, `time`) VALUES
(45, 7, '<p>dsafsdfsd</p>\r\n', NULL, 1, 'chethan1', '2020-12-29 18:10:07'),
(48, 7, 'sdfsdf', 'ebd8379821248836d4eaf249e37da49b58130a8d.png', 0, 'chethan1', '2020-12-29 18:12:05'),
(49, 9, '<p>sdfsdfsdsfsds</p>\r\n', NULL, 1, 'gowthu', '2020-12-29 18:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@test.com', 'admin'),
(3, 'deepak', 'deepak@test.com', '$2y$10$BxctnXBL/GBnE1qqPF3yluGKCE1EtFoDU9g2jy8ouGNkelr1qUx6C'),
(4, 'chethan', 'chethan@test.com', '$2y$10$CQuC7VZbtNznFvhRHdvjZu1.hqK/3UtR/mHBZ04UFnTsY.2w04fra'),
(5, 'ewdasd', 'dsa@test.com', '$2y$10$6tir6RpjScuOPBBpAHhGRuJrYoOF4teqF0wKPNEmfT64nXri1szOm'),
(6, '<?php echo \'hello\';?>', 'dasdasdasdasd', '$2y$10$r7g6d8JllyXpBsV/qNDeKe8t7X7B1sTDG/tIFwd.suN6.C3tMqJ3C'),
(7, 'chethan1', 'chethan1', '$2y$10$SfXn.FOIufdZq3zi5FKvOOcSihPchzZQ36lIHVoJ.jG9D47aO9CUu'),
(8, 'dsad', 'dsadsad', '$2y$10$vPMftPa5cy0xU0ZkEUI.U.Us3h3gtuxpeGuAl1rin1bYPBnwH2QSy'),
(9, 'gowthu', 'gowthu@gowthu.com', '$2y$10$DZfgzywc9D2tlVQRCYPWG.FfztWodAHobe9OWk/VoDiNbRoeQgfNq'),
(10, 'test', 'test@test.com', '$2y$10$ak3pHocIH3T7hKuzUsFNWePl7SwFpG/FrEZA2hZ1Fh3VRyZ7Md9Im');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
