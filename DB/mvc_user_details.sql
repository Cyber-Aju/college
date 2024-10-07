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
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_details` (
  `detail_id` int NOT NULL AUTO_INCREMENT,
  `r_user_id` int NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `department` enum('CSE','ECE','IT','EEE','MECH') DEFAULT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `r_user_id` (`r_user_id`),
  CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`r_user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,12,'Ajmal','Akram','2002-10-17','male','ajmalakram152@gmail.com','7094653492','TVK Main Road, Ammapet, Salem','A+','./view/uploads/_Ajmal.jpg',NULL),(2,16,'Ajmal','Akram','2002-10-17','male','ajmalakram152@gmail.com','7094653493','TVK Main Road, Ammapet, Salem','B+','./view/uploads/CSE_Ajmal.jpg','CSE'),(3,17,'Ajmal','Akram','2002-10-17','male','ajmalakram152@gmail.com','7094653493','TVK Main Road, Ammapet, Salem','B+','./view/uploads/CSE_Ajmal.jpg','CSE'),(4,18,'Suriya','Karthi','2003-10-10','male','suriya@mail.com','7896325410','Trichangode','B+','./view/uploads/CSE_Suriya.jpg','CSE'),(5,19,'Jegadheesh','Waran','2002-10-06','male','jegadheesh@mail.com','9784563210','Nangavalli, Salem....','A+','./view/uploads/CSE_Jegadheesh.jpg','CSE'),(6,20,'Arun','Kumar','2002-12-25','male','arun@mail.com','7896541230','Nangavalli, Salem.','B-','./view/uploads/CSE_Arun.jpg','CSE'),(7,21,'','','2002-10-06','male','jegadheesh@mail.com','9784563210','Nangavalli, Salem..','A+',NULL,'CSE'),(8,22,'Ruban','Edward','2003-10-10','male','ruban@gmail.com','7689451237','Pondicherry','B+','./view/uploads/IT_Ruban.jpg','IT'),(9,23,'Ajmal','Akram','2006-10-05','male','ajmalakram152@gmail.com','7094653492','TVK Main Road, Ammapet, Salem','B+','./view/uploads/CSE_Ajmal.jpg','CSE'),(10,24,'Summa','Testing','2006-10-10','female','summa@mail.com','8794561230','Summa','B+','./view/uploads/ECE_summa.jpg','ECE'),(11,25,'Test','Test','2002-11-11','male','test@mail.com','8794563217','Test','A+','./view/uploads/CSE_test.jpg','CSE'),(12,26,'Qwerty','Qwerty','2003-10-01','male','qwert@mail.com','8796542100','TVK Main Road, Ammapet, Salem','A+',NULL,'CSE'),(13,27,'Ajmal','Akram','2006-10-05','male','ajmalakram152@gmail.com','7094653492','TVK Main Road, Ammapet, Salem','B+','./view/uploads/CSE_Ajmal.jpg','CSE'),(14,28,'Ajmal','Akram','2006-10-05','male','ajmalakram152@gmail.com','7094653492','TVK Main Road, Ammapet, Salem','B+','./view/uploads/CSE_Ajmal.jpg','CSE'),(15,29,'As','As','2003-11-11','male','a@m.c','7896541230','Ansd','A+','./view/uploads/CSE_.jpg','CSE'),(16,30,'As','As','2003-11-11','male','a@m.c','7896541230','Ansd','A+','./view/uploads/CSE_As.jpg','CSE'),(17,31,'Aja','Aka','2000-11-11','male','sales@ma.c','7896565412','Qw','A+',NULL,'CSE'),(18,32,'Aja','Aka','2000-11-11','male','sales@ma.c','7896565412','Qw','A+',NULL,'CSE'),(19,37,'Naveen','Kumar','2002-10-10','male','naveen@mail.com','9876549871','Erode','A-','./view/uploads/EEE_naveen.jpg','EEE');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
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
