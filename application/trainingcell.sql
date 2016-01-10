-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 10, 2016 at 09:40 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainingcell`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `catid` int(11) NOT NULL,
  `tccid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `tccid`, `name`, `type`) VALUES
(1, 1, 'testcat', 1),
(2, 1, 'testcat1', 2),
(3, 1, 'testcat2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `cid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`cid`, `name`) VALUES
(1, 'Computer Science A'),
(2, 'Electronics B');

-- --------------------------------------------------------

--
-- Table structure for table `quizquestions`
--

CREATE TABLE IF NOT EXISTS `quizquestions` (
  `qqid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `option1` varchar(200) NOT NULL,
  `option2` varchar(200) NOT NULL,
  `option3` varchar(200) NOT NULL,
  `option4` varchar(200) NOT NULL,
  `ans` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quizquestions`
--

INSERT INTO `quizquestions` (`qqid`, `tid`, `question`, `description`, `option1`, `option2`, `option3`, `option4`, `ans`) VALUES
(1, 2, 'Question 1', NULL, 'Option 1', 'Option 2', 'Option 3', 'Option 4', 4),
(2, 2, 'Question 2', NULL, 'Option 1', 'Option 2', 'Option 3', 'Option 4', 4),
(3, 3, 'test question', 'sdasbjd', 'sd jasb', 'jsdjasd', 'ashbdasd', 'sdbhashbh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `rid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `attempted` int(11) NOT NULL,
  `missed` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`rid`, `tid`, `uid`, `attempted`, `missed`, `correct`, `wrong`, `score`) VALUES
(1, 2, 2, 2, 0, 1, 1, 1),
(2, 3, 2, 1, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `superman`
--

CREATE TABLE IF NOT EXISTS `superman` (
  `smid` int(11) NOT NULL,
  `emailid` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superman`
--

INSERT INTO `superman` (`smid`, `emailid`, `password`, `name`, `token`) VALUES
(1, 'admin@tc.com', 'password', 'Admin SuperMan', 'cdsjv3e8gebcdcqwkndas83');

-- --------------------------------------------------------

--
-- Table structure for table `tcc`
--

CREATE TABLE IF NOT EXISTS `tcc` (
  `toid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `emailid` varchar(40) NOT NULL,
  `password` varchar(42) NOT NULL DEFAULT 'asdf',
  `cid` int(2) NOT NULL,
  `token` varchar(33) NOT NULL DEFAULT 'fsf4csdsfdfh465t4rcw'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tcc`
--

INSERT INTO `tcc` (`toid`, `name`, `emailid`, `password`, `cid`, `token`) VALUES
(1, 'AJMAL', 'ajmalazeez007@gmail.com', 'asdf', 1, 'fsf4csdsfdfh465t4rcw'),
(2, 'Test User', 'test123@ymail.com', 'passwprd', 1, 'a2UsyiEz9TJuMekA');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `tid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `startdate` varchar(16) NOT NULL,
  `enddate` varchar(16) NOT NULL,
  `duration` int(11) NOT NULL,
  `maxattempt` int(11) NOT NULL,
  `passperc` int(11) NOT NULL,
  `viewans` int(11) NOT NULL DEFAULT '1',
  `corscore` int(11) NOT NULL,
  `incorscore` int(11) NOT NULL,
  `testtype` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`tid`, `classid`, `name`, `startdate`, `enddate`, `duration`, `maxattempt`, `passperc`, `viewans`, `corscore`, `incorscore`, `testtype`) VALUES
(2, 1, 'Test test1', '	1452325618', '1451803618', 60, 1, 60, 1, 1, 0, 1),
(3, 1, 'Test test', '1451717218', '1451803618', 60, 1, 60, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `testcategory`
--

CREATE TABLE IF NOT EXISTS `testcategory` (
  `tcatid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `catid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testcategory`
--

INSERT INTO `testcategory` (`tcatid`, `tid`, `catid`) VALUES
(3, 2, 2),
(4, 2, 3),
(5, 3, 2),
(6, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `password` varchar(42) NOT NULL,
  `cid` int(11) NOT NULL,
  `token` varchar(32) NOT NULL DEFAULT 'dsfchsdmce783ydhbjqdhbd'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `emailid`, `password`, `cid`, `token`) VALUES
(2, 'Ajmal Azeez', 'ajmalazeez007@gmail.com', 'fa9e5e18008f9a787866e81b122d174f95bc65f4', 1, '5B4ZtTlGwRQxNEA2'),
(3, 'Test test', 'test@test.ds', 'fa9e5e18008f9a787866e81b122d174f95bc65f4', 2, 'hkjOQ0o2bcSgJxDM');

-- --------------------------------------------------------

--
-- Table structure for table `user_list`
--

CREATE TABLE IF NOT EXISTS `user_list` (
  `ulid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_list`
--

INSERT INTO `user_list` (`ulid`, `catid`, `uid`) VALUES
(1, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `quizquestions`
--
ALTER TABLE `quizquestions`
  ADD PRIMARY KEY (`qqid`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `superman`
--
ALTER TABLE `superman`
  ADD PRIMARY KEY (`smid`),
  ADD UNIQUE KEY `emailid` (`emailid`);

--
-- Indexes for table `tcc`
--
ALTER TABLE `tcc`
  ADD PRIMARY KEY (`toid`),
  ADD UNIQUE KEY `emailid` (`emailid`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `testcategory`
--
ALTER TABLE `testcategory`
  ADD PRIMARY KEY (`tcatid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`ulid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `quizquestions`
--
ALTER TABLE `quizquestions`
  MODIFY `qqid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `superman`
--
ALTER TABLE `superman`
  MODIFY `smid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tcc`
--
ALTER TABLE `tcc`
  MODIFY `toid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `testcategory`
--
ALTER TABLE `testcategory`
  MODIFY `tcatid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_list`
--
ALTER TABLE `user_list`
  MODIFY `ulid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
