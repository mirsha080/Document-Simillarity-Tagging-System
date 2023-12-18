-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 05:00 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `document_sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(20) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_type`, `username`, `password`, `status`) VALUES
(148, 'Administrator', 'admin', '$2y$10$Nhi/r254ohUU1KYFzB9KJOMgEnzHasDkJjS9jfUHAEW5OX0G7oCvG', 'ACTIVE'),
(149, 'Research Coordinator', 'coor123', '$2y$10$klDSJwCIXS3dp6/nIf.xveWcCq7I0EFPFL8kRdT0HA7f8WnrJG07e', 'INACTIVE'),
(151, 'Research Coordinator', 'farcy', '$2y$10$G21V2ncmyX.bGpC0UW1Y/O6Qghg6aF1Va26QoyJK.XdKunKTy9JfG', 'INACTIVE'),
(155, 'Research Coordinator', 'nafi', '$2y$10$DU0Tm5G9lrTP6JWgcgl26euiy6ny/H298yufdCTMfUyz6LYkrI9.u', 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `profile_picture` varchar(50) DEFAULT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `fname`, `mname`, `lname`, `profile_picture`, `account_id`) VALUES
(22, 'Admin', 'A', 'Admin', '../../uploads/images/1650526961.png', 148);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(10) NOT NULL,
  `person_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `person_id`) VALUES
(12, 98),
(13, 100),
(9, 101),
(8, 103),
(14, 105),
(11, 106),
(7, 108),
(10, 110),
(15, 111),
(16, 112),
(17, 113);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(10) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `fname`, `mname`, `lname`) VALUES
(97, 'Jeffrey', 'M', 'Mondejar'),
(98, 'Sacaria', 'B', 'Gulam'),
(99, 'Jasmin Jeanette', 'C', 'Mama'),
(100, 'Suhaina', 'K', 'Tamano'),
(101, 'Llwelyn', 'E', 'Alcana'),
(102, 'Amer Hussien', 'T', 'Macatotong'),
(103, 'Joseph', 'C', 'Sieras'),
(104, 'Jenan Fathma', 'B', 'Rande'),
(105, 'Janice', 'F', 'Wade'),
(106, 'Mohammad', 'P', 'Domato'),
(107, 'Jogie', 'A', 'Vistal'),
(108, 'Johaira', 'R', 'Isra'),
(110, 'Maimona', 'M', 'Asum'),
(111, 'Mudzna', 'M', 'Asakil'),
(112, 'Azreen', 'M', 'Marohomsalic'),
(113, 'Mia', 'A', 'Catindig'),
(503, 'Ismael ', 'V', 'Mangondatu'),
(504, 'Asminah', 'D', 'Rascal'),
(505, 'Sundosia', 'M', 'Yusop'),
(506, 'Nurjadein', 'X', 'Abdulmorid'),
(507, 'Hanief', 'M', 'Abdulhalim'),
(508, 'Samel', 'S', 'Samporna'),
(509, 'Hisham', 'x', 'H.Jamel'),
(510, 'Warda', 'X', 'Abdulrahman'),
(511, 'Hamida', 'X', 'Rakim'),
(512, 'Rusli', 'x', 'Cali'),
(513, 'Aminah', 'X', 'Solaiman'),
(514, 'Jomaid', 'A', 'Cato'),
(515, 'Norodien', 'P', 'Sharief'),
(516, 'Juhary', 'M', 'Salem'),
(517, 'Moh\'d Nur', 'M', 'Sumandar'),
(518, 'Dayanodin', 'M', 'Macadar'),
(519, 'Ashary', 'X', 'D'),
(520, 'Janarie', 'P', 'Jamel'),
(521, 'Claudine', 'X', 'Lapura'),
(522, 'Cardawi', 'C', 'Comadug'),
(523, 'Jamela', 'P', 'Abbas'),
(524, 'Mosaab', 'S', 'Talib'),
(525, 'Abdulrahman', 'J', 'Bayabao'),
(530, 'Lord', 'L', 'Patawad'),
(531, 'Lord', 'L', 'Patawad'),
(537, 'Farhana', 'F', 'Farhan');

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `research_id` int(10) NOT NULL,
  `research_title` varchar(255) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `copy_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_completed` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`research_id`, `research_title`, `adviser_id`, `copy_id`, `category`, `status`, `date_completed`) VALUES
(110, 'A Web-based Pre-Admission Framework of Incoming Freshmen Students of Mindanao State University- Marawi', 8, 133, 'Capstone Project', 'Completed', '2021-07-22'),
(111, '“eMV [Electronic Mindanao Varsitarian] An Online Publication for the Mindanao Varsitarian ', 15, 134, 'Capstone Project', 'Completed', '2021-07-14'),
(112, 'Accreditation Document Management System ', 14, 135, 'Capstone Project', 'Completed', '2021-07-22'),
(113, 'An Automated Library Management System for MSU Unit Library', 15, 136, 'Capstone Project', 'Completed', '2021-07-22'),
(114, 'CIT Research Information System (CITRIS)', 14, 137, 'Capstone Project', 'Completed', '2021-07-22'),
(115, 'Cultural mapping is the term used to describe the set of activities and process for exploring', 15, 138, 'Capstone Project', 'Completed', '2021-07-22'),
(116, 'DEVELOPING MSU-ERDMS with B+-Tree Indexing', 15, 139, 'Thesis', 'Completed', '2021-07-22'),
(117, 'Mindanao State University Student Organizations Portal of Events and Activities', 15, 140, 'Capstone Project', 'Completed', '2021-07-22'),
(118, 'MODELLING THE CYCLIC PATTERN OF MAIZE, RICE, CASSAVA AND BANANA PLANTATIONS USING MODULAR NEURAL NETWORK ', 14, 141, 'Thesis', 'Completed', '2021-07-14'),
(119, 'Performance Evaluation of Local Email System with Active Directory for Academic, Semi-Academic, and Administrative Offices of Mindanao State University Main Campus ', 11, 142, 'Capstone Project', 'Completed', '2021-07-22'),
(120, 'RBESReco A Rule Based Expert System on Recommending Herbal Plants for Common Diseases Considering Blood Types', 14, 143, 'Thesis', 'Completed', '2021-07-22'),
(121, 'SMS-Based Notification System for Events and Announcements in Mindanao State University – Main Campus ', 15, 144, 'Capstone Project', 'Ongoing', ''),
(122, 'Tadman A web – based inventory system for Intangible Cultural Heritage of Maranao tribe of lanao del sur', 15, 145, 'Capstone Project', 'Ongoing', ''),
(126, 'Database Systems', 12, 149, 'Capstone Project', 'Completed', '2021-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `research_coordinator`
--

CREATE TABLE `research_coordinator` (
  `coor_id` int(10) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `profile_picture` varchar(50) DEFAULT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `research_coordinator`
--

INSERT INTO `research_coordinator` (`coor_id`, `fname`, `mname`, `lname`, `profile_picture`, `account_id`) VALUES
(3, 'Coordinator', 'C', 'Coordinator', '../../uploads/images/1625866567.png', 149),
(5, 'Farhan', 'G', 'Abdulmalic', '../../uploads/images/1625866312.png', 151),
(9, 'nafi', 'n', 'nafi', NULL, 155);

-- --------------------------------------------------------

--
-- Table structure for table `research_panel`
--

CREATE TABLE `research_panel` (
  `faculty_id` int(11) NOT NULL,
  `research_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `research_panel`
--

INSERT INTO `research_panel` (`faculty_id`, `research_id`) VALUES
(14, 110),
(10, 110),
(16, 111),
(9, 111),
(8, 112),
(10, 112),
(12, 113),
(13, 113),
(12, 114),
(15, 114),
(16, 115),
(14, 115),
(12, 116),
(11, 116),
(14, 117),
(13, 117),
(8, 118),
(16, 118),
(10, 119),
(13, 119),
(13, 120),
(15, 120),
(15, 121),
(12, 121),
(8, 122),
(14, 122),
(11, 126),
(17, 126);

-- --------------------------------------------------------

--
-- Table structure for table `soft_copy`
--

CREATE TABLE `soft_copy` (
  `copy_id` int(11) NOT NULL,
  `file_name` varchar(500) COLLATE tis620_bin NOT NULL,
  `chapter1_path` varchar(500) COLLATE tis620_bin NOT NULL,
  `abstract` text COLLATE tis620_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620 COLLATE=tis620_bin;

--
-- Dumping data for table `soft_copy`
--

INSERT INTO `soft_copy` (`copy_id`, `file_name`, `chapter1_path`, `abstract`) VALUES
(133, 'A Web-based Pre-Admission Framework of Incoming Freshmen Students of Mindanao State University- Marawi (mangondatu).pdf', '../../uploads/chapter 1/60e15cbe7dc450.48535400.pdf', '../../uploads/abstract/60f9174bbf5ad3.83941644.pdf'),
(134, '?eMV [Electronic Mindanao Varsitarian] An Online Publication for the Mindanao Varsitarian (asminah,sundosia).pdf', '../../uploads/chapter 1/60e15e2f43d013.46594010.pdf', '../../uploads/abstract/60ee739aa86445.98833036.pdf'),
(135, 'Accreditation Document Management System (Abdulmurid).pdf', '../../uploads/chapter 1/60e15eb8d34837.76008485.pdf', '../../uploads/abstract/60f9177899e318.61354196.pdf'),
(136, 'An Automated Library Management System for MSU Unit Library (hanif,hisham,samil).pdf', '../../uploads/chapter 1/60e15f765b6cf7.28041913.pdf', '../../uploads/abstract/60f917906f8a43.59913073.pdf'),
(137, 'CITRIS (warda).pdf', '../../uploads/chapter 1/60e16075a60114.39998694.pdf', '../../uploads/abstract/60f917a25368f9.69872581.pdf'),
(138, 'Cultural mapping is the term used to describe the set of activities and process for exploring (rusli,amena).pdf', '../../uploads/chapter 1/60e160e921ed39.72692102.pdf', '../../uploads/abstract/60f917c052e575.88654759.pdf'),
(139, 'DEVELOPING MSU-ERDMS with B+-Tree Indexing (cato).pdf', '../../uploads/chapter 1/60e161c0dcc0c8.94662450.pdf', '../../uploads/abstract/60f917ecca5db1.70280218.pdf'),
(140, 'Mindanao State University Student Organizations Portal of Events and Activities (Johary).pdf', '../../uploads/chapter 1/60e162fe73d887.59397207.pdf', '../../uploads/abstract/60f9180546cbf6.39987287.pdf'),
(141, 'MODELLING THE CYCLIC PATTERN OF MAIZE, RICE, CASSAVA AND BANANA PLANTATIONS USING MODULAR NEURAL NETWORK (DIANALAN).pdf', '../../uploads/chapter 1/60e16345bcec59.21104390.pdf', '../../uploads/abstract/60ee73ea222387.99734823.pdf'),
(142, 'Performance Evaluation of Local Email System with Active Directory for Academic, Semi-Academic, and Administrative Offices of Mindanao State University Main Campus (claudine,janary).pdf', '../../uploads/chapter 1/60e163a9d96270.86031088.pdf', '../../uploads/abstract/60f91823e12a02.92109638.pdf'),
(143, 'RBESReco A Rule Based Expert System on Recommending Herbal Plants for Common Diseases Considering Blood Types (qardaywi,jamela).pdf', '../../uploads/chapter 1/60e16407afe485.81654319.pdf', '../../uploads/abstract/60f91842166f73.25451900.pdf'),
(144, 'SMS-Based Notification System for Events and Announcements in Mindanao State University ? Main Campus (Mosaab).pdf', '../../uploads/chapter 1/60e1649ae20bb7.66153125.pdf', 'Research Ongoing No Abstract to Show'),
(145, 'Tadman A web ? based inventory system for Intangible Cultural Heritage of Maranao tribe of lanao del sur (Bayabao).pdf', '../../uploads/chapter 1/60e164f3568871.88404632.pdf', 'Research Ongoing No Abstract to Show'),
(149, 'SMS-Based Notification System for Events and Announcements in Mindanao State University ? Main Campus (Mosaab).pdf', '../../uploads/chapter 1/60fc6a4a9f3337.85511337.pdf', 'Research Ongoing No Abstract to Show');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `research_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `person_id`, `research_id`) VALUES
(174, 503, 110),
(175, 504, 111),
(176, 505, 111),
(177, 506, 112),
(178, 507, 113),
(179, 508, 113),
(180, 509, 113),
(181, 510, 114),
(182, 511, 114),
(183, 512, 115),
(184, 513, 115),
(185, 514, 116),
(186, 515, 116),
(187, 516, 117),
(188, 517, 117),
(189, 518, 117),
(190, 519, 118),
(191, 520, 119),
(192, 521, 119),
(193, 522, 120),
(194, 523, 120),
(195, 524, 121),
(196, 525, 122),
(202, 530, 112),
(208, 537, 126);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`research_id`),
  ADD KEY `copy_id` (`copy_id`),
  ADD KEY `adviser_id` (`adviser_id`);

--
-- Indexes for table `research_coordinator`
--
ALTER TABLE `research_coordinator`
  ADD PRIMARY KEY (`coor_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `research_panel`
--
ALTER TABLE `research_panel`
  ADD KEY `research_id` (`research_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `soft_copy`
--
ALTER TABLE `soft_copy`
  ADD PRIMARY KEY (`copy_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `research_id` (`research_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=538;

--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
  MODIFY `research_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `research_coordinator`
--
ALTER TABLE `research_coordinator`
  MODIFY `coor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `soft_copy`
--
ALTER TABLE `soft_copy`
  MODIFY `copy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `research_ibfk_4` FOREIGN KEY (`copy_id`) REFERENCES `soft_copy` (`copy_id`),
  ADD CONSTRAINT `research_ibfk_5` FOREIGN KEY (`adviser_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `research_coordinator`
--
ALTER TABLE `research_coordinator`
  ADD CONSTRAINT `research_coordinator_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`research_id`) REFERENCES `research` (`research_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
