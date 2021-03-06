CREATE DATABASE  IF NOT EXISTS `swrat` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `swrat`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: swrat
-- ------------------------------------------------------
-- Server version	5.6.21

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned DEFAULT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','administrator','$2y$08$MzPLQcb9Zvihn6lFbCPsB.VUcbaqvD9IoEXOD8Z1EhIHW/o/V1O0K','','administrator@gmail.com','',NULL,NULL,NULL,1268889823,1447132647,1,'Admin','istrator','ADMIN','0','Administrator'),(28,'::1','1044503052','$2y$08$oK26OXZVfuL0rt4w6uAOVun40u10dBMpTi1kwLSihlbi82BYQcg7a',NULL,'cagr215@gmail.com',NULL,NULL,NULL,NULL,1447030596,1508108595,1,NULL,NULL,NULL,NULL,'Carlos Andres Granda Rojas'),(29,'::1','123456789','$2y$08$s4ma6y4iHH2JoC04mekJD.zy0hCFdGJJxxqhEJFNDJmshPmuPjcii',NULL,'nalber.taborda@gmail.com',NULL,NULL,NULL,NULL,1447030679,1447132722,1,NULL,NULL,NULL,NULL,'Nalber Taborda'),(30,'::1','1111111111','$2y$08$KGvKRCd2Vq3q/WMYqL1qpOzh0esa8WyLDphYL/49RrRd9OfXnX4Vy',NULL,'cagr215@gmail.com',NULL,NULL,NULL,NULL,1447030966,1447031202,1,NULL,NULL,NULL,NULL,'Estudiante 1'),(31,'::1','2147483647','$2y$08$xfg72IMjzNqZSSqYKGtNle/jcWm4E29Szg7UWgrYOaYnAgDi67QXC',NULL,'cagr215@gmail.com',NULL,NULL,NULL,NULL,1447030966,1447132547,1,NULL,NULL,NULL,NULL,'Estudiante 2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-24 19:18:21
