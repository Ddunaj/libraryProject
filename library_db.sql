-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2017 at 05:15 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Authors`
--

CREATE TABLE `Authors` (
  `Name` varchar(50) NOT NULL,
  `Author_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Authors`
--

INSERT INTO `Authors` (`Name`, `Author_ID`) VALUES
('Charlie Holmberg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Books`
--

CREATE TABLE `Books` (
  `Title` varchar(200) DEFAULT NULL,
  `Author` varchar(50) NOT NULL,
  `Series` varchar(100) NOT NULL,
  `Number of Pages` int(255) DEFAULT NULL,
  `Publish Date` date DEFAULT NULL,
  `Genre` varchar(30) DEFAULT NULL,
  `ISBN` varchar(20) NOT NULL,
  `Review` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Books`
--

INSERT INTO `Books` (`Title`, `Author`, `Series`, `Number of Pages`, `Publish Date`, `Genre`, `ISBN`, `Review`) VALUES
('The Glass Magician', 'Charlie Holmberg', 'The Paper Magician Trilogy', 224, '2014-11-04', 'Fantasy', '9781477825945', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Patron`
--

CREATE TABLE `Patron` (
  `Name` varchar(50) DEFAULT NULL,
  `Library_Card_Num` varchar(50) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Fine` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Publisher`
--

CREATE TABLE `Publisher` (
  `Name` varchar(50) NOT NULL,
  `Address` int(100) NOT NULL,
  `Year_Est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Review`
--

CREATE TABLE `Review` (
  `Star Rating` int(11) NOT NULL,
  `Review Text` text NOT NULL,
  `Reviewer Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Authors`
--
ALTER TABLE `Authors`
  ADD PRIMARY KEY (`Name`),
  ADD UNIQUE KEY `Author_ID` (`Author_ID`);

--
-- Indexes for table `Books`
--
ALTER TABLE `Books`
  ADD KEY `auth_change` (`Author`);

--
-- Indexes for table `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`Reviewer Name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Books`
--
ALTER TABLE `Books`
  ADD CONSTRAINT `auth_change` FOREIGN KEY (`Author`) REFERENCES `Authors` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
