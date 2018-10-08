-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2018 at 03:46 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fifa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `players_accuser` varchar(28) NOT NULL,
  `players_accused` varchar(28) NOT NULL,
  `descriptions` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `datetime` varchar(45) NOT NULL,
  `players_home` varchar(28) NOT NULL,
  `goals_home` int(2) NOT NULL,
  `goals_away` int(2) NOT NULL,
  `players_away` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `playernames` varchar(28) NOT NULL,
  `passwords` varchar(28) NOT NULL,
  `realnames` varchar(45) NOT NULL,
  `studentcodes` int(6) NOT NULL,
  `hanzemails` varchar(45) NOT NULL,
  `scores` int(11) NOT NULL,
  `avatars` varchar(300) DEFAULT NULL,
  `confirmations` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playernames`, `passwords`, `realnames`, `studentcodes`, `hanzemails`, `scores`, `avatars`, `confirmations`) VALUES
('Aikematig', 'ladygaga', 'Djurre Aikema', 349740, 'd.aikema@st.hanze.nl', 50, 'nope.png', 1),
('DoelpuntjesDamien', 'ultimarulez', 'Daniël Windstra', 312072, 'd.windstra@st.hanze.nl', 100, 'nope.png', 1),
('Hayonnaise', 'sinatra', 'Hayo Riem', 390552, 'h.riem@st.hanze.nl', 80, 'nope.png', 1),
('KabouterKlop77', 'Myxtomat0s!s', 'Pieter Beens', 347070, 'p.beens@st.hanze.nl', 120, 'nope.png', 1),
('TheMenace', '?2nuY7)yAr51!', 'Dennis Smid', 384910, 'd.smid@st.hanze.nl', 150, 'nope.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`players_accuser`,`players_accused`),
  ADD KEY `fk_Cards_Players2_idx` (`players_accused`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`datetime`,`players_home`,`players_away`),
  ADD KEY `fk_Matches_Players1_idx` (`players_home`),
  ADD KEY `fk_Matches_Players2_idx` (`players_away`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`playernames`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `fk_Cards_Players1` FOREIGN KEY (`Players_Accuser`) REFERENCES `players` (`Playernames`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cards_Players2` FOREIGN KEY (`Players_Accused`) REFERENCES `players` (`Playernames`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `fk_Matches_Players1` FOREIGN KEY (`Players_Home`) REFERENCES `players` (`Playernames`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Matches_Players2` FOREIGN KEY (`Players_Away`) REFERENCES `players` (`Playernames`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
