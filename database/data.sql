-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2020 at 07:45 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam prep`
--

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answerID`, `questionID`, `answerValue`) VALUES
(31, 28, 'c3'),
(32, 29, 'c1'),
(33, 30, 'c3'),
(34, 31, 'c2'),
(35, 32, 'c2'),
(36, 33, 'c4'),
(37, 34, 'c1'),
(38, 35, 'c2'),
(39, 36, 'c1'),
(40, 37, 'c1'),
(41, 38, 'c2'),
(42, 39, 'c3'),
(43, 40, 'c1');

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`choiceID`, `questionID`, `choiceValue`) VALUES
(74, 28, 'malloc'),
(75, 28, 'alloc    '),
(76, 28, 'new    '),
(77, 28, 'class      '),
(78, 29, 'Same'),
(79, 29, 'Different'),
(80, 30, 'int'),
(81, 30, 'float'),
(82, 30, 'void'),
(83, 30, 'double'),
(84, 31, 'Function overriding'),
(85, 31, 'Function overloading'),
(86, 31, 'Function doubling'),
(87, 31, 'None of the mentioned'),
(88, 32, 'Primitive'),
(89, 32, 'Object'),
(90, 33, 'finalize'),
(91, 33, 'delete'),
(92, 33, 'class'),
(93, 33, 'constructor'),
(94, 34, 'Does not allocate'),
(95, 34, 'Allocates memory'),
(96, 35, 'if'),
(97, 35, 'switch'),
(98, 35, 'if & switch'),
(99, 35, 'none of the mentioned'),
(100, 36, 'if()'),
(101, 36, 'for()'),
(102, 36, 'continue'),
(103, 36, 'break'),
(104, 37, 'do-while'),
(105, 37, 'while'),
(106, 37, 'for'),
(107, 37, 'none of the mentioned'),
(108, 38, 'switch statement is more efficient than a set of nested ifs'),
(109, 38, 'two case constants in the same switch can have identical values'),
(110, 38, 'switch statement can only test for equality'),
(111, 38, 'it is possible to create a nested switch statements'),
(112, 39, 'Braces { }'),
(113, 39, 'Parentheses ()'),
(114, 39, 'Square Brackets [ ]'),
(115, 39, 'Angled Brackets < >'),
(116, 40, 'main method'),
(117, 40, 'finalize method'),
(118, 40, 'static method'),
(119, 40, 'private method');

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`Course_ID`, `course_name`, `Course_Code`, `Description`) VALUES
(5, '', 'ICS102', 'TEST'),
(6, '', 'Math101', 'TEST@'),
(13, NULL, 'ICS201', ''),
(14, NULL, 'ICS202', NULL),
(15, NULL, 'ICS233', NULL),
(16, NULL, 'ICS253', NULL),
(17, NULL, 'ICS254', NULL),
(18, NULL, 'ICS309', NULL),
(19, NULL, 'ICS324', NULL),
(20, NULL, 'ICS343', NULL),
(21, NULL, 'ICS351', NULL),
(22, NULL, 'ICS353', NULL),
(23, NULL, 'ICS381', NULL),
(24, NULL, 'ICS410', NULL),
(25, NULL, 'ICS411', NULL),
(26, NULL, 'ICS424', NULL),
(27, NULL, 'ICS431', NULL),
(28, NULL, 'ICS444', NULL),
(29, NULL, 'ICS484', NULL),
(30, NULL, 'ICS103', NULL);

--
-- Dumping data for table `courses_code`
--

INSERT INTO `courses_code` (`Course_Code`, `Course_Name`, `Department_ID`) VALUES
('ICS102', 'Introduction To Computing I', 1),
('ICS103', 'No Name', 1),
('ICS201', 'No Name', 1),
('ICS202', 'No Name', 1),
('ICS233', 'No Name', 1),
('ICS253', 'No Name', 1),
('ICS254', 'No Name', 1),
('ICS309', 'No Name', 1),
('ICS324', 'No Name', 1),
('ICS343', 'No Name', 1),
('ICS351', 'No Name', 1),
('ICS353', 'No Name', 1),
('ICS381', 'No Name', 1),
('ICS410', 'No Name', 1),
('ICS411', 'No Name', 1),
('ICS424', 'No Name', 1),
('ICS431', 'No Name', 1),
('ICS444', 'No Name', 1),
('ICS484', 'No Name', 1),
('Math101', 'Calculus I', 2);

--
-- Dumping data for table `course_calendars`
--

INSERT INTO `course_calendars` (`calendar_ID`, `course_ID`, `title`, `description`) VALUES
(1, 5, 'main calendar', ''),
(2, 6, 'main calendar', '');

--
-- Dumping data for table `course_events`
--

INSERT INTO `course_events` (`event_ID`, `calendar_ID`, `title`, `description`, `start`, `end`, `allDay`) VALUES
(6, 1, 'help session', 'test', '2020-07-18 06:00:00', '2020-07-18 06:00:00', 0);

--
-- Dumping data for table `course_topics`
--

INSERT INTO `course_topics` (`topic_id`, `course_ID`, `topic`) VALUES
(1, 5, 'Arrays'),
(2, 5, 'Classes'),
(4, 5, 'Flow of Control\r\n'),
(6, 5, 'Methods');

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_ID`, `department_Name`, `department_code`) VALUES
(1, 'Information and Computer Science', 'ICS'),
(2, 'Mathematics & Statistics', 'MATH'),
(3, 'Accounting & Finance', 'ACCT'),
(4, 'Aerospace Engineering', 'AE'),
(6, 'Architectural Engineering', 'ARC'),
(7, 'Architecture', 'ARE'),
(8, 'BIOL', 'BIOL'),
(9, 'Civil & Environmental Engg', 'CE'),
(10, 'Construction Engg & Management', 'CHE'),
(11, 'Chemical Engineering', 'CHEM'),
(12, 'CISE', 'CISE'),
(13, 'Computer Engineering', 'COE'),
(14, 'CPG', 'CPG'),
(15, 'City & Regional Planning', 'ECON'),
(16, 'Earth Sciences', 'EE'),
(17, 'Electrical Engineering', 'ENGL'),
(18, 'English Language Inst. (Prep)', 'FIN'),
(19, 'English Language Department', 'GEOL'),
(20, 'Info. Systems & Operations Mgt', 'GEOP'),
(21, 'Global & Social Studies', 'GS'),
(22, 'Islamic & Arabic Studies', 'IAS'),
(23, 'ISE', 'ISE'),
(25, 'Mechanical Engineering', 'ME'),
(26, 'Management and Marketing', 'MGT'),
(27, 'MIS', 'MIS'),
(28, 'Management and Marketing', 'MKT'),
(29, 'Physical Education', 'PE'),
(30, 'Petroleum Engineering', 'PETE'),
(31, 'Physics', 'PHYS'),
(32, 'Prep Science & Engineering', 'PYP'),
(33, 'SE', 'SE'),
(34, 'Mathematics & Statistics', 'STAT'),
(35, 'Information and Computer Science', 'SWE');

--
-- Dumping data for table `flashcards`
--

INSERT INTO `flashcards` (`cardID`, `courseID`, `title`, `Content`, `StudentID`, `type`, `topic`) VALUES
(26, 5, 'System.out', '<p><strong>System.out</strong> is an object that is part of the Java language</p>', 1, 0, 'General'),
(33, 5, 'Types of Java programs', '<p>Types of Java programs:</p><ul><li>Applications</li><li>Applets</li></ul>', 1, 0, 'General'),
(34, 5, 'if-else statement', '<p>An <strong>if-else statement</strong> chooses between two alternative statements based on the value of a Boolean expression</p>', 1, 0, 'Flow of Control\r\n'),
(35, 5, 'Java applet', '<p>A <strong>Java applet</strong> (little Java application) is a Java program that is meant to be run from a Web browser</p>', 1, 0, 'Classes'),
(36, 5, 'Println method', '<p><strong>println </strong>is a method invoked by the System.out object that can be used for console output</p>', 1, 0, 'Methods'),
(37, 5, 'Variable declarations', '<p>Variable declarations in Java are similar to those in other programming languages</p>', 1, 0, 'Arrays'),
(38, 5, 'switch statement', '<p>The <strong>switch </strong>statement is the only other kind of Java statement that implements multiway branching</p>', 1, 0, 'Flow of Control\r\n'),
(39, 5, ' equal sign (=)', '<p>&bull;In Java, the equal sign (=) is used as the assignment operator</p>', 1, 0, 'Methods'),
(40, 5, 'Boolean expression', '<p>A Boolean expression is an expression that is either true or false</p>', 1, 0, 'Flow of Control\r\n'),
(41, 5, 'Java can take a shortcut', '<p><strong>Java </strong>can take a shortcut when the evaluation of the first part of a &nbsp;Boolean expression produces a result that evaluation of the second part cannot change</p>', 1, 0, 'Methods'),
(126, 5, 'First Come First Served Algorithm', '<p><strong>244224</strong></p><ul><li><strong>1</strong></li><li><strong>2</strong></li><li><strong>3</strong></li></ul>', 7, 1, 'General'),
(127, 5, 'Methods in Java', '<p>A <strong>method </strong>is a block of code which only runs when it is called.</p>', 1, 0, 'Methods'),
(128, 5, 'Method Creation ', '<p>A method must be declared within a class. It is defined with the name of the method, followed by parentheses&nbsp;<strong>()</strong>.</p>', 1, 0, 'Methods'),
(129, 5, 'Java Strings', '<p>A&nbsp;<strong>String&nbsp;</strong>variable contains a collection of characters surrounded by double quotes</p>', 1, 0, 'Classes'),
(130, 5, 'Primitive data types', '<p>Primitive data types - includes&nbsp;byte,&nbsp;short,&nbsp;int,&nbsp;long,&nbsp;float,&nbsp;double,&nbsp;boolean&nbsp;and&nbsp;char</p>', 1, 0, 'Classes'),
(131, 5, 'Arrays in Java', '<p>Arrays are used to store multiple values in a single variable, instead of declaring separate variables for each value.</p>', 1, 0, 'Arrays'),
(132, 5, 'Declare an array', '<p>To declare an array, define the variable type with&nbsp;<strong>square brackets</strong>:</p><p>String[] cars;</p>', 1, 0, 'Arrays'),
(133, 5, 'Access Elements of Array', '<p>You access an array element by referring to the index number.</p>', 1, 0, 'Arrays');

--
-- Dumping data for table `flashcard_reports`
--

INSERT INTO `flashcard_reports` (`reportID`, `cardID`, `text`, `reporterID`) VALUES
(2, 33, '3131', 1),
(3, 26, 'dhdhddh', 1),
(4, 26, 'fefe', 1),
(5, 119, 'fht', 1),
(6, 26, '0[i', 4);

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`inviter_ID`, `Invitee_ID`, `Course_ID`, `status_ID`, `invite_ID`) VALUES
(2, 1, 5, 21, 11);

--
-- Dumping data for table `notificationsettings`
--

INSERT INTO `notificationsettings` (`Setting_id`, `userID`, `receive_type`, `time_before`) VALUES
(1, 1, 0, 24);

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionID`, `title`, `courseID`, `studentID`, `topic`) VALUES
(28, 'Which operator is used to allocate memory to array in Java?', 5, 1, 'Arrays'),
(29, 'An Array in Java is a collection of elements of data type?', 5, 1, 'Arrays'),
(30, 'What is the return type of a method that not return any value?', 5, 1, 'Functions'),
(31, 'What is the process of defining more than one method in a class?', 5, 1, 'Functions'),
(32, 'The Java Virtual Machine (JVM) implements arrays as type?', 5, 1, 'Arrays'),
(33, 'Which one is a method same name as that of it’s class?', 5, 1, 'Functions'),
(34, 'What is array declaration in Java without initialization memory?', 5, 1, 'Arrays'),
(35, 'Which of these selection statements test only for equality?', 5, 1, 'Flow of Control\r\n'),
(36, 'Which of these are selection statements in Java?', 5, 1, 'Flow of Control\r\n'),
(37, 'Which of the following loops will execute if the loop is initially false?', 5, 1, 'Flow of Control\r\n'),
(38, 'Which of this statement is incorrect since loop not stop?', 5, 1, 'Flow of Control\r\n'),
(39, 'Which are the special symbols used to declare an array in Java?', 5, 1, 'Arrays'),
(40, 'Which method can be defined only once in a program?', 5, 1, 'Classes');

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quizID`, `quizTitle`, `nbQuestions`, `time`, `description`, `courseID`, `studentID`) VALUES
(101, 'Recursion in Java ', 5, 5, 'Java Questions & Answers – Recursion', 5, 1),
(102, 'Arrays Quiz in Java', 3, 5, 'Java Collections Interface Quiz', 5, 1),
(103, 'Mthods Quiz', 3, 6, 'Very Important quiz', 5, 1),
(104, 'Multithreading in Java', 2, 7, 'Multithreading', 5, 1),
(105, 'Hard Quiz in Classes', 2, 5, 'java quiz', 5, 1);

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`answerID`, `quizID`, `questionID`, `answerValue`) VALUES
(56, 101, 79, 'c2'),
(57, 101, 80, 'c2'),
(58, 101, 81, 'c1'),
(59, 101, 82, 'c4'),
(60, 101, 83, 'c1'),
(61, 102, 84, 'c4'),
(62, 102, 85, 'c1'),
(63, 102, 86, 'c1'),
(64, 103, 87, 'c2'),
(65, 103, 88, 'c1'),
(66, 103, 89, 'c1'),
(67, 104, 90, 'c1'),
(68, 104, 91, 'c2'),
(69, 105, 92, 'c3'),
(70, 105, 93, 'c1');

--
-- Dumping data for table `quiz_choices`
--

INSERT INTO `quiz_choices` (`choiceID`, `questionID`, `choiceValue`) VALUES
(281, 79, 'Recursion is a class'),
(282, 79, 'Recursion is a process of defining a method that calls other methods repeatedly'),
(283, 79, 'Recursion is a process of defining a method that calls itself repeatedly'),
(284, 79, 'Recursion is a process of defining a method that calls other methods which in turn call again this method'),
(285, 80, 'Which of these data types is used by operating system to manage the Recursion in Java?'),
(286, 80, 'Array'),
(287, 80, 'Queue'),
(288, 80, 'Tree'),
(289, 81, 'An infinite loop occurs'),
(290, 81, 'System stops the program after some time'),
(291, 81, 'After 1000000 calls it will be automatically stopped'),
(292, 81, 'None of the mentioned'),
(293, 82, 'A recursive method must have a base case'),
(294, 82, 'Recursion always uses stack'),
(295, 82, 'Recursive methods are faster that programmers written loop to call the function repeatedly using a stack'),
(296, 82, 'Recursion is managed by Java Runtime environment'),
(297, 83, 'java.lang'),
(298, 83, ' java.util'),
(299, 83, 'java.io'),
(300, 83, 'java.system'),
(301, 84, 'set'),
(302, 84, 'EventListner'),
(303, 84, 'Comparator'),
(304, 84, 'Collection'),
(305, 85, 'Set'),
(306, 85, 'List'),
(307, 85, 'Comparator'),
(308, 85, 'Collection'),
(309, 86, 'Set'),
(310, 86, 'Collection'),
(311, 86, 'Array'),
(312, 86, 'List'),
(313, 87, 'BlockingQueue'),
(314, 87, 'BlockingEnque'),
(315, 87, 'TransferQueue'),
(316, 87, 'BlockingQueue'),
(317, 88, 'Integer.MAX_VALUE'),
(318, 88, 'BigDecimal.MAX_VALUE'),
(319, 88, '99999999'),
(320, 88, 'Integer.INFINITY'),
(321, 89, 'True'),
(322, 89, 'False'),
(323, 89, 'Integer.INFINITY'),
(324, 89, 'integer.MAX_VALUE'),
(325, 90, 'Thread'),
(326, 90, 'Process'),
(327, 90, 'Thread and Process'),
(328, 90, 'Neither Thread nor Process'),
(329, 91, 'Process'),
(330, 91, 'Daemon Thread'),
(331, 91, 'User Thread'),
(332, 91, ' JVM Thread'),
(333, 92, 'get()'),
(334, 92, 'ThreadPriority()'),
(335, 92, ' getThreadPriority()'),
(336, 92, 'getPriority()'),
(337, 93, 'sleep()'),
(338, 93, ' terminate()'),
(339, 93, 'suspend()'),
(340, 93, 'stop()');

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`quizQuestionID`, `quizID`, `questionTitle`, `questionType`) VALUES
(79, 101, 'What is Recursion in Java?', 'MCQ'),
(80, 101, 'Which of these data types is used by operating system to manage the Recursion in Java?', 'MCQ'),
(81, 101, 'Which of these will happen if recursive method does not have a base case?', 'MCQ'),
(82, 101, 'Which of these is not a correct statement?', 'MCQ'),
(83, 101, 'Which of these packages contains the exception Stack Overflow in Java?', 'MCQ'),
(84, 102, 'Which of these interface declares core method that all collections will have?', 'MCQ'),
(85, 102, 'Which of these interface handle sequences?', 'MCQ'),
(86, 102, ' Which of this interface must contain a unique element?', 'MCQ'),
(87, 103, 'Which of the below is not a subinterface of Queue?', 'MCQ'),
(88, 103, 'What is the remaining capacity of BlockingQueue whose intrinsic capacity is not defined?', 'MCQ'),
(89, 103, 'PriorityQueue is thread safe.', 'MCQ'),
(90, 104, 'What requires less resources?', 'MCQ'),
(91, 104, 'What does not prevent JVM from terminating?', 'MCQ'),
(92, 105, 'Which of these method of Thread class is used to find out the priority given to a thread?', 'MCQ'),
(93, 105, 'Which of these method of Thread class is used to Suspend a thread for a period of time?', 'MCQ');

--
-- Dumping data for table `quiz_reports`
--

INSERT INTO `quiz_reports` (`reportID`, `quizID`, `text`, `reporterID`) VALUES
(1, 86, 'ff', 1);

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`result_id`, `quizID`, `studentID`, `result_value`) VALUES
(20, 101, 1, 1),
(21, 101, 1, 4),
(22, 102, 1, 0),
(23, 102, 1, 1),
(24, 103, 1, 0),
(25, 102, 1, 0),
(26, 102, 1, 0),
(27, 102, 1, 3),
(28, 102, 1, 0),
(29, 104, 1, 1),
(30, 102, 1, 1),
(31, 102, 5, 1);

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`reportID`, `questionID`, `text`, `reporterID`) VALUES
(1, 1, 'Grammar mistake', 1),
(39, 2, 'TEST', 2),
(40, 2, 'qqqqqqqqqqqqqqqq', 1),
(41, 2, 'test', 1),
(42, 2, 'qqqqqqqqqqqqqqqq', 1),
(43, 2, 'y4', 1),
(44, 2, 'test', 1),
(45, 2, 'testtt', 1),
(46, 2, 'ssw', 1),
(47, 4, 'vv', 5),
(48, 23, 'big pro', 1),
(49, 22, 'test', 1),
(50, 21, 'iritfit', 1),
(51, 3, '4774', 4),
(52, 7, 'wwe', 2),
(53, 3, 'te', 7);

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_ID`, `status_name`) VALUES
(21, 'Pending'),
(22, 'Accepted'),
(23, 'Rejected');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `User_name`, `User_email`, `password`, `hash`, `student`, `status`) VALUES
(1, 'Ali', 'ali@test.com', '1234', '$2y$10$GeZc91FuCPoo4A/aMPMGN.HzhImo1gMmor0aMz57XgjVuiZoz7sM6', 1, 1),
(2, 'Omar', 'Omar@test.com', '1234', '$2y$10$rTxRrIqCQeHp3KilL8Y5U.6bCeH5PhahPeEzBgNZhj6DEJnPqb7qO', 1, 1),
(3, 'admin', 'admin@admin.com', '1234', '$2y$10$Q497pRkZxCwxMUraYrymM.jgy2WpnLiWRJQTIVLvrMCjM65mtInaG', 0, 1),
(4, 'Abduallh', 'abd@a.com', '1234', '$2y$10$VgLMylSeGhSfrRKFAGXwXuR9AsbPN4XOaMu7Zopc3wpK2qm.QHuKq', 1, 1),
(5, 'Alaa', 'abc@a.com', '1234', '$2y$10$LTATdoY2V17XRxTh1Kl8R.U.wrOnUDUsUuFmsBtLvtLc5AEOcc6TK', 1, 1),
(6, 'Saud', 's@m.com', '1234', '$2y$10$GRcJrNiJFMAcd9X5jhoBV.6Z0THkT1TI44uzG6iCtLJBWFqne5JrO', 1, 1),
(7, 'mujtaba', 'm7@m.com', '1234', '$2y$10$lxv2dIyM/e82mhpu2wUg9ecf/TnPhj1/x4xIv7Az/6OUnGzw6TncG', 1, 1),
(8, 'ZAID', 'z@m.com', '123', '$2y$10$jq1eItjpQItuEM.j5NeVn.yAPsiR5osorKaNORS/cHFF8PAgW4sWq', 1, 1);

--
-- Dumping data for table `users_favorite`
--

INSERT INTO `users_favorite` (`favorite_id`, `card_id`, `StudentID`, `courseID`) VALUES
(119, 33, 1, 5),
(120, 26, 1, 5);

--
-- Dumping data for table `user_calendars`
--

INSERT INTO `user_calendars` (`calendar_ID`, `user_ID`, `title`, `description`) VALUES
(1, 1, 'Ali\'s Calendar', ''),
(2, 2, 'Omar\'s Calendar', '');

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`Course_ID`, `User_ID`) VALUES
(5, 1),
(5, 2),
(5, 4),
(5, 5),
(5, 7),
(6, 1),
(14, 1);

--
-- Dumping data for table `user_todo`
--

INSERT INTO `user_todo` (`todo_ID`, `user_ID`, `content`, `complete`, `dateTime`) VALUES
(1, 1, 'teyeye', 0, '0000-00-00 00:00:00');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
