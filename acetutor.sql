-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 22, 2021 at 02:13 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acetutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `CID` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Reason` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`CID`,`SID`,`Date`),
  KEY `SID` (`SID`),
  KEY `CID` (`CID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`CID`, `SID`, `Date`, `Time`, `Status`, `Reason`) VALUES
('C001', 'TP00001', '2021-01-04', '15:00:00', 'Present', ''),
('C001', 'TP00001', '2021-01-11', '15:00:00', 'Present', ''),
('C001', 'TP00001', '2021-01-18', '15:00:00', 'Present', ''),
('C001', 'TP00001', '2021-01-25', '15:00:00', 'Present', ''),
('C001', 'TP00001', '2021-02-08', '15:00:00', 'Present', ''),
('C001', 'TP00001', '2021-02-15', '15:00:00', 'Present', ''),
('C001', 'TP00001', '2021-02-22', '15:00:00', 'Present', ''),
('C001', 'TP00001', '2021-03-01', '15:00:00', 'Present', ''),
('C001', 'TP00001', '2021-03-08', '15:00:00', 'Late', ''),
('C001', 'TP00001', '2021-03-15', '15:00:00', 'Present', NULL),
('C001', 'TP00003', '2021-01-04', '15:00:00', 'Present', ''),
('C001', 'TP00003', '2021-01-11', '15:00:00', 'Absent', ''),
('C001', 'TP00003', '2021-01-18', '15:00:00', 'Present', NULL),
('C001', 'TP00003', '2021-01-25', '15:00:00', 'Present', NULL),
('C001', 'TP00003', '2021-02-08', '15:00:00', 'Present', NULL),
('C001', 'TP00003', '2021-02-15', '15:00:00', 'Late', NULL),
('C001', 'TP00003', '2021-02-22', '15:00:00', 'Present', NULL),
('C001', 'TP00003', '2021-03-01', '15:00:00', 'Present', NULL),
('C001', 'TP00003', '2021-03-08', '15:00:00', 'Present', NULL),
('C001', 'TP00003', '2021-03-15', '15:00:00', 'Absent', NULL),
('C002', 'TP00001', '2021-01-05', '15:00:00', 'Absent with Reason', 'Sick'),
('C002', 'TP00001', '2021-01-12', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-01-19', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-01-26', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-02-02', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-02-09', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-02-16', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-02-23', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-03-02', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-03-09', '15:00:00', 'Present', NULL),
('C002', 'TP00001', '2021-03-16', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-01-05', '15:00:00', 'Present', ''),
('C002', 'TP00003', '2021-01-12', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-01-19', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-01-26', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-02-02', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-02-09', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-02-16', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-02-23', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-03-02', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-03-09', '15:00:00', 'Present', NULL),
('C002', 'TP00003', '2021-03-16', '15:00:00', 'Absent', NULL),
('C003', 'TP00002', '2021-01-06', '15:30:00', 'Late', ''),
('C003', 'TP00002', '2021-01-13', '15:30:00', 'Present', ''),
('C003', 'TP00002', '2021-01-20', '15:30:00', 'Present', NULL),
('C003', 'TP00002', '2021-01-27', '15:30:00', 'Present', NULL),
('C003', 'TP00002', '2021-02-03', '15:30:00', 'Present', NULL),
('C003', 'TP00002', '2021-02-10', '15:30:00', 'Present', NULL),
('C003', 'TP00002', '2021-02-17', '15:30:00', 'Present', NULL),
('C003', 'TP00002', '2021-02-24', '15:30:00', 'Present', NULL),
('C003', 'TP00002', '2021-03-03', '15:30:00', 'Present', NULL),
('C003', 'TP00002', '2021-03-10', '15:30:00', 'Present', NULL),
('C003', 'TP00004', '2021-02-03', '15:30:00', 'Present', ''),
('C003', 'TP00004', '2021-02-10', '15:30:00', 'Present', NULL),
('C003', 'TP00004', '2021-02-17', '15:30:00', 'Present', NULL),
('C003', 'TP00004', '2021-02-24', '15:30:00', 'Present', NULL),
('C003', 'TP00004', '2021-03-03', '15:30:00', 'Present', NULL),
('C003', 'TP00004', '2021-03-10', '15:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-01-05', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-01-12', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-01-19', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-01-26', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-02-02', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-02-09', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-02-16', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-02-23', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-03-02', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-03-09', '17:30:00', 'Present', NULL),
('C004', 'TP00003', '2021-03-16', '17:30:00', 'Present', NULL),
('C005', 'TP00004', '2021-02-04', '16:00:00', 'Present', NULL),
('C005', 'TP00004', '2021-02-11', '16:00:00', 'Present', NULL),
('C005', 'TP00004', '2021-02-18', '16:00:00', 'Present', NULL),
('C005', 'TP00004', '2021-02-25', '16:00:00', 'Present', NULL),
('C005', 'TP00004', '2021-03-04', '16:00:00', 'Present', NULL),
('C005', 'TP00004', '2021-03-11', '16:00:00', 'Present', NULL),
('C005', 'TP00004', '2021-03-18', '16:00:00', 'Absent', NULL),
('C006', 'TP00005', '2021-01-04', '16:30:00', 'Present', NULL),
('C006', 'TP00005', '2021-01-11', '16:30:00', 'Late', NULL),
('C006', 'TP00005', '2021-01-18', '16:30:00', 'Present', NULL),
('C006', 'TP00005', '2021-01-25', '16:30:00', 'Present', NULL),
('C006', 'TP00005', '2021-02-08', '16:30:00', 'Present', NULL),
('C006', 'TP00005', '2021-02-15', '16:30:00', 'Absent', NULL),
('C006', 'TP00005', '2021-02-22', '16:30:00', 'Present', NULL),
('C006', 'TP00005', '2021-03-01', '16:30:00', 'Late', NULL),
('C006', 'TP00005', '2021-03-08', '16:30:00', 'Present', NULL),
('C006', 'TP00005', '2021-03-15', '16:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-01-07', '15:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-01-14', '15:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-01-21', '15:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-01-28', '15:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-02-04', '15:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-02-11', '15:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-02-18', '15:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-02-25', '15:30:00', 'Present', NULL),
('C007', 'TP00005', '2021-03-04', '15:30:00', 'Absent with Reason', 'Sick'),
('C007', 'TP00005', '2021-03-11', '15:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-01-08', '09:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-01-15', '09:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-01-22', '09:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-01-29', '09:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-02-05', '09:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-02-19', '09:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-02-26', '09:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-03-05', '09:30:00', 'Present', NULL),
('C008', 'TP00006', '2021-03-12', '09:30:00', 'Present', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `CID` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Venue` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `JID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OTP` int(3) DEFAULT NULL,
  PRIMARY KEY (`CID`),
  KEY `FID` (`FID`) USING BTREE,
  KEY `JID` (`JID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`CID`, `Date`, `Time`, `Venue`, `FID`, `JID`, `OTP`) VALUES
('C001', '2021-03-22', '15:00:00', 'Room 1', 'ST00001', 'AC05-21', 182),
('C002', '2021-03-23', '15:00:00', 'Room 3', 'ST00002', 'SC05-21', 971),
('C003', '2021-03-24', '15:30:00', 'Room 2', 'ST00002', 'BI04-21', 211),
('C004', '2021-03-23', '17:30:00', 'Room 4', 'ST00001', 'MM05-21', 874),
('C005', '2021-03-25', '16:00:00', 'Room 2', 'ST00002', 'SC04-21', 534),
('C006', '2021-03-22', '16:30:00', 'Room 2', 'ST00003', 'MM03-21', 542),
('C007', '2021-03-25', '15:30:00', 'Room 3', 'ST00003', 'SC03-21', NULL),
('C008', '2021-03-26', '09:30:00', 'Room 1', 'ST00004', 'EN02-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `SID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Parent_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Parent_contact` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Parent_email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Relationship` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`SID`,`Parent_name`),
  KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`SID`, `Parent_name`, `Parent_contact`, `Parent_email`, `Relationship`) VALUES
('TP00001', 'Lee Ba Pa', '012-4567893', 'bapa@gmail.com', 'Father'),
('TP00002', 'Leong Ma Ma', '012-4588888', 'leongmama@gmail.com', 'Mother'),
('TP00003', 'Ahmad', '012-5845695', 'ahmad@yahoo.com', 'Father'),
('TP00004', 'Jane', '012-1234567', 'jane@gmail.com', 'Mother'),
('TP00005', 'Goh Ming Tat', '016-2011454', 'gohmingtat@gmail.com', 'Father'),
('TP00006', 'Chan Moon Siew', '012-4155888', 'moonsiew@yahoo.com', 'Mother'),
('TP00007', 'Leong Guan Liang', '016-2155455', 'guanliang@gmail.com', 'Father');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `FID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IC` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contact` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  `Password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`FID`, `Name`, `Gender`, `IC`, `Contact`, `Email`, `Address`, `DOB`, `Password`) VALUES
('SA99999', 'Admin', '', '', '', 'admin@gmail.com', '', '0000-00-00', 'admin'),
('ST00001', 'John Wong', 'Male', '800705-06-2214', '018-2668319', 'johnwong@gmail.com', 'No.7, Jalan 10, Taman Bintang, 54000 Kuala Lumpur, Malaysia.', '1980-07-05', 'john'),
('ST00002', 'Mary Brown', 'Female', '900419-10-8422', '016-9533245', 'marybrown@yahoo.com', 'No.21, Jalan 12, Taman Jernih, 42000 Kajang, Selangor.', '1990-04-19', 'marybrown'),
('ST00003', 'Siti Nor Aisya binti Abdullah', 'Female', '950510-08-9552', '018-2154211', 'sitinoraisya@gmail.com', 'No.7, Jalan Alam Sutera Utama, Alam Sutera, Bukit Jalil, Kuala Lumpur', '1995-05-10', 'siti'),
('ST00004', 'Kumar a/l Joshua', 'Male', '910630-10-5200', '012-9521002', 'kumar@gmail.com', 'No. 2, Jalan Jalil Muhibbah, Kg Muhibah, Bukit Jalil, Kuala Lumpur', '1991-06-30', 'ST00004');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `SID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IC` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contact` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  `Form` int(1) NOT NULL,
  `Year` int(4) NOT NULL,
  `Password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`SID`, `Name`, `Gender`, `IC`, `Contact`, `Email`, `Address`, `DOB`, `Form`, `Year`, `Password`) VALUES
('TP00001', 'Lee Pei Qi', 'Female', '041007-10-1156', '012-3456789', 'leepeiqi@gmail.com', 'No.7, Jalan 9, Taman Mewah, 43000 Kajang, Selangor.', '2004-10-07', 5, 2021, 'lee'),
('TP00002', 'Leong Zhi Yi', 'Female', '050905-08-6338', '012-4568585', 'zhiyi@yahoo.com', 'No.15, Jalan 5, Taman Orkid, 54000 Kuala Lumpur.', '2005-09-05', 4, 2021, 'zhiyi'),
('TP00003', 'Abu', 'Male', '041013-08-6335', '012-5489635', 'abu@gmail.com', 'No.4, Jalan 15, Taman Mewah, 54000 Kuala Lumpur.', '2004-10-13', 5, 2021, 'TP00003'),
('TP00004', 'Joie Chuah', 'Female', '050110-15-1523', '015-3456956', 'joie@gmail.com', 'No.7, Jalan 7, Taman Mewah, 43000 Kajang, Selangor.', '2005-01-10', 4, 2021, 'joie'),
('TP00005', 'George Goh Choon Hao', 'Male', '060720-10-1474', '016-2544333', 'georgegoh@yahoo.com', 'No.2A, Jalan Jalil Utama 2, Bukit Jalil, 57000 Kuala Lumpur', '2006-07-20', 3, 2021, 'TP00005'),
('TP00006', 'Chon Jinn Hou', 'Male', '071231-10-9520', '012-7195133', 'jinnhou@gmail.com', 'No.10, Jalan 19, Country Heights, 43000 Kajang, Selangor.', '2007-12-31', 2, 2021, 'TP00006'),
('TP00007', 'Leong Xue Min', 'Female', '080412-10-1422', '016-7199833', 'xuemin@gmail.com', 'No.47, Jalan 13, Taman Setia Alam, 42000 Kajang, Selangor.', '2008-04-12', 1, 2021, 'TP00007');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

DROP TABLE IF EXISTS `student_class`;
CREATE TABLE IF NOT EXISTS `student_class` (
  `CID` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`CID`,`SID`),
  KEY `CID` (`CID`) USING BTREE,
  KEY `SID` (`SID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`CID`, `SID`) VALUES
('C001', 'TP00001'),
('C001', 'TP00003'),
('C002', 'TP00001'),
('C002', 'TP00003'),
('C003', 'TP00002'),
('C003', 'TP00004'),
('C004', 'TP00003'),
('C005', 'TP00004'),
('C006', 'TP00005'),
('C007', 'TP00005'),
('C008', 'TP00006');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

DROP TABLE IF EXISTS `student_subject`;
CREATE TABLE IF NOT EXISTS `student_subject` (
  `SID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `JID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`SID`,`JID`),
  KEY `SID` (`SID`) USING BTREE,
  KEY `JID` (`JID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`SID`, `JID`) VALUES
('TP00001', 'AC05-21'),
('TP00001', 'SC05-21'),
('TP00002', 'BI04-21'),
('TP00003', 'AC05-21'),
('TP00003', 'MM05-21'),
('TP00003', 'SC05-21'),
('TP00004', 'BI04-21'),
('TP00004', 'EN04-21'),
('TP00004', 'SC04-21'),
('TP00005', 'MM03-21'),
('TP00005', 'SC03-21'),
('TP00006', 'EN02-21'),
('TP00007', 'EN01-21');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `JID` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Form` int(1) NOT NULL,
  `Year` int(4) NOT NULL,
  PRIMARY KEY (`JID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`JID`, `Name`, `Form`, `Year`) VALUES
('AC04-21', 'Accounting', 4, 2021),
('AC05-21', 'Accounting', 5, 2021),
('AM04-21', 'Add Maths', 4, 2021),
('AM05-21', 'Add Maths', 5, 2021),
('BI04-21', 'Biology', 4, 2021),
('BI05-21', 'Biology', 5, 2021),
('CH04-21', 'Chemistry', 4, 2021),
('CH05-21', 'Chemistry', 5, 2021),
('EN01-21', 'English', 1, 2021),
('EN02-21', 'English', 2, 2021),
('EN03-21', 'English', 3, 2021),
('EN04-21', 'English', 4, 2021),
('EN05-21', 'English', 5, 2021),
('MA01-21', 'Malay', 1, 2021),
('MA02-21', 'Malay', 2, 2021),
('MA03-21', 'Malay', 3, 2021),
('MA04-21', 'Malay', 4, 2021),
('MA05-21', 'Malay', 5, 2021),
('MM01-21', 'Maths', 1, 2021),
('MM02-21', 'Maths', 2, 2021),
('MM03-21', 'Maths', 3, 2021),
('MM04-21', 'Maths', 4, 2021),
('MM05-21', 'Maths', 5, 2021),
('PH04-21', 'Physics', 4, 2021),
('PH05-21', 'Physics', 5, 2021),
('SC01-21', 'Science', 1, 2021),
('SC02-21', 'Science', 2, 2021),
('SC03-21', 'Science', 3, 2021),
('SC04-21', 'Science', 4, 2021),
('SC05-21', 'Science', 5, 2021);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `FK_att_CID` FOREIGN KEY (`CID`) REFERENCES `class` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_att_SID` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `FK_class_FID` FOREIGN KEY (`FID`) REFERENCES `staff` (`FID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_class_JID` FOREIGN KEY (`JID`) REFERENCES `subject` (`JID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `FK_parent_SID` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_class`
--
ALTER TABLE `student_class`
  ADD CONSTRAINT `student_class_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `class` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_class_ibfk_2` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_subject_ibfk_2` FOREIGN KEY (`JID`) REFERENCES `subject` (`JID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
