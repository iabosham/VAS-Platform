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
DROP TABLE IF EXISTS `blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blacklist` (
  `id` int NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `attemps_count` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `breaking_1010`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `breaking_1010` (
  `msisdn` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `secret` varchar(200) NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int NOT NULL,
  `isActive` int NOT NULL,
  `creationDate` datetime NOT NULL,
  `vendor_id` int NOT NULL,
  `user_id` int NOT NULL,
  `user_type` int NOT NULL,
  `is_admin` int NOT NULL,
  `is_approve` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cnn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cnn` (
  `msisdn` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `content_posting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `content_posting` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `content_id` int NOT NULL,
  `status` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `system_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=317743 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `content_send_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `content_send_time` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `send_time` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `sys_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `inbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inbox` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TRANSCID` smallint DEFAULT NULL,
  `MSGTIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FROMMDN` varchar(50) DEFAULT NULL,
  `SHORTMSG` varchar(1000) DEFAULT NULL,
  `ISPROCESSED` smallint DEFAULT '0',
  `UPDATEDTIME` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `SHORTCODEID` int DEFAULT NULL,
  `CONNECTIONID` smallint DEFAULT NULL,
  `SHORTCODESTR` varchar(50) DEFAULT NULL,
  `sequenceNumber` int DEFAULT NULL,
  `read_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `from_group` (`FROMMDN`) USING BTREE,
  KEY `shr_code` (`SHORTCODESTR`)
) ENGINE=InnoDB AUTO_INCREMENT=12645736 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `status` int DEFAULT '0',
  `service_id` int NOT NULL,
  `sendTime` datetime NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int NOT NULL,
  `is_approved` int NOT NULL DEFAULT '1',
  `tranc_id` int DEFAULT '0',
  `creation_date_number` bigint DEFAULT NULL,
  `send_time_number` bigint DEFAULT NULL,
  `order_id` int NOT NULL DEFAULT '0',
  `submit_id` varchar(200) DEFAULT NULL,
  `is_free` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_MESSAGE_GROUPS1` (`service_id`),
  KEY `send_num` (`send_time_number`),
  KEY `st` (`status`),
  KEY `stime` (`sendTime`),
  KEY `isapp` (`is_approved`)
) ENGINE=InnoDB AUTO_INCREMENT=341219 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`suda1`@`%`*/ /*!50003 TRIGGER `message_BINS` BEFORE INSERT ON `message` FOR EACH ROW if ( isnull(new.creation_date_number)) then
 set new.creation_date_number=UNIX_TIMESTAMP(now());
end if */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `message_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_content` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `sub_service_id` int NOT NULL,
  `serial_id` int NOT NULL,
  `approval_flag` int NOT NULL,
  `sending_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=200953 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `message_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_history` (
  `id` bigint NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `message_id` int NOT NULL,
  `subscriber_id` int NOT NULL,
  `result_id` bigint NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tranc_id` int DEFAULT '0',
  `resend_count` int DEFAULT '0',
  `creation_date_number` bigint DEFAULT NULL,
  `send_time` bigint DEFAULT '0',
  `msisdn` bigint DEFAULT NULL,
  `process_count` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_MessageDetails_MESSAGE1` (`message_id`),
  KEY `fk_MessageDetails_SUBSCRIBER1` (`subscriber_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`suda1`@`%`*/ /*!50003 TRIGGER `message_history_BINS` BEFORE INSERT ON `message_history` FOR EACH ROW if ( isnull(new.creation_date_number)) then
 set new.creation_date_number=UNIX_TIMESTAMP(NOW());
end if */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `message_history_general`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_history_general` (
  `id` bigint NOT NULL,
  `msisdn` bigint NOT NULL,
  `message` text NOT NULL,
  `result_id` bigint DEFAULT NULL,
  `status` int DEFAULT '0',
  `tranc_id` int NOT NULL DEFAULT '0',
  `process_count` int NOT NULL DEFAULT '0',
  `creation_date` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `message_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_queue` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `message_id` int NOT NULL,
  `subscriber_id` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tranc_id` int DEFAULT '0',
  `creation_date_number` bigint DEFAULT NULL,
  `resend_count` int DEFAULT '0',
  `send_time` bigint DEFAULT NULL,
  `msisdn` bigint DEFAULT NULL,
  `thread_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  KEY `msdn` (`id`),
  KEY `stime` (`send_time`),
  KEY `rcount` (`resend_count`),
  KEY `thre` (`thread_id`),
  KEY `sub_id` (`subscriber_id`),
  KEY `tr_id` (`tranc_id`),
  KEY `cr_date_num` (`creation_date_number`),
  KEY `q_msisdn` (`msisdn`)
) ENGINE=InnoDB AUTO_INCREMENT=881190059 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`suda1`@`%`*/ /*!50003 TRIGGER `message_queue_BINS` BEFORE INSERT ON `message_queue` FOR EACH ROW if ( isnull(new.creation_date_number)) then
 set new.creation_date_number=UNIX_TIMESTAMP(NOW());
end if */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `message_queue_general`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_queue_general` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `msisdn` bigint NOT NULL,
  `message` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_time` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `tranc_id` int NOT NULL DEFAULT '0',
  `conn_id` int DEFAULT '4',
  `source_address` varchar(100) NOT NULL,
  `response_message` text,
  `status_time` datetime DEFAULT NULL,
  `msg_type` int DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `statuss` (`status`),
  KEY `conn_id_gen` (`conn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2026678 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `message_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message_status` (
  `id` int NOT NULL,
  `status_name` varchar(100) NOT NULL,
  `status_code` int NOT NULL,
  `color` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `msg_sub_push_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `msg_sub_push_conf` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `message_id` int NOT NULL,
  `row_index` bigint NOT NULL DEFAULT '0',
  `row_limit` bigint NOT NULL DEFAULT '500',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL,
  `check_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165387 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `notification_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification_log` (
  `id` int NOT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `msisdn` varchar(45) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `processors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processors` (
  `id` int NOT NULL,
  `p_code` int NOT NULL,
  `is_active` int NOT NULL,
  `connection_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `recycled_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recycled_numbers` (
  `id` bigint NOT NULL,
  `msisdn` bigint NOT NULL,
  `operator_id` int NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `resend_message_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resend_message_config` (
  `id` int NOT NULL,
  `service_id` varchar(45) NOT NULL,
  `attemp_number` int NOT NULL,
  `send_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sender` (
  `id` int NOT NULL,
  `name` varchar(14) NOT NULL,
  `service_id` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `service_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_permission` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `sub_service_id` bigint NOT NULL,
  `provider_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=976 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `service_subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_subscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subscription_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subscriber_id` int DEFAULT '0',
  `service_id` int DEFAULT '0',
  `isActive` int NOT NULL DEFAULT '1',
  `msisdn` bigint DEFAULT NULL,
  `subscription_channel` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'sms',
  `subscription_date_number` bigint DEFAULT NULL,
  `order_id` int NOT NULL DEFAULT '1',
  `sending_time` bigint DEFAULT NULL,
  `order_id_log` int DEFAULT '0',
  `o_lod` int NOT NULL DEFAULT '0',
  `thread_id` int DEFAULT NULL,
  `unsubscripe_date` timestamp NULL DEFAULT NULL,
  `retry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_id` (`service_id`,`msisdn`) USING BTREE,
  KEY `s_id` (`service_id`) USING BTREE,
  KEY `msdn` (`msisdn`),
  KEY `is_Ac` (`isActive`),
  KEY `sub_id` (`subscriber_id`),
  KEY `or_id` (`order_id`) USING BTREE,
  KEY `retry_date` (`retry_date`),
  KEY `unsubscripe_date` (`unsubscripe_date`),
  KEY `thread_id` (`thread_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13787341 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`suda1`@`%`*/ /*!50003 TRIGGER `service_subscription_BINS` BEFORE INSERT ON `service_subscription` FOR EACH ROW if ( isnull(new.subscription_date_number)) then
 set new.subscription_date_number=UNIX_TIMESTAMP(NOW());
end if */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
DROP TABLE IF EXISTS `service_subscription1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_subscription1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subscription_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subscriber_id` int DEFAULT '0',
  `service_id` int DEFAULT '0',
  `isActive` int NOT NULL DEFAULT '1',
  `msisdn` bigint DEFAULT NULL,
  `subscription_date_number` bigint DEFAULT NULL,
  `order_id` int NOT NULL DEFAULT '1',
  `sending_time` bigint DEFAULT NULL,
  `order_id_log` int DEFAULT '0',
  `o_lod` int NOT NULL DEFAULT '0',
  `thread_id` int DEFAULT NULL,
  `unsubscripe_date` timestamp NULL DEFAULT NULL,
  `retry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `s_id` (`service_id`) USING BTREE,
  KEY `msdn` (`msisdn`),
  KEY `is_Ac` (`isActive`),
  KEY `sub_id` (`subscriber_id`),
  KEY `or_id` (`order_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13696058 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `service_subscription_12`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_subscription_12` (
  `id` int NOT NULL DEFAULT '0',
  `subscription_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subscriber_id` int DEFAULT '0',
  `service_id` int DEFAULT '0',
  `isActive` int NOT NULL DEFAULT '1',
  `msisdn` bigint DEFAULT NULL,
  `subscription_date_number` bigint DEFAULT NULL,
  `order_id` int NOT NULL DEFAULT '1',
  `sending_time` bigint DEFAULT NULL,
  `order_id_log` int DEFAULT '0',
  `o_lod` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `service_subscription_fail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_subscription_fail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subscription_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `subscriber_id` int DEFAULT '0',
  `service_id` int DEFAULT '0',
  `isActive` int NOT NULL DEFAULT '1',
  `msisdn` bigint DEFAULT NULL,
  `subscription_date_number` bigint DEFAULT NULL,
  `order_id` int NOT NULL DEFAULT '1',
  `sending_time` bigint DEFAULT NULL,
  `order_id_log` int DEFAULT '0',
  `o_lod` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `s_id` (`service_id`) USING BTREE,
  KEY `msdn` (`msisdn`)
) ENGINE=InnoDB AUTO_INCREMENT=11891341 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `service_sudani`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_sudani` (
  `id` int NOT NULL DEFAULT '0',
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
  `system_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `shortcode_connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shortcode_connections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shortcode_id` int NOT NULL,
  `connection_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `smpp_connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `smpp_connections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(400) DEFAULT NULL,
  `server` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `secret` varchar(200) DEFAULT NULL,
  `is_enable` smallint DEFAULT NULL,
  `port` int DEFAULT NULL,
  `is_rx` smallint DEFAULT '1',
  `is_tx` smallint DEFAULT '1',
  `conn_type` smallint DEFAULT NULL,
  `operator_id` smallint DEFAULT NULL,
  `source_address` varchar(100) NOT NULL,
  `ton` int DEFAULT NULL,
  `npi` int DEFAULT NULL,
  `org_ton` int DEFAULT NULL,
  `org_npi` int DEFAULT NULL,
  `service_type` varchar(100) DEFAULT NULL,
  `msg_count` int NOT NULL DEFAULT '20',
  `no_balance_code` int NOT NULL DEFAULT '69',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sub_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `content_type` int NOT NULL DEFAULT '1',
  `msg_per_day` int NOT NULL,
  `content_length` int NOT NULL,
  `need_approval` int NOT NULL,
  `description` text,
  `content_id` int NOT NULL,
  `content_extra_id` int DEFAULT NULL,
  `sys_id` int NOT NULL DEFAULT '0',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=548 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sub_contents1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_contents1` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `content_type` int NOT NULL DEFAULT '1',
  `msg_per_day` int NOT NULL,
  `content_length` int NOT NULL,
  `need_approval` int NOT NULL,
  `description` text,
  `content_id` int NOT NULL,
  `content_extra_id` int DEFAULT NULL,
  `sys_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sub_contents2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_contents2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `content_type` int NOT NULL DEFAULT '1',
  `msg_per_day` int NOT NULL,
  `content_length` int NOT NULL,
  `need_approval` int NOT NULL,
  `description` text,
  `content_id` int NOT NULL,
  `content_extra_id` int DEFAULT NULL,
  `sys_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=393 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `subscriber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriber` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `TRANSID` int NOT NULL DEFAULT '0',
  `msisdn` varchar(45) NOT NULL,
  `isActive` int NOT NULL DEFAULT '1',
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `operator_id` int NOT NULL DEFAULT '1',
  `TRANSIDIndex` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `ms_sub` (`msisdn`)
) ENGINE=InnoDB AUTO_INCREMENT=11439654 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sys_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sys_pages` (
  `id` int NOT NULL,
  `page_code` int NOT NULL,
  `page_title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
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
DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `threads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tranc_connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tranc_connections` (
  `id` int NOT NULL,
  `tranc_id` int NOT NULL,
  `connection_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `transceivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transceivers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tranc_id` int NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` int DEFAULT '1',
  `status_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `uns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ms` varchar(14) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1045 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `unsubscribes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unsubscribes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `msisdn` bigint NOT NULL,
  `service_id` int NOT NULL,
  `unsub_type` varchar(255) NOT NULL DEFAULT 'portal',
  `subscription_date` timestamp NULL DEFAULT NULL,
  `subscription_channel` varchar(25) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203588 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `user_type` int NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` int DEFAULT NULL,
  `system_id` int NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  `company_id` int NOT NULL,
  `provider_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_page_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_page_permission` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `page_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `provider_type` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `address` text,
  `phone` int DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `description` text,
  `user_id` int NOT NULL,
  `public_key` text,
  `private_key` text,
  `provider_id` varchar(200) NOT NULL DEFAULT 'P-SQGdH8_G1OW',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

