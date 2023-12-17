-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2023 at 09:59 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(10) NOT NULL,
  `student_id1` int(10) NOT NULL,
  `student_id2` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `student_id1`, `student_id2`) VALUES
(1, 1, 11),
(2, 1, 14),
(3, 1, 12),
(4, 1, 10),
(5, 16, 14),
(6, 16, 12),
(7, 18, 19);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(10) NOT NULL,
  `chat_id` int(10) NOT NULL,
  `group_chat_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `message` text NOT NULL,
  `message_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `chat_id`, `group_chat_id`, `student_id`, `date`, `time`, `message`, `message_status`) VALUES
(1, 1, 0, 1, '2023-07-02', '11:13:34', 'hi...', 'Active'),
(2, 2, 0, 1, '2023-07-02', '11:16:17', 'sdg', 'Active'),
(3, 3, 0, 1, '2023-07-02', '11:19:15', 'dxghfhjhk', 'Active'),
(4, 4, 0, 1, '2023-07-02', '11:19:22', 'b ugjgk hluilio', 'Active'),
(5, 5, 0, 16, '2023-07-02', '10:31:28', 'Hello', 'Active'),
(6, 6, 0, 16, '2023-07-02', '10:33:28', 'Hello', 'Active'),
(7, 6, 0, 16, '2023-07-02', '10:34:55', 'dfs', 'Active'),
(8, 5, 0, 16, '2023-07-02', '10:35:47', 'ji', 'Active'),
(9, 7, 0, 18, '2023-07-02', '07:28:36', 'hai', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `profile_imge` varchar(300) NOT NULL,
  `dob` date NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `courseid` int(11) NOT NULL,
  `semester` varchar(25) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `adminid` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `apassword` varchar(20) NOT NULL,
  `contactno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`adminid`, `fullname`, `emailid`, `apassword`, `contactno`) VALUES
(1, 'atik', 'atik@alumni.com', 'atik@uiu', '01786214688'),
(2, 'Atik', 'atik@gmail.com', '12345678', '01703390338'),
(4, 'shijan', 'shijan@gmail.com', 'shijan@uiu', '01831437477');

-- --------------------------------------------------------

--
-- Table structure for table `tblalumnimeet`
--

CREATE TABLE `tblalumnimeet` (
  `eventid` int(11) NOT NULL,
  `event_name` varchar(150) NOT NULL,
  `loc` varchar(100) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `description` text NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblalumnimeet`
--

INSERT INTO `tblalumnimeet` (`eventid`, `event_name`, `loc`, `event_date`, `event_time`, `description`, `status`) VALUES
(5, 'CSE Project Show', 'Campus', '2023-12-06', '13:02:00', 'SOmething', 'Active'),
(6, 'UIU Job Fair', 'On campus', '2023-08-31', '10:20:00', '50+ Companies will come to the campus to find talents from our university for their companies.', 'Active'),
(7, 'Annual sports', 'UIU Ground', '2023-09-05', '16:00:00', 'All department will perticipate', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblalumniphoto`
--

CREATE TABLE `tblalumniphoto` (
  `photoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `profilepic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblalumniphoto`
--

INSERT INTO `tblalumniphoto` (`photoid`, `userid`, `profilepic`) VALUES
(1, 9, 'noimage.png'),
(2, 10, 'noimage.png'),
(3, 11, '25638ad.jpg'),
(4, 12, '15001ad.jpg'),
(5, 13, '32299ev.jpg'),
(6, 14, '6295no-user-image.png'),
(7, 15, '10884no-user-image.png'),
(8, 16, '1370831967images.jpg'),
(9, 17, '441534923krishnan.jpg'),
(10, 18, '1754959464krishnan.jpg'),
(11, 19, '175987038Screenshot from 2020-07-10 10-03-35.png'),
(12, 20, '2072298881Voice based Home Automation.jpg'),
(13, 21, '2085165692depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `cid` int(11) NOT NULL,
  `cname` varchar(150) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `cno` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `courseid` int(11) NOT NULL,
  `coursename` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`courseid`, `coursename`) VALUES
(14, 'B.Sc in CSE'),
(15, 'B.Sc in EEE'),
(16, 'BBA in Economics'),
(17, 'B.sc in Data Science'),
(18, 'B.Sc in Civil');

-- --------------------------------------------------------

--
-- Table structure for table `tblfund`
--

CREATE TABLE `tblfund` (
  `fundid` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paiddate` date NOT NULL,
  `remarks` text NOT NULL,
  `userid` int(11) NOT NULL,
  `paytype` varchar(20) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `cardno` varchar(16) NOT NULL,
  `cvv` int(4) NOT NULL,
  `exp_month` int(11) NOT NULL,
  `exp_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblfund`
--

INSERT INTO `tblfund` (`fundid`, `amount`, `paiddate`, `remarks`, `userid`, `paytype`, `bankname`, `cardno`, `cvv`, `exp_month`, `exp_year`) VALUES
(10, '10000.00', '2026-08-23', 'Use this money to BAN UIU News Box. This is a Bribe for you to take the action immediately', 25, 'Debitcard', 'DBBL', '7894561234567896', 345, 12, 2024),
(11, '5000.00', '2026-08-23', 'R eta diye sobai mile cha nasta khaiyen', 25, 'Creditcard', 'Joy Bangla Bank', '7854698745632145', 345, 12, 2028);

-- --------------------------------------------------------

--
-- Table structure for table `tblfundinterest`
--

CREATE TABLE `tblfundinterest` (
  `fundinvestid` int(11) NOT NULL,
  `investedfor` varchar(250) NOT NULL,
  `note` text NOT NULL,
  `investeddate` date NOT NULL,
  `iamount` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblfundinterest`
--

INSERT INTO `tblfundinterest` (`fundinvestid`, `investedfor`, `note`, `investeddate`, `iamount`) VALUES
(16, 'Banned UIU News Box', 'UIU news Box group is limiting student voices. Students voices should not be controlled.', '2023-08-30', 8000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tblgallery`
--

CREATE TABLE `tblgallery` (
  `gid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblgallery`
--

INSERT INTO `tblgallery` (`gid`, `eventid`, `photo`) VALUES
(33, 5, 'gallery/383028067Screenshot_20230214_021601.png'),
(34, 6, 'gallery/1550179331Banner_FB-1.jpg'),
(35, 6, 'gallery/1203742192165482_157.jpg'),
(36, 5, 'gallery/102440995Untitled.jpg'),
(37, 7, 'gallery/2101650339350987272_287253393652006_8440327587668847233_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbljob`
--

CREATE TABLE `tbljob` (
  `jobid` int(11) NOT NULL,
  `company` varchar(100) NOT NULL,
  `jobtitle` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `jobdescription` text NOT NULL,
  `salary` varchar(50) NOT NULL,
  `exp_required` varchar(50) NOT NULL,
  `noofvacancy` int(11) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `lastdate` date NOT NULL,
  `alumnid` int(11) NOT NULL,
  `keyskils` varchar(350) NOT NULL,
  `job_location` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbljob`
--

INSERT INTO `tbljob` (`jobid`, `company`, `jobtitle`, `qualification`, `jobdescription`, `salary`, `exp_required`, `noofvacancy`, `emailid`, `status`, `lastdate`, `alumnid`, `keyskils`, `job_location`) VALUES
(4, 'NeoHive INC.', 'Senior Software Mobile Full Stack Developer, Test & Web developer', 'Minimum 2 Nobel Prize in Engineering', 'Responsibilities:  \r\nPassion for naming variables and functions \r\nThe ability to write understandable code and adhere to best practices \r\nAnalytical and comprehension skills, as well as problem-solving abilities \r\nUnderstanding of OOP, DB-Schema, and Software MVC architecture \r\nProven expertise with Django and Django REST Framework \r\nWorking experience with Web Services REST and JSON based API design \r\nHands on experience of Linux (Command Line), SSH, Bash/ZSH \r\n\r\n\r\nRequirements:  \r\n12 months minimum experience \r\nB.Sc./M.Sc. in Computer Science/Computer Science and Engineering \r\nEducational requirements will be reduced for qualified applicants \r\n\r\n\r\nGood to have: \r\nIndividual Capability of Dealing with a Single Project \r\nVery excellent Sense of Teamwork \r\nPositive Attitude towards Work and Proper Utilization of Weekends \r\nVery good Sense of Accountability and Proactive Delivery \r\nVery good Sense of Discipline, Dress Code, Corporate Manner \r\nProficiency in Bengali and English communication. \r\n\r\n\r\nWorkplace:  \r\nOn Site\r\n\r\n\r\nJob Location:  \r\nLalmatia, Dhaka ', '10000 ', '30+ Year', 1, 'write2turza@gmail.com', 'Active', '2023-12-11', 13, 'Java, Flutter, PHP, Django, HTml, CSS, Javascript, Python, react, angular, vue, Android, Swift, Go, Typescript, .net Asp', 'Gulshan, Uganda');

-- --------------------------------------------------------

--
-- Table structure for table `tbljobappln`
--

CREATE TABLE `tbljobappln` (
  `jobapplid` int(11) NOT NULL,
  `jobid` int(11) NOT NULL,
  `candidatename` varchar(50) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `emailid` varchar(15) NOT NULL,
  `applndate` date NOT NULL,
  `resumecopy` varchar(100) NOT NULL,
  `coverletter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbljobappln`
--

INSERT INTO `tbljobappln` (`jobapplid`, `jobid`, `candidatename`, `contactno`, `emailid`, `applndate`, `resumecopy`, `coverletter`) VALUES
(4, 4, 'nafiz', '01700696969', 'nafiz@gmail.com', '2023-08-27', '364947925', 'asbdbasndi');

-- --------------------------------------------------------

--
-- Table structure for table `tblofficer`
--

CREATE TABLE `tblofficer` (
  `id` int(11) NOT NULL,
  `locid` int(11) NOT NULL,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpost`
--

CREATE TABLE `tblpost` (
  `postid` int(11) NOT NULL,
  `postname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpost`
--

INSERT INTO `tblpost` (`postid`, `postname`) VALUES
(1, 'Director'),
(2, 'Professor & Head'),
(3, 'Secreatary'),
(4, 'Joint Secreatary'),
(5, 'Treasurer');

-- --------------------------------------------------------

--
-- Table structure for table `tblregion`
--

CREATE TABLE `tblregion` (
  `locid` int(11) NOT NULL,
  `location` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblregion`
--

INSERT INTO `tblregion` (`locid`, `location`) VALUES
(15, 'Dhaka'),
(16, 'Khulna'),
(17, 'Noakhali Bivag chai');

-- --------------------------------------------------------

--
-- Table structure for table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `staffid` int(11) NOT NULL,
  `staffname` varchar(150) NOT NULL,
  `qualification` varchar(150) NOT NULL,
  `designation` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `dateof_join` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `staff_pass` varchar(20) NOT NULL,
  `staffphoto` varchar(200) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbltraining`
--

CREATE TABLE `tbltraining` (
  `trainingid` int(11) NOT NULL,
  `topicname` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `courseid` int(11) NOT NULL,
  `trainingdate` date NOT NULL,
  `duration` int(11) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `participationdate` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `refcontactname` varchar(100) NOT NULL,
  `refcontactno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltraining`
--

INSERT INTO `tbltraining` (`trainingid`, `topicname`, `description`, `courseid`, `trainingdate`, `duration`, `venue`, `participationdate`, `status`, `refcontactname`, `refcontactno`) VALUES
(9, 'Java Workshop By Mark Zuckerburg', 'Mark Zuckerburg is an UIU Alumni. He decided to organize a 3 day workshop in our campus to teach about java fundamentals to new aspiring Students', 14, '2023-09-10', 6, 'Campus', '2023-09-12', 'Active', 'Provat', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbltrainingappln`
--

CREATE TABLE `tbltrainingappln` (
  `tpid` int(11) NOT NULL,
  `trainid` int(11) NOT NULL,
  `alimniid` int(11) NOT NULL,
  `confirmdate` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltrainingappln`
--

INSERT INTO `tbltrainingappln` (`tpid`, `trainid`, `alimniid`, `confirmdate`, `status`) VALUES
(1, 4, 1, '2017-03-02', 'Selected'),
(2, 5, 1, '2017-03-02', 'Denied'),
(3, 5, 7, '2017-03-09', 'Selected'),
(4, 8, 16, '2020-07-04', 'Selected'),
(5, 9, 13, '2023-08-26', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userid` int(11) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `name` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `pyear` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `occupation` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `message` text NOT NULL,
  `upass` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL,
  `location` int(11) NOT NULL,
  `membershiptype` varchar(15) NOT NULL,
  `mfee` float(10,2) NOT NULL,
  `paytype` varchar(15) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `cardno` varchar(16) NOT NULL,
  `cvv` int(4) NOT NULL,
  `expmonth` int(11) NOT NULL,
  `expyear` int(11) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userid`, `gender`, `name`, `dob`, `emailid`, `phone`, `pyear`, `courseid`, `occupation`, `address`, `message`, `upass`, `status`, `location`, `membershiptype`, `mfee`, `paytype`, `bank`, `cardno`, `cvv`, `expmonth`, `expyear`, `reg_date`) VALUES
(13, 'Male', 'Shijan', '1998-03-31', 'eyamin@gmail.com', '01700696969', 2021, 6, 'developer', 'Dhaka Bangladesh', 'I am passout in 2021 batch', '123', 'Active', 10, 'Standard', 1000.00, 'Debitcard', 'DBBL', '4556632569652314', 123, 4, 2024, '2022-01-03'),
(21, 'Male', 'Nafiz', '1998-02-05', 'nafiz@gmail.com', '01700696969', 2017, 14, 'Jobless', 'satarkul', 'I want 1st prize and CG 4 in this course ', '12345', 'Active', 15, '', 0.00, '', '', '', 0, 0, 0, '2023-08-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `tblalumnimeet`
--
ALTER TABLE `tblalumnimeet`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `tblalumniphoto`
--
ALTER TABLE `tblalumniphoto`
  ADD PRIMARY KEY (`photoid`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `tblfund`
--
ALTER TABLE `tblfund`
  ADD PRIMARY KEY (`fundid`);

--
-- Indexes for table `tblfundinterest`
--
ALTER TABLE `tblfundinterest`
  ADD PRIMARY KEY (`fundinvestid`);

--
-- Indexes for table `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `tbljob`
--
ALTER TABLE `tbljob`
  ADD PRIMARY KEY (`jobid`);

--
-- Indexes for table `tbljobappln`
--
ALTER TABLE `tbljobappln`
  ADD PRIMARY KEY (`jobapplid`);

--
-- Indexes for table `tblofficer`
--
ALTER TABLE `tblofficer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpost`
--
ALTER TABLE `tblpost`
  ADD PRIMARY KEY (`postid`);

--
-- Indexes for table `tblregion`
--
ALTER TABLE `tblregion`
  ADD PRIMARY KEY (`locid`);

--
-- Indexes for table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `tbltraining`
--
ALTER TABLE `tbltraining`
  ADD PRIMARY KEY (`trainingid`);

--
-- Indexes for table `tbltrainingappln`
--
ALTER TABLE `tbltrainingappln`
  ADD PRIMARY KEY (`tpid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblalumnimeet`
--
ALTER TABLE `tblalumnimeet`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblalumniphoto`
--
ALTER TABLE `tblalumniphoto`
  MODIFY `photoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblfund`
--
ALTER TABLE `tblfund`
  MODIFY `fundid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblfundinterest`
--
ALTER TABLE `tblfundinterest`
  MODIFY `fundinvestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbljob`
--
ALTER TABLE `tbljob`
  MODIFY `jobid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbljobappln`
--
ALTER TABLE `tbljobappln`
  MODIFY `jobapplid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblofficer`
--
ALTER TABLE `tblofficer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblpost`
--
ALTER TABLE `tblpost`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblregion`
--
ALTER TABLE `tblregion`
  MODIFY `locid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblstaff`
--
ALTER TABLE `tblstaff`
  MODIFY `staffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbltraining`
--
ALTER TABLE `tbltraining`
  MODIFY `trainingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbltrainingappln`
--
ALTER TABLE `tbltrainingappln`
  MODIFY `tpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
