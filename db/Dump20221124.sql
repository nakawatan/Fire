-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: bfp
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.1

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
-- Table structure for table `anno`
--

DROP TABLE IF EXISTS `anno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anno` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anno`
--

LOCK TABLES `anno` WRITE;
/*!40000 ALTER TABLE `anno` DISABLE KEYS */;
INSERT INTO `anno` VALUES (7,'bfpnhq_ISO_Certified_29Dec2021.jpg','NOTICE TO PROCEED - LPO-22-05-0007','Supply and Delivery of Ambulance (Type-1 Basic Life Support )','2022-10-05 14:00:00'),(9,'Screenshot from 2022-11-15 15-04-32.png','This is a sample announcement','Sample Announcement','2022-11-23 06:43:00');
/*!40000 ALTER TABLE `anno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (5,'gelo mauhay','gelo03','gelo@gmail.com','202cb962ac59075b964b07152d234b70'),(6,'John Maenard Semira','jmsemira@gmail.com','jmsemira@gmail.com','1668584687757'),(7,'maenard semira','sekretoz02@gmail.com','sekretoz02@gmail.com','1668584906402');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `new_business_doc`
--

DROP TABLE IF EXISTS `new_business_doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `new_business_doc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `certificate_of_occupancy` text,
  `business_permit_fee` text,
  `appidavit_of_undertaking` text,
  `fire_insurance` text,
  `record_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_business_doc`
--

LOCK TABLES `new_business_doc` WRITE;
/*!40000 ALTER TABLE `new_business_doc` DISABLE KEYS */;
INSERT INTO `new_business_doc` VALUES (1,'/upload/docs/1668764938Screenshot from 2022-11-15 14-51-07.png','/upload/docs/1668764938Screenshot from 2022-11-15 15-03-26.png','/upload/docs/1668764938Screenshot from 2022-11-15 14-57-49.png','/upload/docs/1668764938',233);
/*!40000 ALTER TABLE `new_business_doc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `ref_id` int DEFAULT NULL,
  `viewed` int DEFAULT NULL,
  `message` text,
  `date` datetime DEFAULT NULL,
  `obj_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (1,2,6,1,'Request Rejected','2022-11-21 12:08:52',NULL),(2,1,5,1,'New Application Request added.','2022-11-21 13:00:45',241),(3,2,NULL,0,'1600 payment amount is added for app No.:','2022-11-21 15:03:30',239),(4,2,6,1,'600 payment amount is added for app No.:test 3','2022-11-21 15:07:31',238),(5,2,NULL,0,' is approved.','2022-11-21 15:08:31',238),(6,2,6,1,'700 payment amount is added for app No.:test 4','2022-11-21 15:10:54',237),(7,2,6,1,'test 4 is declined.','2022-11-21 15:11:20',237),(8,2,6,1,'1700 payment amount is added for app No.:test 5','2022-11-21 15:13:27',236),(9,1,5,1,'New Application Request added.','2022-11-21 18:20:41',242),(10,2,6,1,'1500 payment amount is added for app No.:test 6','2022-11-21 18:26:32',242),(11,2,6,1,'test 6 is approved.','2022-11-21 18:26:42',242);
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupancy_doc`
--

DROP TABLE IF EXISTS `occupancy_doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `occupancy_doc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `obo_endoursement` text,
  `certificate_of_completion` text,
  `assessment_fee` text,
  `as_built_plan` text,
  `fsccr` text,
  `record_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupancy_doc`
--

LOCK TABLES `occupancy_doc` WRITE;
/*!40000 ALTER TABLE `occupancy_doc` DISABLE KEYS */;
INSERT INTO `occupancy_doc` VALUES (1,'/upload/docs/1668764169Screenshot from 2022-10-13 17-31-35.png','/upload/docs/1668764169Screenshot from 2022-10-13 18-39-02.png','/upload/docs/1668764169Screenshot from 2022-11-15 14-51-07.png','/upload/docs/1668764169Screenshot from 2022-11-15 15-03-26.png','/upload/docs/1668764169Screenshot from 2022-11-15 15-04-34.png',NULL),(2,'/upload/docs/1668764465Screenshot from 2022-10-13 17-31-35.png','/upload/docs/1668764465Screenshot from 2022-10-13 18-39-02.png','/upload/docs/1668764465Screenshot from 2022-11-15 14-51-07.png','/upload/docs/1668764465Screenshot from 2022-11-15 15-03-26.png','/upload/docs/1668764465Screenshot from 2022-11-15 15-04-34.png',230),(3,'/upload/docs/1668764533Screenshot from 2022-10-13 17-31-35.png','/upload/docs/1668764533Screenshot from 2022-11-15 14-57-49.png','/upload/docs/1668764533Screenshot from 2022-11-15 15-04-32.png','/upload/docs/1668764533Screenshot from 2022-11-15 15-04-34.png','/upload/docs/1668764533Screenshot from 2022-11-15 15-04-32.png',231),(4,'/upload/docs/1668764910Screenshot from 2022-10-13 17-31-35.png','/upload/docs/1668764910Screenshot from 2022-11-15 14-57-49.png','/upload/docs/1668764910Screenshot from 2022-11-15 15-04-32.png','/upload/docs/1668764910Screenshot from 2022-11-15 15-04-34.png','/upload/docs/1668764910Screenshot from 2022-11-15 15-04-32.png',232),(5,'/upload/docs/1668766390Screenshot from 2022-10-13 17-31-35.png','/upload/docs/1668766390Screenshot from 2022-10-13 18-39-02.png','/upload/docs/1668766390Screenshot from 2022-11-15 14-51-07.png','/upload/docs/1668766390Screenshot from 2022-11-15 14-57-49.png','/upload/docs/1668766390Screenshot from 2022-11-15 15-04-32.png',235),(6,'/upload/docs/1668766615Screenshot from 2022-10-13 17-31-35.png','/upload/docs/1668766615Screenshot from 2022-10-13 18-39-02.png','/upload/docs/1668766615Screenshot from 2022-11-15 14-51-07.png','/upload/docs/1668766615Screenshot from 2022-11-15 14-53-45.png','/upload/docs/1668766615Screenshot from 2022-11-15 15-03-26.png',237),(7,'/upload/docs/1669006845Screenshot from 2022-11-15 15-04-32.png','/upload/docs/1669006845Screenshot from 2022-11-15 14-57-49.png','/upload/docs/1669006845Screenshot from 2022-11-15 14-53-45.png','/upload/docs/1669006845Screenshot from 2022-11-15 14-51-07.png','/upload/docs/1669006845Screenshot from 2022-11-15 15-04-34.png',241);
/*!40000 ALTER TABLE `occupancy_doc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `record` (
  `id` int NOT NULL AUTO_INCREMENT,
  `appnum` varchar(50) DEFAULT NULL,
  `nowner` varchar(50) NOT NULL,
  `esname` varchar(50) NOT NULL,
  `autho` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `bnature` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `type` int DEFAULT '1',
  `client_id` int DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `payment_review_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `record`
--

LOCK TABLES `record` WRITE;
/*!40000 ALTER TABLE `record` DISABLE KEYS */;
/*!40000 ALTER TABLE `record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renewal_documents`
--

DROP TABLE IF EXISTS `renewal_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `renewal_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_permit_fee` text,
  `fire_insurance` text,
  `fsmr` text,
  `fire_safety_clearance` text,
  `record_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renewal_documents`
--

LOCK TABLES `renewal_documents` WRITE;
/*!40000 ALTER TABLE `renewal_documents` DISABLE KEYS */;
INSERT INTO `renewal_documents` VALUES (1,'/upload/docs/1668765173Screenshot from 2022-11-15 14-57-49.png','/upload/docs/1668765173Screenshot from 2022-11-15 14-51-07.png','/upload/docs/1668765173Screenshot from 2022-11-15 15-04-34.png','/upload/docs/1668765173Screenshot from 2022-11-15 15-04-32.png',234),(2,'/upload/docs/1669026041Screenshot from 2022-10-13 17-31-35.png','/upload/docs/1669026041Screenshot from 2022-10-13 18-39-02.png','/upload/docs/1669026041Screenshot from 2022-11-15 14-51-07.png','/upload/docs/1669026041Screenshot from 2022-11-15 14-53-45.png',242);
/*!40000 ALTER TABLE `renewal_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scheduler`
--

DROP TABLE IF EXISTS `scheduler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scheduler` (
  `id` int NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduler`
--

LOCK TABLES `scheduler` WRITE;
/*!40000 ALTER TABLE `scheduler` DISABLE KEYS */;
/*!40000 ALTER TABLE `scheduler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `em_code` char(12) NOT NULL,
  `department` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `gender` varchar(150) NOT NULL,
  `contact` char(12) NOT NULL,
  `date_birth` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `birth` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'Anjenette Mauhay','Active','MALE','099897286126','2022-10-08','Sampaguita Mabini Batangas','bfpr4amabini','anjiemauhay@gmail.com','827ccb0eea8a706c4c34a16891f84e7b','images.png');
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

-- Dump completed on 2022-11-24 14:15:37
