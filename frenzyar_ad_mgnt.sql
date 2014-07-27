-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2014 at 02:46 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `frenzyar_ad_mgnt`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_admin_user`
--

CREATE TABLE IF NOT EXISTS `ad_admin_user` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` text NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ad_admin_user`
--

INSERT INTO `ad_admin_user` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227');

-- --------------------------------------------------------

--
-- Table structure for table `ad_advertisement_count`
--

CREATE TABLE IF NOT EXISTS `ad_advertisement_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `bannerId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_api_info`
--

CREATE TABLE IF NOT EXISTS `ad_api_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(200) NOT NULL,
  `api_password` varchar(200) NOT NULL,
  `api_salt` varchar(4) NOT NULL,
  `versionName` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_banner`
--

CREATE TABLE IF NOT EXISTS `ad_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brandId` int(11) NOT NULL,
  `brannerURL` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_brand_info`
--

CREATE TABLE IF NOT EXISTS `ad_brand_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(200) NOT NULL,
  `brandDes` text NOT NULL,
  `brandCategories` text NOT NULL,
  `status` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_incentive_method`
--

CREATE TABLE IF NOT EXISTS `ad_incentive_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incentive_name` varchar(200) NOT NULL,
  `incentive_des` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ad_incentive_method`
--

INSERT INTO `ad_incentive_method` (`id`, `incentive_name`, `incentive_des`) VALUES
(1, 'Cash', ''),
(2, 'Discount Offer', '');

-- --------------------------------------------------------

--
-- Table structure for table `ad_interest`
--

CREATE TABLE IF NOT EXISTS `ad_interest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interestName` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_renew_log`
--

CREATE TABLE IF NOT EXISTS `ad_renew_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brandId` int(11) NOT NULL,
  `renewedAt` date NOT NULL,
  `expiredAt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_user`
--

CREATE TABLE IF NOT EXISTS `ad_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(4) NOT NULL,
  `dob` date NOT NULL,
  `status` int(11) NOT NULL,
  `forgetPasswordKey` varchar(200) NOT NULL,
  `activationKey` varchar(200) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_user_device_info`
--

CREATE TABLE IF NOT EXISTS `ad_user_device_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufactural` text NOT NULL,
  `model` text NOT NULL,
  `deviceId` text NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_user_interest`
--

CREATE TABLE IF NOT EXISTS `ad_user_interest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `interestIds` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_user_location`
--

CREATE TABLE IF NOT EXISTS `ad_user_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ad_user_log`
--

CREATE TABLE IF NOT EXISTS `ad_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `location` text NOT NULL,
  `deviceInfo` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
