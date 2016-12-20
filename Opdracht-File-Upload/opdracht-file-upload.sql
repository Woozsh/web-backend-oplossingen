-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 dec 2016 om 17:13
-- Serverversie: 10.1.19-MariaDB
-- PHP-versie: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opdracht-file-upload`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikels`
--

CREATE TABLE `artikels` (
  `id` int(11) NOT NULL,
  `titel` text COLLATE utf8_bin NOT NULL,
  `artikel` text COLLATE utf8_bin NOT NULL,
  `kernwoorden` text COLLATE utf8_bin NOT NULL,
  `datum` date NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0' COMMENT '0=not_active, 1=active',
  `is_archived` int(11) NOT NULL DEFAULT '0' COMMENT '0=active, 1=archived',
  `tracking_details_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `artikels`
--

INSERT INTO `artikels` (`id`, `titel`, `artikel`, `kernwoorden`, `datum`, `is_active`, `is_archived`, `tracking_details_id`) VALUES
(1, 'Manon was zat', 'Eigenlijk echt heel zat.', 'zat, manon', '0000-00-00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tracking_details`
--

CREATE TABLE `tracking_details` (
  `id` int(11) NOT NULL,
  `created_by_user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `changed_by_user_id` int(11) NOT NULL,
  `changed_on` datetime NOT NULL,
  `is_archived` tinyint(1) NOT NULL,
  `archived_by_user_id` int(11) NOT NULL,
  `archived_on` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `activated_by_user_id` int(11) NOT NULL,
  `activated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tracking_details`
--

INSERT INTO `tracking_details` (`id`, `created_by_user_id`, `created_on`, `changed_by_user_id`, `changed_on`, `is_archived`, `archived_by_user_id`, `archived_on`, `is_active`, `activated_by_user_id`, `activated_on`) VALUES
(1, 1, '2016-12-12 23:10:44', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 1, '2016-12-12 23:11:06');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `salt` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hashed_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login_time` date NOT NULL,
  `profile_picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `salt`, `hashed_password`, `last_login_time`, `profile_picture`) VALUES
(1, 'guypeters@mail.be', '1364827851584f0e002e4b22.29688868', '427e5e56d69c9b292756d255f44977201c7b5402881df0a6f1c92cdd9ee429f3594cf3f0b400574a39a41c277aabdde3aa931a0e533d3617079b2bdb32201173', '2016-12-12', '13-12-2016-04-25-42_deepfreezelogo.jpg');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tracking_details`
--
ALTER TABLE `tracking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `tracking_details`
--
ALTER TABLE `tracking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
