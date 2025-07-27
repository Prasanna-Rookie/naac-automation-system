-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2024 at 08:41 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `naac_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(15) NOT NULL,
  `hide_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `academic_year`, `hide_status`) VALUES
(2, '2022-2023', 1),
(1, '2023-2024', 0);

-- --------------------------------------------------------

--
-- Table structure for table `criterion_head`
--

CREATE TABLE `criterion_head` (
  `criterion_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `criterion` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criterion_head`
--

INSERT INTO `criterion_head` (`criterion_id`, `name`, `criterion`, `email`, `password`) VALUES
(3, 'PRASANNA G', 'Criterion - 1', 'test@gmail.com', '$2y$10$8jg3a9aSpqF51xkUVwSwhu2uVfY1d8iEc.31O.Q2h3S47hejibySe'),
(6, 'MOHAN K', 'Criterion - 2', 'test2@gmail.com', '$2y$10$4G.40mNV5aPmj5Yffs6nI.b5IpvnKoP0Nps/.OjOcHYvTJvaNQO7q'),
(7, 'MOHAN K', 'Criterion - 4', 'test4@gmail.com', '$2y$10$Cs1eeVrISf1WDK3OfHq6s.hS37CwYdkYQN.ogrxxrl0imcmdaEdvm'),
(8, 'MOHAN K', 'Criterion - 6', 'test6@gmail.com', '$2y$10$b.sIOxsKeNE9WcJIicxLIeu.dC2So0ze18bDqk6xFry9Ftnlux4iK'),
(9, 'AJAY V', 'Criterion - 5', 'test5@gmail.com', '$2y$10$FTKAOnywleRE7KSRIARMAe6A/mvA963P6dbUZx6ieuUpAeL/vILU6'),
(10, 'MOHAN K', 'Criterion - 3', 'test3@gmail.com', '$2y$10$k.7DzZiLrWYme9R2c9uoxe6PVWbJNeYrEwKvd5s3jTD6ttekARRSe'),
(11, 'AJAY V', 'Criterion - 7', 'test7@gmail.com', '$2y$10$2qrYudWDzYx7Cy4rD4sLGeTDfghL/9mIYrSEBwTTxY0VopuTM7g4S');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_1_1_doc_upload`
--

CREATE TABLE `cri_1_1_1_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_1_1_doc_upload`
--

INSERT INTO `cri_1_1_1_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(7, '2022-2023', 'Criterion - 1', '1704277576_65953648b8372.pdf'),
(8, '2022-2023', '631', '1704277616_659536702387f.pdf'),
(9, '2022-2023', '621', '1704277655_6595369791548.pdf'),
(10, '2022-2023', '621', '1704278062_6595382eb9ce5.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_1_2_doc_upload`
--

CREATE TABLE `cri_1_1_2_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_1_2_doc_upload`
--

INSERT INTO `cri_1_1_2_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(3, '2022-2023', '621', '1704458953_6597fac98e5a4.pdf'),
(4, '2022-2023', '621', '1704458975_6597fadfc6af3.pdf'),
(5, '2022-2023', 'Criterion - 1', '1704460651_6598016be1940.pdf'),
(6, '2022-2023', 'Criterion - 1', '1704461027_659802e3a3d7d.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_1_2_revision`
--

CREATE TABLE `cri_1_1_2_revision` (
  `id` int(11) NOT NULL,
  `programme_code` varchar(25) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `percentage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_1_2_revision`
--

INSERT INTO `cri_1_1_2_revision` (`id`, `programme_code`, `academic_year`, `percentage`) VALUES
(1, '621', '2022-2023', '70');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_1_3_course`
--

CREATE TABLE `cri_1_1_3_course` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(15) NOT NULL,
  `department` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_category` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_1_3_course`
--

INSERT INTO `cri_1_1_3_course` (`id`, `academic_year`, `department`, `course_name`, `course_code`, `course_category`, `doc_name`) VALUES
(2, '2022-2023', '621', 'Python Programming', 'MC0010', 'Employability', '1704466531_659818638e7f5.pdf'),
(3, '2022-2023', '621', 'Python Programming', 'MC12001', 'Employability', '1704467379_65981bb3f3c59.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_2_1_course`
--

CREATE TABLE `cri_1_2_1_course` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(15) NOT NULL,
  `department` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_category` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_2_1_course`
--

INSERT INTO `cri_1_2_1_course` (`id`, `academic_year`, `department`, `course_name`, `course_code`, `course_category`, `doc_name`) VALUES
(1, '2022-2023', '621', 'C Programming', 'MC1001', 'Skill Development', '1704469059_65982243e8bfb.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_2_2_doc_upload`
--

CREATE TABLE `cri_1_2_2_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_2_2_doc_upload`
--

INSERT INTO `cri_1_2_2_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 'Criterion - 1', '1704461827_659806031ae4a.pdf'),
(3, '2022-2023', '621', '1704462773_659809b5eaae5.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_3_1_courses`
--

CREATE TABLE `cri_1_3_1_courses` (
  `id` int(11) NOT NULL,
  `programme_code` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `course_name` varchar(500) NOT NULL,
  `course_type` varchar(500) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_3_1_courses`
--

INSERT INTO `cri_1_3_1_courses` (`id`, `programme_code`, `academic_year`, `course_code`, `course_name`, `course_type`, `doc_name`) VALUES
(10, '621', '2022-2023', 'MC0001', 'Human Values', 'Human Values', '1704434809_65979c79e83d4.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_3_1_events`
--

CREATE TABLE `cri_1_3_1_events` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(25) NOT NULL,
  `upload_by` varchar(20) NOT NULL,
  `activity_name` varchar(500) NOT NULL,
  `organizing_unit` varchar(500) NOT NULL,
  `relevant_event` varchar(500) NOT NULL,
  `activity_date` date NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_3_1_events`
--

INSERT INTO `cri_1_3_1_events` (`id`, `academic_year`, `upload_by`, `activity_name`, `organizing_unit`, `relevant_event`, `activity_date`, `doc_name`) VALUES
(2, '2022-2023', 'Criterion - 1', 'Old Age Home Visit', 'NSS & NCC', 'Human Value', '2024-01-02', '1704295465_65957c2917a6e.pdf'),
(4, '2022-2023', '621', 'Blood Donation and Organ donation Awareness Programme', 'NSS and MCA', 'Human Value', '2023-12-22', '1704296855_6595819754227.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_3_2_value_added_courses`
--

CREATE TABLE `cri_1_3_2_value_added_courses` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(25) NOT NULL,
  `department` varchar(50) NOT NULL,
  `course_name` varchar(500) NOT NULL,
  `course_code` varchar(200) NOT NULL,
  `offered_time` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `stu_enrolled` int(11) NOT NULL,
  `stu_completed` int(11) NOT NULL,
  `doc_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_3_2_value_added_courses`
--

INSERT INTO `cri_1_3_2_value_added_courses` (`id`, `academic_year`, `department`, `course_name`, `course_code`, `offered_time`, `duration`, `stu_enrolled`, `stu_completed`, `doc_name`) VALUES
(1, '2022-2023', '621', 'dhfdfd dhfd', 'fjfhd', 2, 45, 60, 59, '1704437070_6597a54e4f7d9.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_3_3_doc_upload`
--

CREATE TABLE `cri_1_3_3_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(25) NOT NULL,
  `department` varchar(50) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_3_3_doc_upload`
--

INSERT INTO `cri_1_3_3_doc_upload` (`id`, `academic_year`, `department`, `doc_name`) VALUES
(2, '2022-2023', '621', '1704448079_6597d04fb0c1e.pdf'),
(3, '2022-2023', '621', '1704448151_6597d097adf67.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_3_4_doc_upload`
--

CREATE TABLE `cri_1_3_4_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_3_4_doc_upload`
--

INSERT INTO `cri_1_3_4_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(2, '2022-2023', '621', '1704452351_6597e0ffc6725.pdf'),
(3, '2022-2023', '621', '1704452361_6597e1090f0ba.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_3_4_student_project`
--

CREATE TABLE `cri_1_3_4_student_project` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(25) NOT NULL,
  `department` varchar(50) NOT NULL,
  `register_no` varchar(50) NOT NULL,
  `stu_name` varchar(500) NOT NULL,
  `year` varchar(10) NOT NULL,
  `field_project` varchar(10) NOT NULL,
  `internships` varchar(10) NOT NULL,
  `stu_project` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_3_4_student_project`
--

INSERT INTO `cri_1_3_4_student_project` (`id`, `academic_year`, `department`, `register_no`, `stu_name`, `year`, `field_project`, `internships`, `stu_project`) VALUES
(1, '2022-2023', '621', '12345', 'MOHAN K', 'II - Year', 'Yes', 'No', 'Yes'),
(2, '2022-2023', '621', '18767', 'PRASANNA ', 'II - Year', 'Yes', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_4_1_doc_upload`
--

CREATE TABLE `cri_1_4_1_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `stu_sample` varchar(255) NOT NULL,
  `tea_sample` varchar(255) NOT NULL,
  `emp_sample` varchar(255) NOT NULL,
  `alu_sample` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_4_1_doc_upload`
--

INSERT INTO `cri_1_4_1_doc_upload` (`id`, `academic_year`, `upload_by`, `stu_sample`, `tea_sample`, `emp_sample`, `alu_sample`) VALUES
(1, '2023-2024', '621', '1698596047_653e84cfd5498.pdf', '1698596047_653e84cfd549e.pdf', '1698596047_653e84cfd54a0.pdf', '1698596047_653e84cfd54a1.pdf'),
(2, '2023-2024', '631', '1698596250_653e859a96cf4.pdf', '1698596250_653e859a96cfa.pdf', '1698596250_653e859a96cfc.pdf', '1698596250_653e859a96cfe.pdf'),
(3, '2023-2024', '621', '1701191689_65662009309a3.pdf', '1701191689_65662009309b0.pdf', '1701191689_65662009309b6.pdf', '1701191689_65662009309bc.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_4_2_doc_upload`
--

CREATE TABLE `cri_1_4_2_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_type` varchar(255) NOT NULL,
  `doc_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_4_2_doc_upload`
--

INSERT INTO `cri_1_4_2_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_type`, `doc_name`) VALUES
(4, '2023-2024', 'Criterion - 1', 'Feedback Policy', '1701268758_65674d16ee1a9.pdf'),
(5, '2023-2024', 'Criterion - 1', 'Action Taken Report', '1701268758_65674d16ee1bd.pdf'),
(8, '2023-2024', '621', 'Feedback Analysis', '1701270359_65675357d9391.pdf'),
(9, '2023-2024', '621', 'Evidences', '1701270359_65675357d939b.pdf'),
(10, '2023-2024', '631', 'Feedback Analysis', '1701355178_65689eaacc8ac.pdf'),
(11, '2023-2024', '631', 'Evidences', '1701355178_65689eaacc8b2.pdf'),
(12, '2023-2024', 'Criterion - 1', 'Feedback Policy', '1701357964_6568a98cad25a.pdf'),
(13, '2023-2024', 'Criterion - 1', 'Action Taken Report', '1701357964_6568a98cad262.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_1_write_up`
--

CREATE TABLE `cri_1_write_up` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `criteria` varchar(25) NOT NULL,
  `write_up` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_1_write_up`
--

INSERT INTO `cri_1_write_up` (`id`, `academic_year`, `criteria`, `write_up`) VALUES
(4, '2022-2023', 'Metric 1.1.1', '<p><strong>Criteria 1.1.1</strong> <br><br>Curricula developed and implemented have relevance to the <em><strong>local, national, regional and global developmental</strong></em> needs which are reflected in <strong>Programme Outcomes (POs), Programme Specific Outcomes (PSOs) and Course Outcomes (COs)</strong> of the various Programmes offered by the Institution.</p>'),
(5, '2022-2023', 'Metric 1.3.1', '<p><strong>Criteria 1.3.1 </strong></p>\r\n<p>Institution integrates crosscutting issues relevant to <em><strong>Professional Ethics ,Gender, Human Values ,Environment and Sustainability</strong></em> into the Curriculum.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_1_1_doc_upload`
--

CREATE TABLE `cri_2_1_1_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_2_1_1_doc_upload`
--

INSERT INTO `cri_2_1_1_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 'Criterion - 2', '1703427854_65883f0e2d201.pdf'),
(3, '2022-2023', '621', '1703428661_65884235218d9.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_1_1_sanctioned_seats`
--

CREATE TABLE `cri_2_1_1_sanctioned_seats` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `programme_code` varchar(255) NOT NULL,
  `santioned_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_2_1_1_sanctioned_seats`
--

INSERT INTO `cri_2_1_1_sanctioned_seats` (`id`, `academic_year`, `programme_code`, `santioned_seats`) VALUES
(1, '2022-2023', '621', 10),
(2, '2022-2023', '631', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_1_1_student_details`
--

CREATE TABLE `cri_2_1_1_student_details` (
  `reg_no` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `programme_code` varchar(25) NOT NULL,
  `name` varchar(500) NOT NULL,
  `community` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_2_1_1_student_details`
--

INSERT INTO `cri_2_1_1_student_details` (`reg_no`, `academic_year`, `programme_code`, `name`, `community`) VALUES
('12345', '2022-2023', '621', 'MOHAN K', 'SCA'),
('12346', '2022-2023', '621', 'PRASANNA G', 'MBC'),
('45478', '2022-2023', '621', 'KOKILA V', 'SC'),
('4749', '2022-2023', '621', 'KUMAR V', 'ST'),
('475749', '2022-2023', '621', 'MALATHI M', 'MBC'),
('487894', '2022-2023', '621', 'AJAY V', 'BC'),
('48794', '2022-2023', '621', 'RAM M', 'BC'),
('87575', '2022-2023', '621', 'KUMAR V', ''),
('MBA001', '2022-2023', '631', 'RAM', 'OC');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_1_2_doc_upload`
--

CREATE TABLE `cri_2_1_2_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_2_1_2_doc_upload`
--

INSERT INTO `cri_2_1_2_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', '621', '1703508250_6589791a53224.pdf'),
(2, '2022-2023', 'Criterion - 1', '1703509116_65897c7c93da0.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_1_2_reserved_categories`
--

CREATE TABLE `cri_2_1_2_reserved_categories` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `programme_code` varchar(255) NOT NULL,
  `sc_category` int(11) NOT NULL,
  `st_category` int(11) NOT NULL,
  `obc_category` int(11) NOT NULL,
  `general_category` int(11) NOT NULL,
  `others` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_2_1_2_reserved_categories`
--

INSERT INTO `cri_2_1_2_reserved_categories` (`id`, `academic_year`, `programme_code`, `sc_category`, `st_category`, `obc_category`, `general_category`, `others`) VALUES
(2, '2022-2023', '621', 2, 1, 5, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_2_1_doc_upload`
--

CREATE TABLE `cri_2_2_1_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_2_1_doc_upload`
--

INSERT INTO `cri_2_2_1_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 'Criterion - 2', '1708329468_65d309fc7b7fb.pdf'),
(2, '2022-2023', '621', '1708330722_65d30ee2e5aa1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_2_1_spc_programmes`
--

CREATE TABLE `cri_2_2_1_spc_programmes` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(15) NOT NULL,
  `department` varchar(255) NOT NULL,
  `type` varchar(500) NOT NULL,
  `organizer` varchar(500) NOT NULL,
  `resource_person` varchar(1000) NOT NULL,
  `topic` varchar(500) NOT NULL,
  `days` int(11) NOT NULL,
  `sdate` date NOT NULL,
  `edate` varchar(20) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_2_1_spc_programmes`
--

INSERT INTO `cri_2_2_1_spc_programmes` (`id`, `academic_year`, `department`, `type`, `organizer`, `resource_person`, `topic`, `days`, `sdate`, `edate`, `doc_name`) VALUES
(1, '2022-2023', '621', 'kdfhdfl fldjfdl', 'dklfdfj fkljdfld', 'dfdljf ldfdfjldf', 'dklej fdlfjdf fjk', 3, '2024-03-09', '2024-03-11', '../../Uploaded Documents/Criteria - 2/1708619933_65d7789d35a3f.pdf'),
(2, '2022-2023', '621', 'kf jfkdjf dfkdjfld', 'dfjd  fjdlf dfdf', 'kjfd fdkjfdl fkjdfdl', 'dfjdf fjdfd flfkjdlfjdlfk', 1, '2024-02-23', '-', '../../Uploaded Documents/Criteria - 2/1708665576_65d82ae872f52.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_2_2_doc_upload`
--

CREATE TABLE `cri_2_2_2_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `teacher_list` varchar(500) NOT NULL,
  `student_list` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_2_2_doc_upload`
--

INSERT INTO `cri_2_2_2_doc_upload` (`id`, `academic_year`, `upload_by`, `teacher_list`, `student_list`) VALUES
(2, '2022-2023', '621', '1708704295_65d8c2271c693.pdf', '1708704295_65d8c2271c699.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_2_2_full_time_teacher`
--

CREATE TABLE `cri_2_2_2_full_time_teacher` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `department` varchar(255) NOT NULL,
  `name` varchar(500) NOT NULL,
  `id_number` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `pan` varchar(30) NOT NULL,
  `appointment` varchar(30) NOT NULL,
  `joining_date` date NOT NULL,
  `leaving_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_2_2_full_time_teacher`
--

INSERT INTO `cri_2_2_2_full_time_teacher` (`id`, `academic_year`, `department`, `name`, `id_number`, `email`, `gender`, `designation`, `pan`, `appointment`, `joining_date`, `leaving_date`) VALUES
(1, '2022-2023', '621', 'MOHAN K', '123456', 'mohan@gmail.com', 'Male', 'Professor and Head', 'M1234J565', 'Permanent', '2002-03-09', '-'),
(2, '2022-2023', '631', 'PRASANNA G', '98784', 'prasanna@gmail.com', 'Male', 'Professpr', 'ABCD12F', 'Sanctioned Post', '2005-03-09', '2023-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_2_2_student_details`
--

CREATE TABLE `cri_2_2_2_student_details` (
  `reg_no` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `programme_code` varchar(25) NOT NULL,
  `name` varchar(500) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_2_2_student_details`
--

INSERT INTO `cri_2_2_2_student_details` (`reg_no`, `academic_year`, `programme_code`, `name`, `year`) VALUES
('47984', '2022-2023', '621', 'PRASANNA G', 2),
('847943', '2022-2023', '621', 'MOHAN K', 2),
('8733', '2022-2023', '621', 'AJAY V', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_3_1_doc_upload`
--

CREATE TABLE `cri_2_3_1_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `exp_learning` varchar(500) NOT NULL,
  `par_learning` varchar(500) NOT NULL,
  `pro_solving` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_3_1_doc_upload`
--

INSERT INTO `cri_2_3_1_doc_upload` (`id`, `academic_year`, `upload_by`, `exp_learning`, `par_learning`, `pro_solving`) VALUES
(1, '2022-2023', '621', '1708784855_65d9fcd7689a6.pdf', '1708784855_65d9fcd7689db.pdf', '1708784855_65d9fcd7689df.pdf'),
(2, '2022-2023', '621', '1708785360_65d9fed06ef20.pdf', '1708785360_65d9fed06ef26.pdf', '1708785360_65d9fed06ef29.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_3_2_doc_upload`
--

CREATE TABLE `cri_2_3_2_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_3_2_doc_upload`
--

INSERT INTO `cri_2_3_2_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', '621', '1708791431_65da16876a2ee.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_3_3_doc_upload`
--

CREATE TABLE `cri_2_3_3_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_type` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_3_3_doc_upload`
--

INSERT INTO `cri_2_3_3_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_type`, `doc_name`) VALUES
(1, '2022-2023', '621', 'Mentor List', '1708794539_65da22ab6a6d2.pdf'),
(2, '2022-2023', 'Criterion - 2', 'Circulars', '1708795092_65da24d4e15ed.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_3_3_ratio`
--

CREATE TABLE `cri_2_3_3_ratio` (
  `id` int(11) NOT NULL,
  `programme_code` varchar(200) NOT NULL,
  `academic_year` varchar(200) NOT NULL,
  `no_of_mentor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_3_3_ratio`
--

INSERT INTO `cri_2_3_3_ratio` (`id`, `programme_code`, `academic_year`, `no_of_mentor`) VALUES
(2, '621', '2022-2023', 10),
(3, '631', '2022-2023', 13);

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_3_4_doc_upload`
--

CREATE TABLE `cri_2_3_4_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_3_4_doc_upload`
--

INSERT INTO `cri_2_3_4_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', '621', '1708793397_65da1e35b9ab7.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_4_1_doc_upload`
--

CREATE TABLE `cri_2_4_1_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_4_1_doc_upload`
--

INSERT INTO `cri_2_4_1_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 'Criterion - 2', '1708878635_65db6b2b99139.pdf'),
(2, '2022-2023', '621', '1708888312_65db90f824a09.pdf'),
(3, '2022-2023', '621', '1708888666_65db925a5ace7.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_4_1_sanctioned_posts`
--

CREATE TABLE `cri_2_4_1_sanctioned_posts` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `programme_code` varchar(50) NOT NULL,
  `sanctioned_posts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_4_1_sanctioned_posts`
--

INSERT INTO `cri_2_4_1_sanctioned_posts` (`id`, `academic_year`, `programme_code`, `sanctioned_posts`) VALUES
(1, '2022-2023', '621', 4),
(2, '2022-2023', '631', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_4_2_doc_upload`
--

CREATE TABLE `cri_2_4_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` int(11) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_4_2_doc_upload`
--

INSERT INTO `cri_2_4_2_doc_upload` (`doc_id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 621, '1717336209_665c7891c4ced.pdf'),
(2, '2022-2023', 0, '1717826313_6663f30993a59.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_4_2_teachers`
--

CREATE TABLE `cri_2_4_2_teachers` (
  `t_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `teacher_name` varchar(1000) NOT NULL,
  `qualification` varchar(1000) NOT NULL,
  `research_guide` varchar(1000) NOT NULL,
  `recognition_year` varchar(1000) NOT NULL,
  `still_serving` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_4_2_teachers`
--

INSERT INTO `cri_2_4_2_teachers` (`t_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `teacher_name`, `qualification`, `research_guide`, `recognition_year`, `still_serving`) VALUES
(1, '2022-2023', 4, 'MOHAN K', 'Dr.N.Mahendran', 'Ph.D & 1999', 'Yes', '2002', 'Yes'),
(2, '2022-2023', 4, 'MOHAN K', 'Dr.R.Vandhiyan', 'Ph.D & 2020', 'No', 'NIL', 'No/ May - 2023'),
(3, '2022-2023', 4, 'MOHAN K', 'Dr.GVT Gopala Krishna', 'Ph.D & 2007', 'Yes', '2012', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_4_3_doc_upload`
--

CREATE TABLE `cri_2_4_3_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_4_3_doc_upload`
--

INSERT INTO `cri_2_4_3_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 'Criterion - 2', '1708959007_65dca51f28fa8.pdf'),
(2, '2022-2023', '621', '1708963530_65dcb6ca1f35c.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_6_1_doc_upload`
--

CREATE TABLE `cri_2_6_1_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_6_1_doc_upload`
--

INSERT INTO `cri_2_6_1_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 'Criterion - 2', '1709097036_65dec04c52079.pdf'),
(2, '2022-2023', '621', '1709097747_65dec313caa8e.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_6_2_doc_upload`
--

CREATE TABLE `cri_2_6_2_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_6_2_doc_upload`
--

INSERT INTO `cri_2_6_2_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 'Criterion - 2', '1709098834_65dec7526d1cd.pdf'),
(2, '2022-2023', '621', '1709099191_65dec8b7a97ba.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_6_3_doc_upload`
--

CREATE TABLE `cri_2_6_3_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `name_list` varchar(500) NOT NULL,
  `result_proof` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_6_3_doc_upload`
--

INSERT INTO `cri_2_6_3_doc_upload` (`id`, `academic_year`, `upload_by`, `name_list`, `result_proof`) VALUES
(2, '2022-2023', '621', '1709050705_65de0b51b6199.pdf', '1709050705_65de0b51b61a0.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_6_3_pass_percentage`
--

CREATE TABLE `cri_2_6_3_pass_percentage` (
  `reg_no` varchar(50) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `programme_code` varchar(25) NOT NULL,
  `name` varchar(500) NOT NULL,
  `result` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_6_3_pass_percentage`
--

INSERT INTO `cri_2_6_3_pass_percentage` (`reg_no`, `academic_year`, `programme_code`, `name`, `result`) VALUES
('3684368', '2022-2023', '621', 'MOHAN K', 'PASS'),
('4574', '2022-2023', '621', 'MALATHI M', 'PASS'),
('48489', '2022-2023', '631', 'PRASANNA G', 'PASS'),
('489754', '2022-2023', '621', 'RAM M', 'FAIL'),
('5499857', '2022-2023', '621', 'JAYA R', 'PASS');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_7_1_doc_upload`
--

CREATE TABLE `cri_2_7_1_doc_upload` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by` varchar(255) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_2_7_1_doc_upload`
--

INSERT INTO `cri_2_7_1_doc_upload` (`id`, `academic_year`, `upload_by`, `doc_name`) VALUES
(1, '2022-2023', 'Criterion - 2', '1709046435_65ddfaa3418e5.pdf'),
(2, '2022-2023', '621', '1709046725_65ddfbc5b50b2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_2_write_up`
--

CREATE TABLE `cri_2_write_up` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `criteria` varchar(25) NOT NULL,
  `write_up` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_2_write_up`
--

INSERT INTO `cri_2_write_up` (`id`, `academic_year`, `criteria`, `write_up`) VALUES
(9, '2022-2023', 'Metric 2.2.1', '<p dir=\"ltr\">PSNACET assesses the learning levels of the students in two ways at the time of the commencement of the programme. Students enrolled in various disciplines are identified as slow and advanced learners based on their +2 marks and the entry level test conducted by each department. This helps to identify the slow learners and to design special coaching/tutorial sessions to bridge the gap between the slow learners and the advanced learners.&nbsp;</p>\r\n<p dir=\"ltr\"><strong>Strategies adopted for slow learners&nbsp;</strong></p>\r\n<p dir=\"ltr\">Remedial Classes are conducted, Academic and personal counseling are given,&nbsp; Bilingual explanation and discussions are imparted,&nbsp;</p>\r\n<p dir=\"ltr\"><strong>Strategies for the advanced learners&nbsp;</strong></p>\r\n<p dir=\"ltr\">Advanced learners are identified in all the courses using the performance indicators in various continuous assessment components.&nbsp;</p>\r\n<p dir=\"ltr\">Coaching is also given in Skill Development Programme like Communicative English, Aptitude, special training programs, competitions, seminars, conferences and Placement. NPTEL, SWAYAM, and ORACLE &amp; JAVA certifications and are provided</p>\r\n<p>Students are encouraged to participate and present papers in Seminars / Conferences / Workshops / Inter-Collegiate Competitions organized by other colleges.</p>'),
(10, '2022-2023', 'Metric 2.3.1', '<p>The College practices a teaching methodology which focuses on imparting education through a student centric approach. The teaching-learning process is one major objective and the strength of our college. Students are given a right blend of traditional and modern methods to make learning student-centric and a rewarding experience. The institution adopts various student centric methods to enhance student&rsquo;s involvement as part of experiential learning, participative learning and problem-solving methodology to ensure the holistic development of students and facilitate life-long learning and knowledge management. <br><br><strong>Experiential Learning</strong> <br><br>The students are involved in experiential learning by doing mini projects, major curriculum projects and through internships in industry. Students also participate in competitions, symposia, conferences at both national and international level for real time exposure. <br><br><strong>Participative Learning</strong> <br><br>Students take part in participative learning by doing role plays. Departments organize student activities to promote the spirit of teamwork like NSS camps, institutional social responsibility through Red Cross, village adoption, tree plantation, Swachh Bharat and health awareness camp. <br><br><strong>Problem-Solving Skills</strong> <br><br>Students enhance their problem-solving skills by doing case studies.</p>'),
(11, '2022-2023', 'Metric 2.3.2', '<p>In addition to chalk and talk method of teaching, the faculty members use the ICT enabled learning tools such as PPT, Video clippings, Audio system, online sources, to expose the students for advanced knowledge and practical learning. The classrooms and labs are ICT enabled with projectors installed and the campus is enabled with high speed Wi-Fi connection. The multimedia projectors are also enabled with Bluetooth connectivity so that &lsquo;Any cast WiFi HDMI dongle&rsquo; is connected to display the lecture contents directly from one&rsquo;s Android mobile phone.<br><br><strong>The faculty at PSNACET use various ICT enabled tools to enhance the quality of teaching-learning like</strong> <br><br>1. Google classroom is used to manage and post course related information - learning material, Quizzes, lab submissions and evaluations, assignments, etc.<br>2. Virtual labs are used to conduct labs through simulations.&nbsp;<br>3. Online drawing tools like concept maps, mind maps are used to perform student centric Activities.</p>'),
(12, '2022-2023', 'Metric 2.3.4', '<p><strong>Criteria 2.3.4</strong> - Preparation and adherence to Academic Calendar and Teaching Plans by the institution.</p>'),
(14, '2022-2023', 'Metric 2.6.1', '<p dir=\"ltr\">The University has clearly stated the learning outcomes for all its academic Programs and Courses.&nbsp; The syllabi of courses are designed based on the desired learning outcomes. Based on the strict compliance with the objectives of Outcome Based Education (OBE), Course Outcomes (COs) are framed by the department. COs are direct statements that describe the essential and enduring disciplinary knowledge, abilities that students should possess and the depth of learning. The course outcomes are defined by the faculty members using Bloom\'s taxonomy. Each course in the program consists of five to seven course outcomes by considering POs and PSOs of our department. <br><br>Program Outcomes (POs) are broad statements that describe the professional accomplishments and these are to be attained by the students by the time they complete the program. Program specific outcomes (PSOs) are the specific skill requirements and accomplishments to be fulfilled by the students at micro level by the end of the program.</p>\r\n<p dir=\"ltr\">The PEOs have been categorized into three sections such as Academic Values, Social Sensibilities and Moral and Spiritual Values.</p>'),
(15, '2022-2023', 'Metric 2.6.2', '<p><strong>Method of Assessment of POs / PSOs</strong> <br><br>The Program Outcomes and Program Specific Outcomes are assessed with the help of course outcomes of the relevant courses through direct and indirect methods. <br><br>Direct methods are provided through direct examinations or observations of student knowledge or skills. <br><br>At the end of each semester, university conducts examinations based on the result published by university, the course outcomes are measured. <br><br>Assignments are given at the end of each module/unit. The attainment of Course Outcomes of all courses are given, <br><br>% of CO attainment&nbsp; &nbsp; &nbsp; &gt;=60%&nbsp; &nbsp; &nbsp; &nbsp;&gt;=51% &amp;&lt; 60%&nbsp; &nbsp; &nbsp; &nbsp;&lt; 50% <br>CO attainment level&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 3&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_1_2_seed_money`
--

CREATE TABLE `cri_3_1_2_seed_money` (
  `sm_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `seed_money` double NOT NULL,
  `month_year` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_1_2_seed_money`
--

INSERT INTO `cri_3_1_2_seed_money` (`sm_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `teacher_name`, `seed_money`, `month_year`) VALUES
(1, '2022-2023', 7, 'MOHAN K', 'MOHAN K', 1.57, 'JUNE 2024');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_1_3_award_fellowship`
--

CREATE TABLE `cri_3_1_3_award_fellowship` (
  `af_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `award_fellowship` varchar(50) NOT NULL,
  `month_year` varchar(500) NOT NULL,
  `award_agency` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_1_3_award_fellowship`
--

INSERT INTO `cri_3_1_3_award_fellowship` (`af_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `teacher_name`, `award_fellowship`, `month_year`, `award_agency`) VALUES
(1, '2022-2023', 7, 'MOHAN K', 'MOHAN K', 'Award Name', 'JUNE 2024', 'ABC Agency');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_2_1_grants_received`
--

CREATE TABLE `cri_3_2_1_grants_received` (
  `gr_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `principal_name` varchar(500) NOT NULL,
  `principal_dept` varchar(500) NOT NULL,
  `agency_name` varchar(500) NOT NULL,
  `type` varchar(500) NOT NULL,
  `fund` varchar(500) NOT NULL,
  `month_year` varchar(500) NOT NULL,
  `duration` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_2_1_grants_received`
--

INSERT INTO `cri_3_2_1_grants_received` (`gr_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `principal_name`, `principal_dept`, `agency_name`, `type`, `fund`, `month_year`, `duration`) VALUES
(1, '2022-2023', 7, 'MOHAN K', 'Investigation and development of enhanced siddha diagnostic uroscopy Neikuri using dynamic image processing', 'Electronics and Communication Engineering', 'All India Council for Technical Education/Indian Knowledge System', 'Government', '7.00', '2022-23', '2 Years');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_3_2_workshops_seminars`
--

CREATE TABLE `cri_3_3_2_workshops_seminars` (
  `ws_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `seminar_name` varchar(500) NOT NULL,
  `participants` varchar(500) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_3_2_workshops_seminars`
--

INSERT INTO `cri_3_3_2_workshops_seminars` (`ws_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `seminar_name`, `participants`, `from_date`, `to_date`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'How to Build your Self-esteem?', '71', '2022-06-06', '0000-00-00'),
(2, '2022-2023', 2, 'MOHAN K', 'Linguaskill from Cambridge', '65', '2023-03-14', '2023-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_4_2_scholar`
--

CREATE TABLE `cri_3_4_2_scholar` (
  `s_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `teacher_name` varchar(1000) NOT NULL,
  `scholar_name` varchar(1000) NOT NULL,
  `registration_year` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_4_2_scholar`
--

INSERT INTO `cri_3_4_2_scholar` (`s_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `teacher_name`, `scholar_name`, `registration_year`, `title`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'Dr.N.Mahendran', 'Mr. P. Muthuanand', 'JUNE 2023', 'Behavioural Study on Geopolymer Concrete with Bagasse Ash and Nano Metakaolin'),
(2, '2022-2023', 2, 'MOHAN K', 'Dr.GVT Gopala Krishna', 'Mr.A Chandrasekar', 'JUNE 2021', 'Strength and durability characteristics on self-compacting concrete with sugarcane bagasse ash and rise husk ash as partial replacement of sand'),
(3, '2022-2023', 2, 'MOHAN K', 'Dr.N.Mahendran', 'Ms. M. Kohila Devi', 'JUNE 2022', 'Seismic Study on Geosynthetic Reinforced Concrete Frames');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_4_3_research_paper`
--

CREATE TABLE `cri_3_4_3_research_paper` (
  `rp_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `author_name` varchar(1000) NOT NULL,
  `department` varchar(1000) NOT NULL,
  `paper_title` varchar(1000) NOT NULL,
  `journal_name` varchar(1000) NOT NULL,
  `month_year` varchar(1000) NOT NULL,
  `issn` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_4_3_research_paper`
--

INSERT INTO `cri_3_4_3_research_paper` (`rp_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `author_name`, `department`, `paper_title`, `journal_name`, `month_year`, `issn`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'MOHAN K', 'MCA', 'ABC PAPER', 'ABC Journal', 'JUNE 2024', '1234ABC');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_4_4_edited_books`
--

CREATE TABLE `cri_3_4_4_edited_books` (
  `eb_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `teacher_name` varchar(1000) NOT NULL,
  `book_title` varchar(1000) NOT NULL,
  `chapter_title` varchar(1000) NOT NULL,
  `conference_title` varchar(1000) NOT NULL,
  `conference_name` varchar(1000) NOT NULL,
  `conference_type` varchar(1000) NOT NULL,
  `month_year` varchar(1000) NOT NULL,
  `isbn` varchar(1000) NOT NULL,
  `affiliating_institute` varchar(1000) NOT NULL,
  `publisher_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_4_4_edited_books`
--

INSERT INTO `cri_3_4_4_edited_books` (`eb_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `teacher_name`, `book_title`, `chapter_title`, `conference_title`, `conference_name`, `conference_type`, `month_year`, `isbn`, `affiliating_institute`, `publisher_name`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'MOHAN K', 'ABC Published', 'ABC Chapter', 'ABC Conference', 'ABC Conference', 'International', 'JUNE 2024', 'ISBN1234', 'PSNA College', 'ABC Publisher');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_4_5_citation_index`
--

CREATE TABLE `cri_3_4_5_citation_index` (
  `ci_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `paper_title` varchar(1000) NOT NULL,
  `author_name` varchar(1000) NOT NULL,
  `journal_titile` varchar(1000) NOT NULL,
  `month_year` varchar(1000) NOT NULL,
  `citation_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_4_5_citation_index`
--

INSERT INTO `cri_3_4_5_citation_index` (`ci_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `paper_title`, `author_name`, `journal_titile`, `month_year`, `citation_index`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'ABC Paper', 'MOHAN K', 'ABC Journal', '2024', 6);

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_4_6_h_index`
--

CREATE TABLE `cri_3_4_6_h_index` (
  `hi_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `paper_title` varchar(1000) NOT NULL,
  `author_name` varchar(1000) NOT NULL,
  `journal_titile` varchar(1000) NOT NULL,
  `month_year` varchar(1000) NOT NULL,
  `h_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_4_6_h_index`
--

INSERT INTO `cri_3_4_6_h_index` (`hi_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `paper_title`, `author_name`, `journal_titile`, `month_year`, `h_index`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'ABC Title', 'MOHAN K', 'ABC Journal', '2024', 10);

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_5_1_revenue_generated`
--

CREATE TABLE `cri_3_5_1_revenue_generated` (
  `rg_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `consultants_name` varchar(1000) NOT NULL,
  `consultancy_project` varchar(1000) NOT NULL,
  `contact_details` varchar(1000) NOT NULL,
  `revenue_generated` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_5_1_revenue_generated`
--

INSERT INTO `cri_3_5_1_revenue_generated` (`rg_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `consultants_name`, `consultancy_project`, `contact_details`, `revenue_generated`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'ABC', 'ABC Project', 'ABC City', '4');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_5_2_revenue_generated`
--

CREATE TABLE `cri_3_5_2_revenue_generated` (
  `rg_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `consultants_name` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `contact_details` varchar(1000) NOT NULL,
  `revenue_generated` varchar(1000) NOT NULL,
  `no_trainees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_5_2_revenue_generated`
--

INSERT INTO `cri_3_5_2_revenue_generated` (`rg_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `consultants_name`, `title`, `contact_details`, `revenue_generated`, `no_trainees`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'ABC Corporate', 'ABC Programme', 'ABC City', '10000', 500);

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_6_2_awards_received`
--

CREATE TABLE `cri_3_6_2_awards_received` (
  `ar_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `stu_tea_name` varchar(1000) NOT NULL,
  `award_name` varchar(1000) NOT NULL,
  `award_body` varchar(1000) NOT NULL,
  `month_year` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_6_2_awards_received`
--

INSERT INTO `cri_3_6_2_awards_received` (`ar_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `stu_tea_name`, `award_name`, `award_body`, `month_year`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'Blood Donation', 'National blood donation day', 'Meenakshi Mission Hospital, Madurai', 'JUNE 2022');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_6_3_extension_activities`
--

CREATE TABLE `cri_3_6_3_extension_activities` (
  `ea_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `activity_name` varchar(1000) NOT NULL,
  `organising_unit` varchar(1000) NOT NULL,
  `scheme_name` varchar(1000) NOT NULL,
  `month_year` varchar(1000) NOT NULL,
  `no_of_students` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_6_3_extension_activities`
--

INSERT INTO `cri_3_6_3_extension_activities` (`ea_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `activity_name`, `organising_unit`, `scheme_name`, `month_year`, `no_of_students`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'Food Donation at Dindigul', 'YRC/Rotaract', 'Human Welfare', 'JUNE 2023', '32');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_7_1_collaborating_agency`
--

CREATE TABLE `cri_3_7_1_collaborating_agency` (
  `ca_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `collaborating_agency` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_7_1_collaborating_agency`
--

INSERT INTO `cri_3_7_1_collaborating_agency` (`ca_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `collaborating_agency`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'M/s. Propel Systems Pvt Ltd, Chennai'),
(2, '2022-2023', 2, 'MOHAN K', 'Zoho Corporation Pvt. Ltd., Chennai, Tamil Nadu, India');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_7_1_collaborating_agency_student`
--

CREATE TABLE `cri_3_7_1_collaborating_agency_student` (
  `cas_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `activity` varchar(1000) NOT NULL,
  `collaborating_agency` varchar(1000) NOT NULL,
  `participant` varchar(1000) NOT NULL,
  `duration` varchar(1000) NOT NULL,
  `activity_nature` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_7_1_collaborating_agency_student`
--

INSERT INTO `cri_3_7_1_collaborating_agency_student` (`cas_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `activity`, `collaborating_agency`, `participant`, `duration`, `activity_nature`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'Student Internship', 'Zoho Corporation Pvt. Ltd., Chennai, Tamil Nadu, India', 'Ajay S', '21.09.2022 to 31.05.2023', 'ABCDEF');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_7_2_mou_activities`
--

CREATE TABLE `cri_3_7_2_mou_activities` (
  `md_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `activities` varchar(1000) NOT NULL,
  `no_of_students` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_7_2_mou_activities`
--

INSERT INTO `cri_3_7_2_mou_activities` (`md_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `name`, `activities`, `no_of_students`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'All Indis Institute of Ayurveda (AIIA), New Delhi, Under miinistry of AYUSH (MoA), Gautampuri, Mathura Road, New Delhi 110076', 'Training Programme', '70');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_7_2_mou_details`
--

CREATE TABLE `cri_3_7_2_mou_details` (
  `md_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `month_year` varchar(1000) NOT NULL,
  `duration` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_7_2_mou_details`
--

INSERT INTO `cri_3_7_2_mou_details` (`md_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `name`, `month_year`, `duration`) VALUES
(1, '2022-2023', 2, 'MOHAN K', 'All Indis Institute of Ayurveda (AIIA), New Delhi, Under miinistry of AYUSH (MoA), Gautampuri, Mathura Road, New Delhi 110076', 'JUNE 2024', '1 Year'),
(2, '2022-2023', 2, 'MOHAN K', 'Mahendra Pumps Private Limited, 733, Puliakulam road, Coimbatore 624 045', 'JUNE 2023', '1 year');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_choice`
--

CREATE TABLE `cri_3_choice` (
  `choice_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `metric` varchar(30) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `choice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_choice`
--

INSERT INTO `cri_3_choice` (`choice_id`, `academic_year`, `metric`, `upload_by_id`, `upload_by_name`, `choice`) VALUES
(1, '2022-2023', 'Metric 3.4.1', 8, 'MOHAN K', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_doc_upload`
--

CREATE TABLE `cri_3_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `criteria` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_doc_upload`
--

INSERT INTO `cri_3_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `criteria`, `description`, `doc_name`) VALUES
(1, '2022-2023', 7, 'MOHAN K', 'Metric 3.1.2', 'Criteria 3.1.2', '1717068772_665863e486c00.pdf'),
(2, '2022-2023', 8, 'MOHAN K', 'Metric 3.1.2', 'Criteria 3.1.2', '1717077007_6658840fa12e5.pdf'),
(5, '2022-2023', 7, 'MOHAN K', 'Metric 3.1.3', 'Criteria 3.1.3', '1717155356_6659b61c4df1f.pdf'),
(9, '2022-2023', 2, 'MOHAN K', 'Metric 3.2.1', 'Criteria 3.2.1 Department', '1717156765_6659bb9db5312.pdf'),
(10, '2022-2023', 7, 'MOHAN K', 'Metric 3.2.1', 'Criteria 3.2.1 Head', '1717156835_6659bbe3a0205.pdf'),
(11, '2022-2023', 7, 'MOHAN K', 'Metric 3.2.2', 'Criteria 3.2.2', '1717159009_6659c46168a0b.pdf'),
(12, '2022-2023', 2, 'MOHAN K', 'Metric 3.2.2', 'Criteria 3.2.2 Department', '1717161181_6659ccdde1bb8.pdf'),
(13, '2022-2023', 7, 'MOHAN K', 'Metric 3.2.3', 'Criteria 3.2.3', '1717162004_6659d01418f49.pdf'),
(14, '2022-2023', 2, 'MOHAN K', 'Metric 3.2.3', 'Criteria 3.2.3 Department Proof', '1717162351_6659d16f3d463.pdf'),
(15, '2022-2023', 7, 'MOHAN K', 'Metric 3.3.1', 'Criteria 3.3.1', '1717164143_6659d86fa059f.pdf'),
(16, '2022-2023', 2, 'MOHAN K', 'Metric 3.3.1', 'Criteria 3.3.1 Department Proof', '1717164375_6659d957ec9ee.pdf'),
(17, '2022-2023', 2, 'MOHAN K', 'Metric 3.3.2', 'Criteria 3.3.2 Department Proof', '1717225733_665ac9053d423.pdf'),
(18, '2022-2023', 8, 'MOHAN K', 'Metric 3.3.2', 'Criteria 3.3.2 Proof', '1717226313_665acb490625d.pdf'),
(21, '2022-2023', 2, 'MOHAN K', 'Metric 3.7.2', 'Criteria 3.7.2 Department', '1717245326_665b158e25b5d.pdf'),
(32, '2022-2023', 4, 'MOHAN K', 'Metric 3.4.2', 'Criteria 3.4.2 Dept', '1717343627_665c958b1381b.pdf'),
(33, '2022-2023', 2, 'MOHAN K', 'Metric 3.4.3', 'DETP Proof', '1717832080_66640990ba868.pdf'),
(34, '2022-2023', 10, 'MOHAN K', 'Metric 3.4.3', 'Criteria Proof', '1717832839_66640c87bf9db.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_3_write_up`
--

CREATE TABLE `cri_3_write_up` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `criteria` varchar(25) NOT NULL,
  `write_up` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_3_write_up`
--

INSERT INTO `cri_3_write_up` (`id`, `academic_year`, `criteria`, `write_up`) VALUES
(1, '2022-2023', 'Metric 3.1.1', '<p><strong>Criteria 3.1.1</strong> - The institution&rsquo;s research facilities are frequently updated and there is a welldefined policy for promotion of research which is uploaded on the institutional website and implemented.</p>'),
(2, '2022-2023', 'Metric 3.3.1', '<p><strong>Criteria 3.3.1</strong> - Institution has created an ecosystem for innovations and creation and transfer of knowledge supported by dedicated centres for research, entrepreneurship,community orientation, incubation, etc.</p>'),
(3, '2022-2023', 'Metric 3.6.1', '<p><strong>Criteria 3.6.1</strong> - Extension activities carried out in the neighbourhood sensitising students to social issues for their holistic development, and the impact thereof during the year.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_1_1_doc_upload`
--

CREATE TABLE `cri_4_1_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_1_1_doc_upload`
--

INSERT INTO `cri_4_1_1_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(3, '2022-2023', 4, 'MOHAN K', 'kdfld dlfjdlf', '1710058830_65ed6d4e76043.pdf'),
(5, '2022-2023', 7, 'MOHAN K', '1234', '1710059435_65ed6fab2dc13.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_1_2_doc_upload`
--

CREATE TABLE `cri_4_1_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_1_2_doc_upload`
--

INSERT INTO `cri_4_1_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(2, '2022-2023', 7, 'MOHAN K', 'ABCD', '1710063480_65ed7f78d5797.pdf'),
(3, '2022-2023', 4, 'MOHAN K', 'BCD', '1710063821_65ed80cd8c078.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_1_3_classrooms_seminarhalls`
--

CREATE TABLE `cri_4_1_3_classrooms_seminarhalls` (
  `class_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `room_no` text NOT NULL,
  `ict_facility` text NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_1_4_infrastructure_expenditure`
--

CREATE TABLE `cri_4_1_4_infrastructure_expenditure` (
  `exp_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `budget_allocated` float NOT NULL,
  `expenditure` float NOT NULL,
  `tot_expenditure` float NOT NULL,
  `maintenace_aca_fac` float NOT NULL,
  `maintenance_phy_fac` float NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_1_4_infrastructure_expenditure`
--

INSERT INTO `cri_4_1_4_infrastructure_expenditure` (`exp_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `budget_allocated`, `expenditure`, `tot_expenditure`, `maintenace_aca_fac`, `maintenance_phy_fac`, `doc_name`) VALUES
(2, '2022-2023', 4, 'MOHAN K', 167.12, 224.49, 1074.66, 55.99, 271.79, '1710155299_65eee62363c92.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_2_1_doc_upload`
--

CREATE TABLE `cri_4_2_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_2_1_doc_upload`
--

INSERT INTO `cri_4_2_1_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 7, 'MOHAN K', 'Screen Shots', '1710397993_65f29a29afc84.pdf'),
(2, '2022-2023', 4, 'MOHAN K', 'Proof', '1710398473_65f29c0959570.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_2_2_doc_upload`
--

CREATE TABLE `cri_4_2_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_2_2_doc_upload`
--

INSERT INTO `cri_4_2_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 6, 'MOHAN K', 'Proof', '1710416883_65f2e3f3c6e4f.pdf'),
(2, '2022-2023', 4, 'MOHAN K', 'Proof', '1710419205_65f2ed0535026.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_2_2_options`
--

CREATE TABLE `cri_4_2_2_options` (
  `option_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_2_2_options`
--

INSERT INTO `cri_4_2_2_options` (`option_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `option`) VALUES
(1, '2022-2023', 6, 'MOHAN K', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_2_3_doc_upload`
--

CREATE TABLE `cri_4_2_3_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_2_3_doc_upload`
--

INSERT INTO `cri_4_2_3_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 4, 'MOHAN K', 'Proof', '1710413057_65f2d50126838.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_2_4_doc_upload`
--

CREATE TABLE `cri_4_2_4_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_2_4_doc_upload`
--

INSERT INTO `cri_4_2_4_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 4, 'MOHAN K', 'Last Page', '1710405436_65f2b73c4a0ad.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_2_4_library_usage`
--

CREATE TABLE `cri_4_2_4_library_usage` (
  `user_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `method` varchar(500) NOT NULL,
  `e_access` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  `student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_2_4_library_usage`
--

INSERT INTO `cri_4_2_4_library_usage` (`user_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `method`, `e_access`, `teacher`, `student`) VALUES
(1, '2022-2023', 4, 'MOHAN K', 'Method of Computing', 10, 12, 14);

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_3_1_doc_upload`
--

CREATE TABLE `cri_4_3_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_3_1_doc_upload`
--

INSERT INTO `cri_4_3_1_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 7, 'MOHAN K', 'Bill Report', '1710171064_65ef23b8828cc.pdf'),
(2, '2022-2023', 4, 'MOHAN K', 'BCD', '1710171895_65ef26f757bfe.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_3_2_computer_ratio`
--

CREATE TABLE `cri_4_3_2_computer_ratio` (
  `com_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `computer_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_3_2_computer_ratio`
--

INSERT INTO `cri_4_3_2_computer_ratio` (`com_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `department`, `computer_count`) VALUES
(1, '2022-2023', 7, 'MOHAN K', 'Department of Computer Applications - MCA', 64);

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_3_2_doc_upload`
--

CREATE TABLE `cri_4_3_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_3_2_doc_upload`
--

INSERT INTO `cri_4_3_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(2, '2022-2023', 4, 'MOHAN K', 'Computer List - MCA', '1710383833_65f262d9e229f.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_3_3_doc_upload`
--

CREATE TABLE `cri_4_3_3_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_3_3_doc_upload`
--

INSERT INTO `cri_4_3_3_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 6, 'MOHAN K', 'Bill', '1710353770_65f1ed6a4ca49.pdf'),
(2, '2022-2023', 4, 'MOHAN K', 'Bill 1', '1710354127_65f1eecfa78a2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_3_3_options`
--

CREATE TABLE `cri_4_3_3_options` (
  `option_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `option` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_3_3_options`
--

INSERT INTO `cri_4_3_3_options` (`option_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `option`) VALUES
(3, '2022-2023', 7, 'MOHAN K', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_3_4_doc_upload`
--

CREATE TABLE `cri_4_3_4_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_3_4_doc_upload`
--

INSERT INTO `cri_4_3_4_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 6, 'MOHAN K', 'Proof', '1710411797_65f2d015b5d87.pdf'),
(2, '2022-2023', 4, 'MOHAN K', 'Proof 2', '1710412435_65f2d29399804.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_3_4_options`
--

CREATE TABLE `cri_4_3_4_options` (
  `option_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_3_4_options`
--

INSERT INTO `cri_4_3_4_options` (`option_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `option`) VALUES
(1, '2022-2023', 6, 'MOHAN K', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_4_1_doc_upload`
--

CREATE TABLE `cri_4_4_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_4_1_doc_upload`
--

INSERT INTO `cri_4_4_1_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(2, '2022-2023', 4, 'MOHAN K', 'Audited statements of accounts', '1710159938_65eef84275b6b.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_4_2_doc_upload`
--

CREATE TABLE `cri_4_4_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_4_2_doc_upload`
--

INSERT INTO `cri_4_4_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 7, 'MOHAN K', 'ABCD', '1710162307_65ef0183ed5e3.pdf'),
(2, '2022-2023', 4, 'MOHAN K', 'BCD', '1710162638_65ef02ce42c80.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_4_write_up`
--

CREATE TABLE `cri_4_write_up` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `criteria` varchar(24) NOT NULL,
  `write_up` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_4_write_up`
--

INSERT INTO `cri_4_write_up` (`id`, `academic_year`, `criteria`, `write_up`) VALUES
(1, '2022-2023', 'Metric 4.1.1', '<p>PSNA College of Engineering &amp; Technology is <strong>118.52-acre campus</strong> with built up area of <strong>1,11,073 Sq.m</strong> is a vibrant institute of highereducation with world-class infrastructure. The Institute hasadequate infrastructure and physical facilities to enable studentsto innovate, impart team spirit and have competence to enable themto face the global challenges and become a contributing member ofmodern society. The available facilities are more than the requirement prescribed bythe AICTE and Anna University by procuring additional equipment. Alllaboratories are fully equipped with latest equipment. In addition,there are 12 additional labs (other than curriculum labs). Theselaboratories provide expose students to latest in research andadvancements. The computing facility consists of licensed software(system software and applications software). The computingfacilities of the college cater to the needs of faculty and studentsto foster an effective Teaching Learning Process. The main librarywith an area of 2500 Sq.m with a seating capacity of 400 isavailable. The digital library is equipped with personal computerswhich are connected with Wi-Fi and LAN for fast and seamless access of the Internet for streaming NPTEL lectures and using e-Resourcesfor the benefit of its users.</p>'),
(2, '2022-2023', 'Metric 4.1.2', '<p>Sports and games have played an important role in the evolution&nbsp;ofPSNACET and now when PSNACET has completed thirty-eight years of&nbsp;itsacademic life, sports in PSNACET can definitely claim a fair&nbsp;sharein the progress of the institution. The college has&nbsp;excellentinfrastructure for sports and provides professional&nbsp;coaching insports to students. Regarding sports and games, PSNACET&nbsp;is equippedwith the following facilities for facilitating the&nbsp;students to takeup and practice sports activities. The residents&nbsp;play indoor gamessuch as tennis, badminton, ball badminton etc. in&nbsp;the in-doorstadium. All the college play grounds / play fields and&nbsp;all thehostel blocks are located in the college campus. Therefore,&nbsp;thehostel students can use all the sports and games facility that&nbsp;areavailable in college. There will be well furnished Gym&nbsp;facilitiesavailable to cater the needs of the students.In addition&nbsp;to sports and Gym facilities, a well-functioning YogaCenter has&nbsp;been established in our college to inculcate the practiceof doing&nbsp;yoga. College students can reap enormous benefits throughyoga&nbsp;classes on campus.</p>'),
(3, '2022-2023', 'Metric 4.4.2', '<p><strong>Criteria 4.4.2</strong> - There are established systems and procedures for maintaining and utilizing physical, academic and support facilities &ndash; classrooms, laboratory, library, sports complex, computers, etc.</p>'),
(4, '2022-2023', 'Metric 4.3.2', '<p><strong>Criteria 4.3.1</strong> - Institution has an IT policy covering Wi-Fi, cyber security, etc. and has allocated budget for updating its IT facilities.</p>'),
(5, '2022-2023', 'Metric 4.3.1', '<p><strong>Criteria 4.3.1</strong> - Institution has an IT policy covering Wi-Fi, cyber security, etc. and has allocated budget for updating its IT facilities.</p>'),
(6, '2022-2023', 'Metric 4.2.1', '<p><strong>Criteria 4.2.1</strong> - Library is automated using Integrated Library Management System (ILMS).</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_1_1_scholarships`
--

CREATE TABLE `cri_5_1_1_scholarships` (
  `s_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `type` varchar(200) NOT NULL,
  `scheme_name` varchar(1000) NOT NULL,
  `no_students` int(11) NOT NULL,
  `amount` double NOT NULL,
  `agency_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_1_1_scholarships`
--

INSERT INTO `cri_5_1_1_scholarships` (`s_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `type`, `scheme_name`, `no_students`, `amount`, `agency_name`) VALUES
(1, '2022-2023', 6, 'MALATHI M', 'Government', 'PMSS for SC/ST (maintenance fee & Tuition fee)', 169, 4234400, ''),
(2, '2022-2023', 6, 'MALATHI M', 'Institution', 'Institution Freeship - College Tution Fee & Hostel Fee Waiver', 493, 24205640, ''),
(3, '2022-2023', 6, 'MALATHI M', 'Government', 'BC/BCM/MBC/DNC Scholarship', 943, 5595570, '');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_1_3_capacity_development`
--

CREATE TABLE `cri_5_1_3_capacity_development` (
  `cd_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `scheme_name` varchar(1000) NOT NULL,
  `imp_year` varchar(1000) NOT NULL,
  `no_students` int(11) NOT NULL,
  `agency_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_1_3_capacity_development`
--

INSERT INTO `cri_5_1_3_capacity_development` (`cd_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `type`, `scheme_name`, `imp_year`, `no_students`, `agency_name`) VALUES
(1, '2022-2023', 6, 'AJAY V', 'Soft Skills', 'Shortcuts for Eigen values and Eigen vectors', '16-12-2022', 268, 'Mr.V.Sathyamoorthy, Co-Founder, Masters Academy Educator, Unacademy');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_1_5_placement`
--

CREATE TABLE `cri_5_1_5_placement` (
  `p_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `student_name` varchar(1000) NOT NULL,
  `programme` varchar(1000) NOT NULL,
  `employer_name` varchar(1000) NOT NULL,
  `package` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_1_5_placement`
--

INSERT INTO `cri_5_1_5_placement` (`p_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `student_name`, `programme`, `employer_name`, `package`) VALUES
(4, '2022-2023', 6, 'AJAY V', 'ARIRAJA K,arirajaucp007@gmail.com', 'B.E - CIVIL', 'URC CONSTRUCTION,www.urcindia.com', 1.8),
(5, '2022-2023', 6, 'AJAY V', 'BALAJI RAM T,balajiram2002@gmail.com', 'B.E - CIVIL', 'URC CONSTRUCTION,www.urcindia.com', 1.8);

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_1_5_students_benefitted`
--

CREATE TABLE `cri_5_1_5_students_benefitted` (
  `sb_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `activity_name` varchar(1000) NOT NULL,
  `student_participated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_1_5_students_benefitted`
--

INSERT INTO `cri_5_1_5_students_benefitted` (`sb_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `type`, `activity_name`, `student_participated`) VALUES
(1, '2022-2023', 6, 'AJAY V', 'Competitive Examinations', 'GATE2023: How to acquaint yourself with the exam?', 470),
(2, '2022-2023', 6, 'AJAY V', 'Career Counselling', 'Career Guidance Program on Investment Banking and Business Analytics', 60);

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_2_2_higher_education`
--

CREATE TABLE `cri_5_2_2_higher_education` (
  `he_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `student_name` varchar(1000) NOT NULL,
  `programme` varchar(1000) NOT NULL,
  `institution_joined` varchar(1000) NOT NULL,
  `programme_admitted` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_2_2_higher_education`
--

INSERT INTO `cri_5_2_2_higher_education` (`he_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `student_name`, `programme`, `institution_joined`, `programme_admitted`) VALUES
(1, '2022-2023', 6, 'AJAY V', 'MOHAN K', 'MCA', 'ABC Institution', 'P.hD');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_2_3_examinations`
--

CREATE TABLE `cri_5_2_3_examinations` (
  `e_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `roll_no` varchar(1000) NOT NULL,
  `selected_appeared` varchar(1000) NOT NULL,
  `exam_type` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_2_3_examinations`
--

INSERT INTO `cri_5_2_3_examinations` (`e_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `roll_no`, `selected_appeared`, `exam_type`) VALUES
(3, '2022-2023', 6, 'MALATHI M', 'BM23S47418010', 'Appeared & Selected / Qualified', 'GATE');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_3_1_awards_medals`
--

CREATE TABLE `cri_5_3_1_awards_medals` (
  `am_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `awards_name` varchar(1000) NOT NULL,
  `team_individual` varchar(1000) NOT NULL,
  `student_name` varchar(1000) NOT NULL,
  `level` varchar(1000) NOT NULL,
  `event_name` varchar(1000) NOT NULL,
  `month_year` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_3_1_awards_medals`
--

INSERT INTO `cri_5_3_1_awards_medals` (`am_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `awards_name`, `team_individual`, `student_name`, `level`, `event_name`, `month_year`) VALUES
(1, '2022-2023', 6, 'AJAY V', 'Sports Award', 'Individual', 'Bharath  S', 'State', 'State Level Powerlifting championship', '07-02-2023');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_3_3_events`
--

CREATE TABLE `cri_5_3_3_events` (
  `e_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `event_name` varchar(1000) NOT NULL,
  `event_date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_3_3_events`
--

INSERT INTO `cri_5_3_3_events` (`e_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `event_name`, `event_date`) VALUES
(1, '2022-2023', 6, 'MALATHI M', 'Junior National Throwball Championship for Boys and Girls', '22.09.2022');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_choice`
--

CREATE TABLE `cri_5_choice` (
  `choice_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `metric` varchar(30) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `choice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_choice`
--

INSERT INTO `cri_5_choice` (`choice_id`, `academic_year`, `metric`, `upload_by_id`, `upload_by_name`, `choice`) VALUES
(1, '2022-2023', 'Metric 5.1.3', 9, 'AJAY V', 'B'),
(2, '2022-2023', 'Metric 5.1.5', 9, 'AJAY V', 'A'),
(3, '2022-2023', 'Metric 5.4.2', 9, 'AJAY V', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_doc_upload`
--

CREATE TABLE `cri_5_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `criteria` varchar(25) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_doc_upload`
--

INSERT INTO `cri_5_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `criteria`, `description`, `doc_name`) VALUES
(1, '2022-2023', 6, 'MALATHI M', 'Metric 5.3.2', 'Criteria 5.3.2 Proof', '1720493100_668ca42c6e1f6.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_5_write_up`
--

CREATE TABLE `cri_5_write_up` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `criteria` varchar(25) NOT NULL,
  `write_up` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_5_write_up`
--

INSERT INTO `cri_5_write_up` (`id`, `academic_year`, `criteria`, `write_up`) VALUES
(1, '2022-2023', 'Metric 5.4.1', '<p><strong>Criteria 5.4.1</strong> - The Alumni Association and its Chapters (registered and functional) contribute significantly to the development of the institution through financial and other support services.</p>'),
(2, '2022-2023', 'Metric 5.3.2', '<p><strong>Criteria 5.3.2</strong> - Presence of an active Student Council and representation of students in academic and administrative bodies/committees of the institution.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_1_1_doc_upload`
--

CREATE TABLE `cri_6_1_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_1_2_doc_upload`
--

CREATE TABLE `cri_6_1_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_1_2_doc_upload`
--

INSERT INTO `cri_6_1_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(2, '2022-2023', 5, 'MOHAN K', 'Proof', '1711729380_6606eae49d5eb.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_2_1_doc_upload`
--

CREATE TABLE `cri_6_2_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_2_1_doc_upload`
--

INSERT INTO `cri_6_2_1_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 8, 'MOHAN K', 'Proof', '1711730222_6606ee2e4c72e.pdf'),
(2, '2022-2023', 5, 'MOHAN K', 'Proof', '1711730583_6606ef970feaf.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_2_2_doc_upload`
--

CREATE TABLE `cri_6_2_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_2_2_doc_upload`
--

INSERT INTO `cri_6_2_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 8, 'MOHAN K', 'Proof', '1711731333_6606f2853512f.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_2_3_doc_upload`
--

CREATE TABLE `cri_6_2_3_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_2_3_e_governance`
--

CREATE TABLE `cri_6_2_3_e_governance` (
  `eg_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `area` varchar(50) NOT NULL,
  `imp_year` varchar(50) NOT NULL,
  `vendor_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_2_3_e_governance`
--

INSERT INTO `cri_6_2_3_e_governance` (`eg_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `area`, `imp_year`, `vendor_name`) VALUES
(1, '2022-2023', 5, 'MOHAN K', 'Administration', '2022', 'CAMU software, Octoze technologies Pvt, Ltd, Chennai, Tamil nadu. 600 100.');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_3_1_doc_upload`
--

CREATE TABLE `cri_6_3_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_3_2_doc_upload`
--

CREATE TABLE `cri_6_3_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_3_2_doc_upload`
--

INSERT INTO `cri_6_3_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 8, 'MOHAN K', 'Criteria 6.3.2 Proof', '1713015331_661a8a233afa5.pdf'),
(2, '2022-2023', 5, 'MOHAN K', 'Criteria 6.3.2 Proof', '1713016620_661a8f2c1c19b.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_3_2_financial_support`
--

CREATE TABLE `cri_6_3_2_financial_support` (
  `fng_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `teacher_name` varchar(1000) NOT NULL,
  `conference_name` text NOT NULL,
  `professional_body` varchar(500) NOT NULL,
  `amount` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_3_2_financial_support`
--

INSERT INTO `cri_6_3_2_financial_support` (`fng_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `teacher_name`, `conference_name`, `professional_body`, `amount`) VALUES
(1, '2022-2023', 5, 'MOHAN K', 'Ms.G.Sasi, AP/ ECE', 'Participated international conference on \" Advanced communication control and computing technology (ICACCCT-2022)\" at Saveetha school of Engineering, Chennai from 28-30 june 2022.', 'PSNACET, Dindigul', 'Rs.2095');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_3_3_doc_upload`
--

CREATE TABLE `cri_6_3_3_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_3_3_training_programmes`
--

CREATE TABLE `cri_6_3_3_training_programmes` (
  `tp_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `teaching_staff_title` varchar(1000) NOT NULL,
  `non_teaching_staff_title` varchar(1000) NOT NULL,
  `no_participants` varchar(500) NOT NULL,
  `from_date` varchar(500) NOT NULL,
  `to_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_3_3_training_programmes`
--

INSERT INTO `cri_6_3_3_training_programmes` (`tp_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `teaching_staff_title`, `non_teaching_staff_title`, `no_participants`, `from_date`, `to_date`) VALUES
(2, '2022-2023', 5, 'MOHAN K', 'Five Days FDP on UiPath â€œRobotic Process Automation Associateâ€', 'Nil', '50', '2024-04-13', '2024-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_3_4_doc_upload`
--

CREATE TABLE `cri_6_3_4_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_3_4_fdp`
--

CREATE TABLE `cri_6_3_4_fdp` (
  `fdp_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `teacher_name` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `from_date` varchar(500) NOT NULL,
  `to_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_3_4_fdp`
--

INSERT INTO `cri_6_3_4_fdp` (`fdp_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `teacher_name`, `title`, `from_date`, `to_date`) VALUES
(1, '2022-2023', 5, 'MOHAN K', 'Dr. N. Gurumoorthy', 'Recent Trends in Sustainable Development', '2024-04-09', '2024-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_4_1_doc_upload`
--

CREATE TABLE `cri_6_4_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_4_1_doc_upload`
--

INSERT INTO `cri_6_4_1_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 8, 'MOHAN K', 'Criteria 6.4.1 - Proof', '1712992121_661a2f7934080.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_4_2_doc_upload`
--

CREATE TABLE `cri_6_4_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_4_2_doc_upload`
--

INSERT INTO `cri_6_4_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 8, 'MOHAN K', '6.4.2 proof', '1712991120_661a2b909778e.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_4_2_funds_non_government`
--

CREATE TABLE `cri_6_4_2_funds_non_government` (
  `fng_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `agencies_name` varchar(50) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `funds` varchar(500) NOT NULL,
  `month` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_4_2_funds_non_government`
--

INSERT INTO `cri_6_4_2_funds_non_government` (`fng_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `agencies_name`, `purpose`, `funds`, `month`) VALUES
(1, '2022-2023', 5, 'MOHAN K', 'non-government funding agencies', 'Purpose of the Grant', '5.6', 'June 2024');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_4_3_doc_upload`
--

CREATE TABLE `cri_6_4_3_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_5_1_doc_upload`
--

CREATE TABLE `cri_6_5_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_5_1_doc_upload`
--

INSERT INTO `cri_6_5_1_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 8, 'MOHAN K', 'Proof', '1711792018_6607df923420b.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_5_2_doc_upload`
--

CREATE TABLE `cri_6_5_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_5_2_doc_upload`
--

INSERT INTO `cri_6_5_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', 8, 'MOHAN K', 'Proof', '1711867424_6609062050244.pdf'),
(2, '2022-2023', 5, 'MOHAN K', 'Proof', '1711867690_6609072a6e03b.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_5_3_doc_upload`
--

CREATE TABLE `cri_6_5_3_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_5_3_initiatives`
--

CREATE TABLE `cri_6_5_3_initiatives` (
  `qai_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `area` varchar(500) NOT NULL,
  `initiatives` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_5_3_initiatives`
--

INSERT INTO `cri_6_5_3_initiatives` (`qai_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `area`, `initiatives`) VALUES
(1, '2022-2023', 5, 'MOHAN K', 'A', '10/06/2022'),
(2, '2022-2023', 5, 'MOHAN K', 'A', '21/10/2022'),
(3, '2022-2023', 5, 'MOHAN K', 'D', 'Participated in NIRF ranking 2023 Engineering Colleges'),
(4, '2022-2023', 5, 'MOHAN K', 'B\r\n', 'One day Workshop on Artificial Intelligence and Machine Learning Algorithms on July 21, 2022'),
(5, '2022-2023', 5, 'MOHAN K', 'B', 'One day Workshop on Future of AI on July 26, 2022'),
(6, '2022-2023', 5, 'MOHAN K', 'F', 'EEE NBA Accrediation valid upto 30-06-2024'),
(7, '2022-2023', 5, 'MOHAN K', 'H', 'One Week National Level Faculty Development Program on Amazon Web Services from August 22 to 27, 2022'),
(8, '2022-2023', 5, 'MOHAN K', 'H', 'Student Induction Programme for MBA, MCA and ME Students on October 19, 2022'),
(9, '2022-2023', 5, 'MOHAN K', 'G', 'Bentley Education & TechApps COnsulting Services Organises A Three days Training on Application of BIM in Reality Modeling on February 10, 2023'),
(10, '2022-2023', 5, 'MOHAN K', 'G', 'Crystal Clear Technology and Innovation organise Two days Workshop with Hands on Training on IoT Based Innovative Projects Phase II from February 09 to 10, 2023');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_choice`
--

CREATE TABLE `cri_6_choice` (
  `choice_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `metric` varchar(30) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `choice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_choice`
--

INSERT INTO `cri_6_choice` (`choice_id`, `academic_year`, `metric`, `upload_by_id`, `upload_by_name`, `choice`) VALUES
(1, '2022-2023', 'Metric 6.2.3', 8, 'MOHAN K', 'A'),
(2, '2022-2023', 'Metric 6.5.3', 8, 'MOHAN K', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `cri_6_write_up`
--

CREATE TABLE `cri_6_write_up` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `criteria` varchar(25) NOT NULL,
  `write_up` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_6_write_up`
--

INSERT INTO `cri_6_write_up` (`id`, `academic_year`, `criteria`, `write_up`) VALUES
(1, '2022-2023', 'Metric 6.1.1', '<p><strong>&nbsp;Criteria 6.1.1</strong> - The governance of the institution is reflective of an effective leadership in tune with the vision and mission of the Institution.</p>'),
(2, '2022-2023', 'Metric 6.1.2', '<p><strong>Criteria 6.1.2</strong> - Effective leadership is reflected in various institutional practices such as decentralization and participative management.</p>'),
(3, '2022-2023', 'Metric 6.2.1', '<p><strong>Criteria 6.2.1</strong> - The institutional Strategic/ Perspective plan has been clearly articulated and implemented.</p>'),
(4, '2022-2023', 'Metric 6.2.2', '<p><strong>Criteria 6.2.2</strong> - The functioning of the various institutional bodies is effective and efficient as visible from the policies, administrative set-up, appointment and service rules, procedures, etc.</p>'),
(5, '2022-2023', 'Metric 6.5.1', '<p><strong>Criteria 6.5.1</strong> - Internal Quality Assurance Cell (IQAC) has contributed significantly for institutionalizing quality assurance strategies and processes visible in terms of incremental improvements made during the preceding year with regard to quality (in case of the First Cycle).</p>'),
(6, '2022-2023', 'Metric 6.5.2', '<p><strong>Criteria 6.5.2</strong> - The institution reviews its teaching-learning process, structures and methodologies of operation and learning outcomes at periodic intervals through its IQAC as per norms.</p>'),
(7, '2022-2023', 'Metric 6.4.3', '<p><strong>Criteria 6.4.3</strong> - Institutional strategies for mobilisation of funds and the optimal utilisation of resources.</p>'),
(8, '2022-2023', 'Metric 6.3.1', '<p><strong>&nbsp;Criteria 6.3.1</strong> - The institution has effective welfare measures for teaching and non-teaching staff and avenues for their career development/ progression.</p>'),
(9, '2022-2023', 'Metric 6.4.1', '<p>&nbsp;Criteria 6.4.1 - Institution conducts internal and external financial audits regularly.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_1_doc_upload`
--

CREATE TABLE `cri_7_1_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_2_doc_upload`
--

CREATE TABLE `cri_7_1_2_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_2_doc_upload`
--

INSERT INTO `cri_7_1_2_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '5', 'boobalan', 'sample Docs', '1711527341_6603d5ad4c512.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_3_doc_upload`
--

CREATE TABLE `cri_7_1_3_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_3_doc_upload`
--

INSERT INTO `cri_7_1_3_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '8', 'Ajay', 'Machine learning notes', '1711651154_6605b952ada66.pdf'),
(2, '2022-2023', '5', 'boobalan', 'test document', '1711894691_660970a3dfb09.pdf'),
(3, '2022-2023', '8', 'Ajay', 'sample document in criterian head', '1711894766_660970ee33174.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_4_doc_upload`
--

CREATE TABLE `cri_7_1_4_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_4_doc_upload`
--

INSERT INTO `cri_7_1_4_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '5', 'boobalan', 'hello world', '1711969707_660a95ab28923.pdf'),
(2, '2022-2023', '8', 'Ajay', 'feefejei', '1711970258_660a97d2660a1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_5_doc_upload`
--

CREATE TABLE `cri_7_1_5_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_5_doc_upload`
--

INSERT INTO `cri_7_1_5_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '5', 'boobalan', 'testing docs', '1712212770_660e4b2246137.pdf'),
(2, '2022-2023', '8', 'Ajay', 'hello file', '1712213617_660e4e71f0594.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_6_doc_upload`
--

CREATE TABLE `cri_7_1_6_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_6_doc_upload`
--

INSERT INTO `cri_7_1_6_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '5', 'boobalan', 'criteria 7 doc', '1713441487_66210acf77838.pdf'),
(2, '2022-2023', '8', 'Ajay', 'audit docs', '1713852166_66274f06e77f9.pdf'),
(3, '2022-2023', '8', 'Ajay', 'hello world', '1713852257_66274f619ceab.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_7_doc_upload`
--

CREATE TABLE `cri_7_1_7_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_7_doc_upload`
--

INSERT INTO `cri_7_1_7_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '5', 'boobalan', 'testing document', '1713851685_66274d2552107.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_8_doc_upload`
--

CREATE TABLE `cri_7_1_8_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_8_doc_upload`
--

INSERT INTO `cri_7_1_8_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '5', 'boobalan', 'cir_7.1.8_document', '1714474838_6630cf56b5dc9.pdf'),
(2, '2022-2023', '8', 'Ajay', 'cri_doc', '1714476164_6630d484c38ef.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_9_doc_upload`
--

CREATE TABLE `cri_7_1_9_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_9_doc_upload`
--

INSERT INTO `cri_7_1_9_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '8', 'Ajay', 'cri_doc_upload', '1714714322_663476d2c7634.pdf'),
(2, '2022-2023', '5', 'boobalan', 'cri_7.1.9_doc', '1714714870_663478f6a1ff9.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_10_doc_upload`
--

CREATE TABLE `cri_7_1_10_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_1_11_doc_upload`
--

CREATE TABLE `cri_7_1_11_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_1_11_doc_upload`
--

INSERT INTO `cri_7_1_11_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '8', 'Ajay', 'cri_7.1.11_doc', '1714719683_66348bc3d05af.pdf'),
(2, '2022-2023', '5', 'boobalan', 'cri_7.1.11_doc', '1714720500_66348ef432fcc.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_2_1_doc_upload`
--

CREATE TABLE `cri_7_2_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_2_1_doc_upload`
--

INSERT INTO `cri_7_2_1_doc_upload` (`doc_id`, `academic_year`, `upload_by_id`, `upload_by_name`, `description`, `doc_name`) VALUES
(1, '2022-2023', '5', 'boobalan', 'cri_7.2.1_doc', '1714735541_6634c9b5826a2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_3_1_doc_upload`
--

CREATE TABLE `cri_7_3_1_doc_upload` (
  `doc_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `upload_by_id` varchar(255) NOT NULL,
  `upload_by_name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `doc_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_options`
--

CREATE TABLE `cri_7_options` (
  `option_id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `criteria` varchar(50) NOT NULL,
  `upload_by_id` int(11) NOT NULL,
  `upload_by_name` varchar(255) NOT NULL,
  `choice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cri_7_options`
--

INSERT INTO `cri_7_options` (`option_id`, `academic_year`, `criteria`, `upload_by_id`, `upload_by_name`, `choice`) VALUES
(1, '2022-2023', 'criteria 7.1.2', 5, 'boobalan', 'B'),
(2, '2022-2023', 'criteria 7.1.4', 5, 'boobalan', 'A'),
(3, '2022-2023', 'criteria 7.1.5', 5, 'boobalan', 'B'),
(4, '2022-2023', 'criteria 7.1.6', 5, 'boobalan', 'C'),
(5, '2022-2023', 'criteria 7.1.7', 5, 'boobalan', 'B'),
(6, '2022-2023', 'criteria 7.1.10', 5, 'boobalan', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `cri_7_write_up`
--

CREATE TABLE `cri_7_write_up` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `criteria` varchar(25) NOT NULL,
  `write_up` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cri_7_write_up`
--

INSERT INTO `cri_7_write_up` (`id`, `academic_year`, `criteria`, `write_up`) VALUES
(1, '2022-2023', 'Metric 7.1.3', 'dfgeffeeefffefefweefergergargrrgegergergergergegegeguhurgjakjerhnvnfjnjrvnrkvmeprkgfmvkrgkrigjkyjndvdfoeoldpeirjiksdfmvirkmdfkvmkrgldkvfdlfkvmrivlvdkfmvirvldkfmvlergldkmvldfkmldkfjgirvkdlmmvoldoirfkdmfvldkfdolkfldkmgldkmdvlkdmvldkmdlkvmdlkkfgmldkfmlkrligldkfmvldkfmgkjrmjirldkfmvdlkfmvldkmfvlkdmglkdmgkdgdlkgmddelgdl,vmdlkmdlkgeijglrkmklmdflkmfklmfkfkgbkrgijrirod;lfkvgrokflfkfkvmfkvmkfmvkveoooqppkcksvskskssksdsdskdddskdsddkdvmkvmdkmvdkmvdkvmkdvmkvmkmvkdsmvsmkmskmskmsksskaaallalalalalallalalallalaallalalallalalallalalaalallalalalallalalaallallalalalalalalalalalalalalalal'),
(2, '2022-2023', 'Metric 7.1.8', '<p>Describe the Institutional efforts/initiatives in providing an inclusive environment i.e.&nbsp;<br>tolerance and harmony towards cultural, regional, linguistic, communal, socioeconomic and other diversities (within a maximum of 200 words).<br>Provide Web link to:&nbsp;<br>ï‚· Supporting documents on the information provided (as reflected in the&nbsp;<br>administrative and academic activities of the Institution)<br>AQAR Format for Autonomous Colleges Page 59<br>NAAC for Quality and Excellence in Higher Education<br>Human Values and Professional Ethics&nbsp;<br>7.1.9<br>QlM<br>Sensitization of students and employees of the institution to constitutional obligations:&nbsp;<br>values, rights, duties and responsibilities of citizens:</p>'),
(3, '2022-2023', 'Metric 7.1.9', '<p>Sensitization of students and employees of the institution to constitutional obligations:&nbsp;<br>values, rights, duties and responsibilities of citizens:<br>Describe the various activities of the institution for inculcating values for becoming&nbsp;<br>responsible citizens as reflected in the Constitution of India (within a maximum of 200&nbsp;<br>words).<br>Provide weblink to:<br>ï‚· Details of activities that inculcate values necessary to transform students into&nbsp;<br>responsible citizens<br>ï‚· Any other relevant information</p>'),
(4, '2022-2023', 'Metric 7.1.11', '<p>Describe the efforts of the institution to celebrate /organize national and international&nbsp;<br>commemorative days, events and festivals during the year (within a maximum of 200&nbsp;<br>words).&nbsp;<br>Provide weblink to:<br>ï‚· Annual report of the celebrations and commemorative events for during the year<br>ï‚· Geotagged photographs of some of the events<br>ï‚· Any other relevant information&nbsp;</p>'),
(5, '2022-2023', 'Metric 7.1.1', '<p>Criteria 7.1.1 - Measures initiated by the institution for the promotion of gender equity during the year</p>');

-- --------------------------------------------------------

--
-- Table structure for table `department_incharge`
--

CREATE TABLE `department_incharge` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `criterion` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_incharge`
--

INSERT INTO `department_incharge` (`id`, `email`, `name`, `criterion`, `department`, `password`) VALUES
(1, 'test22@gmail.com', 'PRASANNA G', 'Criterion - 2', '631', '$2y$10$Q5Vuy8Ii8NHkkjaJLL5ov.ypSvn.B5TsRAxmT6Eme9uoPIpNvPD/.'),
(2, 'test3@gmail.com', 'MOHAN K', 'Criterion - 3', '621', '$2y$10$8vQJ8CbgajvBrYZm8y3HIexlzWe.lJ11mu28y9CwMNouQwKDOgl42'),
(4, 'test2@gmail.com', 'MOHAN K', 'Criterion - 2', '621', '$2y$10$RGmxHUKas0LtapHU9.OjIub4jBvGynglRQTAuMR1L7YVUB33fY1M6'),
(6, 'test@gmail.com', 'MOHAN', 'Criterion - 1', '621', '$2y$10$GOv5XcG3KLaJ/4SVdZiXRuGPP8EuytWf7o6b3NphSlmTG.9rMOa0W');

-- --------------------------------------------------------

--
-- Table structure for table `incharge`
--

CREATE TABLE `incharge` (
  `inc_id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `criterion` varchar(30) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incharge`
--

INSERT INTO `incharge` (`inc_id`, `email`, `name`, `criterion`, `password`) VALUES
(4, 'test4@gmail.com', 'MOHAN K', 'Criterion - 4', '$2y$10$gYE6z7fW/3rZ2eXhZE3b9.nlRWkatcAmF/JiL/K3h.pRCxOjXBr1u'),
(5, 'test6@gmail.com', 'MOHAN K', 'Criterion - 6', '$2y$10$DxZmP0UWaZ2aNeoq1Rk15O5/8gdHKaDeFv2OAwz0wK6XsDatzJm1i'),
(6, 'test5@gmail.com', 'MALATHI M', 'Criterion - 5', '$2y$10$rlVggvwcyt6Vt9FSzwGdROHaRsTwsfnkYxc7I6PW7b0h5JBj1fVc2'),
(7, 'test7@gmail.com', 'PRASANNA G', 'Criterion - 7', '$2y$10$vGflvFtKU3SrRhCNT/zEoetc.IIT2UUYdRIkCLOSoIu9NxHotemR2');

-- --------------------------------------------------------

--
-- Table structure for table `iqac_chairman`
--

CREATE TABLE `iqac_chairman` (
  `chairman_id` int(11) NOT NULL,
  `chairman_name` varchar(500) NOT NULL,
  `chairman_email` varchar(500) NOT NULL,
  `chairman_password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iqac_chairman`
--

INSERT INTO `iqac_chairman` (`chairman_id`, `chairman_name`, `chairman_email`, `chairman_password`) VALUES
(1, 'PRASANNA G', 'test@gmail.com', '$2y$10$Su5HIF0yHTZtrIbRdvT9s.rD6n8PSAtNXP8hnGVIY0zmaJ1bqKLkC');

-- --------------------------------------------------------

--
-- Table structure for table `iqac_director`
--

CREATE TABLE `iqac_director` (
  `director_id` int(11) NOT NULL,
  `director_name` varchar(255) NOT NULL,
  `director_email` varchar(255) NOT NULL,
  `director_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iqac_director`
--

INSERT INTO `iqac_director` (`director_id`, `director_name`, `director_email`, `director_password`) VALUES
(2, 'MOHAN K', 'test@gmail.com', '$2y$10$2iKx0F5ecfGWXmktHMeGDe/Gw6dEdaXjxP.jIHzpi.qLj0KhtQTBW');

-- --------------------------------------------------------

--
-- Table structure for table `programme_info`
--

CREATE TABLE `programme_info` (
  `id` int(11) NOT NULL,
  `programme_code` varchar(255) NOT NULL,
  `programme_name` varchar(255) NOT NULL,
  `intro_year` varchar(10) NOT NULL,
  `cbcs_status` varchar(5) NOT NULL,
  `cbcs_imple_year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programme_info`
--

INSERT INTO `programme_info` (`id`, `programme_code`, `programme_name`, `intro_year`, `cbcs_status`, `cbcs_imple_year`) VALUES
(1, '621', 'MCA - Master of Computer Applications', '1989', 'Yes', '2017'),
(2, '631', 'MBA - Master of Business Administration', '1989', 'Yes', '2017'),
(3, '103', 'B.E. Civil Engineering', '1999', 'Yes', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`academic_year`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `criterion_head`
--
ALTER TABLE `criterion_head`
  ADD PRIMARY KEY (`criterion_id`);

--
-- Indexes for table `cri_1_1_1_doc_upload`
--
ALTER TABLE `cri_1_1_1_doc_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `cri_1_1_2_doc_upload`
--
ALTER TABLE `cri_1_1_2_doc_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `cri_1_1_2_revision`
--
ALTER TABLE `cri_1_1_2_revision`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `programme_code` (`programme_code`);

--
-- Indexes for table `cri_1_1_3_course`
--
ALTER TABLE `cri_1_1_3_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `department` (`department`(191));

--
-- Indexes for table `cri_1_2_1_course`
--
ALTER TABLE `cri_1_2_1_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `department` (`department`(191));

--
-- Indexes for table `cri_1_2_2_doc_upload`
--
ALTER TABLE `cri_1_2_2_doc_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `cri_1_3_1_courses`
--
ALTER TABLE `cri_1_3_1_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `programme_code` (`programme_code`);

--
-- Indexes for table `cri_1_3_1_events`
--
ALTER TABLE `cri_1_3_1_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `cri_1_3_2_value_added_courses`
--
ALTER TABLE `cri_1_3_2_value_added_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `cri_1_3_3_doc_upload`
--
ALTER TABLE `cri_1_3_3_doc_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `cri_1_3_4_doc_upload`
--
ALTER TABLE `cri_1_3_4_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_1_3_4_student_project`
--
ALTER TABLE `cri_1_3_4_student_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `cri_1_4_1_doc_upload`
--
ALTER TABLE `cri_1_4_1_doc_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`(191)),
  ADD KEY `upload_by` (`upload_by`(191));

--
-- Indexes for table `cri_1_4_2_doc_upload`
--
ALTER TABLE `cri_1_4_2_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_1_write_up`
--
ALTER TABLE `cri_1_write_up`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`);

--
-- Indexes for table `cri_2_1_1_doc_upload`
--
ALTER TABLE `cri_2_1_1_doc_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `upload_by` (`upload_by`(191));

--
-- Indexes for table `cri_2_1_1_sanctioned_seats`
--
ALTER TABLE `cri_2_1_1_sanctioned_seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programme_code` (`programme_code`(191)),
  ADD KEY `academic_year_2` (`academic_year`);

--
-- Indexes for table `cri_2_1_1_student_details`
--
ALTER TABLE `cri_2_1_1_student_details`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `cri_2_1_2_doc_upload`
--
ALTER TABLE `cri_2_1_2_doc_upload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year` (`academic_year`),
  ADD KEY `upload_by` (`upload_by`(191));

--
-- Indexes for table `cri_2_1_2_reserved_categories`
--
ALTER TABLE `cri_2_1_2_reserved_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_2_1_doc_upload`
--
ALTER TABLE `cri_2_2_1_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_2_1_spc_programmes`
--
ALTER TABLE `cri_2_2_1_spc_programmes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_2_2_doc_upload`
--
ALTER TABLE `cri_2_2_2_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_2_2_full_time_teacher`
--
ALTER TABLE `cri_2_2_2_full_time_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_2_2_student_details`
--
ALTER TABLE `cri_2_2_2_student_details`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `cri_2_3_1_doc_upload`
--
ALTER TABLE `cri_2_3_1_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_3_2_doc_upload`
--
ALTER TABLE `cri_2_3_2_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_3_3_doc_upload`
--
ALTER TABLE `cri_2_3_3_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_3_3_ratio`
--
ALTER TABLE `cri_2_3_3_ratio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_3_4_doc_upload`
--
ALTER TABLE `cri_2_3_4_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_4_1_doc_upload`
--
ALTER TABLE `cri_2_4_1_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_4_1_sanctioned_posts`
--
ALTER TABLE `cri_2_4_1_sanctioned_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_4_2_doc_upload`
--
ALTER TABLE `cri_2_4_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_2_4_2_teachers`
--
ALTER TABLE `cri_2_4_2_teachers`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `cri_2_4_3_doc_upload`
--
ALTER TABLE `cri_2_4_3_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_6_1_doc_upload`
--
ALTER TABLE `cri_2_6_1_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_6_2_doc_upload`
--
ALTER TABLE `cri_2_6_2_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_6_3_doc_upload`
--
ALTER TABLE `cri_2_6_3_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_6_3_pass_percentage`
--
ALTER TABLE `cri_2_6_3_pass_percentage`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `cri_2_7_1_doc_upload`
--
ALTER TABLE `cri_2_7_1_doc_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_2_write_up`
--
ALTER TABLE `cri_2_write_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_3_1_2_seed_money`
--
ALTER TABLE `cri_3_1_2_seed_money`
  ADD PRIMARY KEY (`sm_id`);

--
-- Indexes for table `cri_3_1_3_award_fellowship`
--
ALTER TABLE `cri_3_1_3_award_fellowship`
  ADD PRIMARY KEY (`af_id`);

--
-- Indexes for table `cri_3_2_1_grants_received`
--
ALTER TABLE `cri_3_2_1_grants_received`
  ADD PRIMARY KEY (`gr_id`);

--
-- Indexes for table `cri_3_3_2_workshops_seminars`
--
ALTER TABLE `cri_3_3_2_workshops_seminars`
  ADD PRIMARY KEY (`ws_id`);

--
-- Indexes for table `cri_3_4_2_scholar`
--
ALTER TABLE `cri_3_4_2_scholar`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `cri_3_4_3_research_paper`
--
ALTER TABLE `cri_3_4_3_research_paper`
  ADD PRIMARY KEY (`rp_id`);

--
-- Indexes for table `cri_3_4_4_edited_books`
--
ALTER TABLE `cri_3_4_4_edited_books`
  ADD PRIMARY KEY (`eb_id`);

--
-- Indexes for table `cri_3_4_5_citation_index`
--
ALTER TABLE `cri_3_4_5_citation_index`
  ADD PRIMARY KEY (`ci_id`);

--
-- Indexes for table `cri_3_4_6_h_index`
--
ALTER TABLE `cri_3_4_6_h_index`
  ADD PRIMARY KEY (`hi_id`);

--
-- Indexes for table `cri_3_5_1_revenue_generated`
--
ALTER TABLE `cri_3_5_1_revenue_generated`
  ADD PRIMARY KEY (`rg_id`);

--
-- Indexes for table `cri_3_5_2_revenue_generated`
--
ALTER TABLE `cri_3_5_2_revenue_generated`
  ADD PRIMARY KEY (`rg_id`);

--
-- Indexes for table `cri_3_6_2_awards_received`
--
ALTER TABLE `cri_3_6_2_awards_received`
  ADD PRIMARY KEY (`ar_id`);

--
-- Indexes for table `cri_3_6_3_extension_activities`
--
ALTER TABLE `cri_3_6_3_extension_activities`
  ADD PRIMARY KEY (`ea_id`);

--
-- Indexes for table `cri_3_7_1_collaborating_agency`
--
ALTER TABLE `cri_3_7_1_collaborating_agency`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `cri_3_7_1_collaborating_agency_student`
--
ALTER TABLE `cri_3_7_1_collaborating_agency_student`
  ADD PRIMARY KEY (`cas_id`);

--
-- Indexes for table `cri_3_7_2_mou_activities`
--
ALTER TABLE `cri_3_7_2_mou_activities`
  ADD PRIMARY KEY (`md_id`);

--
-- Indexes for table `cri_3_7_2_mou_details`
--
ALTER TABLE `cri_3_7_2_mou_details`
  ADD PRIMARY KEY (`md_id`);

--
-- Indexes for table `cri_3_choice`
--
ALTER TABLE `cri_3_choice`
  ADD PRIMARY KEY (`choice_id`);

--
-- Indexes for table `cri_3_doc_upload`
--
ALTER TABLE `cri_3_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_3_write_up`
--
ALTER TABLE `cri_3_write_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_4_1_1_doc_upload`
--
ALTER TABLE `cri_4_1_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_1_2_doc_upload`
--
ALTER TABLE `cri_4_1_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_1_3_classrooms_seminarhalls`
--
ALTER TABLE `cri_4_1_3_classrooms_seminarhalls`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `cri_4_1_4_infrastructure_expenditure`
--
ALTER TABLE `cri_4_1_4_infrastructure_expenditure`
  ADD PRIMARY KEY (`exp_id`);

--
-- Indexes for table `cri_4_2_1_doc_upload`
--
ALTER TABLE `cri_4_2_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_2_2_doc_upload`
--
ALTER TABLE `cri_4_2_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_2_2_options`
--
ALTER TABLE `cri_4_2_2_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `cri_4_2_3_doc_upload`
--
ALTER TABLE `cri_4_2_3_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_2_4_doc_upload`
--
ALTER TABLE `cri_4_2_4_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_2_4_library_usage`
--
ALTER TABLE `cri_4_2_4_library_usage`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cri_4_3_1_doc_upload`
--
ALTER TABLE `cri_4_3_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_3_2_computer_ratio`
--
ALTER TABLE `cri_4_3_2_computer_ratio`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `cri_4_3_2_doc_upload`
--
ALTER TABLE `cri_4_3_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_3_3_doc_upload`
--
ALTER TABLE `cri_4_3_3_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_3_3_options`
--
ALTER TABLE `cri_4_3_3_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `cri_4_3_4_doc_upload`
--
ALTER TABLE `cri_4_3_4_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_3_4_options`
--
ALTER TABLE `cri_4_3_4_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `cri_4_4_1_doc_upload`
--
ALTER TABLE `cri_4_4_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_4_2_doc_upload`
--
ALTER TABLE `cri_4_4_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_4_write_up`
--
ALTER TABLE `cri_4_write_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_5_1_1_scholarships`
--
ALTER TABLE `cri_5_1_1_scholarships`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `cri_5_1_3_capacity_development`
--
ALTER TABLE `cri_5_1_3_capacity_development`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `cri_5_1_5_placement`
--
ALTER TABLE `cri_5_1_5_placement`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `cri_5_1_5_students_benefitted`
--
ALTER TABLE `cri_5_1_5_students_benefitted`
  ADD PRIMARY KEY (`sb_id`);

--
-- Indexes for table `cri_5_2_2_higher_education`
--
ALTER TABLE `cri_5_2_2_higher_education`
  ADD PRIMARY KEY (`he_id`);

--
-- Indexes for table `cri_5_2_3_examinations`
--
ALTER TABLE `cri_5_2_3_examinations`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `cri_5_3_1_awards_medals`
--
ALTER TABLE `cri_5_3_1_awards_medals`
  ADD PRIMARY KEY (`am_id`);

--
-- Indexes for table `cri_5_3_3_events`
--
ALTER TABLE `cri_5_3_3_events`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `cri_5_choice`
--
ALTER TABLE `cri_5_choice`
  ADD PRIMARY KEY (`choice_id`);

--
-- Indexes for table `cri_5_doc_upload`
--
ALTER TABLE `cri_5_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_5_write_up`
--
ALTER TABLE `cri_5_write_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_6_1_1_doc_upload`
--
ALTER TABLE `cri_6_1_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_1_2_doc_upload`
--
ALTER TABLE `cri_6_1_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_2_1_doc_upload`
--
ALTER TABLE `cri_6_2_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_2_2_doc_upload`
--
ALTER TABLE `cri_6_2_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_2_3_doc_upload`
--
ALTER TABLE `cri_6_2_3_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_2_3_e_governance`
--
ALTER TABLE `cri_6_2_3_e_governance`
  ADD PRIMARY KEY (`eg_id`);

--
-- Indexes for table `cri_6_3_1_doc_upload`
--
ALTER TABLE `cri_6_3_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_3_2_doc_upload`
--
ALTER TABLE `cri_6_3_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_3_2_financial_support`
--
ALTER TABLE `cri_6_3_2_financial_support`
  ADD PRIMARY KEY (`fng_id`);

--
-- Indexes for table `cri_6_3_3_doc_upload`
--
ALTER TABLE `cri_6_3_3_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_3_3_training_programmes`
--
ALTER TABLE `cri_6_3_3_training_programmes`
  ADD PRIMARY KEY (`tp_id`);

--
-- Indexes for table `cri_6_3_4_doc_upload`
--
ALTER TABLE `cri_6_3_4_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_3_4_fdp`
--
ALTER TABLE `cri_6_3_4_fdp`
  ADD PRIMARY KEY (`fdp_id`);

--
-- Indexes for table `cri_6_4_1_doc_upload`
--
ALTER TABLE `cri_6_4_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_4_2_doc_upload`
--
ALTER TABLE `cri_6_4_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_4_2_funds_non_government`
--
ALTER TABLE `cri_6_4_2_funds_non_government`
  ADD PRIMARY KEY (`fng_id`);

--
-- Indexes for table `cri_6_4_3_doc_upload`
--
ALTER TABLE `cri_6_4_3_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_5_1_doc_upload`
--
ALTER TABLE `cri_6_5_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_5_2_doc_upload`
--
ALTER TABLE `cri_6_5_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_5_3_doc_upload`
--
ALTER TABLE `cri_6_5_3_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_6_5_3_initiatives`
--
ALTER TABLE `cri_6_5_3_initiatives`
  ADD PRIMARY KEY (`qai_id`);

--
-- Indexes for table `cri_6_choice`
--
ALTER TABLE `cri_6_choice`
  ADD PRIMARY KEY (`choice_id`);

--
-- Indexes for table `cri_6_write_up`
--
ALTER TABLE `cri_6_write_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cri_7_1_1_doc_upload`
--
ALTER TABLE `cri_7_1_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_2_doc_upload`
--
ALTER TABLE `cri_7_1_2_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_3_doc_upload`
--
ALTER TABLE `cri_7_1_3_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_4_doc_upload`
--
ALTER TABLE `cri_7_1_4_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_5_doc_upload`
--
ALTER TABLE `cri_7_1_5_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_6_doc_upload`
--
ALTER TABLE `cri_7_1_6_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_7_doc_upload`
--
ALTER TABLE `cri_7_1_7_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_8_doc_upload`
--
ALTER TABLE `cri_7_1_8_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_9_doc_upload`
--
ALTER TABLE `cri_7_1_9_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_10_doc_upload`
--
ALTER TABLE `cri_7_1_10_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_1_11_doc_upload`
--
ALTER TABLE `cri_7_1_11_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_2_1_doc_upload`
--
ALTER TABLE `cri_7_2_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_3_1_doc_upload`
--
ALTER TABLE `cri_7_3_1_doc_upload`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `cri_7_options`
--
ALTER TABLE `cri_7_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `cri_7_write_up`
--
ALTER TABLE `cri_7_write_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_incharge`
--
ALTER TABLE `department_incharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incharge`
--
ALTER TABLE `incharge`
  ADD PRIMARY KEY (`inc_id`);

--
-- Indexes for table `iqac_chairman`
--
ALTER TABLE `iqac_chairman`
  ADD PRIMARY KEY (`chairman_id`);

--
-- Indexes for table `programme_info`
--
ALTER TABLE `programme_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `criterion_head`
--
ALTER TABLE `criterion_head`
  MODIFY `criterion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cri_2_1_1_sanctioned_seats`
--
ALTER TABLE `cri_2_1_1_sanctioned_seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_1_2_reserved_categories`
--
ALTER TABLE `cri_2_1_2_reserved_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_2_1_doc_upload`
--
ALTER TABLE `cri_2_2_1_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_2_1_spc_programmes`
--
ALTER TABLE `cri_2_2_1_spc_programmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_2_2_doc_upload`
--
ALTER TABLE `cri_2_2_2_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_2_2_full_time_teacher`
--
ALTER TABLE `cri_2_2_2_full_time_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_3_1_doc_upload`
--
ALTER TABLE `cri_2_3_1_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_3_2_doc_upload`
--
ALTER TABLE `cri_2_3_2_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_2_3_3_doc_upload`
--
ALTER TABLE `cri_2_3_3_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_3_3_ratio`
--
ALTER TABLE `cri_2_3_3_ratio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_2_3_4_doc_upload`
--
ALTER TABLE `cri_2_3_4_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_2_4_1_doc_upload`
--
ALTER TABLE `cri_2_4_1_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_2_4_1_sanctioned_posts`
--
ALTER TABLE `cri_2_4_1_sanctioned_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_4_2_doc_upload`
--
ALTER TABLE `cri_2_4_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_4_2_teachers`
--
ALTER TABLE `cri_2_4_2_teachers`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_2_4_3_doc_upload`
--
ALTER TABLE `cri_2_4_3_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_6_1_doc_upload`
--
ALTER TABLE `cri_2_6_1_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_6_2_doc_upload`
--
ALTER TABLE `cri_2_6_2_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_6_3_doc_upload`
--
ALTER TABLE `cri_2_6_3_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_7_1_doc_upload`
--
ALTER TABLE `cri_2_7_1_doc_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_2_write_up`
--
ALTER TABLE `cri_2_write_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cri_3_1_2_seed_money`
--
ALTER TABLE `cri_3_1_2_seed_money`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_1_3_award_fellowship`
--
ALTER TABLE `cri_3_1_3_award_fellowship`
  MODIFY `af_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_2_1_grants_received`
--
ALTER TABLE `cri_3_2_1_grants_received`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_3_2_workshops_seminars`
--
ALTER TABLE `cri_3_3_2_workshops_seminars`
  MODIFY `ws_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_3_4_2_scholar`
--
ALTER TABLE `cri_3_4_2_scholar`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_3_4_3_research_paper`
--
ALTER TABLE `cri_3_4_3_research_paper`
  MODIFY `rp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_4_4_edited_books`
--
ALTER TABLE `cri_3_4_4_edited_books`
  MODIFY `eb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_4_5_citation_index`
--
ALTER TABLE `cri_3_4_5_citation_index`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_4_6_h_index`
--
ALTER TABLE `cri_3_4_6_h_index`
  MODIFY `hi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_5_1_revenue_generated`
--
ALTER TABLE `cri_3_5_1_revenue_generated`
  MODIFY `rg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_5_2_revenue_generated`
--
ALTER TABLE `cri_3_5_2_revenue_generated`
  MODIFY `rg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_6_2_awards_received`
--
ALTER TABLE `cri_3_6_2_awards_received`
  MODIFY `ar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_6_3_extension_activities`
--
ALTER TABLE `cri_3_6_3_extension_activities`
  MODIFY `ea_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_7_1_collaborating_agency`
--
ALTER TABLE `cri_3_7_1_collaborating_agency`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_3_7_1_collaborating_agency_student`
--
ALTER TABLE `cri_3_7_1_collaborating_agency_student`
  MODIFY `cas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_7_2_mou_activities`
--
ALTER TABLE `cri_3_7_2_mou_activities`
  MODIFY `md_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_7_2_mou_details`
--
ALTER TABLE `cri_3_7_2_mou_details`
  MODIFY `md_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_3_choice`
--
ALTER TABLE `cri_3_choice`
  MODIFY `choice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_3_doc_upload`
--
ALTER TABLE `cri_3_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cri_3_write_up`
--
ALTER TABLE `cri_3_write_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_4_1_1_doc_upload`
--
ALTER TABLE `cri_4_1_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cri_4_1_2_doc_upload`
--
ALTER TABLE `cri_4_1_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_4_1_3_classrooms_seminarhalls`
--
ALTER TABLE `cri_4_1_3_classrooms_seminarhalls`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_4_1_4_infrastructure_expenditure`
--
ALTER TABLE `cri_4_1_4_infrastructure_expenditure`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_2_1_doc_upload`
--
ALTER TABLE `cri_4_2_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_2_2_doc_upload`
--
ALTER TABLE `cri_4_2_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_2_2_options`
--
ALTER TABLE `cri_4_2_2_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_4_2_3_doc_upload`
--
ALTER TABLE `cri_4_2_3_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_4_2_4_doc_upload`
--
ALTER TABLE `cri_4_2_4_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_4_2_4_library_usage`
--
ALTER TABLE `cri_4_2_4_library_usage`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_4_3_1_doc_upload`
--
ALTER TABLE `cri_4_3_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_3_2_computer_ratio`
--
ALTER TABLE `cri_4_3_2_computer_ratio`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_4_3_2_doc_upload`
--
ALTER TABLE `cri_4_3_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_3_3_doc_upload`
--
ALTER TABLE `cri_4_3_3_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_3_3_options`
--
ALTER TABLE `cri_4_3_3_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_4_3_4_doc_upload`
--
ALTER TABLE `cri_4_3_4_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_3_4_options`
--
ALTER TABLE `cri_4_3_4_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_4_4_1_doc_upload`
--
ALTER TABLE `cri_4_4_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_4_2_doc_upload`
--
ALTER TABLE `cri_4_4_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_4_write_up`
--
ALTER TABLE `cri_4_write_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cri_5_1_1_scholarships`
--
ALTER TABLE `cri_5_1_1_scholarships`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_5_1_3_capacity_development`
--
ALTER TABLE `cri_5_1_3_capacity_development`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_5_1_5_placement`
--
ALTER TABLE `cri_5_1_5_placement`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cri_5_1_5_students_benefitted`
--
ALTER TABLE `cri_5_1_5_students_benefitted`
  MODIFY `sb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_5_2_2_higher_education`
--
ALTER TABLE `cri_5_2_2_higher_education`
  MODIFY `he_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_5_2_3_examinations`
--
ALTER TABLE `cri_5_2_3_examinations`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_5_3_1_awards_medals`
--
ALTER TABLE `cri_5_3_1_awards_medals`
  MODIFY `am_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_5_3_3_events`
--
ALTER TABLE `cri_5_3_3_events`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_5_choice`
--
ALTER TABLE `cri_5_choice`
  MODIFY `choice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_5_doc_upload`
--
ALTER TABLE `cri_5_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_5_write_up`
--
ALTER TABLE `cri_5_write_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_6_1_1_doc_upload`
--
ALTER TABLE `cri_6_1_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_6_1_2_doc_upload`
--
ALTER TABLE `cri_6_1_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_6_2_1_doc_upload`
--
ALTER TABLE `cri_6_2_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_6_2_2_doc_upload`
--
ALTER TABLE `cri_6_2_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_6_2_3_doc_upload`
--
ALTER TABLE `cri_6_2_3_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_6_2_3_e_governance`
--
ALTER TABLE `cri_6_2_3_e_governance`
  MODIFY `eg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_6_3_1_doc_upload`
--
ALTER TABLE `cri_6_3_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_6_3_2_doc_upload`
--
ALTER TABLE `cri_6_3_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_6_3_2_financial_support`
--
ALTER TABLE `cri_6_3_2_financial_support`
  MODIFY `fng_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_6_3_3_doc_upload`
--
ALTER TABLE `cri_6_3_3_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_6_3_3_training_programmes`
--
ALTER TABLE `cri_6_3_3_training_programmes`
  MODIFY `tp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_6_3_4_doc_upload`
--
ALTER TABLE `cri_6_3_4_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_6_3_4_fdp`
--
ALTER TABLE `cri_6_3_4_fdp`
  MODIFY `fdp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_6_4_1_doc_upload`
--
ALTER TABLE `cri_6_4_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_6_4_2_doc_upload`
--
ALTER TABLE `cri_6_4_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_6_4_2_funds_non_government`
--
ALTER TABLE `cri_6_4_2_funds_non_government`
  MODIFY `fng_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_6_4_3_doc_upload`
--
ALTER TABLE `cri_6_4_3_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_6_5_1_doc_upload`
--
ALTER TABLE `cri_6_5_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_6_5_2_doc_upload`
--
ALTER TABLE `cri_6_5_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_6_5_3_doc_upload`
--
ALTER TABLE `cri_6_5_3_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_6_5_3_initiatives`
--
ALTER TABLE `cri_6_5_3_initiatives`
  MODIFY `qai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cri_6_choice`
--
ALTER TABLE `cri_6_choice`
  MODIFY `choice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_6_write_up`
--
ALTER TABLE `cri_6_write_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cri_7_1_1_doc_upload`
--
ALTER TABLE `cri_7_1_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_7_1_2_doc_upload`
--
ALTER TABLE `cri_7_1_2_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_7_1_3_doc_upload`
--
ALTER TABLE `cri_7_1_3_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_7_1_4_doc_upload`
--
ALTER TABLE `cri_7_1_4_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_7_1_5_doc_upload`
--
ALTER TABLE `cri_7_1_5_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_7_1_6_doc_upload`
--
ALTER TABLE `cri_7_1_6_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cri_7_1_7_doc_upload`
--
ALTER TABLE `cri_7_1_7_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_7_1_8_doc_upload`
--
ALTER TABLE `cri_7_1_8_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_7_1_9_doc_upload`
--
ALTER TABLE `cri_7_1_9_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_7_1_10_doc_upload`
--
ALTER TABLE `cri_7_1_10_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_7_1_11_doc_upload`
--
ALTER TABLE `cri_7_1_11_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cri_7_2_1_doc_upload`
--
ALTER TABLE `cri_7_2_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cri_7_3_1_doc_upload`
--
ALTER TABLE `cri_7_3_1_doc_upload`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cri_7_options`
--
ALTER TABLE `cri_7_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cri_7_write_up`
--
ALTER TABLE `cri_7_write_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department_incharge`
--
ALTER TABLE `department_incharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `incharge`
--
ALTER TABLE `incharge`
  MODIFY `inc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `iqac_chairman`
--
ALTER TABLE `iqac_chairman`
  MODIFY `chairman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programme_info`
--
ALTER TABLE `programme_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
