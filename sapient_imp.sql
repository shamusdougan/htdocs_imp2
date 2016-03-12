-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2016 at 06:26 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
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
  `updated_at` int(11) DEFAULT NULL
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
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
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
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 'O:25:"app\\rbac\\rules\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1426969341;s:9:"updatedAt";i:1426969341;}', 1426969341, 1426969341);

-- --------------------------------------------------------

--
-- Table structure for table `charge_rates`
--

CREATE TABLE IF NOT EXISTS `charge_rates` (
`id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `time_increment` int(10) NOT NULL,
  `abriev` varchar(5) DEFAULT NULL,
  `status` int(5) NOT NULL,
  `integration_1` varchar(10) DEFAULT NULL,
  `integration_2` varchar(10) DEFAULT NULL,
  `integration_3` varchar(10) DEFAULT NULL,
  `integration_4` varchar(10) DEFAULT NULL,
  `integration_5` varchar(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `charge_rates`
--

INSERT INTO `charge_rates` (`id`, `name`, `time_increment`, `abriev`, `status`, `integration_1`, `integration_2`, `integration_3`, `integration_4`, `integration_5`) VALUES
(1, 'Business Support - Business Hours', 15, 'BS-BH', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Business Support - After Hours', 30, 'BS-AH', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `charge_rates_amounts`
--

CREATE TABLE IF NOT EXISTS `charge_rates_amounts` (
`id` int(10) NOT NULL,
  `valid_from_date` date NOT NULL,
  `amount` float NOT NULL,
  `charge_rate_id` int(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `charge_rates_amounts`
--

INSERT INTO `charge_rates_amounts` (`id`, `valid_from_date`, `amount`, `charge_rate_id`) VALUES
(3, '2015-11-18', 95, 1),
(4, '2016-01-01', 109, 1),
(5, '2016-01-01', 159, 2);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
`id` int(11) NOT NULL,
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
  `contact_owner` int(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `address`, `city`, `state`, `postcode`, `phone1`, `phone2`, `ABN`, `notes`, `defaultBillingRate`, `defaultBillingType`, `accountBillTo`, `FK1`, `FK2`, `FK3`, `FK4`, `FK5`, `labtech`, `last_change`, `sync_status`, `contact_billing`, `contact_authorized`, `contact_owner`) VALUES
(90, 'Oscar Hospitality', 'Suite 2, Level 2, 295 Springvale Road', 'Glen Waverley', 'Victoria', 3150, '(03) 9560 1844', '(03) 9885 2648', NULL, '', 1, 1, NULL, 27, NULL, NULL, NULL, NULL, 1, '2016-03-06 09:35:19', 0, NULL, NULL, NULL),
(91, 'BDKG Pty Ltd', '', '', '', NULL, '9943 3858', '', NULL, '', 1, 1, NULL, 60, NULL, NULL, NULL, NULL, 1, '2016-03-06 09:34:24', 0, NULL, NULL, NULL),
(92, 'Kelly Woodward', '', '', '', NULL, '9717 0048', '', NULL, 'kellie_woodward@travel-associates.com.au', 1, 1, NULL, 76, NULL, NULL, NULL, NULL, 1, '2016-03-06 09:34:24', 0, NULL, NULL, NULL),
(93, 'Savi Loans Pty Ltd', '', '', '', NULL, '0411 393 049', '', NULL, 'Savi Loans Pty Ltd abn is 89 130 547 401\r\nSole Trader ABN 275 209 26973\r\nMortgage Broker crn 453786 \r\nM:  0411 393 049  F:  03 9459 4569    \r\nE:    nataliesavic@saviloans.com.au\r\nW:  www.saviloans.com.au\r\n\r\nof BLSSA Pty Ltd ACL 391237\r\n', 1, 1, NULL, 84, NULL, NULL, NULL, NULL, 1, '2016-03-06 09:34:24', 0, NULL, NULL, NULL),
(94, 'You Are Good Enough', '', '', '', NULL, '', '', NULL, 'ABN 51435650157', 1, 1, NULL, 86, NULL, NULL, NULL, NULL, 1, '2016-03-06 09:34:24', 0, NULL, NULL, NULL),
(95, 'GDMC', '', '', '', NULL, '', '', NULL, '', 1, 1, NULL, 87, NULL, NULL, NULL, NULL, 1, '2016-03-06 09:34:24', 0, NULL, NULL, NULL),
(96, 'Paul Broadfoot', 'Suite G6, Corporate One, 84 Hotham Street', 'Preston', 'VICTORIA', 3072, '0400 605 889', '', NULL, '', 1, 1, NULL, 88, NULL, NULL, NULL, NULL, 1, '2016-03-06 09:34:24', 0, NULL, NULL, NULL),
(98, 'test 1', 'dfasdfdfs', 'test', '', NULL, '', '', NULL, '', 1, 1, NULL, 89, NULL, NULL, NULL, NULL, 1, '2016-03-06 13:01:58', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_contact`
--

CREATE TABLE IF NOT EXISTS `client_contact` (
`id` int(11) NOT NULL,
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
  `last_change` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=411 ;

--
-- Dumping data for table `client_contact`
--

INSERT INTO `client_contact` (`id`, `firstname`, `surname`, `phone1`, `phone2`, `mobile`, `email`, `client_id`, `address`, `City`, `Postcode`, `State`, `Notes`, `owner_contact`, `accounts_contact`, `authorized_contact`, `FK1`, `last_change`) VALUES
(223, 'Shamus', 'Dougan', '03 9824 8042', '', '0468 645 334', 'shamus.dougan@sapient-tech.com.au', 1, 'Suite 3, 1501 Malvern Road', 'Glen Iris', '3146', 0, '', 0, 0, 0, 2, '2016-01-25 15:02:33'),
(224, 'Charles', 'Foletta', '03 984 8042', '', '0413 211 537', 'charles.foletta@sapient-tech.com.au', 1, 'Suite 3', 'Glen Iris', '3146', 0, '', 0, 0, 0, 3, '2016-01-25 15:02:33'),
(225, 'Bryan', 'Irwin', '03 93282681', '', '', 'bryan@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 4, '2016-01-25 15:02:33'),
(226, 'Maria', 'Ensabella', '(03) 9706 7673', '', '(04) 0730-0286', 'maria@aaronlab.com.au', 3, '', '', '', NULL, '', 0, 0, 0, 5, '2016-01-25 15:02:33'),
(227, 'Madeleine', 'Pinnuck', '03 93282681', '', '0419 620 093', 'madeleine@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 6, '2016-01-25 15:02:33'),
(228, 'Jake', 'Frecklington', '03 93282681', '', '0409 566 078', 'jake@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 7, '2016-01-25 15:02:33'),
(229, 'Kristy', 'Evans', '03 93282681', '', '0417 500 344', 'kristyevans@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 8, '2016-01-25 15:02:34'),
(230, 'Pete', 'Lowry', '03 93282681', '', '0409 566 543', 'plowry@milburnbeef.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 9, '2016-01-25 15:02:34'),
(231, 'Donna', 'McAinch', '03 93282681', '', '0400 017 493', 'kristyevans@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 10, '2016-01-25 15:02:34'),
(232, 'Christine', 'Berry', '', '', '0407 771 086', 'christineberry16@gmail.com', 4, 'Level 1 / 292 Church Street', 'Richmond', '3121', 0, '', 0, 0, 0, 11, '2016-01-25 15:02:34'),
(233, 'David', 'Chioda', '+ 61 3 9539 5362', '+61 3 9539 5388', '0411139954', 'DavidC@deafchildren.org.au', 6, '597 St Kilda Road', 'Melbourne', '3004', 0, '', 0, 0, 0, 13, '2016-01-25 15:02:34'),
(234, 'Robin', 'Davies', '03 93282681', '', '', 'robindavies@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 15, '2016-01-25 15:02:34'),
(235, 'Andrew', 'Harris (Corner Stone Soltuions)', '3 9434 7352', '', '', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 16, '2016-01-25 15:02:34'),
(236, 'Ned', 'Cizmic', '03 9419 8099', '03 9419 8155', '041122392', 'ncizmic@pirrotta.com.au', 9, '2c 68 Oxford St Collingwood', 'Collingwood', '3066', 0, '', 0, 0, 0, 17, '2016-01-25 15:02:34'),
(237, 'Greg', 'Kingston', '', '', '0408 556 652', 'gregkington@lbajoinery.com.au', 7, '', '', '', NULL, '', 0, 0, 0, 18, '2016-01-25 15:02:34'),
(238, 'Support', 'Account', '03 924 8042', '', '', 'support@sapient-tech.com.au', 1, 'Suite 3, 1501 Malvern Road', 'Preston', '3072', 0, '', 0, 0, 0, 19, '2016-01-25 15:02:34'),
(239, 'Roz', 'Hansen', '9348 0934', '', '(04) 1936-3437', 'rhansen@hansenconsulting.net.au', 10, '', '', '', NULL, '', 0, 0, 0, 20, '2016-01-25 15:02:34'),
(240, 'Sueanne', 'Newton', '', '', '', 'newton.susanne.j@edumail.vic.gov.au', 12, '', '', '', NULL, '', 0, 0, 0, 21, '2016-01-25 15:02:34'),
(241, 'Nicole', 'Morgan', '', '', '', 'morgan.nicole.m@edumail.vic.gov.au', 12, '', '', '', NULL, '', 0, 0, 0, 22, '2016-01-25 15:02:34'),
(242, 'Sonia', 'DiPinto', '', '', '', 'sonia.dipinto@pirrotta.com.au', 9, '', '', '', NULL, '', 0, 0, 0, 23, '2016-01-25 15:02:34'),
(243, 'Debra', 'Schmauder', '', '', '', 'schmauder.debra.p@edumail.vic.gov.au', 13, '', '', '', NULL, '', 0, 0, 0, 24, '2016-01-25 15:02:34'),
(244, 'rachelle', 'meuse', '', '', '', 'meuse.rachelle.r@edumail.vic.gov.au', 13, '', '', '', NULL, '', 0, 0, 0, 25, '2016-01-25 15:02:34'),
(245, 'catherine', 'wilson', '', '', '', 'wilson.catherine.l@edumail.vic.gov.au', 13, '', '', '', NULL, '', 0, 0, 0, 26, '2016-01-25 15:02:34'),
(246, 'Shamus', 'Dougan', '', '', '', 'shamus.dougan@sapient-tech.com.au', 9, '', '', '', NULL, '', 0, 0, 0, 27, '2016-01-25 15:02:34'),
(247, 'Front', 'Desk', 'local (03) 9867 5596', 'fax (03) 9867 5474', '', '', 14, 'Suite 304, 34 Queens Rd', 'St Kilda', '', 0, '', 0, 0, 0, 28, '2016-01-25 15:02:34'),
(248, 'Matt', 'Blight', '9685 0114', '', '', 'tonyleria@eurekatower.com.au', 16, '', '', '', NULL, '', 0, 0, 0, 29, '2016-01-25 15:02:34'),
(249, 'Dandenong', 'Store', '03 9794 6588', '03 9793 1764', '0413 840 520', 'dandenong@bicyclesuperstore.com.au', 15, '240 Princes Hwy (Dandenong Rd)', 'Dandenong', '3175', 0, '', 0, 0, 0, 30, '2016-01-25 15:02:34'),
(250, 'Trevor', 'Paul', '03 93282681', '', '0419 221 593', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 32, '2016-01-25 15:02:34'),
(251, 'Brad', 'Egan', '03 93282681', '', '', 'brad@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 33, '2016-01-25 15:02:34'),
(252, 'Joseph', 'Ensabella', '(03) 9706 7673', '', '0418179157', 'joseph@aaronlab.com.au', 3, '', '', '', NULL, '', 0, 0, 0, 34, '2016-01-25 15:02:34'),
(253, 'Tami', 'x', '0458 055 300', '', '', '', 17, 'Suite 2, 935 station St', 'Box Hill North', '', 0, '', 0, 0, 0, 35, '2016-01-25 15:02:34'),
(254, 'Mark', 'x', '03 9465 8939', '', '0412 816 770', 'totalaluminium@hotmail.com', 18, 'Suite 1A, 391 Settlement Road', 'Thomastown', '3074', 0, '', 0, 0, 0, 36, '2016-01-25 15:02:34'),
(255, 'Heath', 'Kileen', '03 93282681', '', '0400017493', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 37, '2016-01-25 15:02:34'),
(256, 'Rita', 'x', '9484 2250', '', '', 'rita@laurelgroup.com.au', 19, '', '', '', NULL, '', 0, 0, 0, 38, '2016-01-25 15:02:34'),
(257, 'Peter', 'Jones', '03 9685 0188', '03 9696 7559', '', 'pjones@eurekatower.com.au', 16, '7 Riverside Quay, South Bank', '', '', NULL, '', 0, 0, 0, 39, '2016-01-25 15:02:34'),
(258, 'Greig', 'Foletta', '98248017', '', '0428176583', '', 20, '', '', '', NULL, '', 0, 0, 0, 40, '2016-01-25 15:02:34'),
(259, 'Dr Suhas', 'Jatkar', '96964110', '96964113', '0411 111 054', 'cambrad@netspace.net.au', 19, '(Level 60) APT 6008', 'Southbank', '3006', 0, '', 0, 0, 0, 41, '2016-01-25 15:02:34'),
(260, 'James', 'Thomas', '03 9416 7422', '', '0412 353 384', 'james@bogong.net', 22, '145 Miller St', 'Thornbury', '3071', 0, '', 0, 0, 0, 42, '2016-01-25 15:02:34'),
(261, 'Ashley', 'Webhosting services', '03 9416 7422', '', '0410 977 819', '', 22, '145 Miller St', 'Thornbury', '3071', 0, '', 0, 0, 0, 43, '2016-01-25 15:02:34'),
(262, 'David', 'Brockfield', '9764 2233', '9764 2633', '0448 212 378', 'daivd@bicyclesuperstore.com.au', 15, 'Shop 4, 1488 Ferntree Gully Rd', 'Knoxfield', '3180', 0, '', 0, 0, 0, 44, '2016-01-25 15:02:34'),
(263, 'Ian', 'Gascon', '61-3-9499-4100', '61-3-9484 0368', '', 'sales@gascon.com.au', 24, 'Unit 11', 'Preston', '3072', 0, '', 0, 0, 0, 45, '2016-01-25 15:02:34'),
(264, 'Irwins NAS', 'Device', '03 93282681', '', '', 'do.not.reply@globalaccess.seagate.com', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 46, '2016-01-25 15:02:34'),
(265, 'Shane', 'Doherty', '03 93282681', '', '0417 500 344', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 47, '2016-01-25 15:02:34'),
(266, 'GASCON', 'NAS', '61-3-9499-4100', '61-3-9484 0368', '', 'nas@gascon.com.au', 24, 'Unit 11', 'Preston', '3072', 0, '', 0, 0, 0, 48, '2016-01-25 15:02:35'),
(267, 'concierge', 'Desk', '03 9685 0188', '', '', '', 16, '8 Cook St, South Bank', '', '', NULL, '', 0, 0, 0, 49, '2016-01-25 15:02:35'),
(268, 'Belinda', 'Adams', '(03) 9560 1844', '(03) 9885 2648', '0415 850 806', 'Belinda@oscarhospitality.com.au', 26, '', '', '', NULL, '', 0, 0, 0, 50, '2016-01-25 15:02:35'),
(269, 'Jason', 'Ellery', '', '', '0422309933', '', 26, '', '', '', NULL, '', 0, 0, 0, 51, '2016-01-25 15:02:35'),
(270, 'Kerry', 'Smith', '', '', '0458 650 715', '', 26, '', 'Perth', '', NULL, '', 0, 0, 0, 53, '2016-01-25 15:02:35'),
(271, 'Main', 'Office', '18100 134 442', '', '', 'accounts@auspres.com.au', 29, '', '', '', NULL, '', 0, 0, 0, 54, '2016-01-25 15:02:35'),
(272, 'Krystal', 'x', '03 9685 0115', '03 9696 7559', '', '', 16, '7 Riverside Quay, South Bank', '', '', NULL, '', 0, 0, 0, 55, '2016-01-25 15:02:35'),
(273, 'Albury', 'Store', '02 6025 4177', '', '', 'albury@bicyclesuperstore.com.au', 15, '316 Urana Road', 'Lavington', '2641', 0, '', 0, 0, 0, 58, '2016-01-25 15:02:35'),
(274, 'Head', 'Office', '(03) 8785 9049', '', '', '', 15, 'Shop 4, 1488 Ferntree Gully Rd', 'Knoxfield', '3180', 0, '', 0, 0, 0, 59, '2016-01-25 15:02:35'),
(275, 'Highpoint', 'Store', '03 9376 8311', '', '', 'highpoint@bicyclesuperstore.com.au', 15, 'L3,Shop 6312 Highpoint Shopping Centre, Aquatic Dr', 'Maribynong', '3032', 0, '', 0, 0, 0, 60, '2016-01-25 15:02:35'),
(276, 'Hoppers Crossing', 'Store', '03 8742 7022', '', '', 'HC@bicyclesuperstore.com.au', 15, '2/76 Old Geelong Road', 'Hoppers Crossing', '3029', 0, '', 0, 0, 0, 61, '2016-01-25 15:02:35'),
(277, 'Knox', 'Store', '03 9887 0073', '', '', 'knox@bicyclesuperstore.com.au', 15, '425 Burwood Highway', 'Wantirna South (Knox)', '3152', 0, '', 0, 0, 0, 62, '2016-01-25 15:02:35'),
(278, 'Mentone', 'Store', '03 9583 7700', '', '', 'mentone@bicyclesuperstore.com.au', 15, '30-32 Nepean Highway', 'Mentone', '3194', 0, '', 0, 0, 0, 63, '2016-01-25 15:02:35'),
(279, 'Mildura', 'Store', '03 5022 9350', '', '', 'mildura@bicyclesuperstore.com.au', 15, '116 Eighth Street', 'Mildura', '3500', 0, '', 0, 0, 0, 64, '2016-01-25 15:02:35'),
(280, 'Mornington', 'Store', '03 5975 7033', '', '', 'mornington@bicyclesuperstore.com.au', 15, '1/1002 Nepean Highway', 'Mornington', '3931', 0, '', 0, 0, 0, 65, '2016-01-25 15:02:35'),
(281, 'Nunawading', 'Store', '03 9894 4266', '', '', 'nunawading@bicyclesuperstore.com.au', 15, '315 Whitehorse Rd', 'Nunawading', '3131', 0, '', 0, 0, 0, 66, '2016-01-25 15:02:35'),
(282, 'Sunbury', 'Store', '03 8746 8500', '', '', 'sunbury@bicyclesuperstore.com.au', 15, 'Shop 3, 78-84 Horne St', 'Sunbury', '3429', 0, '', 0, 0, 0, 67, '2016-01-25 15:02:35'),
(283, 'Geelong', 'Store', '03 5229 2199', '', '', 'geelong@bicyclesuperstore.com.au', 15, '143 Malop St', 'Geelong', '3220', 0, '', 0, 0, 0, 68, '2016-01-25 15:02:35'),
(284, 'Danny', 'Ellem', '', '', '0438907233', '', 26, '', '', '', NULL, '', 0, 0, 0, 69, '2016-01-25 15:02:35'),
(285, 'Paul', 'Mentone', '', '', '0422 995 535', '', 15, '', '', '', NULL, '', 0, 0, 0, 70, '2016-01-25 15:02:35'),
(286, 'Belinda', 'Letty', '', '', '0417 349 056', '', 15, '', '', '', NULL, '', 0, 0, 0, 71, '2016-01-25 15:02:35'),
(287, 'Diane', 'Buettel', '', '', '0438 020 648', 'diane@oscarhospitality.com.au', 26, '', '', '', NULL, '', 0, 0, 0, 72, '2016-01-25 15:02:35'),
(288, 'mike', 'Morris', '9421 3332', '', '0448 136 390', 'mmorris@shimmco.com', 31, '21 Laity Street', 'Richmond', '3121', 0, '', 0, 0, 0, 73, '2016-01-25 15:02:35'),
(289, 'Christine', 'Berry', '9421 3332', '', '0448 136 168', 'cberry@shimmco.com', 31, '21 Laity Street', 'Richmond', '3121', 0, '', 0, 0, 0, 74, '2016-01-25 15:02:35'),
(290, 'Jan', 'Jones', '03 9867 3674', '', '(04) 0338-9988', '', 11, '', '', '', NULL, '', 0, 0, 0, 75, '2016-01-25 15:02:35'),
(291, 'Paul', 'Cambasis', '03 9533 6206', '', '0401 938 184', 'paul@eastbournetrading.com', 11, '', '', '', NULL, '', 0, 0, 0, 76, '2016-01-25 15:02:35'),
(292, 'Monica', 'x', '', '', '0418 360 571', 'monocar@live.com.au', 11, '', '', '', NULL, '', 0, 0, 0, 77, '2016-01-25 15:02:35'),
(293, 'Mark', 'Nichol', '03 9533 6206', '', '0451 030 163', 'mark@frenchoakfloors.com.au', 11, '', '', '', NULL, '', 0, 0, 0, 78, '2016-01-25 15:02:35'),
(294, 'Lynne', 'Harris', '(03) 9404 4565', '', '', 'admin@millparkcommunityhouse.com', 32, '68 Mill Park Dr', 'Mill Park', '3082', 0, '', 0, 0, 0, 79, '2016-01-25 15:02:35'),
(295, 'Hopppers', 'Crossing - Don', '', '', '', '0432 714 360', 15, '', '', '', NULL, '', 0, 0, 0, 80, '2016-01-25 15:02:35'),
(296, 'Don', '(Owner)', '', '', '0432 714 360', '', 15, '', '', '', NULL, '', 0, 0, 0, 81, '2016-01-25 15:02:35'),
(297, 'Tony', 'Lerserias - Building Manager', '0433451174', '', '', 'BuildingManager@victoriapointdocklands.com.au', 34, '100-120 Harbour Esplanade', '', '', NULL, '', 0, 0, 0, 82, '2016-01-25 15:02:35'),
(298, 'Jan', 'Jones', '03 9867 3674', '', '', '', 35, '', '', '', NULL, '', 0, 0, 0, 83, '2016-01-25 15:02:35'),
(299, 'Jennifer', 'Richards', '', '', '0412295553', '', 27, '', '', '', NULL, '', 0, 0, 0, 84, '2016-01-25 15:02:35'),
(300, 'Kim', 'Accounts', '', '', '0413 006 587', '', 33, '', '', '', NULL, '', 0, 0, 0, 85, '2016-01-25 15:02:35'),
(301, 'Patsy', 'ALD', '', '', '0410 579 297', '', 33, '', '', '', NULL, '', 0, 0, 0, 86, '2016-01-25 15:02:35'),
(302, 'Alfie', 'ALD', '', '', '0418 105 882', '', 33, '', '', '', NULL, '', 0, 0, 0, 87, '2016-01-25 15:02:35'),
(303, 'Rebbeca', 'Stilman', '0439 645 232', '', '', '', 21, '17 Haleys Gully Rd,', 'Hurstbridge', '', 0, '', 0, 0, 0, 88, '2016-01-25 15:02:35'),
(304, 'Hugh', 'McKee', '(03) 9826 8745', '', '0419 442 218', '', 36, '', '', '', NULL, '', 0, 0, 0, 90, '2016-01-25 15:02:35'),
(305, 'Adrian', 'Letty', '', '', '0413 134 551', 'adrian@bicyclesuperstore.com.au', 15, '', '', '', NULL, '', 0, 0, 0, 91, '2016-01-25 15:02:35'),
(306, 'Sandro', 'Meloni', '', '', '0411 408 131', 'sandro@redalligator.com.au', 27, '', '', '', NULL, '', 0, 0, 0, 92, '2016-01-25 15:02:35'),
(307, 'web/email Rowan', 'Peterson', '03 9894 6302', '', '0408 129 641', 'rowan@amphibian.com.au', 11, '', '', '', NULL, '', 0, 0, 0, 93, '2016-01-25 15:02:35'),
(308, 'Barbara', 'Di Pierro', '9913 7274', '', '0432 260 305', 'barbara.dipierro@kiara-international.com.au', 42, '2 Coopers Lane', 'Kensington', '', 0, '', 0, 0, 0, 94, '2016-01-25 15:02:35'),
(309, 'Ben', 'Drakely', '', '', '0401 474 437', '', 29, '', '', '', NULL, '', 0, 0, 0, 95, '2016-01-25 15:02:35'),
(310, 'Mark', 'Hopkinson', '03 9685 0114', '03 9696 7559', '0423 000 114', '', 16, '7 Riverside Quay, South Bank', '', '', NULL, '', 0, 0, 0, 97, '2016-01-25 15:02:35'),
(311, 'Jay', 'Web Hosting', '', '', '0433 178 837', '', 16, '7 Riverside Quay, South Bank', '', '', NULL, '', 0, 0, 0, 98, '2016-01-25 15:02:35'),
(312, 'Gerald', 'McDornan', '03 9544 8884', '', '0488 901 722', 'gerald@veracitymedia.com.au', 45, 'Suite 6/752 Blackburn Road', 'Clayton', '3178', 0, '', 0, 0, 0, 99, '2016-01-25 15:02:35'),
(313, 'Richard', 'Oversen', '', '', '0404004548', '', 15, '', '', '', NULL, '', 0, 0, 0, 100, '2016-01-25 15:02:35'),
(314, 'Bill', 'Wallace', '03 5997 5561', '', '0417 331 161', '', 2, '1 Laurens Street', 'Lang Lang', '3051', 0, '', 0, 0, 0, 101, '2016-01-25 15:02:35'),
(315, 'Pauline', 'Walker', '', '', '0417 964 092', '', 47, '', '', '', NULL, '', 0, 0, 0, 102, '2016-01-25 15:02:35'),
(316, 'Fountaingate', 'Store', '03 8790 5500', '', '', '', 15, '1004/352 PRINCES HWY', 'NARRE WARREN', '3805', 0, '', 0, 0, 0, 103, '2016-01-25 15:02:35'),
(317, 'Microchannel', 'RMS support', '1300 440 444', '', '', '', 15, '', '', '', NULL, '', 0, 0, 0, 104, '2016-01-25 15:02:36'),
(318, 'FrontDesk', 'Support', '1800 181 820', '', '', '', 39, '', '', '', NULL, '', 0, 0, 0, 105, '2016-01-25 15:02:36'),
(319, 'Keoni', 'Moore', '(03) 9431 0331', '', '(04) 3460-3755', '', 39, '', '', '', NULL, '', 0, 0, 0, 107, '2016-01-25 15:02:36'),
(320, 'Nicholas', 'Tang', '(03) 9832-0816', '', '0411 180 828', 'nicholas@highperformanceconsulting.com.au', 49, '', '', '', NULL, '', 0, 0, 0, 108, '2016-01-25 15:02:36'),
(321, 'Orlando', 'scalzi', '8788 7617', '', '', '', 3, '', '', '', NULL, '', 0, 0, 0, 109, '2016-01-25 15:02:36'),
(322, 'Margaret', 'Brigandi', '9331 4334', '', '0419 314 334', '', 40, '', '', '', NULL, '', 0, 0, 0, 110, '2016-01-25 15:02:36'),
(323, 'Justin', 'd (mornington)', '', '', '0419 345 112', 'justind@gp.com.au', 15, '', '', '', NULL, '', 0, 0, 0, 111, '2016-01-25 15:02:36'),
(324, 'David', 'Witchell', '+61411015789', '', '', 'dwitchell@optusnet.com.au', 19, '49 Erskin Road', 'Macleod', '', NULL, '', 0, 0, 0, 112, '2016-01-25 15:02:36'),
(325, 'Sarah', 'Gibbins', '', '', '0408 507 355', '', 48, '', '', '', NULL, '', 0, 0, 0, 113, '2016-01-25 15:02:36'),
(326, 'Emily', 'Jaksch', '', '', '0410 457 325', '', 48, '', '', '', NULL, '', 0, 0, 0, 114, '2016-01-25 15:02:36'),
(327, 'Kirsty', 'McMenaman', '(03) 94350604', '', '0437 193 774', '', 48, '', '', '', NULL, '', 0, 0, 0, 115, '2016-01-25 15:02:36'),
(328, 'Mike', 'Hayworth', '(03) 9457-5585', '', '0421392708', 'backdoc94@hotmail.com', 51, '40 Waiora Rd', 'Rosanna', '3084', 0, '', 0, 0, 0, 116, '2016-01-25 15:02:36'),
(329, 'David', 'Saunders', '', '', '', 'david@davidsaundersplumbing.com.au', 50, '', '', '', NULL, '', 0, 0, 0, 117, '2016-01-25 15:02:36'),
(330, 'John', 'Miller', '0411 755 153', '', '', 'john@moreprofitlesstime.com', 52, '3 / 333 Wantirna Road', 'Wantirna', '3152', 0, '', 0, 0, 0, 118, '2016-01-25 15:02:36'),
(331, 'Peter', 'Worcester', '0414303322', '', '', 'peter@worcester.com.au', 54, '1/31 Marne St, South Yarra', '', '', NULL, '', 0, 0, 0, 119, '2016-01-25 15:02:36'),
(332, 'Julie', 'Rocco', '', '0409 853 160', '0417 559 490', '', 40, '', '', '', NULL, '', 0, 0, 0, 120, '2016-01-25 15:02:36'),
(333, 'Ivan', 'Orsolic', '9826 8745', '', '0437 773 437', '', 36, 'Suite 6', 'South Yarra', '3141', 0, '', 0, 0, 0, 121, '2016-01-25 15:02:36'),
(334, 'Steuart', 'Meers', '98941644', '', '0413 830 008', 'steuartm@photodirect.com.au', 55, '4/109 Whitehorse Road', 'Blackburn', '3130', 0, '', 0, 0, 0, 122, '2016-01-25 15:02:36'),
(335, 'Michael', 'McKeon', '9421 3332', '', '0434 950 750', '', 31, '21 Laity Street', 'Richmond', '3121', 0, '', 0, 0, 0, 123, '2016-01-25 15:02:36'),
(336, 'Lewis', 'Chapman', '', '', '0428 766 050', 'chapmanplumbinginfo@gmail.com', 56, 'Unit 1/12 stradbroke av, heidleberg', '', '3084', NULL, '', 0, 0, 0, 124, '2016-01-25 15:02:36'),
(337, 'Helen', 'Gilpin', '(03) 9560 1844', '', '0438 907 233', '', 26, '405 High Street', 'Ashburton', '3147', 0, '', 0, 0, 0, 125, '2016-01-25 15:02:36'),
(338, 'Lou', 'Bacher', '', '', '0451 132 210', '', 47, '1903/594 St Kilda RD', 'Mlebourne', '3004', 0, '', 0, 0, 0, 126, '2016-01-25 15:02:37'),
(339, 'Tom', 'Moylan', '', '', '0477 000 571', '', 57, '1903/594 St Kilda RD', 'Mlebourne', '3004', 0, '', 0, 0, 0, 127, '2016-01-25 15:02:37'),
(340, 'Rosie', 'Emery', '0418 114 383', '', '0418 114 383', 'rosanne@cliftonstreet.com.au', 60, '9a Clifton Street', 'Richmond', '3121', 0, '', 0, 0, 0, 128, '2016-01-25 15:02:37'),
(341, 'Melissa', 'De Campo', '0419 316 135', '', '0419 316 135', 'mel_dec@bigpond.com', 60, '', '', '', NULL, '', 0, 0, 0, 129, '2016-01-25 15:02:37'),
(342, 'Craig', 'Helmer', '', '', '0412 205 556', '', 61, '', '', '', NULL, '', 0, 0, 0, 130, '2016-01-25 15:02:37'),
(343, 'Barry', 'Goldenberg', '9943 3858', '', '0411 551 100', 'barry@bdkg.com.au', 59, '', '', '', NULL, '', 0, 0, 0, 131, '2016-01-25 15:02:37'),
(344, 'Vanessa', 'Thomas', '', '', '0416 808 798', 'vanessa@synkd.com.au', 63, '', '', '', NULL, '', 0, 0, 0, 132, '2016-01-25 15:02:37'),
(345, 'Kam', 'Phulwani', '1300788261', '', '0432 779 775', 'kam@medsurge.com.au', 65, 'Unit 2', 'Mulgrave', '3170', 0, '', 0, 0, 0, 133, '2016-01-25 15:02:37'),
(346, 'Paul', 'Bailey', '1300 793 423', '', '0408699171', '', 62, '15-17 Rodeo Drive', 'Dandenong', '3175', 0, '', 0, 0, 0, 134, '2016-01-25 15:02:37'),
(347, 'Caroline', 'Tremayne', '', '', '0420237456', '', 35, '', '', '', NULL, '', 0, 0, 0, 135, '2016-01-25 15:02:37'),
(348, 'Michael', 'domain hosting', '', '', '0416 032 671', '', 66, 'The Riverside at Crown', '', '', NULL, '', 0, 0, 0, 136, '2016-01-25 15:02:37'),
(349, 'Adrian', 'Alexander', '', '', '0417 383 705', 'adrian.alexander@bigpond.com', 66, 'The Riverside at Crown', '', '', NULL, '', 0, 0, 0, 137, '2016-01-25 15:02:37'),
(350, 'Callum', 'Donoghue', '', '', '0414 932 051', '', 67, '', '', '', NULL, '', 0, 0, 0, 138, '2016-01-25 15:02:38'),
(351, 'Matt', 'Collins', '', '', '0408 599 938', '', 67, '', '', '', NULL, '', 0, 0, 0, 139, '2016-01-25 15:02:38'),
(352, 'Peter', 'Treby', '0419 361 428', '', '', '', 68, '10 Kirwana  Grove', 'Montmorency', '', 0, '', 0, 0, 0, 140, '2016-01-25 15:02:38'),
(353, 'Laura', 'Carolan', '03 9445 0232', '', '', 'lauracarolan@richmondcreche.com.au', 69, '10-14 Abinger Street', 'Richmond', '3121', 0, '', 0, 0, 0, 141, '2016-01-25 15:02:38'),
(354, 'Nicole', 'O''Donnel', '03 9428 2663', '', '', 'nicoleodonnell@richmondcreche.com.au', 69, '10-14 Abinger Street', 'Richmond', '3121', 0, '', 0, 0, 0, 142, '2016-01-25 15:02:38'),
(355, 'Matt', 'PABX', '0414 326 002', '', '', '', 69, '', '', '3121', NULL, '', 0, 0, 0, 143, '2016-01-25 15:02:38'),
(356, 'Xavier', 'X', '98941644', '', '', 'xavier@worldnet.com.au', 55, '4/109 Whitehorse Road', 'Blackburn', '3130', 0, '', 0, 0, 0, 144, '2016-01-25 15:02:38'),
(357, 'Claudia', 'Bonifacio', '9826 8745', '', '0433 379 564', '', 36, 'Suite 6', 'South Yarra', '3141', 0, '', 0, 0, 0, 145, '2016-01-25 15:02:38'),
(358, 'Sapient', 'Backups', '03 9824 8042', '', '', '', 1, 'Suite 3, 1501 Malvern Road', 'Glen Iris', '3146', 0, '', 0, 0, 0, 146, '2016-01-25 15:02:38'),
(359, 'Server', 'Room', '9539 5340', '', '', '', 6, '', '', '', NULL, '', 0, 0, 0, 147, '2016-01-25 15:02:38'),
(360, 'Kris', 'Cerini', '', '', '0428 525 115', '', 15, '', '', '', NULL, '', 0, 0, 0, 148, '2016-01-25 15:02:38'),
(361, 'Ryan', 'Harley', '', '', '0408 135 385', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 149, '2016-01-25 15:02:38'),
(362, 'Katie', 'Harley', '', '', '0433 157 058', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 150, '2016-01-25 15:02:38'),
(363, 'Jane', 'Sloan', '', '', '', 'janesloan@netspace.net.au', 46, '', '', '', NULL, '', 0, 0, 0, 151, '2016-01-25 15:02:38'),
(364, 'Michael', 'Jones', '03 9533 6206', '', '(04) 0338-6386', '', 35, 'Rear, 24 Wellington Street', 'St Kilda', '3182', 0, '', 0, 0, 0, 152, '2016-01-25 15:02:38'),
(365, 'TEDS', 'Frankston', '(03) 9783 8160', '', '', '', 55, 'Shop 3&4, 54-58 Wells St', 'Frankston', '', 0, '', 0, 0, 0, 153, '2016-01-25 15:02:38'),
(366, 'Carol', 'Fraser', '039853 0311', '', '', 'carol@scanlancarroll.com.au', 72, '', '', '', NULL, '', 0, 0, 0, 154, '2016-01-25 15:02:38'),
(367, 'Meaghan', 'X', '9435 7127', '', '0447 550 796', '', 72, '', '', '', NULL, '', 0, 0, 0, 155, '2016-01-25 15:02:38'),
(368, 'Andrew', 'McEwin (CEO)', '03 9702 9044', '', '0412 470 464', 'andrew@bicyclepartswholesale.com.au', 73, '76-80 Micro Circuit', 'Dandenong', '9044', 0, '', 0, 0, 0, 156, '2016-01-25 15:02:38'),
(369, 'Peter Worcester', 'Barwon Heads/Connewware address', '0414303322', '', '', 'peter@worcester.com.au', 54, '57  Fourth Loop', 'Conneware', '3227', NULL, '', 0, 0, 0, 157, '2016-01-25 15:02:38'),
(370, 'Justin', 'Seabrook', '03 9354 5250', '', '0400 190 184', 'fulham.chelsea@bigpond.com', 74, '23 Connolly Ave', 'Coburg', '3058', 0, '', 0, 0, 0, 158, '2016-01-25 15:02:38'),
(371, 'anthony', 'Mann', '', '', '0499 566 040', '', 2, '', '', '', NULL, '', 0, 0, 0, 159, '2016-01-25 15:02:38'),
(372, 'Elle', 'Lockey', '03 93282681', '', '0488 566 546', '', 2, '', '', '3051', 0, '', 0, 0, 0, 160, '2016-01-25 15:02:38'),
(373, 'Minemet', 'Server', '9826 8745', '', '', 'raid@minemet.com', 36, 'Suite 6', 'South Yarra', '3141', 0, '', 0, 0, 0, 161, '2016-01-25 15:02:38'),
(374, 'Glenn', 'Kernick', '', '', '0401 242 699', '', 15, '', '', '', NULL, '', 0, 0, 0, 162, '2016-01-25 15:02:38'),
(375, 'Carli', 'O''Reilly', '', '', '0409 424 596', 'corraccounting@bigpond.com', 76, '', 'Croydon South', '', NULL, '', 0, 0, 0, 163, '2016-01-25 15:02:38'),
(376, 'Kristy', 'Hansen', '', '', '0400645018', 'kristy@hrgurus.com.au', 48, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, '2015-09-25 16:13:59'),
(377, 'Jim', 'x', '', '', '0418 367 880', '', 78, '', '', '', NULL, '', 0, 0, 0, 164, '2016-01-25 15:02:38'),
(378, 'Bill', 'Abbott', '', '', '0409 830 383', 'Bill.Abbott@bicyclesuperstore.com.au', 15, '', '', '', NULL, '', 0, 0, 0, 165, '2016-01-25 15:02:38'),
(379, 'Nicol', 'Reslova', '9826 8745', '', '0408 039 875', '', 36, 'Suite 6', 'South Yarra', '3141', 0, '', 0, 0, 0, 166, '2016-01-25 15:02:38'),
(380, 'Andre', 'Tang', '(03) 9832-0816', '', '0403 159 598', 'andre@highperformanceconsulting.com.au', 49, '', '', '', NULL, '', 0, 0, 0, 167, '2016-01-25 15:02:38'),
(381, 'Carlo', 'ALD', '03 9357 7400', '9357 7973', '0402 219 524', '', 33, '45 Jesica Rd', 'Campbellfield', '3061', NULL, '', 0, 0, 0, 168, '2016-01-25 15:02:38'),
(382, 'Kahill', 'Tierney', '', '', '0433991891', '', 15, '', '', '', NULL, '', 0, 0, 0, 169, '2016-01-25 15:02:38'),
(383, 'Kylie', 'Mc Elhenny', '', '', '0417 549 342', 'kmcelhenny@hotmail.com', 48, '', '', '', NULL, '', 0, 0, 0, 170, '2016-01-25 15:02:38'),
(384, 'Daniel', 'Siciliano', '9432 4121', '', '0432 688 950', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 171, '2016-01-25 15:02:39'),
(385, 'Cain', 'Baker', '9432 4121', '', '0417 973 521', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 172, '2016-01-25 15:02:39'),
(386, 'Cameron', 'Janson', '9432 4121', '', '0438 047 134', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 173, '2016-01-25 15:02:39'),
(387, 'Chris', 'Chapman', '9432 4121', '', '0409 444 502', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 174, '2016-01-25 15:02:39'),
(388, 'Craig', 'Kenny  (Your local Telecom)', '1300 769 670', '', '0424 223 004', '', 62, '15-17 Rodeo Drive', 'Dandenong', '3175', 0, '', 0, 0, 0, 175, '2016-01-25 15:02:39'),
(389, 'Ken', 'Griggs', '61-3-9499 4100', '61-3-9499 4111', '0414 694 096', '', 24, '24 Ford Crescent', 'Thornbury', '3071', 0, '', 0, 0, 0, 176, '2016-01-25 15:02:39'),
(390, 'Steve', 'Brouggy', '1300 793 423', '', '0409 502 308', '', 62, '15-17 Rodeo Drive', 'Dandenong', '3175', 0, '', 0, 0, 0, 177, '2016-01-25 15:02:39'),
(391, 'Toby', 'Couchman(webaroo webhosting)', '', '', '0431 696 885', 'toby@webberoo.com.au', 2, '', '', '3051', 0, '', 0, 0, 0, 178, '2016-01-25 15:02:39'),
(392, 'Steve', 'Bland (Corner Stone Solutions)', '3 9434 7352', '', '', '', 2, '', '', '', NULL, '', 0, 0, 0, 179, '2016-01-25 15:02:39'),
(393, 'Operations', 'Mobile', '03 93282681', '', '0409 851 831', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 180, '2016-01-25 15:02:39'),
(394, 'Tim', 'Leggott', '9432 4121', '', '0481 274 080', '', 71, 'Unit 3B, 266 Bolton Street', 'Eltham', '3095', 0, '', 0, 0, 0, 181, '2016-01-25 15:02:39'),
(395, 'Natalie', 'Savic', '03 9459 4569', '', '0411 393 049', 'nataliesavic@saviloans.com.au', 82, '', '', '', NULL, '', 0, 0, 0, 182, '2016-01-25 15:02:39'),
(396, 'Kellie', 'Woodward', '9717 0048', '', '', 'kellie_woodward@travel-associates.com.au', 75, '', '', '', NULL, '', 0, 0, 0, 183, '2016-01-25 15:02:39'),
(397, 'Alysha', 'Munro', '', '', '0431 145 772', 'alysha@hrgurus.com.au', 48, '', '', '', NULL, '', 0, 0, 0, 184, '2016-01-25 15:02:39'),
(398, 'Kristy', 'Hansen', '', '', '0400 645 018', '', 48, '', '', '', NULL, '', 0, 0, 0, 185, '2016-01-25 15:02:39'),
(399, 'Samra', 'Nazir', '', '', '0430 971 871', 'samra@hrgurus.com.au', 48, '', '', '', NULL, '', 0, 0, 0, 186, '2016-01-25 15:02:39'),
(400, 'Natalie', 'Bol', '', '', '0400 061 769', 'natalie@hrgurus.com.au', 48, '', '', '', NULL, '', 0, 0, 0, 187, '2016-01-25 15:02:39'),
(401, 'Caz', 'Simpson', '03 8782 0251', '03 8782 0240', '0408 324 012', 'mailingmatters@gmail.com', 86, '6/22 Carter Way', 'Dandenong South', '3175', 0, '', 0, 0, 0, 188, '2016-01-25 15:02:39'),
(402, 'Brent', 'Kirchner', '', '', '0421 335 903', 'brent.kirchner@bicyclesuperstore.com.au', 15, '', '', '', NULL, '', 0, 0, 0, 189, '2016-01-25 15:02:39'),
(403, 'Dennis', 'Rozich', '03 9357 7400', '9357 7973', '0418 337 353', '', 33, '45 Jesica Rd', 'Campbellfield', '3061', NULL, '', 0, 0, 0, 191, '2016-01-25 15:02:39'),
(404, 'Katrina', 'Galindo', '03 93282681', '', '408 300 625', 'katrina@irwinstockfeeds.com.au', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 192, '2016-01-25 15:02:39'),
(405, 'Chris', 'Hatzi', '', '', '0411 261 630', '', 88, '', '', '', NULL, '', 0, 0, 0, 193, '2016-01-25 15:02:39'),
(406, 'Katrina', 'Galindo', '', '', '0408300625', '', 2, '', '', '', 0, '', 0, 0, 0, 194, '2016-01-25 15:02:39'),
(407, 'Tony', 'Lerias', '', '', '0433 451 174', 'stjapartments@bigpond.com', 89, '', '', '', NULL, '', 0, 0, 0, 195, '2016-01-25 15:02:39'),
(408, 'Andrew', 'Leather', '03 93282681', '', '0488 566 546', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 196, '2016-01-25 15:02:39'),
(409, 'Jesse', 'Van Rooye', '03 93282681', '', '0499 566 040', '', 2, '1 Laurens Street', 'North Melbourne', '3051', 0, '', 0, 0, 0, 197, '2016-01-25 15:02:39'),
(410, 'Cherise', 'Northfield', '9421 3332', '', '0402 495 770', '', 31, '21 Laity Street', 'Richmond', '3121', 0, '', 0, 0, 0, 198, '2016-01-25 15:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `lookup`
--

CREATE TABLE IF NOT EXISTS `lookup` (
`id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `lookup`
--

INSERT INTO `lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Database', 1, 'SyncEndPointType', 1),
(2, 'Webpage', 2, 'SyncEndPointType', 2),
(3, 'File', 3, 'SyncEndPointType', 3),
(6, 'Success', 1, 'SYNC_RESULT', 1),
(7, 'Error', 2, 'SYNC_RESULT', 2),
(8, 'Database Spanning', 4, 'SyncEndPointType', 4);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
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
`index` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `syncModelName` varchar(200) NOT NULL,
  `endPoint` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `frequenyMin` int(11) NOT NULL DEFAULT '60',
  `lastSync` datetime DEFAULT NULL,
  `LastStatus` int(11) DEFAULT NULL,
  `LastStatusData` varchar(500) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `syncrelationships`
--

INSERT INTO `syncrelationships` (`index`, `description`, `syncModelName`, `endPoint`, `username`, `password`, `frequenyMin`, `lastSync`, `LastStatus`, `LastStatusData`) VALUES
(2, 'This sync model is to sync the Clients between labtech and Imp', 'SyncLabtechClient', 'localhost', 'root', '', 15, '2016-03-06 13:03:29', 1, 'fdgdf'),
(3, '', 'SyncLabtechContact', NULL, NULL, NULL, 15, '2016-02-25 15:42:36', 2, ''),
(4, '', 'SyncPhoneContacts', NULL, NULL, NULL, 360, '2016-01-25 15:04:41', 1, ''),
(5, '', 'SyncTicketInfo', NULL, NULL, NULL, 15, '1970-01-01 00:00:00', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_info`
--

CREATE TABLE IF NOT EXISTS `ticket_info` (
`id` int(100) NOT NULL,
  `labtech_ticket_id` int(50) NOT NULL,
  `imp_status` int(4) NOT NULL,
  `charge_rate_id` int(4) NOT NULL,
  `invoice_date` date DEFAULT NULL,
  `invoice_id` int(10) DEFAULT NULL,
  `default_billing_account_id` int(10) DEFAULT NULL,
  `default_charge_rate_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `timeslip_info`
--

CREATE TABLE IF NOT EXISTS `timeslip_info` (
`id` int(11) NOT NULL,
  `labtech_timeslip_id` int(10) NOT NULL,
  `labtech_ticket_id` int(10) NOT NULL,
  `ticket_info_id` int(10) NOT NULL,
  `billed_time` float NOT NULL DEFAULT '0',
  `charge_rate_id` int(10) NOT NULL,
  `billing_account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `status`, `auth_key`, `password_reset_token`, `account_activation_token`, `created_at`, `updated_at`) VALUES
(2, 'stsadmin', 'shamus.dougan@sapient-tech.com.au', '$2y$13$EvP1mu/iRq6xqIp4oKaAoOgBaCnJUImEFdXwH39NK7CvKOiosvHtK', 10, 'BqH0sfhID-iGM37FxP_AUG8JV-ndRJFs', NULL, NULL, 1426969380, 1426969380),
(5, 'shamus', 'test@test.com', '$2y$13$a0JVb.KGIEintCd4Jo89zuSsG0gPXOGr8AaoTAFiCLYUkechkT9/a', 10, 'IUTHnAzXzyW5YOof6D-OwievOpQWP9nQ', NULL, NULL, 1427250473, 1427253473);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `charge_rates`
--
ALTER TABLE `charge_rates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charge_rates_amounts`
--
ALTER TABLE `charge_rates_amounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_contact`
--
ALTER TABLE `client_contact`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lookup`
--
ALTER TABLE `lookup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `syncrelationships`
--
ALTER TABLE `syncrelationships`
 ADD PRIMARY KEY (`index`);

--
-- Indexes for table `ticket_info`
--
ALTER TABLE `ticket_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeslip_info`
--
ALTER TABLE `timeslip_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `charge_rates`
--
ALTER TABLE `charge_rates`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `charge_rates_amounts`
--
ALTER TABLE `charge_rates_amounts`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `client_contact`
--
ALTER TABLE `client_contact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=411;
--
-- AUTO_INCREMENT for table `lookup`
--
ALTER TABLE `lookup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `syncrelationships`
--
ALTER TABLE `syncrelationships`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ticket_info`
--
ALTER TABLE `ticket_info`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timeslip_info`
--
ALTER TABLE `timeslip_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
