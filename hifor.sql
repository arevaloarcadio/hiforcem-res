-- MySQL dump 10.16  Distrib 10.3.8-MariaDB, for osx10.13 (x86_64)
--
-- Host: localhost    Database: hifor
-- ------------------------------------------------------
-- Server version	10.3.8-MariaDB

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
  `parent_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complete` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  UNIQUE KEY `categories_complete_unique` (`complete`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,0,'Pretensada','vigueta-pretensada',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(2,0,'Armada','vigueta-armada',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(3,0,'Pérgolas','pergolas',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(4,0,'Hincos','hincos',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(5,0,'Placas','placas',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(6,1,'P-12','P-12',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(7,1,'T-17','T-17',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(8,2,'Único','unico',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(9,3,'10x15','10x15',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(10,3,'12x20','12x20',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(11,3,'12x25','12x25',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27'),(12,3,'14x28','14x28',NULL,'2018-08-19 15:32:27','2018-08-19 15:32:27');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `discount` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,1,1,40,'2018-08-20 08:57:59','2018-08-20 08:57:59'),(2,1,1,35,'2018-08-20 08:58:24','2018-08-20 08:58:24'),(3,1,3,35,'2018-08-20 09:04:35','2018-08-20 09:04:35'),(4,1,3,0,'2018-08-20 09:05:03','2018-08-20 09:05:03'),(5,1,3,2,'2018-08-20 09:06:39','2018-08-20 09:06:39'),(6,3,1,30,'2018-08-20 09:08:50','2018-08-20 09:08:50'),(7,1,16,2,'2018-08-20 09:08:52','2018-08-20 09:08:52');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_options`
--

DROP TABLE IF EXISTS `item_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_options`
--

LOCK TABLES `item_options` WRITE;
/*!40000 ALTER TABLE `item_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `size` decimal(8,2) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `bruto` decimal(8,2) DEFAULT NULL,
  `mano` decimal(8,2) DEFAULT NULL,
  `cost` decimal(8,2) DEFAULT NULL,
  `comission` decimal(8,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(10) unsigned DEFAULT NULL,
  `commercial_id` int(10) unsigned DEFAULT NULL,
  `commercial` tinyint(1) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_01_25_202838_create_products_table',1),(4,'2018_01_25_203031_create_categories_table',1),(5,'2018_01_28_155446_create_orders_table',1),(6,'2018_01_29_124516_create_items_table',1),(7,'2018_04_30_214330_create_options_table',1),(8,'2018_04_30_214959_create_item_options_table',1),(9,'2018_06_09_202136_create_discounts_table',1),(10,'2018_08_02_164529_create_ships_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` enum('primary','secundary') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,8,'Punta','[{\"value\": \"Sí\",\"image\": \"foto.jpg\"},{\"value\": \"No\",\"image\": \"foto.jpg\"}]','secundary','2018-08-19 15:32:27','2018-08-19 15:32:27'),(2,8,'Armadura','[{\"value\": \"17\",\"image\": \"foto.jpg\"},{\"value\": \"20\",\"image\": \"foto.jpg\"},{\"value\": \"23\",\"image\": \"foto.jpg\"}]','primary','2018-08-19 15:32:27','2018-08-19 15:32:27'),(3,4,'Agujeros','[{\"value\": \"3\",\"image\": \"foto.jpg\"},{\"value\": \"4\",\"image\": \"foto.jpg\"},{\"value\": \"5\",\"image\": \"foto.jpg\"}]','primary','2018-08-19 15:32:27','2018-08-19 15:32:27'),(4,9,'Función','[{\"value\": \"Carga\",\"image\": \"foto.jpg\"},{\"value\": \"Decorativa\",\"image\": \"foto.jpg\"}]','primary','2018-08-19 15:32:27','2018-08-19 15:32:27');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ship_id` int(10) unsigned DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NIF` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `shipping_cost` decimal(8,2) DEFAULT NULL,
  `palos` int(11) DEFAULT NULL,
  `obra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pendiente','aceptado','entregado') COLLATE utf8mb4_unicode_ci NOT NULL,
  `solicitud` int(10) unsigned DEFAULT NULL,
  `albaran` int(10) unsigned DEFAULT NULL,
  `factura` int(10) unsigned DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comercial_comission` int(11) DEFAULT NULL,
  `comercial_id` int(11) DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `transaction` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_solicitud_unique` (`solicitud`),
  UNIQUE KEY `orders_albaran_unique` (`albaran`),
  UNIQUE KEY `orders_factura_unique` (`factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(8,2) NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `views` int(10) unsigned DEFAULT NULL,
  `bought` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `mano` decimal(8,2) DEFAULT NULL,
  `max_size` decimal(8,2) NOT NULL,
  `imagePath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'12/1','12-1','Descripción de las propiedades',12.00,3.18,NULL,NULL,6,3.18,NULL,3.80,NULL,NULL,NULL),(2,'D12/1','D12-1','Descripción de las propiedades',12.00,3.18,NULL,NULL,6,3.18,NULL,1.80,NULL,NULL,NULL),(3,'12/2','12-2','Descripción de las propiedades',14.00,3.50,NULL,NULL,6,3.61,NULL,4.50,NULL,NULL,NULL),(4,'12/3','12-3','Descripción de las propiedades',16.00,3.80,NULL,NULL,6,3.86,NULL,5.10,NULL,NULL,NULL),(5,'12/4','12-4','Descripción de las propiedades',14.00,3.50,NULL,NULL,6,4.41,NULL,5.60,NULL,NULL,NULL),(6,'12/5','12-5','Descripción de las propiedades',16.00,3.80,NULL,NULL,6,4.80,NULL,6.30,NULL,NULL,NULL),(7,'17/1','17-1','Descripción de las propiedades',12.00,3.18,NULL,NULL,7,3.50,NULL,3.60,NULL,NULL,NULL),(8,'17/2','17-2','Descripción de las propiedades',14.00,3.50,NULL,NULL,7,4.00,NULL,4.40,NULL,NULL,NULL),(9,'17/3','17-3','Descripción de las propiedades',16.00,3.80,NULL,NULL,7,4.14,NULL,5.00,NULL,NULL,NULL),(10,'17/4','17-4','Descripción de las propiedades',14.00,3.50,NULL,NULL,7,4.14,NULL,5.40,NULL,NULL,NULL),(11,'17/5','17-5','Descripción de las propiedades',16.00,3.80,NULL,NULL,7,5.86,NULL,6.10,NULL,NULL,NULL),(12,'K-2','K-2','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,3.89,NULL,3.20,NULL,NULL,NULL),(13,'K-3','K-3','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.09,NULL,3.60,NULL,NULL,NULL),(14,'K-4','K-4','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.28,NULL,4.10,NULL,NULL,NULL),(15,'K-5','K-5','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.38,NULL,4.30,NULL,NULL,NULL),(16,'K-6','K-6','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.47,NULL,4.50,NULL,NULL,NULL),(17,'K-7','K-7','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.58,NULL,4.80,NULL,NULL,NULL),(18,'K-8','K-8','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.68,NULL,5.10,NULL,NULL,NULL),(19,'K-9','K-9','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.78,NULL,5.30,NULL,NULL,NULL),(20,'K-10','K-10','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.83,NULL,5.50,NULL,NULL,NULL),(21,'K-11','K-11','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,4.87,NULL,5.90,NULL,NULL,NULL),(22,'K-12','K-12','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,5.06,NULL,6.10,NULL,NULL,NULL),(23,'K-13','K-13','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,5.64,NULL,6.30,NULL,NULL,NULL),(24,'K-14','K-14','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,6.23,NULL,6.55,NULL,NULL,NULL),(25,'K-15','K-15','Descripción de las propiedades',16.00,3.80,NULL,NULL,8,6.81,NULL,7.35,NULL,NULL,NULL),(26,'K-2','K--2','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,3.89,NULL,3.20,NULL,NULL,NULL),(27,'K-3','K--3','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.09,NULL,3.60,NULL,NULL,NULL),(28,'K-4','K--4','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.28,NULL,4.10,NULL,NULL,NULL),(29,'K-5','K--5','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.38,NULL,4.30,NULL,NULL,NULL),(30,'K-6','K--6','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.47,NULL,4.50,NULL,NULL,NULL),(31,'K-7','K--7','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.58,NULL,4.80,NULL,NULL,NULL),(32,'K-8','K--8','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.68,NULL,5.10,NULL,NULL,NULL),(33,'K-9','K--9','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.78,NULL,5.30,NULL,NULL,NULL),(34,'K-10','K--10','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.83,NULL,5.50,NULL,NULL,NULL),(35,'K-11','K--11','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,4.87,NULL,5.90,NULL,NULL,NULL),(36,'K-12','K--12','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,5.06,NULL,6.10,NULL,NULL,NULL),(37,'K-13','K--13','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,5.64,NULL,6.30,NULL,NULL,NULL),(38,'K-14','K--14','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,6.23,NULL,6.55,NULL,NULL,NULL),(39,'K-15','K--15','Descripción de las propiedades',16.00,3.80,NULL,NULL,9,6.81,NULL,7.35,NULL,NULL,NULL),(40,'hinco 10x10','hinco-10x10',NULL,26.00,1.80,NULL,NULL,4,3.00,NULL,2.00,NULL,'2018-08-20 08:42:09','2018-08-20 08:42:09');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ships`
--

DROP TABLE IF EXISTS `ships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('Vacio','Incompleto','Completo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `weights` enum('15000','25000') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order1` int(10) unsigned DEFAULT NULL,
  `order2` int(10) unsigned DEFAULT NULL,
  `order3` int(10) unsigned DEFAULT NULL,
  `order4` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ships`
--

LOCK TABLES `ships` WRITE;
/*!40000 ALTER TABLE `ships` DISABLE KEYS */;
INSERT INTO `ships` VALUES (1,'Vacio',0.00,'15000',NULL,NULL,NULL,NULL,'2018-08-20 08:53:48','2018-08-20 08:53:48');
/*!40000 ALTER TABLE `ships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIF` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comercial_id` int(11) DEFAULT NULL,
  `comercial_comission` int(11) DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `root` tinyint(1) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `comercial` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2018-08-19 15:32:27','2018-08-19 15:32:27','root@example.com','$2y$10$HdiRRG.SzmAyv0V/LQFP4O5mn/pRB/xu0EZRZO06WLid8bhKoun0e','31848383','Nombre','Apellidos','956848383','Razón Social','direccion','ciudad','11600',NULL,NULL,'Cádiz',NULL,NULL,NULL,NULL),(2,'2018-08-19 15:32:27','2018-08-19 15:32:27','cliente20@example.com','$2y$10$ZJlMk7GOzwLi/qYNWHbZsuZC6FB95d/yib5WTJJIe3be7ssLdV.O6','31848384','Cliente 20','Apellidos','956848384','Razón Social','direccion','ciudad','11600',NULL,NULL,'Cádiz',NULL,NULL,NULL,NULL),(3,'2018-08-19 15:32:27','2018-08-19 15:32:27','cliente30@example.com','$2y$10$oRC.N0yKllSjRfySvgZM6OcMi1Ew0SNhvPuCqeFgtbihXit0IR5Je','31848385','Cliente 30','Apellidos','956848385','Razón Social','direccion','ciudad','11600',NULL,NULL,'Cádiz',NULL,NULL,NULL,NULL);
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

-- Dump completed on 2018-08-22 14:26:54
