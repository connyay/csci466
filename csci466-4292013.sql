-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2013 at 06:49 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csci466`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `enrollment_cap` int(11) NOT NULL DEFAULT '1',
  `meetingdays` varchar(70) DEFAULT NULL,
  `cost` varchar(10) NOT NULL DEFAULT 'Free',
  `room` int(11) NOT NULL DEFAULT '1',
  `duration` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_idx` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `teacher_id`, `description`, `enrollment_cap`, `meetingdays`, `cost`, `room`, `duration`) VALUES
(15, 'Individual Yoga', 19, 'One on one Yoga session', 1, 'Mondays 7:00AM', 'Free', 2, '45 Minutes'),
(18, 'Early Bird Hot Yoga', 19, 'Early morning hot yoga session', 10, 'Mondays 5:00AM', 'Free', 1, '1 Hour'),
(19, 'Starting Yoga', 19, 'A great first yoga class', 15, 'Tuesdays and Thursdays 5:00PM', 'Free', 2, '30 Min'),
(21, 'Couples Massage', 20, 'Romantic', 2, 'Fridays 8:00PM', '$100', 1, '50 Min'),
(22, 'Tranquil Yoga', 21, 'Calm and relaxing group yoga', 20, 'Wednesdays and Fridays 8:00AM', '$20', 1, NULL),
(23, 'Private Feldenkrais', 17, 'Individual Feldenkrais course', 1, 'Fridays 6:00PM', '$30', 3, NULL),
(24, 'Group Feldenkrais Course', 17, 'Group Feldenkrais', 15, 'Thursdays 6:00PM', '$10', 3, NULL),
(25, 'Essential Feldenkrais', 22, 'Covers the basics and essential Feldenkrais', 20, 'Tuesdays 8:00PM', '$10', 1, NULL),
(26, 'Stress Relief', 18, 'Hour long course to teach how to reduce tension in everyday life.', 20, 'Sundays 11:00AM', '$15', 1, '1 Hour'),
(30, 'Feldenkrais Workshop', 22, 'Learn everything there is to know', 20, 'Saturdays 12:00PM', '$75', 2, '3 Hours'),
(31, 'The Feldenkrais Method', 22, 'Fundamental Feldenkrais', 25, 'Sunday 12:00PM', '$18', 2, '45 Min'),
(32, 'Children''s Yoga', 21, 'Yoga targeted for children', 30, 'Tuesdays and Thursdays 6:00PM', '$20', 3, '40 Min'),
(33, 'Core Alexander Technique', 18, 'Learn core technique', 20, 'Thursdays 7:00PM', '$20', 2, '45 MIN'),
(34, 'Hot Stone Massage', 20, 'Massage using hot stones', 2, 'Tuesday 8:00PM', '$50', 1, '30 Min'),
(35, 'Yoga X', 16, 'Yoga inspired by P90X', 10, 'Fridays 7:30PM', '$30', 3, '2 Hours');

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE IF NOT EXISTS `discipline` (
  `id` int(11) NOT NULL,
  `discipline` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discipline`
--

INSERT INTO `discipline` (`id`, `discipline`) VALUES
(0, 'Yoga'),
(1, 'Feldenkrais'),
(2, 'Alexander'),
(3, 'Massage');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE IF NOT EXISTS `enrollment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `enroll_date` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `student_idx` (`student_id`),
  KEY `class_idx` (`class_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`id`, `student_id`, `class_id`, `enroll_date`, `status_id`) VALUES
(36, 11, 24, '2013-03-30 08:05:26', 1),
(35, 14, 30, '2013-03-30 08:05:19', 1),
(33, 6, 24, '2013-03-30 02:59:51', 0),
(32, 17, 25, '2013-03-30 02:56:22', 1),
(31, 9, 23, '2013-03-30 02:56:11', 0),
(30, 6, 18, '2013-03-30 02:56:00', 0),
(29, 6, 15, '2013-03-30 02:12:14', 2),
(37, 23, 22, '2013-03-30 08:05:32', 0),
(38, 25, 24, '2013-03-30 08:05:40', 0),
(39, 7, 26, '2013-03-30 08:05:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_status`
--

CREATE TABLE IF NOT EXISTS `enrollment_status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment_status`
--

INSERT INTO `enrollment_status` (`id`, `status`) VALUES
(0, 'Not Paid'),
(1, 'Paid'),
(2, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`) VALUES
(6, 'John Doe'),
(7, 'Bob Builder'),
(8, 'Peter Griffen'),
(9, 'Mila Kunis'),
(10, 'Justin Thyme'),
(11, 'Courtney Richards'),
(12, 'Garrett Baldwin'),
(13, 'Lewis Deleon'),
(14, 'Carly Bowen'),
(15, 'Matthew Case'),
(16, 'Joy Crawford'),
(17, 'Quinn Bowen'),
(18, 'Wyoming Sargent'),
(19, 'Nero Schmidt'),
(20, 'Desirae Vaughn'),
(21, 'Forrest Preston'),
(22, 'Herman Perez'),
(23, 'Summer Elliott'),
(24, 'Lilah Bowers'),
(25, 'Demetrius Mcdowell');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `discipline_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `discipline_id`) VALUES
(16, 'Claire Fraser', 0),
(17, 'Jane Brown', 1),
(18, 'Debra Morgan', 2),
(19, 'Alana Ryan', 0),
(20, 'Lisa Wenzleman', 3),
(21, 'Joyce Gross', 0),
(22, 'Julie Shay', 1),
(28, 'Kait Sanford', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
