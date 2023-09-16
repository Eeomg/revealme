-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: revealme
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `project` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `dateofcomment` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `comments_ibfk_3` (`project`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (293,'asdasd',110,7,'2023-09-16 12:22:07'),(294,'kjkjkjkjkk',110,7,'2023-09-16 12:28:39');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `user` int(11) NOT NULL,
  `friend` int(11) NOT NULL,
  `confirm` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user`,`friend`),
  KEY `friend` (`friend`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (7,11,1),(11,7,1);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `user` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `dateoflike` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user`,`project`),
  KEY `project` (`project`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (7,110,'2023-09-16 12:28:30');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_photo`
--

DROP TABLE IF EXISTS `project_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `project` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project` (`project`),
  CONSTRAINT `project_photo_ibfk_1` FOREIGN KEY (`project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_photo`
--

LOCK TABLES `project_photo` WRITE;
/*!40000 ALTER TABLE `project_photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateofpost` timestamp NOT NULL DEFAULT current_timestamp(),
  `disc` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (110,'2023-09-09 13:36:30','alskdam111sldml',11),(111,'2023-09-09 13:36:50','alskdamsldml222',11),(112,'2023-09-09 13:36:50','alskdamsldml3333',11),(113,'2023-09-09 13:36:50','alskdamsldml4444',11),(114,'2023-09-09 13:36:50','alskdamsldml5555',11),(115,'2023-09-09 13:36:50','alskdamsldml6666',11),(116,'2023-09-09 13:36:50','alskdamsldml7777',11),(117,'2023-09-09 13:36:50','alskdamsldml8888',11),(125,'2023-09-12 16:12:05','hjaj',7),(128,'2023-09-14 17:46:39','aennm',15);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social`
--

DROP TABLE IF EXISTS `social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social`
--

LOCK TABLES `social` WRITE;
/*!40000 ALTER TABLE `social` DISABLE KEYS */;
INSERT INTO `social` VALUES (1,'facebook','<i class=\"fab fa-facebook \"></i>'),(2,'instagram','<i class=\"fab fa-instagram \"></i>'),(3,'twitter','<i class=\"fab fa-twitter\"></i>'),(4,'linkedin','<i class=\"fab fa-linkedin\"></i>'),(5,'github','<i class=\"fab fa-github\"></i>'),(6,'youtube','                        <i class=\"fab fa-youtube\"></i>\r\n'),(7,'whatsapp','<i class=\"fab fa-whatsapp\"></i>'),(8,'email','<i class=\"fas fa-envelope\"></i>\r\n');
/*!40000 ALTER TABLE `social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlinks`
--

DROP TABLE IF EXISTS `userlinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `social_id` int(11) NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`,`user_id`,`social_id`),
  KEY `social_id` (`social_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `userlinks_ibfk_1` FOREIGN KEY (`social_id`) REFERENCES `social` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userlinks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlinks`
--

LOCK TABLES `userlinks` WRITE;
/*!40000 ALTER TABLE `userlinks` DISABLE KEYS */;
INSERT INTO `userlinks` VALUES (15,7,8,'mailto:wewooow@exaple.com?subject=osamagasser'),(16,7,7,'http://wa.me/201099634597'),(25,10,8,'mailto:wewooow2@yahoo.com?'),(26,10,7,'http://wa.me/01099634597'),(30,11,8,'mailto:osamagasser2002@gmail.com?'),(31,11,7,'http://wa.me/01099634597'),(32,12,8,'mailto:wewooow323@yahoo.com?'),(33,12,7,'http://wa.me/01099634597'),(38,14,8,'mailto:belalgasser@gmail.com?'),(39,14,7,'http://wa.me/01099634597'),(50,15,8,'mailto:ahmed@ahmed.com?'),(51,15,7,'http://wa.me/01151422701');
/*!40000 ALTER TABLE `userlinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `job` varchar(100) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'User.webp',
  `disc` text NOT NULL DEFAULT 'hello there',
  `educ` text NOT NULL DEFAULT 'educated',
  `datrofsign` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'osama','wewooow@yahoo.com','201099634597','$2y$10$Tu36KhCkquH5scm1suZoZeVyPBsK5sN3/xj6ct3eh74cgDhp6fdEm','back end engineer','57241472d133b77f430955d32fcecb21.webp','haklsdlklklklklklklkllklkl','okokokollklklkl','2023-09-01 19:51:28'),(10,'osama gasser','wewooow2@yahoo.com','01099634597','$2y$10$MHss8UySlh70zg0613DqgOhd76hq2FlBFh8Eg5GdrvPPVmwYnIvyW','back end engineer','User.webp','hello there','educated','2023-09-04 16:58:12'),(11,'medoss','osamagasser2002@gmail.com','01099634597','$2y$10$fkGDQGtTaDtDMyd3B6.hJuUZ/UR/AV0W.jHQMqgqXuV8J2lYp5Mk.','back end engineer','User.webp','hello there','educated','2023-09-04 23:41:08'),(12,'osama','wewooow323@yahoo.com','01099634597','$2y$10$5wg.vrbMN5CWyGmLUoV12.sVeSq1DCCW175HI0p1tB0EMCBMuyzqu','back end engineer','User.webp','hello there','educated','2023-09-08 22:03:29'),(14,'belalgasser','belalgasser@gmail.com','01099634597','$2y$10$Qh3ht4mGMKvwcBPdhyqyZOuUayujy0jM7eDFfla4ejVrSV1kXNho2','back end engineer','c9d29f8c2131a59a086838ec93db6a49.webp','alsx;lmsxclmz.xmc.,amzscklamslcmaklmsclkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk','educated elzagazig university','2023-09-10 19:43:50'),(15,'ahmed abaza','ahmed@ahmed.com','01151422701','$2y$10$MrwPW9wD8PwNmBzoK8pP3.nOKoHLlHgh59X2SEr/nEh8OOZDd48eS','devops engineer','User.webp','hello there','educated','2023-09-13 14:47:22');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `email&whatsapp` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `userlinks` (`user_id`,`social_id`,`link`) 
VALUES 
(NEW.id,8,CONCAT('mailto:',NEW.email,'?')),(NEW.id,7,CONCAT('http://wa.me/',NEW.phone)) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-16 17:15:16
