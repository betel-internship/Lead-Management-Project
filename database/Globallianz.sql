-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 09, 2021 at 03:33 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Globallianz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` tinytext CHARACTER SET utf8 NOT NULL,
  `username` varchar(200) CHARACTER SET utf8 NOT NULL,
  `status` varchar(40) DEFAULT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `lead_id`, `userid`, `comment`, `username`, `status`, `created_date`) VALUES
(1, 1, 2, 'Contacted This Leads', 'Vijay', 'Contacted', '2020-03-09 08:42:31'),
(2, 1, 2, 'Goood', 'Vijay', 'Deal Done', '2020-03-09 08:43:03'),
(3, 1, 1, 'Continouse lead follow up', 'Globallianz', 'Importance', '2020-03-09 20:04:15'),
(4, 1, 1, 'Our Site may use \"cookies\" to enhance User experience. User\'s web browser places cookies on their hard drive for record-keeping purposes and sometimes to track information about them. User may choose to set their web browser to refuse cookies, or to alert', 'Globallianz', 'Negotiation', '2020-03-09 20:04:46'),
(5, 1, 1, 'We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration, disclosure or destruction of your personal information, username, password, transaction information and data s', 'Globallianz', 'Quotation Sending', '2020-03-09 20:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead`
--

CREATE TABLE `tbl_lead` (
  `id` int(11) NOT NULL,
  `lead_id` varchar(200) NOT NULL,
  `customer_name` varchar(500) CHARACTER SET utf8 NOT NULL,
  `company_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `city` varchar(200) CHARACTER SET utf8 NOT NULL,
  `state` varchar(200) CHARACTER SET utf8 NOT NULL,
  `mobile_no` varchar(200) NOT NULL,
  `secondary_mobile_no` varchar(30) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `requirement` varchar(1000) NOT NULL,
  `description` varchar(200) CHARACTER SET utf8 NOT NULL,
  `lead_source` varchar(500) NOT NULL,
  `status` varchar(200) CHARACTER SET utf8 NOT NULL,
  `userid` int(11) NOT NULL,
  `assigned_by` varchar(200) NOT NULL,
  `assigned_to` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lead`
--

INSERT INTO `tbl_lead` (`id`, `lead_id`, `customer_name`, `company_name`, `city`, `state`, `mobile_no`, `secondary_mobile_no`, `email_id`, `requirement`, `description`, `lead_source`, `status`, `userid`, `assigned_by`, `assigned_to`, `created_date`) VALUES
(1, '1583723505', 'vijay jadhav', 'Globallianz', 'Nanded', 'Maha', '9158675645', '', 'vijay123@gmail.com', 'Leads', 'Leads', 'Google', 'Quotation Sending', 2, 'Vijay', 'Globallianz', '2020-03-09 08:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL,
  `from_username` varchar(200) CHARACTER SET utf8 NOT NULL,
  `to_username` varchar(200) CHARACTER SET utf8 NOT NULL,
  `from_userid` int(11) NOT NULL,
  `to_userid` int(11) NOT NULL,
  `message` varchar(500) CHARACTER SET utf8 NOT NULL,
  `view` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `lead_id` bigint(20) NOT NULL,
  `Notification_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`id`, `from_username`, `to_username`, `from_userid`, `to_userid`, `message`, `view`, `created_date`, `status`, `lead_id`, `Notification_type`) VALUES
(1, 'Vijay', 'Globallianz', 2, 1, '<b style=\"color:green\">Vijay</b> This Employee Created New Lead', 1, '2020-03-09 08:41:45', 'active', 1, 'Lead'),
(2, 'Vijay', 'Globallianz', 2, 1, '<b style=\"color:green\">ID ID1583723505</b> Commented', 1, '2020-03-09 08:42:31', 'active', 1, 'Lead'),
(3, 'Vijay', 'Globallianz', 2, 1, '<b style=\"color:green\">ID ID1583723505</b> Commented', 1, '2020-03-09 08:43:03', 'active', 1, 'Lead'),
(4, 'Globallianz', 'Vijay', 1, 2, '<b style=\"color:green\">ID ID1583723505</b> Commented', 1, '2020-03-09 20:04:15', 'active', 1, 'Lead'),
(5, 'Globallianz', 'Vijay', 1, 2, '<b style=\"color:green\">ID ID1583723505</b> Commented', 1, '2020-03-09 20:04:46', 'active', 1, 'Lead'),
(6, 'Globallianz', 'Vijay', 1, 2, '<b style=\"color:green\">ID ID1583723505</b> Commented', 1, '2020-03-09 20:05:14', 'active', 1, 'Lead');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE `tbl_registration` (
  `id` bigint(20) NOT NULL,
  `full_name` varchar(300) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` enum('Admin','Employee') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`id`, `full_name`, `mobile_no`, `email_address`, `location`, `role`, `password`, `user_type`, `status`, `created_date`) VALUES
(1, 'Globallianz', '7507012305', 'globallianz@gmail.com', 'Pune', 'Manager', '7c5e62fbfc8a62229675265f24ac0c10', 'Admin', 'active', '2020-02-26 00:00:00'),
(2, 'Vijay', '9158675645', 'vijay171819@gmail.com', 'Pune', 'Account executive', '7c5e62fbfc8a62229675265f24ac0c10', 'Employee', 'active', '2020-02-26 18:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `role_name`) VALUES
(1, 'Sales executive'),
(2, 'Marketing execute'),
(3, 'Manager'),
(4, 'Account executive'),
(5, 'Production executive'),
(6, 'Team leader'),
(7, 'Sales manager');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_source`
--

CREATE TABLE `tbl_source` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_source`
--

INSERT INTO `tbl_source` (`id`, `name`) VALUES
(1, 'Indiamart'),
(2, 'Google'),
(3, 'Self'),
(4, 'Justdial'),
(5, 'Online'),
(6, 'Reference'),
(7, 'Friend');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `status`) VALUES
(1, 'Contacted'),
(3, 'Not Contacted'),
(4, 'E Relevant'),
(5, 'Follow Up'),
(6, 'Case Dropped'),
(7, 'Lost Lead'),
(8, 'Importance'),
(9, 'Negotiation'),
(10, 'Deal Done'),
(11, 'Quotation Sending ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lead`
--
ALTER TABLE `tbl_lead`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_owner` (`customer_name`(255)),
  ADD KEY `city` (`city`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_source`
--
ALTER TABLE `tbl_source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_lead`
--
ALTER TABLE `tbl_lead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_source`
--
ALTER TABLE `tbl_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
