-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: mvc
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` char(35) NOT NULL,
  `user_type` enum('student','admin') NOT NULL DEFAULT 'student',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `register_number` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (12,'admin@infiniti','0749e44bcbde551b398813d345981969','admin','active','2024-10-06 09:21:45',NULL,'AD001'),(13,'ajmal_akram','572d47eec268c511f4cc5ff5fa2c60ad','admin','active','2024-10-06 09:43:13','2024-10-06 09:43:13','AD001'),(14,'ajmal_akram','572d47eec268c511f4cc5ff5fa2c60ad','admin','active','2024-10-06 09:45:45','2024-10-06 09:45:45','AD001'),(15,'ajmal_akram','572d47eec268c511f4cc5ff5fa2c60ad','admin','active','2024-10-06 09:49:32','2024-10-06 09:49:32','AD001'),(16,'ajmal_akram','572d47eec268c511f4cc5ff5fa2c60ad','admin','active','2024-10-06 09:50:46','2024-10-06 09:50:46','AD001'),(17,'ajmal_akram','572d47eec268c511f4cc5ff5fa2c60ad','admin','active','2024-10-06 12:46:02','2024-10-06 12:46:02','AD001'),(18,'suriya_karthi','9ab24703d4acc4de60b56723558b0644','student','active','2024-10-06 12:50:46','2024-10-06 12:50:46','AD001'),(19,'jegadheesh_waran','50a8e359e1078247b33878ddbaae6868','student','inactive','2024-10-06 14:55:12','2024-10-06 19:27:20','AD001'),(20,'arun_kumar','7e7ca246d026a11510ca2b53a2436f37','student','active','2024-10-06 15:31:08','2024-10-07 07:42:22','1ST'),(21,'jegadheesh_waran','d41d8cd98f00b204e9800998ecf8427e','student','inactive',NULL,'2024-10-06 15:32:20','AD001'),(22,'ruban_edward','55be7011db91e5628e4f5d02ef301a33','student','active','2024-10-06 15:49:24','2024-10-06 15:49:59','ST001'),(23,'alkegms','25d55ad283aa400af464c76d713c07ad','student','inactive','2024-10-06 15:51:58','2024-10-06 15:51:58','ST001'),(24,'summatesting','3fa020e9626aa4c887ab5f98e5e66fb7','student','active','2024-10-06 16:03:57','2024-10-06 16:03:57','ST001'),(25,'test','ae2b1fca515949e5d54fb22b8ed95575','student','inactive','2024-10-06 16:13:30','2024-10-06 16:13:30','ST001'),(26,'qwerty','e10adc3949ba59abbe56e057f20f883e','student','inactive','2024-10-06 16:14:43','2024-10-06 16:14:43','ST001'),(27,'alkegms','25d55ad283aa400af464c76d713c07ad','student','active','2024-10-06 16:20:01','2024-10-06 16:20:01','ST'),(28,'alkegms','25d55ad283aa400af464c76d713c07ad','student','active','2024-10-06 16:20:23','2024-10-06 16:20:23','ST'),(29,'m;legkgmnskng','25d55ad283aa400af464c76d713c07ad','student','active','2024-10-06 19:18:20','2024-10-07 10:37:55','ST001'),(30,'legituser','25d55ad283aa400af464c76d713c07ad','student','active','2024-10-06 19:18:48','2024-10-07 10:44:32','ST001'),(31,'ajmalakram152','25f9e794323b453885f5181f1b624d0b','student','active','2024-10-07 08:05:56','2024-10-07 08:05:56','ST001'),(32,'ajmalakram152','25f9e794323b453885f5181f1b624d0b','student','active','2024-10-07 08:06:37','2024-10-07 08:06:37','ST001'),(33,'naveen_kumar','cc9b7eb6fe3303f0045d5e490ed2b31c','student','active','2024-10-07 10:28:40','2024-10-07 10:28:40','ST001'),(34,'naveen_kumar','cc9b7eb6fe3303f0045d5e490ed2b31c','student','active','2024-10-07 10:29:05','2024-10-07 10:29:05','ST001'),(35,'naveen_kumar','cc9b7eb6fe3303f0045d5e490ed2b31c','student','active','2024-10-07 10:31:31','2024-10-07 10:31:31','ST001'),(36,'naveen_kumar','cc9b7eb6fe3303f0045d5e490ed2b31c','student','active','2024-10-07 10:35:12','2024-10-07 10:35:12','ST001'),(37,'naveen_kumar','cc9b7eb6fe3303f0045d5e490ed2b31c','student','active','2024-10-07 10:36:11','2024-10-07 10:36:11','ST001');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-07 10:59:04
