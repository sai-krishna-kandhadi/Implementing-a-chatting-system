-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: April 17, 2022 at 06:43 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amaterasu`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_onetomany`
--

CREATE TABLE `chat_onetomany` (
  `sender` varchar(20) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  `msg` varchar(300) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_onetomany`
--

INSERT INTO `chat_onetomany` (`sender`, `group_name`, `msg`, `time`) VALUES
('ssj', 'losendead', 'fohaoush', '2018-05-29 14:18:30'),
('zama', 'losendead', 'what does that mean', '2018-05-29 14:20:54'),
('ssj', 'losers', 'yo losers', '2018-05-29 14:36:55'),
('ssj', 'losendead', 'qwioqjdoiqJP', '2018-05-29 15:43:45'),
('zama', 'losendead', 'UNDERSTOOD', '2018-05-29 15:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `chat_onetoone`
--

CREATE TABLE `chat_onetoone` (
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `message` varchar(200) NOT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_onetoone`
--

INSERT INTO `chat_onetoone` (`sender`, `receiver`, `message`, `time`) VALUES
('ssj', 'zama', 'Mama', '2018-05-29 02:01:29'),
('zama', 'ssj', 'Bol Mama', '2018-05-29 02:01:43'),
('ssj', 'Prudhvi', 'h', '2018-05-29 10:11:34'),
('ssj', 'zama', 'n', '2018-05-29 10:11:54'),
('sss', 'zama', 'yo', '2018-05-29 12:02:29'),
('Assistant', 'ssj', 'This is your Assistant', '2018-05-29 12:45:29'),
('ssj', 'losendead-->group', 'yo', '2018-05-29 13:43:06'),
('ssj', 'losendead-->group', 'to', '2018-05-29 13:44:59'),
('ssj', 'Prudhvi', 'ujhilhio', '2018-05-29 14:12:28'),
('ssj', 'zama', 'hai', '2018-05-29 16:27:40'),
('ssj', 'zama', 'okay', '2018-05-29 16:27:48'),
('ssj', 'Assistant', 'hello', '2018-05-29 16:28:11'),
('ssj', 'zama', '', '0000-00-00 00:00:00'),
('hari', 'sss', '', '0000-00-00 00:00:00'),
('hari', 'sss', 'hi', '2018-05-29 16:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_name` varchar(30) NOT NULL,
  `member1` varchar(20) NOT NULL,
  `member2` varchar(20) NOT NULL,
  `member3` varchar(20) NOT NULL,
  `member4` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_name`, `member1`, `member2`, `member3`, `member4`) VALUES
('losendead', 'Prudhvi', 'zama', 'ssj', ''),
('losers', 'ssj', 'zama', 'Prudhvi', '');

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `uname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online`
--

INSERT INTO `online` (`uname`) VALUES
('Assistant'),
('zama'),
('ssj'),
('ssj');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(30) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `uname`, `password`) VALUES
('hari@g.com', 'hari', '46ebaaa2b80c7a3459b80353e085aaeed5aff2ff'),
('prudhvi@gmail.com', 'Prudhvi', '8cb2237d0679ca88db6464eac60da96345513964'),
('ssgoku0@gmail.com', 'ssj', '668cc3a286ff71717cbb89a03abf5507091aa008'),
('st@gmail.com', 'sss', '8cb2237d0679ca88db6464eac60da96345513964'),
('zamahashmi@yahoo.com', 'zama', '7c4a8d09ca3762af61e59520943dc26494f8941b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_name`(20));

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `uname` (`uname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
