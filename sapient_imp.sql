-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2015 at 08:44 AM
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
  `state` int(5) DEFAULT NULL,
  `postcode` int(4) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `ABN` varchar(50) DEFAULT NULL,
  `defaultBillingRate` int(11) NOT NULL,
  `defaultBillingType` int(11) NOT NULL,
  `accountBillTo` int(5) DEFAULT NULL,
  `FK1` int(30) DEFAULT NULL,
  `FK2` int(30) DEFAULT NULL,
  `FK3` int(30) DEFAULT NULL,
  `FK4` int(30) DEFAULT NULL,
  `FK5` int(30) DEFAULT NULL,
  `last_change` datetime DEFAULT NULL,
  `sync_status` int(5) NOT NULL,
  `contact_billing` int(5) DEFAULT NULL,
  `contact_authorized` int(5) DEFAULT NULL,
  `contact_owner` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `address`, `city`, `state`, `postcode`, `phone1`, `phone2`, `ABN`, `defaultBillingRate`, `defaultBillingType`, `accountBillTo`, `FK1`, `FK2`, `FK3`, `FK4`, `FK5`, `last_change`, `sync_status`, `contact_billing`, `contact_authorized`, `contact_owner`) VALUES
(1, 'Sapient Technology Solutions', 'Suite 3, 1501 Malvern Rd', 'Glen Iris', 1, 3146, '1300787471', NULL, '2147483647', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-18 15:26:06', 0, NULL, NULL, NULL),
(22, 'BDKG Pty Ltd', '', '', NULL, NULL, '9943 3858', NULL, NULL, 1, 1, NULL, 60, NULL, NULL, NULL, NULL, '2015-08-09 08:41:25', 0, NULL, NULL, NULL),
(23, 'Kelly Woodward', '', '', NULL, NULL, '9717 0048', NULL, NULL, 1, 1, NULL, 76, NULL, NULL, NULL, NULL, '2015-08-09 08:41:25', 0, NULL, NULL, NULL),
(24, 'Savi Loans Pty Ltd', '', '', NULL, NULL, '0411 393 049', NULL, NULL, 1, 1, NULL, 84, NULL, NULL, NULL, NULL, '2015-08-09 08:41:25', 0, NULL, NULL, NULL),
(25, 'You Are Good Enough', '', '', NULL, NULL, '', NULL, NULL, 1, 1, NULL, 86, NULL, NULL, NULL, NULL, '2015-08-09 08:41:25', 0, NULL, NULL, NULL),
(26, 'GDMC', '', '', NULL, NULL, '', NULL, NULL, 1, 1, NULL, 87, NULL, NULL, NULL, NULL, '2015-08-09 08:41:25', 0, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lookup`
--

INSERT INTO `lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Database', 1, 'SyncEndPointType', 1),
(2, 'Webpage', 2, 'SyncEndPointType', 2),
(3, 'File', 3, 'SyncEndPointType', 3),
(4, 'VIC', 1, 'STATE', 1),
(5, 'NSW', 2, 'STATE', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `syncrelationships`
--

INSERT INTO `syncrelationships` (`index`, `impModelName`, `endPointName`, `endPointType`, `endPointDBServer`, `endPointDBName`, `endPointDBTable`, `endPointUser`, `endPointPassword`, `syncModelName`, `frequenyMin`, `lastSync`, `LastStatus`, `LastStatusData`, `endPointFilePath`, `endPointBaseURL`) VALUES
(2, 'Client', 'Labtech', 1, 'localhost', 'labtech', 'clients', 'root', '', 'SyncLabtechClient', 15, '2015-06-18 16:05:41', NULL, '', '', '');

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
