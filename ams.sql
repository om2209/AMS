-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2018 at 09:11 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `reg_id` varchar(20) COLLATE utf32_bin NOT NULL,
  `papercode` varchar(5) COLLATE utf32_bin NOT NULL,
  `dates` varchar(20) COLLATE utf32_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`reg_id`, `papercode`, `dates`) VALUES
('2015UGCS014', 'CS701', '14/07/2018'),
('2015UGCS014', 'CS701', '15/07/2018'),
('2015UGCS014', 'CS701', '17/07/2018'),
('2015UGCS015', 'CS701', '14/07/2018'),
('2015UGCS015', 'CS701', '15/07/2018'),
('2015UGCS015', 'CS701', '17/07/2018');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` varchar(5) COLLATE utf32_bin NOT NULL,
  `sem` varchar(5) COLLATE utf32_bin NOT NULL,
  `faculty` varchar(20) COLLATE utf32_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `sem`, `faculty`) VALUES
('CS701', 'VII', 'vsoni');

-- --------------------------------------------------------

--
-- Table structure for table `course_stud`
--

CREATE TABLE `course_stud` (
  `c_code` varchar(6) COLLATE utf32_bin NOT NULL,
  `reg_id` varchar(20) COLLATE utf32_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

--
-- Dumping data for table `course_stud`
--

INSERT INTO `course_stud` (`c_code`, `reg_id`) VALUES
('CS701', '2015UGCS014'),
('CS701', '2015UGCS015');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `reg_id` varchar(20) COLLATE utf32_bin NOT NULL,
  `dept_name` varchar(5) COLLATE utf32_bin NOT NULL,
  `sem` varchar(5) COLLATE utf32_bin NOT NULL,
  `password` varchar(500) COLLATE utf32_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_id`, `dept_name`, `sem`, `password`) VALUES
('2015UGCS014', 'CSE', 'VII', '827ccb0eea8a706c4c34a16891f84e7b'),
('2015UGCS015', 'CSE', 'VII', '827ccb0eea8a706c4c34a16891f84e7b'),
('2017PGCACA35', 'DCA', 'III', '37ab9111c42e81ea9ad77c2362503ad3');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(5) NOT NULL,
  `username` varchar(20) COLLATE utf32_bin NOT NULL,
  `deptname` varchar(5) COLLATE utf32_bin NOT NULL,
  `password` varchar(500) COLLATE utf32_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `username`, `deptname`, `password`) VALUES
(1, 'vsoni', 'CSE', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'shubh', 'CSE', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 'om_2209', 'CSE', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'arpita_ss', 'CSE', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `ccode` varchar(5) COLLATE utf32_bin DEFAULT NULL,
  `dates` varchar(20) COLLATE utf32_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`ccode`, `dates`) VALUES
('CS701', '17/07/2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`reg_id`,`papercode`,`dates`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
