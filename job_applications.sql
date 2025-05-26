-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 01:41 PM
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
-- Database: `job_applications`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `jobReferenceNumber` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `dateOfBirth` text NOT NULL,
  `gender` text NOT NULL,
  `streetAddress` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` text NOT NULL,
  `postcode` int(11) NOT NULL,
  `emailAddress` text NOT NULL,
  `phoneNumber` text NOT NULL,
  `skillsList` text NOT NULL,
  `otherSkills` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('New','Current','Rejected') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `jobReferenceNumber`, `firstName`, `lastName`, `dateOfBirth`, `gender`, `streetAddress`, `suburb`, `state`, `postcode`, `emailAddress`, `phoneNumber`, `skillsList`, `otherSkills`, `username`, `password`, `status`) VALUES
(78, 2, 'charlie', 'walker', '26/08/2006', 'male', '113 sen rod', 'swanb', 'wa', 6010, 'char@gmail.com', '0412345678', '[\"html\",\"javascript\",\"python\"]', 0, 'charlie.walker682', '$2y$10$2N6A3M2cSgRrtcsZKADlI.1Tl..PIyVmpWFlIH7guAuF21pcbGfOi', 'New'),
(79, 1, 'charlie', 'wlajer', '26/08/2006', 'male', '113 sen rod', 'swanbourne', 'wa', 6000, 'charliewalker537@gmail.com', '0412345678', '[\"html\",\"javascript\",\"python\",\"java\"]', 0, 'charlie.wlajer837', '$2y$10$4LXj4UVi4cyfqYbjW257fuZKdcTYiZFZ9i6t/px9AzZJ275XbhDkq', 'New'),
(80, 2, 'charlie', 'wlajer', '26/08/2006', 'male', '113 sen rod', 'swanbourne', 'wa', 6000, 'charliewalker537@gmail.com', '0412345678', '[\"html\",\"javascript\",\"python\",\"java\"]', 0, 'charlie.wlajer301', '$2y$10$xBqxqSSvDc.mn8HNd5YPYud0cONIqg62jrhpfz1ain2jdYgRTKxoC', 'New'),
(81, 1, 'cha', 'awl', '26/08/2006', 'male', '113 shen rd', 'swanb', 'wa', 6000, 'charliewalkew@gmail.com', '0412345678', '[\"javascript\",\"python\",\"java\"]', 0, 'cha.awl318', '$2y$10$DcMCyF8CC.GuMJBkTe/qsukjqevM7YfFTFeF5TEfkxNp2ZFy4UA/e', 'New'),
(82, 2, 'weal', 'qwql', '26/08/2006', 'male', '112 sqweeb st', 'Cott', 'wa', 6000, 'charl@gmail.com', '0412345678', '[\"html\",\"css\",\"javascript\"]', 0, 'weal.qwql330', '$2y$10$P73q0r/ChBMj6dPTQ7MuUuHWRexK/xPp5c/iaIqtJR0tv/PG2.t3W', 'Current'),
(83, 1, 'charlie', 'wlaker', '26/08/2006', 'male', '113 shen rd', 'Swanbourne', 'wa', 6000, 'charliewalkew@gmail.com', '0412345678', '[\"css\",\"javascript\",\"python\",\"git\"]', 0, 'charlie.wlaker954', '$2y$10$iSmunqBUGRIJ8YLIRlIRDeB9xF6Vwk1X6XOm6axe6k35BwWDaX6ui', 'New'),
(84, 1, 'John', 'Johnson', '12/12/2012', 'male', 'john', 'johntown', 'vic', 3000, 'john@john.com', '0481000000', '[\"html\",\"python\"]', 0, 'john.johnson890', '$2y$10$Uw1uJjklRFcAnmth0Ali5uNfidcok5At.JKk1iILLjGrv/dOh1pRy', 'Current'),
(85, 1, 'John', 'Johnsoooon', '12/12/2012', 'other', 'john', 'johntown', 'vic', 4000, 'john@john.com', '0481000000', '[\"sql\"]', 0, 'john.johnsoooon570', '$2y$10$nD3aRZEXvDe9amDSc0cdnODOtkfqK3Mjh0oYSqTLLlltPrRMuAfBK', 'New'),
(86, 1, 'John', 'Johnsoooon', '12/12/2012', 'other', 'john', 'johntown', 'vic', 4000, 'john@john.com', '0481000000', '[\"sql\"]', 0, 'john.johnsoooon108', '$2y$10$a4Cl/mky2BpP.wDdubfg9u4jCPDWkAS7kZq9pf2XQEt0C.oeOntaS', 'New'),
(87, 1, 'John', 'Johnsoooon', '12/12/2012', 'other', 'john', 'johntown', 'vic', 9999, 'john@john.com', '0481000000', '[\"sql\"]', 0, 'john.johnsoooon811', '$2y$10$Y177poakJ6mQb3ozzK/R9eGpBoUCPrIcGbfNJ895nkyzmiHIEp0ry', 'New'),
(88, 1, 'John', 'Johnsoooon', '12/12/2012', 'male', 'john', 'johntown', 'vic', 3000, 'john@john.com', '0481000000', '[\"css\",\"git\"]', 0, 'john.johnsoooon778', '$2y$10$CT1/z2Zvf6fgpf2mlLVrO.7URGMpMkitnDQH1.kENtAStQJ2Sv2Qu', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `managerId` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`managerId`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$d.vtRK8Kv4LDfdQL3Qspn.c4yGCwyym/QFpeHScLlxIUtmvwHHlqm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`managerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `managerId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
