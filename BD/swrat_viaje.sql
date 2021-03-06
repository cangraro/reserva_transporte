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
-- Table structure for table `viaje`
--

DROP TABLE IF EXISTS `viaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viaje` (
  `id_viaje` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(45) NOT NULL,
  `id_ruta` int(11) NOT NULL,
  `id_estado_viaje` int(11) NOT NULL,
  `horario` datetime NOT NULL,
  PRIMARY KEY (`id_viaje`),
  KEY `placa_idx` (`placa`),
  KEY `id_estado_idx` (`id_estado_viaje`),
  KEY `id_ruta_idx` (`id_ruta`),
  CONSTRAINT `id_estado_viaje` FOREIGN KEY (`id_estado_viaje`) REFERENCES `estado_viaje` (`id_estado_viaje`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `placa` FOREIGN KEY (`placa`) REFERENCES `vehiculo` (`placa`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ruta` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viaje`
--

LOCK TABLES `viaje` WRITE;
/*!40000 ALTER TABLE `viaje` DISABLE KEYS */;
INSERT INTO `viaje` VALUES (20,'EKJ45D',1,1,'2015-11-08 08:00:00'),(21,'EKJ45D',2,1,'2015-11-08 09:00:00'),(22,'EKJ45D',12,1,'2015-11-08 10:00:00'),(23,'EKJ45D',1,1,'2015-11-08 11:00:00'),(24,'EKJ45D',2,1,'2015-11-08 12:00:00'),(25,'EKJ45D',12,1,'2015-11-08 13:00:00'),(26,'EKJ45D',1,1,'2015-11-09 08:00:00'),(27,'EKJ45D',2,1,'2015-11-09 09:00:00'),(28,'EKJ45D',12,1,'2015-11-09 10:00:00'),(29,'EKJ45D',1,1,'2015-11-09 11:00:00'),(30,'EKJ45D',2,1,'2015-11-09 12:00:00'),(31,'EKJ45D',12,1,'2015-11-09 13:00:00'),(32,'EKJ45D',1,1,'2015-11-09 08:00:00'),(33,'EKJ45D',2,1,'2015-11-09 09:00:00'),(34,'EKJ45D',12,1,'2015-11-09 10:00:00'),(35,'EKJ45D',1,1,'2015-11-09 11:00:00'),(36,'EKJ45D',2,1,'2015-11-09 12:00:00'),(37,'EKJ45D',12,1,'2015-11-09 13:00:00'),(38,'EKJ45D',1,1,'2015-11-10 08:00:00'),(39,'EKJ45D',2,1,'2015-11-10 09:00:00'),(40,'EKJ45D',12,1,'2015-11-10 10:00:00'),(41,'EKJ45D',1,1,'2015-11-10 11:00:00'),(42,'EKJ45D',2,1,'2015-11-10 12:00:00'),(43,'EKJ45D',12,1,'2015-11-10 13:00:00'),(44,'EKJ45D',1,1,'2015-11-11 08:00:00'),(45,'EKJ45D',2,1,'2015-11-11 09:00:00'),(46,'EKJ45D',12,1,'2015-11-11 10:00:00'),(47,'EKJ45D',1,1,'2015-11-11 11:00:00'),(48,'EKJ45D',2,1,'2015-11-11 12:00:00'),(49,'EKJ45D',12,1,'2015-11-11 13:00:00'),(50,'EKJ45D',1,1,'2015-11-12 08:00:00'),(51,'EKJ45D',2,1,'2015-11-12 09:00:00'),(52,'EKJ45D',12,1,'2015-11-12 10:00:00'),(53,'EKJ45D',1,1,'2015-11-12 11:00:00'),(54,'EKJ45D',2,1,'2015-11-12 12:00:00'),(55,'EKJ45D',12,1,'2015-11-12 13:00:00'),(56,'EKJ45D',1,1,'2015-11-13 08:00:00'),(57,'EKJ45D',2,1,'2015-11-13 09:00:00'),(58,'EKJ45D',12,1,'2015-11-13 10:00:00'),(59,'EKJ45D',1,1,'2015-11-13 11:00:00'),(60,'EKJ45D',2,1,'2015-11-13 12:00:00'),(61,'EKJ45D',12,1,'2015-11-13 13:00:00'),(62,'EKJ45D',1,1,'2015-11-14 08:00:00'),(63,'EKJ45D',2,1,'2015-11-14 09:00:00'),(64,'EKJ45D',12,1,'2015-11-14 10:00:00'),(65,'EKJ45D',1,1,'2015-11-14 11:00:00'),(66,'EKJ45D',2,1,'2015-11-14 12:00:00'),(67,'EKJ45D',12,1,'2015-11-14 13:00:00'),(68,'EKJ45D',1,1,'2015-11-15 08:00:00'),(69,'EKJ45D',2,1,'2015-11-15 09:00:00'),(70,'EKJ45D',12,1,'2015-11-15 10:00:00'),(71,'EKJ45D',1,1,'2015-11-15 11:00:00'),(72,'EKJ45D',2,1,'2015-11-15 12:00:00'),(73,'EKJ45D',12,1,'2015-11-15 13:00:00'),(74,'EKJ45D',1,1,'2015-11-16 08:00:00'),(75,'EKJ45D',2,1,'2015-11-16 09:00:00'),(76,'EKJ45D',12,1,'2015-11-16 10:00:00'),(77,'EKJ45D',1,1,'2015-11-16 11:00:00'),(78,'EKJ45D',2,1,'2015-11-16 12:00:00'),(79,'EKJ45D',12,1,'2015-11-16 13:00:00'),(80,'EKJ45D',1,1,'2015-11-17 08:00:00'),(81,'EKJ45D',2,1,'2015-11-17 09:00:00'),(82,'EKJ45D',12,1,'2015-11-17 10:00:00'),(83,'EKJ45D',1,1,'2015-11-17 11:00:00'),(84,'EKJ45D',2,1,'2015-11-17 12:00:00'),(85,'EKJ45D',12,1,'2015-11-17 13:00:00'),(86,'EKJ45D',1,1,'2015-11-18 08:00:00'),(87,'EKJ45D',2,1,'2015-11-18 09:00:00'),(88,'EKJ45D',12,1,'2015-11-18 10:00:00'),(89,'EKJ45D',1,1,'2015-11-18 11:00:00'),(90,'EKJ45D',2,1,'2015-11-18 12:00:00'),(91,'EKJ45D',12,1,'2015-11-18 13:00:00'),(92,'EKJ45D',1,1,'2015-11-19 08:00:00'),(93,'EKJ45D',2,1,'2015-11-19 09:00:00'),(94,'EKJ45D',12,1,'2015-11-19 10:00:00'),(95,'EKJ45D',1,1,'2015-11-19 11:00:00'),(96,'EKJ45D',2,1,'2015-11-19 12:00:00'),(97,'EKJ45D',12,1,'2015-11-19 13:00:00'),(98,'EKJ45D',1,1,'2015-11-20 08:00:00'),(99,'EKJ45D',2,1,'2015-11-20 09:00:00'),(100,'EKJ45D',12,1,'2015-11-20 10:00:00'),(101,'EKJ45D',1,1,'2015-11-20 11:00:00'),(102,'EKJ45D',2,1,'2015-11-20 12:00:00'),(103,'EKJ45D',12,1,'2015-11-20 13:00:00'),(104,'EKJ45D',1,1,'2015-11-21 08:00:00'),(105,'EKJ45D',2,1,'2015-11-21 09:00:00'),(106,'EKJ45D',12,1,'2015-11-21 10:00:00'),(107,'EKJ45D',1,1,'2015-11-21 11:00:00'),(108,'EKJ45D',2,1,'2015-11-21 12:00:00'),(109,'EKJ45D',12,1,'2015-11-21 13:00:00');
/*!40000 ALTER TABLE `viaje` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-24 19:18:23
