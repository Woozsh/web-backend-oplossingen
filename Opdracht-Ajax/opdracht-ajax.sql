-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 dec 2016 om 16:39
-- Serverversie: 10.1.13-MariaDB
-- PHP-versie: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opdracht-ajax`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `time_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `email`, `message`, `time_sent`) VALUES
(1, '', '', '2016-12-15 14:55:04'),
(2, '', '', '2016-12-15 14:55:04'),
(3, '', '', '2016-12-15 14:55:04'),
(4, '', '', '2016-12-15 14:57:18'),
(5, '', '', '2016-12-15 14:59:17'),
(6, 'jordy.pereira@hotmail.com', 'jklpopopppp$k', '2016-12-15 14:59:30'),
(7, 'jordy.pereira@hotmail.com', 'jklpopopppp$k', '2016-12-15 15:02:41'),
(8, 'jordy.pereira@hotmail.com', 'jklpopopppp$k', '2016-12-15 15:03:06'),
(9, 'jordy.pereira@hotmail.com', 'iooijo\r\n', '2016-12-15 15:05:00'),
(10, 'jordy.pereira@hotmail.com', 'ddada', '2016-12-15 15:08:06'),
(11, 'jordy.pereira@hotmail.com', 'caca', '2016-12-15 15:09:20'),
(12, 'jordy.pereira@hotmail.com', 'dadad', '2016-12-15 15:11:18'),
(13, 'jordy.pereira@hotmail.com', 'sxa', '2016-12-15 15:14:57'),
(14, 'jordy.pereira@hotmail.com', 'dadad', '2016-12-15 15:16:42'),
(15, 'jordy.pereira@hotmail.com', 'dadad', '2016-12-15 15:18:37'),
(16, 'jordy.pereira@hotmail.com', 'dadad', '2016-12-15 15:19:23');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
