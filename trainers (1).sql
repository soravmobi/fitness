-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2016 at 01:17 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE IF NOT EXISTS `trainers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trainer_name` varchar(100) NOT NULL,
  `trainer_lname` varchar(100) NOT NULL,
  `trainer_email` varchar(100) NOT NULL,
  `trainer_gender` varchar(50) NOT NULL,
  `trainer_age` int(11) NOT NULL,
  `trainer_phone` varchar(100) NOT NULL,
  `trainer_displayName` varchar(100) NOT NULL,
  `trainer_country` int(11) NOT NULL,
  `trainer_state` int(11) NOT NULL,
  `trainer_city` int(11) NOT NULL,
  `trainer_zip` varchar(50) NOT NULL,
  `trainer_password` varchar(100) NOT NULL,
  `trainer_image` varchar(20) NOT NULL,
  `trainer_skills` text NOT NULL,
  `trainer_rating` double NOT NULL,
  `biography` text NOT NULL,
  `certification` text NOT NULL,
  `awards` text NOT NULL,
  `accomplishments` text NOT NULL,
  `location` text NOT NULL,
  `credentials` text NOT NULL,
  `interests_hobby` text NOT NULL,
  `hobby` text NOT NULL,
  `paypal_url` text NOT NULL,
  `paypal_email` varchar(50) NOT NULL,
  `amazon_url` text NOT NULL,
  `amazon_email` varchar(50) NOT NULL,
  `money_order_address` text NOT NULL,
  `trainer_status` int(11) NOT NULL COMMENT '0 = blocked, 1 = unblock',
  `trainer_linkedin` text NOT NULL,
  `trainer_belibitv` text NOT NULL,
  `trainer_facebook` text NOT NULL,
  `trainer_twitter` text NOT NULL,
  `trainer_google` text NOT NULL,
  `trainer_instagram` text NOT NULL,
  `lat` varchar(250) NOT NULL,
  `lng` varchar(250) NOT NULL,
  `trainer_added_date` datetime NOT NULL,
  `trainer_modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `user_id`, `trainer_name`, `trainer_lname`, `trainer_email`, `trainer_gender`, `trainer_age`, `trainer_phone`, `trainer_displayName`, `trainer_country`, `trainer_state`, `trainer_city`, `trainer_zip`, `trainer_password`, `trainer_image`, `trainer_skills`, `trainer_rating`, `biography`, `certification`, `awards`, `accomplishments`, `location`, `credentials`, `interests_hobby`, `hobby`, `paypal_url`, `paypal_email`, `amazon_url`, `amazon_email`, `money_order_address`, `trainer_status`, `trainer_linkedin`, `trainer_belibitv`, `trainer_facebook`, `trainer_twitter`, `trainer_google`, `trainer_instagram`, `lat`, `lng`, `trainer_added_date`, `trainer_modify_date`) VALUES
(2, 62, 'rahul', 'goyal', 'rahul@gmail.com', 'male', 29, '', 'rahulgoyal', 90, 1531, 20749, '452001', '123456', '566e6ec9c0833.jpg', 'Test1,Test2,Test3,Test4,Test5', 3.8, '   Biography', 'Certification   ', '   Awards', '   Accomplishments', ' Location', ' Credentials', ' Interests', ' Hobby', 'https://www.sandbox.paypal.com/cgi-bin/webscr', 'sourav-buyer@mobiwebtech.com', 'https://www.sandbox.amazon.com/cgi-bin/webscr', 'rahul-facilitator@amazon.com', 'You Tag Media & Business Solutions, Inc\r\n1950 Broad Street, Unit 209 Regina, SK S461X6 Canada', 1, 'https://in.linkedin.com/', 'http://virtual.belibitv.com/', 'https://www.facebook.com', 'https://twitter.com/', 'https://www.google.co.in/', 'https://instagram.com/', '', '', '0000-00-00 00:00:00', '2016-04-12 12:30:03'),
(10, 80, 'vikas', 'garg', 'vikas123@gmail.com', 'male', 26, '9632/87411', 'vikas123', 101, 21, 2229, '452001', '123456', 'default.png', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '2016-04-11 13:55:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
