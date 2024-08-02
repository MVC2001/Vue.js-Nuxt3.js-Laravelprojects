-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 10:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aruexams_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allquestionnairesdetails`
--

CREATE TABLE `allquestionnairesdetails` (
  `id` int(11) NOT NULL,
  `evaluatorsName` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `reasonFor` varchar(255) NOT NULL,
  `venueNo` varchar(50) NOT NULL,
  `NoOfAdmittedStudents` varchar(50) NOT NULL,
  `examsRoomCapacity` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `invRank` varchar(50) NOT NULL,
  `allStudentsIdentifiedAtEntry` varchar(50) NOT NULL,
  `studentsFoundWithId` varchar(50) NOT NULL,
  `studentsFoundWithExpiredId` varchar(50) NOT NULL,
  `studentsFoundWithForgedId` varchar(50) NOT NULL,
  `studentsFoundWithoutARUId` varchar(50) NOT NULL,
  `studentsFoundWithpRPdUPpermission` varchar(50) NOT NULL,
  `studentsFoundWithPoliceReport` varchar(50) NOT NULL,
  `reasonForQualityAssessment` varchar(50) NOT NULL,
  `restrictionOfUnauthorizedMaterial` varchar(50) NOT NULL,
  `wereCorrectionsMadeToExamsPaper` varchar(50) NOT NULL,
  `commitmentOfInv` varchar(50) NOT NULL,
  `generalConductOfUE` varchar(50) NOT NULL,
  `godOrBadOnPracticesObserved` varchar(50) NOT NULL,
  `recommendation` varchar(50) NOT NULL,
  `sittingArrOfStudents` varchar(50) NOT NULL,
  `chairsAndTables` varchar(59) NOT NULL,
  `roomVentilation` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allquestionnairesdetails`
--

INSERT INTO `allquestionnairesdetails` (`id`, `evaluatorsName`, `date`, `courseCode`, `program`, `reasonFor`, `venueNo`, `NoOfAdmittedStudents`, `examsRoomCapacity`, `name`, `invRank`, `allStudentsIdentifiedAtEntry`, `studentsFoundWithId`, `studentsFoundWithExpiredId`, `studentsFoundWithForgedId`, `studentsFoundWithoutARUId`, `studentsFoundWithpRPdUPpermission`, `studentsFoundWithPoliceReport`, `reasonForQualityAssessment`, `restrictionOfUnauthorizedMaterial`, `wereCorrectionsMadeToExamsPaper`, `commitmentOfInv`, `generalConductOfUE`, `godOrBadOnPracticesObserved`, `recommendation`, `sittingArrOfStudents`, `chairsAndTables`, `roomVentilation`, `created_at`) VALUES
(5, 'ffrffr', '2024-04-26 00:00:00.000', 'ISS33', 'EFFJDF', 'DGDGDSGHSSFFSF', '43', '332', 'HDGDGGGJWW', 'DSGSAGGSAGSA', '', 'Yes', '3', '3636', '3', '43', '3335', '32242', '3253EUUFDFDFSUFDS', 'FDFSFFXFFSAFS', 'DYTDFFDSCSDGFFGFSD', 'GFJDFJFSAFSAFSAFS', 'FFDFFDDSFFXFDS', 'DSFDFFDFDFDFD', 'DFDFFDEDFD', '', 'good', 'good', '2024-04-29 12:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `assignbooklets`
--

CREATE TABLE `assignbooklets` (
  `booklet_id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `comfirmation` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignbooklets`
--

INSERT INTO `assignbooklets` (`booklet_id`, `fullName`, `school_id`, `department_id`, `quantity`, `description`, `comfirmation`, `created_at`) VALUES
(3, 'Yohana Kangwe', 'SERBI', 'Computer-Systems and Mathematics', '14011', 'rgmgfjggthjt', '', '2024-05-14 14:59:45'),
(4, 'Alexander moreka', 'SERBI', 'Computer-Systems and Mathematics', '67', 'gghhhhhhhhhhhhhhhh', 'comfirmed', '2024-05-14 21:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `assignedbooklets`
--

CREATE TABLE `assignedbooklets` (
  `booklet_id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `comfirmation` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignedbooklets`
--

INSERT INTO `assignedbooklets` (`booklet_id`, `user_id`, `school_id`, `department_id`, `quantity`, `description`, `comfirmation`, `created_at`) VALUES
(1, 4, '01', '01', '2000', 'for all programs', 'comfirmed', '2024-05-31 00:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `assignedscripts`
--

CREATE TABLE `assignedscripts` (
  `script_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `comfirmation` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignedscripts`
--

INSERT INTO `assignedscripts` (`script_id`, `user_id`, `school_id`, `department_id`, `courseCode`, `program`, `quantity`, `description`, `comfirmation`, `created_at`) VALUES
(1, 'Alexander moreka', 'SERBI', 'CSM', 'IS443', 'ISM 3', '400', 'For ism three only', 'comfirmed', '2024-05-14 14:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `assingbookletstoexaminer`
--

CREATE TABLE `assingbookletstoexaminer` (
  `booklet_id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `courseCode` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `comfirmation` varchar(50) NOT NULL,
  `returned` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assingbookletstoexaminer`
--

INSERT INTO `assingbookletstoexaminer` (`booklet_id`, `fullName`, `school_id`, `department_id`, `courseCode`, `program`, `quantity`, `description`, `comfirmation`, `returned`, `created_at`) VALUES
(1, 'Yohana Kangwe', 'SERBI', 'Computer-Systems and Mathematics', 'IS554', 'ISM', '67', 'ggfjjjjjjjjjjjj', 'comfirmed', 'already_returned', '2024-05-14 16:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `assscript`
--

CREATE TABLE `assscript` (
  `script_id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `courseCode` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `comfirmation` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assscript`
--

INSERT INTO `assscript` (`script_id`, `fullName`, `school_id`, `department_id`, `courseCode`, `program`, `quantity`, `description`, `comfirmation`, `created_at`) VALUES
(1, 'Alexander moreka', 'SERBI', 'Computer-Systems and Mathematics', 'IS554', 'ISM', '67', '87997888888', 'comfirmed', '2024-05-14 21:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `location`, `created_at`) VALUES
(1, 'Interior_Design', 'fsssssssssss', '2024-05-30 23:24:28');

-- --------------------------------------------------------

--
-- Table structure for table `invigilation_reportv1`
--

CREATE TABLE `invigilation_reportv1` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `totalStudentsDo_exams` varchar(50) NOT NULL,
  `bookletsUsed` varchar(50) NOT NULL,
  `unUsedBooklets` varchar(50) NOT NULL,
  `scriptsUsed` varchar(50) NOT NULL,
  `unUsedScripts` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `comfirmation` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invigilation_reportv1`
--

INSERT INTO `invigilation_reportv1` (`id`, `fullName`, `school_id`, `department_id`, `courseCode`, `program`, `totalStudentsDo_exams`, `bookletsUsed`, `unUsedBooklets`, `scriptsUsed`, `unUsedScripts`, `description`, `comfirmation`, `created_at`) VALUES
(1, 'Yohana Kangwe', 'SERBI', 'Computer-Systems and Mathematics', 'IS554', 'ISM', '44', '44', '44', '33', '44', 'rhrhrhrhrhr', '', '2024-05-14 16:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `overallinvigilationreport`
--

CREATE TABLE `overallinvigilationreport` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `department_id` varchar(50) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `program` varchar(50) NOT NULL,
  `totalStudents` varchar(50) NOT NULL,
  `bookletsUsed` varchar(50) NOT NULL,
  `unUsedBooklets` varchar(50) NOT NULL,
  `usedScripts` varchar(50) NOT NULL,
  `unUsedScripts` varchar(50) NOT NULL,
  `comfirmation` varchar(100) NOT NULL,
  `description` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `overallinvigilationreport`
--

INSERT INTO `overallinvigilationreport` (`id`, `fullName`, `school_id`, `department_id`, `courseCode`, `program`, `totalStudents`, `bookletsUsed`, `unUsedBooklets`, `usedScripts`, `unUsedScripts`, `comfirmation`, `description`, `created_at`) VALUES
(3, 'alexander moreka', 'SERBI', 'Computer-Systems and Mathematics', 'IS554', 'ISM', '33', '33', '33', '33', '33', '', 'ERGTGT', '2024-05-14 22:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `per_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`per_id`, `category`, `description`, `created_at`) VALUES
(1, 'Read', 'trrryt', '2024-05-04 23:18:21'),
(2, 'Read', 'trrryt', '2024-05-04 23:17:50'),
(3, 'Create', 'fdddddddddd', '2024-05-30 22:05:14'),
(4, 'Create', 'fsfsffff', '2024-05-30 22:07:21'),
(5, 'Create', 'dffffffffffff', '2024-05-30 22:16:28'),
(6, 'Create', 'fgggggggggggggg', '2024-05-30 22:23:34'),
(7, 'Create', 'SGGGGGGG', '2024-05-30 22:35:07'),
(8, 'Create', 'sffffff', '2024-05-30 22:42:03'),
(9, 'Read', 'wfwfw', '2024-05-30 22:42:34'),
(10, 'Read', 'sfffff', '2024-05-30 22:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role`, `description`, `created_at`) VALUES
(4, 'exams_administrator_manager', 'ssssssssssss', '2024-05-30 21:24:54'),
(5, 'examination_coordinator', 'ggggggggggg', '2024-05-30 21:25:26'),
(6, 'admin', 'hhhhhhhhhh', '2024-05-30 21:27:17'),
(7, 'quality_assurance_officer', 'jjjjjjjjjjjjjjjjj', '2024-05-30 21:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(50) NOT NULL,
  `per_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `per_id`) VALUES
(3, 0),
(6, 0),
(0, 5),
(0, 6),
(2, 7),
(4, 8),
(5, 9),
(7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `school_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`school_id`, `name`, `location`, `created_at`) VALUES
(2, 'SSPSS', 'rgggggggggggggg', '2024-05-30 23:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullName`, `role`, `school_id`, `department_id`, `email`, `password`, `created_at`) VALUES
(1, 'quality assurance officer', 'quality_assurance_officer', '', '', 'qualityassOfficer@gmail.com', '36f682dd3ada7e7d10e1cebfba53a535', '2024-04-25 17:21:40'),
(3, 'administrator', 'admin', '', '', 'administrator123@gmail.com', '7096db86e990c11697503d5ba66ff32a', '2024-04-29 12:31:24'),
(4, 'Alexander moreka', 'examination_coordinator', '01', '01', 'examscoord123@gmail.com', 'd7468fee6df315e79f870bfb5049c694', '2024-05-30 23:26:21'),
(5, 'alexander moreka', 'invigilator', 'SERBI', 'Computer-Systems and Mathematics', 'invigilator123@gmail.com', '9444708479ce230c20c35a4fb789e578', '2024-05-14 21:03:15'),
(6, 'Examination Administration Manager', 'exams_administrator_manager', 'None-user', 'None', 'examinationAdministrationManager@gmail.com', '5b29dcb35f298e19f9d66e469d074fb7', '2024-05-12 22:26:43'),
(7, 'Invigilation examiner', 'examiner', '01', '01', 'examiner123@gmail.com', 'b3b7ab7f3585cde09ccf788065106eb0', '2024-05-30 20:42:57'),
(8, 'USER TEST', '', '', '', 'admin123@gmail.com', 'd7468fee6df315e79f870bfb5049c694', '2024-05-30 20:53:41'),
(9, 'Queen', '', '', '', 'queen@gmal.com', '48f151ac56cfcb34a9876a757277ab05', '2024-05-30 20:56:54'),
(10, 'USER TESTv5', '', '01', '01', 'userv7@gmail.com', 'fdd40fe0cad6a5848a19b903830fc780', '2024-05-30 21:05:14'),
(11, 'successfull', 'examiner', '01', '01', 'successv155@gmail.com', 'fbf310f3a72bf56bbca2d688e00e2a86', '2024-05-30 21:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(50) DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `role_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role`, `role_id`) VALUES
(8, 'quality_assurance_officer', NULL),
(9, 'others', NULL),
(10, 'invigilator', NULL),
(11, 'examiner', NULL),
(NULL, 'admin', 2),
(NULL, '', 3),
(1, '', 5),
(1, '', 6),
(1, '', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allquestionnairesdetails`
--
ALTER TABLE `allquestionnairesdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignbooklets`
--
ALTER TABLE `assignbooklets`
  ADD PRIMARY KEY (`booklet_id`);

--
-- Indexes for table `assignedbooklets`
--
ALTER TABLE `assignedbooklets`
  ADD PRIMARY KEY (`booklet_id`);

--
-- Indexes for table `assignedscripts`
--
ALTER TABLE `assignedscripts`
  ADD PRIMARY KEY (`script_id`);

--
-- Indexes for table `assingbookletstoexaminer`
--
ALTER TABLE `assingbookletstoexaminer`
  ADD PRIMARY KEY (`booklet_id`);

--
-- Indexes for table `assscript`
--
ALTER TABLE `assscript`
  ADD PRIMARY KEY (`script_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `invigilation_reportv1`
--
ALTER TABLE `invigilation_reportv1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overallinvigilationreport`
--
ALTER TABLE `overallinvigilationreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allquestionnairesdetails`
--
ALTER TABLE `allquestionnairesdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `assignbooklets`
--
ALTER TABLE `assignbooklets`
  MODIFY `booklet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assignedbooklets`
--
ALTER TABLE `assignedbooklets`
  MODIFY `booklet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignedscripts`
--
ALTER TABLE `assignedscripts`
  MODIFY `script_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assingbookletstoexaminer`
--
ALTER TABLE `assingbookletstoexaminer`
  MODIFY `booklet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assscript`
--
ALTER TABLE `assscript`
  MODIFY `script_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invigilation_reportv1`
--
ALTER TABLE `invigilation_reportv1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `overallinvigilationreport`
--
ALTER TABLE `overallinvigilationreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
