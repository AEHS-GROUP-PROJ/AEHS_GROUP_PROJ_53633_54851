-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 18, 2024 at 09:21 PM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_at` datetime NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `user_id`, `submitted_at`, `title`, `text`) VALUES
(1, 15, '2024-01-12 09:45:33', 'Semester Start', 'The new semester will begin on January 15th. All students are advised to check their timetables and classroom assignments before the start of the semester.\n\nPlease ensure that you have completed all pre-semester requirements including book rentals and lab registrations.\n\nWishing everyone a successful semester ahead!'),
(2, 21, '2024-02-05 14:23:47', 'Library Closure', 'The library will be closed for maintenance on February 10th. During this period, students are encouraged to use the online resources available on the university portal.\n\nThe maintenance is expected to enhance our library services and provide a better study environment for all.\n\nWe apologize for any inconvenience this may cause and appreciate your understanding.'),
(3, 18, '2024-03-08 10:15:56', 'Workshop', 'Join us for a workshop on study skills on March 12th. This workshop will cover effective study techniques, time management skills, and methods to reduce exam stress.\n\nAttendees will also receive free study materials and a certificate of participation.\n\nTo register, please visit the student services office or sign up online.'),
(4, 11, '2024-04-01 11:35:21', 'Exam Schedule', 'The final exam schedule has been posted on the website. Students are required to review the schedule and note their respective exam dates and times.\n\nPlease ensure you arrive at the exam hall at least 15 minutes before the start of your exam. Any clashes in the schedule should be reported to the exam office immediately.\n\nBest of luck to all students!'),
(5, 13, '2024-05-02 16:02:19', 'Guest Lecture', 'A guest lecture by Dr. Smith will be held on May 5th. Dr. Smith, a renowned expert in environmental science, will be discussing the impacts of climate change on global biodiversity.\n\nThe lecture will be followed by a Q&A session and an opportunity for students to interact with Dr. Smith personally.\n\nDon\'t miss this chance to gain insights from a leading expert in the field.'),
(6, 17, '2024-01-25 15:47:50', 'Holiday Notice', 'The university will be closed on January 26th for Republic Day.\n\nStudents and staff are encouraged to participate in the Republic Day celebrations being organized by the local community.\n\nRegular classes and office hours will resume on January 27th. We hope everyone enjoys a safe and joyful holiday.'),
(7, 23, '2024-02-17 13:14:33', 'Cultural Fest', 'The annual cultural fest will take place on March 1st. This year\'s fest promises to be bigger and better with a variety of performances, workshops, and food stalls.\n\nHighlights include a dance competition, a musical night, and a fashion show.\n\nStudents are encouraged to participate and showcase their talents. Let\'s come together to celebrate our diverse culture and community spirit.'),
(8, 20, '2024-03-19 09:50:27', 'Sports Day', 'Sports day will be held on March 25th. All students are encouraged to participate in various events such as track and field, basketball, and volleyball.\n\nThis is a great opportunity to demonstrate your sportsmanship and team spirit. Awards and certificates will be given to winners and participants.\n\nLet\'s make this event memorable with your active participation.'),
(9, 12, '2024-04-10 14:30:12', 'Results Announcement', 'Semester results will be announced on April 15th. Students can access their results online through the student portal using their credentials.\n\nIn case of any discrepancies or concerns regarding the results, students are advised to contact the examination office immediately.\n\nWe congratulate all students on their hard work and dedication throughout the semester.'),
(10, 14, '2024-05-16 11:05:44', 'Graduation Ceremony', 'The graduation ceremony is scheduled for May 20th.\n\nGraduating students are required to confirm their attendance by May 18th. The ceremony will include a procession, keynote speeches, and the awarding of diplomas.\n\nFamily and friends are welcome to attend and celebrate this significant milestone.\n\nWe look forward to honoring our graduates and their achievements.');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `course_id`, `title`, `deadline`) VALUES
(13, 15, 'Programming Basics Assignment', '2024-01-15 10:00:00'),
(14, 20, 'Psychology Research Paper', '2024-01-25 17:00:00'),
(15, 17, 'Chemistry Lab Report 1', '2024-02-01 23:59:00'),
(16, 22, 'Essay on Ancient Religions', '2024-02-10 11:59:00'),
(17, 16, 'Shakespearean Literature Analysis', '2024-02-15 14:00:00'),
(18, 21, 'Business Strategy Report', '2024-02-20 12:00:00'),
(19, 19, 'Engineering Mathematics Problem Set 1', '2024-03-01 18:00:00'),
(20, 15, 'Introduction to Algorithms', '2024-03-05 16:00:00'),
(21, 23, 'Digital Marketing Strategy Plan', '2024-03-10 20:00:00'),
(22, 24, 'Environmental Impact Report', '2024-03-15 09:00:00'),
(23, 17, 'Organic Chemistry Project', '2024-03-20 13:00:00'),
(24, 20, 'Case Study: Psychological Disorders', '2024-03-25 11:59:00'),
(25, 18, 'Analysis of Renaissance Art', '2024-03-30 23:59:00'),
(26, 21, 'Business Management Case Study', '2024-04-05 14:00:00'),
(27, 22, 'Research Paper on World Religions', '2024-04-10 10:00:00'),
(28, 16, 'Essay on Modern English Literature', '2024-04-15 16:00:00'),
(29, 19, 'Engineering Calculus Assignment', '2024-04-20 17:00:00'),
(30, 23, 'Digital Marketing Campaign Project', '2024-04-25 13:00:00'),
(31, 24, 'Sustainability Analysis Report', '2024-05-01 12:00:00'),
(32, 15, 'Database Management Systems Project', '2024-05-05 20:00:00'),
(33, 18, 'Art History Research Paper', '2024-05-10 09:00:00'),
(34, 22, 'Comparative Religion Essay', '2024-05-15 23:59:00'),
(35, 17, 'Chemistry Lab Report 2', '2024-05-20 14:00:00'),
(36, 21, 'Operations Management Analysis', '2024-05-25 11:59:00'),
(37, 19, 'Engineering Statistics Homework', '2024-06-01 16:00:00'),
(38, 24, 'Environmental Science Field Report', '2024-06-05 13:00:00'),
(39, 15, 'Introduction to Networking Project', '2024-06-10 12:00:00'),
(40, 23, 'SEO Optimization Report', '2024-06-15 17:00:00'),
(41, 20, 'Personality Psychology Paper', '2024-06-20 09:00:00'),
(42, 16, 'Literature Review on English Novels', '2024-06-25 20:00:00'),
(43, 21, 'Entrepreneurship Business Plan', '2024-07-01 11:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `assignment_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `submitted_at` datetime NOT NULL,
  `text` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`assignment_id`, `student_id`, `submitted_at`, `text`, `grade`) VALUES
(13, 10, '2024-01-30 12:45:15', 'Chemistry lab report on the reactions observed in the first experiment.', 6),
(13, 14, '2024-05-20 10:30:20', 'Chemistry lab report on reactions and their implications.', 10),
(14, 19, '2024-02-12 09:10:20', 'An analysis of Shakespeare\'s influence on modern literature, focusing on Macbeth.', NULL),
(14, 21, '2024-02-28 14:45:15', 'Literature analysis focusing on the works of William Shakespeare.', 6),
(15, 12, '2024-01-12 10:15:30', 'An essay analyzing the Shakespearean literature with a focus on Hamlet.', NULL),
(15, 17, '2024-02-04 18:20:10', 'Shakespearean literature analysis, focusing on the themes of love and betrayal.', NULL),
(16, 13, '2024-04-05 18:25:35', 'Case study on psychological disorders, including treatment methods and outcomes.', 9),
(16, 22, '2024-03-28 10:50:15', 'Case study on psychological disorders, focusing on treatment methods and outcomes.', 10),
(17, 21, '2024-02-03 11:45:30', 'Lab report on the first chemistry experiment, covering the reactions and results.', NULL),
(17, 22, '2024-02-16 15:50:25', 'Lab report on chemistry experiment 2, detailing the procedures and findings.', 7),
(18, 21, '2024-04-12 16:05:30', 'Business management case study analyzing the effectiveness of different management styles.', 8),
(18, 23, '2024-04-15 10:15:30', 'Business management case study analyzing the impact of different management styles.', NULL),
(19, 12, '2024-02-10 10:30:35', 'Research paper on psychological disorders and their treatment options.', 8),
(19, 15, '2024-01-20 14:22:05', 'Research paper discussing psychological disorders and their impact on society.', NULL),
(20, 16, '2024-01-10 14:20:35', 'Analysis of digital marketing strategies, including SEO and content marketing.', 8),
(20, 19, '2024-05-25 13:15:30', 'Report on psychological research methods and their practical applications.', NULL),
(21, 12, '2024-04-25 13:30:50', 'Essay on modern English literature, focusing on contemporary authors.', 6),
(21, 23, '2024-04-26 12:45:50', 'Essay on modern English literature, focusing on the works of Virginia Woolf.', 8),
(22, 13, '2024-03-15 11:00:40', 'Environmental impact report discussing the effects of pollution on marine life.', 9),
(22, 23, '2024-03-25 16:30:10', 'Environmental impact report analyzing the effects of pollution on wildlife.', 8),
(23, 11, '2024-02-18 17:50:30', 'Case study examining different business strategies and their outcomes.', NULL),
(23, 20, '2024-03-05 12:05:30', 'Business strategy report analyzing different management techniques.', NULL),
(24, 11, '2024-01-20 09:30:50', 'Research paper on Shakespearean plays, focusing on their cultural impact.', 9),
(25, 10, '2024-02-08 16:20:45', 'A comprehensive analysis of ancient religions and their influence on modern culture.', NULL),
(25, 18, '2024-02-22 11:25:50', 'Comprehensive essay on ancient religions and their impact on modern society.', 9),
(26, 11, '2024-03-15 11:20:35', 'Introduction to algorithms assignment, with examples and explanations.', 9),
(26, 20, '2024-03-03 18:45:50', 'Assignment covering the basics of algorithms, with examples and explanations.', NULL),
(27, 15, '2024-05-05 12:40:20', 'Project on digital marketing, with a focus on social media strategy.', 7),
(27, 18, '2024-05-08 18:15:10', 'Digital marketing campaign project, with a focus on social media strategy.', 9),
(28, 19, '2024-01-25 17:00:25', 'Analysis of business strategies in modern corporations, with case studies.', NULL),
(28, 22, '2024-06-04 14:20:15', 'Business strategy analysis, including case studies of successful companies.', 7),
(29, 10, '2024-03-30 12:10:25', 'Lab report on the third chemistry experiment, covering reactions and results.', NULL),
(29, 14, '2024-03-22 15:30:20', 'Lab report on the second chemistry experiment, detailing the process and results.', 7),
(30, 15, '2024-03-10 15:40:25', 'Mathematics problem set focusing on calculus applications in engineering.', NULL),
(30, 18, '2024-02-24 12:05:10', 'Mathematical problem set focusing on calculus and its applications in engineering.', 6),
(31, 15, '2024-05-18 20:30:25', 'Project on the basics of networking, covering protocols and network design.', 10),
(31, 18, '2024-05-15 16:45:50', 'Project on networking basics, covering protocols and network design.', NULL),
(32, 10, '2024-06-14 11:05:25', 'Digital marketing plan focusing on SEO and social media strategies.', NULL),
(32, 14, '2024-03-20 09:45:50', 'Digital marketing strategy plan, focusing on SEO and content marketing.', 6),
(32, 17, '2024-03-09 14:15:35', 'Strategic plan for a digital marketing campaign, including SEO and social media.', NULL),
(33, 12, '2024-05-02 15:30:30', 'Assignment on engineering calculus, including problem sets and solutions.', NULL),
(33, 23, '2024-04-30 15:55:15', 'Engineering calculus problem set, including examples and solutions.', 9),
(34, 16, '2024-04-05 13:10:25', 'An in-depth analysis of Renaissance art, with a focus on Leonardo da Vinci.', NULL),
(34, 19, '2024-04-10 14:00:20', 'In-depth analysis of Renaissance art, focusing on major artists and their works.', 7),
(35, 17, '2024-04-20 09:45:10', 'Research paper on world religions and their historical significance.', NULL),
(35, 20, '2024-04-19 09:25:40', 'Research paper comparing different world religions and their historical contexts.', 6),
(36, 14, '2024-05-14 11:45:20', 'Environmental science field report, detailing observations and data analysis.', 7),
(36, 23, '2024-05-10 11:25:30', 'Field report for environmental science, including observations and data analysis.', 8),
(37, 23, '2024-01-15 11:15:40', 'Report on psychological research methods and their applications.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `lecture_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`lecture_id`, `student_id`) VALUES
(18, 11),
(18, 12),
(18, 13),
(19, 13),
(19, 14),
(18, 15),
(19, 18),
(18, 20),
(12, 21),
(12, 23),
(13, 23),
(14, 23),
(19, 23);

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `title`, `location`, `capacity`) VALUES
(3, 'Room 101', 'Campus A, Main Building', 30),
(4, 'Room 202', 'Campus B, Science Block', 30),
(5, 'Room 305', 'Campus C, Arts Building', 30),
(6, 'Room 410', 'Campus D, Humanities Wing', 50),
(7, 'Room 512', 'Campus E, Engineering Block', 55),
(8, 'Physics Lab', '31 Wilcza Street, Warsaw', 60),
(9, 'Chemistry Lab', '12 Żurawia Street, Warsaw', 80),
(10, 'Computer Lab', '18 Nowogrodzka Street, Warsaw', 60),
(11, 'Biology Lab', '9 Piękna Street, Warsaw', 80),
(12, 'Lecture Hall 1', 'Campus A, Main Building', 220),
(13, 'Lecture Hall 2', 'Campus C, Arts Building', 160);

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
(21, 'Business Management Essentials', '2024-03-06', '2024-08-10', 50),
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
(11, 15, 0),
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
(17, 23, 1),
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
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `lecturer_id` bigint(20) UNSIGNED NOT NULL,
  `classroom_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `course_id`, `lecturer_id`, `classroom_id`, `title`, `starts_at`) VALUES
(10, 18, 16, 3, 'The Renaissance: Art and Innovation', '2024-04-25 08:00:00'),
(11, 24, 18, 4, 'Water Resources and Management', '2024-04-30 10:00:00'),
(12, 23, 19, 13, 'Email Marketing Best Practices', '2024-04-30 23:33:00'),
(13, 18, 17, 7, 'Asian Art: Traditions and Influences', '2024-04-30 10:00:00'),
(14, 18, 18, 12, 'Contemporary Art: Trends and Critiques', '2024-05-01 08:00:00'),
(15, 18, 20, 3, 'Women Artists in History', '2024-04-18 11:00:00'),
(16, 23, 15, 11, 'Web Analytics and Tracking Tools', '2024-04-30 10:00:00'),
(17, 23, 13, 5, 'Influencer Marketing in the Digital Age', '2024-04-30 12:00:00'),
(18, 21, 23, 9, 'Human Resources and Management', '2024-05-04 06:00:00'),
(19, 18, 23, 11, 'European Art: Traditions and Influences', '2024-05-04 08:00:00'),
(22, 15, 17, 3, 'Computer Science Basics', '2024-05-21 09:30:00'),
(23, 16, 19, 4, 'English Literature Survey', '2024-06-10 13:45:00'),
(24, 17, 12, 5, 'Chemistry Fundamentals', '2024-06-02 11:20:00'),
(25, 18, 22, 6, 'Art History Overview', '2024-05-28 10:00:00'),
(26, 19, 15, 7, 'Mathematics for Engineers', '2024-06-28 15:00:00'),
(27, 20, 18, 8, 'Introduction to Psychology', '2024-05-26 14:30:00'),
(28, 21, 20, 9, 'Business Management Essentials', '2024-06-03 12:15:00'),
(29, 22, 16, 10, 'World Religions History', '2024-06-16 16:45:00'),
(30, 23, 21, 11, 'Digital Marketing', '2024-06-23 08:45:00'),
(31, 24, 11, 12, 'Environmental Science', '2024-06-09 10:20:00'),
(32, 15, 14, 13, 'Computer Science Basics', '2024-06-11 09:30:00'),
(33, 16, 10, 3, 'English Literature Survey', '2024-06-14 13:45:00'),
(34, 17, 13, 4, 'Chemistry Fundamentals', '2024-06-18 11:20:00'),
(35, 18, 23, 5, 'Art History Overview', '2024-06-25 10:00:00'),
(36, 19, 10, 6, 'Mathematics for Engineers', '2024-06-28 15:00:00'),
(37, 20, 16, 7, 'Introduction to Psychology', '2024-06-22 14:30:00'),
(38, 21, 12, 8, 'Business Management Essentials', '2024-06-10 12:15:00'),
(39, 22, 17, 9, 'World Religions History', '2024-06-16 16:45:00'),
(40, 23, 20, 10, 'Digital Marketing', '2024-06-23 08:45:00'),
(41, 24, 15, 11, 'Environmental Science', '2024-06-09 10:20:00');

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
('0nntAZtmP1QuBpwP', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('7awh0rumiFLKMJtO', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('CZlOhA0pSnjZKCcS', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('Dy4wYUMkGgT9bZsL', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('EWO7SJYVMGJREUso', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('FRsESUQCfL8CR6tk', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('FvkxbJRH26diGHPm', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('MHosYh7TpJSmK9ml', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('NdkSzY6Md6uYMgR2', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('OmD1QbZrTmTpJMMa', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('PE1MyD8ii9Vl8vmi', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('Ps6NXhEHSWTNosuH', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('RyVfv17uc7wrwLtu', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('UBRNvPDhACLn3Jzp', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('atEu69vq9BNcqTwx', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('fV4VaJbsS09M8jKA', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('g0iqz0obqrNaGxn6', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('h5ilZl9nTS9yh0pk', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('j8D4AbPwrm5p1jNS', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('mgiH1k4u25TlS4Qe', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('tEnk8AK7jQ7chBhv', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('wN2xteLp0fKEUycp', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.'),
('wcGmQAoBbwhkLACt', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.');

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
(22, 'samantha.thomas@zoho.com', 'Samantha Thomas', NULL, '+48123456788', 1, 1, 0, 'ee79976c9380d5e337fc1c095ece8c8f22f91f306ceeb161fa51fecede2c4ba1'),
(23, 'melihov@me.com', 'Mikhail Melikhov', '01-931, Warszawa, Wólczyńska 45', '+48578546532', 1, 1, 1, '46a9cbdfc126d2606caa297826c16ae949b8373193d67dad6ffcbe30077b34a7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements.users` (`user_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments.courses` (`course_id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`assignment_id`,`student_id`),
  ADD KEY `assignment_submissions.users` (`student_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`lecture_id`,`student_id`),
  ADD KEY `attendance.users` (`student_id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

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
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lectures.courses` (`course_id`),
  ADD KEY `lectures.users` (`lecturer_id`),
  ADD KEY `lectures.classrooms` (`classroom_id`);

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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements.users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments.courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD CONSTRAINT `assignment_submissions.assignments` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_submissions.users` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance.lectures` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance.users` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD CONSTRAINT `enrollments.courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments.users` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `lectures.classrooms` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lectures.courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lectures.users` FOREIGN KEY (`lecturer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions.users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
