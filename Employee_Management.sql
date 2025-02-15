-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 07:11 AM
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
-- Database: `socialpact`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dpt_id` int(3) NOT NULL,
  `dpt_name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `mem_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dpt_id`, `dpt_name`, `designation`, `mem_id`) VALUES
(1, 'Human Resource', 'Department Head', 1),
(3, 'Sports', 'Treasurer', 3),
(4, 'Technical', 'Department Head', 4),
(5, 'Sports', 'Department Head', 5),
(6, 'Educational', 'Department Head', 6),
(7, 'Human Resource', 'Member', 7),
(8, 'Sports', 'Member', 8),
(9, '', 'Department Head', 9),
(10, 'Educational', 'Member', 10),
(11, 'Meadia & Marketing', 'Member', 11),
(12, 'Media & Marketing', 'Member', 12),
(13, 'Media and Marketing', 'Member', 13);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `doc_id` int(3) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `identity_document` varchar(255) NOT NULL,
  `mem_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`doc_id`, `profile_image`, `identity_document`, `mem_id`) VALUES
(1, 'uploads/shubham_shetmandrekar/profile_shubham_shetmandrekar.png', 'uploads/shubham_shetmandrekar/identity_shubham_shetmandrekar.pdf', 1),
(3, 'uploads/ramesh_mandrekar/profile_ramesh_mandrekar.png', 'uploads/ramesh_mandrekar/identity_ramesh_mandrekar.pdf', 3),
(4, 'uploads/shyam_paesekar/profile_shyam_paesekar.png', 'uploads/shyam_paesekar/identity_shyam_paesekar.pdf', 4),
(5, 'uploads/mahesh_shirodkar/profile_mahesh_shirodkar.jpeg', 'uploads/mahesh_shirodkar/identity_mahesh_shirodkar.pdf', 5),
(6, 'uploads/shivam_/profile_shivam_.jpeg', 'uploads/shivam_/identity_shivam_.pdf', 6),
(7, 'uploads/aitdcanteen107/profile_aitdcanteen107.jpeg', 'uploads/aitdcanteen107/identity_aitdcanteen107.pdf', 7),
(8, 'uploads/sahil_halankar/profile_sahil_halankar.jpg', 'uploads/sahil_halankar/identity_sahil_halankar.pdf', 8),
(9, 'profile_9.jpg', 'uploads/susma_shetmandrekar/identity_susma_shetmandrekar.pdf', 9),
(10, 'uploads/shubham_shetmandrekar/profile_shubham_shetmandrekar.jpeg', 'uploads/shubham_shetmandrekar/identity_shubham_shetmandrekar.pdf', 10),
(11, 'uploads/shubham_shetmandrekar/profile_shubham_shetmandrekar.jpg', 'uploads/shubham_shetmandrekar/identity_shubham_shetmandrekar.pdf', 11),
(12, 'uploads/shubham_shetmandrekar/profile_shubham_shetmandrekar.jpeg', 'uploads/shubham_shetmandrekar/identity_shubham_shetmandrekar.pdf', 12),
(13, 'uploads/shubham_shetmandrekar/profile_shubham_shetmandrekar.jpg', 'uploads/shubham_shetmandrekar/identity_shubham_shetmandrekar.pdf', 13);

-- --------------------------------------------------------

--
-- Table structure for table `personal_details`
--

CREATE TABLE `personal_details` (
  `mem_id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ph_no` varchar(10) NOT NULL,
  `alt_ph_no` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `college_dpt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`mem_id`, `name`, `email`, `ph_no`, `alt_ph_no`, `address`, `college`, `college_dpt`) VALUES
(1, 'Shubham Shetmandrekar', 'shetmandrekarshubham107@gmail.com', '9145668620', '9546547854', 'deulwada mandrem goa ', 'AITD', 'CSE'),
(3, 'Ramesh Mandrekar', 'ramesh@gmail.com', '1236545695', '9546547854', 'sdfsfsfsdf', 'GEC', 'ECE'),
(4, 'Shyam Parsekar', 'shyam@gmail.com', '9213654215', '9546547854', 'sdfdsffdgfdg', 'PCCE', 'ME'),
(5, 'Mahesh Shirodkar', '21co58@aitdgoa.edu.in', '9213654215', '9546547854', 'asfdsfgdsg', 'GEC', 'ECE'),
(6, 'shivam ', 'shetmandrekarshubham107@gmail.com', '9213654215', '9546547854', 'sdfsfsd', 'AITD', 'ME'),
(7, 'aitdcanteen107', '21co58@aitdgoa.edu.in', '9213654215', 'sdfs', 'zXCZCZX', 'PCCE', 'ECE'),
(8, 'Sahil Halankar', 'sahil@gmail.com', '4564564564', '1231231231', 'Assagao goa', 'AITD', 'ECE'),
(9, 'Susma Shetmandrekar', 'susma@gmail.com', '4564564564', '1231231231', 'Mandrem goa', 'AITD', 'CSE'),
(10, 'shubham shetmandrekar', 'shetmandrekarshubham107@gmail.com', '4564564564', '1231231231', 'Assagao goa', 'AITD', 'CSE'),
(11, 'shubham shetmandrekar', 'shubham@gmail.com', '4564564564', '1231231231', 'Assagao goa', 'AITD', 'ECE'),
(12, 'shubham shetmandrekar', 'shetmandrekarshubham107@gmail.com', '4564564564', '1231231231', 'Assagao goa', 'GEC', 'CSE'),
(13, 'shubham shetmandrekar', 'shetmandrekarshubham107@gmail.com', '4564564564', '1231231231', 'Assagao goa', 'PCCE', 'ECE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dpt_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`mem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dpt_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `doc_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_details`
--
ALTER TABLE `personal_details`
  MODIFY `mem_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `personal_details` (`mem_id`);

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`mem_id`) REFERENCES `personal_details` (`mem_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
