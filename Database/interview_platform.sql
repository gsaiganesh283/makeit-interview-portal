-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2024 at 09:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interview_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `aiusers`
--

CREATE TABLE `aiusers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aiusers`
--

INSERT INTO `aiusers` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'testuser1', '$2y$10$wNn6YHR/Rl9x9s.uwCB.kOecAEiR/TZHpJWRGRwXfcoLeW4pKFlWa', '2024-08-10 06:49:33'),
(2, 'testuser2', '$2y$10$lt/UCyXfFVhzxyT1vKp.u.TlgP48S0Gk53Hqf4RtM3iViLEuFfRli', '2024-08-10 06:49:33');

-- --------------------------------------------------------

--
-- Table structure for table `clientusers`
--

CREATE TABLE `clientusers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientusers`
--

INSERT INTO `clientusers` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'testuser1', '', '$2y$10$wNn6YHR/Rl9x9s.uwCB.kOecAEiR/TZHpJWRGRwXfcoLeW4pKFlWa', '2024-08-10 06:49:04'),
(2, 'testuser2', '', '$2y$10$lt/UCyXfFVhzxyT1vKp.u.TlgP48S0Gk53Hqf4RtM3iViLEuFfRli', '2024-08-10 06:49:04'),
(3, 'saiganesh', 'gg4906@srmist.edu.in', '$2y$10$Cjeb7tMVWqZj7Z90sPbL0OzMO02MNsjx7vc5McdP6j6xK38as/6Bi', '2024-08-10 07:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `example` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `description`, `example`) VALUES
(1, 'Arrays & Hashing: Simplifying Email Addresses', 'Write a function to simplify email addresses by removing unnecessary characters.', 'Given the input `[\"test.email+alex@leetcode.com\",\"test.e.mail+bob.cathy@leetcode.com\",\"testemail+david@lee.tcode.com\"]`, the function should return `2` because `testemail@leetcode.com` and `testemail@lee.tcode.com` are unique.'),
(2, 'hi', 'hi', 'hi');

--
-- Indexes for dumped tables
--

-- Table structure for table `testcases`
CREATE TABLE `testcases` (
  `id` int(11) NOT NULL,
  `input` varchar(50) NOT NULL,
  `output` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table 'testcases'

INSERT INTO `testcases` (`id`,`input`, `output`) VALUES
('1','2 4', '2'),
('2','3 9', '3');

--
-- Indexes for table `aiusers`
--
ALTER TABLE `aiusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `clientusers`
--
ALTER TABLE `clientusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aiusers`
--
ALTER TABLE `aiusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clientusers`
--
ALTER TABLE `clientusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;