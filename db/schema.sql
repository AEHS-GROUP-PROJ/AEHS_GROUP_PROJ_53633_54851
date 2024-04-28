-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 14, 2024 at 08:39 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `places` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `start_date`, `end_date`, `places`) VALUES
(15, 'Computer Science Basics', '2024-06-10', '2024-07-10', 25),
(16, 'English Literature Survey', '2024-06-15', '2024-07-15', 35),
(17, 'Chemistry Fundamentals', '2024-06-20', '2024-07-20', 40),
(18, 'Art History Overview', '2024-06-25', '2024-07-25', 30),
(19, 'Mathematics for Engineers', '2024-07-01', '2024-08-01', 20),
(20, 'Introduction to Psychology', '2024-07-05', '2024-08-05', 45),
(21, 'Business Management Essentials', '2024-07-10', '2024-08-10', 50),
(22, 'World Religions History', '2024-07-15', '2024-08-15', 30),
(23, 'Digital Marketing', '2024-07-20', '2024-08-20', 35),
(24, 'Environmental Science', '2024-07-25', '2024-08-25', 25);

-- --------------------------------------------------------

--
-- Table structure for table `enrolments`
--

CREATE TABLE `enrolments` (
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `is_accepted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolments`
--

INSERT INTO `enrolments` (`student_id`, `course_id`, `is_accepted`) VALUES
(10, 18, 1),
(10, 20, 1),
(10, 23, 1),
(11, 15, 1),
(11, 21, 1),
(11, 24, 1),
(12, 16, 0),
(12, 17, 0),
(12, 20, 0),
(12, 21, 1),
(13, 18, 0),
(13, 19, 1),
(13, 21, 1),
(13, 22, 1),
(14, 15, 1),
(14, 17, 0),
(14, 18, 0),
(14, 21, 0),
(15, 15, 1),
(15, 21, 1),
(15, 22, 1),
(16, 19, 1),
(16, 22, 1),
(16, 23, 1),
(17, 15, 0),
(17, 16, 0),
(17, 23, 0),
(18, 18, 1),
(18, 20, 0),
(18, 22, 1),
(19, 20, 0),
(19, 23, 1),
(19, 24, 0),
(20, 16, 1),
(20, 21, 0),
(20, 23, 0),
(21, 16, 1),
(21, 19, 1),
(21, 22, 1),
(22, 15, 1),
(22, 17, 1),
(22, 23, 0),
(22, 24, 0),
(23, 18, 1),
(23, 19, 0),
(23, 20, 0),
(23, 21, 1),
(23, 22, 0),
(23, 23, 1),
(23, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `token` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `host` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`token`, `user_id`, `host`, `agent`) VALUES
('CZlOhA0pSnjZKCcS', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('Dy4wYUMkGgT9bZsL', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('EWO7SJYVMGJREUso', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('NdkSzY6Md6uYMgR2', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('OmD1QbZrTmTpJMMa', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('PE1MyD8ii9Vl8vmi', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('RyVfv17uc7wrwLtu', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('UBRNvPDhACLn3Jzp', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('fV4VaJbsS09M8jKA', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('h5ilZl9nTS9yh0pk', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('j8D4AbPwrm5p1jNS', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('mgiH1k4u25TlS4Qe', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('pmv2k750nmes80KI', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('tEnk8AK7jQ7chBhv', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_student` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `is_lecturer` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `is_admin` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `password_hash` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `full_name`, `address`, `phone`, `is_student`, `is_lecturer`, `is_admin`, `password_hash`) VALUES
(10, 'n.gurchiani@gmail.com', 'Nika Gurchiani', NULL, '+48485375948', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(11, 'e.rustamov@mail.com', 'Eljan Rustamov', NULL, '+48983564987', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(12, 's.rentapalli@yahoo.com', 'Sai Rentapalli', NULL, '+48465874095', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(13, 'adam.nowak@example.com', 'Adam Nowak', NULL, '+48123456789', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(14, 'anna.kowalska@mail.com', 'Anna Kowalska', NULL, '+48123456780', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(15, 'brandon.williams@gmail.com', 'Brandon Williams', NULL, '+48123456781', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(16, 'magdalena.wozniak@outlook.com', 'Magdalena Woźniak', NULL, '+48123456782', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(17, 'michael.anderson@yahoo.com', 'Michael Anderson', NULL, '+48123456783', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(18, 'jessica.brown@aol.com', 'Jessica Brown', NULL, '+48123456784', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(19, 'justin.taylor@icloud.com', 'Justin Taylor', NULL, '+48123456785', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(20, 'agnieszka.kozlowska@protonmail.com', 'Agnieszka Kozłowska', NULL, '+48123456786', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(21, 'kevin.white@live.com', 'Kevin White', NULL, '+48123456787', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(22, 'samantha.thomas@zoho.com', 'Samantha Thomas', NULL, '+48123456788', 1, 1, 1, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(23, 'melihov@me.com', 'Mikhail Melikhov', NULL, '+48573952932', 1, 1, 1, '46a9cbdfc126d2606caa297826c16ae949b8373193d67dad6ffcbe30077b34a7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `enrollments.courses` (`course_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD CONSTRAINT `enrollments.courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments.users` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions.users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
