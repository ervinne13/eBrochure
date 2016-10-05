-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ebrochure
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Soap','Take care of your skin with our special soaps'),(2,'Perfumes','Everyday lovely fragrances for you');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2016_09_05_013823_create_admin',1),('2016_09_11_165448_add_payment_token',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '1',
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_images_products1_idx` (`product_id`),
  CONSTRAINT `fk_product_images_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,6,1,'/uploads/2016_09_05_113128.jpg'),(2,7,1,'/uploads/2016_09_05_122704.jpg');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `model` varchar(64) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '1',
  `status` varchar(32) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `model_UNIQUE` (`model`),
  KEY `fk_products_category1_idx` (`category_id`),
  CONSTRAINT `fk_products_category1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (6,1,'FL_Gluta_OilEx',45,'Forever Lovely Gluthathione with Oil Extract',120,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','2016-09-05 03:14:47','2016-09-05 03:30:59'),(7,2,'FL_RoseP',25,'Forever Lovely Rose Perfume',70,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','2016-09-05 04:27:07','2016-09-05 04:27:07');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `code` varchar(36) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES ('ADMIN','Administrator'),('PREMIUM_USER','Premium User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_invoice_details`
--

DROP TABLE IF EXISTS `sales_invoice_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_invoice_details` (
  `sales_invoice_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `sub_total` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sales_invoice_id`,`product_id`),
  KEY `fk_sales_invoice_has_products_sales_invoice1_idx` (`sales_invoice_id`),
  KEY `fk_sales_invoice_details_products1_idx` (`product_id`),
  CONSTRAINT `fk_sales_invoice_details_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sales_invoice_has_products_sales_invoice1` FOREIGN KEY (`sales_invoice_id`) REFERENCES `sales_invoices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_invoice_details`
--

LOCK TABLES `sales_invoice_details` WRITE;
/*!40000 ALTER TABLE `sales_invoice_details` DISABLE KEYS */;
INSERT INTO `sales_invoice_details` VALUES (1,7,1,70,'2016-09-06 10:14:53','2016-09-06 10:14:53'),(2,6,1,120,'2016-09-06 18:36:54','2016-09-06 18:36:54'),(3,7,1,70,'2016-09-06 19:19:55','2016-09-06 19:19:55'),(4,7,1,70,'2016-09-06 19:21:36','2016-09-06 19:21:36'),(5,7,1,70,'2016-09-06 19:22:44','2016-09-06 19:22:44'),(6,6,1,120,'2016-09-06 19:23:25','2016-09-06 19:23:25'),(7,7,1,70,'2016-09-06 19:24:12','2016-09-06 19:24:12'),(8,6,1,120,'2016-09-06 19:25:56','2016-09-06 19:25:56'),(9,6,1,120,'2016-09-06 19:27:11','2016-09-06 19:27:11'),(10,6,1,120,'2016-09-06 19:29:01','2016-09-06 19:29:01'),(11,6,1,120,'2016-09-06 19:29:21','2016-09-06 19:29:21'),(12,6,1,120,'2016-09-06 19:29:37','2016-09-06 19:29:37'),(13,6,1,120,'2016-09-06 19:30:24','2016-09-06 19:30:24'),(14,7,1,70,'2016-09-06 19:31:02','2016-09-06 19:31:02'),(15,6,1,120,'2016-09-06 19:31:43','2016-09-06 19:31:43'),(16,6,1,120,'2016-09-06 19:35:53','2016-09-06 19:35:53'),(17,7,1,70,'2016-09-06 19:36:27','2016-09-06 19:36:27'),(18,6,1,120,'2016-09-06 21:43:59','2016-09-06 21:43:59'),(18,7,1,70,'2016-09-06 21:43:59','2016-09-06 21:43:59'),(19,6,1,120,'2016-09-07 21:30:17','2016-09-07 21:30:17'),(20,7,1,70,'2016-09-07 21:46:38','2016-09-07 21:46:38'),(21,7,1,70,'2016-09-11 07:42:15','2016-09-11 07:42:15'),(22,7,1,70,'2016-09-11 07:42:44','2016-09-11 07:42:44'),(23,7,1,70,'2016-09-11 07:43:05','2016-09-11 07:43:05'),(24,7,1,70,'2016-09-11 07:47:45','2016-09-11 07:47:45'),(25,6,2,240,'2016-09-11 08:24:55','2016-09-11 08:24:55'),(26,6,1,120,'2016-09-11 08:27:05','2016-09-11 08:27:05'),(27,6,1,120,'2016-09-11 08:28:41','2016-09-11 08:28:41'),(28,6,1,120,'2016-09-11 08:32:02','2016-09-11 08:32:02'),(29,6,1,120,'2016-09-11 08:34:04','2016-09-11 08:34:04'),(30,6,2,240,'2016-09-11 08:47:16','2016-09-11 08:47:16'),(31,6,1,120,'2016-09-11 08:49:13','2016-09-11 08:49:13'),(32,6,1,120,'2016-09-11 09:10:56','2016-09-11 09:10:56'),(33,6,1,120,'2016-09-11 09:23:39','2016-09-11 09:23:39'),(34,6,1,120,'2016-09-11 09:24:51','2016-09-11 09:24:51'),(42,6,1,120,'2016-09-11 09:32:24','2016-09-11 09:32:24'),(43,6,1,120,'2016-09-11 09:36:51','2016-09-11 09:36:51'),(44,6,1,120,'2016-09-11 09:37:55','2016-09-11 09:37:55'),(45,6,1,120,'2016-09-11 09:43:23','2016-09-11 09:43:23'),(47,6,1,120,'2016-09-11 09:44:47','2016-09-11 09:44:47'),(48,6,1,120,'2016-09-11 10:24:26','2016-09-11 10:24:26'),(49,6,1,120,'2016-09-11 10:50:24','2016-09-11 10:50:24'),(50,6,1,120,'2016-09-11 11:13:13','2016-09-11 11:13:13'),(51,6,1,120,'2016-09-11 11:15:39','2016-09-11 11:15:39'),(53,6,1,120,'2016-09-11 11:17:24','2016-09-11 11:17:24'),(54,6,1,120,'2016-09-11 11:36:42','2016-09-11 11:36:42'),(55,6,1,120,'2016-09-11 11:48:17','2016-09-11 11:48:17'),(56,6,1,120,'2016-09-11 11:50:54','2016-09-11 11:50:54'),(57,6,2,240,'2016-09-11 11:54:27','2016-09-11 11:54:27'),(58,6,1,120,'2016-09-11 11:57:17','2016-09-11 11:57:17'),(58,7,1,70,'2016-09-11 11:57:17','2016-09-11 11:57:17'),(59,6,1,120,'2016-09-11 12:00:06','2016-09-11 12:00:06'),(59,7,1,70,'2016-09-11 12:00:06','2016-09-11 12:00:06'),(60,6,1,120,'2016-09-12 00:19:20','2016-09-12 00:19:20'),(60,7,2,140,'2016-09-12 00:19:20','2016-09-12 00:19:20'),(61,6,1,120,'2016-09-12 00:54:08','2016-09-12 00:54:08');
/*!40000 ALTER TABLE `sales_invoice_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_invoices`
--

DROP TABLE IF EXISTS `sales_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_number` varchar(10) DEFAULT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `customer_name` varchar(64) DEFAULT NULL,
  `customer_email` varchar(64) DEFAULT NULL,
  `customer_contact` varchar(64) DEFAULT NULL,
  `customer_address` text,
  `total_item_qty` int(11) NOT NULL DEFAULT '0',
  `total_amount` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL,
  `status` varchar(64) NOT NULL DEFAULT 'Open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_token` text,
  PRIMARY KEY (`id`),
  KEY `fk_sales_invoice_users1_idx` (`customer_id`),
  CONSTRAINT `fk_sales_invoice_users1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_invoices`
--

LOCK TABLES `sales_invoices` WRITE;
/*!40000 ALTER TABLE `sales_invoices` DISABLE KEYS */;
INSERT INTO `sales_invoices` VALUES (1,NULL,NULL,'','','','',1,70,0,'Rejected','2016-09-06 10:14:53','2016-09-06 17:17:53',NULL),(2,NULL,NULL,'Doris','','09461492931','',1,120,0,'Confirmed Payment','2016-09-06 18:36:54','2016-09-06 21:37:25',NULL),(3,NULL,NULL,'Doris','','09461492931','',1,70,0,'Awaiting Payment','2016-09-06 19:19:55','2016-09-06 19:19:55',NULL),(4,NULL,NULL,'Doris','','09461492931','',1,70,0,'Awaiting Payment','2016-09-06 19:21:36','2016-09-06 19:21:36',NULL),(5,NULL,NULL,'Doris','','09461492931','',1,70,0,'Awaiting Payment','2016-09-06 19:22:44','2016-09-06 19:22:44',NULL),(6,NULL,NULL,'Doris','','09461492931','',1,120,0,'Awaiting Payment','2016-09-06 19:23:25','2016-09-06 19:23:25',NULL),(7,NULL,NULL,'Doris','','09461492931','',1,70,0,'Awaiting Payment','2016-09-06 19:24:12','2016-09-06 19:24:12',NULL),(8,NULL,NULL,'Doris','','09461492931','',1,120,0,'Awaiting Payment','2016-09-06 19:25:56','2016-09-06 19:25:56',NULL),(9,NULL,NULL,'Doris','','09461492931','',1,120,0,'Awaiting Payment','2016-09-06 19:27:11','2016-09-06 19:27:11',NULL),(10,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-06 19:29:01','2016-09-06 19:29:01',NULL),(11,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-06 19:29:21','2016-09-06 19:29:21',NULL),(12,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-06 19:29:36','2016-09-06 19:29:36',NULL),(13,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-06 19:30:24','2016-09-06 19:30:24',NULL),(14,NULL,NULL,'Test User 01','','+639120406721','',1,70,0,'Awaiting Payment','2016-09-06 19:31:02','2016-09-06 19:31:02',NULL),(15,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-06 19:31:42','2016-09-06 19:31:42',NULL),(16,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-06 19:35:53','2016-09-06 19:35:53',NULL),(17,NULL,NULL,'Test User 01','','+639120406721','',1,70,0,'Awaiting Payment','2016-09-06 19:36:27','2016-09-06 19:36:27',NULL),(18,NULL,NULL,'Test User 01','','+639120406721','',2,190,0,'Confirmed Payment','2016-09-06 21:43:59','2016-09-06 21:45:15',NULL),(19,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-07 21:30:17','2016-09-07 21:30:17',NULL),(20,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,70,0,'Awaiting Payment','2016-09-07 21:46:38','2016-09-07 21:46:38',NULL),(21,NULL,NULL,'Test User 01','','+639120406721','',1,70,0,'Awaiting Payment','2016-09-11 07:42:15','2016-09-11 07:42:15',NULL),(22,NULL,NULL,'Test User 01','','+639120406721','',1,70,0,'Awaiting Payment','2016-09-11 07:42:44','2016-09-11 07:42:44',NULL),(23,NULL,NULL,'Test User 01','','+639120406721','',1,70,0,'Awaiting Payment','2016-09-11 07:43:05','2016-09-11 07:43:05',NULL),(24,NULL,NULL,'Test User 01','','+639120406721','',1,70,0,'Awaiting Payment','2016-09-11 07:47:45','2016-09-11 07:47:45',NULL),(25,NULL,NULL,'Test User 01','','+639120406721','',2,240,0,'Awaiting Payment','2016-09-11 08:24:55','2016-09-11 08:24:55',NULL),(26,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 08:27:05','2016-09-11 08:27:05',NULL),(27,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 08:28:41','2016-09-11 08:28:41',NULL),(28,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 08:32:02','2016-09-11 08:32:02',NULL),(29,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 08:34:04','2016-09-11 08:34:04',NULL),(30,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',2,240,0,'Awaiting Payment','2016-09-11 08:47:16','2016-09-11 08:47:16',NULL),(31,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 08:49:13','2016-09-11 08:49:13',NULL),(32,NULL,NULL,'Test User 01','','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 09:10:56','2016-09-11 09:10:56',NULL),(33,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 09:23:39','2016-09-11 09:23:39',NULL),(34,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 09:24:51','2016-09-11 09:24:51',NULL),(42,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 09:32:24','2016-09-11 09:32:28','PAY-8S691677GF807210LK7KZKLA'),(43,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 09:36:51','2016-09-11 09:36:55','PAY-2VE88667TT777302FK7KZMNY'),(44,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 09:37:55','2016-09-11 09:37:59','PAY-5SK68338SF3111639K7KZM5Y'),(45,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 09:43:23','2016-09-11 09:43:27','PAY-4FJ56646S7387451DK7KZPQA'),(47,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Payment Confirmed','2016-09-11 09:44:47','2016-09-11 09:45:27',''),(48,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Payment Confirmed','2016-09-11 10:24:26','2016-09-11 10:25:25',''),(49,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Payment Confirmed','2016-09-11 10:50:24','2016-09-11 10:51:57',''),(50,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 11:13:13','2016-09-11 11:13:18','PAY-1UK14071CR4864140K7K2ZTQ'),(51,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Awaiting Payment','2016-09-11 11:15:39','2016-09-11 11:15:43','PAY-2BJ55246ND257224YK7K22XY'),(53,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Payment Confirmed','2016-09-11 11:17:24','2016-09-11 11:18:03',''),(54,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Payment Confirmed','2016-09-11 11:36:42','2016-09-11 11:39:07',''),(55,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Payment Confirmed','2016-09-11 11:48:17','2016-09-11 11:48:55',''),(56,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',1,120,0,'Payment Confirmed','2016-09-11 11:50:54','2016-09-11 11:51:41',''),(57,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',2,240,0,'Payment Confirmed','2016-09-11 11:54:27','2016-09-11 11:55:18',''),(58,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',2,190,0,'Payment Confirmed','2016-09-11 11:57:17','2016-09-11 11:58:11',''),(59,NULL,NULL,'Ervinne','ervinnesodusta13@yahoo.com.ph','+639120406721','',2,190,0,'Payment Confirmed','2016-09-11 12:00:06','2016-09-11 12:00:49',''),(60,NULL,NULL,'','','','',3,260,0,'For Pickup','2016-09-12 00:19:20','2016-09-12 00:23:08',''),(61,NULL,NULL,'','','+639461492931','',1,120,0,'For Pickup','2016-09-12 00:54:08','2016-09-12 00:56:20','PAY-5M971506HM278870FK7LG2QI');
/*!40000 ALTER TABLE `sales_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `role_code` varchar(36) NOT NULL,
  `email` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `contact` varchar(64) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `address` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_roles1_idx` (`role_code`),
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`role_code`) REFERENCES `roles` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'ADMIN','administrator@ebrochure.com','Administrator',NULL,'2016-09-05 03:07:43','2016-09-12 00:16:46','qoQhC6Cq7aZTMpBMci2K13ioZc1scI8nyHwsxRRg3WArRRmFwB8mNoQiBfW3','QBHlorqsOb4XIJF9Z3oguwXVKmufGE1VmHdJaVvzGT4v3b6DYV7Ki9IRVg17','$2y$10$1WgIUrlps/XHYF.3L6Izees.oMKY618wdmR9VMJI2TcY2ph2Vr642',NULL);
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

-- Dump completed on 2016-09-15 12:36:41
