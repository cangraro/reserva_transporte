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
-- Table structure for table `jos_noticias`
--

DROP TABLE IF EXISTS `jos_noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jos_noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `contenido` text NOT NULL,
  `autor` varchar(45) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `publicado` int(11) NOT NULL DEFAULT '0',
  `fecha_publicacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `autor_modifica` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jos_noticias`
--

LOCK TABLES `jos_noticias` WRITE;
/*!40000 ALTER TABLE `jos_noticias` DISABLE KEYS */;
INSERT INTO `jos_noticias` VALUES (14,'Asignacion de transporte','    <p>El Sistema de Administración para la Gestión de reserva de transporte - SWRAT - es la herramienta por medio de la cual los usuario pueden registrar y controlan el proceso de asignación de transporte a las diferentes sedes  en la Universidad, a su vez, genera un medio efectivo que sin duda contribuye en materia de mejoramiento a los proceso de movilidad para la comunidad universitaria.</p>                                        ','administrator','2015-05-07 14:40:23',1,'2015-05-07 14:40:23','2015-05-20 11:04:21','administrator'),(15,'Servicios','<p>Este servicio pretende responder a la demanda de los usuarios cuando requieren hacer uso del servicio de transporte articulado a la institución, mejorando aspectos tales como:\r\nServicios:\r\nAsignación personalizada de trasporte Público Universitario. \r\nPermite conocer la cantidad de vehículos vinculados a la universidad.\r\nDisponibilidad de puestos por vehículo.\r\nConsulta de rutas, horarios y puntos de partida.\r\nUn mayor nivel de seguridad para estudiantes que cuentan con horarios nocturnos y requieren del uso de este medio de transporte.</p>','administrator','2015-05-07 14:40:23',1,'2015-05-07 14:40:23','2015-05-07 14:40:23','administrator');
/*!40000 ALTER TABLE `jos_noticias` ENABLE KEYS */;
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
