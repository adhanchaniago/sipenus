-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2020 at 07:43 PM
-- Server version: 8.0.21-0ubuntu0.20.04.4
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sips`
--

-- --------------------------------------------------------

--
-- Table structure for table `minithesis`
--

CREATE TABLE `minithesis` (
  `id` int NOT NULL,
  `collage_student_id` int NOT NULL,
  `title` text NOT NULL,
  `guide_one` varchar(100) NOT NULL,
  `guide_two` varchar(100) NOT NULL,
  `examiner_one` varchar(100) NOT NULL,
  `examiner_two` varchar(100) NOT NULL,
  `examiner_three` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `minithesis`
--

INSERT INTO `minithesis` (`id`, `collage_student_id`, `title`, `guide_one`, `guide_two`, `examiner_one`, `examiner_two`, `examiner_three`) VALUES
(1, 2, 'Aplikasi Ojek Online Khusus Wanita', 'Bambang Pramono', 'Isnawaty', 'Jummdil', 'Fid Askara', 'Yamin'),
(2, 4, 'Bismillah ... 2020 Wisuda sdfsdf', 'R', 'W', 'R', 'Y', 'T'),
(3, 7, 'sistem informasi mencari cinta', 'w', 'd', 'ds', 'sd', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `minithesis_category`
--

CREATE TABLE `minithesis_category` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `minithesis_category`
--

INSERT INTO `minithesis_category` (`id`, `name`) VALUES
(1, 'Proposal'),
(2, 'Result'),
(3, 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `minithesis_id` int NOT NULL,
  `room` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `upload_at` datetime NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `category_id`, `minithesis_id`, `room`, `time`, `upload_at`, `status`) VALUES
(1, 1, 1, 'Ruang Sidang A', '2020-08-23 13:00:00', '2020-08-21 16:12:03', 1),
(2, 2, 1, 'Ruang Sidang B', '2020-09-12 10:00:00', '2020-08-21 16:13:34', 1),
(3, 3, 1, NULL, NULL, '2020-08-21 17:42:19', 0),
(4, 1, 2, NULL, NULL, '2020-08-21 20:45:51', 0),
(5, 1, 3, NULL, NULL, '2020-08-24 18:14:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `uid` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` int NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `email`, `password`, `first_name`, `last_name`, `gender`, `phone`, `role`) VALUES
(1, 'fadel', 'fadel@sipenus.com', '55c3b5386c486feb662a0785f340938f518d547f', 'Muhammad', 'Fadel', 1, '082122334455', 1),
(2, 'E1E117018', 'mahasiswa@sipenus.com', '55c3b5386c486feb662a0785f340938f518d547f', 'Mahasiswa', 'Sipenus', 1, '085161718191', 2),
(4, 'E1E117065', 'tiyanattirmidzi20@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', 'Tiyan', 'Attirmidzi', 1, '081133557799', 2),
(5, 'E1E117011', 'iklil@iklil.com', '55c3b5386c486feb662a0785f340938f518d547f', 'Iklil', 'Tariza', 0, '082324252618', 2),
(7, 'e1e117017', 'danil@gmail.com', '55c3b5386c486feb662a0785f340938f518d547f', 'muhammad', 'danil', 1, '081133557799', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `minithesis`
--
ALTER TABLE `minithesis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minithesis_category`
--
ALTER TABLE `minithesis_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
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
-- AUTO_INCREMENT for table `minithesis`
--
ALTER TABLE `minithesis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `minithesis_category`
--
ALTER TABLE `minithesis_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
