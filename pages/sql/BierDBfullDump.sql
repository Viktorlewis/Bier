-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: bierdb
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `achievements` (
  `AchievementID` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(64) NOT NULL,
  `Beschrijving` mediumtext NOT NULL,
  `BadgeLink` varchar(64) NOT NULL,
  PRIMARY KEY (`AchievementID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievements`
--

LOCK TABLES `achievements` WRITE;
/*!40000 ALTER TABLE `achievements` DISABLE KEYS */;
/*!40000 ALTER TABLE `achievements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bieren`
--

DROP TABLE IF EXISTS `bieren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bieren` (
  `BierID` int(11) NOT NULL AUTO_INCREMENT,
  `AlcoholPerc` double unsigned zerofill NOT NULL,
  `PrijsGem` double NOT NULL,
  `AantalReviews` int(11) NOT NULL DEFAULT '0',
  `Score` double NOT NULL DEFAULT '-1',
  PRIMARY KEY (`BierID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bieren`
--

LOCK TABLES `bieren` WRITE;
/*!40000 ALTER TABLE `bieren` DISABLE KEYS */;
/*!40000 ALTER TABLE `bieren` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bierreviews`
--

DROP TABLE IF EXISTS `bierreviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `bierreviews` (
  `ReviewID` int(11) NOT NULL AUTO_INCREMENT,
  `BierID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Titel` varchar(48) NOT NULL,
  `Inhoud` mediumtext NOT NULL,
  `AlcoholPercentge` float NOT NULL,
  `CafeID` int(11) NOT NULL,
  `Gebruikers_GebruikerID` int(11) NOT NULL,
  PRIMARY KEY (`ReviewID`,`BierID`),
  KEY `fk_BierReviews_Bieren1_idx` (`BierID`),
  KEY `fk_BierReviews_Cafes1_idx` (`CafeID`),
  KEY `fk_BierReviews_Gebruikers1_idx` (`Gebruikers_GebruikerID`),
  CONSTRAINT `fk_BierReviews_Bieren1` FOREIGN KEY (`BierID`) REFERENCES `bieren` (`BierID`),
  CONSTRAINT `fk_BierReviews_Cafes1` FOREIGN KEY (`CafeID`) REFERENCES `cafes` (`CafeID`),
  CONSTRAINT `fk_BierReviews_Gebruikers1` FOREIGN KEY (`Gebruikers_GebruikerID`) REFERENCES `gebruikers` (`GebruikerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bierreviews`
--

LOCK TABLES `bierreviews` WRITE;
/*!40000 ALTER TABLE `bierreviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `bierreviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cafereviews`
--

DROP TABLE IF EXISTS `cafereviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cafereviews` (
  `ReviewID` int(11) NOT NULL AUTO_INCREMENT,
  `CafeID` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `Titel` varchar(48) NOT NULL,
  `Inhoud` mediumtext NOT NULL,
  `AlcoholPercentge` double NOT NULL,
  `Sanitair` double NOT NULL,
  `Wifi` tinyint(4) NOT NULL,
  `Gebruikers_GebruikerID` int(11) NOT NULL,
  PRIMARY KEY (`ReviewID`,`CafeID`),
  KEY `fk_CafeReviews_Cafes_idx` (`CafeID`),
  KEY `fk_CafeReviews_Gebruikers1_idx` (`Gebruikers_GebruikerID`),
  CONSTRAINT `fk_CafeReviews_Cafes` FOREIGN KEY (`CafeID`) REFERENCES `cafes` (`CafeID`),
  CONSTRAINT `fk_CafeReviews_Gebruikers1` FOREIGN KEY (`Gebruikers_GebruikerID`) REFERENCES `gebruikers` (`GebruikerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cafereviews`
--

LOCK TABLES `cafereviews` WRITE;
/*!40000 ALTER TABLE `cafereviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `cafereviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cafes`
--

DROP TABLE IF EXISTS `cafes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cafes` (
  `CafeID` int(11) NOT NULL AUTO_INCREMENT,
  `Locatie` float NOT NULL,
  `AantalReviews` int(11) NOT NULL,
  `Score` double DEFAULT NULL,
  PRIMARY KEY (`CafeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cafes`
--

LOCK TABLES `cafes` WRITE;
/*!40000 ALTER TABLE `cafes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cafes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cafesheeftbieren`
--

DROP TABLE IF EXISTS `cafesheeftbieren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cafesheeftbieren` (
  `Cafes_CafeID` int(11) NOT NULL,
  `Bieren_BierID` int(11) NOT NULL,
  PRIMARY KEY (`Cafes_CafeID`,`Bieren_BierID`),
  KEY `fk_Cafes_has_Bieren_Bieren1_idx` (`Bieren_BierID`),
  KEY `fk_Cafes_has_Bieren_Cafes1_idx` (`Cafes_CafeID`),
  CONSTRAINT `fk_Cafes_has_Bieren_Bieren1` FOREIGN KEY (`Bieren_BierID`) REFERENCES `bieren` (`BierID`),
  CONSTRAINT `fk_Cafes_has_Bieren_Cafes1` FOREIGN KEY (`Cafes_CafeID`) REFERENCES `cafes` (`CafeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cafesheeftbieren`
--

LOCK TABLES `cafesheeftbieren` WRITE;
/*!40000 ALTER TABLE `cafesheeftbieren` DISABLE KEYS */;
/*!40000 ALTER TABLE `cafesheeftbieren` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gebruikersheeftachievements`
--

DROP TABLE IF EXISTS `gebruikersheeftachievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gebruikersheeftachievements` (
  `Gebruikers_GebruikerID` int(11) NOT NULL,
  `Achievements_AchievementID` int(11) NOT NULL,
  PRIMARY KEY (`Gebruikers_GebruikerID`,`Achievements_AchievementID`),
  KEY `fk_Gebruikers_has_Achievements_Achievements1_idx` (`Achievements_AchievementID`),
  KEY `fk_Gebruikers_has_Achievements_Gebruikers1_idx` (`Gebruikers_GebruikerID`),
  CONSTRAINT `fk_Gebruikers_has_Achievements_Achievements1` FOREIGN KEY (`Achievements_AchievementID`) REFERENCES `achievements` (`AchievementID`),
  CONSTRAINT `fk_Gebruikers_has_Achievements_Gebruikers1` FOREIGN KEY (`Gebruikers_GebruikerID`) REFERENCES `gebruikers` (`GebruikerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gebruikersheeftachievements`
--

LOCK TABLES `gebruikersheeftachievements` WRITE;
/*!40000 ALTER TABLE `gebruikersheeftachievements` DISABLE KEYS */;
/*!40000 ALTER TABLE `gebruikersheeftachievements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-10 14:41:15
