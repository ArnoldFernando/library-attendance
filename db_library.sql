-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 04:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sessions`
--

CREATE TABLE `tbl_sessions` (
  `session_id` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `total_minutes` decimal(5,2) DEFAULT NULL,
  `validity` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sessions`
--

INSERT INTO `tbl_sessions` (`session_id`, `student_id`, `time_in`, `time_out`, `total_minutes`, `validity`) VALUES
('09cc4e437c97b639cf5f12fb', 'S001', '2023-10-12 13:51:24', '2023-10-12 15:08:18', 76.90, 0),
('39af7fa5a2bac69d637f9bb5', 'S001', '2023-10-12 13:28:06', '2023-10-12 13:43:56', 15.83, 0),
('8b4f62eabb9e1e565d2c48fc', 'S002', '2023-10-12 14:31:52', '2023-10-12 15:17:49', 45.95, 0),
('a89d51ad26b344b48848c317', 'S001', '2023-10-12 13:45:39', '2023-10-12 13:45:44', 0.08, 0),
('d149976e05d6879499e206c5', 'S001', '2023-10-14 10:36:16', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `student_id` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`student_id`, `last_name`, `first_name`, `middle_name`, `age`, `sex`, `course`, `year_level`) VALUES
('S001', 'Smith', 'John', 'Michael', 21, 'Male', 'Computer Science', 'Sophomore'),
('S002', 'Johnson', 'Emily', 'Grace', 20, 'Female', 'Psychology', 'Freshman'),
('S003', 'Brown', 'William', 'Robert', 22, 'Male', 'Engineering', 'Junior'),
('S004', 'Davis', 'Olivia', 'Sophia', 19, 'Female', 'Biology', 'Freshman'),
('S005', 'Wilson', 'James', 'David', 20, 'Male', 'Mathematics', 'Sophomore'),
('S006', 'Martinez', 'Sophia', 'Lynn', 21, 'Female', 'Chemistry', 'Junior'),
('S007', 'Jones', 'Liam', 'Ethan', 23, 'Male', 'Business Administration', 'Senior'),
('S008', 'Garcia', 'Ava', 'Isabella', 19, 'Female', 'History', 'Freshman'),
('S009', 'Anderson', 'Mason', 'Lucas', 22, 'Male', 'Nursing', 'Junior'),
('S010', 'Thomas', 'Charlotte', 'Zoe', 20, 'Female', 'Marketing', 'Sophomore'),
('S011', 'Harris', 'Ella', 'Aiden', 21, 'Male', 'Education', 'Junior'),
('S012', 'Clark', 'Amelia', 'Lily', 20, 'Female', 'Physics', 'Sophomore'),
('S013', 'Miller', 'Benjamin', 'Alexander', 22, 'Male', 'Political Science', 'Junior'),
('S014', 'White', 'Luna', 'Aria', 19, 'Female', 'Sociology', 'Freshman'),
('S015', 'Lee', 'Lucas', 'Elijah', 21, 'Male', 'English Literature', 'Sophomore'),
('S016', 'Adams', 'Avery', 'Grace', 20, 'Female', 'Art History', 'Sophomore'),
('S017', 'Hill', 'Ethan', 'Evelyn', 22, 'Male', 'Music', 'Junior'),
('S018', 'Turner', 'Lily', 'Chloe', 19, 'Female', 'Geology', 'Freshman'),
('S019', 'Parker', 'Elijah', 'Michael', 21, 'Male', 'Economics', 'Sophomore'),
('S020', 'Carter', 'Scarlett', 'Sophia', 20, 'Female', 'Communication', 'Sophomore');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `fk_student_id` (`student_id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `tbl_students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
