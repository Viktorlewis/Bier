-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 21 jan 2020 om 17:17
-- Serverversie: 10.4.10-MariaDB
-- PHP-versie: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `achievements`
--

CREATE TABLE `achievements` (
  `AchievementID` int(11) NOT NULL,
  `Naam` varchar(64) NOT NULL,
  `Beschrijving` mediumtext NOT NULL,
  `BadgeLink` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bieren`
--

CREATE TABLE `bieren` (
  `BierID` int(11) NOT NULL,
  `AlcoholPerc` double NOT NULL,
  `PrijsGem` double NOT NULL,
  `AantalReviews` int(11) NOT NULL DEFAULT 0,
  `Score` double NOT NULL DEFAULT -1,
  `biernaam` varchar(255) DEFAULT NULL,
  `reviewtekst` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `bieren`
--

INSERT INTO `bieren` (`BierID`, `AlcoholPerc`, `PrijsGem`, `AantalReviews`, `Score`, `biernaam`, `reviewtekst`) VALUES
(1, 7, 3.3, 0, 45, 'Duvel', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(4, 8, 1.8, 3, 22, 'Karmeliet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(5, 4.2, 4.4, 3, 85, 'Westmalle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(6, 3.1, 3.7, 3, 35, 'Stella', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(7, 7.7, 3.7, 3, 100, 'Orval', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(8, 3.6, 4.3, 3, 43, 'Jupiler', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(9, 4.7, 5.3, 3, 42, 'Guiness', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bierreviews`
--

CREATE TABLE `bierreviews` (
  `ReviewID` int(11) NOT NULL,
  `BierID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Titel` varchar(48) NOT NULL,
  `Inhoud` mediumtext NOT NULL,
  `AlcoholPercentge` float NOT NULL,
  `CafeID` int(11) NOT NULL,
  `Gebruikers_GebruikerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cafereviews`
--

CREATE TABLE `cafereviews` (
  `ReviewID` int(11) NOT NULL,
  `CafeID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Titel` varchar(48) NOT NULL,
  `Inhoud` mediumtext NOT NULL,
  `AlcoholPercentge` double NOT NULL,
  `Sanitair` double NOT NULL,
  `Wifi` tinyint(4) NOT NULL,
  `Gebruikers_GebruikerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cafes`
--

CREATE TABLE `cafes` (
  `CafeID` int(11) NOT NULL,
  `Locatie` varchar(255) NOT NULL,
  `AantalReviews` int(11) NOT NULL,
  `Score` int(11) DEFAULT NULL,
  `naam` varchar(40) DEFAULT NULL,
  `reviewtekst` varchar(600) DEFAULT NULL,
  `wifi` varchar(255) DEFAULT NULL,
  `sanitair` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `cafes`
--

INSERT INTO `cafes` (`CafeID`, `Locatie`, `AantalReviews`, `Score`, `naam`, `reviewtekst`, `wifi`, `sanitair`) VALUES
(1, 'Albertplein, 8300 Knokke-zoute', 3, 85, 'Piazza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Nee', 'Ja'),
(2, 'Place du Casino, 98000 Monaco', 3, 95, 'Cafe De Paris', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Ja', 'Ja');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cafesheeftbieren`
--

CREATE TABLE `cafesheeftbieren` (
  `Cafes_CafeID` int(11) NOT NULL,
  `Bieren_BierID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikersheeftachievements`
--

CREATE TABLE `gebruikersheeftachievements` (
  `Gebruikers_GebruikerID` int(11) NOT NULL,
  `Achievements_AchievementID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`, `email`) VALUES
(1, 'JonathanAZ', '$2y$10$pPWEMsQ1kwrigtprTzyIDunAdaXWoFYE16oRbyOyvfurcrTcWiF1C', 'jonathan.de.mangelaere@outlook.be');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`AchievementID`);

--
-- Indexen voor tabel `bieren`
--
ALTER TABLE `bieren`
  ADD PRIMARY KEY (`BierID`);

--
-- Indexen voor tabel `bierreviews`
--
ALTER TABLE `bierreviews`
  ADD PRIMARY KEY (`ReviewID`,`BierID`),
  ADD KEY `fk_BierReviews_Bieren1_idx` (`BierID`),
  ADD KEY `fk_BierReviews_Cafes1_idx` (`CafeID`),
  ADD KEY `fk_BierReviews_Gebruikers1_idx` (`Gebruikers_GebruikerID`);

--
-- Indexen voor tabel `cafereviews`
--
ALTER TABLE `cafereviews`
  ADD PRIMARY KEY (`ReviewID`,`CafeID`),
  ADD KEY `fk_CafeReviews_Cafes_idx` (`CafeID`),
  ADD KEY `fk_CafeReviews_Gebruikers1_idx` (`Gebruikers_GebruikerID`);

--
-- Indexen voor tabel `cafes`
--
ALTER TABLE `cafes`
  ADD PRIMARY KEY (`CafeID`);

--
-- Indexen voor tabel `cafesheeftbieren`
--
ALTER TABLE `cafesheeftbieren`
  ADD PRIMARY KEY (`Cafes_CafeID`,`Bieren_BierID`),
  ADD KEY `fk_Cafes_has_Bieren_Bieren1_idx` (`Bieren_BierID`),
  ADD KEY `fk_Cafes_has_Bieren_Cafes1_idx` (`Cafes_CafeID`);

--
-- Indexen voor tabel `gebruikersheeftachievements`
--
ALTER TABLE `gebruikersheeftachievements`
  ADD PRIMARY KEY (`Gebruikers_GebruikerID`,`Achievements_AchievementID`),
  ADD KEY `fk_Gebruikers_has_Achievements_Achievements1_idx` (`Achievements_AchievementID`),
  ADD KEY `fk_Gebruikers_has_Achievements_Gebruikers1_idx` (`Gebruikers_GebruikerID`);

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `achievements`
--
ALTER TABLE `achievements`
  MODIFY `AchievementID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `bieren`
--
ALTER TABLE `bieren`
  MODIFY `BierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `bierreviews`
--
ALTER TABLE `bierreviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `cafereviews`
--
ALTER TABLE `cafereviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `cafes`
--
ALTER TABLE `cafes`
  MODIFY `CafeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bierreviews`
--
ALTER TABLE `bierreviews`
  ADD CONSTRAINT `fk_BierReviews_Bieren1` FOREIGN KEY (`BierID`) REFERENCES `bieren` (`BierID`),
  ADD CONSTRAINT `fk_BierReviews_Cafes1` FOREIGN KEY (`CafeID`) REFERENCES `cafes` (`CafeID`),
  ADD CONSTRAINT `fk_BierReviews_Gebruikers1` FOREIGN KEY (`Gebruikers_GebruikerID`) REFERENCES `gebruikers` (`GebruikerID`);

--
-- Beperkingen voor tabel `cafereviews`
--
ALTER TABLE `cafereviews`
  ADD CONSTRAINT `fk_CafeReviews_Cafes` FOREIGN KEY (`CafeID`) REFERENCES `cafes` (`CafeID`),
  ADD CONSTRAINT `fk_CafeReviews_Gebruikers1` FOREIGN KEY (`Gebruikers_GebruikerID`) REFERENCES `gebruikers` (`GebruikerID`);

--
-- Beperkingen voor tabel `cafesheeftbieren`
--
ALTER TABLE `cafesheeftbieren`
  ADD CONSTRAINT `fk_Cafes_has_Bieren_Bieren1` FOREIGN KEY (`Bieren_BierID`) REFERENCES `bieren` (`BierID`),
  ADD CONSTRAINT `fk_Cafes_has_Bieren_Cafes1` FOREIGN KEY (`Cafes_CafeID`) REFERENCES `cafes` (`CafeID`);

--
-- Beperkingen voor tabel `gebruikersheeftachievements`
--
ALTER TABLE `gebruikersheeftachievements`
  ADD CONSTRAINT `fk_Gebruikers_has_Achievements_Achievements1` FOREIGN KEY (`Achievements_AchievementID`) REFERENCES `achievements` (`AchievementID`),
  ADD CONSTRAINT `fk_Gebruikers_has_Achievements_Gebruikers1` FOREIGN KEY (`Gebruikers_GebruikerID`) REFERENCES `gebruikers` (`GebruikerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
