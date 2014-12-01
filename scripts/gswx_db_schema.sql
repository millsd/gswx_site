-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: db.gswx.info
-- Generation Time: Nov 28, 2014 at 12:06 PM
-- Server version: 5.1.56
-- PHP Version: 5.4.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `gswx`
--

-- --------------------------------------------------------

--
-- Table structure for table `coordinates`
--

CREATE TABLE IF NOT EXISTS `coordinates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lon` decimal(8,5) NOT NULL,
  `lat` decimal(7,5) NOT NULL,
  `touched` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '2014-07-01 00:00:01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `point` (`lon`,`lat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `coordinates`
--

REPLACE INTO `coordinates` (`id`, `lon`, `lat`, `touched`, `created`) VALUES(100, 0.00000, 0.00000, '2014-11-26 16:51:43', '2014-07-01 00:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint(12) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `parent` varchar(7) NOT NULL DEFAULT 'D105',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '2014-07-01 00:00:01',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `documents`
--

REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(0, '', '', '', '2014-11-27 05:31:37', '2014-07-01 00:00:01');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(1, 'The Great Stones Way: Wiltshire, England', 'Barbury Castle to Old Sarum &amp;bull ~40 mi', '/', '2014-11-26 09:00:51', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(10, 'The Great Stones Way: Stage 1', 'Barbury Castle to Overton Hill &amp;bull; 6.4 mi', 'D1', '2014-11-26 09:01:01', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(20, 'The Great Stones Way: Stage 2', 'Overton Hill to Honey Street', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(30, 'The Great Stones Way: Stage 3', 'Honey Street to Casterly Camp', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(40, 'The Great Stones Way: Stage 4', 'Casterly Camp to Netheravon', 'D1', '2014-11-26 09:04:41', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(50, 'The Great Stones Way: Stage 5', 'Netheravon to Amesbury', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(60, 'The Great Stones Way: Stage 6', 'Amesbury to Old Sarum', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(101, 'Great Stones Way: Variants (OBE)', '', 'D1', '2014-11-27 05:27:24', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(102, 'Great Stones Way: Extensions', '', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(103, 'Great Stones Way: Tracks', '', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(104, 'Great Stones Way: Intersecting Trails', '', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(105, 'Great Stones Way: Custom Maps', '', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(106, 'Great Stones Way: Transportation', '', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(107, 'Great Stones Way: Accomodations', '', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');
REPLACE INTO `documents` (`id`, `name`, `description`, `parent`, `updated`, `created`) VALUES(108, 'Great Stones Way: Pubs', '', 'D1', '2014-11-26 09:04:31', '2014-11-25 12:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE IF NOT EXISTS `folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` varchar(13) NOT NULL DEFAULT 'D105',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '2014-07-01 00:00:01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `folders`
--

REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(11, 'GSW Stage 1 Directions', 'D10', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(12, 'GSW Stage 1 Streetviews', 'D10', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(13, 'GSW Stage 1 Interesting', 'D10', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(14, 'GSW Stage 1 Milestones', 'D10', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(15, 'GSW Stage 1 Path', 'D10', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(21, 'GSW Stage 2 Directions', 'D20', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(22, 'GSW Stage 2 Streetviews', 'D20', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(23, 'GSW Stage 2 Interesting', 'D20', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(24, 'GSW Stage 2 Milestones', 'D20', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(25, 'GSW Stage 2 Path', 'D20', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(31, 'GSW Stage 3 Directions', 'D30', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(32, 'GSW Stage 3 Streetviews', 'D30', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(33, 'GSW Stage 3 Interesting', 'D30', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(34, 'GSW Stage 3 Milestones', 'D30', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(35, 'GSW Stage 3 Path', 'D30', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(41, 'GSW Stage 4 Directions', 'D40', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(42, 'GSW Stage 4 Streetviews', 'D40', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(43, 'GSW Stage 4 Interesting', 'D40', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(44, 'GSW Stage 4 Milestones', 'D40', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(45, 'GSW Stage 4 Path', 'D40', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(51, 'GSW Stage 5 Directions', 'D50', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(52, 'GSW Stage 5 Streetviews', 'D50', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(53, 'GSW Stage 5 Interesting', 'D50', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(54, 'GSW Stage 5 Milestones', 'D50', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(55, 'GSW Stage 5 Path', 'D50', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(61, 'GSW Stage 6 Directions', 'D60', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(62, 'GSW Stage 6 Streetviews', 'D60', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(63, 'GSW Stage 6 Interesting', 'D60', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(64, 'GSW Stage 6 Milestones', 'D60', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(65, 'GSW Stage 6 Path', 'D60', '2014-11-25 12:25:49', '2014-11-25 12:25:49');
REPLACE INTO `folders` (`id`, `name`, `parent`, `updated`, `created`) VALUES(100, '', '', '2014-11-27 19:14:25', '2014-07-01 00:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `coord_id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `lon` decimal(18,15) NOT NULL,
  `lat` decimal(18,16) NOT NULL,
  `ele` decimal(8,3) DEFAULT NULL,
  `parent` varchar(13) NOT NULL DEFAULT 'D105',
  `description` text NOT NULL,
  `lookat` varchar(255) DEFAULT NULL,
  `style` varchar(100) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '2014-07-01 00:00:01',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `points`
--

REPLACE INTO `points` (`id`, `coord_id`, `name`, `lon`, `lat`, `ele`, `parent`, `description`, `lookat`, `style`, `updated`, `created`) VALUES(1, 0, '', -1.783098450000000, 51.5636546000000000, NULL, 'gswx.info', 'Swindon bus station', NULL, '', '2014-11-19 05:53:29', '2014-11-19 05:53:29');
REPLACE INTO `points` (`id`, `coord_id`, `name`, `lon`, `lat`, `ele`, `parent`, `description`, `lookat`, `style`, `updated`, `created`) VALUES(23, 0, '', -1.824378000000000, 51.1798290000000000, 308.240, '', 'Stonehenge', NULL, '', '2014-11-19 08:45:34', '2014-11-25 12:25:49');
REPLACE INTO `points` (`id`, `coord_id`, `name`, `lon`, `lat`, `ele`, `parent`, `description`, `lookat`, `style`, `updated`, `created`) VALUES(100, 0, '', 0.000000000000000, 0.0000000000000000, NULL, '', '', NULL, '', '2014-11-27 16:39:03', '2014-07-01 00:00:01');
