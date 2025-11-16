mysqldump: [Warning] Using a password on the command line interface can be insecure.

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `service_code` int NOT NULL,
  `service_type_id` int NOT NULL DEFAULT '1',
  `service_key` varchar(10) DEFAULT NULL,
  `shortcode_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text,
  `en_name` varchar(100) DEFAULT NULL,
  `type` int DEFAULT '1',
  `sub_message` text,
  `unsub_message` text,
  `service_method` int NOT NULL DEFAULT '1',
  `sender_name` varchar(30) DEFAULT NULL,
  `sender_info` varchar(200) NOT NULL,
  `free_source` varchar(50) DEFAULT 'Info',
  `sub_service_id` int NOT NULL,
  `unsub_key` varchar(10) NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `send_count` int NOT NULL DEFAULT '1',
  `system_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'مواعظ الشيخ محمد سيد حاج',4441,1,'ا',1,1,1,'2024-03-11 13:16:49',NULL,'Mawaez Mohammed Said Hajj',1,'تم اشتراكك بنجاح في خدمة الشيخ محمد سيد حاج\r قيمة الاشتراك فقط ٢٥٠ج \r في حال الرغبة في الغاء الاشتراك ، أرسل الرمز غ','تم الغاء اشتراكك بنجاح',1,'4441','Info','4441',1,'غ',500,1,''),(2,'مدارج السالكين مع الشيخ محمد سيد حاج',4440,1,'1',2,1,1,'2024-03-11 13:18:07',NULL,'Madarej Al Salikin Mohammed Said Hajj',1,'تم اشتراكك بنجاح في خدمة الشيخ محمد سيد حاج\r قيمة الاشتراك فقط  ٢٥٠ج \r في حال الرغبة في الغاء الاشتراك ، أرسل الرمز غ','تم الغاء اشتراكك بنجاح',1,'4440','Info','4440',545,'غ',500,1,''),(3,'همسات زوجية للرجال',4488,1,'1',3,1,1,'2024-03-11 13:18:55',NULL,'Hmsat Zawjiah Man',1,'تم اشتراكك بنجاح في خدمة همسات زوجية\r قيمة الاشتراك فقط ٢٥٠ج \r في حال الرغبة في الغاء الاشتراك ، أرسل الرمز unsub','تم الغاء اشتراكك بنجاح',1,'4488','Info','4488',546,'unsub',500,1,''),(4,'همسات زوجية للنساء',4488,1,'2',3,1,1,'2024-03-11 13:19:36',NULL,'Hmsat Zawjiah Woman',1,'تم اشتراكك بنجاح في خدمة همسات زوجية\r قيمة الاشتراك فقط ٢٥٠ج \r في حال الرغبة في الغاء الاشتراك ، أرسل الرمز unsub','تم الغاء اشتراكك بنجاح',1,'4488','Info','4488',547,'unsub',500,1,'');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
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
/*!50003 CREATE*/ /*!50017 DEFINER=`suda1`@`%`*/ /*!50003 TRIGGER `service_BEFORE_INSERT` BEFORE INSERT ON `service` FOR EACH ROW BEGIN
DECLARE next_id INT;
   SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='service');
   SET NEW.service_code=next_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `service_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `service_type_code` varchar(100) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `service_type` WRITE;
/*!40000 ALTER TABLE `service_type` DISABLE KEYS */;
INSERT INTO `service_type` VALUES (1,'General','1',1);
/*!40000 ALTER TABLE `service_type` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `operators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operators` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `country_id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` text,
  `status` int DEFAULT '1',
  `num_pre_hint` varchar(14) DEFAULT NULL,
  `def_conn` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `operators` WRITE;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
INSERT INTO `operators` VALUES (1,'Zain',1,'zainsd','9d7b4a82d93b97b50c1dc612a6305095',NULL,1,'2499********',1),(2,'Sudani',1,'sudani_cci','1caacedad0c7088187398340a1e95677','eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb21wYW55IjoiYWx3aXNhbSJ9.iFnxvLyjkk-qgp_aUqq3HZs1lH5vwyqTKWsJe9njhW4',1,'2491********',4),(3,'MTN',1,'mtn_cci','9d7b4a82d93b97b50c1dc612a6305095',NULL,1,'2499********',2),(5,'sudani Temp',1,'sudani_temp','6644a41afa7453b8421e9162aa6e53fc',NULL,1,'2491********',0),(6,'Alwisam',1,'alwissam','8a9dacbfec13a64fff6fa7fe5156fdff','eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb21wYW55IjoiYWx3aXNhbSJ9.iFnxvLyjkk-qgp_aUqq3HZs1lH5vwyqTKWsJe9njhW4',1,'2491********',4);
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `shortcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shortcode` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `number` varchar(200) NOT NULL,
  `vendor_id` int NOT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  `company_id` int NOT NULL,
  `billing_type` varchar(45) NOT NULL DEFAULT '713265',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `shortcode` WRITE;
/*!40000 ALTER TABLE `shortcode` DISABLE KEYS */;
INSERT INTO `shortcode` VALUES (1,'مواعظ الشيخ محمد سيد حاج','4441',1,1,1,2,'direct'),(2,'مدارج السالكين مع الشيخ محمد سيد حاج','4440',1,1,1,2,'direct'),(3,'همسات زوجية','4488',1,1,1,2,'direct');
/*!40000 ALTER TABLE `shortcode` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `errorcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `errorcodes` (
  `code` varchar(10) NOT NULL,
  `tag` varchar(35) DEFAULT NULL,
  `description` varchar(95) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `errorcodes` WRITE;
/*!40000 ALTER TABLE `errorcodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `errorcodes` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `service_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_keys` (
  `id` int NOT NULL,
  `service_key` varchar(10) NOT NULL,
  `service_id` int NOT NULL,
  `key_type` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `service_keys` WRITE;
/*!40000 ALTER TABLE `service_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_keys` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `system_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_message` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `code` int NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `system_message` WRITE;
/*!40000 ALTER TABLE `system_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_message` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

