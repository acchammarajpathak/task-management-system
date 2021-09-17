-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2021 at 04:41 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `201it`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave`
--

CREATE TABLE `emp_leave` (
  `leave_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(26) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_leave`
--

INSERT INTO `emp_leave` (`leave_id`, `emp_id`, `reason`, `start_date`, `end_date`, `status`) VALUES
(1, 5, 'fever', '2021-04-26', '2021-04-29', 'Approved'),
(2, 6, 'Headache', '2021-04-26', '2021-04-29', 'Pending'),
(3, 5, 'lockdown', '2021-06-10', '2021-06-15', 'Denied');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `eid` int(11) NOT NULL,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`eid`, `points`) VALUES
(5, 500),
(6, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `base_salary` int(11) NOT NULL,
  `bonus` int(11) NOT NULL,
  `tax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `emp_id`, `base_salary`, `bonus`, `tax`) VALUES
(1, 5, 30000, 2000, 5),
(2, 6, 25000, 3000, 13);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_info_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `assign_date` date DEFAULT current_timestamp(),
  `due_date` date NOT NULL,
  `sub_date` date DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'Pending',
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_info_id`, `user_id`, `emp_id`, `assign_date`, `due_date`, `sub_date`, `status`, `remarks`) VALUES
(1, 2, 2, 5, '2021-04-20', '2021-04-24', '2021-04-24', 'Completed', ''),
(2, 2, 2, 5, '0000-00-00', '0000-00-00', '2021-04-24', 'Completed', ''),
(3, 1, 2, 5, NULL, '2021-04-28', '0000-00-00', 'Completed', ''),
(4, 1, 2, 5, NULL, '2021-05-30', '2021-06-02', 'Completed', ''),
(5, 2, 2, 5, NULL, '0000-00-00', '0000-00-00', 'Canceled', ''),
(6, 3, 2, 5, NULL, '2021-05-30', '0000-00-00', 'Completed', ''),
(7, 4, 2, 5, NULL, '2021-06-06', '0000-00-00', 'Completed', ''),
(8, 4, 2, 5, '2021-06-02', '2021-06-10', NULL, 'Pending', ''),
(9, 3, 2, 6, '2021-06-02', '2021-06-12', NULL, 'Pending', ''),
(10, 5, 2, 5, '2021-06-03', '2021-06-11', NULL, 'Pending', ''),
(11, 5, 7, 6, '2021-06-03', '2021-06-05', NULL, 'Pending', ''),
(12, 3, 2, NULL, '2021-07-18', '2021-07-21', NULL, 'Pending', 'B/W with circle and triangle.  ansbbdb'),
(13, 5, 2, NULL, '2021-07-18', '2021-08-07', NULL, 'Pending', 'doneeeeeee');

-- --------------------------------------------------------

--
-- Table structure for table `task_info`
--

CREATE TABLE `task_info` (
  `task_info_id` int(11) NOT NULL,
  `task_name` varchar(250) NOT NULL,
  `price` int(10) NOT NULL,
  `remarks` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_info`
--

INSERT INTO `task_info` (`task_info_id`, `task_name`, `price`, `remarks`) VALUES
(1, 'PHP Website', 60000, 'hello'),
(2, 'Static Website', 5000, NULL),
(3, 'Logo Design', 2000, NULL),
(4, 'Banner Design', 10000, NULL),
(5, 'SEO', 10000, 'As soon as possible');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `pic` text NOT NULL,
  `role` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `birthday`, `gender`, `contact`, `address`, `department`, `degree`, `pic`, `role`, `is_active`, `verified`, `token`) VALUES
(1, 'Acchamma Raj', 'Pathak', 'admin@gmail.com', '6b3724f64df5e0e244509ed671ccc081', '2021-04-01', 'm', '9841657545', 'Kathmandu', 'BCA', 'Bachelor', '../img/uploads/60b7156402c2b.jpg', 'admin', 1, 1, NULL),
(2, 'Arjun', 'Singh', 'user@gmail.com', '6b3724f64df5e0e244509ed671ccc081', '2021-04-16', 'm', '1234567890', 'Dhangadi', 'BCA', 'Bachelor', '../img/uploads/6074546e14a9b.jpg', 'user', 1, 1, '9c368f4aeda7be4ebad77000957f199c'),
(4, 'acchamma', 'pathak', 'info@201it.com', '6b3724f64df5e0e244509ed671ccc081', '2021-05-14', 'f', '9841657545', 'Dhangadi', 'BCA', 'Bachelor', 'img/uploads/60b3972aa5aaf.png', 'user', 0, NULL, NULL),
(5, 'Niraz', 'Kharel', 'emp@gmail.com', '6b3724f64df5e0e244509ed671ccc081', '2021-05-13', 'm', '9841657545', 'Kavre', 'BCA', 'Bachelor', '../img/uploads/60b7168747e29.jpg', 'employee', 1, 1, NULL),
(6, 'Aashish', 'Aryal', 'emp1@gmail.com', '6b3724f64df5e0e244509ed671ccc081', '2021-05-13', 'm', '9841657545', 'Bardiya', 'BCA', 'Bachelor', '../img/uploads/60b716c929b49.jpg', 'employee', 1, NULL, NULL),
(7, 'Aashish', 'Aryal', 'user1@gmail.com', '6b3724f64df5e0e244509ed671ccc081', '2021-05-13', 'm', '9841657545', 'Bardiya', 'BCA', 'Bachelor', '../img/uploads/60b716c929b49.jpg', 'user', 1, NULL, NULL),
(13, 'Saanvi', 'Pathak', 'saanvipathak2020@gmail.com', 'd0d2c337b0608d0d2d0fe4a135adf47d', '2021-07-15', 'f', '9841657545', 'Tokha-8,Gaireguan', 'BCA', 'Bachelor', 'img/uploads/60f3fd9622fc0.jpg', 'admin', 1, 1, 'fc157fefa96250429a69c30487739f15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_leave`
--
ALTER TABLE `emp_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_info`
--
ALTER TABLE `task_info`
  ADD PRIMARY KEY (`task_info_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `task_info`
--
ALTER TABLE `task_info`
  MODIFY `task_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
