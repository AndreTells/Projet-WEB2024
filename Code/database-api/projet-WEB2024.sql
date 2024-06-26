-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2024 at 01:38 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet-WEB2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mail` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `job` varchar(255) NOT NULL,
  `profile_picture` blob,
  `admin` boolean,
PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`id`, `name`, `hash`, `mail`, `description`, `job`,`profile_picture`,`admin`) VALUES
(1, 'tom', 'web', 'web@example.com', 'Bio of tom', 'professor',NULL, 0),
(2, 'pedro', 'password456', 'pedro@example.com', 'Bio of PEDRO', 'etudiant',NULL, 0),
(3, 'WEB', '123', 'WEB@example.com', 'Bio of WEB', 'subject',NULL, 0 );

-- --------------------------------------------------------

--
-- Table structure for table `Conversation`
--

CREATE TABLE `Conversation` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Conversation`
--

INSERT INTO `Conversation` (`id`, `title`) VALUES
(1, 'Super trip'),
(2, 'Wow what a fun title for the trip');

-- --------------------------------------------------------

--
-- Table structure for table `Conversation_Accounts_AUX`
--

CREATE TABLE `Conversation_Accounts_AUX` (
  `account_id` int NOT NULL,
  `conversation_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Conversation_Accounts_AUX`
--

INSERT INTO `Conversation_Accounts_AUX` (`account_id`, `conversation_id`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE `Message` (
  `id` int NOT NULL,
  `conversation_id` int DEFAULT NULL,
  `posting_account_id` int DEFAULT NULL,
  `post_time` datetime NOT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Message`
--

INSERT INTO `Message` (`id`, `conversation_id`, `posting_account_id`, `post_time`, `content`) VALUES
(1, 1, 1, '2024-06-20 10:00:00', 'J aime ta base de donnees'),
(2, 1, 2, '2024-06-20 11:00:00', 'Moi aussi!'),
(3, 2, 3, '2024-06-21 12:00:00', 'Vous dites quoi? Je parle pas français');

-- --------------------------------------------------------

--
-- Table structure for table `Reservations`
--

CREATE TABLE `Reservations` (
  `account_id` int NOT NULL,
  `trip_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Reservations`
--

INSERT INTO `Reservations` (`account_id`, `trip_id`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Trip`
--

CREATE TABLE `Trip` (
  `id` int NOT NULL,
  `vehicle_id` int DEFAULT NULL,
  `conversation_id` int DEFAULT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `places` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Trip`
--

INSERT INTO `Trip` (`id`, `vehicle_id`, `conversation_id`, `from_location`, `to_location`, `places`, `date`) VALUES
(1, 1, 1, 'Centrale Lille', 'Lens', 4, '2024-07-01 08:00:00'),
(2, 2, 2, 'Lens', 'Centrale Lille', 4, '2024-07-02 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Vehicle`
--

CREATE TABLE `Vehicle` (
  `id` int NOT NULL,
  `conductor_id` int DEFAULT NULL,
  `model` varchar(255) NOT NULL,
  `license_plate` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Vehicle`
--

INSERT INTO `Vehicle` (`id`, `conductor_id`, `model`, `license_plate`, `color`) VALUES
(1, 1, 'Toyota Prius', 'ABC123', 'Blanc'),
(2, 2, 'Honda Civic', 'DEF456', 'Rouge');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Conversation`
--
ALTER TABLE `Conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Conversation_Accounts_AUX`
--
ALTER TABLE `Conversation_Accounts_AUX`
  ADD PRIMARY KEY (`account_id`,`conversation_id`),
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexes for table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `posting_account_id` (`posting_account_id`);

--
-- Indexes for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD PRIMARY KEY (`account_id`,`trip_id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `Trip`
--
ALTER TABLE `Trip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexes for table `Vehicle`
--
ALTER TABLE `Vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conductor_id` (`conductor_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Conversation_Accounts_AUX`
--
ALTER TABLE `Conversation_Accounts_AUX`
  ADD CONSTRAINT `conversation_accounts_aux_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `Account` (`id`),
  ADD CONSTRAINT `conversation_accounts_aux_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `Conversation` (`id`);

--
-- Constraints for table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `Conversation` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`posting_account_id`) REFERENCES `Account` (`id`);

--
-- Constraints for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `Account` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`trip_id`) REFERENCES `Trip` (`id`);

--
-- Constraints for table `Trip`
--
ALTER TABLE `Trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `Vehicle` (`id`),
  ADD CONSTRAINT `trip_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `Conversation` (`id`);

--
-- Constraints for table `Vehicle`
--
ALTER TABLE `Vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`conductor_id`) REFERENCES `Account` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
