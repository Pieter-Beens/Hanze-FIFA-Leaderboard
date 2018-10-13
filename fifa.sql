-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2018 at 01:59 AM
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
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `homeplayer` int(11) NOT NULL,
  `awayplayer` int(11) NOT NULL,
  `homegoals` int(11) NOT NULL,
  `awaygoals` int(11) NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `homeplayer`, `awayplayer`, `homegoals`, `awaygoals`, `description`, `datetime`) VALUES
(1, 2, 5, 5, 0, 'What\'s in a name.', '2018-10-01 03:00:00'),
(2, 3, 5, 5, 0, NULL, '2018-10-19 06:00:00'),
(3, 6, 3, 0, 5, 'Wie stopt deze man???', '2018-10-19 14:00:00'),
(4, 6, 2, 0, 3, NULL, '2018-10-22 11:19:00'),
(5, 4, 3, 0, 1, 'Maar serieus, waar is Hayo\'s fiets?', '2018-10-26 10:14:25');

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
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `realname` varchar(45) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `score` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `confirmation` varchar(45) DEFAULT NULL,
  `avatar` varchar(256) DEFAULT NULL,
  `roles_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `realname`, `password`, `score`, `email`, `confirmation`, `avatar`, `roles_id`, `datetime`) VALUES
(2, 'KabouterKlop77', 'Pieter Beens', 'quidproquo', 130, 'p.beens@st.hanze.nl', '1', 'https://argylesuperstore.co.uk/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/f/o/football_gnome_web_only.jpg', 2, '2018-10-13 01:32:23'),
(3, 'TheMenace', 'Dennis Smid', '1337', 150, 'd.smid@st.hanze.nl', '1', 'https://images-na.ssl-images-amazon.com/images/I/41y4FyN73kL._SX425_.jpg', 1, '0000-00-00 00:00:00'),
(4, 'Hayonnaise', 'Hayo Riem', 'sinatra', 100, 'h.riem@st.hanze.nl', '1', 'http://i.imgur.com/KbqTG.jpg', 1, '0000-00-00 00:00:00'),
(5, 'Aikematig', 'Djurre Aikema', 'ladygaga', 50, 'd.aikema@st.hanze.nl', '1', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Illuminati_triangle_eye.png/576px-Illuminati_triangle_eye.png', 1, '1918-10-24 00:00:00'),
(6, 'DoelpuntjesDamien', 'Daniel Windstra', 'ultimarulez', 70, 'd.windstra@st.hanze.nl', '1', 'https://www.vlaggenmasten.nl/media/catalog/product/cache/2/image/800x800/9df78eab33525d08d6e5fb8d27136e95/v/l/vlag-friesland_1_3.jpg', 1, '1203-10-31 03:30:12');

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
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
