-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2025 at 02:08 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saloon`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `service` text NOT NULL,
  `provider` text NOT NULL,
  `location` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `instructions` mediumtext NOT NULL,
  `status` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `service`, `provider`, `location`, `date`, `time`, `instructions`, `status`) VALUES
(3, 'Sandra', 'sandra@mail.com', '+256701234567', 'Hair Stylist', 'stylist', 'Ntinda', '2025-05-10', '09:30:00', 'I want box braids.', 'Accepted'),
(4, 'David', 'davidk@gmail.com', '+256775432198', 'Hair Coloring', 'stylist2', 'Bugolobi', '2025-04-12', '14:00:00', 'Go bold with red.', 'Accepted'),
(5, 'Maria', 'maria@beauty.com', '+256703456789', 'Manicure', 'stylist3', 'Entebbe', '2025-04-15', '13:00:00', 'French tips only.', 'Accepted'),
(6, 'Peter', 'peterstyles@mail.com', '+256784562311', 'Pedicure', '', 'Kira', '2025-04-20', '16:30:00', 'Add scrub please.', 'pending'),
(7, 'Linda', 'lindaqueen@mail.com', '+256778889900', 'Hair Cut', 'stylist2', 'Kyaliwajjala', '2025-04-22', '10:00:00', 'Shoulder length bob.', 'Accepted'),
(8, 'Brian', 'brianb@gmail.com', '+256770001122', 'Facial', 'stylist', 'Kampala', '2025-04-25', '15:45:00', 'Use sensitive skin products.', 'Accepted'),
(9, 'user', 'ian.lubinga@ug.gt.com', '0778053879', 'Hair Cut', 'stylist', 'Lugogo', '2025-05-02', '20:20:00', 'Cut me well', 'Accepted'),
(10, 'Lubinx Ian', 'ian.lubinga@ug.gt.com', '0778053879', 'Hair Cut', '', 'Lugogo', '2025-05-08', '18:20:00', 'Add a little style to it.', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `service` text NOT NULL,
  `review` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user`, `service`, `review`) VALUES
(1, 'Mark Henry', 'Beard cut', 'It was a very nice trim.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `user_role` tinytext NOT NULL,
  `status` text NOT NULL,
  `location` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `user_role`, `status`, `location`) VALUES
(1, 'admin', 'admin@salon.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'admin', 'active', ''),
(2, 'user', 'user@sample.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'user', 'active', 'Mukono'),
(3, 'stylist', 'stylist@salon.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'stylist', 'active', 'Kampala'),
(4, 'david', 'davidk@gmail.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'user', 'active', 'Bugolobi'),
(5, 'sandra', 'sandra@mail.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'user', 'active', 'Ntinda'),
(6, 'brian', 'brianb@gmail.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'user', 'active', 'Kampala'),
(7, 'stylist1', 'stylist1@salon.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'stylist', 'active', 'Kira'),
(8, 'stylist2', 'stylist2@salon.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'stylist', 'active', 'Kyaliwajjala'),
(9, 'stylist3', 'stylist3@salon.com', '$2y$10$AFl627YuIMJbdSX07GhN2ulYu0X25L9rptHacvFKWFTm/C0Jfi.6G', 'stylist', 'active', 'Entebbe'),
(10, 'Jack', 'ian.lubinga@ug.gt.com', '$2y$10$836VaCsPLTs6PiXwXEbu3OVVR3hX0N5M0Q4sXqH9Bo1WYFlNRUzAG', 'user', 'active', 'Lugogo');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
