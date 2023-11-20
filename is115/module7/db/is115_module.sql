-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20. Nov, 2023 21:29 PM
-- Tjener-versjon: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `is115_module`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `guidance_bookings`
--

CREATE TABLE `guidance_bookings` (
  `id` int(11) NOT NULL,
  `booking_header` varchar(255) NOT NULL,
  `booking_date` date NOT NULL,
  `appointee` varchar(255) NOT NULL,
  `supervisor` varchar(255) NOT NULL,
  `booking_registered` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `guidance_bookings`
--

INSERT INTO `guidance_bookings` (`id`, `booking_header`, `booking_date`, `appointee`, `supervisor`, `booking_registered`) VALUES
(1, 'I need help on monday!', '2023-11-13', 'John Doe', 'Super Visor', '2023-11-03'),
(2, 'Guidence for solving module #11', '2023-11-17', 'Johnny Jordan', 'James Bokassa', '2023-11-12'),
(3, 'Module #42 - Live approval', '2023-11-24', 'Waay Ahead', 'Canhelp Helperson', '2023-11-18'),
(4, 'I\'m lost', '2028-11-30', 'Chuck Noland', 'Wilson the volleyball', '2023-11-18'),
(5, 'Quick help session today please!', '2023-11-20', 'Michael Varg', 'Bush', '2023-11-20');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `guidance_users`
--

CREATE TABLE `guidance_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` int(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('student','la') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dataark for tabell `guidance_users`
--

INSERT INTO `guidance_users` (`id`, `name`, `phone`, `email`, `role`) VALUES
(1, 'Michael Tangeraas', 45411759, 'test@test.no', 'student'),
(2, 'Michael Tangeraas', 45411759, 'test@test.no', 'la');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guidance_bookings`
--
ALTER TABLE `guidance_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guidance_users`
--
ALTER TABLE `guidance_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guidance_bookings`
--
ALTER TABLE `guidance_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guidance_users`
--
ALTER TABLE `guidance_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
