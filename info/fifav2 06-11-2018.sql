-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2018 at 03:02 AM
-- Server version: 5.6.34
-- PHP Version: 7.1.11

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
  `id` int(11) NOT NULL,
  `accuser` int(11) NOT NULL,
  `accused` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `accuser`, `accused`, `description`, `datetime`) VALUES
(1, 2, 3, 'Dennis liep weg tijdens een potje omdat hij bang was te laat te komen. Hij weigerde zijn wachtwoord in te vullen toen ik hem vertelde dat ik 9-0 had gewonnen.', '2018-10-02 10:00:00'),
(2, 5, 2, 'Peter heeft voor mij een account aangemaakt maar ik speel helemaal geen FIFA.', '1972-06-13 16:23:00'),
(3, 2, 5, 'Joppe noemt mij nog steeds Peter.', '2018-10-10 09:00:00'),
(4, 2, 4, 'Hayo wil niet meer tegen mij spelen omdat hij denkt dat hij niet kan winnen. :\'(', '2018-10-22 23:00:00'),
(5, 6, 4, 'Pieter vroeg mij Hayo ook een kaart te geven om te kijken of hij gebanned zou worden.', '2018-10-25 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `submit_date` int(14) NOT NULL,
  `note` varchar(500) NOT NULL,
  `closed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ID`, `firstname`, `lastname`, `email`, `subject`, `message`, `submit_date`, `note`, `closed`) VALUES
(1, 'test', 'Badpak', 'badpack@gov.com', 'First!', 'TEST TEST TEST TEST ', 1540823212, 'testnotitie', 1),
(2, 'testuser', '2222222222', '32323123@gov.ru', 'Fi4214213123123', '4123123123123312', 1540803212, 'test2', 0),
(3, 'Dennis', 'Smid', 'dennis@st.hanze.nl', 'TITLE VAN BERICHTJES', 'TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST TEST', 1540503212, 'test string', 1),
(4, 'Peter', 'BE', 'peter@peter.be', 'Peters vraag', 'TEST TEST TEST TEST TEST TEST TEST TEST ', 1540853553, 'testnotitie', 1);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `homeplayer` int(11) NOT NULL,
  `awayplayer` int(11) NOT NULL,
  `homegoals` int(11) NOT NULL,
  `awaygoals` int(11) NOT NULL,
  `scorechange` decimal(11,3) DEFAULT NULL,
  `description` varchar(60) DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'user'),
(2, '{\"admin\": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `realname` varchar(45) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `score` decimal(11,3) NOT NULL,
  `highscore` int(11) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `confirmation` varchar(45) DEFAULT NULL,
  `avatar` varchar(512) DEFAULT NULL,
  `favteam` varchar(28) DEFAULT NULL,
  `roles_id` int(11) NOT NULL,
  `joindate` datetime NOT NULL,
  `salt` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `realname`, `password`, `score`, `highscore`, `email`, `confirmation`, `avatar`, `favteam`, `roles_id`, `joindate`, `salt`) VALUES
(2, 'KabouterKlop77', 'Pieter Beens', 'quidproquo', '100.000', 100, 'p.beens@st.hanze.nl', '1', 'https://argylesuperstore.co.uk/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/f/o/football_gnome_web_only.jpg', 'Arsenal', 2, '2018-10-18 11:58:40', NULL),
(3, 'TheMenace', 'Dennis Smid', '1337', '100.000', 100, 'd.smid@st.hanze.nl', '1', 'https://t6.rbxcdn.com/1c725527bf7cbabb9c1202e090c8bf88', 'VV Musselkanaal', 1, '2018-10-18 11:58:40', NULL),
(4, 'Hayonnaise', 'Hayo Riem', 'sinatra', '100.000', 100, 'h.riem@st.hanze.nl', '1', 'https://vignette.wikia.nocookie.net/r2da/images/2/24/Zilla_mayonnaise_transparent.png', 'Ajax', 1, '2018-10-18 11:58:40', NULL),
(5, 'Aikematig', 'Djurre Aikema', 'ladygaga', '100.000', 100, 'd.aikema@st.hanze.nl', '1', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Illuminati_triangle_eye.png/576px-Illuminati_triangle_eye.png', 'SC Heerenveen', 1, '2018-10-18 11:58:40', NULL),
(6, 'DoelpuntjesDamien', 'Daniel Windstra', 'ultimarulez', '100.000', 100, 'd.windstra@st.hanze.nl', '1', 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Pompebled.svg/600px-Pompebled.svg.png', 'Lokomotiv Moscow', 1, '2018-10-18 11:58:40', NULL),
(7, 'dennis', 'dennis', '9d9546e8f27e2e5d165f391b03192e90b11b9b90', '100.000', 100, 'dennis@st.hanze.nl', '1', NULL, NULL, 2, '2018-10-29 21:43:43', '92880d42980a9fdd8fb6b0e8e3a6105eab80a60eb78d0f2c74dd12ccd44d08d1');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `users_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`,`accuser`,`accused`),
  ADD KEY `fk_cards_users1_idx` (`accused`),
  ADD KEY `fk_cards_users2_idx` (`accuser`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`,`homeplayer`,`awayplayer`),
  ADD KEY `fk_results_users1_idx` (`homeplayer`),
  ADD KEY `fk_results_users2_idx` (`awayplayer`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_roles_idx` (`roles_id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `fk_cards_users1` FOREIGN KEY (`accused`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cards_users2` FOREIGN KEY (`accuser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_results_users1` FOREIGN KEY (`homeplayer`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_results_users2` FOREIGN KEY (`awayplayer`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `fk_user_sessions_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
