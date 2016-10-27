-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2016 at 01:54 PM
-- Server version: 10.0.27-MariaDB-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `anchorco_ifb299`
--

-- --------------------------------------------------------

--
-- Table structure for table `health`
--
-- Creation: Oct 25, 2016 at 02:56 PM
--

CREATE TABLE IF NOT EXISTS `health` (
  `health_id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `department` varchar(50) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Unresolved',
  `end_date` date DEFAULT NULL,
  `end_time` varchar(10) DEFAULT NULL,
  `resolution` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`health_id`),
  UNIQUE KEY `health_id` (`health_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `health`
--

INSERT INTO `health` (`health_id`, `firstname`, `surname`, `start_date`, `start_time`, `department`, `description`, `status`, `end_date`, `end_time`, `resolution`) VALUES
(3, 'xgonx', 'fsaa', '2016-09-30', '2am', 'Dpt of Astrology', 'dog', 'Resolved', '2016-10-14', '4pm', 'You dingo aye'),
(4, 'comb', 'quicke', '2016-09-26', '3pm', 'Dpt of Astrology', 'problemo', 'Resolved', '2016-10-13', '2am', 'it done'),
(5, 'Star', 'Ffion', '2016-10-21', '8pm', 'Dpt of Astrology', 'Guy died', 'Resolved', '2016-10-22', '9pm', 'fdsfdsfeds'),
(6, 'Star', 'Ffion', '2016-10-22', '11:48pm', 'Dpt of Astrology', 'test case', 'Unresolved', NULL, NULL, NULL),
(7, 'Star', 'Ffion', '2016-10-03', '1am', 'Dpt of Science', 'here', 'Unresolved', NULL, NULL, NULL),
(8, 'test', 'case', '2016-10-22', '8pm', 'Dpt of Astrology', 'dang health', 'Unresolved', NULL, NULL, NULL),
(10, 'Zach', 'IsReal', '0026-10-26', '12:31am', 'Dpt of Astrology', 'Someone insulted my pink bike >:(', 'Resolved', '2016-10-26', '12:44am', 'dw, I locked the bad people away <3\r\nAlso did I mention that your bike looks great !'),
(11, 'John', 'Smith', '2016-10-21', '12:00am', 'Dpt of Astrology', 'stars', 'Unresolved', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permits`
--
-- Creation: Oct 23, 2016 at 09:45 PM
--

CREATE TABLE IF NOT EXISTS `permits` (
  `permit_id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `department` varchar(50) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `vehicle_type` varchar(15) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`permit_id`),
  UNIQUE KEY `permit_id` (`permit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `permits`
--

INSERT INTO `permits` (`permit_id`, `firstname`, `surname`, `email`, `mobile`, `department`, `duration`, `start_date`, `end_date`, `vehicle_type`, `status`) VALUES
(13, 'Alex', 'Griffiths', 'alex@yahoo.com', 467234543, 'Dpt of Time and Space', 'Yearly', '2016-09-30', '2017-09-30', 'Bike', 'Approved'),
(14, 'Alex', 'Griffiths', 'alex@yahoo.com', 467234543, 'Dpt of Time and Space', 'Yearly', '2016-10-15', '2017-10-15', 'Bike', 'Pending'),
(16, 'Alex', 'Griffiths', 'alex@yahoo.com', 467234543, 'Dpt of Astrology', 'Monthly', '2016-10-16', '2016-11-16', 'Car', 'Approved'),
(17, 'Alex', 'Griffiths', 'alex@yahoo.com', 467234543, 'Dpt of Astrology', 'Hourly', '2016-10-08', '2016-10-08', 'Car', 'Pending'),
(18, 'Viss', 'Etor', 'email4', 4, 'Dpt of Astrology', 'Monthly', '2016-10-08', '2016-11-08', 'Car', 'Pending'),
(19, 'Star', 'Ffion', 'email2', 1, 'Dpt of Astrology', 'Yearly', '2016-10-19', '2017-10-19', 'Car', 'Denied'),
(20, 'Star', 'Ffion', 'email2', 1, 'Dpt of Astrology', 'Yearly', '2016-10-16', '2017-10-16', 'Car', 'Denied'),
(21, 'Stu', 'Dentt', 'email3', 3, 'Dpt of Astrology', 'Yearly', '2016-10-05', '2017-10-05', 'Car', 'Approved'),
(22, 'Lana', 'Drah', 'Whyyes@thisemail.com', 2147483647, 'Dpt of Time and Space', 'Monthly', '2001-01-01', '2001-02-01', 'Car', 'Pending'),
(23, 'test', 'case', 'sunshinepotter@ymail.com', 447067432, 'Dpt of Astrology', 'Yearly', '2016-10-08', '2017-10-08', 'Car', 'Approved'),
(24, 'Zach', 'IsReal', 'example@mail.com', 2147483647, 'Dpt of Science', 'Hourly', '2016-10-26', '2016-10-26', 'Bike', 'Approved'),
(25, 'Lana', 'Drah', 'Whyyes@thisemail.com', 2147483647, 'Dpt of Astrology', 'Yearly', '0000-00-00', '1970-12-31', 'Car', 'Pending'),
(26, 'John', 'Smith', 'alexandriagriffiths@yahoo.com.au', 417899401, 'Dpt of Time and Space', 'Monthly', '2016-10-26', '2016-11-26', 'Bike', 'Approved'),
(27, 'Student', 'access', 'SAtest@test.com.au', 411111111, 'Dpt of Science', 'Yearly', '0000-00-00', '2017-06-04', 'Car', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Oct 23, 2016 at 09:45 PM
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `permission` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `user_id_2` (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `surname`, `email`, `mobile`, `permission`, `username`, `password`) VALUES
(1, 'Addy', 'Minnie', 'email', 0, 'admin', 'admin', 'password'),
(2, 'Star', 'Ffion', 'email2', 1, 'staff', 'staff', 'password'),
(3, 'Stu', 'Dentt', 'email3', 3, 'student', 'student', 'password'),
(4, 'Viss', 'Etor', 'email4', 4, 'visitor', 'visitor', 'password'),
(5, 'Patt', 'Role', 'email5', 5, 'patrol', 'patrol', 'password'),
(9, 'etst', 'heyyy', 'lehmail', 9816, 'staff', 'myerrrh', 'password'),
(10, 'Alex', 'Stevens', 'keklord@gmail.com', 1441515151, 'student', 'Keklord', 'fdsfds'),
(11, 'Epic', 'Legend', 'thisistotallyafakeemail@bs.com', 2147483647, 'admin', 'BETATHNY', '116FTW'),
(13, 'Muthu', 'Ramanathan', 'm.ramanathan@qut.edu.au', 0, 'admin', 'mrnathan', '12345678'),
(14, 'Alex', 'Griffiths', 'alex@yahoo.com', 467234543, 'student', 'sutoriku', 'password'),
(15, 'Mike', 'Lee', 'myemail@thisemail.com', 412456789, 'admin', 'oneofakind', '1234'),
(16, 'Lana', 'Drah', 'Whyyes@thisemail.com', 2147483647, 'student', 'Theonlyone', '4321'),
(17, 'Reese', 'Geez', 'saveme@myemail.com', 2147483647, 'patrol', 'theverybest', '3214'),
(24, 'aassd', 'afds', '152', 0, 'admin', 'aaa', 'fdsfdsa'),
(25, 'fdsfdsa', 'sdfds', 'fdsdsdsd', 0, 'admin', 'fdsfds', 'adsffds'),
(26, 'fdsfdsafds', 'dsafdsafds', 'fdsafdsafdsa', 0, 'admin', 'fdsafdsadfs', 'dsafdsafdsf'),
(27, 'test', 'case', 'sunshinepotter@ymail.com', 447067432, 'student', 'studenttest', 'password'),
(28, 'new', 'admin', 'algriffiths1@yahoo.com.au', 0, 'admin', 'admintest', 'password'),
(29, 'Zach', 'IsReal', 'example@mail.com', 2147483647, 'student', 'Pagazz', 'password'),
(30, 'test', 'cas', 'email@thing.com', 2147483647, 'staff', 'newbie', 'password'),
(31, 'John', 'Smith', 'alexandriagriffiths@yahoo.com.au', 417899401, 'staff', 'jsmith', 'password'),
(32, 'Student', 'access', 'SAtest@test.com.au', 411111111, 'student', 'SAtest', 'SAtest123'),
(33, 'Patrol', 'Test', 'PAtest@test.com', 441411414, 'patrol', 'PAtest', 'PAtest1234');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--
-- Creation: Oct 23, 2016 at 09:45 PM
--

CREATE TABLE IF NOT EXISTS `violations` (
  `violation_id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `violation_type` varchar(20) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Unpaid',
  `vehicle_type` varchar(15) DEFAULT NULL,
  `license` int(10) DEFAULT NULL,
  `permit` tinyint(1) DEFAULT NULL,
  `permit_id` int(10) DEFAULT NULL,
  `v_firstname` varchar(20) DEFAULT NULL,
  `v_surname` varchar(20) DEFAULT NULL,
  `v_department` varchar(50) DEFAULT NULL,
  `v_supervisor` varchar(50) DEFAULT NULL,
  `place` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`violation_id`),
  UNIQUE KEY `violation_id` (`violation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`violation_id`, `date`, `time`, `violation_type`, `description`, `status`, `vehicle_type`, `license`, `permit`, `permit_id`, `v_firstname`, `v_surname`, `v_department`, `v_supervisor`, `place`) VALUES
(1, '2016-09-16', '2am', 'Smoking', 'desc', 'Unpaid', NULL, NULL, NULL, NULL, 'aa', 'gg', 'Dpt of Astrology', 'superman', 'bblock'),
(3, '2016-09-14', '2pm', 'Smoking', 'dey be vaping', 'Paid', NULL, NULL, NULL, NULL, 'Star', 'Ffion', 'Dpt of Astrology', 'Addy', 'Lawns'),
(4, '2016-10-08', '2pm', 'Other', 'hanging around', 'Paid', NULL, NULL, NULL, NULL, 'Star', 'Ffion', 'Dpt of Astrology', 'Addy', 'Lawns'),
(5, '2016-10-10', '2pm', 'Smoking', 'more smokes omg', 'Paid', NULL, NULL, NULL, NULL, 'Star', 'Ffion', 'Dpt of Astrology', 'Addy', 'Lawns'),
(6, '2016-10-08', '2pm', 'Other', '2 handsome 5 me', 'Unpaid', NULL, NULL, NULL, NULL, 'Zach', 'IsReal', 'Dpt of Time and Space', 'Alex', 'Gardens Point'),
(9, '2016-10-20', '8pm', 'Parking', 'omg imaginary car is imaginary', 'Unpaid', 'Bike', 567980, 0, 0, 'Zach', 'IsReal', NULL, NULL, NULL),
(10, '2002-02-02', '5am', 'Parking', 'parked in the loading bay', 'Unpaid', 'Car', 321, NULL, 555431, 'Reese', 'Geez', NULL, NULL, NULL),
(11, '2016-10-22', '2pm', 'Parking', 'wow m8', 'Unpaid', 'Car', 5678, NULL, 0, 'test', 'case', NULL, NULL, NULL),
(12, '2016-10-26', '2:00pm', 'Parking', 'Double lines', 'Paid', 'Car', 56778, NULL, 26, 'John', 'Smith', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
