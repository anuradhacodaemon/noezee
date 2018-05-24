-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2018 at 07:30 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neozee`
--

-- --------------------------------------------------------

--
-- Table structure for table `neo_device`
--

CREATE TABLE `neo_device` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` varchar(200) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `user_type` enum('P','C') NOT NULL,
  `parent_device_id` varchar(255) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `neo_device`
--

INSERT INTO `neo_device` (`id`, `user_id`, `device_id`, `device_name`, `user_type`, `parent_device_id`, `updated_date`, `created_date`, `status`) VALUES
(1, 1, '32fd175c1ba80130', 'anu phone', 'P', '', '2018-01-29 11:26:16', '2018-01-29 04:54:35', '1'),
(2, 1, 'f12a46c562103947', 'rajib phone', 'C', '', '2018-01-29 11:25:48', '2018-01-29 04:59:46', '1'),
(14, 3, 'cde047dccc5d7b7d', 'prashant.koli-cde047dccc5d7b7d', 'C', '', '2018-01-29 16:09:07', '2018-01-29 10:09:07', '1'),
(15, 3, 'e61bbae536e20faa', 'prashant.koli-e61bbae536e20faa', 'P', '', '2018-01-29 16:10:48', '2018-01-29 10:10:48', '1'),
(22, 3, 'e61bbae536e20faa', 'prashant.koli-e61bbae536e20faa', 'P', '', '2018-01-29 16:10:48', '2018-01-29 10:10:48', '1'),
(25, 2, '5D1CEE6B-77D3-444E-8B33-CB8589CD3352', 'Soumik’s iPhone', 'P', '', '2018-01-29 13:06:07', '2018-01-29 07:06:07', '1'),
(26, 4, 'b2f14fd6f7152120', '', 'C', '', '2018-01-29 12:53:10', '2018-01-29 06:53:10', '1'),
(27, 3, '5D1CEE6B-77D3-444E-8B33-CB8589CD3352', 'Soumik’s iPhone', 'P', '', '2018-01-29 16:50:03', '2018-01-29 10:50:03', '1'),
(28, 4, 'e61bbae536e20faa', 'atindrabiswas', 'P', '', '2018-01-29 13:17:19', '2018-01-29 07:17:19', '1'),
(29, 1, 'b2f14fd6f7152120', 'anu-b2f14fd6f7152120', 'C', '', '2018-01-29 15:33:48', '2018-01-29 09:33:48', '1'),
(30, 1, '5D1CEE6B-77D3-444E-8B33-CB8589CD3352', 'Soumik’s iPhone', 'P', '', '2018-01-29 15:57:37', '2018-01-29 09:57:37', '1'),
(31, 2, '6581930e26f25802', 'prashnat.koli-6581930e26f25802', 'P', '', '2018-01-31 08:26:20', '2018-01-30 20:56:19', '1'),
(32, 3, '6581930e26f25802', 'prashnat.koli-6581930e26f25802', 'P', '', '2018-01-31 08:39:37', '2018-01-30 21:09:37', '1');

-- --------------------------------------------------------

--
-- Table structure for table `neo_favorite`
--

CREATE TABLE `neo_favorite` (
  `fav_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `child_id` varchar(255) NOT NULL COMMENT 'child device id',
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `neo_favorite`
--

INSERT INTO `neo_favorite` (`fav_id`, `media_id`, `user_id`, `child_id`, `created_date`, `updated_date`, `status`) VALUES
(1, 4, 1, 'f12a46c562103947', '2018-01-29 07:38:09', '2018-01-29 13:45:48', '0'),
(2, 8, 3, 'cde047dccc5d7b7d', '2018-01-29 10:24:03', '2018-01-29 16:24:03', '1'),
(3, 7, 3, 'cde047dccc5d7b7d', '2018-01-29 10:24:26', '2018-01-29 16:24:26', '1'),
(4, 22, 3, 'cde047dccc5d7b7d', '2018-01-29 10:40:59', '2018-01-29 16:40:59', '1'),
(5, 14, 1, 'b2f14fd6f7152120', '2018-01-29 20:57:48', '2018-01-30 08:32:59', '0'),
(6, 1, 1, 'f12a46c562103947', '2018-01-31 00:59:39', '2018-01-31 12:29:39', '1'),
(7, 17, 2, '', '2018-02-01 19:41:14', '2018-02-02 07:11:14', '1'),
(8, 17, 1, 'f12a46c562103947', '2018-02-01 23:11:34', '2018-02-02 10:41:34', '1'),
(9, 7, 1, 'f12a46c562103947', '2018-02-02 01:03:44', '2018-02-02 12:33:44', '1');

-- --------------------------------------------------------

--
-- Table structure for table `neo_feedback`
--

CREATE TABLE `neo_feedback` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `neo_feedback`
--

INSERT INTO `neo_feedback` (`id`, `content`, `user_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 'nice ', 1, 0, '0000-00-00 00:00:00', '2018-01-29 15:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `neo_keys`
--

CREATE TABLE `neo_keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `neo_keys`
--

INSERT INTO `neo_keys` (`id`, `key`, `level`, `ignore_limits`, `date_created`) VALUES
(1, 'neo-32696d98-a84a2f0f-2a254259-ea5de6aa', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `neo_media`
--

CREATE TABLE `neo_media` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_thumb` varchar(250) NOT NULL,
  `image_thumb1` varchar(255) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('1','0') NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `neo_media`
--

INSERT INTO `neo_media` (`id`, `type`, `name`, `image_thumb`, `image_thumb1`, `add_date`, `update_date`, `status`, `user_id`, `device_id`) VALUES
(1, 'jpg', '15174017511024x1024-ipad.jpg', 'b546596a10349808d27bfa60057a2813.jpg', 'b546596a10349808d27bfa60057a2813.jpg', '2018-02-02 04:52:54', '0000-00-00 00:00:00', '0', 1, 'f12a46c562103947'),
(2, 'jpeg', '1517468420pexels-photo-543226.jpeg', '9b9aceb4dcb1e187358724bbf0ebf7ab.jpeg', '9b9aceb4dcb1e187358724bbf0ebf7ab.jpeg', '2018-02-02 04:52:58', '0000-00-00 00:00:00', '0', 1, 'f12a46c562103947'),
(3, 'jpg', '15175464281024x1024-ipad.jpg', '10f0e49ac9a8ebaa31fb3e0a37937534.jpg', '10f0e49ac9a8ebaa31fb3e0a37937534.jpg', '2018-02-02 04:53:02', '0000-00-00 00:00:00', '0', 1, 'f12a46c562103947'),
(4, 'jpg', '15175466831024x1024-ipad.jpg', '0245ec3ddcdc54db1cda137d8c422490.jpg', '0245ec3ddcdc54db1cda137d8c422490.jpg', '2018-02-02 04:53:07', '0000-00-00 00:00:00', '0', 1, 'f12a46c562103947'),
(5, 'jpg', '15175472221024x1024-ipad.jpg', '427aa954df541cc2fc48479a48ef0d36.jpg', '427aa954df541cc2fc48479a48ef0d36.jpg', '2018-02-02 04:53:51', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(6, 'jpeg', '1517547439pexels-photo-543226.jpeg', '89337a2cc86855865d4a44df31c87dc8.jpeg', '89337a2cc86855865d4a44df31c87dc8.jpeg', '2018-02-02 04:57:32', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(7, 'jpg', '15175476331024x1024-ipad.jpg', 'b671a92bd8ae2015281ae2c656b2be30.jpg', 'b671a92bd8ae2015281ae2c656b2be30.jpg', '2018-02-02 05:00:39', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(8, 'jpg', '1517549961maxresdefault.jpg', '4546045626cd56aa69e9931b782ca185.jpg', '4546045626cd56aa69e9931b782ca185.jpg', '2018-02-02 05:39:27', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(9, 'png', '1517551500splash_screen_1.png', '4546045626cd56aa69e9931b782ca185.jpg', '4546045626cd56aa69e9931b782ca185.jpg', '2018-02-02 06:05:07', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(10, 'png', '1517551540splash_screen_1.png', '4546045626cd56aa69e9931b782ca185.jpg', '4546045626cd56aa69e9931b782ca185.jpg', '2018-02-02 06:05:51', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(11, 'png', '1517551578splash_screen_1.png', '4546045626cd56aa69e9931b782ca185.jpg', '4546045626cd56aa69e9931b782ca185.jpg', '2018-02-02 06:06:23', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(12, 'png', '1517551643splash_screen_1.png', '4546045626cd56aa69e9931b782ca185.jpg', '4546045626cd56aa69e9931b782ca185.jpg', '2018-02-02 06:07:28', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(13, 'png', '1517551680banner.png', '4546045626cd56aa69e9931b782ca185.jpg', '4546045626cd56aa69e9931b782ca185.jpg', '2018-02-02 06:08:05', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(14, 'jpg', '1517551697maxresdefault.jpg', 'fb5e2cffb14d93116018d831b8e89a96.jpg', 'fb5e2cffb14d93116018d831b8e89a96.jpg', '2018-02-02 12:07:12', '0000-00-00 00:00:00', '0', 1, 'f12a46c562103947'),
(15, 'jpg', '1517552279child-children-girl-happy (1).jpg', '80c5a193aa63c907813f966aba23dbaf.jpg', '80c5a193aa63c907813f966aba23dbaf.jpg', '2018-02-02 12:01:10', '0000-00-00 00:00:00', '0', 1, 'f12a46c562103947'),
(16, 'png', '1517552316splash_screen_1.png', '80c5a193aa63c907813f966aba23dbaf.jpg', '80c5a193aa63c907813f966aba23dbaf.jpg', '2018-02-02 06:18:45', '0000-00-00 00:00:00', '1', 1, 'f12a46c562103947'),
(17, 'png', '1517552375splash_screen_1.png', '80c5a193aa63c907813f966aba23dbaf.jpg', '80c5a193aa63c907813f966aba23dbaf.jpg', '2018-02-02 09:51:34', '0000-00-00 00:00:00', '0', 1, 'f12a46c562103947');

-- --------------------------------------------------------

--
-- Table structure for table `neo_message`
--

CREATE TABLE `neo_message` (
  `msg_id` int(11) NOT NULL,
  `sent_user_id` int(11) NOT NULL,
  `received_user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `currentdate` date NOT NULL,
  `currenttime` time NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `neo_message`
--

INSERT INTO `neo_message` (`msg_id`, `sent_user_id`, `received_user_id`, `content`, `updated_date`, `created_date`, `currentdate`, `currenttime`, `status`) VALUES
(1, 1, 2, 'hi', '2018-02-01 10:22:59', '2018-01-31 06:24:49', '2018-01-31', '06:08:16', '1'),
(2, 1, 3, 'hi', '2018-02-01 10:23:09', '2018-01-31 09:03:27', '2018-01-31', '00:00:00', '1'),
(3, 1, 2, 'hi', '2018-02-01 10:23:15', '2018-01-31 18:56:39', '2018-02-01', '00:00:00', '1'),
(4, 1, 2, 'how r u?', '2018-02-01 10:23:23', '2018-01-31 22:34:58', '2018-02-01', '00:00:00', '1'),
(5, 1, 2, 'I am fine ', '2018-02-01 10:23:30', '2018-01-31 22:38:53', '2018-02-01', '00:00:00', '1'),
(6, 1, 2, 'hi', '2018-02-01 10:23:35', '2018-01-31 22:39:03', '2018-02-01', '00:00:00', '1'),
(7, 1, 2, 'hello', '2018-02-01 10:23:41', '2018-01-31 22:39:10', '2018-02-01', '00:00:00', '1'),
(8, 1, 2, 'hello', '2018-02-01 10:23:55', '2018-01-30 10:16:34', '2018-01-30', '00:00:00', '1'),
(9, 3, 1, 'hello', '2018-02-01 11:10:57', '2018-01-31 23:40:57', '2018-02-01', '05:10:57', '1'),
(10, 3, 1, 'I am fine', '2018-02-01 11:11:08', '2018-01-31 23:41:08', '2018-02-01', '05:11:08', '1'),
(11, 3, 1, 'what is u\ns problem?', '2018-02-01 11:11:34', '2018-01-31 23:41:34', '2018-02-01', '05:11:34', '1'),
(12, 1, 3, 'No Thank you', '2018-02-01 11:11:49', '2018-01-31 23:41:49', '2018-02-01', '05:11:49', '1'),
(13, 2, 1, 'No Thank you', '2018-02-01 11:17:48', '2018-01-31 23:47:48', '2018-02-01', '05:17:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `neo_user`
--

CREATE TABLE `neo_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `device_id` varchar(250) NOT NULL,
  `deviceToken` varchar(255) NOT NULL,
  `appVersion` int(11) NOT NULL,
  `osVersion` varchar(255) NOT NULL,
  `device_name` varchar(250) NOT NULL,
  `span_chat` varchar(250) NOT NULL,
  `facebook_liveid` varchar(250) NOT NULL,
  `twitter_id` varchar(250) NOT NULL,
  `Instagram_id` varchar(250) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('1','0') NOT NULL,
  `reset_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `neo_user`
--

INSERT INTO `neo_user` (`id`, `username`, `user_password`, `email`, `address`, `device_id`, `deviceToken`, `appVersion`, `osVersion`, `device_name`, `span_chat`, `facebook_liveid`, `twitter_id`, `Instagram_id`, `updated_date`, `created_date`, `status`, `reset_url`) VALUES
(1, '', '827ccb0eea8a706c4c34a16891f84e7b', 'anu@yopmail.com', '', '', '5D1CEE6B-77D3-444E-8B33-CB8589CD3352', 1, '11.2.1', '', '', '', '', '', '2018-01-29 15:55:24', '2018-01-29 04:53:19', '1', ''),
(2, '', '827ccb0eea8a706c4c34a16891f84e7b', 'aniket.bharambe@codaemonsoftwares.com', '', '', '5D1CEE6B-77D3-444E-8B33-CB8589CD3352', 1, '11.2.1', '', '', '', '', '', '2018-01-29 11:40:18', '2018-01-29 05:27:14', '1', ''),
(3, '', '827ccb0eea8a706c4c34a16891f84e7b', 'prashant.koli@codaemonsoftwares.com', '', '', '5D1CEE6B-77D3-444E-8B33-CB8589CD3352', 1, '11.2.1', '', '', '', '', '', '2018-01-29 16:13:39', '2018-01-29 05:45:04', '1', ''),
(4, '', '827ccb0eea8a706c4c34a16891f84e7b', 'atindrabiswas@gmail.com', '', '', 'DeviceToekn', 1, '7.1.2', '', '', '', '', '', '2018-01-29 13:17:16', '2018-01-29 06:45:34', '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `neo_device`
--
ALTER TABLE `neo_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neo_favorite`
--
ALTER TABLE `neo_favorite`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `neo_feedback`
--
ALTER TABLE `neo_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neo_media`
--
ALTER TABLE `neo_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `neo_message`
--
ALTER TABLE `neo_message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `neo_user`
--
ALTER TABLE `neo_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `neo_device`
--
ALTER TABLE `neo_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `neo_favorite`
--
ALTER TABLE `neo_favorite`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `neo_feedback`
--
ALTER TABLE `neo_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `neo_media`
--
ALTER TABLE `neo_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `neo_message`
--
ALTER TABLE `neo_message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `neo_user`
--
ALTER TABLE `neo_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
