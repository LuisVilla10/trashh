-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tisupport
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id` varchar(80) NOT NULL,
  `causa` varchar(50) DEFAULT NULL,
  `solucion` varchar(50) DEFAULT NULL,
  `tiempoConsumido` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES ('bitac-614b8a86be117','Codigo estaba incorrecto','Corregir el codigo',5),('bitac-626ee5807048d','hamster en cables','destruir cables',2),('bitac-6294c5ccd46cf','Hamster en cables','Atrapar hamster',2),('bitac-629c20280a2d2','kjkk','ljlkj',8),('bitac-629d69ed3faf9','bitacora de prueba','una solucion',10),('bitac-629d6b390279e','hjgjg','jkjhkj',2),('bitac-629d6f4d5ffe7','hiiii','hiiiii',2);
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `updateBitacora` BEFORE UPDATE ON `bitacora` FOR EACH ROW BEGIN
	update  tieneBitacora set id_bitacora = new.id where id_bitacora = old.id;
        update escribeBitacora set id=new.id where id = old.id;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `deleteBitacora` BEFORE DELETE ON `bitacora` FOR EACH ROW BEGIN
	delete from tieneBitacora where id_bitacora = old.id;
        delete from escribeBitacora where id = old.id;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES ('cliente Machu','cliente1@gmail.com','1234','rfc1234'),('cliente2','cliente2@gmail.com','1234','rfc567'),('cliente3','cliente3@gmail.com','1234','rfc8910'),('cliente45','cliente4@gmail.com','1234','rfc101112'),('cliente5','cliente5@gmail.com','1234','rfc131415'),('cliente6','cliente6@gmail.com','1234','rfc161718'),('dkjadhas','rawrcesar15@gmail.com','12345678','');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `updateCliente` BEFORE UPDATE ON `cliente` FOR EACH ROW BEGIN
	update  contrata set correo= new.correo where correo= old.correo;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `deleteCliente` BEFORE DELETE ON `cliente` FOR EACH ROW BEGIN
	delete from contrata where correo = old.correo;

    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `contrata`
--

DROP TABLE IF EXISTS `contrata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrata` (
  `correo` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL,
  PRIMARY KEY (`correo`,`id`),
  KEY `id` (`id`),
  CONSTRAINT `contrata_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `cliente` (`correo`),
  CONSTRAINT `contrata_ibfk_2` FOREIGN KEY (`id`) REFERENCES `proyecto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrata`
--

LOCK TABLES `contrata` WRITE;
/*!40000 ALTER TABLE `contrata` DISABLE KEYS */;
INSERT INTO `contrata` VALUES ('cliente4@gmail.com','proy-2342tggssbafsd5'),('cliente6@gmail.com','proy-614b6212c4eda'),('cliente3@gmail.com','proy-615613e4053b3'),('cliente4@gmail.com','proy-629a7680c6d1a'),('cliente2@gmail.com','proy-629b7a71324cb'),('cliente1@gmail.com','proy-629b859f42435'),('cliente1@gmail.com','proy-629b872dca405'),('cliente1@gmail.com','proy-629b8c6800612'),('cliente1@gmail.com','proy-629b8c794e428'),('cliente1@gmail.com','proy-629b8ca48eda8'),('cliente2@gmail.com','proy-65768asdfgafsd5'),('cliente2@gmail.com','proy-a16843213468'),('cliente3@gmail.com','proy-asdfasfd546');
/*!40000 ALTER TABLE `contrata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuenta`
--

DROP TABLE IF EXISTS `cuenta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta` (
  `correo` varchar(100) DEFAULT NULL,
  `pass` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta`
--

LOCK TABLES `cuenta` WRITE;
/*!40000 ALTER TABLE `cuenta` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuenta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `esDirector` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (8,'admin','rawrcesar13@gmail.com','12345678',1),(9,'empleado12','empleado1@gmail.com','1234',0),(10,'empleado2','empleado2@gmail.com','1234',0),(12,'empleado3','empleado3@gmail.com','1234',0),(13,'empleado4','empleado4@gmail.com','1234',0),(15,'empleado55','empleado5@gmail.com','1234',0),(16,'empleado6','empleado6@gmail.com','1234',0),(24,'prueba','prueba@prueba.com','12345678',0),(26,'Luis Villa','armanvilla117@gmail.com','12345678',0);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `updateEmpleado` BEFORE UPDATE ON `empleado` FOR EACH ROW BEGIN
	update  tieneAsignado set correo = new.correo where correo= old.correo;
        update escribeNota set correo=new.correo where correo = old.correo;
	update escribeBitacora set correo=new.correo where correo = old.correo;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `deleteEmpleado` BEFORE DELETE ON `empleado` FOR EACH ROW BEGIN
	delete from tieneasignado where correo = old.correo;
        delete from escribeNota where correo = old.correo;
	delete from escribeBitacora where correo = old.correo;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `escribebitacora`
--

DROP TABLE IF EXISTS `escribebitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escribebitacora` (
  `correo` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL,
  PRIMARY KEY (`correo`,`id`),
  KEY `id` (`id`),
  CONSTRAINT `escribebitacora_ibfk_1` FOREIGN KEY (`id`) REFERENCES `bitacora` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escribebitacora`
--

LOCK TABLES `escribebitacora` WRITE;
/*!40000 ALTER TABLE `escribebitacora` DISABLE KEYS */;
INSERT INTO `escribebitacora` VALUES ('rawrcesar13@gmail.com','bitac-629c20280a2d2'),('rawrcesar13@gmail.com','bitac-629d69ed3faf9'),('rawrcesar13@gmail.com','bitac-629d6b390279e'),('rawrcesar13@gmail.com','bitac-629d6f4d5ffe7');
/*!40000 ALTER TABLE `escribebitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `escribenota`
--

DROP TABLE IF EXISTS `escribenota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `escribenota` (
  `correo` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL,
  PRIMARY KEY (`correo`,`id`),
  KEY `id` (`id`),
  CONSTRAINT `escribenota_ibfk_1` FOREIGN KEY (`id`) REFERENCES `nota` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escribenota`
--

LOCK TABLES `escribenota` WRITE;
/*!40000 ALTER TABLE `escribenota` DISABLE KEYS */;
INSERT INTO `escribenota` VALUES ('rawrcesar13@gmail.com','nota-629c0902a204a');
/*!40000 ALTER TABLE `escribenota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fallo`
--

DROP TABLE IF EXISTS `fallo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fallo` (
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `id` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fallo`
--

LOCK TABLES `fallo` WRITE;
/*!40000 ALTER TABLE `fallo` DISABLE KEYS */;
INSERT INTO `fallo` VALUES ('value','value','fallo-615004c569a90','reparado'),('sfsasdaf ','2021-08-30','fallo-615094b0bfa86','reparado'),('Prueba final ','2021-09-15','fallo-615204dc0867e','notificado'),('asdfasdf','2021-08-30','fallo-615205982c942','notificado'),('asdfasdf','2021-08-30','fallo-615205d61b417','notificado'),('asdfasdf','2021-08-30','fallo-615205e4a6da9','notificado'),('Estaba abriendo el trabado','2021-09-16','fallo-6152506a164c3','notificado'),('value','value','fallo-6152532b05ed0','notificado'),('value','value','fallo-6152533585d35','notificado'),('value','value','fallo-6152537cbdd35','notificado'),('value','value','fallo-615261589f365','reparado'),('value','value','fallo-615261771b889','notificado'),('JcskvoOh','2021-10-01','fallo-61579856a7004','notificado'),('Entre a admin pero cargo como cliente','2021-09-17','fallo-61579ddf14120','notificado'),('122222','2021-09-29','fallo-6157bf59e93dc','notificado'),('zfasfdsa ','2021-09-29','fallo-6157bfb76d820','reparado'),('zfasfdsa ','2021-09-29','fallo-6157bff765ddb','notificado'),('value','value','fallo-6157c05643fb0','notificado'),('value','value','fallo-6157c07c2ef38','notificado'),('value','value','fallo-6157c08b0545c','notificado'),('value','value','fallo-6157c0964fef8','notificado'),('zfasfdsa ','2021-09-29','fallo-6157c09dd1bdc','notificado'),('asdfa q2341 1','2021-09-28','fallo-6157c0c09168e','notificado'),('asdf ','2021-09-27','fallo-6157c2a267344','notificado'),('dfghd','2021-09-27','fallo-6157c2b0e64c3','notificado'),('asf a','2021-09-28','fallo-6157c31ac7d0d','notificado'),('1231231 ','2021-09-27','fallo-6157c50adbd93','reparado'),('qweqwer','2021-09-27','fallo-6157c514c918a','notificado'),('asdgfa wgsdgsdg','2021-09-27','fallo-6157c53207373','notificado'),('qwrq 12313','2021-09-14','fallo-6157c6807e5db','notificado'),('dfgasf a','2021-09-27','fallo-6157c6c5bce88','notificado'),('Probando interfaz','2021-10-01','fallo-6157c6f9e09d2','notificado'),('value','value','fallo-6157cc07bb860','notificado'),('value','value','fallo-6157cccbb63c3','notificado'),('No funciona, mal servicio','2022-05-30','fallo-6294c7adec94b','notificado'),('descripcion proyecto proy','2022-06-03','fallo-629bd6b12d5d6','notificado'),('kgkhgkkhgkhhk','2022-06-04','fallo-629bd86fc00dd','notificado'),('jjjj','2022-06-03','fallo-629bde87d1a61','notificado'),('hgg','2022-06-04','fallo-629be25695aeb','notificado'),('asd','2022-06-04','fallo-629be7bf3ee0a','notificado');
/*!40000 ALTER TABLE `fallo` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `updateFallo` BEFORE UPDATE ON `fallo` FOR EACH ROW BEGIN
	update  tieneFallo set id_fallo = new.id where id_fallo= old.id;
        update tieneAsignado set id=new.id where id = old.id;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `deleteFallo` BEFORE DELETE ON `fallo` FOR EACH ROW BEGIN
	delete from tieneFallo where id_fallo = old.id;
        delete from tieneAsignado where id = old.id;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `nota`
--

DROP TABLE IF EXISTS `nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nota` (
  `contenido` varchar(500) DEFAULT NULL,
  `fecha` varchar(50) DEFAULT NULL,
  `id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nota`
--

LOCK TABLES `nota` WRITE;
/*!40000 ALTER TABLE `nota` DISABLE KEYS */;
INSERT INTO `nota` VALUES ('Contenido de la nota','21-10-2021','nota-61561afd098b1'),('nota','01-05-2022','nota-626ee548dce07'),('esta es una nota','21-05-2022','nota-62896bcd31be8'),('Sigue sin servir, pesimo servicio','30-05-2022','nota-6294ca81e9688'),('nota','04-06-2022','nota-629c0902a204a');
/*!40000 ALTER TABLE `nota` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `updateNota` BEFORE UPDATE ON `nota` FOR EACH ROW BEGIN
	update  tieneNota set id_nota = new.id where id_nota= old.id;
        update escribeNota set id=new.id where id = old.id;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `deleteNota` BEFORE DELETE ON `nota` FOR EACH ROW BEGIN
	delete from tieneNota where id_nota = old.id;
        delete from escribeNota where id = old.id;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyecto` (
  `nombre` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `id` varchar(50) NOT NULL,
  `fechaDeContratacion` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto`
--

LOCK TABLES `proyecto` WRITE;
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` VALUES ('kjlk','en desarrollo','proy-2342tggssbafsd5','01/09/2021'),('proyecto x','en desarrollo','proy-614b6212c4eda','05/06/2000'),('Prueba','en diseño','proy-615613e4053b3','21/02/2069'),('Cliente bb','en diseño','proy-629a7680c6d1a','2020-08-31'),('proy','en diseño','proy-629b7a71324cb','2020-08-29'),('proy2','en diseño','proy-629b859f42435','2020-08-29'),('proy3','en diseño','proy-629b872dca405','2020-08-29'),('asdasdasdasdd','en diseño','proy-629b8c6800612','2020-08-29'),('adadas','en diseño','proy-629b8c794e428','2020-08-29'),('12333333345','en diseño','proy-629b8ca48eda8','2020-08-29'),('proyecto d','en diseño','proy-65768asdfgafsd5','20/09/2021'),('proyecto c','implementado','proy-a16843213468','20/09/2021'),('proyecto b','en pruebas','proy-asdfasfd546','20/09/2021');
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `updateProyecto` BEFORE UPDATE ON `proyecto` FOR EACH ROW BEGIN
	update  contrata set id= new.id where id= old.id;
        update tieneFallo set id_proyecto=new.id where id_proyecto = old.id;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `deleteProyecto` BEFORE DELETE ON `proyecto` FOR EACH ROW BEGIN
		delete from tieneFallo where id_proyecto = old.id;
        delete from contrata where id = old.id;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tieneasignado`
--

DROP TABLE IF EXISTS `tieneasignado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tieneasignado` (
  `correo` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL,
  PRIMARY KEY (`correo`,`id`),
  KEY `id` (`id`),
  CONSTRAINT `tieneasignado_ibfk_1` FOREIGN KEY (`id`) REFERENCES `fallo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tieneasignado`
--

LOCK TABLES `tieneasignado` WRITE;
/*!40000 ALTER TABLE `tieneasignado` DISABLE KEYS */;
INSERT INTO `tieneasignado` VALUES ('rawrcesar13@gmail.com','fallo-615004c569a90'),('rawrcesar13@gmail.com','fallo-615094b0bfa86'),('empleado6@gmail.com','fallo-6152537cbdd35'),('empleado6@gmail.com','fallo-615261589f365'),('empleado6@gmail.com','fallo-615261771b889'),('rawrcesar13@gmail.com','fallo-6157bfb76d820'),('rawrcesar13@gmail.com','fallo-6157c50adbd93');
/*!40000 ALTER TABLE `tieneasignado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tienebitacora`
--

DROP TABLE IF EXISTS `tienebitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tienebitacora` (
  `id_bitacora` varchar(100) NOT NULL,
  `id_fallo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bitacora`,`id_fallo`),
  KEY `id_fallo` (`id_fallo`),
  CONSTRAINT `tienebitacora_ibfk_1` FOREIGN KEY (`id_bitacora`) REFERENCES `bitacora` (`id`),
  CONSTRAINT `tienebitacora_ibfk_2` FOREIGN KEY (`id_fallo`) REFERENCES `fallo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tienebitacora`
--

LOCK TABLES `tienebitacora` WRITE;
/*!40000 ALTER TABLE `tienebitacora` DISABLE KEYS */;
INSERT INTO `tienebitacora` VALUES ('bitac-626ee5807048d','fallo-615004c569a90'),('bitac-629d6b390279e','fallo-615004c569a90'),('bitac-629c20280a2d2','fallo-615094b0bfa86'),('bitac-6294c5ccd46cf','fallo-615261589f365'),('bitac-629d69ed3faf9','fallo-6157bfb76d820'),('bitac-629d6f4d5ffe7','fallo-6157c50adbd93');
/*!40000 ALTER TABLE `tienebitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tienefallo`
--

DROP TABLE IF EXISTS `tienefallo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tienefallo` (
  `id_proyecto` varchar(100) NOT NULL,
  `id_fallo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_proyecto`,`id_fallo`),
  KEY `id_fallo` (`id_fallo`),
  CONSTRAINT `tienefallo_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`),
  CONSTRAINT `tienefallo_ibfk_2` FOREIGN KEY (`id_fallo`) REFERENCES `fallo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tienefallo`
--

LOCK TABLES `tienefallo` WRITE;
/*!40000 ALTER TABLE `tienefallo` DISABLE KEYS */;
INSERT INTO `tienefallo` VALUES ('proy-614b6212c4eda','fallo-615004c569a90'),('proy-614b6212c4eda','fallo-615094b0bfa86'),('proy-614b6212c4eda','fallo-615204dc0867e'),('proy-614b6212c4eda','fallo-615205982c942'),('proy-614b6212c4eda','fallo-615205d61b417'),('proy-614b6212c4eda','fallo-615205e4a6da9'),('proy-614b6212c4eda','fallo-6152506a164c3'),('proy-614b6212c4eda','fallo-6152532b05ed0'),('proy-614b6212c4eda','fallo-6152533585d35'),('proy-614b6212c4eda','fallo-6152537cbdd35'),('proy-614b6212c4eda','fallo-615261589f365'),('proy-65768asdfgafsd5','fallo-615261589f365'),('proy-614b6212c4eda','fallo-615261771b889'),('proy-a16843213468','fallo-615261771b889'),('proy-614b6212c4eda','fallo-61579856a7004'),('proy-614b6212c4eda','fallo-61579ddf14120'),('proy-614b6212c4eda','fallo-6157bf59e93dc'),('proy-614b6212c4eda','fallo-6157bfb76d820'),('proy-614b6212c4eda','fallo-6157bff765ddb'),('proy-asdfasfd546','fallo-6157c05643fb0'),('proy-asdfasfd546','fallo-6157c07c2ef38'),('proy-asdfasfd546','fallo-6157c08b0545c'),('proy-asdfasfd546','fallo-6157c0964fef8'),('proy-614b6212c4eda','fallo-6157c09dd1bdc'),('proy-614b6212c4eda','fallo-6157c0c09168e'),('proy-614b6212c4eda','fallo-6157c2a267344'),('proy-614b6212c4eda','fallo-6157c2b0e64c3'),('proy-614b6212c4eda','fallo-6157c31ac7d0d'),('proy-614b6212c4eda','fallo-6157c50adbd93'),('proy-614b6212c4eda','fallo-6157c514c918a'),('proy-614b6212c4eda','fallo-6157c53207373'),('proy-614b6212c4eda','fallo-6157c6807e5db'),('proy-614b6212c4eda','fallo-6157c6c5bce88'),('proy-614b6212c4eda','fallo-6157c6f9e09d2'),('proy-asdfasfd546','fallo-6157cc07bb860'),('proy-asdfasfd546','fallo-6157cccbb63c3'),('proy-65768asdfgafsd5','fallo-6294c7adec94b'),('proy-629b7a71324cb','fallo-629bd6b12d5d6'),('proy-629b7a71324cb','fallo-629bd86fc00dd'),('proy-629b7a71324cb','fallo-629bde87d1a61'),('proy-65768asdfgafsd5','fallo-629be25695aeb'),('proy-65768asdfgafsd5','fallo-629be7bf3ee0a');
/*!40000 ALTER TABLE `tienefallo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tienenota`
--

DROP TABLE IF EXISTS `tienenota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tienenota` (
  `id_nota` varchar(100) NOT NULL,
  `id_fallo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_nota`,`id_fallo`),
  KEY `id_fallo` (`id_fallo`),
  CONSTRAINT `tienenota_ibfk_1` FOREIGN KEY (`id_nota`) REFERENCES `nota` (`id`),
  CONSTRAINT `tienenota_ibfk_2` FOREIGN KEY (`id_fallo`) REFERENCES `fallo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tienenota`
--

LOCK TABLES `tienenota` WRITE;
/*!40000 ALTER TABLE `tienenota` DISABLE KEYS */;
INSERT INTO `tienenota` VALUES ('nota-61561afd098b1','fallo-615004c569a90'),('nota-626ee548dce07','fallo-615004c569a90'),('nota-629c0902a204a','fallo-615004c569a90'),('nota-62896bcd31be8','fallo-615094b0bfa86'),('nota-6294ca81e9688','fallo-615094b0bfa86');
/*!40000 ALTER TABLE `tienenota` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-06 10:36:58
