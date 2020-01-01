-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u6
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vytvořeno: Stř 01. led 2020, 19:32
-- Verze serveru: 5.5.62-0+deb8u1
-- Verze PHP: 5.6.40-0+deb8u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `qtman`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `pause`
--

CREATE TABLE IF NOT EXISTS `pause` (
`id` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `when` datetime NOT NULL,
  `reason` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
`id` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `od` date NOT NULL,
  `do` date NOT NULL,
  `note` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`id` int(11) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `created` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `duration` int(4) NOT NULL,
  `queue` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `note` text COLLATE utf8_czech_ci NOT NULL,
  `result` varchar(10) COLLATE utf8_czech_ci DEFAULT NULL,
  `reason` text COLLATE utf8_czech_ci,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `solver` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `task`
--

INSERT INTO `task` (`id`, `priority`, `date`, `created`, `duration`, `queue`, `name`, `note`, `result`, `reason`, `started`, `finished`, `active`, `solver`) VALUES
(9, NULL, '2019-04-30 13:25:12', 'submiter', 1, 1, 'a', 'tyuio', 'OK', 'DONE', '2019-05-10 08:09:50', '2019-05-10 09:23:03', 0, 'tester'),
(10, NULL, '2019-04-30 13:53:31', 'manager', 20, 2, 'ukol z fronty tralala', 'Praha - BÃ½valÃ½ fotbalovÃ½ reprezentant TomÃ¡Å¡ Å˜epka pÅ¯jde na dva roky do vÄ›zenÃ­. OdvolacÃ­ soud nÄ›kdejÅ¡Ã­mu obrÃ¡nci Sparty Äi West Hamu zpÅ™Ã­snil pÅ¯vodnÄ› uloÅ¾enÃ½ patnÃ¡ctimÄ›sÃ­ÄnÃ­ souhrnnÃ½ trest. PÄ›taÄtyÅ™icetiletÃ½ sportovec se provinil zpronevÄ›rou luxusnÃ­ho vozu a internetovÃ½mi Ãºtoky na svou druhou exmanÅ¾elku, kterÃ© spoÄÃ­valy ve smyÅ¡lenÃ½ch erotickÃ½ch inzerÃ¡tech. Verdikt je pravomocnÃ½', 'OK', 'DONE', '2019-05-06 15:47:13', '2019-05-06 16:17:35', 0, NULL),
(11, NULL, '2019-04-30 15:11:20', 'tonda', 20, 2, 'otestovat hodinky', 's vodotryskem', 'NOT OK', 'Vodotrysk netryska', '2019-05-06 16:17:39', '2019-05-06 16:26:10', 0, NULL),
(12, NULL, '2019-05-07 12:00:19', 'tonda', 15, 3, 'tortilla se sÃ½rem', 'schvÃ¡lnÄ›, jestli chutnÃ¡? mindful eating', 'NOT OK', 'where is chilli?', '2019-05-07 12:00:42', '2019-05-07 12:00:54', 0, NULL),
(13, NULL, '2019-05-08 15:59:08', 'tonda', 22, 3, 'pokus', 'popis', NULL, NULL, '2019-05-08 15:59:21', NULL, 1, 'tonda'),
(14, 100, '2019-05-10 09:53:14', 'submiter', 5, 3, 'otestovat resitele', 'otestovat jestli se po odmavnuti otevre jiny pozadavek', 'OK', 'DONE', '2019-05-10 09:54:57', '2019-05-10 09:55:30', 0, 'tester'),
(15, 100, '2019-05-10 09:53:30', 'submiter', 5, 3, 'otestovat resitele 1', 'otestovat jestli se po odmavnuti otevre jiny pozadavek 1', 'NOT OK', 'problem - osetrit nez das start a jste na to 2 aby se ti nejdriv odkontrolovalo, jestli nenastartoval jiz nekdo jiny', '2019-05-10 09:56:00', '2019-05-10 09:56:56', 0, 'tester1'),
(16, 100, '2019-05-10 13:38:10', 'submiter', 10, 3, 'PÅ™edvÃ¡dÄ›Äka 1', 'Na tomto mÃ­stÄ› prosÃ­m udÄ›lej 2 lehsedy a pÃ­skni na prsty', NULL, NULL, '2019-05-10 14:42:29', NULL, 1, 'verka'),
(17, 100, '2019-05-10 13:38:58', 'submiter', 5, 3, 'PÅ™edvÃ¡dÄ›Äka 2', 'TentokrÃ¡t si zakryj oÄi a naraz hlavou do zdi', NULL, NULL, NULL, NULL, 1, NULL),
(18, 100, '2019-05-10 13:39:29', 'submiter', 2, 3, 'PÅ™edvÃ¡dÄ›Äka 3', 'OtevÅ™i dveÅ™e co nejrychlejÅ¡Ã­m zpÅ¯sobem', NULL, NULL, NULL, NULL, 1, NULL),
(19, 100, '2019-05-10 13:40:37', 'verka', 1, 1, 'PÅ™edvÃ¡dÄ›Äka 4', 'Kdo mi povÃ­ prvnÃ­ kolik je hodin vyhraje korunu', NULL, NULL, '2019-06-12 08:22:19', NULL, 1, 'tonda'),
(20, 100, '2019-05-10 13:41:18', 'verka', 5, 1, 'PÅ™edvÃ¡dÄ›Äka 5', 'PÅ™edstavte si velkÃ½ zelenÃ½ strom, co je to za strom, vÃ½sledek zapiÅ¡te', NULL, NULL, NULL, NULL, 1, NULL),
(21, 100, '2019-05-10 13:42:44', 'verka', 1, 2, 'PÅ™edvÃ¡dÄ›Äka 6', 'zavÅ™i oÄi , udÄ›lej otoÄku o 360 stupÅˆÅ¯ a pak otevÅ™i oÄi', NULL, NULL, NULL, NULL, 1, NULL),
(22, 100, '2019-05-10 13:44:06', 'verka', 2, 2, 'PÅ™edvÃ¡dÄ›Äka 7', 'Rychle Å™ekni prvnÃ­ spodnÃ­ prÃ¡dlo co tÄ› napadne a zeptej se kolik barev mÃ¡', NULL, NULL, NULL, NULL, 1, NULL),
(23, 100, '2019-05-10 13:44:54', 'verka', 5, 3, 'PÅ™edvÃ¡dÄ›Äka 8', 'AÅ¥ vstane kdo je v ÄernÃ©m triÄku a Å™ekne proÄ si ho vzal, vÃ½sledek zapiÅ¡', NULL, NULL, NULL, NULL, 1, NULL),
(24, 100, '2019-05-10 13:46:32', 'verka', 2, 3, 'PÅ™edvÃ¡dÄ›Äka 9', 'ZavÅ™i okno', NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabulky `tasktypes`
--

CREATE TABLE IF NOT EXISTS `tasktypes` (
`id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `priority` int(7) NOT NULL,
  `note` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `tasktypes`
--

INSERT INTO `tasktypes` (`id`, `name`, `priority`, `note`) VALUES
(2, 'Pokus', 10, 'pokusny text'),
(3, 'Test BudÃ­ku', 1, 'Budeme testovat kombÃ­ky');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `passcode` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `manager` tinyint(1) NOT NULL,
  `submiter` tinyint(1) NOT NULL,
  `tester` tinyint(1) NOT NULL,
  `email` varchar(80) COLLATE utf8_czech_ci DEFAULT NULL,
  `telefon` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `inserted` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `date` datetime NOT NULL,
  `queue` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `passcode`, `popis`, `active`, `admin`, `manager`, `submiter`, `tester`, `email`, `telefon`, `inserted`, `date`, `queue`) VALUES
(1, 'tonda', 'tonda', NULL, 1, 1, 1, 1, 1, 'antoninecer@gmail.com', '733674242', 'tonda', '2019-04-26 21:30:00', 1),
(2, 'libor', 'libor', 'libor', 1, 1, 1, 1, 1, '', '', 'tonda', '2019-04-26 21:48:04', 2),
(4, 'tester', 'tester', 'tester', 1, 0, 0, 0, 1, '', '', 'tonda', '2019-04-28 20:46:03', 3),
(5, 'submiter', 'submiter', 'submiter', 1, 0, 0, 1, 0, '', '', 'tonda', '2019-04-28 20:46:35', 1),
(6, 'manager', 'manager', 'manager', 1, 0, 1, 0, 0, '', '', 'tonda', '2019-04-28 20:47:07', 1),
(7, 'JKemr', '850527', '', 1, 1, 1, 1, 1, 'jakub.kemr@seznam.cz', '', 'tonda', '2019-05-06 09:26:26', 1),
(8, 'verka', 'verka', 'verka', 1, 0, 1, 0, 0, '', '', 'tonda', '2019-05-07 12:03:09', 3),
(9, 'tester1', 'tester1', 'tester1', 1, 0, 0, 0, 1, '', '', 'tonda', '2019-05-10 09:54:06', 3),
(10, 'aas', 'bbb', '', 1, 0, 0, 0, 0, '', '', 'tonda', '2019-06-12 08:44:56', NULL);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `pause`
--
ALTER TABLE `pause`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `queue`
--
ALTER TABLE `queue`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `task`
--
ALTER TABLE `task`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `tasktypes`
--
ALTER TABLE `tasktypes`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `pause`
--
ALTER TABLE `pause`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `queue`
--
ALTER TABLE `queue`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pro tabulku `task`
--
ALTER TABLE `task`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pro tabulku `tasktypes`
--
ALTER TABLE `tasktypes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
