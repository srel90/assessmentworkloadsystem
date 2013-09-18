-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2013 at 03:57 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assessmentworkloadsystem`
--
CREATE DATABASE IF NOT EXISTS `assessmentworkloadsystem` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `assessmentworkloadsystem`;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `facultyID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสคณะ/สถาบัน',
  `faculty` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'คณะ/สถาบัน',
  `status` int(11) NOT NULL COMMENT 'สถานะ',
  PRIMARY KEY (`facultyID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facultyID`, `faculty`, `status`) VALUES
(1, 'วิทยาการจัดการ', 1),
(2, '', 0),
(3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `otherworkgroup`
--

DROP TABLE IF EXISTS `otherworkgroup`;
CREATE TABLE IF NOT EXISTS `otherworkgroup` (
  `otherWorkgroupID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกลุ่มงานอื่นๆ',
  `otherWorkgroupType` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทงาน',
  `otherWorkgroup` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'กิจกรรม',
  `otherWorkgroupWorkloadID` int(11) NOT NULL COMMENT 'รหัสภาระงาน',
  `otherWorkgroupSubject` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อเรื่อง/โครงการ',
  `otherWorkgroupTime` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'วัน/เวลา',
  `otherWorkgroupHours` float NOT NULL COMMENT 'ชั่วโมง',
  PRIMARY KEY (`otherWorkgroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `otherworkgroup`
--

INSERT INTO `otherworkgroup` (`otherWorkgroupID`, `otherWorkgroupType`, `otherWorkgroup`, `otherWorkgroupWorkloadID`, `otherWorkgroupSubject`, `otherWorkgroupTime`, `otherWorkgroupHours`) VALUES
(13, '1', 'กรรมการส่งเสริมกิจการมหาวิทยาลัย', 1, 'คำสั่งมหาวิทยาลัย', '', 3),
(14, '2', 'กรรมการประจำหลักสูตร', 1, 'คำสั่งมหาวิทยาลัย', '', 1.5),
(15, '3', 'กรรมการประจำคณะ', 1, 'คำสั่งมหาวิทยาลัย', '', 1.5),
(16, '4', '', 1, 'คำสั่ง', '', 0.25),
(17, '4', '', 1, 'คำสั่ง', '', 0.25),
(18, '4', '', 1, 'คำสั่ง', '', 1),
(19, '4', '', 1, 'คำสั่ง', '', 0.25),
(20, '5', '', 1, 'คำสั่ง', '', 0.25),
(21, '5', '', 1, 'คำสั่ง', '', 0.25),
(22, '5', '', 1, 'คำสั่ง', '', 0.25),
(23, '5', '', 1, 'คำสั่ง', '', 0.25),
(24, '5', '', 1, 'คำสั่ง', '', 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `researchingworkgroup`
--

DROP TABLE IF EXISTS `researchingworkgroup`;
CREATE TABLE IF NOT EXISTS `researchingworkgroup` (
  `researchingWorkgroupID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกลุ่มงานวิจัย',
  `researchingWorkgroupType` int(11) NOT NULL COMMENT 'ประเภทงาน',
  `researchingWorkgroup` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'กิจกรรม',
  `researchingWorkgroupWorkloadID` int(11) NOT NULL COMMENT 'รหัสภาระงาน',
  `researchingWorkgroupSubject` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อเรื่อง/กิจกรรม',
  `researchingWorkgroupPeriod` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระยะเวลา',
  `researchingWorkgroupHours` float NOT NULL COMMENT 'ชั่วโมง',
  `researchingWorkgroupProportion` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สัดส่วน',
  PRIMARY KEY (`researchingWorkgroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `researchingworkgroup`
--

INSERT INTO `researchingworkgroup` (`researchingWorkgroupID`, `researchingWorkgroupType`, `researchingWorkgroup`, `researchingWorkgroupWorkloadID`, `researchingWorkgroupSubject`, `researchingWorkgroupPeriod`, `researchingWorkgroupHours`, `researchingWorkgroupProportion`) VALUES
(5, 1, 'งบประมาณรายได้', 1, 'วิจัยในชั้นเรียน เรื่องความพึงพอใจของ', '1 ปี', 7, '100'),
(6, 1, 'งบประมาณรายได้', 1, 'การศึกษาความพึงพอใจ', '1 ปี', 2.3, '33'),
(7, 1, 'งบประมาณรายได้', 1, 'การประเมินหลักสูตร', '1 ปี', 0.8, '11'),
(8, 2, 'เอกสารประกอบการสอน', 1, 'เอกสารประกอบการสอนรายวิชา BCOM 3501', '1 ปี', 4, '50');

-- --------------------------------------------------------

--
-- Table structure for table `servicesworkgroup`
--

DROP TABLE IF EXISTS `servicesworkgroup`;
CREATE TABLE IF NOT EXISTS `servicesworkgroup` (
  `servicesWorkgroupID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกลุ่มงานบริการวิชาการ',
  `servicesWorkgroupType` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทงาน',
  `servicesWorkgroup` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'กิจกรรม',
  `servicesWorkgroupWorkloadID` int(11) NOT NULL COMMENT 'รหัสภาระงาน',
  `servicesWorkgroupSubject` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อเรื่อง/โครงการ',
  `servicesWorkgroupTime` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'วัน/เวลา',
  `servicesWorkgroupHours` float NOT NULL COMMENT 'ชั่วโมง',
  PRIMARY KEY (`servicesWorkgroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `servicesworkgroup`
--

INSERT INTO `servicesworkgroup` (`servicesWorkgroupID`, `servicesWorkgroupType`, `servicesWorkgroup`, `servicesWorkgroupWorkloadID`, `servicesWorkgroupSubject`, `servicesWorkgroupTime`, `servicesWorkgroupHours`) VALUES
(5, '1', 'กรรมการวิชาการพัฒนาหลักสูตร', 1, 'การปรับปรุง', '', 1.5),
(6, '2', 'การอบรมบุคคลภายนอก', 1, 'การใช้โปรแกรม photoshop', '6 ชั่วโมง', 6),
(7, '3', 'คณะกรรมการตรวจประเมิน', 1, 'การประเมินคุณภาพ', '6 ชั่วโมง', 3),
(8, '3', 'คณะกรรมการตรวจประเมิน', 1, 'การประเมินความพร้อม', '6 ชั่วโมง', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teachingworkgroup`
--

DROP TABLE IF EXISTS `teachingworkgroup`;
CREATE TABLE IF NOT EXISTS `teachingworkgroup` (
  `teachingWorkgroupID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสกลุ่มงานสอน',
  `teachingWorkgroupType` int(11) NOT NULL COMMENT 'รหัสประเภทกลุ่มงานสอน',
  `teachingWorkgroup` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `teachingWorkgroupWorkloadID` int(11) NOT NULL COMMENT 'รหัสภาระงาน',
  `teachingWorkgroupCode` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัส',
  `teachingWorkgroupNumberOfStudents` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'จำนวนนักศึกษา',
  `teachingWorkgroupSubject` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รายวิชา/หลักสูตร/สาขาวิชา',
  `teachingWorkgroupHours` float NOT NULL COMMENT 'ชั่วโมง',
  `teachingWorkgroupProportion` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สัดส่วน',
  PRIMARY KEY (`teachingWorkgroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `teachingworkgroup`
--

INSERT INTO `teachingworkgroup` (`teachingWorkgroupID`, `teachingWorkgroupType`, `teachingWorkgroup`, `teachingWorkgroupWorkloadID`, `teachingWorkgroupCode`, `teachingWorkgroupNumberOfStudents`, `teachingWorkgroupSubject`, `teachingWorkgroupHours`, `teachingWorkgroupProportion`) VALUES
(8, 1, 'วิชาที่ 1', 1, 'BCOM 3201', '0', 'การจัดการระบบสารสนเทศเพื่อธุรกิจ', 11.25, '50'),
(9, 1, 'วิชาที่ 2', 1, 'BCOM 3501', '0', 'การจัดการธุรกรรมอิเล็กทรอนิกส์', 11.25, '50'),
(10, 3, 'วิชาการ', 1, '', '0', 'สาขาคอมพิวเตอร์ธุรกิจ', 2.5, ''),
(11, 3, 'กิจกรรม', 1, '', '0', 'ชุมนุม BCOM NETWORK', 2.5, ''),
(12, 4, 'เตรียมฝึกประสบการณ์วิชาชีพ', 1, '', '31', 'สาขาคอมพิวเตอร์ธุรกิจ', 7.8, ''),
(13, 4, 'นักศึกษาฝึกประสบการณืวิชาชีพ', 1, '', '4', 'สาขาคอมพิวเตอร์ธุรกิจ', 4, ''),
(14, 5, 'การประสานงานรายวิชา', 1, '', '0', 'การจัดการระบบสารสนเทศเพื่อธุรกิจ', 0.5, '');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

DROP TABLE IF EXISTS `userrole`;
CREATE TABLE IF NOT EXISTS `userrole` (
  `userRoleID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสิทธิ์',
  `userTypeID` int(11) NOT NULL COMMENT 'รหัสประเภทผู้ใช้',
  `userRole` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สิทธิ์',
  `status` int(11) NOT NULL COMMENT 'สถานะ',
  PRIMARY KEY (`userRoleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`userRoleID`, `userTypeID`, `userRole`, `status`) VALUES
(1, 1, '*', 1),
(2, 2, 'workload.php', 1),
(3, 2, 'workload1.php', 1),
(4, 2, 'workload2.php', 1),
(5, 2, 'profile.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับ',
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสผู้ใช้',
  `mentorID` int(11) NOT NULL COMMENT 'รหัสพี่เลี้ยง',
  `IDCard` varchar(13) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสประจำตัวประชาชน',
  `userTypeID` int(11) NOT NULL COMMENT 'รหัสประเภทผู้ใช้',
  `firstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อ',
  `lastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'นามสกุล',
  `userStatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะภาพ',
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสผ่าน',
  `dateOfBirth` date NOT NULL COMMENT 'วันเดือนปีเกิด(คำนวณอายุจากวันเดือนปีเกิด)',
  `bachelorDegreeDiscipline` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สาขาวิชาระดับปริญญาตรี',
  `bachelorDegreeInstitution` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถาบันการศึกษาระดับปริญญาตรี',
  `bachelorDegreeGraduate` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ปีที่จบการศึกษาระดับปริญาตรี',
  `mastersDegreeDiscipline` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สาขาวิชาระดับปริญญาโท',
  `mastersDegreeInstitution` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถาบันการศึกษาระดับปริญญาโท',
  `mastersDegreeGraduate` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ปีที่จบการศึกษาระดับปริญาโท',
  `doctorateDegreeDiscipline` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สาขาวิชาระดับปริญญาเอก',
  `doctorateDegreeInstitution` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถาบันการศึกษาระดับปริญญาเอก',
  `doctorateDegreeGraduate` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ปีที่จบการศึกษาระดับปริญาเอก',
  `diplomaDiscipline` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สาขาวิชาระดับวุฒิบัตร',
  `diplomaInstitution` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถาบันการศึกษาระดับวุฒิบัตร',
  `diplomaGraduate` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ปีที่จบการศึกษาระดับวุฒิบัตร',
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ที่อยู่',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อีเมล์',
  `registerDate` date NOT NULL COMMENT 'วันที่เริ่มทำงาน',
  `currentSalary` decimal(13,2) NOT NULL COMMENT 'เงินเดือน',
  `status` int(11) NOT NULL COMMENT 'สถานะ',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `code`, `mentorID`, `IDCard`, `userTypeID`, `firstName`, `lastName`, `userStatus`, `username`, `password`, `dateOfBirth`, `bachelorDegreeDiscipline`, `bachelorDegreeInstitution`, `bachelorDegreeGraduate`, `mastersDegreeDiscipline`, `mastersDegreeInstitution`, `mastersDegreeGraduate`, `doctorateDegreeDiscipline`, `doctorateDegreeInstitution`, `doctorateDegreeGraduate`, `diplomaDiscipline`, `diplomaInstitution`, `diplomaGraduate`, `address`, `phone`, `email`, `registerDate`, `currentSalary`, `status`) VALUES
(1, '00001', 2, '3929800021686', 1, 'วิเลิศวัฒน์', 'หนูแสง', '2', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1983-01-04', 't', 't', 't', 's', 's', 's', 'w', 'w', 'w', 'd', 'd', 'd', '123', '1234567890', 'srel90@gmail.com', '2013-08-13', '0.00', 1),
(2, '0000002', 1, '3929800021686', 2, 'Vilerswat', 'Noosaeng', '1', 'test', '098f6bcd4621d373cade4e832627b4f6', '2013-08-01', '', '', '', '', '', '', '', '', '', '', '', '', '', '66840900050', 'srel90@gmail.com', '2013-08-13', '100000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE IF NOT EXISTS `usertype` (
  `userTypeID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทผู้ใช้',
  `userType` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทผู้ใช้',
  `status` int(11) NOT NULL COMMENT 'สถานะ',
  PRIMARY KEY (`userTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`userTypeID`, `userType`, `status`) VALUES
(1, 'ผู้ดูแลระบบ', 1),
(2, 'อาจารย์', 1),
(3, 'พี่เลี้ยง', 1);

-- --------------------------------------------------------

--
-- Table structure for table `workload`
--

DROP TABLE IF EXISTS `workload`;
CREATE TABLE IF NOT EXISTS `workload` (
  `workloadID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสภาระงาน',
  `userID` int(11) NOT NULL,
  `mentorID` int(11) NOT NULL,
  `facultyID` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสคณะ',
  `semester` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ภาคการศึกษา',
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ปีการศึกษา',
  `teachingWorkgroupStdProportion` float NOT NULL COMMENT 'สัดส่วนมาตรฐานกลุ่มงานสอน',
  `teachingWorkgroupStdHours` float NOT NULL COMMENT 'ชั่วโมงมาตรฐานกลุ่มงานสอน',
  `teachingWorkgroupAgrProportion` float NOT NULL COMMENT 'สัดส่วนตามข้อตกลงกลุ่มงานสอน',
  `teachingWorkgroupAgrHours` float NOT NULL COMMENT 'ชั่วโมงตามข้อตกลงกลุ่มงานสอน',
  `researchingWorkgroupStdProportion` float NOT NULL COMMENT 'สัดส่วนมาตรฐานกลุ่มงานวิจัย',
  `researchingWorkgroupStdHours` float NOT NULL COMMENT 'ชั่วโมงมาตรฐานกลุ่มงานวิจัย',
  `researchingWorkgroupAgrProportion` float NOT NULL COMMENT 'สัดส่วนตามข้อตกลงกลุ่มงานวิจัย',
  `researchingWorkgroupAgrHours` float NOT NULL COMMENT 'ชั่วโมงตามข้อตกลงกลุ่มงานวิจัย',
  `servicesWorkgroupStdProportion` float NOT NULL COMMENT 'สัดส่วนมาตรฐานกลุ่มงานบริการวิชาการ',
  `servicesWorkgroupStdHours` float NOT NULL COMMENT 'ชั่วโมงมาตรฐานกลุ่มงานบริการวิชาการ',
  `servicesWorkgroupAgrProportion` float NOT NULL COMMENT 'สัดส่วนตามข้อตกลงกลุ่มงานบริการวิชาการ',
  `servicesWorkgroupAgrHours` float NOT NULL COMMENT 'ชั่วโมงตามข้อตกลงกลุ่มงานบริการวิชาการ',
  `otherWorkgroupStdProportion` float NOT NULL COMMENT 'สัดส่วนมาตรฐานกลุ่มงานอื่นๆ',
  `otherWorkgroupStdHours` float NOT NULL COMMENT 'ชั่วโมงมาตรฐานกลุ่มงานอื่นๆ',
  `otherWorkgroupAgrProportion` float NOT NULL COMMENT 'สัดส่วนตามข้อตกลงกลุ่มงานอื่นๆ',
  `otherWorkgroupAgrHours` float NOT NULL COMMENT 'ชั่วโมงตามข้อตกลงกลุ่มงานอื่นๆ',
  `remark` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=ยังไม่เสร็จ 1=ส่งตรวจสอบ 2=ปรับปรุง 3=เสร็จเรียบร้อย',
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`workloadID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `workload`
--

INSERT INTO `workload` (`workloadID`, `userID`, `mentorID`, `facultyID`, `semester`, `year`, `teachingWorkgroupStdProportion`, `teachingWorkgroupStdHours`, `teachingWorkgroupAgrProportion`, `teachingWorkgroupAgrHours`, `researchingWorkgroupStdProportion`, `researchingWorkgroupStdHours`, `researchingWorkgroupAgrProportion`, `researchingWorkgroupAgrHours`, `servicesWorkgroupStdProportion`, `servicesWorkgroupStdHours`, `servicesWorkgroupAgrProportion`, `servicesWorkgroupAgrHours`, `otherWorkgroupStdProportion`, `otherWorkgroupStdHours`, `otherWorkgroupAgrProportion`, `otherWorkgroupAgrHours`, `remark`, `status`, `comment`) VALUES
(1, 1, 2, '1', '1', '2554', 50, 20, 50, 39.8, 25, 10, 25, 14.1, 15, 6, 15, 13.5, 10, 4, 10, 9, '', 3, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
