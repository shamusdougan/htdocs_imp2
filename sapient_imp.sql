-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2015 at 08:05 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `address`, `city`, `state`, `postcode`, `phone1`, `phone2`, `ABN`, `notes`, `defaultBillingRate`, `defaultBillingType`, `accountBillTo`, `FK1`, `FK2`, `FK3`, `FK4`, `FK5`, `labtech`, `last_change`, `sync_status`, `contact_billing`, `contact_authorized`, `contact_owner`) VALUES
(51, 'Oscar Hospitality', 'Suite 2, Level 2, 295 Springvale Road', 'Glen Waverley', 'Victoria', 3150, '(03) 9560 1844', NULL, NULL, '', 1, 1, NULL, 27, NULL, NULL, NULL, NULL, 1, '2015-08-12 19:51:34', 0, NULL, NULL, NULL),
(52, 'BDKG Pty Ltd', '', '', '', NULL, '9943 3858', NULL, NULL, '', 1, 1, NULL, 60, NULL, NULL, NULL, NULL, 1, '2015-08-12 19:51:34', 0, NULL, NULL, NULL),
(53, 'Kelly Woodward', '', '', '', NULL, '9717 0048', NULL, NULL, 'kellie_woodward@travel-associates.com.au', 1, 1, NULL, 76, NULL, NULL, NULL, NULL, 1, '2015-08-12 19:51:34', 0, NULL, NULL, NULL),
(54, 'Savi Loans Pty Ltd', '', '', '', NULL, '0411 393 049', NULL, NULL, 'Savi Loans Pty Ltd abn is 89 130 547 401\r\nSole Trader ABN 275 209 26973\r\nMortgage Broker crn 453786 \r\nM:  0411 393 049  F:  03 9459 4569    \r\nE:    nataliesavic@saviloans.com.au\r\nW:  www.saviloans.com.au\r\n\r\nof BLSSA Pty Ltd ACL 391237\r\n', 1, 1, NULL, 84, NULL, NULL, NULL, NULL, 1, '2015-08-12 19:51:34', 0, NULL, NULL, NULL),
(55, 'You Are Good Enough', '', '', '', NULL, '', NULL, NULL, 'ABN 51435650157', 1, 1, NULL, 86, NULL, NULL, NULL, NULL, 1, '2015-08-12 19:51:34', 0, NULL, NULL, NULL),
(56, 'GDMC', '', '', '', NULL, '', NULL, NULL, '', 1, 1, NULL, 87, NULL, NULL, NULL, NULL, 1, '2015-08-12 19:51:34', 0, NULL, NULL, NULL),
(57, 'Paul Broadfoot', 'Suite G6, Corporate One, 84 Hotham Street', 'Preston', 'VICTORIA', 3072, '0400 605 889', NULL, NULL, '', 1, 1, NULL, 88, NULL, NULL, NULL, NULL, 1, '2015-08-12 19:51:34', 0, NULL, NULL, NULL);

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
  `address` int(11) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Postcode` varchar(10) DEFAULT NULL,
  `State` int(10) DEFAULT NULL,
  `Notes` varchar(500) NOT NULL,
  `owner_contact` tinyint(1) NOT NULL DEFAULT '0',
  `accounts_contact` tinyint(1) NOT NULL DEFAULT '0',
  `authorized_contact` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `client_contact`
--

INSERT INTO `client_contact` (`id`, `firstname`, `surname`, `phone1`, `phone2`, `mobile`, `email`, `client_id`, `address`, `City`, `Postcode`, `State`, `Notes`, `owner_contact`, `accounts_contact`, `authorized_contact`) VALUES
(1, 'asdfasd', 'asdfasdf', '', '', '', '', 1, NULL, NULL, NULL, NULL, '', 0, 0, 0),
(2, 'dddddd', '3332223', '', '', '', '', 1, NULL, NULL, NULL, NULL, '', 0, 0, 0),
(3, 'sadfasdf', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf', '', '', '', '', 1, NULL, NULL, NULL, NULL, '', 0, 0, 0),
(5, 'shamus', 'Dougan', '1234', '', '', '', 27, NULL, NULL, NULL, NULL, '', 0, 0, 0);

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
  `endPointBaseURL` varchar(500) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `syncrelationships`
--

INSERT INTO `syncrelationships` (`index`, `impModelName`, `endPointName`, `endPointType`, `endPointDBServer`, `endPointDBName`, `endPointDBTable`, `endPointUser`, `endPointPassword`, `syncModelName`, `frequenyMin`, `lastSync`, `LastStatus`, `LastStatusData`, `endPointFilePath`, `endPointBaseURL`) VALUES
(2, 'Client', 'Labtech', 1, 'localhost', 'labtech', 'clients', 'root', '', 'SyncLabtechClient', 15, '2015-08-12 20:41:03', 1, '', '', '');

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
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `client_contact`
--
ALTER TABLE `client_contact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lookup`
--
ALTER TABLE `lookup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `syncrelationships`
--
ALTER TABLE `syncrelationships`
MODIFY `index` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
