-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: exercisedb
-- ------------------------------------------------------
-- Server version	5.5.57-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `EXERCISE_LOG`
--

DROP TABLE IF EXISTS `EXERCISE_LOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EXERCISE_LOG` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time_in_minutes` int(11) NOT NULL,
  `heartrate` int(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `EXERCISE_USER_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EXERCISE_LOG`
--

LOCK TABLES `EXERCISE_LOG` WRITE;
/*!40000 ALTER TABLE `EXERCISE_LOG` DISABLE KEYS */;
INSERT INTO `EXERCISE_LOG` VALUES (6,'2018-03-12',45,135,566,'Biking',1),(11,'2018-03-12',65,100,471,'Jogging',1),(14,'2018-03-12',95,110,964,'Jogging',2),(15,'2018-03-18',42,118,420,'Biking',1),(16,'2018-03-21',45,154,755,'Swimming',2),(18,'2018-03-21',45,95,0,'Walking',3),(19,'2018-03-21',56,102,589,'Jogging',3),(20,'2018-03-21',45,135,542,'Biking',1),(21,'2018-03-21',36,102,331,'Walking',8),(22,'2018-03-21',65,345,2678,'Biking',8);
/*!40000 ALTER TABLE `EXERCISE_LOG` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EXERCISE_USER`
--

DROP TABLE IF EXISTS `EXERCISE_USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EXERCISE_USER` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(90) DEFAULT NULL,
  `lastname` varchar(40) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL,
  `weight` double(4,1) NOT NULL,
  `age` varchar(30) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EXERCISE_USER`
--

LOCK TABLES `EXERCISE_USER` WRITE;
/*!40000 ALTER TABLE `EXERCISE_USER` DISABLE KEYS */;
INSERT INTO `EXERCISE_USER` VALUES (1,'lbusch','$2y$10$GjBgrugArqgMK451qQW/guME7QAe4iBldoZLc33pBsqHtCHD27icy','Busch','Luke','M',165.0,'38','1980-06-16'),(2,'thorton','$2y$10$dOCqiQxcpngpl2.SdyH2ROkNxoWz6ZLqoZ9P3Z89gTSKzqMsxnX4q','Horton','Tony','M',205.0,'48',NULL),(3,'rmcdonald','$2y$10$14lWamWJMNnnXmzqhnirfOA3v6xkD6hOlIdNmb4zKfl7YmPhMPjFO','McDonald','Ronald','M',215.0,'76',NULL),(7,'jdaniels3','$2y$10$fce/9iMGA2y315olNodKqOLwPxD8fQolsx6tCeXhGoCP7ce0ukjze','Daniels','Jack','M',225.0,'52',NULL),(8,'jbeam','$2y$10$nZ9K461T8PmDzr7UmostfeNoE7RKJdbWtzbXWj4FpisF1r.Zlpq9G','Beam','Jim','M',24.0,'134','1980-03-16');
/*!40000 ALTER TABLE `EXERCISE_USER` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-21 21:27:36
