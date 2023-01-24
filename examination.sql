-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 18, 2023 at 03:12 AM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examination`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE IF NOT EXISTS `candidates` (
  `candidate_id` int(100) NOT NULL AUTO_INCREMENT,
  `candidate_names` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `centre_id` int(100) NOT NULL,
  `category_id` int(255) NOT NULL,
  PRIMARY KEY (`candidate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `candidate_names`, `centre_id`, `category_id`) VALUES
(1, 'John Kiels', 1, 2),
(2, 'Mike Burner', 3, 3),
(3, 'Kelvin Obi', 4, 1),
(4, 'Kunle Mary', 2, 1),
(5, 'Mamudu David', 2, 1),
(6, 'Lenfred Preye', 3, 2),
(7, 'Jane Shola', 1, 2),
(8, 'Kunle Mary', 2, 3),
(9, 'Agrud Mathew', 4, 1),
(10, 'Sedney Brown', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_names` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_names`) VALUES
(1, 'Science'),
(2, 'Art'),
(3, 'Commercial');

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

DROP TABLE IF EXISTS `centers`;
CREATE TABLE IF NOT EXISTS `centers` (
  `center_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `center_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`center_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`center_id`, `center_name`) VALUES
(1, 'Lagos'),
(2, 'Abuja'),
(3, 'Kano'),
(4, 'Enugu');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(100) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `category_id`) VALUES
(1, 'Physics', 1),
(2, 'English', 2),
(3, 'Mathematics', 1),
(4, 'Accounting', 3),
(5, 'Office Practice', 3),
(6, 'Chemistry', 1),
(7, 'Civil Studies', 2),
(8, 'Biology', 1),
(9, 'Book Keeping', 3),
(10, 'Basic Law', 2),
(11, 'Agriculture', 1),
(12, 'Basic Technology', 3),
(13, 'Commerce', 3),
(14, 'Religious Knowledge', 2),
(15, 'Economics', 1),
(16, 'Geography', 1),
(17, 'Computer Studies', 1),
(18, 'Library Studies', 2),
(19, 'History', 2),
(20, 'Fine Arts', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
