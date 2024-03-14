-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2019 at 08:48 AM
-- Server version: 5.5.24
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `real_state`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE IF NOT EXISTS `agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agency_code` varchar(250) NOT NULL,
  `branch_id` varchar(200) NOT NULL,
  `agent_name` varchar(250) NOT NULL,
  `country` varchar(20) NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL,
  `pin_code` varchar(10) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `bank_account_no` varchar(20) DEFAULT NULL,
  `bank_ifsc_code` varchar(20) DEFAULT NULL,
  `account_holder_name` varchar(250) NOT NULL,
  `bank_branch_name` varchar(250) NOT NULL,
  `aadhar_card_no` varchar(20) DEFAULT NULL,
  `pan_card_no` varchar(20) DEFAULT NULL,
  `c_date` varchar(20) DEFAULT NULL,
  `c_by` varchar(100) DEFAULT NULL,
  `status` int(5) DEFAULT '1' COMMENT '1=active,0=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id`, `agency_code`, `branch_id`, `agent_name`, `country`, `state`, `district`, `post`, `pin_code`, `address`, `mobile_no`, `email`, `bank_name`, `bank_account_no`, `bank_ifsc_code`, `account_holder_name`, `bank_branch_name`, `aadhar_card_no`, `pan_card_no`, `c_date`, `c_by`, `status`) VALUES
(1, 'UPVNS00001', 'BRC001', 'Subhash Chandra Maurya', 'India', 'Uttar Pradesh', 'Varanasi', 'Kachhwa Road', '221313', 'Pure, Kachhawa Road, Varanasi', '9935819925', '', 'State Bank Of India', '30661090115', 'SBIN0006202', 'Subhash Chandra Maurya', 'Mirzamurad', '686214131841', '', '2019-03-16', 'admin', 1),
(3, 'UPVNS00002', 'BRC001', 'Ashok kumar maurya', 'India', 'Uttar Pradesh', 'Varanasi', 'Kachhwa Road', '221313', 'Pure, Kachhawa Road, Varanasi', '8924993440', 'pintu4405@gmail.com', 'State Bank Of India', '11482677538', 'SBIN0006202', 'Ashok  kumar maurya', 'Mirzamurad', '362157287217', 'CDCPM4875N', '2019-03-25', 'admin', 1),
(4, 'UPVNS00003', 'BRC001', 'Suresh Kumar Gupta', 'India', 'Uttar Pradesh', 'Mirzapur', 'Majhwa', '221313', 'vill-Majhawa Mirzapur', '8115837460', 'pintu4405@gmail.com', 'na', 'na', 'na', 'Suresh kumar Gupta', 'Mirzamurad', 'na', 'na', '2019-03-29', 'admin', 1),
(5, 'UPVNS00004', 'BRC001', 'Subhash  Maurya', 'India', 'Uttar Pradesh', 'Mirzapur', 'Mirzamurad', '221307', 'Byashpur', '9956381543', 'pintu4405@gmail.com', 'na', 'na', 'na', 'Subhash Chandra Maurya', 'Mirzamurad', 'na', 'na', '2019-05-03', 'admin', 1),
(6, 'UPCKN00005', 'BRC002', 'Roshan maurya', 'India', 'Uttar Pradesh', 'varanasi', 'mirzamurad', '343543', 'byaspur', '4564756454', 'fg@gmail.com', 'allahabad bank', '3645634534535', '456345345345', 'roshan maurya', 'jamuaa bazar', '346573457345', '6545645347543', '2019-05-30', 'fadmin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `agent_commission_history`
--

CREATE TABLE IF NOT EXISTS `agent_commission_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agency_code` varchar(20) NOT NULL,
  `customer_id` varchar(20) NOT NULL,
  `no_of_installment` int(200) NOT NULL DEFAULT '1',
  `commission_amount` double NOT NULL,
  `pay_date` varchar(20) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1=active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `agent_commission_history`
--

INSERT INTO `agent_commission_history` (`id`, `agency_code`, `customer_id`, `no_of_installment`, `commission_amount`, `pay_date`, `status`) VALUES
(1, 'UPVNS00001', 'CU0000001', 1, 75, '2019-02-06', 1),
(2, 'UPVNS00001', 'CU0000002', 1, 1500, '2018-10-11', 1),
(3, 'UPVNS00001', 'CU0000003', 1, 2500, '2019-03-14', 1),
(4, 'UPVNS00001', 'CU0000001', 2, 150, '2019-03-20', 1),
(5, 'UPVNS00001', 'CU0000004', 1, 4000, '2018-12-25', 1),
(6, 'UPVNS00001', 'CU0000005', 1, 7500, '2018-12-25', 1),
(7, 'UPVNS00001', 'CU0000006', 1, 1000, '2019-03-10', 1),
(8, 'UPVNS00001', 'CU0000007', 1, 10000, '2020-03-14', 1),
(9, 'UPVNS00001', 'CU0000008', 1, 10000, '2019-03-14', 1),
(10, 'UPVNS00001', 'CU0000009', 1, 1000, '2019-02-28', 1),
(11, 'UPVNS00001', 'CU0000010', 1, 50, '2019-03-29', 1),
(12, 'UPVNS00002', 'CU0000011', 1, 50, '2017-04-18', 1),
(13, 'UPVNS00002', 'CU0000011', 17, 850, '2019-03-29', 1),
(14, 'UPVNS00002', 'CU0000011', 2, 100, '2019-03-29', 1),
(15, 'UPVNS00003', 'CU0000012', 1, 25, '2017-04-18', 1),
(16, 'UPVNS00003', 'CU0000012', 18, 450, '2019-03-29', 1),
(17, 'UPVNS00003', 'CU0000013', 1, 50, '2017-05-22', 1),
(18, 'UPVNS00003', 'CU0000013', 17, 850, '2019-03-29', 1),
(19, 'UPVNS00003', 'CU0000014', 1, 25, '2014-03-25', 1),
(20, 'UPVNS00003', 'CU0000014', 1, 25, '2014-03-25', 1),
(21, 'UPVNS00003', 'CU0000014', 47, 1175, '2019-03-29', 1),
(23, 'UPVNS00003', 'CU0000014', 6, 150, '2019-03-29', 1),
(24, 'UPVNS00003', 'CU0000015', 1, 50, '2014-03-24', 1),
(25, 'UPVNS00003', 'CU0000015', 1, 50, '2014-03-24', 1),
(26, 'UPVNS00003', 'CU0000015', 1, 50, '2014-03-24', 1),
(27, 'UPVNS00003', 'CU0000015', 1, 50, '2019-03-29', 1),
(28, 'UPVNS00003', 'CU0000015', 2, 100, '2019-03-29', 1),
(30, 'UPVNS00001', 'CU0000016', 1, 25, '2019-03-30', 1),
(31, 'UPVNS00003', 'CU0000015', 49, 2450, '2019-03-30', 1),
(32, 'UPVNS00003', 'CU0000017', 1, 15, '2015-08-03', 1),
(33, 'UPVNS00003', 'CU0000017', 37, 555, '2019-03-30', 1),
(34, 'UPVNS00003', 'CU0000018', 1, 25, '2014-07-31', 1),
(35, 'UPVNS00003', 'CU0000018', 51, 1275, '2019-03-30', 1),
(36, 'UPVNS00003', 'CU0000019', 1, 15, '2014-07-31', 1),
(37, 'UPVNS00003', 'CU0000019', 51, 765, '2019-03-30', 1),
(38, 'UPVNS00001', 'CU0000020', 1, 150, '2019-03-30', 1),
(39, 'UPVNS00001', 'CU0000021', 1, 50, '2019-03-30', 1),
(40, 'UPVNS00001', 'CU0000022', 1, 50, '2019-04-10', 1),
(41, 'UPVNS00001', 'CU0000023', 1, 50, '2019-04-10', 1),
(42, 'UPVNS00001', 'CU0000024', 1, 75, '2019-04-10', 1),
(43, 'UPVNS00001', 'CU0000025', 1, 300, '2019-04-10', 1),
(44, 'UPVNS00001', 'CU0000026', 1, 50, '2019-04-10', 1),
(45, 'UPVNS00003', 'CU0000019', 6, 90, '2019-04-19', 1),
(46, 'UPVNS00002', 'CU0000011', 6, 300, '2019-04-19', 1),
(47, 'UPVNS00003', 'CU0000012', 6, 150, '2019-04-19', 1),
(48, 'UPVNS00003', 'CU0000018', 6, 150, '2019-04-19', 1),
(49, 'UPVNS00003', 'CU0000017', 6, 90, '2019-04-19', 1),
(50, 'UPVNS00003', 'CU0000013', 6, 300, '2019-04-19', 1),
(51, 'UPVNS00001', 'CU0000026', 1, 50, '2019-05-02', 1),
(52, 'UPVNS00001', 'CU0000023', 1, 50, '2019-05-02', 1),
(53, 'UPVNS00001', 'CU0000010', 1, 50, '2019-05-02', 1),
(54, 'UPVNS00001', 'CU0000021', 1, 50, '2019-05-02', 1),
(55, 'UPVNS00001', 'CU0000001', 1, 75, '2019-05-02', 1),
(56, 'UPVNS00001', 'CU0000020', 1, 150, '2019-05-03', 1),
(57, 'UPVNS00004', 'CU0000027', 1, 150, '2019-05-03', 1),
(58, 'UPVNS00001', 'CU0000028', 1, 250, '2019-04-27', 1),
(59, 'UPVNS00001', 'CU0000024', 1, 75, '2019-05-09', 1),
(60, 'UPVNS00001', 'CU0000022', 1, 50, '2019-05-09', 1),
(61, 'UPVNS00002', 'CU0000029', 1, 50, '2018-05-07', 1),
(62, 'UPVNS00002', 'CU0000029', 13, 650, '2019-05-09', 1),
(63, 'UPVNS00001', 'CU0000030', 1, 300, '2019-05-01', 1),
(64, 'UPVNS00004', 'CU0000031', 1, 5000, '2019-05-05', 1),
(65, 'UPVNS00002', 'CU0000032', 1, 500, '2019-05-01', 1),
(66, 'UPVNS00002', 'CU0000033', 1, 250, '2019-05-09', 1),
(67, 'UPVNS00003', 'CU0000019', 1, 15, '2019-05-14', 1),
(68, 'UPVNS00003', 'CU0000018', 1, 25, '2019-05-14', 1),
(69, 'UPVNS00003', 'CU0000013', 1, 50, '2019-05-14', 1),
(70, 'UPVNS00003', 'CU0000012', 1, 25, '2019-05-14', 1),
(71, 'UPVNS00003', 'CU0000017', 1, 15, '2019-05-14', 1),
(72, 'UPVNS00003', 'CU0000034', 1, 300, '2017-05-20', 1),
(73, 'UPVNS00003', 'CU0000034', 2, 600, '2019-05-14', 1),
(74, 'UPVNS00002', 'CU0000035', 1, 150, '2019-05-12', 1),
(75, 'UPVNS00002', 'CU0000036', 1, 25, '2019-05-28', 1),
(76, 'UPVNS00001', 'CU0000037', 1, 500, '2019-05-27', 1),
(77, 'UPCKN00005', 'CU0000038', 1, 5, '2019-05-08', 1),
(78, 'UPCKN00005', 'CU0000038', 10, 50, '2019-05-30', 1),
(79, 'UPCKN00005', 'CU0000039', 1, 60, '2008-12-30', 0),
(80, 'UPCKN00005', 'CU0000040', 1, 150, '2009-02-04', 0),
(81, 'UPVNS00003', 'CU0000041', 1, 50, '2019-06-03', 1),
(82, 'UPVNS00001', 'CU0000001', 10, 750, '2019-06-05', 1),
(83, 'UPVNS00001', 'CU0000001', 1, 75, '2019-06-10', 1),
(84, 'UPVNS00003', 'CU0000012', 1, 25, '2019-06-11', 1),
(85, 'UPVNS00003', 'CU0000041', 1, 50, '2019-06-13', 1),
(86, 'UPVNS00003', 'CU0000041', 2, 100, '2019-06-13', 1),
(87, 'UPVNS00003', 'CU0000041', 3, 150, '2019-06-13', 1),
(88, 'UPVNS00003', 'CU0000041', 1, 50, '2019-06-13', 1),
(89, 'UPVNS00003', 'CU0000041', 1, 50, '2019-06-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `agent_pay_commission_history`
--

CREATE TABLE IF NOT EXISTS `agent_pay_commission_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agency_code` varchar(250) NOT NULL,
  `pay_amount` double NOT NULL,
  `pay_date` varchar(20) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '1=active,0=Inactive',
  `c_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `agent_pay_commission_history`
--

INSERT INTO `agent_pay_commission_history` (`id`, `agency_code`, `pay_amount`, `pay_date`, `status`, `c_by`) VALUES
(1, 'UPVNS00003', 8150, '2019-04-02', 1, 'admin'),
(2, 'UPVNS00001', 5, '2019-06-18', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `branch_id` varchar(200) NOT NULL,
  `branch_code` varchar(10) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `state` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `pin_code` varchar(10) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '1=active, 0=Inactive',
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `c_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_id`, `branch_code`, `branch_name`, `country`, `state`, `district`, `pin_code`, `mobile_no`, `email`, `address`, `status`, `date`, `c_by`) VALUES
(1, 'BRC001', 'VNS', 'Kachhwa Road', 'India', 'Uttar Pradesh', 'Varanasi ', '221313', '9935819925', 'subhashmaurya513@gmail', 'Kachhawa road Varanasi 221313', 1, '2019-03-16 06:50:45', 'admin'),
(2, 'BRC002', 'CKN', 'Chakranpur', 'India', 'Uttar Pradesh', 'VARANASI', '465646', '7475475455', 'rahulkumarmaurya464@gmail.com', 'MIRZAMURAD', 1, '2019-05-29 18:30:00', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(11) NOT NULL,
  `registration_no` varchar(100) NOT NULL,
  `sr_no` varchar(100) NOT NULL,
  `agency_code` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `father` varchar(200) NOT NULL,
  `customer_relationship` varchar(20) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `date_of_joining` varchar(50) NOT NULL,
  `expairy_date` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `post` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `pin_code` varchar(15) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `mobil_no` varchar(15) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `aadhar_card_no` varchar(20) DEFAULT NULL,
  `pan_card_no` varchar(20) DEFAULT NULL,
  `bank_name` varchar(250) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `bank_branch_name` varchar(250) NOT NULL,
  `account_holder_name` varchar(250) NOT NULL,
  `nominee` varchar(150) DEFAULT NULL,
  `realation` varchar(150) DEFAULT NULL,
  `nominee_date_of_birth` varchar(11) DEFAULT NULL,
  `customer_img` varchar(250) DEFAULT NULL,
  `c_by` varchar(100) DEFAULT NULL,
  `c_date` varchar(100) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '1=active, 0=Inactive',
  `claimed_maturity_payment_status` int(5) NOT NULL DEFAULT '0' COMMENT '0=not payment, 1=success payment',
  `maturity_return_paid_date` varchar(20) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_id`, `registration_no`, `sr_no`, `agency_code`, `branch_id`, `name`, `father`, `customer_relationship`, `dob`, `date_of_joining`, `expairy_date`, `country`, `post`, `district`, `pin_code`, `address`, `mobil_no`, `gender`, `aadhar_card_no`, `pan_card_no`, `bank_name`, `account_no`, `ifsc_code`, `bank_branch_name`, `account_holder_name`, `nominee`, `realation`, `nominee_date_of_birth`, `customer_img`, `c_by`, `c_date`, `status`, `claimed_maturity_payment_status`, `maturity_return_paid_date`, `date_time`) VALUES
(1, 'CU0000001', 'UPVNS0000001', 'UP0000001', 'UPVNS00001', 'BRC001', 'Manoj Kumar Patel', 'Lt. Ramesh Patel', '', '1985-01-06', '2019-02-20', '2024-02-06', 'India', 'Mirzamurad', 'Varanasi', '221307', 'Dangahariya', '9125260414', 'Male', '958166047974', '', 'NA', 'NA', 'NA', 'NA', 'NA', 'Nagina Devi', 'Wife', '1987-01-06', '../../uploads/IMG-13155271780342.jpeg', 'admin', '2019-02-06', 1, 0, NULL, '2019-03-29 12:37:45'),
(2, 'CU0000002', 'UPVNS0000002', 'UP0000002', 'UPVNS00001', 'BRC001', 'Rajkumari Devi', 'Shymnarayan Maurya', '', '1970-07-07', '2018-10-11', '2025-10-11', 'India', 'kachhawa r', 'Varanasi', '221313', 'Pure, Kachhawa Road, Varanasi', '9935819925', 'Female', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'Shyamnarayan maurya', 'Wife', '1968-03-15', '../../uploads/IMG-40155282810638.jpg', 'admin', '2018-10-11', 1, 0, NULL, '2019-03-29 12:37:45'),
(3, 'CU0000003', 'UPVNS0000003', 'UP0000003', 'UPVNS00001', 'BRC001', 'Durga devi ', 'vijay shankar pathak ', 'W/O', '1956-01-01', '2019-03-14', '2026-03-14', 'India', 'kachhwa road ', 'varanasi', '221313', 'Pure, Kachhawa Road, Varanasi', '9198999112', 'Female', '782550490714', 'na', 'na', 'na', 'na', 'na', 'na', 'vijay shankar pathak', 'Wife', '1954-01-01', '../../uploads/IMG-29155300187290.jpg', 'admin', '2019-03-19', 1, 0, NULL, '2019-03-29 12:37:45'),
(4, 'CU0000004', 'UPVNS0000004', 'UP0000004', 'UPVNS00001', 'BRC001', 'Manjhari Devi', 'Jitnarayan Maurya', 'W/O', '1972-01-01', '2018-12-25', '2025-12-25', 'India', 'kachhawa Road', 'Varanasi', '221313', 'Pure, Kachhawa Road, Varanasi', '8127202034', 'Female', '437668250851', 'na', 'na', 'na', 'na', 'na', 'na', 'Jitnarayan Maurya', 'Husband', '2019-03-23', '../../uploads/IMG-84155332715679.jpg', 'admin', '2019-03-23', 1, 0, NULL, '2019-03-29 12:37:45'),
(5, 'CU0000005', 'UPVNS0000005', 'UP0000005', 'UPVNS00001', 'BRC001', 'Bashanti Devi', 'Nandlal Maurya', 'W/O', '1984-01-17', '2018-12-25', '2025-12-25', 'India', 'Modh', 'Varanasi', '221404', 'Vill-Bhanupur Po-Modh SantRavidashnagar UP', '7905073864', 'Male', '935168197528', 'na', 'State Bank Of India', '32920507381', 'sbin0001088', 'Bhadohi', 'Bashanti Devi', 'Khushi', 'Daughter', '2009-07-08', '../../uploads/IMG-34155332828311.jpg', 'admin', '2019-03-23', 1, 0, NULL, '2019-03-29 12:37:45'),
(6, 'CU0000006', 'UPVNS0000006', 'UP0000006', 'UPVNS00001', 'BRC001', 'Shahazadi Devi', 'Let Chandrama Dubey', 'W/O', '1944-03-13', '2019-03-10', '2026-03-10', 'India', 'Kachhawa road', 'Varanasi', '221313', 'Pure, Kachhawa Road, Varanasi', '9794112836', 'Female', '558929726113', 'nan', 'na', 'na', 'na', 'na', 'na', 'Sushama Dubey', 'None', '1970-02-11', '../../uploads/IMG-96155332964841.jpg', 'admin', '2019-03-23', 1, 0, NULL, '2019-03-29 12:37:45'),
(7, 'CU0000007', 'UPVNS0000007', 'UP0000007', 'UPVNS00001', 'BRC001', 'Sugriv  Sharma', 'Dukkhi', 'S/O', '1949-01-10', '2020-03-14', '2022-03-14', 'India', 'Mirzamurad', 'Varanasi', '221307', 'Vill-Moglabir Mirzamurad varanasi', '9453213781', 'Male', '529856171480', 'ACWPS4832N', 'State Bank Of India', 'na', 'SBIN0006202', 'Mirzamurad', 'Sugriv sharma', 'Mamata', 'Daughter', '1984-01-05', '../../uploads/IMG-20155351692628.jpg', 'admin', '2019-03-25', 1, 0, NULL, '2019-03-29 12:37:45'),
(8, 'CU0000008', 'UPVNS0000008', 'UP0000008', 'UPVNS00001', 'BRC001', 'Sugriv Sharma', 'Dukkhi', 'S/O', '1949-01-10', '2019-03-14', '2021-03-14', 'India', 'Mirzamurad', 'Varanasi', '221307', 'Vill-Moglabir Mirzamurad varanasi', '9453213781', 'Male', '529856171480', 'ACWPS4832N', 'State Bank Of India', 'na', 'SBIN0006202', 'Mirzamurad', 'Sugriv Sharma', 'Mamata', 'Daughter', '1984-01-05', '../../uploads/IMG-27155351820038.jpg', 'admin', '2019-03-25', 1, 0, NULL, '2019-03-29 12:37:45'),
(9, 'CU0000009', 'UPVNS0000009', 'UP0000009', 'UPVNS00001', 'BRC001', 'subhash', 'ramraj', 'S/O', '2019-02-25', '2019-02-28', '2026-02-28', 'India', 'kac', 'Varanasi', '221313', 'Pure, Kachhawa Road, Varanasi', '9935819925', 'Male', '5412548', '44552', 'State Bank Of India', '30661090115', 'sb', 'Mirzamurad', 'Subhash Chandra Maurya', 'am', 'Wife', '1984-01-05', NULL, 'admin', '2019-03-25', 1, 0, NULL, '2019-03-29 12:37:45'),
(10, 'CU0000010', 'UPVNS0000010', 'UP0000010', 'UPVNS00001', 'BRC001', 'Ashish kumar keshari', 'let Ashok kumar keshari', 'S/O', '1989-07-08', '2019-03-29', '2024-03-29', 'India', 'kachhawa Rroad', 'Varanasi', '221313', 'Kachhawa road  Thatara varanasi', '6387148670', 'Male', '905145138939', 'DNCPK9735A', 'Union bank of india', '721402010001846', 'na', 'kachhawa road', 'Ashish Kumar keshari', 'Nikita Keshari', 'Wife', '1991-05-07', '../../uploads/IMG-60155384533456.jpg', 'admin', '2019-03-29', 1, 0, NULL, '2019-03-29 12:37:45'),
(11, 'CU0000011', 'UPVNS0000011', 'UP0000011', 'UPVNS00002', 'BRC001', 'Gita Devi', 'Chandrajeet Pal', 'W/O', '1981-10-14', '2017-04-18', '2022-04-18', 'India', 'Kachhawa road', 'Varanasi', '221313', 'vill-Chitrasenpur kachhawaroad varanasi', '8115837460', 'Female', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'Chandrajeet pal', 'Husband', '1970-08-10', NULL, 'admin', '2019-03-29', 1, 0, NULL, '2019-03-29 12:37:45'),
(12, 'CU0000012', 'UPVNS0000012', 'UP0000012', 'UPVNS00003', 'BRC001', 'Jay DEvi', 'Sidhdnath Pal', 'W/O', '19171-01-14', '2017-04-18', '2022-04-18', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'CHitrasenpurkachhawaroad varanasi', '8115837460', 'Female', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'Sidhnath pai', 'Husband', '1970-01-14', NULL, 'admin', '2019-03-29', 1, 0, NULL, '2019-03-29 12:37:45'),
(13, 'CU0000013', 'UPVNS0000013', 'UP0000013', 'UPVNS00003', 'BRC001', 'Amit kumar jaisawal', 'Penne Lal jaisawal', 'S/O', '1994-08-07', '2017-05-22', '2022-05-22', 'India', 'Mirzamurad', 'Varanasi ', '221307', 'Vill-Nayapur mirzamurad', '9794300250', 'Male', 'Na', 'Na', 'Na', 'Na', 'Na', 'Na', 'Na', 'Penne Lal jaisawal', 'Father', '1970-05-20', NULL, 'admin', '2019-03-29', 1, 0, NULL, '2019-03-29 12:37:45'),
(14, 'CU0000014', 'UPVNS0000014', 'UP0000014', 'UPVNS00003', 'BRC001', 'Ram kumar Maurya', 'Bechulal  maurya', 'S/O', '1987-02-05', '2014-03-25', '2019-03-25', 'India', 'Kachhawa Bazar', 'Mirzapur', 'na', 'vill-Godhana kachhawa Mirzapur', '8115837460', 'Male', 'na', 'na', 'na', 'ba', 'na', 'na', 'na', 'Bechhulal Maurya', 'Father', '1955-04-05', NULL, 'admin', '2019-03-29', 1, 0, '2019-05-14, 16:46:00', '2019-03-29 12:37:45'),
(16, 'CU0000015', 'UPVNS0000015', 'UP0000015', 'UPVNS00003', 'BRC001', 'Ajit  kumar   jaisawal', ' Panna Lal Jaisawal', 'S/O', '1990-05-15', '2014-03-24', '2019-03-24', 'India', 'Mirzapur', 'Varanasi', '221307', 'Vill-Nayapur Mirzamurad varanasi', '9794300250', 'Male', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'pannalal maurya', 'Father', '1970-02-02', NULL, 'admin', '2019-03-29', 1, 1, '2019-06-07', '2019-03-29 12:37:45'),
(19, 'CU0000016', 'UPVNS0000016', 'UP0000016', 'UPVNS00001', 'BRC001', 'Sursati Devi', 'Subhash Chand Maurya', 'W/O', '1985-07-20', '2019-03-30', '2024-03-30', 'India', 'Kachhawaroad', 'Mirzapur', '231501', 'Vill -Ramapur Kachhawa Mirzapur', '6386233014', 'Female', '676242003329', 'na', 'State Bank Of India', '30919426943', 'SBIN0012303', 'Kachhawa', 'Sursatti Devi', 'Priyanshu Maurya', 'Son', '2006-02-15', '../../uploads/IMG-77155395219885.jpg', 'admin', '2019-03-30', 1, 0, NULL, '2019-03-30 13:23:18'),
(20, 'CU0000017', 'UPVNS0000017', 'UP0000017', 'UPVNS00003', 'BRC001', 'Patiya Devi', 'Gangaram', 'W/O', '1965-02-14', '2015-08-03', '2020-08-03', 'India', 'Kachhawa', 'Mirzapur', 'na', 'Vill-Badapur Kachhawa Mirzapur', '8115837460', 'Female', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'Gangaram', 'Husband', '1964-05-19', NULL, 'admin', '2019-03-30', 1, 0, NULL, '2019-03-30 13:50:52'),
(21, 'CU0000018', 'UPVNS0000018', 'UP0000018', 'UPVNS00003', 'BRC001', 'Suresh Kumar Gupta', 'Pyare lal Gupta', 'S/O', '1980-02-15', '2014-07-31', '2019-07-31', 'India', 'Kachhawa', 'Mirzapur', 'na', 'Majhawa Kachhawa Mirzapur', '8115837460', 'Male', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'Usha Gupta', 'Wife', '1982-02-16', NULL, 'admin', '2019-03-30', 1, 0, NULL, '2019-03-30 14:08:54'),
(22, 'CU0000019', 'UPVNS0000019', 'UP0000019', 'UPVNS00003', 'BRC001', 'Urmila Devi', 'Vinod Kumar', 'W/O', '1987-05-25', '2014-07-31', '2019-07-31', 'India', 'Kachhawa', 'Mirzapur', 'na', 'vILL-BADAPUR KACHHAWA Mirzapur', '9956595246', 'Female', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'Vinod Kumar', 'Husband', '1984-01-05', NULL, 'admin', '2019-03-30', 1, 0, NULL, '2019-03-30 14:19:11'),
(23, 'CU0000020', 'UPVNS0000020', 'UP0000020', 'UPVNS00001', 'BRC001', 'Lalbali Singh', 'Let Banshraj Varma', 'S/O', '1977-07-03', '2019-03-30', '2020-03-30', 'India', 'Hathibazar', 'Varanasi', '221405', 'Vill-Dayapur Tendui Hathibazar Varanasi', '8858352120', 'Male', '263591188696', 'ECPS4414K', 'State Bank Of India', 'na', 'na', 'Mirzamurad', 'na', 'Sneha Singh', 'Daughter', '2006-05-15', '../../uploads/IMG-98155395757181.jpg', 'admin', '2019-03-30', 1, 0, NULL, '2019-03-30 14:52:51'),
(24, 'CU0000021', 'UPVNS0000021', 'UP0000021', 'UPVNS00001', 'BRC001', 'Sandeep Kumar Keshari', 'Let Mangal Dash Keshari', 'S/O', '1985-08-03', '2019-03-30', '2024-03-30', 'India', 'Kachhawa  Road', 'Varanasi', '221313', ', Kachhawa RoadThatara, Varanasi', '8423791034', 'Male', '609974121246', 'CEUPK3648Q', 'Union Bank Of India', '487702010004669', 'UBIN0572144', 'CHitrasenpur', 'Sandeep KUmar Keshari', 'Sanju Devi', 'Wife', '1989-01-05', '../../uploads/IMG-12155395865565.jpg', 'admin', '2019-03-30', 1, 0, NULL, '2019-03-30 15:10:54'),
(25, 'CU0000022', 'UPVNS0000022', 'UP0000022', 'UPVNS00001', 'BRC001', 'Rajbihari Singh', 'Baliram Patel', 'S/O', '1976-12-18', '2019-04-10', '2024-04-10', 'India', 'Rajatalab', 'Varanasi', '221311', 'Vill-Mehadiganj Rajatalab varansi', '9451862830', 'Male', '238723686213', 'HPOPS0200C', 'na', 'na', 'na', 'na', 'na', 'Bebi Singh', 'Wife', '1978-02-04', '../../uploads/IMG-78155489590931.jpg', 'admin', '2019-04-10', 1, 0, NULL, '2019-04-10 11:31:49'),
(26, 'CU0000023', 'UPVNS0000023', 'UP0000023', 'UPVNS00001', 'BRC001', 'Nitesh Kumar Dubey', 'Inspector Dubey', 'S/O', '1991-07-10', '2019-04-10', '2037-04-10', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'Vill-Gundia Kachhawa road Varanasi', '8127116234', 'Male', '833959255524', 'BSJPD0945B', 'UBI', '754602010003387', 'UBIN0575461', 'Babusarai   Bhadohi', 'Nitesh Kumar Dubey', 'Kamala Dubey', 'Mother', '1970-01-02', '../../uploads/IMG-14155489995724.jpg', 'admin', '2019-04-10', 1, 0, NULL, '2019-04-10 12:39:17'),
(27, 'CU0000024', 'UPVNS0000024', 'UP0000024', 'UPVNS00001', 'BRC001', 'Savita Devi', 'Rajeshwar Singh', 'W/O', '1985-07-06', '2019-04-10', '2024-04-10', 'India', 'Khochawa', 'Varanasi', '221307', 'Vill-Danghariya KHochawa varanasi', '9415869577', 'Female', '403412926342', 'CTJPD8170Q', 'na', 'na', 'na', 'na', 'na', 'Rajeshwar Singh', 'Husband', '1981-07-01', '../../uploads/IMG-14155490184815.jpg', 'admin', '2019-04-10', 1, 0, NULL, '2019-04-10 13:10:47'),
(28, 'CU0000025', 'UPVNS0000025', 'UP0000025', 'UPVNS00001', 'BRC001', 'Rajeshwar Singh', 'Ramesh Singh', 'S/O', '1981-07-01', '2019-04-10', '2020-04-10', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'Danghariya  khochwa Varanasi', '9415869577', 'Male', '491103754908', 'HKBPS0373E', 'na', 'na', 'naaa', 'na', 'na', 'Savita DEvi', 'Wife', '1985-07-06', '../../uploads/IMG-18155490544451.jpg', 'admin', '2019-04-10', 1, 0, NULL, '2019-04-10 14:10:43'),
(29, 'CU0000026', 'UPVNS0000026', 'UP0000026', 'UPVNS00001', 'BRC001', 'Surendra Nath Bind', 'Tulashi Ram Bind', 'S/O', '1977-01-01', '2019-04-10', '2024-04-10', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'Gundia Kachhawa Road Varansi', '9118868683', 'Male', '869258185531', 'na', 'na', 'na', 'na', 'na', 'na', 'Gaytri Devi', 'Wife', '1980-01-01', '../../uploads/IMG-53155514601450.jpg', 'admin', '2019-04-13', 1, 0, NULL, '2019-04-13 09:00:13'),
(30, 'CU0000027', 'UPVNS0000027', 'UP0000027', 'UPVNS00004', 'BRC001', 'Mumtaj  Ahamad', 'Ijahar', 'S/O', '1992-07-18', '2019-05-03', '2020-05-03', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'India Tent Hous Kachhawanroad Thatra Varanasi', '9807493811', 'Male', '753368409957', 'BYLPA3107Q', 'State Bank Of India', 'na', 'na', 'Mirzamurad', 'MUmtaj', 'Julekh', 'Wife', '1994-05-12', '../../uploads/IMG-66155689234277.jpg', 'admin', '2019-05-03', 1, 0, NULL, '2019-05-03 14:05:40'),
(31, 'CU0000028', 'UPVNS0000028', 'UP0000028', 'UPVNS00001', '', 'Ripunjay pandey', 'Shiv Sankar Pandey', 'S/O', '1990-08-12', '2019-04-27', '2020-04-27', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'CHitrasenpurkachhawaroad varanasi ', '9580550551', 'Male', '880082184625', 'BQZPP9326Q', 'na', 'na', 'na', 'Mirzamurad', 'na', 'Sandhya Pandey', 'Wife', '1994-02-12', '../../uploads/IMG-70155689396828.jpg', '', '2019-05-03', 1, 0, NULL, '2019-05-03 14:32:48'),
(32, 'CU0000029', 'UPVNS0000029', 'UP0000029', 'UPVNS00002', 'BRC001', 'Jafar Ikbal', 'SHaukat Alli', 'S/O', '1977-07-17', '2018-05-07', '2023-05-07', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'Khochawan Varanasi', '7398553206', 'Male', '388327701948', 'na', 'Allahabad Bank', '50227064975', 'ALLA0212960', 'Thatar kachhawaroad', 'Jafar Ikbal', 'Shahnaj Bano', 'Wife', '1980-05-17', '../../uploads/IMG-67155738592127.jpg', 'admin', '2019-05-09', 1, 0, NULL, '2019-05-09 07:12:00'),
(33, 'CU0000030', 'UPVNS0000030', 'UP0000030', 'UPVNS00001', 'BRC001', 'Rajeshwar Singh', 'Let Ramesh Singh', 'S/O', '1981-07-01', '2019-05-01', '2020-05-01', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'Danghariya ', '9415869577', 'Male', '491103754908', 'HKBPS0373E', 'na', 'na', 'na', 'na', 'na', 'Savita Devi', 'Wife', '1984-01-05', '../../uploads/IMG-69155739554333.jpg', 'admin', '2019-05-09', 1, 0, NULL, '2019-05-09 09:52:22'),
(34, 'CU0000031', 'UPVNS0000031', 'UP0000031', 'UPVNS00004', 'BRC001', 'Mumtaj Ahamad ', 'Ijahar ', 'S/O', '1992-07-18', '2019-05-05', '2021-05-05', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'India Tent Housh kachhawan Road', '9807493811', 'Male', '753368409957', 'BYLPA3107Q', 'Bank Of Baroda', '43600100005505', 'BARB0KACHHW', 'Chitrasenpur Kachhawan Road', 'Mumataj Aahamad so Mohammad Izahar', 'Julekha', 'Wife', '1994-05-17', '../../uploads/IMG-95155740328714.jpg', 'admin', '2019-05-09', 1, 0, NULL, '2019-05-09 12:01:26'),
(35, 'CU0000032', 'UPVNS0000032', 'UP0000032', 'UPVNS00002', 'BRC001', 'Aesh Kumar', 'Kunjan Pal', 'S/O', '1980-02-10', '2019-05-01', '2026-05-01', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'Pure, Kachhawa Road, Varanasi', '8115723426', 'Male', '758787826889', 'na', 'Allahabad Bank', '59146353930', 'ALLA0212960', 'Thatara Kachhawa Road', 'Aesh Kumar', 'Bindu Devi', 'Wife', '1985-10-17', '../../uploads/IMG-41155740848222.jpg', 'admin', '2019-05-09', 1, 0, NULL, '2019-05-09 13:28:01'),
(36, 'CU0000033', 'UPVNS0000033', 'UP0000033', 'UPVNS00002', 'BRC001', 'Ashish Kumar Pal', 'Ramjag Pal', 'S/O', '1994-07-10', '2019-05-09', '2020-05-09', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'Parsottampur Domaila ', '9415984206', 'Male', '595724689659', 'CCIPP7943M', 'na', 'na', 'na', 'na', 'na', 'Nilam Pal', 'Wife', '1996-12-15', '../../uploads/IMG-92155741052745.jpg', 'admin', '2019-05-09', 1, 0, NULL, '2019-05-09 14:02:07'),
(37, 'CU0000034', 'UPVNS0000034', 'UP0000034', 'UPVNS00003', 'BRC001', 'Usha Gupta', 'Suresh Kumar  Gupta', 'W/O', '1985-01-15', '2017-05-20', '2020-05-20', 'India', 'Kachhawa', 'Mirzapur', 'na', 'Majhawa Kachhawa Mirzapur', '7275104133', 'Female', 'na', 'na', 'na', 'na', 'na', 'Mirzamurad', 'na', 'Suresh kumar Gupta', 'Husband', '19980-01-17', '../../uploads/IMG-47155783231782.jpg', 'admin', '2019-05-14', 1, 0, NULL, '2019-05-14 11:11:56'),
(38, 'CU0000035', 'UPVNS0000035', 'UP0000035', 'UPVNS00002', 'BRC001', 'Niraj  Kumar Saroj', 'Chhotelal Saroj', 'S/O', '1990-05-11', '2019-05-12', '2020-05-12', 'India', 'Kachhawan', 'Mirzapur', '231501', 'Karshada Kachhawan Mirzapur', '9005437835', 'Male', '762479296307', 'na', 'Corporetion Bank', '346200101000530', 'CORP0003462', 'Kachhawa Road', 'Nirajkumar Saroj', 'Shadhana Devi', 'Wife', '1997-05-15', '../../uploads/IMG-41155851552678.jpg', 'admin', '2019-05-22', 1, 0, NULL, '2019-05-22 08:58:46'),
(39, 'CU0000036', 'UPVNS0000036', 'UP0000036', 'UPVNS00002', 'BRC001', 'Mamata Devi', 'Pramod', 'W/O', '1991-01-01', '2019-05-28', '2022-05-28', 'India', 'Mirzamurad', 'Varanasi', '221307', 'Milkipur Varanasi', '6394730429', 'Male', '337986328985', 'na', 'na', 'na', 'na', 'Mirzamurad', 'na', 'Pramod', 'Husband', '1988-01-12', '../../uploads/IMG-10155904979743.jpg', 'admin', '2019-05-28', 1, 0, NULL, '2019-05-28 13:23:16'),
(40, 'CU0000037', 'UPVNS0000037', 'UP0000037', 'UPVNS00001', 'BRC001', 'Rishi Kumar', 'Shivraj Maurya', 'S/O', '1987-08-12', '2019-05-27', '2026-05-27', 'India', 'Kachhawa Road', 'Varanasi', '221313', 'Pure, Kachhawa Road, Varanasi', '9793805510', 'Male', '622836738912', 'na', 'na', 'na', 'na', 'Mirzamurad', 'na', 'Sulekha Devi', 'Wife', '1990-05-12', '../../uploads/IMG-90155905119990.jpg', 'admin', '2019-05-28', 1, 0, NULL, '2019-05-28 13:46:39'),
(41, 'CU0000038', 'UPCKN0000038', 'UP0000038', 'UPCKN00005', 'BRC002', 'Rahul kumar', 'rajnarayan mauray', 'S/O', '2019-04-29', '2019-05-08', '2024-05-08', 'India', 'n', 'varanasi', '645435', 'byaspur', '7785987247', 'Female', '64546556476', '63457353', 'satate bank ', '346573564', '73454353543', 'jamuaa bazar', 'rahul', 'rahul', 'None', '2019-05-30', NULL, 'fadmin', '2019-05-30', 1, 0, NULL, '2019-05-30 09:33:30'),
(42, 'CU0000039', 'UPCKN0000039', 'UP0000039', 'UPCKN00005', 'BRC002', 'arun maurya', 'ramji', 'S/O', '2019-04-29', '2019-05-31', '2010-12-30', 'India', 'yeryrue', 'varanasi', 'gfgf', 'dbvdf', '7785987247', 'Male', 'dbhj', 'bdfhj', 'egfyu', 'uyu', 'vcvdc', 'sdf', 'sdvhchds', 'gufy', 'None', '2019-05-26', NULL, 'fadmin', '2019-05-30', 0, 1, '2019-05-31', '2019-05-30 12:23:49'),
(43, 'CU0000040', 'UPCKN0000040', 'UP0000040', 'UPCKN00005', 'BRC002', 'Satish kumar maurya', 'Ramkumar maurya', 'S/O', '2019-05-05', '2019-05-30', '2011-02-04', 'India', 'Nigatpur', 'Varanasi', '231313', 'byaspur', '7785987247', 'Male', '7765465575674', '465764754', 'Union Bank', '3457657453', '45845748', 'Handiya Bhiti', 'satish maurya', 'fa', 'Father', '2019-04-30', NULL, 'fadmin', '2019-05-31', 0, 1, '2019-05-31', '2019-05-31 05:12:43'),
(44, 'CU0000041', 'UPVNS0000041', 'UP0000041', 'UPVNS00003', 'BRC001', 'RAHUL KUMAR MAURYA', 'RAJNARAYAN MAURYA', 'S/O', '2019-05-30', '2019-06-23', '2020-06-03', 'India', 'NIGATPUR', 'VARANASI', '634436', 'MIRZAMURAD', '7785987247', 'Male', '436753534', 'REERERER', 'ALLA', '5736453453453', '46743534', 'JAMUAA', 'RAHUL', 'RA', 'Mother', '2019-06-30', NULL, 'admin', '2019-06-05', 1, 0, NULL, '2019-06-05 11:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `customer_installment_history`
--

CREATE TABLE IF NOT EXISTS `customer_installment_history` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `reciept_no` varchar(20) NOT NULL,
  `pay_amount` double NOT NULL,
  `no_of_installment` int(11) DEFAULT '1',
  `pay_date` varchar(20) NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `status` int(5) DEFAULT '1' COMMENT '0=Inactive, 1=Active',
  `da_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_installment_history`
--

INSERT INTO `customer_installment_history` (`id`, `customer_id`, `reciept_no`, `pay_amount`, `no_of_installment`, `pay_date`, `transaction_id`, `status`, `da_time`) VALUES
(1, 'CU0000001', '00000001', 1500, 1, '2019-02-06', '', 1, '0000-00-00 00:00:00'),
(2, 'CU0000002', '00000002', 15000, 1, '2018-10-11', '', 1, '0000-00-00 00:00:00'),
(3, 'CU0000003', '00000003', 25000, 1, '2019-03-14', '', 1, '0000-00-00 00:00:00'),
(4, 'CU0000001', '00000004', 3000, 2, '2019-03-20', '', 1, '0000-00-00 00:00:00'),
(5, 'CU0000004', '00000005', 40000, 1, '2018-12-25', '', 1, '0000-00-00 00:00:00'),
(6, 'CU0000005', '00000006', 75000, 1, '2018-12-25', '', 1, '0000-00-00 00:00:00'),
(7, 'CU0000006', '00000007', 10000, 1, '2019-03-10', '', 1, '0000-00-00 00:00:00'),
(8, 'CU0000007', '00000008', 200000, 1, '2020-03-14', '', 0, '2019-06-01 01:37:09'),
(9, 'CU0000008', '00000009', 200000, 1, '2019-03-14', '', 1, '0000-00-00 00:00:00'),
(10, 'CU0000009', '00000010', 10000, 1, '2019-02-28', '', 1, '0000-00-00 00:00:00'),
(11, 'CU0000010', '00000011', 1000, 1, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(12, 'CU0000011', '00000012', 1000, 1, '2017-04-18', '', 1, '0000-00-00 00:00:00'),
(13, 'CU0000011', '00000013', 17000, 17, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(14, 'CU0000011', '00000014', 2000, 2, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(15, 'CU0000012', '00000015', 500, 1, '2017-04-18', '', 1, '0000-00-00 00:00:00'),
(16, 'CU0000012', '00000016', 9000, 18, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(17, 'CU0000013', '00000017', 1000, 1, '2017-05-22', '', 1, '0000-00-00 00:00:00'),
(18, 'CU0000013', '00000018', 17000, 17, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(20, 'CU0000014', '00000020', 500, 1, '2014-03-25', '', 1, '0000-00-00 00:00:00'),
(21, 'CU0000014', '00000021', 23500, 47, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(23, 'CU0000014', '00000022', 3000, 6, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(24, 'CU0000015', '00000023', 1000, 1, '2014-03-24', '', 1, '0000-00-00 00:00:00'),
(25, 'CU0000015', '00000024', 1000, 1, '2014-03-24', '', 1, '0000-00-00 00:00:00'),
(26, 'CU0000015', '00000025', 1000, 1, '2014-03-24', '', 1, '0000-00-00 00:00:00'),
(27, 'CU0000015', '00000026', 1000, 1, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(28, 'CU0000015', '00000027', 2000, 2, '2019-03-29', '', 1, '0000-00-00 00:00:00'),
(30, 'CU0000016', '00000028', 500, 1, '2019-03-30', '', 1, '2019-03-30 07:53:18'),
(31, 'CU0000015', '00000029', 49000, 49, '2019-03-30', '', 1, '2019-03-30 07:58:01'),
(32, 'CU0000017', '00000030', 300, 1, '2015-08-03', '', 1, '2019-03-30 08:20:52'),
(33, 'CU0000017', '00000031', 11100, 37, '2019-03-30', '', 1, '2019-03-30 08:28:00'),
(34, 'CU0000018', '00000032', 500, 1, '2014-07-31', '', 1, '2019-03-30 08:38:54'),
(35, 'CU0000018', '00000033', 25500, 51, '2019-03-30', '', 1, '2019-03-30 08:40:10'),
(36, 'CU0000019', '00000034', 300, 1, '2014-07-31', '', 1, '2019-03-30 08:49:11'),
(37, 'CU0000019', '00000035', 15300, 51, '2019-03-30', '', 1, '2019-03-30 08:50:49'),
(38, 'CU0000020', '00000036', 3000, 1, '2019-03-30', '', 1, '2019-03-30 09:22:51'),
(39, 'CU0000021', '00000037', 1000, 1, '2019-03-30', '', 1, '2019-03-30 09:40:54'),
(40, 'CU0000022', '00000038', 1000, 1, '2019-04-10', '', 1, '2019-04-10 06:01:49'),
(41, 'CU0000023', '00000039', 1000, 1, '2019-04-10', '', 1, '2019-04-10 07:09:17'),
(42, 'CU0000024', '00000040', 1500, 1, '2019-04-10', '', 1, '2019-04-10 07:40:47'),
(43, 'CU0000025', '00000041', 6000, 1, '2019-04-10', '', 1, '2019-04-10 08:40:43'),
(44, 'CU0000026', '00000042', 1000, 1, '2019-04-10', '', 1, '2019-04-13 03:30:13'),
(45, 'CU0000019', '00000043', 1800, 6, '2019-04-19', '', 1, '2019-04-19 03:28:43'),
(46, 'CU0000011', '00000044', 6000, 6, '2019-04-19', '', 1, '2019-04-19 03:31:00'),
(47, 'CU0000012', '00000045', 3000, 6, '2019-04-19', '', 1, '2019-04-19 03:33:21'),
(48, 'CU0000018', '00000046', 3000, 6, '2019-04-19', '', 1, '2019-04-19 03:34:46'),
(49, 'CU0000017', '00000047', 1800, 6, '2019-04-19', '', 1, '2019-04-19 03:35:58'),
(50, 'CU0000013', '00000048', 6000, 6, '2019-04-19', '', 1, '2019-04-19 03:40:19'),
(51, 'CU0000026', '00000049', 1000, 1, '2019-05-02', '', 1, '2019-05-02 00:42:01'),
(52, 'CU0000023', '00000050', 1000, 1, '2019-05-02', '', 1, '2019-05-02 00:44:14'),
(53, 'CU0000010', '00000051', 1000, 1, '2019-05-02', '', 1, '2019-05-02 00:45:34'),
(54, 'CU0000021', '00000052', 1000, 1, '2019-05-02', '', 1, '2019-05-02 00:47:22'),
(55, 'CU0000001', '00000053', 1500, 1, '2019-05-02', '', 1, '2019-05-02 00:48:59'),
(56, 'CU0000020', '00000054', 3000, 1, '2019-05-03', '', 1, '2019-05-03 04:58:36'),
(57, 'CU0000027', '00000055', 3000, 1, '2019-05-03', '', 1, '2019-05-03 08:35:41'),
(58, 'CU0000028', '00000056', 5000, 1, '2019-04-27', '', 1, '2019-05-03 09:02:48'),
(59, 'CU0000024', '00000057', 1500, 1, '2019-05-09', '', 1, '2019-05-09 00:29:21'),
(60, 'CU0000022', '00000058', 1000, 1, '2019-05-09', '', 1, '2019-05-09 00:31:28'),
(61, 'CU0000029', '00000059', 1000, 1, '2018-05-07', '', 1, '2019-05-09 01:42:00'),
(62, 'CU0000029', '00000060', 13000, 13, '2019-05-09', '', 1, '2019-05-09 01:56:46'),
(63, 'CU0000030', '00000061', 6000, 1, '2019-05-01', '', 1, '2019-05-09 04:22:22'),
(64, 'CU0000031', '00000062', 100000, 1, '2019-05-05', '', 1, '2019-05-09 06:31:26'),
(65, 'CU0000032', '00000063', 5000, 1, '2019-05-01', '', 1, '2019-05-09 07:58:01'),
(66, 'CU0000033', '00000064', 5000, 1, '2019-05-09', '', 1, '2019-05-09 08:32:07'),
(67, 'CU0000019', '00000065', 300, 1, '2019-05-14', '', 1, '2019-05-14 05:16:09'),
(68, 'CU0000018', '00000066', 500, 1, '2019-05-14', '', 1, '2019-05-14 05:17:10'),
(69, 'CU0000013', '00000067', 1000, 1, '2019-05-14', '', 1, '2019-05-14 05:22:31'),
(70, 'CU0000012', '00000068', 500, 1, '2019-05-14', '', 1, '2019-05-14 05:24:20'),
(71, 'CU0000017', '00000069', 300, 1, '2019-05-14', '', 1, '2019-05-14 05:25:46'),
(72, 'CU0000034', '00000070', 6000, 1, '2017-05-20', '', 1, '2019-05-14 05:41:56'),
(73, 'CU0000034', '00000071', 12000, 2, '2019-05-14', '', 1, '2019-05-14 05:43:04'),
(74, 'CU0000035', '00000072', 3000, 1, '2019-05-12', '', 1, '2019-05-22 03:28:46'),
(75, 'CU0000036', '00000073', 500, 1, '2019-05-28', '', 1, '2019-05-28 07:53:16'),
(76, 'CU0000037', '00000074', 5000, 1, '2019-05-27', '', 1, '2019-05-28 08:16:39'),
(77, 'CU0000021', '00000075', 1000, 1, '2019-06-02', '', 1, '2019-06-02 04:44:37'),
(78, 'CU0000020', '00000076', 3000, 1, '2019-06-02', '', 1, '2019-06-02 04:46:55'),
(79, 'CU0000010', '00000077', 1000, 1, '2019-06-02', '', 1, '2019-06-02 04:49:51'),
(80, 'CU0000038', '00000078', 1500, 1, '2019-06-01', '', 1, '2019-06-05 07:41:18'),
(81, 'CU0000039', '00000079', 1500, 1, '2019-06-01', '', 1, '2019-06-06 02:40:40'),
(82, 'CU0000040', '00000080', 3000, 1, '2019-06-01', '', 1, '2019-06-06 03:27:46'),
(83, 'CU0000041', '00000081', 12000, 1, '2019-06-04', '', 1, '2019-06-06 04:15:38'),
(84, 'CU0000042', '00000082', 3000, 1, '2019-06-05', '', 1, '2019-06-07 07:28:35'),
(85, 'CU0000043', '00000083', 3000, 1, '2019-05-10', '', 1, '2019-06-07 07:45:40'),
(86, 'CU0000022', '00000084', 1000, 1, '2019-06-08', '', 1, '2019-06-08 00:16:28'),
(87, 'CU0000024', '00000085', 1500, 1, '2019-06-08', '', 1, '2019-06-08 00:20:44'),
(88, 'CU0000001', '00000086', 1500, 1, '2019-06-08', '', 1, '2019-06-08 00:23:18'),
(89, 'CU0000027', '00000087', 3000, 1, '2019-06-08', '', 1, '2019-06-08 01:37:26'),
(90, 'CU0000030', '00000088', 6000, 1, '2019-06-08', '', 1, '2019-06-08 01:46:19'),
(91, 'CU0000035', '00000089', 3000, 1, '2019-06-09', '', 1, '2019-06-09 04:16:07'),
(92, 'CU0000029', '00000090', 1000, 1, '2019-06-09', '', 1, '2019-06-09 04:18:09'),
(93, 'CU0000033', '00000091', 5000, 1, '2019-06-09', '', 1, '2019-06-09 04:20:08'),
(94, 'CU0000044', '00000092', 1500, 1, '2019-06-01', '', 1, '2019-06-10 05:08:08'),
(95, 'CU0000045', '00000093', 1500, 1, '2019-06-10', '', 1, '2019-06-10 05:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `customer_maturity_return_history`
--

CREATE TABLE IF NOT EXISTS `customer_maturity_return_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(20) NOT NULL,
  `maturity_return_amount` double NOT NULL,
  `return_date` varchar(20) NOT NULL,
  `transaction_ id` varchar(30) NOT NULL,
  `c_by` varchar(20) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `branch_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer_maturity_return_history`
--

INSERT INTO `customer_maturity_return_history` (`id`, `customer_id`, `maturity_return_amount`, `return_date`, `transaction_ id`, `c_by`, `status`, `branch_id`) VALUES
(1, 'CU0000015', 90000, '2019-06-07', '999999999999', 'admin', 1, 'BRC001');

-- --------------------------------------------------------

--
-- Table structure for table `customer_mis_info`
--

CREATE TABLE IF NOT EXISTS `customer_mis_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(20) NOT NULL,
  `no_of_mis` varchar(20) NOT NULL,
  `no_of_pay_mis` varchar(20) NOT NULL DEFAULT '0',
  `mis_paid_upto_date` varchar(20) NOT NULL,
  `c_by` varchar(20) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '1=active,0=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer_mis_info`
--

INSERT INTO `customer_mis_info` (`id`, `customer_id`, `no_of_mis`, `no_of_pay_mis`, `mis_paid_upto_date`, `c_by`, `status`) VALUES
(1, 'CU0000007', '24', '14', '2018-05-14', 'admin', 1),
(2, 'CU0000008', '24', '5', '2019-05-14', 'admin', 1),
(3, 'CU0000031', '24', '1', '2019-06-05', 'admin', 1),
(4, 'CU0000039', '24', '6', '2009-06-30', 'fadmin', 0),
(5, 'CU0000040', '24', '0', '2009-02-04', 'fadmin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_pay_mis_history`
--

CREATE TABLE IF NOT EXISTS `customer_pay_mis_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(50) NOT NULL,
  `pay_amount` double NOT NULL,
  `on_of_pay_mis` int(50) NOT NULL,
  `transaction_id` varchar(25) NOT NULL,
  `pay_date` varchar(20) NOT NULL,
  `c_by` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '1=active, 0=inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `customer_pay_mis_history`
--

INSERT INTO `customer_pay_mis_history` (`id`, `customer_id`, `pay_amount`, `on_of_pay_mis`, `transaction_id`, `pay_date`, `c_by`, `status`) VALUES
(1, 'CU0000008', 4000, 2, '', '2019-02-30', 'admin', 1),
(2, 'CU0000039', 72, 6, '', '2019-05-30', 'fadmin', 1),
(3, 'CU0000008', 6000, 3, '', '2019-06-05', 'admin', 1),
(4, 'CU0000031', 1000, 1, '', '2019-06-10', 'admin', 1),
(5, 'CU0000007', 2000, 1, '634673467345', '2019-06-13', 'admin', 1),
(6, 'CU0000007', 6000, 3, '236476732643', '2019-06-13', 'admin', 1),
(7, 'CU0000007', 2000, 1, '0', '2019-06-13', 'admin', 1),
(8, 'CU0000007', 2000, 1, '12', '2019-06-13', 'admin', 1),
(9, 'CU0000007', 2000, 1, '222222222222', '2019-06-13', 'admin', 1),
(10, 'CU0000007', 2000, 1, '0', '2019-06-13', 'admin', 1),
(11, 'CU0000007', 2000, 1, '0', '2019-06-13', 'admin', 1),
(12, 'CU0000007', 2000, 1, '0', '2019-06-13', 'admin', 1),
(13, 'CU0000007', 2000, 1, '222222222222', '2019-06-13', 'admin', 1),
(14, 'CU0000007', 2000, 1, '999999999999', '2019-06-13', 'admin', 1),
(15, 'CU0000007', 2000, 1, '233434343334', '2019-06-13', 'admin', 1),
(16, 'CU0000007', 2000, 1, '444444444444', '2019-06-13', 'admin', 1),
(17, 'CU0000007', 2000, 1, '232324234242', '2019-06-24', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_plan_mapping`
--

CREATE TABLE IF NOT EXISTS `customer_plan_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(100) NOT NULL,
  `agency_code` varchar(100) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(200) NOT NULL,
  `plan_duration` varchar(100) NOT NULL,
  `commision_in_per` double NOT NULL,
  `interest_rate_in_per` varchar(250) NOT NULL,
  `plan_type` varchar(50) NOT NULL,
  `pay_mode` varchar(150) NOT NULL,
  `total_installment_amount` double NOT NULL,
  `installment_amount` double NOT NULL,
  `no_of_installment` varchar(20) NOT NULL,
  `no_of_pay_installment` varchar(20) NOT NULL,
  `maturity_return` double DEFAULT NULL,
  `plot_consideration` double NOT NULL,
  `c_date` varchar(20) NOT NULL,
  `c_by` varchar(100) NOT NULL,
  `status` int(5) NOT NULL COMMENT '1=active, 0=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `customer_plan_mapping`
--

INSERT INTO `customer_plan_mapping` (`id`, `customer_id`, `agency_code`, `branch_id`, `plan_id`, `plan_name`, `plan_duration`, `commision_in_per`, `interest_rate_in_per`, `plan_type`, `pay_mode`, `total_installment_amount`, `installment_amount`, `no_of_installment`, `no_of_pay_installment`, `maturity_return`, `plot_consideration`, `c_date`, `c_by`, `status`) VALUES
(1, 'CU0000001', 'UPVNS00001', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 90000, 1500, '60', '15', 121655, 90, '2019-02-06', 'admin', 1),
(2, 'CU0000002', 'UPVNS00001', 'BRC001', 3, 'surchha plus  1101', '84', 10, '12', 'FD', 'fixdeposite', 15000, 15000, '1', '1', 30000, 15, '2018-10-11', 'admin', 1),
(3, 'CU0000003', 'UPVNS00001', 'BRC001', 3, 'surchha plus  1101', '84', 10, '12', 'FD', 'fixdeposite', 25000, 25000, '1', '1', 50000, 25, '2019-03-14', 'admin', 1),
(4, 'CU0000004', 'UPVNS00001', 'BRC001', 3, 'surchha plus  1101', '84', 10, '12', 'FD', 'fixdeposite', 40000, 40000, '1', '1', 80000, 40, '2018-12-25', 'admin', 1),
(5, 'CU0000005', 'UPVNS00001', 'BRC001', 3, 'surchha plus  1101', '84', 10, '12', 'FD', 'fixdeposite', 75000, 75000, '1', '1', 150000, 75, '2018-12-25', 'admin', 1),
(6, 'CU0000006', 'UPVNS00001', 'BRC001', 3, 'surchha plus  1101', '84', 10, '12', 'FD', 'fixdeposite', 10000, 10000, '1', '1', 20000, 10, '2019-03-10', 'admin', 1),
(7, 'CU0000007', 'UPVNS00001', 'BRC001', 4, 'Money Plus', '24', 5, '12', 'MIS', 'fixdeposite', 200000, 200000, '1', '1', 200000, 200, '2019-03-14', 'admin', 1),
(8, 'CU0000008', 'UPVNS00001', 'BRC001', 4, 'Money Plus', '24', 5, '12', 'MIS', 'fixdeposite', 200000, 200000, '1', '1', 200000, 200, '2019-03-14', 'admin', 1),
(9, 'CU0000009', 'UPVNS00001', 'BRC001', 3, 'surchha plus  1101', '84', 10, '12', 'FD', 'fixdeposite', 10000, 10000, '1', '1', 20000, 10, '2019-02-28', 'admin', 1),
(10, 'CU0000010', 'UPVNS00001', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 60000, 1000, '60', '2', 78082, 60, '2019-03-29', 'admin', 1),
(11, 'CU0000011', 'UPVNS00002', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 60000, 1000, '60', '26', 45000, 60, '2017-04-18', 'admin', 1),
(12, 'CU0000012', 'UPVNS00003', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 30000, 500, '60', '27', 22500, 30, '2017-04-18', 'admin', 1),
(13, 'CU0000013', 'UPVNS00003', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 60000, 1000, '60', '25', 45000, 60, '2017-05-22', 'admin', 1),
(14, 'CU0000014', 'UPVNS00003', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 30000, 500, '60', '54', 45000, 30, '2014-03-25', 'admin', 1),
(16, 'CU0000015', 'UPVNS00003', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 60000, 1000, '60', '55', 90000, 60, '2014-03-24', 'admin', 1),
(19, 'CU0000016', 'UPVNS00001', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 30000, 500, '60', '1', 39041, 30, '2019-03-30', 'admin', 1),
(20, 'CU0000017', 'UPVNS00003', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 18000, 300, '60', '45', 26250, 18, '2015-08-03', 'admin', 1),
(21, 'CU0000018', 'UPVNS00003', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 30000, 500, '60', '59', 45000, 30, '2014-07-31', 'admin', 1),
(22, 'CU0000019', 'UPVNS00003', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 18000, 300, '60', '59', 27000, 18, '2014-07-31', 'admin', 1),
(23, 'CU0000020', 'UPVNS00001', 'BRC001', 5, 'Profit Plus 105', '12', 5, '15', 'RD', 'monthly', 36000, 3000, '12', '2', 39000, 36, '2019-03-30', 'admin', 1),
(24, 'CU0000021', 'UPVNS00001', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 60000, 1000, '60', '2', 78082, 60, '2019-03-30', 'admin', 1),
(25, 'CU0000022', 'UPVNS00001', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 60000, 1000, '60', '2', 78082, 60, '2019-04-10', 'admin', 1),
(26, 'CU0000023', 'UPVNS00001', 'BRC001', 6, 'Dhanlakchhmi', '216', 5, '10', 'RD', 'monthly', 216000, 1000, '216', '2', 576398, 216, '2019-04-10', 'admin', 1),
(27, 'CU0000024', 'UPVNS00001', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 90000, 1500, '60', '2', 121655, 90, '2019-04-10', 'admin', 1),
(28, 'CU0000025', 'UPVNS00001', 'BRC001', 5, 'Profit Plus 105', '12', 5, '15', 'RD', 'monthly', 72000, 6000, '12', '1', 78000, 72, '2019-04-10', 'admin', 1),
(29, 'CU0000026', 'UPVNS00001', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 60000, 1000, '60', '2', 78082, 60, '2019-04-10', 'admin', 1),
(30, 'CU0000027', 'UPVNS00004', 'BRC001', 5, 'Profit Plus 105', '12', 5, '15', 'RD', 'monthly', 36000, 3000, '12', '1', 39000, 36, '2019-05-03', 'admin', 1),
(31, 'CU0000028', 'UPVNS00001', 'BRC001', 5, 'Profit Plus 105', '12', 5, '15', 'RD', 'monthly', 60000, 5000, '12', '1', 65000, 60, '2019-04-27', '', 1),
(32, 'CU0000029', 'UPVNS00002', 'BRC001', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'monthly', 60000, 1000, '60', '14', 78082, 60, '2018-05-07', 'admin', 1),
(33, 'CU0000030', 'UPVNS00001', 'BRC001', 5, 'Profit Plus 105', '12', 5, '15', 'RD', 'monthly', 72000, 6000, '12', '1', 78000, 72, '2019-05-01', 'admin', 1),
(34, 'CU0000031', 'UPVNS00004', 'BRC001', 4, 'Money Plus', '24', 5, '12', 'MIS', 'fixdeposite', 100000, 100000, '1', '1', 100000, 100, '2019-05-05', 'admin', 1),
(35, 'CU0000032', 'UPVNS00002', 'BRC001', 3, 'surchha plus  1101', '84', 10, '12', 'FD', 'fixdeposite', 5000, 5000, '1', '1', 10000, 5, '2019-05-01', 'admin', 1),
(36, 'CU0000033', 'UPVNS00002', 'BRC001', 5, 'Profit Plus 105', '12', 5, '15', 'RD', 'monthly', 60000, 5000, '12', '1', 65000, 60, '2019-05-09', 'admin', 1),
(37, 'CU0000034', 'UPVNS00003', 'BRC001', 8, 'Profit Plus 103', '36', 5, '12', 'RD', 'yearly', 18000, 6000, '3', '3', 22500, 18, '2017-05-20', 'admin', 1),
(38, 'CU0000035', 'UPVNS00002', 'BRC001', 5, 'Profit Plus 105', '12', 5, '15', 'RD', 'monthly', 36000, 3000, '12', '1', 39000, 36, '2019-05-12', 'admin', 1),
(39, 'CU0000036', 'UPVNS00002', 'BRC001', 8, 'Profit Plus 103', '36', 5, '12', 'RD', 'monthly', 18000, 500, '36', '1', 21712, 18, '2019-05-28', 'admin', 1),
(40, 'CU0000037', 'UPVNS00001', 'BRC001', 3, 'surchha plus  1101', '84', 10, '12', 'FD', 'fixdeposite', 5000, 5000, '1', '1', 10000, 5, '2019-05-27', 'admin', 1),
(41, 'CU0000038', 'UPCKN00005', 'BRC002', 1, 'Profit Plus 101', '60', 5, '10', 'RD', 'quarterly', 2000, 100, '20', '11', 50000, 2, '2019-05-08', 'fadmin', 1),
(42, 'CU0000039', 'UPCKN00005', 'BRC002', 4, 'Money Plus', '24', 5, '12', 'MIS', 'fixdeposite', 1200, 1200, '1', '1', 1000, 1.2, '2008-12-30', 'fadmin', 0),
(43, 'CU0000040', 'UPCKN00005', 'BRC002', 4, 'Money Plus', '24', 5, '12', 'MIS', 'fixdeposite', 3000, 3000, '1', '1', 6000, 3, '2009-02-04', 'fadmin', 0),
(44, 'CU0000041', 'UPVNS00003', 'BRC001', 5, 'Profit Plus 105', '12', 5, '15', 'RD', 'monthly', 12000, 1000, '12', '9', 1500, 12, '2019-06-03', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` varchar(50) NOT NULL,
  `user_id` varchar(40) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `expense_name` varchar(250) NOT NULL,
  `description` text,
  `expense_amount` float NOT NULL,
  `expense_date` varchar(20) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '1=active,0=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `expense_id`, `user_id`, `branch_id`, `expense_name`, `description`, `expense_amount`, `expense_date`, `status`) VALUES
(1, '1560512306', 'admin', 'BRC001', 'Parle', 'Parle', 1000, '2019-06-14', 1),
(3, '1560576141', 'admin', 'BRC001', 'Orange', 'ORANGE', 20, '2019-06-27', 1),
(14, '1560768594', 'superuser', 'VNS', 'gfyuyu', 'dfuerhf', 300, '2019-06-18', 1),
(15, '1560768594', 'superuser', 'VNS', 'uyfe', 'bdfreuygf', 400, '2019-06-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `f_cofis`
--

CREATE TABLE IF NOT EXISTS `f_cofis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(20) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `post` varchar(20) DEFAULT NULL,
  `district` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `f_cofis`
--

INSERT INTO `f_cofis` (`id`, `company_id`, `company_name`, `address`, `post`, `district`, `state`, `country`, `email`, `contact`, `logo`, `favicon`, `title`, `short_name`) VALUES
(1, 'COMP001', 'Kashi India Developers LTD.', 'N/A', 'N/A', 'N/A', 'N/A', 'INDIA', 'N/A', 'N/A', '../../images/logo/alogo.png', '../../mages/logo/logo.jpg', 'Kashi India Developers LTD.', 'KID');

-- --------------------------------------------------------

--
-- Table structure for table `f_countries`
--

CREATE TABLE IF NOT EXISTS `f_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `f_currency_configuration`
--

CREATE TABLE IF NOT EXISTS `f_currency_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `in_doller` double NOT NULL,
  `in_inr` double NOT NULL,
  `rate_for` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `f_menu_detail`
--

CREATE TABLE IF NOT EXISTS `f_menu_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `menu_id` varchar(20) DEFAULT NULL,
  `menu_pid` varchar(20) DEFAULT '0',
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_url` varchar(200) DEFAULT NULL,
  `menu_priority` int(11) DEFAULT '1',
  `menu_icon` varchar(50) DEFAULT NULL,
  `menu_position` varchar(20) DEFAULT 'LEFT',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `f_menu_detail`
--

INSERT INTO `f_menu_detail` (`id`, `menu_id`, `menu_pid`, `menu_name`, `menu_url`, `menu_priority`, `menu_icon`, `menu_position`) VALUES
(1, 'MEN001', '0', 'Dashboard', '../../view/dashboard/dashboard.php', 1, '<i class="menu-icon fa fa-tachometer"></i>', 'LEFT'),
(2, 'MEN002', '0', 'Manage Role', '#', 1, '<i class="menu-icon fa fa-users"></i>', 'LEFT'),
(3, 'MEN003', 'MEN002', 'Create Role', '../../view/user/createRole.php', 1, '<i class="menu-icon fa fa-list"></i>', 'LEFT'),
(4, 'MEN004', 'MEN002', 'Assign Menu', '../../view/user/assignMenu.php', 1, '<i class="menu-icon fa fa-user-plus"></i>', 'LEFT'),
(5, 'MEN005', '0', 'Manage User', '#', 1, '<i class="menu-icon fa fa-user"></i>', 'LEFT'),
(6, 'MEN006', 'MEN005', 'Create User', '../../view/user/addUser.php', 1, '<i class="menu-icon fa fa-list"></i>', 'LEFT'),
(9, 'MEN007', 'MEN005', 'All User', '../../view/user/allUsers.php', 1, '<i class="menu-icon fa fa-eye"></i>', 'LEFT'),
(10, 'MEN008', '0', 'Mannage Branch', '#', 1, '<i class="menu-icon fa fa-briefcase"></i>', 'LEFT'),
(11, 'MEN009', 'MEN008', 'Add Branch', '../../view/branch/addBranch.php', 1, '<i class="menu-icon fa fa-list"></i>', 'LEFT'),
(12, 'MEN0010', 'MEN008', 'Branch List', '../../view/branch/branchList.php', 1, '<i class="menu-icon fa fa-building"></i>', 'LEFT'),
(13, 'MEN0011', '0', 'Manage Plan', '#', 1, '<i class="menu-icon fa fa-eye"></i>', 'LEFT'),
(14, 'MEN0012', 'MEN0011', 'Add Plan', '../../view/plan/addPlan.php', 1, '<i class="menu-icon fa fa-edit"></i>', 'LEFT'),
(16, 'MEN0013', 'MEN0011', 'Plan List', '../../view/plan/planList.php', 1, '<i class="menu-icon fa fa-male"></i>', 'LEFT'),
(17, 'MEN0014', '0', 'Manage Agent', '#', 1, '<i class="menu-icon fa fa-edit"></i>', 'LEFT'),
(18, 'MEN0015', 'MEN0014', 'Add Agent', '../../view/agent/addAgent.php', 1, '<i class="menu-icon fa fa-gears"></i>', 'LEFT'),
(19, 'MEN0016', 'MEN0014', 'Agent List', '../../view/agent/agentList.php', 1, '<i class="menu-icon fa fa-globe"></i>', 'LEFT'),
(20, 'MEN0017', '0', 'Manage Customer', '#', 1, '<i class="fa fa-user"></i>', 'LEFT'),
(21, 'MEN0018', 'MEN0017', 'Add Customer', '../../view/customer/addCustomer.php', 1, '<i class="fa fa-user"></i>', 'LEFT'),
(22, 'MEN0019', 'MEN0017', 'Customer List', '../../view/customer/customerList.php', 1, '<i class="menu-icon fa fa-list"></i>', 'LEFT'),
(23, 'MEN0020', '0', 'Manage Installment', '#', 1, '<i class="menu-icon fa fa-rupee"></i>', 'LEFT'),
(24, 'MEN0021', 'MEN0020', 'Deposit  Installment', '../../view/installment/depositInstallment.php', 1, '<i class="menu-icon fa fa-rupee"></i>', 'LEFT'),
(25, 'MEN0022', 'MEN0014', 'Pay Agent Commission', '../../view/agent/payAgentCommissionAmount.php', 1, '<i class="menu-icon fa fa-rupee"></i>', 'LEFT'),
(26, 'MEN0023', '0', 'Manage MIS', '#', 1, '<i class="fa fa-user"></i>', 'LEFT'),
(27, 'MEN0024', 'MEN0023', 'Pay MIS', '../../view/mis/manageMis.php', 1, '<i class="fa fa-rupee"></i>', 'LEFT'),
(28, 'MEN0025', 'MEN0017', 'Maturity Pending List', '../../view/customer/claimedMaturityPendingList.php', 1, '<i class="fa fa-rupee"></i>', 'LEFT'),
(29, 'MEN0026', 'MEN0017', 'Maturity Paid List', '../../view/customer/claimedMaturityPaidList.php', 1, '<i class="fa fa-rupee"></i>', 'LEFT'),
(31, 'MEN0027', 'MEN0017', 'FD Customer List', '../../view/customer/fdCustomerList.php', 1, '<i class="fa fa-user"></i>', 'LEFT'),
(32, 'MEN0028', 'MEN0017', 'RD Customer List', '../../view/customer/rdCustomerList.php', 1, '<i class="fa fa-user"></i>', 'LEFT'),
(33, 'MEN0029', 'MEN0017', 'MIS Customer List', '../../view/customer/misCustomerList.php', 1, '<i class="fa fa-user"></i>', 'LEFT'),
(34, 'MEN0030', '0', 'Manage Expense', '#', 1, '<i class="fa fa-rupee"></i>', 'LEFT'),
(35, 'MEN0031', 'MEN0030', 'add Expense', '../../view/expense/addExpense.php', 1, '<i class=" fa fa-rupee"></i>', 'LEFT'),
(36, 'MEN0032', 'MEN0030', 'Expense List', '../../view/expense/expenseList.php', 1, '<i class="fa fa-book"></i>', 'LEFT');

-- --------------------------------------------------------

--
-- Table structure for table `f_role_menu_mapping`
--

CREATE TABLE IF NOT EXISTS `f_role_menu_mapping` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(20) DEFAULT NULL,
  `menu_id` varchar(20) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=204 ;

--
-- Dumping data for table `f_role_menu_mapping`
--

INSERT INTO `f_role_menu_mapping` (`id`, `role_id`, `menu_id`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`) VALUES
(1, 'ROL001', 'MEN001', 'admin', '2018-10-23', NULL, NULL, 1),
(2, 'ROL001', 'MEN002', 'admin', '2018-10-23', NULL, NULL, 1),
(3, 'ROL001', 'MEN003', 'admin', '2018-10-23', NULL, NULL, 1),
(4, 'ROL001', 'MEN004', 'admin', '2018-10-23', NULL, NULL, 1),
(5, 'ROL001', 'MEN005', 'admin', '2018-10-23', NULL, NULL, 1),
(6, 'ROL001', 'MEN006', 'admin', '2018-10-23', NULL, NULL, 1),
(7, 'ROL001', 'MEN007', 'admin', '2018-10-23', NULL, NULL, 1),
(8, 'ROL001', 'MEN008', 'admin', '2018-10-23', NULL, NULL, 1),
(9, 'ROL001', 'MEN009', 'admin', '2018-10-23', NULL, NULL, 1),
(10, 'ROL001', 'MEN0010', 'admin', '2018-10-23', NULL, NULL, 1),
(11, 'ROL001', 'MEN0011', 'admin', '2018-10-23', NULL, NULL, 1),
(12, 'ROL001', 'MEN0012', 'admin', '2018-10-23', NULL, NULL, 1),
(13, 'ROL001', 'MEN0013', 'admin', '2018-10-23', NULL, NULL, 1),
(14, 'ROL001', 'MEN0014', 'admin', '2018-10-23', NULL, NULL, 1),
(15, 'ROL001', 'MEN0015', 'admin', '2018-10-23', NULL, NULL, 1),
(16, 'ROL001', 'MEN0016', 'admin', '2018-10-23', NULL, NULL, 1),
(33, 'ROL001', 'MEN0017', 'admin', '2019-03-07', NULL, NULL, 1),
(34, 'ROL001', 'MEN0018', 'admin', '2019-03-07', NULL, NULL, 1),
(35, 'ROL001', 'MEN0019', 'admin', '2019-03-09', NULL, NULL, 1),
(54, 'ROL001', 'MEN0020', 'admin', '2019-03-11', NULL, NULL, 1),
(55, 'ROL001', 'MEN0021', 'admin', '2019-03-11', NULL, NULL, 1),
(100, 'ROL001', 'MEN0022', 'admin', '2019-03-15', NULL, NULL, 1),
(101, 'ROL001', 'MEN0023', 'admin', '2019-03-28', NULL, NULL, 1),
(102, 'ROL001', 'MEN0024', 'admin', '2019-03-28', NULL, NULL, 1),
(105, 'ROL001', 'MEN0025', 'admin', '2019-04-01', NULL, NULL, 1),
(106, 'ROL001', 'MEN0026', 'admin', '2019-05-24', NULL, NULL, 1),
(108, 'ROL001', 'MEN0027', 'admin', '2019-05-28', NULL, NULL, 1),
(109, 'ROL001', 'MEN0028', 'admin', '2019-05-28', NULL, NULL, 1),
(110, 'ROL001', 'MEN0029', 'admin', '2019-05-28', NULL, NULL, 1),
(111, 'ROL002', 'MEN001', 'admin', '2019-05-30', NULL, NULL, 1),
(112, 'ROL002', 'MEN002', 'admin', '2019-05-30', NULL, NULL, 1),
(113, 'ROL002', 'MEN003', 'admin', '2019-05-30', NULL, NULL, 1),
(114, 'ROL002', 'MEN004', 'admin', '2019-05-30', NULL, NULL, 1),
(115, 'ROL002', 'MEN005', 'admin', '2019-05-30', NULL, NULL, 1),
(116, 'ROL002', 'MEN006', 'admin', '2019-05-30', NULL, NULL, 1),
(117, 'ROL002', 'MEN007', 'admin', '2019-05-30', NULL, NULL, 1),
(118, 'ROL002', 'MEN008', 'admin', '2019-05-30', NULL, NULL, 1),
(119, 'ROL002', 'MEN009', 'admin', '2019-05-30', NULL, NULL, 1),
(120, 'ROL002', 'MEN0010', 'admin', '2019-05-30', NULL, NULL, 1),
(121, 'ROL002', 'MEN0011', 'admin', '2019-05-30', NULL, NULL, 1),
(122, 'ROL002', 'MEN0012', 'admin', '2019-05-30', NULL, NULL, 1),
(123, 'ROL002', 'MEN0013', 'admin', '2019-05-30', NULL, NULL, 1),
(124, 'ROL002', 'MEN0014', 'admin', '2019-05-30', NULL, NULL, 1),
(125, 'ROL002', 'MEN0015', 'admin', '2019-05-30', NULL, NULL, 1),
(126, 'ROL002', 'MEN0016', 'admin', '2019-05-30', NULL, NULL, 1),
(127, 'ROL002', 'MEN0017', 'admin', '2019-05-30', NULL, NULL, 1),
(128, 'ROL002', 'MEN0018', 'admin', '2019-05-30', NULL, NULL, 1),
(129, 'ROL002', 'MEN0019', 'admin', '2019-05-30', NULL, NULL, 1),
(130, 'ROL002', 'MEN0020', 'admin', '2019-05-30', NULL, NULL, 1),
(131, 'ROL002', 'MEN0021', 'admin', '2019-05-30', NULL, NULL, 1),
(132, 'ROL002', 'MEN0022', 'admin', '2019-05-30', NULL, NULL, 1),
(133, 'ROL002', 'MEN0023', 'admin', '2019-05-30', NULL, NULL, 1),
(134, 'ROL002', 'MEN0024', 'admin', '2019-05-30', NULL, NULL, 1),
(135, 'ROL002', 'MEN0025', 'admin', '2019-05-30', NULL, NULL, 1),
(136, 'ROL002', 'MEN0026', 'admin', '2019-05-30', NULL, NULL, 1),
(137, 'ROL002', 'MEN0027', 'admin', '2019-05-30', NULL, NULL, 1),
(138, 'ROL002', 'MEN0028', 'admin', '2019-05-30', NULL, NULL, 1),
(139, 'ROL002', 'MEN0029', 'admin', '2019-05-30', NULL, NULL, 1),
(140, 'ROL003', 'MEN001', 'fadmin', '2019-06-07', NULL, NULL, 0),
(141, 'ROL003', 'MEN002', 'fadmin', '2019-06-07', NULL, NULL, 0),
(142, 'ROL003', 'MEN003', 'fadmin', '2019-06-07', NULL, NULL, 0),
(143, 'ROL003', 'MEN004', 'fadmin', '2019-06-07', NULL, NULL, 0),
(144, 'ROL003', 'MEN005', 'fadmin', '2019-06-07', NULL, NULL, 0),
(145, 'ROL003', 'MEN006', 'fadmin', '2019-06-07', NULL, NULL, 0),
(146, 'ROL003', 'MEN007', 'fadmin', '2019-06-07', NULL, NULL, 0),
(147, 'ROL003', 'MEN008', 'fadmin', '2019-06-07', NULL, NULL, 0),
(148, 'ROL003', 'MEN009', 'fadmin', '2019-06-07', NULL, NULL, 0),
(149, 'ROL003', 'MEN0010', 'fadmin', '2019-06-07', NULL, NULL, 0),
(150, 'ROL003', 'MEN0011', 'fadmin', '2019-06-07', NULL, NULL, 0),
(151, 'ROL003', 'MEN0012', 'fadmin', '2019-06-07', NULL, NULL, 0),
(152, 'ROL003', 'MEN0013', 'fadmin', '2019-06-07', NULL, NULL, 0),
(153, 'ROL003', 'MEN0014', 'fadmin', '2019-06-07', NULL, NULL, 0),
(154, 'ROL003', 'MEN0015', 'fadmin', '2019-06-07', NULL, NULL, 0),
(155, 'ROL003', 'MEN0016', 'fadmin', '2019-06-07', NULL, NULL, 0),
(156, 'ROL003', 'MEN0017', 'fadmin', '2019-06-07', NULL, NULL, 0),
(157, 'ROL003', 'MEN0018', 'fadmin', '2019-06-07', NULL, NULL, 0),
(158, 'ROL003', 'MEN0019', 'fadmin', '2019-06-07', NULL, NULL, 0),
(159, 'ROL003', 'MEN0020', 'fadmin', '2019-06-07', NULL, NULL, 0),
(160, 'ROL003', 'MEN0021', 'fadmin', '2019-06-07', NULL, NULL, 0),
(161, 'ROL003', 'MEN0022', 'fadmin', '2019-06-07', NULL, NULL, 0),
(162, 'ROL003', 'MEN0023', 'fadmin', '2019-06-07', NULL, NULL, 0),
(163, 'ROL003', 'MEN0024', 'fadmin', '2019-06-07', NULL, NULL, 0),
(164, 'ROL003', 'MEN0025', 'fadmin', '2019-06-07', NULL, NULL, 0),
(165, 'ROL003', 'MEN0026', 'fadmin', '2019-06-07', NULL, NULL, 0),
(166, 'ROL003', 'MEN0027', 'fadmin', '2019-06-07', NULL, NULL, 0),
(167, 'ROL003', 'MEN0028', 'fadmin', '2019-06-07', NULL, NULL, 0),
(168, 'ROL003', 'MEN0029', 'fadmin', '2019-06-07', NULL, NULL, 0),
(169, 'ROL003', 'MEN001', 'fadmin', '2019-06-07', NULL, NULL, 0),
(170, 'ROL003', 'MEN002', 'fadmin', '2019-06-07', NULL, NULL, 0),
(171, 'ROL003', 'MEN003', 'fadmin', '2019-06-07', NULL, NULL, 0),
(172, 'ROL003', 'MEN004', 'fadmin', '2019-06-07', NULL, NULL, 0),
(173, 'ROL003', 'MEN005', 'fadmin', '2019-06-07', NULL, NULL, 0),
(174, 'ROL003', 'MEN006', 'fadmin', '2019-06-07', NULL, NULL, 0),
(175, 'ROL003', 'MEN007', 'fadmin', '2019-06-07', NULL, NULL, 0),
(176, 'ROL003', 'MEN008', 'fadmin', '2019-06-07', NULL, NULL, 0),
(177, 'ROL003', 'MEN009', 'fadmin', '2019-06-07', NULL, NULL, 0),
(178, 'ROL003', 'MEN0010', 'fadmin', '2019-06-07', NULL, NULL, 0),
(179, 'ROL003', 'MEN0011', 'fadmin', '2019-06-07', NULL, NULL, 0),
(180, 'ROL003', 'MEN0012', 'fadmin', '2019-06-07', NULL, NULL, 0),
(181, 'ROL003', 'MEN0013', 'fadmin', '2019-06-07', NULL, NULL, 0),
(182, 'ROL003', 'MEN0014', 'fadmin', '2019-06-07', NULL, NULL, 0),
(183, 'ROL003', 'MEN0015', 'fadmin', '2019-06-07', NULL, NULL, 0),
(184, 'ROL003', 'MEN0016', 'fadmin', '2019-06-07', NULL, NULL, 0),
(185, 'ROL003', 'MEN0017', 'fadmin', '2019-06-07', NULL, NULL, 0),
(186, 'ROL003', 'MEN0018', 'fadmin', '2019-06-07', NULL, NULL, 0),
(187, 'ROL003', 'MEN0019', 'fadmin', '2019-06-07', NULL, NULL, 0),
(188, 'ROL003', 'MEN0020', 'fadmin', '2019-06-07', NULL, NULL, 0),
(189, 'ROL003', 'MEN0021', 'fadmin', '2019-06-07', NULL, NULL, 0),
(190, 'ROL003', 'MEN0022', 'fadmin', '2019-06-07', NULL, NULL, 0),
(191, 'ROL003', 'MEN0023', 'fadmin', '2019-06-07', NULL, NULL, 0),
(192, 'ROL003', 'MEN0024', 'fadmin', '2019-06-07', NULL, NULL, 0),
(193, 'ROL003', 'MEN0025', 'fadmin', '2019-06-07', NULL, NULL, 0),
(194, 'ROL003', 'MEN0026', 'fadmin', '2019-06-07', NULL, NULL, 0),
(195, 'ROL003', 'MEN0027', 'fadmin', '2019-06-07', NULL, NULL, 0),
(196, 'ROL003', 'MEN0028', 'fadmin', '2019-06-07', NULL, NULL, 0),
(197, 'ROL003', 'MEN0029', 'fadmin', '2019-06-07', NULL, NULL, 0),
(198, 'ROL001', 'MEN0030', 'admin', '2019-06-14', NULL, NULL, 1),
(199, 'ROL001', 'MEN0031', 'admin', '2019-06-14', NULL, NULL, 1),
(200, 'ROL002', 'MEN0030', 'admin', '2019-06-14', NULL, NULL, 1),
(201, 'ROL002', 'MEN0031', 'admin', '2019-06-14', NULL, NULL, 1),
(202, 'ROL001', 'MEN0032', 'admin', '2019-06-14', NULL, NULL, 1),
(203, 'ROL002', 'MEN0032', 'admin', '2019-06-14', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `f_user_credential`
--

CREATE TABLE IF NOT EXISTS `f_user_credential` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_date` date NOT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=active, 2=blocked, 0=inactive',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `f_user_credential`
--

INSERT INTO `f_user_credential` (`id`, `user_id`, `password`, `role`, `expiry_date`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ROL001', '2020-08-03', 'FADMIN', '2019-03-15', 'Recvory Page', '2019-04-03', 1),
(2, 'fadmin', '1b5f8a2a5d8ab37b7fbaa63f53200aa2d7c612c6', 'ROL002', NULL, 'admin', '2019-05-30', NULL, NULL, 1),
(3, 'freedom', '7ecfd8f97b4729c6ff0799b0b4d40f870083b461', 'ROL003', NULL, 'fadmin', '2019-06-07', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `f_user_detail`
--

CREATE TABLE IF NOT EXISTS `f_user_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL,
  `branch_id` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `post` varchar(20) DEFAULT NULL,
  `district` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `email` varchar(200) NOT NULL DEFAULT '',
  `contact` varchar(30) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `user_img` varchar(200) DEFAULT '../../images/user/user.png',
  `c_by` varchar(20) DEFAULT NULL,
  `c_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_by` varchar(20) DEFAULT NULL,
  `u_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `f_user_detail`
--

INSERT INTO `f_user_detail` (`id`, `user_id`, `name`, `branch_id`, `address`, `post`, `district`, `state`, `country`, `email`, `contact`, `designation`, `user_img`, `c_by`, `c_date`, `u_by`, `u_date`) VALUES
(1, 'admin', 'Kashi India Developers LTD.', 'BRC001', 'Kachhawa Road Varanasi', 'Mirzamurad', 'Varanasi', 'Uttar Pradesh', 'India', 'kashiindiadevelopers@gmail.com', '9935819925', 'ROL', '../../images/user/user.png', NULL, '2019-03-15 01:41:26', NULL, NULL),
(2, 'fadmin', 'fadmin', 'BRC002', 'byaspur', 'nigatpur', 'varanasi', 'uttar pradesh', 'india', 'fadmin@gmail.com', '467546576', 'role', '../../images/user/user.png', 'admin', '2019-05-30 09:26:33', NULL, NULL),
(3, 'freedom', 'freedom', 'BRC002', 'MIRZAMURAD', 'MIRZAMURAD ', 'VARANASI', 'UTTAR PRADESH ', 'INDIA', 'freedom@gmail.com', '3465763453', 'freedom', '../../images/user/user.png', 'fadmin', '2019-06-07 05:49:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `f_user_role`
--

CREATE TABLE IF NOT EXISTS `f_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(20) NOT NULL,
  `role_name` varchar(20) NOT NULL,
  `role_description` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_by` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `f_user_role`
--

INSERT INTO `f_user_role` (`id`, `role_id`, `role_name`, `role_description`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, 'ROL001', 'ADMIN', 'ADMIN', 1, 'admin', '2019-03-15 11:55:55', 'admin', '2019-03-05'),
(2, 'ROL002', 'FADMIN', '', 1, 'admin', '2019-05-30 09:23:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `opening_closing_amount`
--

CREATE TABLE IF NOT EXISTS `opening_closing_amount` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `opening_total_amount` float NOT NULL DEFAULT '0',
  `closing_total_amount` float NOT NULL DEFAULT '0',
  `branch_id` varchar(20) NOT NULL,
  `c_by` varchar(100) DEFAULT NULL,
  `date` varchar(20) NOT NULL,
  `rd_amount` float DEFAULT '0',
  `fd_amount` float DEFAULT '0',
  `in_mis` float DEFAULT '0',
  `out_mis` float DEFAULT '0',
  `maturity_return_amount` float NOT NULL DEFAULT '0',
  `expense` float NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `opening_closing_amount`
--

INSERT INTO `opening_closing_amount` (`id`, `opening_total_amount`, `closing_total_amount`, `branch_id`, `c_by`, `date`, `rd_amount`, `fd_amount`, `in_mis`, `out_mis`, `maturity_return_amount`, `expense`, `status`) VALUES
(1, 0, 0, 'BRC001', 'admin', '2019-06-24', 0, 0, 0, 0, 0, 0, 1),
(2, 0, -2000, 'BRC001', 'admin', '2019-06-24', 0, 0, 0, 2000, 0, 0, 1),
(3, -2000, -2000, 'BRC001', 'admin', '2019-06-24', 0, 0, 0, 2000, 0, 0, 1),
(4, -2000, 0, 'BRC001', 'admin', '2019-06-25', 0, 0, 0, 0, 0, 0, 1),
(5, 0, 0, 'BRC001', 'admin', '2019-06-25', 0, 0, 0, 0, 0, 0, 1),
(6, 0, 0, 'BRC001', 'admin', '2019-07-08', 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(20) NOT NULL DEFAULT '250',
  `duration_month` varchar(200) NOT NULL,
  `commission_in_per` varchar(250) NOT NULL COMMENT 'agent_commission',
  `plan_type` varchar(200) NOT NULL,
  `interest_rate_in_per` varchar(20) NOT NULL COMMENT 'customer_commission_in_per_for_total_installment_amount',
  `branch_id` varchar(100) NOT NULL,
  `c_date` varchar(20) NOT NULL DEFAULT '250',
  `c_by` varchar(250) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '1=active, 0=Inactive',
  `calculation_rate` int(10) DEFAULT NULL,
  PRIMARY KEY (`plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `plan_name`, `duration_month`, `commission_in_per`, `plan_type`, `interest_rate_in_per`, `branch_id`, `c_date`, `c_by`, `status`, `calculation_rate`) VALUES
(1, 'Profit Plus 101', '60', '5', 'RD', '10', 'BRC001', '2019-03-16', 'admin', 1, NULL),
(2, 'surchha plash', '84', '10', 'FD', '12', 'BRC001', '2019-03-17', 'admin', 0, NULL),
(3, 'surchha plus  1101', '84', '10', 'FD', '12', 'BRC001', '2019-03-17', 'admin', 1, NULL),
(4, 'Money Plus', '24', '5', 'MIS', '12', 'BRC001', '2019-03-25', 'admin', 1, 1),
(5, 'Profit Plus 105', '12', '5', 'RD', '15', 'BRC001', '2019-03-30', 'admin', 1, NULL),
(6, 'Dhanlakchhmi', '216', '5', 'RD', '10', 'BRC001', '2019-04-10', 'admin', 1, NULL),
(7, 'Dhanlakchhami 1', '216', '5', 'RD', '10', 'BRC001', '2019-04-10', 'admin', 0, NULL),
(8, 'Profit Plus 103', '36', '5', 'RD', '12', 'BRC001', '2019-05-14', 'admin', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reset_pass_links`
--

CREATE TABLE IF NOT EXISTS `reset_pass_links` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `link` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
