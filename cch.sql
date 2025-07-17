-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2025 at 03:46 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cch`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoid` int(11) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`) VALUES
(14, 5, 1, 14, '2025-02-24');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(2) NOT NULL,
  `bname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `bname`) VALUES
(1, 'colombo'),
(2, 'kandy'),
(3, 'kurunagala');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(2, 'user0', 'user@gmail.com', 'What are your latest treatments?', '2025-02-25 05:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL,
  `branch` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`, `branch`) VALUES
(5, 'doctor1@gmail.com', 'Doctor1', '123', '2233445566', '078564534', 5, 1),
(6, 'doctor2@gmail.com', 'Doctor2', '123', '4455667788', '098765678', 1, 2),
(7, 'doctor3@gmail.com', 'Doctor3', '123', '2323232323', '076564524', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(5, 'user2@gmail.com', 'user 2', '123', 'homagama', '1122334455', '2002-12-19', '0714786746'),
(6, 'user1@gmail.com', 'user 1', '1234', 'Maharagama', '6655774433', '2003-01-15', '0764564534');

-- --------------------------------------------------------

--
-- Table structure for table `rappointment`
--

CREATE TABLE `rappointment` (
  `rappoid` int(11) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `reportid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rappointment`
--

INSERT INTO `rappointment` (`rappoid`, `pid`, `reportid`, `appodate`) VALUES
(12, 5, 6, '2025-02-24'),
(13, 6, 6, '2025-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportid` int(11) NOT NULL,
  `rname` varchar(255) DEFAULT NULL,
  `discription` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportid`, `rname`, `discription`, `price`) VALUES
(5, 'ECG (Electrocardiogram)', 'A test that records the electrical activity of the heart over a period of time, allowing doctors to detect heart rhythm problems and other cardiac conditions.                                    ', '2000'),
(6, 'MRI (Magnetic Resonance Imaging)', 'A non-invasive imaging technique that uses strong magnets and radio waves to create detailed images of organs and tissues inside the body, useful for diagnosing various conditions.                                    ', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `resultid` int(11) NOT NULL,
  `pid` varchar(255) DEFAULT NULL,
  `reportid` varchar(255) DEFAULT NULL,
  `image` varchar(75) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`resultid`, `pid`, `reportid`, `image`) VALUES
(14, '5', '5', '67bcbd8b3295c.png');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL,
  `price` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`, `price`) VALUES
(14, '5', 'Cardiology ', '2025-03-06', '16:00:00', 10, 2000),
(15, '6', 'General Medicine', '2025-03-13', '17:00:00', 15, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'General Medicine'),
(2, 'Pediatrics'),
(3, 'Surgery '),
(4, 'Obstetrics and Gynecology '),
(5, 'Cardiology '),
(6, 'Dermatology '),
(7, 'Psychiatry ');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staid` int(11) NOT NULL,
  `staemail` varchar(255) DEFAULT NULL,
  `staname` varchar(255) DEFAULT NULL,
  `stapassword` varchar(255) DEFAULT NULL,
  `stanic` varchar(15) DEFAULT NULL,
  `statel` varchar(15) DEFAULT NULL,
  `branch` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staid`, `staemail`, `staname`, `stapassword`, `stanic`, `statel`, `branch`) VALUES
(3, 'staff1@gmail.com', 'staff1', '123', '3434343434', '0756453423', 1);

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@gmail.com', 'a'),
('staff1@gmail.com', 's'),
('doctor3@gmail.com', 'd'),
('user1@gmail.com', 'p'),
('doctor2@gmail.com', 'd'),
('doctor1@gmail.com', 'd'),
('user2@gmail.com', 'p');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aemail`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `scheduleid` (`scheduleid`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docid`),
  ADD KEY `specialties` (`specialties`),
  ADD KEY `branch` (`branch`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `rappointment`
--
ALTER TABLE `rappointment`
  ADD PRIMARY KEY (`rappoid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `reportid` (`reportid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportid`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`resultid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `reportid` (`reportid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `docid` (`docid`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staid`),
  ADD KEY `branch` (`branch`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rappointment`
--
ALTER TABLE `rappointment`
  MODIFY `rappoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `resultid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
