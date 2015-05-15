-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2015 at 05:27 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `healthcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
`aid` int(11) NOT NULL,
  `duname` varchar(50) NOT NULL,
  `puname` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(15) NOT NULL,
  `desc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`aid`, `duname`, `puname`, `date`, `time`, `desc`) VALUES
(1, 'jahiralam', 'sayeed', '2015-04-08', '3 PM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctorinfo`
--

CREATE TABLE IF NOT EXISTS `doctorinfo` (
  `duname` varchar(50) NOT NULL,
  `pword` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `age` int(50) NOT NULL,
  `gender` tinyint(2) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `hospital` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `experties` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ph1` varchar(50) NOT NULL,
  `ph2` varchar(50) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorinfo`
--

INSERT INTO `doctorinfo` (`duname`, `pword`, `fname`, `lname`, `age`, `gender`, `qualification`, `designation`, `hospital`, `address`, `experties`, `email`, `ph1`, `ph2`, `img`) VALUES
('jahiralam', 'Abcdhjk8', 'MD. JAHIR', 'ALAM', 22, 1, 'mbbs', 'Senior Doctor', 'Square hospital', '10/3 , dhanmondi,dhaka 1200', 'ENT', 'jahir@gmail.com', '01740618846', NULL, 'doc.png');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `uname` varchar(50) NOT NULL,
  `pword` varchar(50) NOT NULL,
  `type` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`uname`, `pword`, `type`) VALUES
('jahiralam', 'Abcdhjk8', 1),
('sayeed', 'Abcdefghij8', 2);

-- --------------------------------------------------------

--
-- Table structure for table `patientinfo`
--

CREATE TABLE IF NOT EXISTS `patientinfo` (
  `puname` varchar(50) NOT NULL,
  `pward` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `age` int(50) NOT NULL,
  `gender` tinyint(2) NOT NULL,
  `ph` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `img` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientinfo`
--

INSERT INTO `patientinfo` (`puname`, `pward`, `fname`, `lname`, `age`, `gender`, `ph`, `email`, `img`) VALUES
('sayeed', 'Abcdefghij8', 'rahman', 'ataur', 22, 1, '01553652775', 'sayeed@gmail.com', 'pat.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
 ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `doctorinfo`
--
ALTER TABLE `doctorinfo`
 ADD PRIMARY KEY (`duname`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`uname`);

--
-- Indexes for table `patientinfo`
--
ALTER TABLE `patientinfo`
 ADD PRIMARY KEY (`puname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
