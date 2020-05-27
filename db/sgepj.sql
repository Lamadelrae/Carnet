-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 09:05 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgepj`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(255) NOT NULL,
  `uniq_id` varchar(255) NOT NULL,
  `name` varchar(120) NOT NULL,
  `cnpj` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `total_debt` decimal(16,2) NOT NULL,
  `num_quota` int(255) NOT NULL,
  `contract` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `uniq_id`, `name`, `cnpj`, `password`, `total_debt`, `num_quota`, `contract`) VALUES
(1, '5ecc67f21360e', 'VR System', '12.000.000/0000-00', '$2y$10$5FzIJcSn.Pl28coc2T5DsePw7eEyUourNHT6mTMqAOEh5JYH7LDS.', '1200.00', 12, '028'),
(2, '5ecce5a47146e', 'Matthew', '12.323.323/1231-23', '$2y$10$BpVrewPWFJojl3DHDrX7R.lNm3y4xS7N8cL5LQ6PtOUm6HH3tUdxe', '900000.00', 120, 'haha');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(1200) NOT NULL,
  `post` varchar(1200) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `post`, `date`) VALUES
(1, 1, 'sass', 'assassas', '2020-05-26'),
(2, 1, 'saunsauahs', 'sauros', '2020-05-26'),
(3, 1, 'sasa', 'sasassasas', '2020-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `quota`
--

CREATE TABLE `quota` (
  `id` int(255) NOT NULL,
  `cli_id` int(255) NOT NULL,
  `line_quota` int(120) NOT NULL,
  `quota_value` decimal(16,2) NOT NULL,
  `status` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quota`
--

INSERT INTO `quota` (`id`, `cli_id`, `line_quota`, `quota_value`, `status`) VALUES
(1, 1, 1, '100.00', 100),
(2, 1, 2, '100.00', 100),
(3, 1, 3, '100.00', 100),
(4, 1, 4, '100.00', 100),
(5, 1, 5, '100.00', 300),
(6, 1, 6, '100.00', 300),
(7, 1, 7, '100.00', 300),
(8, 1, 8, '100.00', 300),
(9, 1, 9, '100.00', 200),
(10, 1, 10, '100.00', 200),
(11, 1, 11, '100.00', 200),
(12, 1, 12, '100.00', 200),
(13, 2, 1, '7500.00', 100),
(14, 2, 2, '7500.00', 100),
(15, 2, 3, '7500.00', 100),
(16, 2, 4, '7500.00', 100),
(17, 2, 5, '7500.00', 100),
(18, 2, 6, '7500.00', 100),
(19, 2, 7, '7500.00', 100),
(20, 2, 8, '7500.00', 100),
(21, 2, 9, '7500.00', 100),
(22, 2, 10, '7500.00', 100),
(23, 2, 11, '7500.00', 100),
(24, 2, 12, '7500.00', 100),
(25, 2, 13, '7500.00', 100),
(26, 2, 14, '7500.00', 100),
(27, 2, 15, '7500.00', 100),
(28, 2, 16, '7500.00', 100),
(29, 2, 17, '7500.00', 100),
(30, 2, 18, '7500.00', 100),
(31, 2, 19, '7500.00', 100),
(32, 2, 20, '7500.00', 100),
(33, 2, 21, '7500.00', 100),
(34, 2, 22, '7500.00', 100),
(35, 2, 23, '7500.00', 100),
(36, 2, 24, '7500.00', 100),
(37, 2, 25, '7500.00', 100),
(38, 2, 26, '7500.00', 100),
(39, 2, 27, '7500.00', 100),
(40, 2, 28, '7500.00', 100),
(41, 2, 29, '7500.00', 100),
(42, 2, 30, '7500.00', 100),
(43, 2, 31, '7500.00', 100),
(44, 2, 32, '7500.00', 100),
(45, 2, 33, '7500.00', 100),
(46, 2, 34, '7500.00', 100),
(47, 2, 35, '7500.00', 100),
(48, 2, 36, '7500.00', 100),
(49, 2, 37, '7500.00', 100),
(50, 2, 38, '7500.00', 100),
(51, 2, 39, '7500.00', 100),
(52, 2, 40, '7500.00', 100),
(53, 2, 41, '7500.00', 100),
(54, 2, 42, '7500.00', 100),
(55, 2, 43, '7500.00', 100),
(56, 2, 44, '7500.00', 100),
(57, 2, 45, '7500.00', 100),
(58, 2, 46, '7500.00', 100),
(59, 2, 47, '7500.00', 100),
(60, 2, 48, '7500.00', 100),
(61, 2, 49, '7500.00', 100),
(62, 2, 50, '7500.00', 100),
(63, 2, 51, '7500.00', 100),
(64, 2, 52, '7500.00', 100),
(65, 2, 53, '7500.00', 100),
(66, 2, 54, '7500.00', 100),
(67, 2, 55, '7500.00', 100),
(68, 2, 56, '7500.00', 100),
(69, 2, 57, '7500.00', 100),
(70, 2, 58, '7500.00', 100),
(71, 2, 59, '7500.00', 100),
(72, 2, 60, '7500.00', 100),
(73, 2, 61, '7500.00', 100),
(74, 2, 62, '7500.00', 100),
(75, 2, 63, '7500.00', 100),
(76, 2, 64, '7500.00', 100),
(77, 2, 65, '7500.00', 100),
(78, 2, 66, '7500.00', 100),
(79, 2, 67, '7500.00', 100),
(80, 2, 68, '7500.00', 100),
(81, 2, 69, '7500.00', 100),
(82, 2, 70, '7500.00', 100),
(83, 2, 71, '7500.00', 100),
(84, 2, 72, '7500.00', 100),
(85, 2, 73, '7500.00', 100),
(86, 2, 74, '7500.00', 100),
(87, 2, 75, '7500.00', 100),
(88, 2, 76, '7500.00', 100),
(89, 2, 77, '7500.00', 100),
(90, 2, 78, '7500.00', 100),
(91, 2, 79, '7500.00', 100),
(92, 2, 80, '7500.00', 100),
(93, 2, 81, '7500.00', 100),
(94, 2, 82, '7500.00', 100),
(95, 2, 83, '7500.00', 100),
(96, 2, 84, '7500.00', 100),
(97, 2, 85, '7500.00', 100),
(98, 2, 86, '7500.00', 100),
(99, 2, 87, '7500.00', 100),
(100, 2, 88, '7500.00', 100),
(101, 2, 89, '7500.00', 100),
(102, 2, 90, '7500.00', 100),
(103, 2, 91, '7500.00', 100),
(104, 2, 92, '7500.00', 100),
(105, 2, 93, '7500.00', 100),
(106, 2, 94, '7500.00', 100),
(107, 2, 95, '7500.00', 100),
(108, 2, 96, '7500.00', 100),
(109, 2, 97, '7500.00', 100),
(110, 2, 98, '7500.00', 100),
(111, 2, 99, '7500.00', 100),
(112, 2, 100, '7500.00', 100),
(113, 2, 101, '7500.00', 100),
(114, 2, 102, '7500.00', 100),
(115, 2, 103, '7500.00', 100),
(116, 2, 104, '7500.00', 100),
(117, 2, 105, '7500.00', 100),
(118, 2, 106, '7500.00', 100),
(119, 2, 107, '7500.00', 100),
(120, 2, 108, '7500.00', 100),
(121, 2, 109, '7500.00', 100),
(122, 2, 110, '7500.00', 100),
(123, 2, 111, '7500.00', 100),
(124, 2, 112, '7500.00', 100),
(125, 2, 113, '7500.00', 100),
(126, 2, 114, '7500.00', 100),
(127, 2, 115, '7500.00', 100),
(128, 2, 116, '7500.00', 100),
(129, 2, 117, '7500.00', 100),
(130, 2, 118, '7500.00', 100),
(131, 2, 119, '7500.00', 100),
(132, 2, 120, '7500.00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `type` int(120) NOT NULL,
  `status` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `type`, `status`) VALUES
(1, 'Matthew', '$2y$10$pZnVQazN6HCtGSbRRS9gQ.9uUcd0qPCzhSr8HpNDsOEMmQ32QVqT2', 1, 1),
(2, 'Pendente', '$2y$10$MclZmCTrX9v8tVLPKYlbMeIRws5D6v3Rp162OcnrZGqy78oowgTqq', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `quota`
--
ALTER TABLE `quota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cli_id` (`cli_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quota`
--
ALTER TABLE `quota`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quota`
--
ALTER TABLE `quota`
  ADD CONSTRAINT `quota_ibfk_1` FOREIGN KEY (`cli_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
