-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 dec 2016 om 17:14
-- Serverversie: 10.1.19-MariaDB
-- PHP-versie: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opdracht-security-login`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `salt` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hashed_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `salt`, `hashed_password`, `last_login_time`) VALUES
(3, 'jordy.pereira@hotmail.com', '282495520584cb6e447e611.62786158', 'a9d91c55821f3d084dbdec8b715e4b68394409e8c2786e46f1bc6fe168f140634999a9e863218e202ae5b7cfe2f5aac05903607ae60f44b5441de28ac873c48e', '2016-12-11'),
(13, 'elmatepvp@hotmail.com', '1394393433584cc193433321.42558910', '4cc050fbfeef591b1e16b64931ed8797ca49c810d77dc3e94a6e532854379aea09907114941b21e4e38e026df0558d47772239d0730a1ec612be22430dc77ceb', '2016-12-11'),
(18, 'guypeters@mail.be', '1384517982584d8148582ec6.94597401', '303af8f14d103e42a2933d6d8c4b22fe8afff87964499f51548c8b5357a39b07e6f874b2b1538fa3d6e959dcf54d79f0bfe43dca92ce7234857e8c5c0654632a', '2016-12-11'),
(19, 'hsc.brabo@gmail.com', '657338387584d85cd07a248.75938050', 'cd9af4ae2c637c43e9f2a9ef5ab4fa08813ffd80364ca02993490ff9598f48e5f86d1bee39ac89f547693b6b2abf15e8068a776143ac1f426ae999e546a224c8', '2016-12-11');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
