-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2015 at 04:14 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sapient_imp`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Technician', 5, NULL),
('theCreator', 2, 1426969380);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Accounts', 1, 'Accounts can create invoices and billiongs from tickets', NULL, NULL, 1427246611, 1427246611),
('IMP Admin', 1, 'IMP Admin can modify settings in the Application', NULL, NULL, 1427246611, 1427246611),
('Technician', 1, 'Technician can look at and modify tickets, add purchases and other items to a ticket', NULL, NULL, 1427246611, 1427246611),
('theCreator', 1, 'You!', NULL, NULL, 1426969342, 1426969342),
('useAccounts', 2, 'Allows Users to interact with the Accounts Subsystem', NULL, NULL, 1427246610, 1427246610),
('useAdmin', 2, 'Allows Users to interact with the Admin Subsystem', NULL, NULL, 1427246610, 1427246610),
('useTickets', 2, 'Allows Users to interact with the Ticket Subsystem', NULL, NULL, 1427246610, 1427246610);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Accounts', 'useAccounts'),
('IMP Admin', 'useAccounts'),
('theCreator', 'useAccounts'),
('IMP Admin', 'useAdmin'),
('theCreator', 'useAdmin'),
('Accounts', 'useTickets'),
('IMP Admin', 'useTickets'),
('Technician', 'useTickets'),
('theCreator', 'useTickets');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 'O:25:"app\\rbac\\rules\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1426969341;s:9:"updatedAt";i:1426969341;}', 1426969341, 1426969341);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `city` varchar(500) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `postcode` int(4) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `ABN` varchar(50) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `defaultBillingRate` int(11) NOT NULL,
  `defaultBillingType` int(11) NOT NULL,
  `accountBillTo` int(5) DEFAULT NULL,
  `FK1` int(30) DEFAULT NULL,
  `FK2` int(30) DEFAULT NULL,
  `FK3` int(30) DEFAULT NULL,
  `FK4` int(30) DEFAULT NULL,
  `FK5` int(30) DEFAULT NULL,
  `labtech` tinyint(1) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `sync_status` int(5) NOT NULL,
  `contact_billing` int(5) DEFAULT NULL,
  `contact_authorized` int(5) DEFAULT NULL,
  `contact_owner` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `address`, `city`, `state`, `postcode`, `phone1`, `phone2`, `ABN`, `notes`, `defaultBillingRate`, `defaultBillingType`, `accountBillTo`, `FK1`, `FK2`, `FK3`, `FK4`, `FK5`, `labtech`, `last_change`, `sync_status`, `contact_billing`, `contact_authorized`, `contact_owner`) VALUES
(1, '.Sapient Technology Solutions', 'Suite 3, 1501 Malvern Road', 'Glen Iris', 'Vic', 3146, '03 9824 8042', '', NULL, '', 1, 1, NULL, 1, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(2, 'Irwin Stock Feeds', '1 Laurens Street', 'North Melbourne', 'Victoria', 3051, '03 93282681', '', NULL, 'OWA URL: https://red003.mail.apac.microsoftonline.com/owa\r\n\r\nExchange Server: SG1RD3XVS361.red003.local\r\nProxy: red003.mail.apac.microsoftonline.com\r\n	- Connect using SSL only\r\n		- msstd:*.mail.apac.microsoftonline.com\r\n	- on fast networks,\r\n	- on slow networks\r\nNTLM Authentication\r\n\r\nUsername - Admin@irwinstockfeeds.apac.microsoftonline.com\r\nOLD Password - Cczm77051\r\nNEW Password - K@pp@1976\r\nURL - https://admin.microsoftonline.com/login.aspx\r\n\r\n', 1, 1, NULL, 2, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(3, 'Aaron Laboratories', '', '', '', NULL, '(03) 9706 7673', '', NULL, 'payables@aaronlab.com.au', 1, 1, NULL, 3, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(4, 'Mode Design Corp', 'Level 1 / 292 Church Street', 'Richmond', 'Vic', 3121, '03 9428 8807', '', NULL, '', 1, 1, NULL, 4, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(5, 'Jilted Developments Pty Ltd', '10 Sherwood Street Richmond', 'Richmond', '', NULL, '0414339611', '', NULL, '', 1, 1, NULL, 5, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(6, 'Deaf Children Australia', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 6, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(7, 'LBA Joinery', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 7, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(8, 'Plexus', '1/149 Northern Rd', 'Heidelberg Height', 'VIC', 3081, '94862500', '', NULL, '1/149 Northern Rd \r\nHeidelberg Heights VIC 3081\r\n', 1, 1, NULL, 8, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(9, 'Edgard Pirrotta', '', '', '', NULL, '03 9419 8099', '', NULL, '', 1, 1, NULL, 9, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(10, 'Hansen Consulting', '', '', '', NULL, '9348 0934', '', NULL, '', 1, 1, NULL, 10, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(11, 'Eastbourne Trading (French Oak Floors)', '03 9533 6206', 'St Kilda', 'VIC', 3182, '03 9533 6206', '', NULL, '', 1, 1, NULL, 11, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(12, 'Ripponlea Primary', '', '', '', NULL, '03 9527 5728', '', NULL, '', 1, 1, NULL, 12, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(13, 'Caulfield Junior College', '', '', '', NULL, '', '', NULL, 'Contact Rachelle Meuse, Cat or Debbie', 1, 1, NULL, 13, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(14, 'Aaron Financial Services', 'Suite 304', 'Melbourne', 'Vic', 3004, '(03) 9867 5596', '(03) 9867 5474', NULL, '', 1, 1, NULL, 14, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(15, 'Bicycle Super Store', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 15, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(16, 'Eureka Tower', '7 Riverside Quay, South Bank', '', '', NULL, '03 9685 0114', '03 9696 7559', NULL, 'Loading dock number: 9685 0116', 1, 1, NULL, 16, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(17, 'Lash Out Lashes', 'Suite 2, 935 station St', 'Box Hill North', 'Vic', NULL, '', '', NULL, '', 1, 1, NULL, 17, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(18, 'Total Aluminium Fabricators Pty Ltd', 'Suite 1A, 391 Settlement Road', 'Thomastown', 'Vicq', 3074, '03 9465 8939', '', NULL, '', 1, 1, NULL, 18, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(19, 'Home Users', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 19, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(20, 'Gerra Pty Ltd', '', '', '', NULL, '', '', NULL, 'ABN: 53 004 855 127', 1, 1, NULL, 20, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(21, 'Max Power Electrical', '17 Haleys Gully Rd,', 'Hurstbridge', 'Vic', NULL, '0439 645 232', '', NULL, '', 1, 1, NULL, 22, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(22, 'Bogong Management Services', '145 Miller St', 'Thornbury', 'Vic', 3071, '03 9416 7422', '', NULL, '', 1, 1, NULL, 23, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(23, 'Focussed Books', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 24, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(24, 'Gascon Systems Pty Ltd', '24 Ford Crescent', 'Thornbury', 'Victoria', 3071, '61-3-9499 4100', '61-3-9499 4111', NULL, 'ABN: 74 716 626 338', 1, 1, NULL, 25, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(25, 'Phillips & Wilkins', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 26, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(26, 'Oscar Hospitality', '405 High Street', 'Ashburton', 'Victoria', 3147, '(03) 9560 1844', '', NULL, '', 1, 1, NULL, 27, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(27, 'Red Alligator', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 28, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(28, 'The Loan Operator', '133 Mitchel St,', 'Northcote', 'vic', NULL, '', '', NULL, '', 1, 1, NULL, 29, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(29, 'Interactive Whiteboards Australia', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 30, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(30, 'Oscar 3CP', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 31, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(31, 'MRM Design PL', '21 Laity Street', 'Richmond', 'vic', 3121, '9421 3332', '', NULL, '', 1, 1, NULL, 32, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(32, 'Mill Park Community House', '68 Mill Park Dr', 'Mill Park', 'VIC', 3082, '(03) 9404 4565', '', NULL, '', 1, 1, NULL, 33, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:04', 0, NULL, NULL, NULL),
(33, 'A.L.D. Linen Services', '45 Jesica Rd', 'Campbellfield', '', 3061, '03 9357 7400', '9357 7973', NULL, '', 1, 1, NULL, 34, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(34, 'Victoria Point Towers', '100-120 Harbour Esplanade', '', '', NULL, '0433451174', '', NULL, '', 1, 1, NULL, 35, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(35, 'Eastbourne Trading', 'Rear, 24 Wellington Street', 'St Kilda', 'VIC', 3182, '03 9533 6206', '', NULL, '', 1, 1, NULL, 36, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(36, 'Minemet', 'Suite 6', 'South Yarra', 'Victoria', 3141, '9826 8745', '', NULL, '', 1, 1, NULL, 37, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(37, 'Advice for Living', '', '', '', NULL, '03 8370 5307', '03 8692 1083', NULL, '', 1, 1, NULL, 38, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(38, 'Real Estate Real Easy', '', '', '', NULL, '0411 515 505', '', NULL, '', 1, 1, NULL, 39, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(39, 'Re-Med', '', '', '', NULL, '(03) 9431 0331', '', NULL, 'Room 1 - (LHS as you walk in) PC = ROOM3', 1, 1, NULL, 40, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(40, 'Integrity Cleaning Services', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 41, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(41, 'Supply Change', '', '', '', NULL, '', '', NULL, 'ABN 18 248 976 458', 1, 1, NULL, 42, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(42, 'Kiara International', '2 Coopers Lane', 'Kensington', 'Vic', NULL, '0432 260 305', '', NULL, 'ABN: 18 930 363 406', 1, 1, NULL, 43, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(43, 'Joel Buncle Video Productions', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 44, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(44, 'Roartastic Shelving', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 45, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(45, 'Veracity Media', 'Suite 6/752 Blackburn Road', 'Clayton', 'Vic', 3178, '03 9544 8884', '', NULL, '', 1, 1, NULL, 46, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(46, 'Jane Sloan', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 47, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(47, 'Celebrate Cleaning', '', '', '', NULL, '0417 964 092', '', NULL, 'ABN - 16178979144', 1, 1, NULL, 48, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(48, 'HR Gurus', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 49, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(49, 'High Performance Consulting', '', '', '', NULL, '(03) 9832-0816', '', NULL, '', 1, 1, NULL, 50, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(50, 'David Saunders Plumbing', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 51, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(51, 'Rosanna Chiropractic Health Centre', '40 Waiora Rd', 'Rosanna', 'VIC', 3084, '(03) 9457-5585', '', NULL, '', 1, 1, NULL, 52, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(52, 'More Profit Less Time', '3 / 333 Wantirna Road', 'Wantirna', 'VIC', 3152, '0411 755 153', '', NULL, 'More Profit Less Time \r\n3 / 333 Wantirna Road \r\nWantirna, VIC 3152 \r\nTelephone: 0411 755 153\r\n', 1, 1, NULL, 53, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(53, 'Visual Pro', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 54, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(54, 'Peter Worcester', '1/31 Marne St, South Yarra', '', '', NULL, '0414303322', '', NULL, 'dob 7 april 1954', 1, 1, NULL, 55, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(55, 'Photo Direct', '4/109 Whitehorse Road', 'Blackburn', 'Vic', 3130, '98941644', '', NULL, '1300 364 817', 1, 1, NULL, 56, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(56, 'Chapman Plumbing', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 57, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(57, 'Adaptive Security', '1903/594 St Kilda RD', 'Mlebourne', 'Vic', 3004, '', '', NULL, '', 1, 1, NULL, 58, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(58, 'John Mc Sweeney', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 59, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(59, 'Galwin Pty Ltd', '', '', '', NULL, '9943 3858', '', NULL, '', 1, 1, NULL, 60, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(60, 'Designed Consigned', '', '', '', NULL, '', '', NULL, 'ABN - 85167490608', 1, 1, NULL, 61, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(61, 'Sargeants - Craig', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 62, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(62, 'Motorcycle Events Group Australia', '15-17 Rodeo Drive', 'Dandenong', 'VIC', 3175, '1300 793 423', '', NULL, 'ABN 11077668323', 1, 1, NULL, 63, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(63, 'Synkd', '', '', '', NULL, '', '', NULL, 'ABN 31 925 561 752', 1, 1, NULL, 64, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(64, 'Reverse Skin Clinic', '21 Carters Avenue', 'Toorak', 'Vic', NULL, '9827 1414', '', NULL, 'Reverse Skin Clinic\r\n21 Carters Ave\r\nToorak, 3142\r\n \r\n9827 1414\r\n', 1, 1, NULL, 65, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(65, 'Medsurge Healthcare Pty Ltd', 'Unit 2', 'Mulgrave', 'Victoria', 3205, '1300788261', '', NULL, 'ABN 92 124 728 892\r\n\r\n+61 38414 8245', 1, 1, NULL, 66, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(66, 'Cervo Restaurant', 'The Riverside at Crown', '', '', NULL, '9292 7824', '', NULL, 'ABN : 11085208591', 1, 1, NULL, 67, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(67, 'Aussie Post Caps', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 68, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(68, 'Peter Treby', '10 Kirwana  Grove', 'Montmorency', 'Vic', NULL, '0419 361 428', '', NULL, '', 1, 1, NULL, 69, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(69, 'Richmond Creche and Kindergarten', '10-14 Abinger Street', 'Richmond', 'Victoria', 3121, '03 9428 2663', '', NULL, '', 1, 1, NULL, 70, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(70, 'Angel Faces', '', '', '', NULL, '0418380791', '', NULL, '', 1, 1, NULL, 71, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(71, 'Harley Plumbing', 'Unit 3B, 266 Bolton Street', 'Eltham', 'Victoria', 3095, '03 8609 9703', '', NULL, '', 1, 1, NULL, 72, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(72, 'Diamond Valley Appliance Service', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 73, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(73, 'Bicycle Parts Wholesale', '76-80 Micro Circuit', 'Dandenong', 'Vic', 9044, '03 9702 9044', '', NULL, '', 1, 1, NULL, 74, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(74, 'Fulham & Chelsea Building Services', '23 Connolly Ave', 'Coburg', 'Victoria', 3058, '03 9354 5250', '', NULL, '', 1, 1, NULL, 75, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(75, 'Kelly Woodward', '', '', '', NULL, '9717 0048', '', NULL, '', 1, 1, NULL, 76, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL),
(76, 'Corr Accounting and Tax', '', 'Croydon South', '', 3136, '', '', NULL, 'ABN: 72705120792', 1, 1, NULL, 77, NULL, NULL, NULL, NULL, 1, '2015-09-15 15:44:05', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_contact`
--

CREATE TABLE IF NOT EXISTS `client_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `phone1` varchar(100) DEFAULT NULL,
  `phone2` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Postcode` varchar(10) DEFAULT NULL,
  `State` int(10) DEFAULT NULL,
  `Notes` varchar(500) NOT NULL,
  `owner_contact` tinyint(1) NOT NULL DEFAULT '0',
  `accounts_contact` tinyint(1) NOT NULL DEFAULT '0',
  `authorized_contact` tinyint(1) DEFAULT '0',
  `FK1` int(10) NOT NULL,
  `last_change` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=377 ;

--
-- Dumping data for table `client_contact`
--

INSERT INTO `client_contact` (`id`, `firstname`, `surname`, `phone1`, `phone2`, `mobile`, `email`, `client_id`, `address`, `City`, `Postcode`, `State`, `Notes`, `owner_contact`, `accounts_contact`, `authorized_contact`, `FK1`, `last_change`) VALUES
(223, 'Shamus', 'Dougan', '03 9824 8042', '', '0468 645 334', 'shamus.dougan@sapient-tech.com.au', 1, 'Suite 3, 1501 Malvern Road', 'Glen Iris', '3146', 0, '', 0, 0, 0, 2, '2015-09-25 13:05:31'),
(224, 'Charles', 'Foletta', '03 984 8042', '', '0413 211 537', 'charles.foletta@sapient-tech.com.au', 1, 'Suite 3', 'Glen Iris', '3146', 0, '', 0, 0, 0, 3, '2015-09-25 13:05:31'),
(225, 'Bryan2', 'Irwin', '03 93282681', '', '', 'bryan@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 4, '2015-09-25 13:05:31'),
(226, 'Maria', 'Ensabella', '(03) 9706 7673', '', '(04) 0730-0286', 'maria@aaronlab.com.au', 3, '', '', '', NULL, '', 0, 0, 0, 5, '2015-09-25 13:05:31'),
(227, 'Madeleine', 'Pinnuck', '03 93282681', '', '0419 620 093', 'madeleine@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 6, '2015-09-25 13:05:31'),
(228, 'Jake', 'Frecklington', '03 93282681', '', '0409 566 078', 'jake@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 7, '2015-09-25 13:05:31'),
(229, 'Kristy', 'Evans', '03 93282681', '', '0417 500 344', 'kristyevans@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 8, '2015-09-25 13:05:31'),
(230, 'Pete', 'Lowry', '03 93282681', '', '0409 566 543', 'plowry@milburnbeef.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 9, '2015-09-25 13:05:31'),
(231, 'Donna', 'McAinch', '03 93282681', '', '0400 017 493', 'kristyevans@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 10, '2015-09-25 13:05:31'),
(232, 'Christine', 'Berry', '0407 771 086', '', '', 'christineberry16@gmail.com', 4, 'Level 1 / 292 Church Street', 'Richmond', '3121', 0, '', 0, 0, 0, 11, '2015-09-25 13:05:31'),
(233, 'David', 'Chioda', '+ 61 3 9539 5362', '+61 3 9539 5388', '0411139954', 'DavidC@deafchildren.org.au', 6, '597 St Kilda Road', 'Melbourne', '3004', 0, '', 0, 0, 0, 13, '2015-09-25 13:05:31'),
(234, 'Robin', 'Davies', '03 93282681', '', '', 'robindavies@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 15, '2015-09-25 13:05:31'),
(235, 'Andrew', 'Harris (Corner Stone Soltuions)', '03 93282681', '', '', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 16, '2015-09-25 13:05:31'),
(236, 'Ned', 'Cizmic', '03 9419 8099', '03 9419 8155', '', 'ncizmic@pirrotta.com.au', 9, '2c 68 Oxford St Collingwood', 'Collingwood', '3066', 0, '', 0, 0, 0, 17, '2015-09-25 13:05:31'),
(237, 'Greg', 'Kingston', '', '', '0408 556 652', 'gregkington@lbajoinery.com.au', 7, '', '', '', NULL, '', 0, 0, 0, 18, '2015-09-25 13:05:31'),
(238, 'Support', 'Account', '03 924 8042', '', '', 'support@sapient-tech.com.au', 1, 'Suite 3, 1501 Malvern Road', 'Preston', '3072', 0, '', 0, 0, 0, 19, '2015-09-25 13:05:31'),
(239, 'Roz', 'Hansen', '9348 0934', '', '(04) 1936-3437', 'rhansen@hansenconsulting.net.au', 10, '', '', '', NULL, '', 0, 0, 0, 20, '2015-09-25 13:05:31'),
(240, 'Sueanne', 'Newton', '', '', '', 'newton.susanne.j@edumail.vic.gov.au', 12, '', '', '', NULL, '', 0, 0, 0, 21, '2015-09-25 13:05:31'),
(241, 'Nicole', 'Morgan', '', '', '', 'morgan.nicole.m@edumail.vic.gov.au', 12, '', '', '', NULL, '', 0, 0, 0, 22, '2015-09-25 13:05:31'),
(242, 'Sonia', 'DiPinto', '', '', '', 'sonia.dipinto@pirrotta.com.au', 9, '', '', '', NULL, '', 0, 0, 0, 23, '2015-09-25 13:05:31'),
(243, 'Debra', 'Schmauder', '', '', '', 'schmauder.debra.p@edumail.vic.gov.au', 13, '', '', '', NULL, '', 0, 0, 0, 24, '2015-09-25 13:05:31'),
(244, 'rachelle', 'meuse', '', '', '', 'meuse.rachelle.r@edumail.vic.gov.au', 13, '', '', '', NULL, '', 0, 0, 0, 25, '2015-09-25 13:05:31'),
(245, 'catherine', 'wilson', '', '', '', 'wilson.catherine.l@edumail.vic.gov.au', 13, '', '', '', NULL, '', 0, 0, 0, 26, '2015-09-25 13:05:31'),
(246, 'Shamus', 'Dougan', '', '', '', 'shamus.dougan@sapient-tech.com.au', 9, '', '', '', NULL, '', 0, 0, 0, 27, '2015-09-25 13:05:31'),
(247, 'Front', 'Desk', 'local (03) 9867 5596', 'fax (03) 9867 5474', '', '', 14, 'Suite 304, 34 Queens Rd', 'St Kilda', '', 0, '', 0, 0, 0, 28, '2015-09-25 13:05:31'),
(248, 'Matt', 'Blight', '9685 0114', '', '', 'tonyleria@eurekatower.com.au', 16, '', '', '', NULL, '', 0, 0, 0, 29, '2015-09-25 13:05:31'),
(249, 'Dandenong', 'Store', '03 9794 6588', '03 9793 1764', '0413 840 520', 'dandenong@bicyclesuperstore.com.au', 15, '240 Princes Hwy (Dandenong Rd)', 'Dandenong', '3175', 0, '', 0, 0, 0, 30, '2015-09-25 13:05:31'),
(250, 'Trevor', 'Paul', '03 93282681', '', '0419 221 593', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 32, '2015-09-25 13:05:31'),
(251, 'Brad', 'Egan', '03 93282681', '', '', 'brad@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 33, '2015-09-25 13:05:31'),
(252, 'Joseph', 'Ensabella', '(03) 9706 7673', '', '0418179157', 'joseph@aaronlab.com.au', 3, '', '', '', NULL, '', 0, 0, 0, 34, '2015-09-25 13:05:31'),
(253, 'Tami', 'x', '0458 055 300', '', '', '', 17, 'Suite 2, 935 station St', 'Box Hill North', '', 0, '', 0, 0, 0, 35, '2015-09-25 13:05:31'),
(254, 'Mark', 'x', '03 9465 8939', '', '0412 816 770', '', 18, 'Suite 1A, 391 Settlement Road', 'Thomastown', '3074', 0, '', 0, 0, 0, 36, '2015-09-25 13:05:31'),
(255, 'Heath', 'Kileen', '03 93282681', '', '0400017493', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 37, '2015-09-25 13:05:31'),
(256, 'Rita', 'x', '9484 2250', '', '', 'rita@laurelgroup.com.au', 19, '', '', '', NULL, '', 0, 0, 0, 38, '2015-09-25 13:05:31'),
(257, 'Peter', 'Jones', '03 9685 0188', '03 9696 7559', '', 'pjones@eurekatower.com.au', 16, '7 Riverside Quay, South Bank', '', '', NULL, '', 0, 0, 0, 39, '2015-09-25 13:05:31'),
(258, 'Greig', 'Foletta', '98248017', '', '0428176583', '', 20, '', '', '', NULL, '', 0, 0, 0, 40, '2015-09-25 13:05:32'),
(259, 'Dr Suhas', 'Jatkar', '96964110', '96964113', '0411 111 054', 'cambrad@netspace.net.au', 19, '(Level 60) APT 6008', 'Southbank', '3006', 0, '', 0, 0, 0, 41, '2015-09-25 13:05:32'),
(260, 'James', 'Thomas', '03 9416 7422', '', '0412 353 384', 'james@bogong.net', 22, '145 Miller St', 'Thornbury', '3071', 0, '', 0, 0, 0, 42, '2015-09-25 13:05:32'),
(261, 'Ashley', 'Webhosting services', '03 9416 7422', '', '0410 977 819', '', 22, '145 Miller St', 'Thornbury', '3071', 0, '', 0, 0, 0, 43, '2015-09-25 13:05:32'),
(262, 'David', 'Brockfield', '9764 2233', '9764 2633', '0448 212 378', 'daivd@bicyclesuperstore.com.au', 15, 'Shop 4, 1488 Ferntree Gully Rd', 'Knoxfield', '3180', 0, '', 0, 0, 0, 44, '2015-09-25 13:05:32'),
(263, 'Ian', 'Gascon', '61-3-9499-4100', '61-3-9484 0368', '', 'sales@gascon.com.au', 24, 'Unit 11', 'Preston', '3072', 0, '', 0, 0, 0, 45, '2015-09-25 13:05:32'),
(264, 'Irwins NAS', 'Device', '03 93282681', '', '', 'do.not.reply@globalaccess.seagate.com', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 46, '2015-09-25 13:05:32'),
(265, 'Shane', 'Doherty', '03 93282681', '', '0417 500 344', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 47, '2015-09-25 13:05:32'),
(266, 'GASCON', 'NAS', '61-3-9499-4100', '61-3-9484 0368', '', 'nas@gascon.com.au', 24, 'Unit 11', 'Preston', '3072', 0, '', 0, 0, 0, 48, '2015-09-25 13:05:32'),
(267, 'concierge', 'Desk', '03 9685 0188', '', '', '', 16, '8 Cook St, South Bank', '', '', NULL, '', 0, 0, 0, 49, '2015-09-25 13:05:32'),
(268, 'Belinda', 'Adams', '(03) 9560 1844', '(03) 9885 2648', '0415 850 806', 'Belinda@oscarhospitality.com.au', 26, '', '', '', NULL, '', 0, 0, 0, 50, '2015-09-25 13:05:32'),
(269, 'Jason', 'Ellery', '', '', '0422309933', '', 26, '', '', '', NULL, '', 0, 0, 0, 51, '2015-09-25 13:05:32'),
(270, 'Kerry', 'Smith', '', '', '0458 650 715', '', 26, '', 'Perth', '', NULL, '', 0, 0, 0, 53, '2015-09-25 13:05:32'),
(271, 'Main', 'Office', '18100 134 442', '', '', 'accounts@auspres.com.au', 29, '', '', '', NULL, '', 0, 0, 0, 54, '2015-09-25 13:05:32'),
(272, 'Krystal', 'x', '03 9685 0115', '03 9696 7559', '', '', 16, '7 Riverside Quay, South Bank', '', '', NULL, '', 0, 0, 0, 55, '2015-09-25 13:05:32'),
(273, 'Albury', 'Store', '02 6025 4177', '', '', 'albury@bicyclesuperstore.com.au', 15, '316 Urana Road', 'Lavington', '2641', 0, '', 0, 0, 0, 58, '2015-09-25 13:05:32'),
(274, 'Head', 'Office', '(03) 8785 9049', '', '', '', 15, 'Shop 4, 1488 Ferntree Gully Rd', 'Knoxfield', '3180', 0, '', 0, 0, 0, 59, '2015-09-25 13:05:32'),
(275, 'Flemington', 'Store', '03 9376 8311', '', '', 'flemington@bicyclesuperstore.com.au', 15, '320 - 380 Epsom Rd', 'Flemington', '3031', 0, '', 0, 0, 0, 60, '2015-09-25 13:05:32'),
(276, 'Hoppers Crossing', 'Store', '03 8742 7022', '', '', 'HC@bicyclesuperstore.com.au', 15, '2/76 Old Geelong Road', 'Hoppers Crossing', '3029', 0, '', 0, 0, 0, 61, '2015-09-25 13:05:32'),
(277, 'Knox', 'Store', '03 9887 0073', '', '', 'knox@bicyclesuperstore.com.au', 15, '425 Burwood Highway', 'Wantirna South (Knox)', '3152', 0, '', 0, 0, 0, 62, '2015-09-25 13:05:32'),
(278, 'Mentone', 'Store', '03 9583 7700', '', '', 'mentone@bicyclesuperstore.com.au', 15, '30-32 Nepean Highway', 'Mentone', '3194', 0, '', 0, 0, 0, 63, '2015-09-25 13:05:32'),
(279, 'Mildura', 'Store', '03 5022 9350', '', '', 'mildura@bicyclesuperstore.com.au', 15, '116 Eighth Street', 'Mildura', '3500', 0, '', 0, 0, 0, 64, '2015-09-25 13:05:32'),
(280, 'Mornington', 'Store', '03 5975 7033', '', '', 'mornington@bicyclesuperstore.com.au', 15, '1/1002 Nepean Highway', 'Mornington', '3931', 0, '', 0, 0, 0, 65, '2015-09-25 13:05:32'),
(281, 'Nunawading', 'Store', '03 9894 4266', '', '', 'nunawading@bicyclesuperstore.com.au', 15, '315 Whitehorse Rd', 'Nunawading', '3131', 0, '', 0, 0, 0, 66, '2015-09-25 13:05:32'),
(282, 'Sunbury', 'Store', '03 8746 8500', '', '', 'sunbury@bicyclesuperstore.com.au', 15, 'Shop 3, 78-84 Horne St', 'Sunbury', '3429', 0, '', 0, 0, 0, 67, '2015-09-25 13:05:32'),
(283, 'Geelong', 'Store', '03 5229 2199', '', '', 'geelong@bicyclesuperstore.com.au', 15, '143 Malop St', 'Geelong', '3220', 0, '', 0, 0, 0, 68, '2015-09-25 13:05:32'),
(284, 'Danny', 'Ellem', '', '', '0438907233', '', 26, '', '', '', NULL, '', 0, 0, 0, 69, '2015-09-25 13:05:32'),
(285, 'Paul', 'Mentone', '', '', '0422 995 535', '', 15, '', '', '', NULL, '', 0, 0, 0, 70, '2015-09-25 13:05:32'),
(286, 'Belinda', 'Letty', '', '', '0417 349 056', '', 15, '', '', '', NULL, '', 0, 0, 0, 71, '2015-09-25 13:05:32'),
(287, 'Diane', 'Buettel', '', '', '0438 020 648', 'diane@oscarhospitality.com.au', 26, '', '', '', NULL, '', 0, 0, 0, 72, '2015-09-25 13:05:32'),
(288, 'mike', 'Morris', '9421 3332', '', '0448 136 390', 'mmorris@shimmco.com', 31, '21 Laity Street', 'Richmond', '3121', 0, '', 0, 0, 0, 73, '2015-09-25 13:05:32'),
(289, 'Christine', 'Berry', '9421 3332', '', '0448 136 168', 'cberry@shimmco.com', 31, '21 Laity Street', 'Richmond', '3121', 0, '', 0, 0, 0, 74, '2015-09-25 13:05:32'),
(290, 'Jan', 'Jones', '03 9867 3674', '', '(04) 0338-9988', '', 11, '', '', '', NULL, '', 0, 0, 0, 75, '2015-09-25 13:05:32'),
(291, 'Paul', 'Cambasis', '03 9533 6206', '', '0401 938 184', 'paul@eastbournetrading.com', 11, '', '', '', NULL, '', 0, 0, 0, 76, '2015-09-25 13:05:32'),
(292, 'Monica', 'x', '', '', '0418 360 571', 'monocar@live.com.au', 11, '', '', '', NULL, '', 0, 0, 0, 77, '2015-09-25 13:05:32'),
(293, 'Mark', 'Nichol', '03 9533 6206', '', '0451 030 163', 'mark@frenchoakfloors.com.au', 11, '', '', '', NULL, '', 0, 0, 0, 78, '2015-09-25 13:05:32'),
(294, 'Lynne', 'Harris', '(03) 9404 4565', '', '', 'admin@millparkcommunityhouse.com', 32, '68 Mill Park Dr', 'Mill Park', '3082', 0, '', 0, 0, 0, 79, '2015-09-25 13:05:32'),
(295, 'Hopppers', 'Crossing - Don', '', '', '', '0432 714 360', 15, '', '', '', NULL, '', 0, 0, 0, 80, '2015-09-25 13:05:32'),
(296, 'Don', '(Owner)', '', '', '0432 714 360', '', 15, '', '', '', NULL, '', 0, 0, 0, 81, '2015-09-25 13:05:32'),
(297, 'Tony', 'Lerserias - Building Manager', '0433451174', '', '', 'BuildingManager@victoriapointdocklands.com.au', 34, '100-120 Harbour Esplanade', '', '', NULL, '', 0, 0, 0, 82, '2015-09-25 13:05:32'),
(298, 'Jan', 'Jones', '03 9867 3674', '', '', '', 35, '', '', '', NULL, '', 0, 0, 0, 83, '2015-09-25 13:05:32'),
(299, 'Jennifer', 'Richards', '', '', '0412295553', '', 27, '', '', '', NULL, '', 0, 0, 0, 84, '2015-09-25 13:05:32'),
(300, 'Kim', 'Accounts', '', '', '0413006587', '', 33, '', '', '', NULL, '', 0, 0, 0, 85, '2015-09-25 13:05:32'),
(301, 'Patsy', 'ALD', '', '', '0410579297', '', 33, '', '', '', NULL, '', 0, 0, 0, 86, '2015-09-25 13:05:32'),
(302, 'Alfie', 'ALD', '', '', '0418 105 882', '', 33, '', '', '', NULL, '', 0, 0, 0, 87, '2015-09-25 13:05:32'),
(303, 'Rebbeca', 'Stilman', '0439 645 232', '', '', '', 21, '17 Haleys Gully Rd,', 'Hurstbridge', '', 0, '', 0, 0, 0, 88, '2015-09-25 13:05:32'),
(304, 'Hugh', 'McKee', '(03) 9826 8745', '', '0419 442 218', '', 36, '', '', '', NULL, '', 0, 0, 0, 90, '2015-09-25 13:05:33'),
(305, 'Adrian', 'Letty', '', '', '0413 134 551', 'adrian@bicyclesuperstore.com.au', 15, '', '', '', NULL, '', 0, 0, 0, 91, '2015-09-25 13:05:33'),
(306, 'Sandro', 'Meloni', '', '', '', 'sandro@redalligator.com.au', 27, '', '', '', NULL, '', 0, 0, 0, 92, '2015-09-25 13:05:33'),
(307, 'web/email Rowan', 'Peterson', '03 9894 6302', '', '0408 129 641', 'rowan@amphibian.com.au', 11, '', '', '', NULL, '', 0, 0, 0, 93, '2015-09-25 13:05:33'),
(308, 'Barbara', 'Di Pierro', '9913 7274', '', '0432 260 305', 'barbara.dipierro@kiara-international.com.au', 42, '2 Coopers Lane', 'Kensington', '', 0, '', 0, 0, 0, 94, '2015-09-25 13:05:33'),
(309, 'Ben', 'Drakely', '', '', '0401 474 437', '', 29, '', '', '', NULL, '', 0, 0, 0, 95, '2015-09-25 13:05:33'),
(310, 'Mark', 'Hopkinson', '03 9685 0114', '03 9696 7559', '0423 000 114', '', 16, '7 Riverside Quay, South Bank', '', '', NULL, '', 0, 0, 0, 97, '2015-09-25 13:05:33'),
(311, 'Jay', 'Web Hosting', '', '', '0433 178 837', '', 16, '7 Riverside Quay, South Bank', '', '', NULL, '', 0, 0, 0, 98, '2015-09-25 13:05:33'),
(312, 'Gerald', 'McDornan', '03 9544 8884', '', '0488 901 722', 'gerald@veracitymedia.com.au', 45, 'Suite 6/752 Blackburn Road', 'Clayton', '3178', 0, '', 0, 0, 0, 99, '2015-09-25 13:05:33'),
(313, 'Richard', 'Oversen', '', '', '0404004548', '', 15, '', '', '', NULL, '', 0, 0, 0, 100, '2015-09-25 13:05:33'),
(314, 'Bill', 'Wallace', '03 5997 5561', '', '0417 331 161', '', 2, '1 Laurens Street', 'Lang Lang', '3051', 0, '', 0, 0, 0, 101, '2015-09-25 13:05:33'),
(315, 'Pauline', 'Walker', '', '', '0417 964 092', '', 47, '', '', '', NULL, '', 0, 0, 0, 102, '2015-09-25 13:05:33'),
(316, 'Fountaingate', 'Store', '03 8790 5500', '', '', '', 15, '1004/352 PRINCES HWY', 'NARRE WARREN', '3805', 0, '', 0, 0, 0, 103, '2015-09-25 13:05:33'),
(317, 'Microchannel', 'RMS support', '1300 440 444', '', '', '', 15, '', '', '', NULL, '', 0, 0, 0, 104, '2015-09-25 13:05:33'),
(318, 'FrontDesk', 'Support', '1800 181 820', '', '', '', 39, '', '', '', NULL, '', 0, 0, 0, 105, '2015-09-25 13:05:33'),
(319, 'Keoni', 'Moore', '(03) 9431 0331', '', '(04) 3460-3755', '', 39, '', '', '', NULL, '', 0, 0, 0, 107, '2015-09-25 13:05:33'),
(320, 'Nicholas', 'Tang', '(03) 9832-0816', '', '0411 180 828', 'nicholas@highperformanceconsulting.com.au', 49, '', '', '', NULL, '', 0, 0, 0, 108, '2015-09-25 13:05:33'),
(321, 'Orlando', 'scalzi', '8788 7617', '', '', '', 3, '', '', '', NULL, '', 0, 0, 0, 109, '2015-09-25 13:05:33'),
(322, 'Margaret', 'Brigandi', '9331 4334', '', '0419 314 334', '', 40, '', '', '', NULL, '', 0, 0, 0, 110, '2015-09-25 13:05:33'),
(323, 'Justin', 'd (mornington)', '', '', '0419 345 112', 'justind@gp.com.au', 15, '', '', '', NULL, '', 0, 0, 0, 111, '2015-09-25 13:05:33'),
(324, 'David', 'Witchell', '+61411015789', '', '', 'dwitchell@optusnet.com.au', 19, '49 Erskin Road', 'Macleod', '', NULL, '', 0, 0, 0, 112, '2015-09-25 13:05:33'),
(325, 'Sarah', 'Gibbins', '', '', '0408 507 355', '', 48, '', '', '', NULL, '', 0, 0, 0, 113, '2015-09-25 13:05:33'),
(326, 'Emily', 'Jaksch', '', '', '0410 457 325', '', 48, '', '', '', NULL, '', 0, 0, 0, 114, '2015-09-25 13:05:33'),
(327, 'Kirsty', 'McMenaman', '(03) 94350604', '', '0437 193 774', '', 48, '', '', '', NULL, '', 0, 0, 0, 115, '2015-09-25 13:05:33'),
(328, 'Mike', 'Hayworth', '(03) 9457-5585', '', '0421392708', 'backdoc94@hotmail.com', 51, '40 Waiora Rd', 'Rosanna', '3084', 0, '', 0, 0, 0, 116, '2015-09-25 13:05:34'),
(329, 'David', 'Saunders', '', '', '', 'david@davidsaundersplumbing.com.au', 50, '', '', '', NULL, '', 0, 0, 0, 117, '2015-09-25 13:05:34'),
(330, 'John', 'Miller', '0411 755 153', '', '', 'john@moreprofitlesstime.com', 52, '3 / 333 Wantirna Road', 'Wantirna', '3152', 0, '', 0, 0, 0, 118, '2015-09-25 13:05:34'),
(331, 'Peter', 'Worcester', '0414303322', '', '', 'peter@worcester.com.au', 54, '1/31 Marne St, South Yarra', '', '', NULL, '', 0, 0, 0, 119, '2015-09-25 13:05:34'),
(332, 'Julie', 'Rocco', '', '0409 853 160', '0417 559 490', '', 40, '', '', '', NULL, '', 0, 0, 0, 120, '2015-09-25 13:05:34'),
(333, 'Ivan', 'Orsolic', '9826 8745', '', '0437 773 437', '', 36, 'Suite 6', 'South Yarra', '3141', 0, '', 0, 0, 0, 121, '2015-09-25 13:05:34'),
(334, 'Steuart', 'Meers', '98941644', '', '0413 830 008', 'steuartm@photodirect.com.au', 55, '4/109 Whitehorse Road', 'Blackburn', '3130', 0, '', 0, 0, 0, 122, '2015-09-25 13:05:34'),
(335, 'Michael', 'McKeon', '9421 3332', '', '0434 950 750', '', 31, '21 Laity Street', 'Richmond', '3121', 0, '', 0, 0, 0, 123, '2015-09-25 13:05:34'),
(336, 'Lewis', 'Chapman', '', '', '0428 766 050', 'chapmanplumbinginfo@gmail.com', 56, 'Unit 1/12 stradbroke av, heidleberg', '', '3084', NULL, '', 0, 0, 0, 124, '2015-09-25 13:05:34'),
(337, 'Helen', 'Gilpin', '(03) 9560 1844', '', '0438 907 233', '', 26, '405 High Street', 'Ashburton', '3147', 0, '', 0, 0, 0, 125, '2015-09-25 13:05:34'),
(338, 'Lou', 'Bacher', '', '', '0451 132 210', '', 47, '1903/594 St Kilda RD', 'Mlebourne', '3004', 0, '', 0, 0, 0, 126, '2015-09-25 13:05:34'),
(339, 'Tom', 'Moylan', '', '', '0477 000 571', '', 57, '1903/594 St Kilda RD', 'Mlebourne', '3004', 0, '', 0, 0, 0, 127, '2015-09-25 13:05:34'),
(340, 'Rosie', 'Emery', '0418 114 383', '', '0418 114 383', '', 60, '9a Clifton Street', 'Richmond', '3121', 0, '', 0, 0, 0, 128, '2015-09-25 13:05:34'),
(341, 'Melissa', 'De Campo', '0419 316 135', '', '0419 316 135', '', 60, '', '', '', NULL, '', 0, 0, 0, 129, '2015-09-25 13:05:34'),
(342, 'Craig', 'Helmer', '', '', '0412 205 556', '', 61, '', '', '', NULL, '', 0, 0, 0, 130, '2015-09-25 13:05:34'),
(343, 'Barry', 'Goldenberg', '9943 3858', '', '0411 551 100', 'bgoldenberg@hotmail.com', 59, '', '', '', NULL, '', 0, 0, 0, 131, '2015-09-25 13:05:34'),
(344, 'Vanessa', 'Thomas', '', '', '0416 808 798', 'vanessa@synkd.com.au', 63, '', '', '', NULL, '', 0, 0, 0, 132, '2015-09-25 13:05:34'),
(345, 'Kam', 'Phulwani', '1300788261', '', '0432 779 775', 'kam@medsurge.com.au', 65, 'Unit 2', 'Mulgrave', '3170', 0, '', 0, 0, 0, 133, '2015-09-25 13:05:34'),
(346, 'Paul', 'Bailey', '1300 793 423', '', '0408699171', '', 62, '15-17 Rodeo Drive', 'Dandenong', '3175', 0, '', 0, 0, 0, 134, '2015-09-25 13:05:34'),
(347, 'Caroline', 'Tremayne', '', '', '0420237456', '', 35, '', '', '', NULL, '', 0, 0, 0, 135, '2015-09-25 13:05:34'),
(348, 'Michael', 'domain hosting', '', '', '0416 032 671', '', 66, 'The Riverside at Crown', '', '', NULL, '', 0, 0, 0, 136, '2015-09-25 13:05:34'),
(349, 'Adrian', 'Alexander', '', '', '0417 383 705', '', 66, 'The Riverside at Crown', '', '', NULL, '', 0, 0, 0, 137, '2015-09-25 13:05:34'),
(350, 'Callum', 'Donoghue', '', '', '0414 932 051', '', 67, '', '', '', NULL, '', 0, 0, 0, 138, '2015-09-25 13:05:34'),
(351, 'Matt', 'Collins', '', '', '0408 599 938', '', 67, '', '', '', NULL, '', 0, 0, 0, 139, '2015-09-25 13:05:34'),
(352, 'Peter', 'Treby', '0419 361 428', '', '', '', 68, '10 Kirwana  Grove', 'Montmorency', '', 0, '', 0, 0, 0, 140, '2015-09-25 13:05:34'),
(353, 'Laura', 'Carolan', '03 9445 0232', '', '', 'lauracarolan@richmondcreche.com.au', 69, '10-14 Abinger Street', 'Richmond', '3121', 0, '', 0, 0, 0, 141, '2015-09-25 13:05:34'),
(354, 'Nicole', 'O''Donnel', '03 9428 2663', '', '', 'nicoleodonnell@richmondcreche.com.au', 69, '10-14 Abinger Street', 'Richmond', '3121', 0, '', 0, 0, 0, 142, '2015-09-25 13:05:34'),
(355, 'Matt', 'PABX', '0414 326 002', '', '', '', 69, '', '', '3121', NULL, '', 0, 0, 0, 143, '2015-09-25 13:05:34'),
(356, 'Xavier', 'X', '98941644', '', '', 'xavier@worldnet.com.au', 55, '4/109 Whitehorse Road', 'Blackburn', '3130', 0, '', 0, 0, 0, 144, '2015-09-25 13:05:34'),
(357, 'Claudia', 'Bonifacio', '9826 8745', '', '0433 379 564', '', 36, 'Suite 6', 'South Yarra', '3141', 0, '', 0, 0, 0, 145, '2015-09-25 13:05:34'),
(358, 'Sapient', 'Backups', '03 9824 8042', '', '', '', 1, 'Suite 3, 1501 Malvern Road', 'Glen Iris', '3146', 0, '', 0, 0, 0, 146, '2015-09-25 13:05:34'),
(359, 'Server', 'Room', '9539 5340', '', '', '', 6, '', '', '', NULL, '', 0, 0, 0, 147, '2015-09-25 13:05:34'),
(360, 'Kris', 'Cerini', '', '', '0428 525 115', '', 15, '', '', '', NULL, '', 0, 0, 0, 148, '2015-09-25 13:05:34'),
(361, 'Ryan', 'Harley', '', '', '0408 135 385', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 149, '2015-09-25 13:05:34'),
(362, 'Katie', 'Harley', '', '', '0433 157 058', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 150, '2015-09-25 13:05:34'),
(363, 'Jane', 'Sloan', '', '', '', 'janesloan@netspace.net.au', 46, '', '', '', NULL, '', 0, 0, 0, 151, '2015-09-25 13:05:34'),
(364, 'Michael', 'Jones', '03 9533 6206', '', '(04) 0338-6386', '', 35, 'Rear, 24 Wellington Street', 'St Kilda', '3182', 0, '', 0, 0, 0, 152, '2015-09-25 13:05:34'),
(365, 'TEDS', 'Frankston', '(03) 9783 8160', '', '', '', 55, 'Shop 3&4, 54-58 Wells St', 'Frankston', '', 0, '', 0, 0, 0, 153, '2015-09-25 13:05:34'),
(366, 'Carol', 'Fraser', '039853 0311', '', '', 'carol@scanlancarroll.com.au', 72, '', '', '', NULL, '', 0, 0, 0, 154, '2015-09-25 13:05:34'),
(367, 'Meaghan', 'X', '9435 7127', '', '0447 550 796', '', 72, '', '', '', NULL, '', 0, 0, 0, 155, '2015-09-25 13:05:34'),
(368, 'Andrew', 'McEwin', '03 9702 9044', '', '0412 470 464', 'andrew@bicyclepartswholesale.com.au', 73, '76-80 Micro Circuit', 'Dandenong', '9044', 0, '', 0, 0, 0, 156, '2015-09-25 13:05:34'),
(369, 'Peter Worcester', 'Barwon Heads/Connewware address', '0414303322', '', '', 'peter@worcester.com.au', 54, '57  Fourth Loop', 'Conneware', '3227', NULL, '', 0, 0, 0, 157, '2015-09-25 13:05:34'),
(370, 'Justin', 'Seabrook', '03 9354 5250', '', '0400 190 184', 'fulham.chelsea@bigpond.com', 74, '23 Connolly Ave', 'Coburg', '3058', 0, '', 0, 0, 0, 158, '2015-09-25 13:05:34'),
(371, 'anthony', 'Mann', '', '', '0499 566 040', '', 2, '', '', '', NULL, '', 0, 0, 0, 159, '2015-09-25 13:05:34'),
(372, 'Elle', 'Lockey', '03 93282681', '', '0488 566 546', '', 2, '', '', '3051', 0, '', 0, 0, 0, 160, '2015-09-25 13:05:34'),
(373, 'Minemet', 'Server', '9826 8745', '', '', 'raid@minemet.com', 36, 'Suite 6', 'South Yarra', '3141', 0, '', 0, 0, 0, 161, '2015-09-25 13:05:34'),
(374, 'Glenn', 'Kernick', '', '', '0401 242 699', '', 15, '', '', '', NULL, '', 0, 0, 0, 162, '2015-09-25 13:05:34'),
(375, 'Carli', 'O''Reilly', '', '', '0409 424 596', 'corraccounting@bigpond.com', 76, '', 'Croydon South', '', NULL, '', 0, 0, 0, 163, '2015-09-25 13:05:34'),
(376, 'Kristy', 'Hansen', '', '', '0400645018', 'kristy@hrgurus.com.au', 48, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, '2015-09-25 16:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `lookup`
--

CREATE TABLE IF NOT EXISTS `lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lookup`
--

INSERT INTO `lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Database', 1, 'SyncEndPointType', 1),
(2, 'Webpage', 2, 'SyncEndPointType', 2),
(3, 'File', 3, 'SyncEndPointType', 3),
(6, 'Success', 1, 'SYNC_RESULT', 1),
(7, 'Error', 2, 'SYNC_RESULT', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1426969065),
('m141022_115823_create_user_table', 1426969071),
('m141022_115912_create_rbac_tables', 1426969073),
('m150104_153617_create_article_table', 1426969073);

-- --------------------------------------------------------

--
-- Table structure for table `syncrelationships`
--

CREATE TABLE IF NOT EXISTS `syncrelationships` (
  `index` int(11) NOT NULL AUTO_INCREMENT,
  `impModelName` varchar(200) NOT NULL,
  `endPointName` varchar(200) NOT NULL,
  `endPointType` int(5) NOT NULL,
  `endPointDBServer` varchar(200) DEFAULT NULL,
  `endPointDBName` varchar(200) DEFAULT NULL,
  `endPointDBTable` varchar(200) DEFAULT NULL,
  `endPointUser` varchar(200) DEFAULT NULL,
  `endPointPassword` varchar(200) DEFAULT NULL,
  `syncModelName` varchar(200) NOT NULL,
  `frequenyMin` int(11) NOT NULL DEFAULT '60',
  `lastSync` datetime DEFAULT NULL,
  `LastStatus` int(11) DEFAULT NULL,
  `LastStatusData` varchar(500) DEFAULT NULL,
  `endPointFilePath` varchar(200) DEFAULT NULL,
  `endPointBaseURL` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`index`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `syncrelationships`
--

INSERT INTO `syncrelationships` (`index`, `impModelName`, `endPointName`, `endPointType`, `endPointDBServer`, `endPointDBName`, `endPointDBTable`, `endPointUser`, `endPointPassword`, `syncModelName`, `frequenyMin`, `lastSync`, `LastStatus`, `LastStatusData`, `endPointFilePath`, `endPointBaseURL`) VALUES
(2, 'Client', 'Labtech', 1, 'localhost', 'labtech', 'clients', 'root', '', 'SyncLabtechClient', 15, '2015-09-15 15:44:06', 1, '', '', ''),
(3, 'ClientContact', 'Labtech', 1, 'localhost', 'labtech', 'contacts', 'root', '', 'SyncLabtechContact', 15, '2015-09-25 15:57:17', 1, '', '', ''),
(4, 'ClientContact', 'Phone Contact List', 3, '', '', '', '', '', 'SyncPhoneContacts', 360, '2015-09-25 16:14:10', 1, '', '\\\\sts-app-1\\wwwroot\\RemotePhonebook.xml', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `status`, `auth_key`, `password_reset_token`, `account_activation_token`, `created_at`, `updated_at`) VALUES
(2, 'stsadmin', 'shamus.dougan@sapient-tech.com.au', '$2y$13$EvP1mu/iRq6xqIp4oKaAoOgBaCnJUImEFdXwH39NK7CvKOiosvHtK', 10, 'BqH0sfhID-iGM37FxP_AUG8JV-ndRJFs', NULL, NULL, 1426969380, 1426969380),
(5, 'shamus', 'test@test.com', '$2y$13$a0JVb.KGIEintCd4Jo89zuSsG0gPXOGr8AaoTAFiCLYUkechkT9/a', 10, 'IUTHnAzXzyW5YOof6D-OwievOpQWP9nQ', NULL, NULL, 1427250473, 1427253473);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
