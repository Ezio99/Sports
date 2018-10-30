-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2018 at 12:37 PM
-- Server version: 5.7.22
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `uname` varchar(30) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uname`, `pass`) VALUES
('vaibhav', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `adm_tour_req`
--

CREATE TABLE `adm_tour_req` (
  `tc_id` varchar(5) NOT NULL,
  `t_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `p_id` varchar(5) NOT NULL,
  `uname` varchar(12) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `lname` varchar(30) NOT NULL,
  `gend` varchar(1) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `em` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pin` varchar(6) NOT NULL,
  `football` varchar(12) DEFAULT NULL,
  `cricket` varchar(12) DEFAULT NULL,
  `volleyball` varchar(12) DEFAULT NULL,
  `basketball` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`p_id`, `uname`, `pass`, `fname`, `mname`, `lname`, `gend`, `phno`, `em`, `dob`, `state`, `city`, `pin`, `football`, `cricket`, `volleyball`, `basketball`) VALUES
('PL000', 'Ezio', 'qwerty', 'Vaibhav', '', 'Deb', 'M', '9769535798', 'vaibhavritam@gmail.com', '2018-10-03', 'Maharashtra', 'Mumbai', '400076', 'Football', 'Cricket', 'Volleyball', 'Basketball'),
('PL001', 'avishekD1', 'killerno111', 'Avishek', '', 'Dutta', 'M', '9874618262', 'avishek.dutta.2000@gmail.com', '1999-08-07', 'West Bengal', 'Kolkata', '700008', 'Football', 'Cricket', 'Volleyball', 'Basketball'),
('PL002', 'youngstoney', '12345', 'Akash', '', 'Singh', 'M', '7055603344', 'akash.singh2017b@vitstudent.ac.in', '1998-12-01', 'Uttarakhand', 'Dehradun', '200871', 'Football', 'Cricket', '0', '0'),
('PL003', 'aditya5567', 'yoyo', 'Aditya', '', 'Kaushik', 'M', '9999996680', 'hihelloaditya22@gmail.com', '1999-09-29', 'Uttar Pradesh', 'Noida', '201301', '0', '0', 'Volleyball', 'Basketball'),
('PL005', 'cvbhn', '1234', 'Rahul', '', 'Khan', 'M', '7834921189', 'vaibhavritam@gmail.com', '2018-09-07', 'Maharashtra', 'Mumbai', '400076', 'Football', 'Cricket', '0', 'Basketball'),
('PL006', 'footy', '123', 'ghj', '', 'asd', 'M', '9820400791', 'mrvaibhav.deb2017@vitstudent.ac.in', '2018-10-07', 'Maharashtra', 'Mumbai', '400076', 'Football', 'Cricket', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `player_team`
--

CREATE TABLE `player_team` (
  `p_id` varchar(5) NOT NULL,
  `te_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `player_team`
--

INSERT INTO `player_team` (`p_id`, `te_id`) VALUES
('PL000', 'TE000'),
('PL002', 'TE000'),
('PL000', 'TE001'),
('PL005', 'TE002'),
('PL001', 'TE003'),
('PL006', 'TE004');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `te_id` varchar(5) NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `sport` varchar(20) NOT NULL,
  `cap` varchar(5) NOT NULL,
  `numpl` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`te_id`, `name`, `gender`, `sport`, `cap`, `numpl`) VALUES
('TE000', 'Mumbai Indians', 'M', 'Cricket', 'PL000', 11),
('TE001', 'Manchester United', 'M', 'Football', 'PL000', 23),
('TE002', 'Victory FC', 'M', 'Football', 'PL005', 23),
('TE003', 'Barcelona', 'M', 'Football', 'PL001', 23),
('TE004', 'PSG', 'M', 'Football', 'PL006', 23);

-- --------------------------------------------------------

--
-- Table structure for table `team_req`
--

CREATE TABLE `team_req` (
  `sender` varchar(5) NOT NULL,
  `te_id` varchar(5) NOT NULL,
  `reciever` varchar(5) NOT NULL,
  `sport` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `t_id` varchar(5) NOT NULL,
  `tc_id` varchar(5) NOT NULL,
  `sport` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `name` varchar(70) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `RegS` date NOT NULL,
  `RegE` date NOT NULL,
  `TS` date NOT NULL,
  `TE` date NOT NULL,
  `Address` varchar(1000) NOT NULL,
  `Status` enum('Registrations not begun','Registering','Ongoing','Ended','Registrations Ended') NOT NULL,
  `participation` int(4) NOT NULL,
  `approval` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`t_id`, `tc_id`, `sport`, `city`, `name`, `Gender`, `RegS`, `RegE`, `TS`, `TE`, `Address`, `Status`, `participation`, `approval`) VALUES
('TO000', 'TC000', 'Football', 'Mumbai', 'Some', 'M', '2018-10-23', '2018-10-24', '2018-10-25', '2018-10-26', 'Eternia/Hiranandani Gardens/Powai\r\n1404/A Wing', 'Ended', 20, 'Approved'),
('TO001', 'TC001', 'Cricket', 'Kolkata', 'hsdh', 'M', '2018-10-27', '2018-10-28', '2018-10-29', '2018-10-30', 'fafad', 'Ended', 20, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tour_creator`
--

CREATE TABLE `tour_creator` (
  `tc_id` varchar(5) NOT NULL,
  `uname` varchar(12) NOT NULL,
  `pass` varchar(15) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `lname` varchar(30) NOT NULL,
  `gend` varchar(1) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `em` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tour_creator`
--

INSERT INTO `tour_creator` (`tc_id`, `uname`, `pass`, `fname`, `mname`, `lname`, `gend`, `phno`, `em`, `dob`, `state`, `city`) VALUES
('TC000', 'TOUR', '1234', 'TOUR', '', 'NAMENT', 'M', '9769535798', 'vaibhavritam@gmail.com', '2018-10-02', 'Maharashtra', 'Mumbai'),
('TC001', 'tournament', 'qwerty', 'hello', 'good', 'bye', 'F', '9874618262', 'avishek.dutta.2000@gmail.com', '2018-10-04', 'West Bengal', 'Kolkata'),
('TC003', 'akkus7', '123', 'Akash', '', 'Sing', 'M', '1234567890', 'vaibhavritam@gmail.com', '2018-10-04', 'Rajasthan', 'Jaipur');

-- --------------------------------------------------------

--
-- Table structure for table `tour_req`
--

CREATE TABLE `tour_req` (
  `te_id` varchar(5) NOT NULL,
  `t_id` varchar(5) NOT NULL,
  `tc_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tour_team`
--

CREATE TABLE `tour_team` (
  `t_id` varchar(5) NOT NULL,
  `te_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
