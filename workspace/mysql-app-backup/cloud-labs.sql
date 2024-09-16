-- MySQL dump 10.13  Distrib 8.0.30, for macos12 (x86_64)
--
-- Host: localhost    Database: cloud-labs
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `devices`
--

CREATE DATABASE `cloud_labs`;
use `cloud_labs`;


DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `devices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `device_name` text NOT NULL,
  `device_id` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `device_type` text NOT NULL,
  `private_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wg_ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wg_pubkey` varchar(128) NOT NULL,
  `time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `private_ip` (`private_ip`),
  UNIQUE KEY `wg_ip` (`wg_ip`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (60,43,'farooq','betalabs','9f1c2c9a22181aaa84d7e45f61758d97','Laptop','167.48.20.61','172.19.38.139','IpOBcVeW473pzmvPFdPVrdOw3sfM+Rp6IaMm+cYaIBI=','2023-12-05 01:49:03'),(63,43,'farooq','betalabsdev','a87269b1d586a9228272b0868a03f0f3','Laptop','167.48.17.36','172.19.3.203','UwgW7HYmYP1AmC0vTVFDVbWHbOXlgBueFkCDvyreWRU=','2023-12-22 16:19:06'),(74,45,'umarfarooq','betalabs-mac','9f013ddef74f1f298dc0de057f81e442','Laptop','167.48.245.107','172.19.185.69','UwgW7HYmYP1AmC0vTVFDVbWHbOXlgBueFkCDvyreWRU=','2024-08-27 03:20:18');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labs`
--

DROP TABLE IF EXISTS `labs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `instance_id` varchar(32) NOT NULL,
  `private_ip` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wg_ip` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `wg_pubkey` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `container_status` int NOT NULL,
  `time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `instance_id` (`instance_id`),
  UNIQUE KEY `private_ip` (`private_ip`),
  UNIQUE KEY `wg_ip` (`wg_ip`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labs`
--

LOCK TABLES `labs` WRITE;
/*!40000 ALTER TABLE `labs` DISABLE KEYS */;
INSERT INTO `labs` VALUES (31,43,'farooq','af27ebaaf1a96bf892fd55627f1824ba','167.48.188.102','172.19.30.175','5FPN255nDwMJ1xxFi0F/lrlHMDoPZvVAN1+cMPE22kw=',1,'2024-03-14 15:44:26'),(32,47,'suresh','c766720f0f7e44703a28d1b4974b21e8','167.48.124.170','172.19.107.226','XgDlxyt2amdlcJ222/2rHqqIoNGjokEeqf5qjiUukww=',0,'2023-12-08 19:52:34'),(33,48,'sado','fdf2136c0bd7655c87169fb41f3fb7c5','167.48.39.220','172.19.247.201','UgrlV573dC7VE3j6b1VRhf7OADOURZvVumztZGYoU1A=',1,'2023-12-12 18:37:11'),(34,49,'umarfarooq','ab5fe1cc183e55943fab897b13c959f1','167.48.193.242','172.19.26.97','OZE3jpcIyhKhX+8LMRVDJR32isfc9/YOSgwA83GI4Bs=',1,'2024-06-17 00:04:37'),(35,46,'karthik','0a01167d9f5a262312913a726d77bcec','167.48.84.235','172.19.201.30','xNpI+aCKs8R0V4+IqwscWw2d16752madqkaGHetNvjw=',0,'2024-05-21 23:30:43');
/*!40000 ALTER TABLE `labs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(512) NOT NULL,
  `date_joined` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_UNIQUE` (`uid`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (34,44,'umar','umar@exmple.com','$2y$10$5TUib6fN4tJ1jw3GR656/u39LwYL3MztcnA3JX9s4Wlh8bvze6Qy6','2023-11-03 22:16:17'),(36,46,'karthik','karthik@example.com','$2y$10$kJt0rd4JVC03jwOxGxbMjeqOQvEpBT1hbtrNIoSUYTUy5xlXklnVu','2023-11-12 03:47:51'),(37,47,'suresh','suresh@example.com','$2y$10$9Kx0CYw0kNbRqpuyiRdRAeC43W4ngXVOxYMsTt9xZg/JSR1fU3V/2','2023-11-13 02:43:40'),(38,48,'sado','sado@example.com','$2y$10$aArQq1kL7gS7qchSynRXx.5WtkplbxWzgI80whAyvWvhmkQVDL4I.','2023-12-12 18:33:21'),(39,45,'umarfarooq','umarfarooq@example.com','$2y$10$gEfWtrUJhEeP2m0/cpzsDOjGrjRFallYi428EyoXUMJha4XxbrnBi','2024-03-14 16:45:59'),(40,50,'vishal','vishal@example.com','$2y$10$A.vmEOVqK9BvFcTFxuzakOQD6S1PtZ97f1.yrbzVpfDLyVQ4FW9Bm','2024-05-02 18:03:23');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mysql_dbs`
--

DROP TABLE IF EXISTS `mysql_dbs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mysql_dbs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `mysql_username` varchar(30) NOT NULL,
  `mysql_dbname` varchar(30) NOT NULL,
  `time` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_dbs`
--

LOCK TABLES `mysql_dbs` WRITE;
/*!40000 ALTER TABLE `mysql_dbs` DISABLE KEYS */;
/*!40000 ALTER TABLE `mysql_dbs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mysql_users`
--

DROP TABLE IF EXISTS `mysql_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mysql_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `mysql_username` varchar(30) NOT NULL,
  `mysql_password` varchar(30) NOT NULL,
  `time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mysql_users`
--

LOCK TABLES `mysql_users` WRITE;
/*!40000 ALTER TABLE `mysql_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `mysql_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `session_token` varchar(32) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `fingerprint` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `login_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_agent` varchar(256) NOT NULL,
  `active` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (148,43,'farooq','06d7be7813fb803475206781a24f60ba','127.0.0.1','d8fea53534e6ca2f8c0c115541de138e','2023-12-01 20:52:09','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Safari/605.1.15',1),(150,43,'farooq','a28244ae0729eda37e91b6c036c7793b','127.0.0.1','d8fea53534e6ca2f8c0c115541de138e','2023-12-01 22:45:24','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Safari/605.1.15',1),(152,43,'farooq','3ce7c5a079fbdaf4721e06063ace7d22','127.0.0.1','d8fea53534e6ca2f8c0c115541de138e','2023-12-02 17:15:33','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Safari/605.1.15',1),(153,43,'farooq','3d25b07f7b2a9618dc2defa545d96355','127.0.0.1','158f38ec17e4fe162a323d45aca2e591','2023-12-03 17:10:21','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Safari/605.1.15',1),(154,43,'farooq','fd2d0abbc5eb78238bb60550731e1fd8','127.0.0.1','158f38ec17e4fe162a323d45aca2e591','2023-12-03 21:33:50','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Safari/605.1.15',1),(155,43,'farooq','c001031941b7a9a95a323ce18ba2147f','127.0.0.1','158f38ec17e4fe162a323d45aca2e591','2023-12-03 22:52:53','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Safari/605.1.15',1),(156,43,'farooq','495ae50f823a3b14bc45fa227e2d342d','127.0.0.1','158f38ec17e4fe162a323d45aca2e591','2023-12-04 11:26:12','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Safari/605.1.15',1),(158,43,'farooq','64416a33c50d1e080cd3ec665e8fc507','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-04 15:14:23','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(159,43,'farooq','bebdcd39f08d8c928aeeb31357e1c1f4','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-05 23:12:33','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(160,43,'farooq','93833a5b7176116f51e4a9cd9223c11c','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-06 02:14:08','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(161,43,'farooq','39109391cd08de298945496d672b826e','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-06 12:49:37','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(164,43,'farooq','4023e42af9c08427aac7d9eb3948d8fb','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-07 02:05:00','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(165,43,'farooq','05cc9e232a06071fb8b4da4a794827e3','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-07 14:38:16','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(166,43,'farooq','2aad22d2b5a22b1ed7987781bd7c84d5','127.0.0.1','1234','2023-12-07 15:39:07','PostmanRuntime/7.35.0',1),(167,43,'farooq','e86093cdaef3dccd32db4ebc963d8d08','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-07 18:32:02','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(168,43,'farooq','6c628e1570b5f438ab6f766388302803','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-07 21:50:15','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(169,43,'farooq','03f2517fe520eb23fa53f2c30b5c5a71','127.0.0.1','158f38ec17e4fe162a323d45aca2e591','2023-12-07 22:14:40','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Safari/605.1.15',1),(170,47,'suresh','eb10fa6bb001cf706d42cad426a239f7','127.0.0.1','158f38ec17e4fe162a323d45aca2e591','2023-12-07 22:15:13','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Safari/605.1.15',1),(171,43,'farooq','feb2c315fe215a9dd87cfbcfda10542b','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-07 22:17:00','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(172,43,'farooq','975776296c38e1299027801c565c867f','127.0.0.1','158f38ec17e4fe162a323d45aca2e591','2023-12-07 22:17:43','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Safari/605.1.15',1),(173,43,'farooq','d0ee8617ca914b544f048ea5a6fc32ef','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-08 02:39:20','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(176,43,'farooq','224cc8b80ef367215aeffea1af4fcb1b','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-08 19:28:01','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(178,43,'farooq','111bd41dbdc3b15fd15c333013b0c319','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-08 19:35:11','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(179,47,'suresh','14b5684242e447731f2c11d544948bef','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-08 19:35:23','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(180,43,'farooq','9f88549045608fdad0ca878d713cca8a','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-08 19:43:02','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(185,43,'farooq','1d40d4e0527a01d2f856fcd2fa843943','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-08 19:54:04','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(186,43,'farooq','b235002b0b35f898ca2686a256604510','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-08 23:08:50','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(187,43,'farooq','b20fdc843088005e7ea05eee2202d9ec','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-09 01:19:06','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(188,43,'farooq','c2777d9a204e31152b2fe41249f33351','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-09 13:35:55','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(189,43,'farooq','12abfaf5f0f45c7edd478008d51ccf70','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-10 01:26:23','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(197,43,'farooq','c568913d0c44edad37b4bb47b6fe16c0','127.0.0.1','58e99dc7c7e8526fd51f139c91fd20f3','2023-12-11 01:39:57','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(198,43,'farooq','8466fe261b2f64bae1cfcbd239afb9f9','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-11 15:05:23','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(201,43,'farooq','77c1fd0c6de3e8725ce4af1865395cd9','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-11 16:57:09','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(202,43,'farooq','bff9e4953b92585f4f9a9bb7c1ba4a20','127.0.0.1','8f90cb0561183c83dc23e12100a7f0d5','2023-12-11 22:21:46','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',1),(204,43,'farooq','caa1e212527e11aed3c1a3e8c4da8972','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-12 20:37:21','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(205,43,'farooq','56049dbcaa3308b933448d1307ad3429','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-14 01:02:53','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(206,43,'farooq','20145266fe78c4b0c8d300ec692f469b','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-18 01:54:48','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(207,43,'farooq','2c2d4802d0297bfe6d23bab72b49bb26','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-18 19:10:52','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(208,43,'farooq','17c328ae598dde3828a1ed3bbfe6fe24','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-20 02:22:13','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(209,43,'farooq','1107ff7e565113ef772e4793ac201b6c','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-21 02:57:22','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(210,43,'farooq','882267f09e81fca3bc8d0193a17b33ae','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-21 03:02:05','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(211,43,'farooq','0c65c04b18c2337e27386f9c0462002a','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-21 03:40:36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(212,43,'farooq','bf13700c7e9075a7a794590d5a357d3e','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-21 16:33:52','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(214,43,'farooq','2e861662aee6cfef1ea2a55b563191d8','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-22 15:05:02','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(215,43,'farooq','f64f31446d5042f3bb1664fe28cc677d','127.0.0.1','126cd729b340d520b7117d803cd3ea14','2023-12-22 21:18:45','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(216,43,'farooq','540c06f6cc2998fe7ed01a52b251ca79','127.0.0.1','ca46a97544508e2a04eefa77e5231e1f','2023-12-27 03:30:07','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(217,43,'farooq','e8c8a83c1a81cc1356c61cc8b0dd77ac','127.0.0.1','ca46a97544508e2a04eefa77e5231e1f','2023-12-28 19:26:11','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(218,43,'farooq','a22d6378934190de6ba3becf8ef7b74d','127.0.0.1','ca46a97544508e2a04eefa77e5231e1f','2023-12-28 23:54:03','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(219,43,'farooq','eaa4869ac103941fce7fcd0a7ae71880','127.0.0.1','ca46a97544508e2a04eefa77e5231e1f','2023-12-29 00:00:29','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(220,43,'farooq','3edf6822edcd32fbe61fb2b005b426b2','127.0.0.1','ca46a97544508e2a04eefa77e5231e1f','2023-12-31 19:13:54','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(221,45,'umarfarooq','f104607a1e487f6bc0edb62433728b07','127.0.0.1','ca46a97544508e2a04eefa77e5231e1f','2024-01-06 22:53:06','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(222,45,'umarfarooq','0d4f8b732bdffe471f5efa7d000308f5','127.0.0.1','ca46a97544508e2a04eefa77e5231e1f','2024-01-08 01:03:55','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',1),(223,45,'umarfarooq','5507303a7854c1b27e94c47cca05a5fb','127.0.0.1','96eba75359730759a5b741eea4df791e','2024-02-25 00:10:20','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',1),(224,45,'umarfarooq','b1ed8365cf67c367038416f87dca7b28','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-12 16:12:26','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(225,43,'farooq','7e548f908af6861990339986df7489f8','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-12 16:24:05','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(226,43,'farooq','9a21cf15080e1ae2a5f1258c42b8813c','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-13 11:11:54','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(227,43,'farooq','f873499e18670d66d878e8cdd6e680c8','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-13 11:18:45','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(228,43,'farooq','47766a8bb0d97b5d04d115d98f82a54b','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 14:08:23','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(229,43,'farooq','472f518a04ae078b9507792ce1b49bad','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 14:26:44','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(230,43,'farooq','b252ea5c1fe1e2ca5813733310f84b80','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 14:38:32','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(231,43,'farooq','b1feaffdc67a4a33559ad1703ab210f4','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 14:38:57','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(232,49,'umarfarooq','05e93aa1af79edf5be6085ea8a782bbf','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 15:39:49','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(233,43,'farooq','e622438a164877af9e04daa091f1504d','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 15:44:17','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(234,45,'umarfarooq','9aad0a080920c697e41273578f6f9c44','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 16:46:10','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(235,45,'umarfarooq','ae35d33b948040881ad87a6762d8b1e7','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 16:48:45','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(236,45,'umarfarooq','6eacea0577b3c4fc8c206a5fe4df09a5','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 16:49:23','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(237,45,'umarfarooq','cb50e407bf050dd277040bb0a82c327f','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 16:51:21','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(238,45,'umarfarooq','dc95a02ed5cab71ab22a1ced77adfa5a','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 16:52:31','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(239,45,'umarfarooq','1ead619d69799ae37dd878d73066fe9b','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 16:56:03','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(240,45,'umarfarooq','c6112aa138017c84651fe5b8df0d0341','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 16:57:09','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(241,45,'umarfarooq','818ee0b7659a8006d6ab36d42664184e','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-14 17:39:14','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(242,45,'umarfarooq','4786142bce243424dc6be027537dee9a','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-15 12:49:20','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(244,45,'umarfarooq','a3db06772601d2db022cba94455e45d5','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-18 00:20:43','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(246,45,'umarfarooq','1ae58ff34ca63c3c8e9c80a4f982b1be','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-20 12:49:55','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(247,45,'umarfarooq','8a27a40a85958323efa6f04f12dfb4c3','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-20 13:58:36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(248,45,'umarfarooq','e52b038ec68fdb3e596c8e8f54c8b261','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-20 14:02:07','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(249,45,'umarfarooq','68c23e9647359cf6a6615bd0637e45b7','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-20 14:12:32','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(250,45,'umarfarooq','cd2b95551c0da6f26d97f0cb785f118e','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-20 14:12:50','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(251,45,'umarfarooq','3dd840f423359891114a4382a89fd996','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-20 14:18:31','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(252,45,'umarfarooq','2a80a4a28b61b939bae8f6df9875be30','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-21 16:02:41','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',1),(253,45,'umarfarooq','bcd83154a1f89c78c955a6c4caaba5f6','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-26 21:48:32','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',1),(256,45,'umarfarooq','2d2ff44235b99c0509722ae3dcf25f74','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-03-27 23:00:13','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',1),(257,45,'umarfarooq','ec602c03b4d4bc97b6315fa734411cda','127.0.0.1','e9b48489bab205a998f3889e54a61d10','2024-04-03 16:30:36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',1),(258,45,'umarfarooq','2b418b55cc318d77009c40fd93d9db60','127.0.0.1','0cd0bae0a6333b086160292568c8b74e','2024-04-17 20:37:45','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',1),(259,45,'umarfarooq','6db3f756cf8d5e66c904e915e22cf64c','127.0.0.1','fe9ace6321eb151e9e59624e52195a97','2024-05-02 00:22:44','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',1),(260,45,'umarfarooq','b8f6f4601e547b7d48d2597f1f775722','127.0.0.1','fe9ace6321eb151e9e59624e52195a97','2024-05-02 17:49:07','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',1),(261,45,'umarfarooq','df027d114400d1b1f71af68e0cee03b8','127.0.0.1','dfiodahifhdihfdh','2024-05-02 17:51:34','PostmanRuntime/7.38.0',1),(262,45,'umarfarooq','874ca3fa6c630c145624762c3f7fe0e7','127.0.0.1','dfiodahifhdihfdh','2024-05-02 17:51:46','PostmanRuntime/7.38.0',1),(263,45,'umarfarooq','0cbc79207424230648eff0f5cf7af553','127.0.0.1','3f6b25baefd61c0d9a6f0f10799bbb68','2024-05-14 23:09:40','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',1),(264,45,'umarfarooq','4a9c0a1913dc5a127f2753954cb35704','127.0.0.1','dfiodahifhdihfdh','2024-05-14 23:12:21','PostmanRuntime/7.38.0',1),(265,45,'umarfarooq','b312d3738fdac8d7c49d38898b7725f6','127.0.0.1','3f6b25baefd61c0d9a6f0f10799bbb68','2024-05-15 20:13:41','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',1),(266,45,'umarfarooq','c9e4b9a5e1c06015ea8f7ac20d0b6076','127.0.0.1','3f6b25baefd61c0d9a6f0f10799bbb68','2024-05-16 23:30:00','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',1),(272,45,'umarfarooq','acb9ce57426c5ab4451ceba64628f8c9','127.0.0.1','3f6b25baefd61c0d9a6f0f10799bbb68','2024-05-17 00:39:09','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',1),(274,45,'umarfarooq','a287f04310542f65a4c9edf753abfca9','127.0.0.1','3f6b25baefd61c0d9a6f0f10799bbb68','2024-05-17 22:36:22','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',1),(275,45,'umarfarooq','0efc7fb3d578f52e8e0e8af112cda8e5','127.0.0.1','514e440a3b2152fbe82b37db5e2d42ac','2024-05-18 18:30:41','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(276,45,'umarfarooq','e3e13eb0d894316820b018da2d70acf4','127.0.0.1','514e440a3b2152fbe82b37db5e2d42ac','2024-05-20 22:33:40','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(277,45,'umarfarooq','19d0c8e7d2a0d0858b4f45780407dc21','127.0.0.1','514e440a3b2152fbe82b37db5e2d42ac','2024-05-21 23:09:34','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(278,46,'karthik','49918334f331fe40053353bd6903fc9a','127.0.0.1','514e440a3b2152fbe82b37db5e2d42ac','2024-05-21 23:23:54','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(279,45,'umarfarooq','3c1eeb83e94655e3bb475c4f266dfb08','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-09 20:33:46','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(280,45,'umarfarooq','11a072754cc5a55e049c565b50411e1e','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-09 21:51:42','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(281,45,'umarfarooq','3668070518e8d22b5bb8ff0ac59f5bb7','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-09 21:59:00','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(282,45,'umarfarooq','a49828947ae8274469fcf310cc2d48f4','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-09 23:22:40','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(283,45,'umarfarooq','637122f8833c0a1dd99a3719fc3b5df3','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-11 01:02:05','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(284,45,'umarfarooq','7e1ed4f58486b791c97e7a36be1c01c7','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-12 23:15:20','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(285,45,'umarfarooq','0960231eedf97585be18b6d472be4909','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-13 01:35:14','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(286,45,'umarfarooq','d694f9562d12cf43184c8136364cd8a7','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-15 20:37:49','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(287,45,'umarfarooq','2aa11b6681ab0ff53671a48893aafc4b','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-17 00:02:10','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(288,45,'umarfarooq','7238279935d7e0a3711ed7609d6ab399','127.0.0.1','29601ddb35df3b9a37b118255095a433','2024-06-17 20:10:36','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',1),(289,45,'umarfarooq','2a6df91a09df0fd0bd71a4e9b755f2a5','127.0.0.1','47c8a7f68fcdf36e1babec303ac07fa2','2024-07-04 03:31:22','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',1),(290,45,'umarfarooq','d869112a176a6db6ab71453256819086','127.0.0.1','f75883d78e073499170dc12f0c2100ed','2024-08-27 03:13:10','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',1);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `about` longtext,
  `role` tinytext,
  `email` varchar(256) NOT NULL,
  `phone` bigint NOT NULL,
  `date_joined` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `phone_UNIQUE` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (44,'umar','umar',NULL,NULL,'umar@exmple.com',424240099,'2023-11-03 22:16:17'),(45,'Umar Farooq','umarfarooq',NULL,NULL,'umar@example.com',1234567890,'2023-11-03 22:38:53'),(46,'karthik','karthik',NULL,NULL,'karthik@example.com',123456,'2023-11-12 03:47:51'),(47,'Suresh','suresh',NULL,NULL,'suresh@example.com',1234567,'2023-11-13 02:43:40'),(48,'Sadagopan','sado',NULL,NULL,'sado@example.com',2323232323,'2023-12-12 18:33:21'),(50,'vishal','vishal',NULL,NULL,'vishal@example.com',12341234,'2024-05-02 18:03:23');
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

-- Dump completed on 2024-09-05 23:54:57
