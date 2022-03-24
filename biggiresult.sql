-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 11, 2021 at 09:01 AM
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
-- Database: `biggiresult`
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
  `user_token` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `passport` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `role`, `email`, `username`, `password`, `user_token`, `date`, `ip`, `mobile`, `passport`) VALUES
(8, 'admin', 'admin', 'adeleyeayodeji12345@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, NULL, NULL);

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
  `address1` longtext,
  `address2` longtext,
  `session` varchar(1000) DEFAULT NULL,
  `term` varchar(1000) DEFAULT NULL,
  `logo` varchar(1000) DEFAULT NULL,
  `siteback` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `address1`, `address2`, `session`, `term`, `logo`, `siteback`) VALUES
(2, 'SMRT Result Management', 'Excellence in Learning and Character ', '2, Awotunde Temidire Street, Off Shogbesan Ave, Moshalasi Bus Stop, Alagbado, Lagos.', '<b>PRIMARY: </b>11, Temidire Street, Off Awolu, Moshalasi Bus Stop, Alagbado, Lagos.', '2020/2021', 'First Term', 'p.png', 'maxfemcollege.jpg');

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
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `Section` varchar(10000) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section`, `CreationDate`, `price`) VALUES
(1, 'SSS 1', NULL, NULL, '2021-08-11 07:52:13', NULL),
(2, 'SSS 2', NULL, NULL, '2021-08-11 07:52:19', NULL);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `CreationDate`, `Updationdate`) VALUES
(1, 'Science', '2021-08-11 07:47:15', '2021-08-11 07:47:15'),
(2, 'Arts', '2021-08-11 07:47:22', '2021-08-11 07:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `tblpin`
--

DROP TABLE IF EXISTS `tblpin`;
CREATE TABLE IF NOT EXISTS `tblpin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pin` varchar(1000) DEFAULT NULL,
  `keytext` longtext,
  `student_id` int(251) DEFAULT NULL,
  `rem` int(251) DEFAULT '5',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpin`
--

INSERT INTO `tblpin` (`id`, `pin`, `keytext`, `student_id`, `rem`, `created_at`, `update_at`) VALUES
(16, 'e40068c3e83b622dcad46b868c5b54cca4b805ca', '2021791628666523169', NULL, 5, '2021-08-11 07:22:03', '2021-08-11 07:22:03'),
(17, '9596df532248dc88074b14b31c9cfda5714e0893', '20211461628670316104', NULL, 5, '2021-08-11 08:25:16', '2021-08-11 08:25:16'),
(18, '578ee49d75d5a247a30c5c6d19d19e78edbb0d78', '20211581628670898286', NULL, 5, '2021-08-11 08:34:58', '2021-08-11 08:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

DROP TABLE IF EXISTS `tblresult`;
CREATE TABLE IF NOT EXISTS `tblresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(1000) DEFAULT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
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
  `revision_` bigint(20) NOT NULL DEFAULT '0',
  `adminstatus` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresult`
--

INSERT INTO `tblresult` (`id`, `Status`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `tmarks`, `PostingDate`, `UpdationDate`, `term`, `year`, `Department`, `daysschool`, `dayspresent`, `daysabsence`, `termbegin`, `termends`, `termnext`, `revision_`, `adminstatus`) VALUES
(1, '1', 1, 1, 2, 50, '30', '2021-08-11 07:58:26', '2021-08-11 08:36:12', 'First Term', '2020/2021', '1', '118', '114', '4', '06/01/21', '06/02/20', '04/04/20', 3, 1),
(2, '1', 1, 1, 3, 60, '20', '2021-08-11 07:58:26', '2021-08-11 08:36:12', 'First Term', '2020/2021', '1', '118', '114', '4', '06/01/21', '06/02/20', '04/04/20', 3, 1);

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
  `ClassId` int(11) NOT NULL,
  `user_token` varchar(1000) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Status` int(1) NOT NULL,
  `Departments` mediumtext,
  `password` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`StudentId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`StudentId`, `StudentName`, `classtype`, `session`, `logo`, `RollId`, `StudentEmail`, `mobile`, `Gender`, `DOB`, `ClassId`, `user_token`, `RegDate`, `UpdationDate`, `Status`, `Departments`, `password`) VALUES
(1, 'Chuks Okwuenu', '1', '2020/2021', '_DSC619gfdf8.JPG', '52698414', 'chuksokwuenu@gmail.com', NULL, 'Male', '2021-08-13', 1, NULL, '2021-08-11 07:53:34', NULL, 1, '1', '21232f297a57a5a743894a0e4a801fc3');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(1, 1, 2, 1, '2021-08-11 07:48:03', '2021-08-11 07:48:03'),
(2, 1, 3, 1, '2021-08-11 07:48:03', '2021-08-11 07:48:03'),
(3, 2, 4, 1, '2021-08-11 07:48:35', '2021-08-11 07:48:35'),
(4, 2, 5, 1, '2021-08-11 07:48:35', '2021-08-11 07:48:35');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(2, 'Maths', '83560', '2021-08-11 07:45:53', '0000-00-00 00:00:00'),
(3, 'English', '10243', '2021-08-11 07:46:03', '0000-00-00 00:00:00'),
(4, 'CRS', '26842', '2021-08-11 07:46:08', '0000-00-00 00:00:00'),
(5, 'IRS', '10787', '2021-08-11 07:46:17', '0000-00-00 00:00:00');

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
