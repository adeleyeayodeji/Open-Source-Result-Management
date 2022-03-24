-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2021 at 09:16 AM
-- Server version: 5.7.31-log
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(1000) DEFAULT NULL,
  `role` varchar(1000) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `passport` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `role`, `email`, `username`, `password`, `user_token`, `date`, `ip`, `mobile`, `passport`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '2021-01-13 15:08:14', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jssbilling`
--

DROP TABLE IF EXISTS `jssbilling`;
CREATE TABLE IF NOT EXISTS `jssbilling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newintake` varchar(1000) DEFAULT NULL,
  `termly` varchar(1000) DEFAULT NULL,
  `jss3` varchar(1000) DEFAULT NULL,
  `NewIntakeJSS3` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10000) DEFAULT NULL,
  `description` text,
  `logo` varchar(1000) DEFAULT NULL,
  `siteback` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `logo`, `siteback`) VALUES
(1, 'Resut', 'Result Management', 'p.png', 'maxfemcollege.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sssbilling`
--

DROP TABLE IF EXISTS `sssbilling`;
CREATE TABLE IF NOT EXISTS `sssbilling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newintakeart` varchar(1000) DEFAULT NULL,
  `newintakescience` varchar(1000) DEFAULT NULL,
  `termlyartcomm` varchar(1000) DEFAULT NULL,
  `termlyscience` varchar(1000) DEFAULT NULL,
  `sss3artcomm` varchar(1000) DEFAULT NULL,
  `sss3science` varchar(1000) DEFAULT NULL,
  `NewIntakeSSS3Art` varchar(1000) DEFAULT NULL,
  `NewIntakeSSS3Science` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students_data`
--

DROP TABLE IF EXISTS `students_data`;
CREATE TABLE IF NOT EXISTS `students_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(10000) NOT NULL,
  `uiid` mediumtext NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `status` varchar(10000) NOT NULL,
  `full_name` varchar(10000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `dob` varchar(10000) NOT NULL,
  `age` varchar(1000) NOT NULL,
  `sex` varchar(1000) NOT NULL,
  `address` varchar(10000) NOT NULL,
  `nationality` varchar(150) NOT NULL,
  `state` varchar(50) NOT NULL,
  `lga` varchar(50) NOT NULL,
  `home_town` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `prev_school` varchar(100) NOT NULL,
  `prev_school_date_attended` varchar(100) NOT NULL,
  `prev_school_class_read` varchar(100) NOT NULL,
  `prev_school_reasonforleaving` varchar(100) NOT NULL,
  `father_full_name` varchar(100) NOT NULL,
  `father_address` varchar(100) NOT NULL,
  `father_occupation` varchar(100) NOT NULL,
  `father_office_address` varchar(100) NOT NULL,
  `father_email` varchar(100) NOT NULL,
  `father_mobile` varchar(100) NOT NULL,
  `mother_full_name` varchar(100) NOT NULL,
  `mother_address` varchar(100) NOT NULL,
  `mother_occupation` varchar(100) NOT NULL,
  `mother_office_address` varchar(100) NOT NULL,
  `mother_email` varchar(100) NOT NULL,
  `mother_mobile` varchar(100) NOT NULL,
  `passport` varchar(10000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `smsto` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

DROP TABLE IF EXISTS `tblclasses`;
CREATE TABLE IF NOT EXISTS `tblclasses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int(4) NOT NULL,
  `Section` varchar(10000) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `person_name_and_idx` (`ClassName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

DROP TABLE IF EXISTS `tbldepartments`;
CREATE TABLE IF NOT EXISTS `tbldepartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentName` varchar(10000) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `person_name_and_idx` (`DepartmentName`(3072))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpin`
--

DROP TABLE IF EXISTS `tblpin`;
CREATE TABLE IF NOT EXISTS `tblpin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pin` varchar(1000) DEFAULT NULL,
  `keytext` varchar(1000) DEFAULT NULL,
  `student_id` int(251) DEFAULT NULL,
  `rem` int(251) DEFAULT '5',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

DROP TABLE IF EXISTS `tblresult`;
CREATE TABLE IF NOT EXISTS `tblresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `Status` varchar(1000) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `revision_` int(250) DEFAULT '0',
  `adminstatus` int(250) DEFAULT '0',
  `marks` int(11) DEFAULT NULL,
  `tmarks` varchar(1000) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `term` varchar(10000) DEFAULT NULL,
  `year` varchar(10000) DEFAULT NULL,
  `Department` varchar(10000) DEFAULT NULL,
  `daysschool` varchar(1000) DEFAULT NULL,
  `dayspresent` varchar(1000) DEFAULT NULL,
  `daysabsence` varchar(1000) DEFAULT NULL,
  `termbegin` varchar(1000) DEFAULT NULL,
  `termends` varchar(1000) DEFAULT NULL,
  `termnext` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `result_StudentId_and_ClassId` (`StudentId`,`ClassId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

DROP TABLE IF EXISTS `tblstudents`;
CREATE TABLE IF NOT EXISTS `tblstudents` (
  `StudentId` int(11) NOT NULL AUTO_INCREMENT,
  `StudentName` varchar(100) NOT NULL,
  `classtype` varchar(1000) DEFAULT NULL,
  `session` varchar(1000) DEFAULT NULL,
  `logo` varchar(10000) DEFAULT NULL,
  `RollId` varchar(100) NOT NULL,
  `StudentEmail` varchar(100) NOT NULL,
  `mobile` varchar(1000) DEFAULT NULL,
  `Gender` varchar(10) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `ClassId` varchar(1000) DEFAULT NULL,
  `user_token` varchar(1000) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Status` int(1) NOT NULL,
  `Departments` mediumtext,
  `password` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`StudentId`),
  KEY `person_StudentId_and_StudentName` (`StudentName`,`StudentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination`
--

DROP TABLE IF EXISTS `tblsubjectcombination`;
CREATE TABLE IF NOT EXISTS `tblsubjectcombination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `person_name_and_idx` (`ClassId`,`SubjectId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

DROP TABLE IF EXISTS `tblsubjects`;
CREATE TABLE IF NOT EXISTS `tblsubjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) NOT NULL,
  `Creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `person_name_and_idx` (`SubjectName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) NOT NULL,
  `pic` varchar(10000) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `classid` int(100) DEFAULT NULL,
  `mobileNo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(100) DEFAULT NULL,
  `studentid` int(100) DEFAULT NULL,
  `fullname` varchar(10000) DEFAULT NULL,
  `amount` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionref` varchar(10000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
