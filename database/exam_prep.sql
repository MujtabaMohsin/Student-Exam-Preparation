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

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answerID` int(11) NOT NULL,
  `questionID` int(11) DEFAULT NULL,
  `answerValue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `choiceID` int(255) NOT NULL,
  `questionID` int(255) DEFAULT NULL,
  `choiceValue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `Course_ID` int(11) NOT NULL,
  `course_name` varchar(20) DEFAULT NULL,
  `Course_Code` varchar(10) NOT NULL,
  `Description` varchar(399) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses_code`
--

CREATE TABLE `courses_code` (
  `Course_Code` varchar(10) NOT NULL,
  `Course_Name` varchar(99) NOT NULL DEFAULT 'No Name',
  `Department_ID` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_calendars`
--

CREATE TABLE `course_calendars` (
  `calendar_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT 'Main Calendar',
  `description` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_events`
--

CREATE TABLE `course_events` (
  `event_ID` int(11) NOT NULL,
  `calendar_ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT 'Title',
  `description` text NOT NULL DEFAULT 'Description',
  `start` timestamp NOT NULL DEFAULT current_timestamp(),
  `end` timestamp NOT NULL DEFAULT current_timestamp(),
  `allDay` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_todo`
--

CREATE TABLE `course_todo` (
  `todo_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `complete` tinyint(1) NOT NULL,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_topics`
--

CREATE TABLE `course_topics` (
  `topic_id` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_ID` int(11) NOT NULL,
  `department_Name` varchar(99) DEFAULT NULL,
  `department_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `discussion_ID` int(11) NOT NULL,
  `Question_title` varchar(99) NOT NULL,
  `Question` text NOT NULL,
  `No_of_ans` int(11) NOT NULL DEFAULT 0,
  `course_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discussions_answers`
--

CREATE TABLE `discussions_answers` (
  `answer_ID` int(11) NOT NULL,
  `answer` text NOT NULL,
  `discussion_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `likes_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flashcards`
--

CREATE TABLE `flashcards` (
  `cardID` int(50) NOT NULL,
  `courseID` int(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `Content` varchar(999) DEFAULT NULL,
  `StudentID` int(50) DEFAULT NULL,
  `type` int(10) NOT NULL DEFAULT 0,
  `topic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `flashcard_reports`
--

CREATE TABLE `flashcard_reports` (
  `reportID` int(50) NOT NULL,
  `cardID` int(50) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `reporterID` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `inviter_ID` int(11) NOT NULL,
  `Invitee_ID` int(11) NOT NULL,
  `Course_ID` int(11) NOT NULL,
  `status_ID` int(11) NOT NULL,
  `invite_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_ID` int(11) NOT NULL,
  `chapter` int(11) NOT NULL,
  `section` int(11) NOT NULL DEFAULT 0,
  `private` tinyint(4) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `note_name` varchar(99) NOT NULL,
  `type` varchar(40) NOT NULL,
  `size` int(11) NOT NULL,
  `data` longblob NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notificationsettings`
--

CREATE TABLE `notificationsettings` (
  `Setting_id` int(10) NOT NULL,
  `userID` int(10) DEFAULT NULL,
  `receive_type` int(10) DEFAULT 0,
  `time_before` int(10) DEFAULT 24
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionID` int(255) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `courseID` int(255) DEFAULT NULL,
  `studentID` int(255) DEFAULT NULL,
  `topic` varchar(255) NOT NULL DEFAULT 'General'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quizID` int(50) NOT NULL,
  `quizTitle` varchar(255) DEFAULT NULL,
  `nbQuestions` int(50) DEFAULT NULL,
  `time` int(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `courseID` int(50) DEFAULT NULL,
  `studentID` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `answerID` int(50) NOT NULL,
  `quizID` int(50) DEFAULT NULL,
  `questionID` int(50) DEFAULT NULL,
  `answerValue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_choices`
--

CREATE TABLE `quiz_choices` (
  `choiceID` int(50) NOT NULL,
  `questionID` int(50) DEFAULT NULL,
  `choiceValue` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `quizQuestionID` int(55) NOT NULL,
  `quizID` int(55) DEFAULT NULL,
  `questionTitle` varchar(500) DEFAULT NULL,
  `questionType` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_reports`
--

CREATE TABLE `quiz_reports` (
  `reportID` int(50) NOT NULL,
  `quizID` int(50) NOT NULL,
  `text` varchar(500) NOT NULL,
  `reporterID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `result_id` int(55) NOT NULL,
  `quizID` int(55) DEFAULT NULL,
  `studentID` int(55) DEFAULT NULL,
  `result_value` int(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `reminder_ID` int(11) NOT NULL,
  `event_type` varchar(22) NOT NULL,
  `event_ID` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `msg` varchar(500) DEFAULT '.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `reportID` int(255) NOT NULL,
  `questionID` int(255) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `reporterID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_ID` int(11) NOT NULL,
  `resource_title` varchar(50) NOT NULL,
  `type` varchar(9) NOT NULL,
  `Chapter` int(11) NOT NULL,
  `private` tinytext NOT NULL,
  `Link` text NOT NULL,
  `Data` longblob NOT NULL,
  `name` varchar(99) NOT NULL,
  `From_Link` tinyint(4) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `Course_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_ID` int(11) NOT NULL,
  `status_name` varchar(49) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `User_name` varchar(99) NOT NULL,
  `User_email` varchar(99) NOT NULL,
  `password` text NOT NULL,
  `hash` varchar(255) NOT NULL,
  `student` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_favorite`
--

CREATE TABLE `users_favorite` (
  `favorite_id` int(50) NOT NULL,
  `card_id` int(50) DEFAULT NULL,
  `StudentID` int(50) DEFAULT NULL,
  `courseID` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_calendars`
--

CREATE TABLE `user_calendars` (
  `calendar_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `Course_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_events`
--

CREATE TABLE `user_events` (
  `event_ID` int(11) NOT NULL,
  `calendar_ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT 'Title',
  `description` text NOT NULL DEFAULT 'Description',
  `start` timestamp NOT NULL DEFAULT current_timestamp(),
  `end` timestamp NOT NULL DEFAULT current_timestamp(),
  `allDay` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_todo`
--

CREATE TABLE `user_todo` (
  `todo_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT 0,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answerID`),
  ADD KEY `questionID` (`questionID`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`choiceID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`Course_ID`);

--
-- Indexes for table `courses_code`
--
ALTER TABLE `courses_code`
  ADD UNIQUE KEY `Course_Code` (`Course_Code`),
  ADD KEY `Department_ID` (`Department_ID`);

--
-- Indexes for table `course_calendars`
--
ALTER TABLE `course_calendars`
  ADD PRIMARY KEY (`calendar_ID`),
  ADD KEY `course_ID` (`course_ID`);

--
-- Indexes for table `course_events`
--
ALTER TABLE `course_events`
  ADD PRIMARY KEY (`event_ID`),
  ADD KEY `calendar_ID` (`calendar_ID`);

--
-- Indexes for table `course_todo`
--
ALTER TABLE `course_todo`
  ADD PRIMARY KEY (`todo_ID`),
  ADD KEY `course_ID` (`course_ID`);

--
-- Indexes for table `course_topics`
--
ALTER TABLE `course_topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_ID`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`discussion_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `course_ID` (`course_ID`);

--
-- Indexes for table `discussions_answers`
--
ALTER TABLE `discussions_answers`
  ADD PRIMARY KEY (`answer_ID`),
  ADD KEY `discussion_ID` (`discussion_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `flashcards`
--
ALTER TABLE `flashcards`
  ADD PRIMARY KEY (`cardID`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `flashcard_reports`
--
ALTER TABLE `flashcard_reports`
  ADD PRIMARY KEY (`reportID`),
  ADD KEY `reporterID` (`reporterID`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`inviter_ID`,`Invitee_ID`,`Course_ID`) USING BTREE,
  ADD UNIQUE KEY `invite_ID` (`invite_ID`),
  ADD KEY `Invitee_ID` (`Invitee_ID`),
  ADD KEY `invitations_ibfk_3` (`Course_ID`),
  ADD KEY `invitations_ibfk_4` (`status_ID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `course_ID` (`course_ID`);

--
-- Indexes for table `notificationsettings`
--
ALTER TABLE `notificationsettings`
  ADD PRIMARY KEY (`Setting_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionID`),
  ADD KEY `questions_ibfk_1` (`studentID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quizID`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`answerID`);

--
-- Indexes for table `quiz_choices`
--
ALTER TABLE `quiz_choices`
  ADD PRIMARY KEY (`choiceID`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`quizQuestionID`);

--
-- Indexes for table `quiz_reports`
--
ALTER TABLE `quiz_reports`
  ADD PRIMARY KEY (`reportID`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminder_ID`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`reportID`),
  ADD KEY `reporterID` (`reporterID`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_ID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `users_favorite`
--
ALTER TABLE `users_favorite`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `user_calendars`
--
ALTER TABLE `user_calendars`
  ADD PRIMARY KEY (`calendar_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`Course_ID`,`User_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `user_events`
--
ALTER TABLE `user_events`
  ADD PRIMARY KEY (`event_ID`),
  ADD KEY `calendar_ID` (`calendar_ID`);

--
-- Indexes for table `user_todo`
--
ALTER TABLE `user_todo`
  ADD PRIMARY KEY (`todo_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `choiceID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `Course_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_calendars`
--
ALTER TABLE `course_calendars`
  MODIFY `calendar_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_events`
--
ALTER TABLE `course_events`
  MODIFY `event_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_todo`
--
ALTER TABLE `course_todo`
  MODIFY `todo_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_topics`
--
ALTER TABLE `course_topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `discussion_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discussions_answers`
--
ALTER TABLE `discussions_answers`
  MODIFY `answer_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flashcards`
--
ALTER TABLE `flashcards`
  MODIFY `cardID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flashcard_reports`
--
ALTER TABLE `flashcard_reports`
  MODIFY `reportID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `invite_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notificationsettings`
--
ALTER TABLE `notificationsettings`
  MODIFY `Setting_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quizID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `answerID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_choices`
--
ALTER TABLE `quiz_choices`
  MODIFY `choiceID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `quizQuestionID` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_reports`
--
ALTER TABLE `quiz_reports`
  MODIFY `reportID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `result_id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminder_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `reportID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_favorite`
--
ALTER TABLE `users_favorite`
  MODIFY `favorite_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_calendars`
--
ALTER TABLE `user_calendars`
  MODIFY `calendar_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_events`
--
ALTER TABLE `user_events`
  MODIFY `event_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_todo`
--
ALTER TABLE `user_todo`
  MODIFY `todo_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `questions` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses_code`
--
ALTER TABLE `courses_code`
  ADD CONSTRAINT `courses_code_ibfk_1` FOREIGN KEY (`Department_ID`) REFERENCES `department` (`department_ID`);

--
-- Constraints for table `course_calendars`
--
ALTER TABLE `course_calendars`
  ADD CONSTRAINT `course_calendars_ibfk_1` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`Course_ID`);

--
-- Constraints for table `course_events`
--
ALTER TABLE `course_events`
  ADD CONSTRAINT `course_events_ibfk_1` FOREIGN KEY (`calendar_ID`) REFERENCES `course_calendars` (`calendar_ID`);

--
-- Constraints for table `course_todo`
--
ALTER TABLE `course_todo`
  ADD CONSTRAINT `course_todo_ibfk_1` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`Course_ID`);

--
-- Constraints for table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `discussions_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discussions_ibfk_2` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`Course_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussions_answers`
--
ALTER TABLE `discussions_answers`
  ADD CONSTRAINT `discussions_answers_ibfk_1` FOREIGN KEY (`discussion_ID`) REFERENCES `discussions` (`discussion_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discussions_answers_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flashcards`
--
ALTER TABLE `flashcards`
  ADD CONSTRAINT `flashcards_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`Course_ID`),
  ADD CONSTRAINT `flashcards_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `flashcard_reports`
--
ALTER TABLE `flashcard_reports`
  ADD CONSTRAINT `flashcard_reports_ibfk_1` FOREIGN KEY (`reporterID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_ibfk_1` FOREIGN KEY (`inviter_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitations_ibfk_2` FOREIGN KEY (`Invitee_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitations_ibfk_3` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`Course_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitations_ibfk_4` FOREIGN KEY (`status_ID`) REFERENCES `status` (`status_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`Course_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `courses` (`Course_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`reporterID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `users_favorite`
--
ALTER TABLE `users_favorite`
  ADD CONSTRAINT `users_favorite_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`Course_ID`),
  ADD CONSTRAINT `users_favorite_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `user_calendars`
--
ALTER TABLE `user_calendars`
  ADD CONSTRAINT `user_calendars_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `user_courses_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`Course_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_courses_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `user_events`
--
ALTER TABLE `user_events`
  ADD CONSTRAINT `user_events_ibfk_1` FOREIGN KEY (`calendar_ID`) REFERENCES `user_calendars` (`calendar_ID`);

--
-- Constraints for table `user_todo`
--
ALTER TABLE `user_todo`
  ADD CONSTRAINT `user_todo_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`User_ID`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
