-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 01:57 AM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `note_tbl`
--

CREATE TABLE `note_tbl` (
  `note_name` varchar(100) NOT NULL,
  `note_date` date NOT NULL,
  `note_message` varchar(100) NOT NULL,
  `note_status` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `note_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `note_tbl`
--

INSERT INTO `note_tbl` (`note_name`, `note_date`, `note_message`, `note_status`, `user_id`, `note_id`) VALUES
('asdff', '2024-09-19', 'asd', 'New', 1, 1),
('asd', '2024-09-19', 'asd', 'New', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_fname` varchar(100) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `user_age` int(100) NOT NULL,
  `user_gender` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_fname`, `user_lname`, `user_age`, `user_gender`, `user_email`, `user_password`, `user_id`) VALUES
('harfeil', 'Salmeron', 12, 'Male ', 'harfeilsalmeron1@gmail.com', '$2y$10$2uBRElRxMJ6q5UpgXzAb8.hI9SjY6ap9sLcOyFf8Kt.m3IJRFqqkK', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `note_tbl`
--
ALTER TABLE `note_tbl`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `note_tbl`
--
ALTER TABLE `note_tbl`
  MODIFY `note_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `note_tbl`
--
ALTER TABLE `note_tbl`
  ADD CONSTRAINT `note_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
