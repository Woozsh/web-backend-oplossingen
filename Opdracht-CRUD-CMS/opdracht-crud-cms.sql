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
-- Database: `opdracht-crud-cms`
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
(2, 'My Wishlist', 'Creating a form in Foundation is designed to be easy but extremely flexible. Forms are built with a combination of standard form elements, as well as grid rows and columns.', 'titel', '0000-00-00', 1, 1, 0),
(6, 'Manon was zat', 'Eigenlijk echt heel zat.', 'zat, manon', '2016-12-11', 1, 1, 0),
(8, 'Een mooie zomerdag', 'Het was eens een mooie zomerdag, toen plots iedereen het koud had.', 'zomer, koud, nat', '0000-00-00', 1, 1, 18),
(9, 'Manon was zat', 'Eigenlijk echt heel zat.', 'zat, manon', '1995-01-27', 0, 1, 18),
(10, 'Manon was zat', 'Eigenlijk echt heel zat.', 'titel', '2002-12-13', 0, 1, 6),
(11, 'My First time went a little like this', 'Creating a form in Foundation is designed to be easy but extremely flexible. Forms are built with a combination of standard form elements, as well as grid rows and columns.', 'titel', '1995-01-27', 1, 1, 7),
(12, 'My First time went a little like this', 'Creating a form in Foundation is designed to be easy but extremely flexible. Forms are built with a combination of standard form elements, as well as grid rows and columns.', 'titel', '1995-01-27', 0, 1, 8),
(13, 'Manon was zat', 'Eigenlijk echt heel zat.', 'zat, manon', '0000-00-00', 1, 1, 9),
(14, 'Manon was nuchter', 'haha ne', 'manon, zat', '2016-12-11', 1, 0, 10),
(15, 'Een mooie zomerdag', 'Het was eens een mooie zomerdag, toen plots iedereen het koud had.', 'zomer, koud, nat', '0000-00-00', 1, 0, 11);

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
(1, 18, '2016-12-12 20:53:47', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(2, 18, '2016-12-12 21:02:44', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(3, 18, '2016-12-12 21:03:49', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(4, 18, '2016-12-12 21:04:31', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(5, 18, '2016-12-12 21:04:57', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(6, 18, '2016-12-12 21:06:11', 18, '2016-12-12 21:12:12', 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(7, 18, '2016-12-12 21:19:05', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(8, 18, '2016-12-12 21:22:50', 18, '2016-12-12 21:23:33', 1, 18, '2016-12-12 21:23:34', 0, 0, '0000-00-00 00:00:00'),
(9, 18, '2016-12-12 21:26:35', 0, '0000-00-00 00:00:00', 1, 18, '2016-12-12 21:31:47', 0, 18, '2016-12-12 21:31:17'),
(10, 18, '2016-12-12 21:26:45', 18, '2016-12-12 21:38:05', 0, 0, '0000-00-00 00:00:00', 1, 18, '2016-12-12 21:34:38'),
(11, 18, '2016-12-12 21:26:55', 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', 1, 18, '2016-12-12 21:32:03');

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
(19, 'webmasterhimself@brabo.be', '2112508810584f0023bfb8b9.78017991', '2a2923099d5307b8b3034dd33887ca1e74f951f37345fa6c3c75056c860fbf9b3ed03d62e45a9133c18d0b49c69dc9ec439549e8deef97527acd389d17367d18', '2016-12-12');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT voor een tabel `tracking_details`
--
ALTER TABLE `tracking_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
