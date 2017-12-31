-- MySQL dump 10.13  Distrib 5.7.20, for osx10.12 (x86_64)
--
-- Host: localhost    Database: order_meal
-- ------------------------------------------------------
-- Server version	5.7.20

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
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_id` (`product_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat`
--

DROP TABLE IF EXISTS `cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_path` varchar(2084) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat`
--

LOCK TABLES `cat` WRITE;
/*!40000 ALTER TABLE `cat` DISABLE KEYS */;
INSERT INTO `cat` VALUES (12,'西游联盟',NULL,'2017-12-22 14:49:47','2017-12-22 14:49:47'),(15,'酒水','','2017-12-27 14:25:14','2017-12-27 14:25:14'),(16,'熟食','','2017-12-27 14:25:30','2017-12-27 14:25:30'),(17,'炒菜','','2017-12-27 14:25:45','2017-12-27 14:25:45'),(18,'炖菜','','2017-12-27 14:25:49','2017-12-27 14:25:49'),(19,'主食','','2017-12-27 14:26:01','2017-12-27 14:26:01'),(21,'汤类','','2017-12-27 14:27:59','2017-12-27 14:27:59'),(22,'点心','','2017-12-27 14:28:08','2017-12-27 14:28:08'),(23,'海鲜','','2017-12-27 14:28:48','2017-12-27 14:28:48'),(24,'粤菜','','2017-12-27 14:28:58','2017-12-27 14:28:58'),(25,'川菜','','2017-12-27 14:29:02','2017-12-27 14:29:02'),(26,'免费','','2017-12-27 15:09:24','2017-12-27 15:09:24');
/*!40000 ALTER TABLE `cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `order_num` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '如：A-8788627842',
  `product` text COLLATE utf8mb4_unicode_ci COMMENT '[{id: 1, count: 2},{id: 2, count: 5}]',
  `snapshot` text COLLATE utf8mb4_unicode_ci COMMENT '{product: [{id: 1, cover_url: "...", price: 5}], user: {id: 1, username: "whh"}}',
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,21,'9941','[{\"id\":\"19\",\"count\":\"2\"},{\"id\":\"20\",\"count\":\"1\"}]','{\"product\":[{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17},{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22}]}'),(2,21,'7772','[{\"id\":\"20\",\"count\":\"1\"}]','{\"product\":[{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22}]}'),(3,21,'8693','[{\"id\":\"20\",\"count\":\"1\"}]','{\"product\":[{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22}]}'),(4,21,'3114','null','{\"product\":[]}'),(5,21,'6475','[{\"id\":\"19\",\"count\":\"1\"},{\"id\":\"17\",\"count\":\"1\"}]','{\"product\":[{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17},{\"id\":17,\"title\":\"u8425u517bu83ccu6c64\",\"price\":77,\"cover_path\":\"5a4354b925c08.136.jpg\",\"prop\":null,\"sales\":567,\"create_time\":\"2017-12-27 16:07:21\",\"update_time\":\"2017-12-27 16:07:21\",\"cat_id\":21}]}'),(6,21,'8046','[{\"id\":\"19\",\"count\":\"1\"}]','{\"product\":[{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17}]}'),(7,21,'5587','[{\"id\":\"19\",\"count\":\"1\"},{\"id\":\"17\",\"count\":\"2\"},{\"id\":\"16\",\"count\":\"1\"}]','{\"product\":[{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17},{\"id\":17,\"title\":\"u8425u517bu83ccu6c64\",\"price\":77,\"cover_path\":\"5a4354b925c08.136.jpg\",\"prop\":null,\"sales\":567,\"create_time\":\"2017-12-27 16:07:21\",\"update_time\":\"2017-12-27 16:07:21\",\"cat_id\":21},{\"id\":16,\"title\":\"u6e05u7092u5927u867e\",\"price\":322,\"cover_path\":\"5a4354861ca3e.924.jpg\",\"prop\":null,\"sales\":212,\"create_time\":\"2017-12-27 16:06:30\",\"update_time\":\"2017-12-27 16:06:30\",\"cat_id\":17}]}'),(8,21,'1728','[{\"id\":\"19\",\"count\":\"1\"},{\"id\":\"17\",\"count\":\"3\"},{\"id\":\"16\",\"count\":\"1\"}]','{\"product\":[{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17},{\"id\":17,\"title\":\"u8425u517bu83ccu6c64\",\"price\":77,\"cover_path\":\"5a4354b925c08.136.jpg\",\"prop\":null,\"sales\":567,\"create_time\":\"2017-12-27 16:07:21\",\"update_time\":\"2017-12-27 16:07:21\",\"cat_id\":21},{\"id\":16,\"title\":\"u6e05u7092u5927u867e\",\"price\":322,\"cover_path\":\"5a4354861ca3e.924.jpg\",\"prop\":null,\"sales\":212,\"create_time\":\"2017-12-27 16:06:30\",\"update_time\":\"2017-12-27 16:06:30\",\"cat_id\":17}]}'),(9,21,'9529','[{\"id\":\"19\",\"count\":\"1\"},{\"id\":\"17\",\"count\":\"3\"},{\"id\":\"16\",\"count\":\"1\"}]','{\"product\":[{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17},{\"id\":17,\"title\":\"u8425u517bu83ccu6c64\",\"price\":77,\"cover_path\":\"5a4354b925c08.136.jpg\",\"prop\":null,\"sales\":567,\"create_time\":\"2017-12-27 16:07:21\",\"update_time\":\"2017-12-27 16:07:21\",\"cat_id\":21},{\"id\":16,\"title\":\"u6e05u7092u5927u867e\",\"price\":322,\"cover_path\":\"5a4354861ca3e.924.jpg\",\"prop\":null,\"sales\":212,\"create_time\":\"2017-12-27 16:06:30\",\"update_time\":\"2017-12-27 16:06:30\",\"cat_id\":17}]}'),(10,21,'56210','[{\"id\":\"20\",\"count\":\"2\"},{\"id\":\"19\",\"count\":\"1\"},{\"id\":\"21\",\"count\":\"2\"},{\"id\":\"18\",\"count\":\"1\"}]','{\"product\":[{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22},{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17},{\"id\":21,\"title\":\"u867eu4ec1u7389u7c73\",\"price\":55,\"cover_path\":\"5a4355bba6e1c.579.jpg\",\"prop\":null,\"sales\":234,\"create_time\":\"2017-12-27 16:11:39\",\"update_time\":\"2017-12-27 16:11:39\",\"cat_id\":21},{\"id\":18,\"title\":\"u5c0fu767du9f99\",\"price\":33,\"cover_path\":\"5a4354e3e3da6.581.jpg\",\"prop\":null,\"sales\":23,\"create_time\":\"2017-12-27 16:08:03\",\"update_time\":\"2017-12-27 16:08:03\",\"cat_id\":17}]}'),(11,21,'51411','[{\"id\":\"20\",\"count\":\"1\"}]','{\"product\":[{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22}]}'),(12,21,'58212','[{\"id\":\"20\",\"count\":\"2\"},{\"id\":\"19\",\"count\":\"1\"},{\"id\":\"21\",\"count\":\"2\"}]','{\"product\":[{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22},{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17},{\"id\":21,\"title\":\"u867eu4ec1u7389u7c73\",\"price\":55,\"cover_path\":\"5a4355bba6e1c.579.jpg\",\"prop\":null,\"sales\":234,\"create_time\":\"2017-12-27 16:11:39\",\"update_time\":\"2017-12-27 16:11:39\",\"cat_id\":21}]}'),(13,21,'26813','[{\"id\":\"20\",\"count\":\"2\"},{\"id\":\"19\",\"count\":\"1\"}]','{\"product\":[{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22},{\"id\":19,\"title\":\"u6e05u84b8u6cb3u87f9\",\"price\":188,\"cover_path\":\"5a435526311e7.506.jpg\",\"prop\":null,\"sales\":288,\"create_time\":\"2017-12-27 16:09:10\",\"update_time\":\"2017-12-27 16:09:10\",\"cat_id\":17}]}'),(14,21,'26914','[{\"id\":\"20\",\"count\":\"1\"}]','{\"product\":[{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22}]}'),(15,21,'56115','[{\"id\":\"20\",\"count\":\"1\"}]','{\"product\":[{\"id\":20,\"title\":\"u5c0fu751cu7cd5\",\"price\":233,\"cover_path\":\"5a4355532eada.974.jpg\",\"prop\":null,\"sales\":211,\"create_time\":\"2017-12-27 16:09:55\",\"update_time\":\"2017-12-27 16:09:55\",\"cat_id\":22}]}');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double unsigned NOT NULL,
  `cover_path` varchar(1080) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prop` text COLLATE utf8mb4_unicode_ci,
  `sales` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `cat_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cat` (`cat_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (12,'阿斯蒂拉炒黄瓜',66,'5a433e21c1736.711.jpg',NULL,188,'2017-12-27 14:30:57','2017-12-27 14:30:57',24),(13,'德科家私土豆片',68,'5a433e4f129fc.381.jpg',NULL,198,'2017-12-27 14:31:43','2017-12-27 14:31:43',24),(14,'大铁锅吨霸王',466,'5a433e78dbf8f.291.jpg',NULL,89,'2017-12-27 14:32:24','2017-12-27 14:32:24',18),(15,'科佳拉丝地瓜',76,'5a433ea650029.999.jpg',NULL,233,'2017-12-27 14:33:10','2017-12-27 14:33:10',17),(16,'清炒大虾',322,'5a4354861ca3e.924.jpg',NULL,212,'2017-12-27 16:06:30','2017-12-27 16:06:30',17),(17,'营养菌汤',77,'5a4354b925c08.136.jpg',NULL,567,'2017-12-27 16:07:21','2017-12-27 16:07:21',21),(18,'小白龙',33,'5a4354e3e3da6.581.jpg',NULL,23,'2017-12-27 16:08:03','2017-12-27 16:08:03',17),(19,'清蒸河蟹',188,'5a435526311e7.506.jpg',NULL,288,'2017-12-27 16:09:10','2017-12-27 16:09:10',17),(20,'小甜糕',233,'5a4355532eada.974.jpg',NULL,211,'2017-12-27 16:09:55','2017-12-27 16:09:55',22),(21,'虾仁玉米',55,'5a4355bba6e1c.579.jpg',NULL,234,'2017-12-27 16:11:39','2017-12-27 16:11:39',21),(22,'大金刚',222,'5a4355dd3622d.219.jpg',NULL,199,'2017-12-27 16:12:13','2017-12-27 16:12:13',25);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci COMMENT '{location_id: 1,detail:"望京山庄四单元1001" }',
  `permission` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'wangye','wangye','2017-12-19 15:17:42',NULL,NULL,'user'),(3,'小西悠','77777777','2017-12-19 15:24:54',NULL,NULL,'user'),(4,'正经啥的sad','wangye','2017-12-19 15:27:41',NULL,NULL,'user'),(5,'jingangsd','sada8asd','2017-12-19 15:28:03',NULL,NULL,'user'),(6,'wangye1','wangye','2017-12-19 15:31:57',NULL,NULL,'user'),(7,'wnagye3','wangye','2017-12-19 15:33:46',NULL,NULL,'user'),(8,'wangye4','wangye','2017-12-19 15:35:03',NULL,NULL,'user'),(9,'wangye9','wangye','2017-12-19 15:35:45',NULL,NULL,'user'),(10,'shhsdasd','asdassfds','2017-12-19 15:36:50',NULL,NULL,'user'),(11,'wangysds','d33e3b663c045f2ee927fa6d76e8093b','2017-12-19 15:37:48',NULL,NULL,'user'),(12,'xiaohutong','07fc113fa7cf01c48b2b0647136d6048','2017-12-19 15:39:25',NULL,NULL,'admin'),(13,'  小胡同123','07fc113fa7cf01c48b2b0647136d6048','2017-12-19 15:42:28',NULL,NULL,'user'),(14,'小正经','wangye',NULL,NULL,NULL,'user'),(15,'花花','wangye',NULL,NULL,NULL,'user'),(16,'花花','wangye',NULL,NULL,NULL,'user'),(17,'花花','wangye',NULL,NULL,NULL,'user'),(18,'花花','wangye',NULL,NULL,NULL,'user'),(19,'花花','wangye',NULL,NULL,NULL,'user'),(20,'-1111111','wangye','2017-12-20 14:23:50','2017-12-20 14:23:50',NULL,'user'),(21,'wangyecc','c23ac2b49fdcca78731600de83f384b0','2017-12-20 15:12:39','2017-12-20 15:12:39',NULL,'admin'),(22,'ningjiaqi','dec503d76e54f063e2ea4a638bea25d1','2017-12-21 10:52:29','2017-12-21 10:52:29',NULL,'user'),(23,'金刚王','c22cf8e6eee512fe125615b325e1c937','2017-12-27 13:44:32','2017-12-27 13:44:32',NULL,'user');
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

-- Dump completed on 2017-12-31 15:35:47
