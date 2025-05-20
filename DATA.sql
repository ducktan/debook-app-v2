-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: db_debook
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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel_cache_123@gmail.com|127.0.0.1','i:2;',1747560269),('laravel_cache_123@gmail.com|127.0.0.1:timer','i:1747560269;',1747560269),('laravel_cache_duck@debook.vn|127.0.0.1','i:1;',1747560251),('laravel_cache_duck@debook.vn|127.0.0.1:timer','i:1747560251;',1747560251);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (6,'Nội dung độc quyền VIP','noi-dung-doc-quyen-vip','Thư viện tài nguyên chỉ dành riêng cho thành viên VIP.','1747733815.png','2025-05-11 06:27:40','2025-05-20 09:36:55',NULL),(17,'Văn học','van-hoc','Mô tả cho danh mục Văn học','cat1.png','2025-05-20 09:35:58','2025-05-20 09:35:58',NULL),(18,'Kỹ năng sống','ky-nang-song','Mô tả cho danh mục Kỹ năng sống','cat2.png','2025-05-20 09:35:58','2025-05-20 09:35:58',NULL),(19,'Tâm lý – Giáo dục','tam-ly-giao-duc','Mô tả cho danh mục Tâm lý – Giáo dục','cat3.png','2025-05-20 09:35:58','2025-05-20 09:35:58',NULL),(20,'Thiếu nhi','thieu-nhi','Mô tả cho danh mục Thiếu nhi','cat1.png','2025-05-20 09:35:58','2025-05-20 09:35:58',NULL),(21,'Kinh tế','kinh-te','Mô tả cho danh mục Kinh tế','cat2.png','2025-05-20 09:35:58','2025-05-20 09:35:58',NULL),(22,'Podcast truyền cảm hứng','podcast-truyen-cam-hung','Mô tả cho danh mục Podcast truyền cảm hứng','cat3.png','2025-05-20 09:35:58','2025-05-20 09:35:58',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_product_id_foreign` (`product_id`),
  CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (97,9,61,'Bài học đáng giá cho ai đang tìm hướng đi trong nghề nghiệp.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(98,5,61,'Đọc xong muốn hành động ngay.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(99,19,62,'Chất lượng bản ghi tốt, nội dung truyền cảm hứng.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(100,15,62,'Nghe đi nghe lại nhiều lần vẫn thấy hay.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(101,16,63,'Cần kiên nhẫn để thấm, nhưng rất giá trị.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(102,5,63,'Không phù hợp người mới bắt đầu.',3,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(103,9,64,'Bài giảng rõ ràng, cách truyền đạt chuyên nghiệp.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(104,19,64,'Cần có kiến thức nền thì mới dễ hiểu.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(105,15,65,'Một trong những cuốn mình tâm đắc nhất năm nay.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(106,16,65,'Sẽ giới thiệu cho bạn bè chắc chắn.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(107,5,65,'Không hối hận khi mua.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(108,9,66,'Podcast nhẹ nhàng mà sâu sắc, rất dễ đồng cảm.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(109,19,66,'Chất giọng phù hợp với chủ đề.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(110,5,67,'Giá cao nhưng đáng với những gì nhận được.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(111,15,67,'Nội dung rất “đời”, không màu mè.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(112,16,68,'Một số phần trùng lặp, nhưng vẫn học được nhiều.',3,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(113,9,68,'Tác giả dẫn dắt tốt, ví dụ gần gũi.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(114,19,69,'Cảm giác như được “thức tỉnh”.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(115,5,69,'Sách hay, in đẹp, trình bày logic.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(116,15,70,'Không phù hợp với mình lắm, nhưng nhiều người sẽ thích.',3,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(117,9,70,'Giá cao so với nội dung.',3,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(118,16,71,'Đọc xong muốn thay đổi thói quen ngay.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(119,5,71,'Thực tiễn, không lan man.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(120,19,72,'Sách gối đầu giường. Quá hay!',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(121,15,72,'Có chiều sâu nhưng hơi khó tiếp cận cho người mới.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(122,9,73,'Lắng nghe podcast này mỗi sáng là thói quen của mình.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(123,16,73,'Nội dung chất lượng, lồng nhạc rất ổn.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(124,5,74,'Không ngờ lại thích đến vậy. Rất bất ngờ.',5,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(125,19,74,'Học được nhiều bài học đáng giá.',4,'2025-05-20 09:54:03','2025-05-20 09:54:03'),(127,2,84,'Thường thôi',4,'2025-05-20 10:25:09','2025-05-20 10:25:09'),(129,23,55,'Hay, ý nghĩa',4,'2025-05-20 10:45:22','2025-05-20 10:45:22');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_04_24_085128_create_categories_table',1),(5,'2025_04_24_085349_create_products_table',1),(6,'2025_04_25_063529_create_comments_table',1),(7,'2025_04_25_063919_create_posts_table',1),(8,'2025_04_25_064510_create_payments_table',1),(9,'2025_04_25_065158_create_subscriptions_table',1),(10,'2025_04_25_065940_create_product_subscriptions_table',1),(11,'2025_04_25_070019_create_user_subscriptions_table',1),(12,'2025_04_30_144855_create_orders_table',1),(13,'2025_04_30_145002_create_order_items_table',1),(14,'2025_05_01_130801_create_user_products_table',1),(15,'2025_05_12_224439_add_image_url_to_posts_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (9,299,55,150000,2,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(10,299,57,300000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(11,300,60,750000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(12,301,58,500000,3,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(13,301,63,1200000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(14,302,67,800000,2,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(15,303,55,150000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(16,303,70,900000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(17,304,66,2200000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(18,305,74,10000000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(19,306,59,600000,3,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(20,307,61,450000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(21,307,64,350000,2,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(22,308,56,200000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(23,309,68,700000,2,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(24,310,65,550000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(25,310,62,400000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(26,311,69,1300000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(27,312,71,2600000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(28,312,55,150000,2,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(29,313,73,8500000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(30,314,57,300000,3,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(31,315,59,600000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(32,316,60,750000,2,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(33,317,66,2200000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(34,318,68,700000,2,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(35,319,62,400000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(36,320,61,450000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(37,321,64,350000,1,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(38,322,65,550000,3,'2025-05-20 10:01:31','2025-05-20 10:01:31'),(39,329,68,8900000,2,'2025-05-20 10:33:36','2025-05-20 10:33:36'),(40,329,65,250000,3,'2025-05-20 10:33:36','2025-05-20 10:33:36'),(41,329,61,99,1,'2025-05-20 10:33:36','2025-05-20 10:33:36'),(42,330,68,8900000,2,'2025-05-20 10:34:00','2025-05-20 10:34:00'),(43,330,65,250000,3,'2025-05-20 10:34:00','2025-05-20 10:34:00'),(44,331,55,10000,1,'2025-05-20 10:45:51','2025-05-20 10:45:51'),(45,331,66,3200000,1,'2025-05-20 10:45:51','2025-05-20 10:45:51'),(47,333,1,49000,1,'2025-05-20 13:08:38','2025-05-20 13:08:38');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `codeVNPAY` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_codevnpay_unique` (`codeVNPAY`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,2,'DEB059070','completed',240000,'2025-05-11 06:39:29','2025-05-11 06:39:54'),(2,2,'DEB374672','completed',1500000,'2025-05-11 10:16:13','2025-05-11 10:16:36'),(3,2,'DEB6821B4309EE01','completed',399000,'2025-05-12 08:41:20','2025-05-12 08:41:47'),(4,2,'DEB6821B513A13BD','completed',49000,'2025-05-12 08:45:07','2025-05-12 08:45:21'),(5,2,'DEB993894','completed',120000,'2025-05-18 12:15:36','2025-05-18 15:29:40'),(16,15,'VNPAY00001','pending',1500000,'2025-05-10 03:30:00','2025-05-10 03:30:00'),(17,16,'VNPAY00002','completed',2500000,'2025-05-09 08:20:00','2025-05-09 08:20:00'),(18,NULL,'VNPAY00003','cancelled',500000,'2025-05-08 06:45:00','2025-05-08 06:45:00'),(19,15,'VNPAY00004','completed',1000000,'2025-05-07 02:10:00','2025-05-18 15:29:46'),(20,15,'VNPAY00005','completed',2000000,'2025-05-06 10:00:00','2025-05-06 10:00:00'),(21,16,'VNPAY00006','cancelled',1800000,'2025-05-05 13:15:00','2025-05-05 13:15:00'),(23,15,'VNPAY00008','completed',3000000,'2025-05-03 07:30:00','2025-05-03 07:30:00'),(25,16,'VNPAY00010','pending',900000,'2025-05-01 09:45:00','2025-05-01 09:45:00'),(26,NULL,'DEB051828','completed',360000,'2025-05-18 15:06:48','2025-05-18 15:07:35'),(27,2,'DEB651064','completed',120000,'2025-05-20 05:01:27','2025-05-20 05:02:02'),(28,2,'DEB944984','completed',120000,'2025-05-20 06:19:06','2025-05-20 06:19:27'),(299,19,'DEB3008214567','completed',250000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(300,16,'DEB9831205478','pending',1500000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(301,5,'DEB6723459831','cancelled',500000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(302,15,'DEB4589123746','completed',3000000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(303,9,'DEB2398746512','pending',750000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(304,19,'DEB1023587465','completed',1200000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(305,16,'DEB9876543210','cancelled',600000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(306,5,'DEB4567891234','pending',450000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(307,15,'DEB1234567890','completed',900000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(308,9,'DEB6543219876','completed',200000,'2025-05-20 09:59:23','2025-05-20 13:14:40'),(309,19,'DEB5432109876','pending',1750000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(310,16,'DEB8765432109','completed',2400000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(311,5,'DEB1928374650','cancelled',700000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(312,15,'DEB5647382910','completed',3200000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(313,9,'DEB8374651920','pending',800000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(314,19,'DEB9112233445','completed',1300000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(315,16,'DEB6263547890','cancelled',550000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(316,5,'DEB1827364950','pending',480000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(317,15,'DEB3748291056','completed',950000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(318,9,'DEB9183746502','pending',210000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(319,19,'DEB5147382910','completed',2700000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(320,16,'DEB8174652039','pending',1600000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(321,5,'DEB9112736450','cancelled',650000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(322,15,'DEB7263548190','completed',3100000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(323,9,'DEB1827364951','pending',820000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(324,19,'DEB3748291057','completed',1250000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(325,16,'DEB9183746503','cancelled',600000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(326,5,'DEB5647382911','pending',470000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(327,15,'DEB8274652030','completed',980000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(328,9,'DEB9182736450','pending',220000,'2025-05-20 09:59:23','2025-05-20 09:59:23'),(329,NULL,'DEB014026','pending',18550099,'2025-05-20 10:33:36','2025-05-20 10:33:36'),(330,NULL,'DEB929907','pending',18550000,'2025-05-20 10:34:00','2025-05-20 10:34:00'),(331,23,'DEB024183','completed',3210000,'2025-05-20 10:45:51','2025-05-20 10:46:14'),(333,23,'DEB682C7ED6A6302','completed',49000,'2025-05-20 13:08:38','2025-05-20 13:08:52');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_product_id_foreign` (`product_id`),
  CONSTRAINT `payments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `audio_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (4,2,'demo2','111',NULL,'images/mN9R3ZDsjJ5wa7rYziqoDGfpp6Yes3gByvxoKlgG.jpg','2025-05-17 09:59:27','2025-05-17 09:59:27'),(5,2,'Lần đầu Viết blog','Hello, hôm nay tui rất zui luôn và tui muốn hát nè',NULL,'images/ZnwSwLyLhnioQDgiXvXbi9gzzlKVaJol261wNVXu.jpg','2025-05-17 10:04:12','2025-05-17 10:04:12'),(6,23,'Tớ mệt quá','Hôm nay đi dạo hong',NULL,'images/PkZEu99nRa2QG8ZoprsRZ7wlfCOI560sbm8nRdkq.jpg','2025-05-20 13:09:34','2025-05-20 13:09:34');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_subscriptions`
--

DROP TABLE IF EXISTS `product_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `subscription_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_subscriptions_product_id_subscription_id_unique` (`product_id`,`subscription_id`),
  KEY `product_subscriptions_subscription_id_foreign` (`subscription_id`),
  CONSTRAINT `product_subscriptions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_subscriptions_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_subscriptions`
--

LOCK TABLES `product_subscriptions` WRITE;
/*!40000 ALTER TABLE `product_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `language` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Sách demo 3',NULL,'Admin','ebook',18,NULL,15000.00,NULL,'1747746413.jpg',5,'vi',0,'2025-05-20 13:06:12','2025-05-20 13:07:25'),(2,'Sách demo 2',NULL,'Admin','ebook',20,NULL,15000.00,NULL,'1747746420.jpg',5,'vi',0,'2025-05-20 13:06:03','2025-05-20 13:07:20'),(3,'Sách demo','Hello cả nhà','Admin','ebook',17,'2025-05-20',12000.00,'Cm5zPckPPju4u5apkWmzpeU5jrJj9cxmvBmNnzgX.jpg','AIoFN00tncVd5XmnaJ4XxojWzEFjv76EHeuGVGTY.png',5,'vi',0,'2025-05-20 13:05:35','2025-05-20 13:05:35'),(55,'Bí mật của sự tĩnh lặng','Một hành trình khám phá sức mạnh của sự im lặng trong thế giới ồn ào.','Nguyễn Nhật Ánh','ebook',17,NULL,10000.00,'sample.pdf','p1.jpg',0,'vi',4,'2025-05-20 09:44:50','2025-05-20 09:47:10'),(56,'Dũng cảm sống thật','Cuốn podcast truyền cảm hứng về việc sống đúng với giá trị bản thân, vượt qua nỗi sợ và định kiến xã hội.','Lê Hồng Nhung','podcast',17,'2025-02-19',0.00,'sample.mp3','p2.jpg',42,'vi',4.2,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(57,'Deep Work - Làm việc sâu để thành công','Phương pháp làm việc không bị phân tâm giúp bạn đạt hiệu quả vượt trội.','Cal Newport','ebook',18,'2024-11-01',89.00,'sample.pdf','p3.jpg',0,'en',4.8,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(58,'Nuôi dưỡng đứa trẻ bên trong bạn','Chữa lành tổn thương thời thơ ấu và học cách yêu thương bản thân một cách trọn vẹn.','Thái Hà','ebook',19,'2024-07-24',65.00,'sample.pdf','p4.jpg',0,'vi',4.6,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(59,'Sức mạnh của thói quen','Tại sao chúng ta làm điều mình làm, và làm sao để thay đổi hành vi một cách bền vững.','Charles Duhigg','ebook',20,'2024-11-21',79.00,'sample.pdf','p5.jpg',0,'en',4.7,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(60,'Tỉnh thức giữa cuộc đời bận rộn','Podcast nhẹ nhàng giúp bạn dừng lại, hít thở và sống trọn vẹn từng khoảnh khắc.','Minh Thư','podcast',21,'2025-03-21',0.00,'sample.mp3','p1.jpg',35,'vi',4.3,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(61,'The Power of Now','Khám phá giá trị hiện tại, từ bỏ quá khứ và thôi lo âu về tương lai.','Eckhart Tolle','ebook',22,'2024-04-15',99.00,'sample.pdf','p2.jpg',0,'en',4.9,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(62,'Khởi đầu mới mỗi ngày','Podcast mang đến năng lượng tích cực và nhắc nhở bạn về giá trị của từng ngày sống.','Lan Hương','podcast',6,'2025-04-20',0.00,'sample.mp3','p3.jpg',28,'vi',4.1,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(63,'Thiền và sự tự do nội tại','Hành trình đi vào bên trong để tìm sự bình an và hiểu rõ chính mình.','Thích Nhất Hạnh','ebook',17,'2024-05-20',55.00,'sample.pdf','p4.jpg',0,'vi',4.8,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(64,'Podcast: Kể chuyện đêm khuya','Những câu chuyện nhẹ nhàng giúp bạn thư giãn trước khi ngủ.','Phạm An','podcast',18,'2025-05-05',0.00,'sample.mp3','p5.jpg',33,'vi',4,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(65,'Lãnh đạo cấp độ 5','Khám phá phẩm chất của những nhà lãnh đạo khiêm nhường nhưng cực kỳ quyết đoán trong những tập đoàn vĩ đại.','Jim Collins','ebook',19,'2023-09-28',250000.00,'sample.pdf','p1.jpg',0,'vi',4.9,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(66,'Nghệ thuật đầu tư Dhandho','Cách đầu tư khôn ngoan và rủi ro thấp dựa trên tư duy kinh doanh truyền thống của người Ấn.','Mohnish Pabrai','ebook',20,'2024-01-06',3200000.00,'sample.pdf','p2.jpg',0,'en',4.7,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(67,'Chạm vào sự bất tử','Podcast dẫn dắt bạn vào thế giới của triết học, tôn giáo và cái đẹp vượt thời gian.','Thiền sư Trần Tâm','podcast',21,'2024-07-24',10000.00,'sample.mp3','p3.jpg',58,'vi',4.6,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(68,'Xây dựng thương hiệu cá nhân triệu đô','Làm sao để biến bản thân thành một thương hiệu đáng tin cậy và kiếm tiền từ đó.','Gary Vaynerchuk','ebook',22,'2024-11-01',8900000.00,'sample.pdf','p4.jpg',0,'en',3,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(69,'Tái cấu trúc tâm trí','Một cái nhìn sâu sắc về cách hoạt động của não bộ và làm thế nào để kiểm soát suy nghĩ tiêu cực.','Daniel Goleman','ebook',6,'2024-02-25',170000.00,'sample.pdf','p5.jpg',0,'vi',4.5,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(70,'Giác ngộ giữa phố thị','Podcast kể lại hành trình đi tìm ý nghĩa sống giữa nhịp sống hiện đại xô bồ.','Huyền My','podcast',17,'2024-12-21',52000.00,'sample.mp3','p1.jpg',40,'vi',4.2,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(71,'Data-Driven Marketing','Tối ưu chiến lược tiếp thị bằng dữ liệu: công nghệ, AI và hành vi người tiêu dùng.','Thomas Redman','ebook',18,'2025-02-09',9999999.00,'sample.pdf','p2.jpg',0,'en',4.9,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(72,'Sức mạnh của sự trì hoãn có chủ đích','Phá bỏ định kiến về sự lười biếng và cách biến nó thành công cụ sáng tạo.','Adam Grant','ebook',19,'2025-03-31',420000.00,'sample.pdf','p3.jpg',0,'en',4.6,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(73,'Trí tuệ tài chính cá nhân','Podcast hướng dẫn từ A-Z về quản lý tài chính cho người mới bắt đầu đến chuyên gia.','Lâm Quang Nhật','podcast',20,'2025-03-11',205000.00,'sample.mp3','p4.jpg',37,'vi',4.4,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(74,'Rework - Tái thiết lập tư duy làm việc','Tư duy mới mẻ, cắt giảm sự phức tạp, làm ít hơn mà hiệu quả hơn.','Jason Fried & DHH','ebook',22,'2025-04-30',640000.00,'sample.pdf','p5.jpg',0,'en',4.7,'2025-05-20 09:44:50','2025-05-20 09:44:50'),(75,'Lãnh đạo cấp độ 5','Khám phá phẩm chất của những nhà lãnh đạo khiêm nhường nhưng cực kỳ quyết đoán trong những tập đoàn vĩ đại.','Jim Collins','ebook',19,'2023-09-28',250000.00,'sample.pdf','p1.jpg',0,'vi',4.9,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(76,'Nghệ thuật đầu tư Dhandho','Cách đầu tư khôn ngoan và rủi ro thấp dựa trên tư duy kinh doanh truyền thống của người Ấn.','Mohnish Pabrai','ebook',20,'2024-01-06',3200000.00,'sample.pdf','p2.jpg',0,'en',4.7,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(77,'Chạm vào sự bất tử','Podcast dẫn dắt bạn vào thế giới của triết học, tôn giáo và cái đẹp vượt thời gian.','Thiền sư Trần Tâm','podcast',21,'2024-07-24',10000.00,'sample.mp3','p3.jpg',58,'vi',4.6,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(78,'Xây dựng thương hiệu cá nhân triệu đô','Làm sao để biến bản thân thành một thương hiệu đáng tin cậy và kiếm tiền từ đó.','Gary Vaynerchuk','ebook',22,'2024-11-01',8900000.00,'sample.pdf','p4.jpg',0,'en',4.8,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(79,'Tái cấu trúc tâm trí','Một cái nhìn sâu sắc về cách hoạt động của não bộ và làm thế nào để kiểm soát suy nghĩ tiêu cực.','Daniel Goleman','ebook',6,'2024-02-25',170000.00,'sample.pdf','p5.jpg',0,'vi',4.5,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(80,'Giác ngộ giữa phố thị','Podcast kể lại hành trình đi tìm ý nghĩa sống giữa nhịp sống hiện đại xô bồ.','Huyền My','podcast',17,'2024-12-21',52000.00,'sample.mp3','p1.jpg',40,'vi',4.2,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(81,'Data-Driven Marketing','Tối ưu chiến lược tiếp thị bằng dữ liệu: công nghệ, AI và hành vi người tiêu dùng.','Thomas Redman','ebook',18,'2025-02-09',9999999.00,'sample.pdf','p2.jpg',0,'en',4.9,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(82,'Sức mạnh của sự trì hoãn có chủ đích','Phá bỏ định kiến về sự lười biếng và cách biến nó thành công cụ sáng tạo.','Adam Grant','ebook',19,'2025-03-31',420000.00,'sample.pdf','p3.jpg',0,'en',4.6,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(83,'Trí tuệ tài chính cá nhân','Podcast hướng dẫn từ A-Z về quản lý tài chính cho người mới bắt đầu đến chuyên gia.','Lâm Quang Nhật','podcast',20,'2025-03-11',205000.00,'sample.mp3','p4.jpg',37,'vi',4.4,'2025-05-20 09:52:09','2025-05-20 09:52:09'),(84,'Rework - Tái thiết lập tư duy làm việc','Tư duy mới mẻ, cắt giảm sự phức tạp, làm ít hơn mà hiệu quả hơn.','Jason Fried & DHH','ebook',22,'2025-04-30',640000.00,'sample.pdf','p5.jpg',0,'en',4,'2025-05-20 09:52:09','2025-05-20 09:52:09');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('lQ9qw5Q0t4A0p4ax4ShDWxNouBgtHBXioItUoFr2',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiS0V2WGc5dzZJY3hycGdzRW83UmJwVkNPM2ZOanV0SHhFb3Vrd1hZUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9leHBvcnQtcmVwb3J0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDc3NDY2MDE7fX0=',1747746921);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `duration` int NOT NULL,
  `duration_unit` enum('days','months','years') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'months',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,'Gói 1 tháng','Truy cập Sách Hội viên trong vòng 1 tháng.',49000.00,1,'months','2025-05-12 07:02:23','2025-05-12 07:02:23'),(2,'Gói 3 tháng','Truy cập Sách Hội viên trong vòng 3 tháng.',129000.00,3,'months','2025-05-12 07:02:23','2025-05-12 07:02:23'),(3,'Gói 1 năm','Truy cập Sách Hội viên trong vòng 12 tháng.',399000.00,12,'months','2025-05-12 07:02:23','2025-05-12 07:02:23');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_products`
--

DROP TABLE IF EXISTS `user_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_products_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `user_products_product_id_foreign` (`product_id`),
  CONSTRAINT `user_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_products`
--

LOCK TABLES `user_products` WRITE;
/*!40000 ALTER TABLE `user_products` DISABLE KEYS */;
INSERT INTO `user_products` VALUES (5,23,55,NULL,NULL),(6,23,66,NULL,NULL);
/*!40000 ALTER TABLE `user_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_subscriptions`
--

DROP TABLE IF EXISTS `user_subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `subscription_id` bigint unsigned NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','expired','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_subscriptions_user_id_foreign` (`user_id`),
  KEY `user_subscriptions_subscription_id_foreign` (`subscription_id`),
  CONSTRAINT `user_subscriptions_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_subscriptions`
--

LOCK TABLES `user_subscriptions` WRITE;
/*!40000 ALTER TABLE `user_subscriptions` DISABLE KEYS */;
INSERT INTO `user_subscriptions` VALUES (3,2,1,'2025-05-12','2025-06-12','active','2025-05-12 08:45:21','2025-05-12 08:45:21'),(4,23,1,'2025-05-20','2025-06-20','active','2025-05-20 13:08:52','2025-05-20 13:08:52');
/*!40000 ALTER TABLE `user_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USR' COMMENT 'ADM for Admin and USR for User or Customer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2025-05-11 06:27:40','$2y$12$JSXz8Wk/z0HaLIbMCWdF6Ogrldn8LtoRblqGGK3891sgGKw0VgIUa',NULL,NULL,NULL,'USR','n2Ms0aqshi','2025-05-11 06:27:40','2025-05-11 06:27:40'),(2,'acc1','acc-demo-1@debook.vn',NULL,'$2y$12$gfcjcnvPn9A69crGDcd9BeH4r6do3FZcKCA8znH6JbZ3CL5xxfsbO','0900123456','Admin','1747570840.png','ADM',NULL,'2025-05-11 06:36:38','2025-05-18 12:20:40'),(5,'acc2','acc-demo-2@debook.vn',NULL,'$2y$12$mC1i98EuvoJD7rxNIuuQcucIP22a0mQp7NNEnz.aGVURVajYaDWNK',NULL,'Tấn Đức',NULL,'USR',NULL,'2025-05-12 09:46:57','2025-05-12 09:46:57'),(9,'demo22','123@gmail.com',NULL,'$2y$12$pNcAKEURpIrLBG/IerAT0umpwYvZ4crGsfycAuLdYWjPbBYtMo8ai','0949076780','Nguyễn Đức Tấn12','1747495266.jpg','USR',NULL,'2025-05-17 14:32:08','2025-05-17 15:33:34'),(15,'test1','acc-demo-1@debook.vn11',NULL,'$2y$12$pBxyt7iDTerdUSkGO5RWzetJVL4pgwfk0O8zmzcED.SWULBu1mQZq','0900123456','Khách hàng 1','1747560130.jpg','USR',NULL,'2025-05-17 15:36:23','2025-05-18 09:22:10'),(16,'an-quanly','annv-ql@debook.vn',NULL,'$2y$12$jKpccTXJgUxda///KcWUH.H8LPzRnO34iQa3gLYgQtywAUWCPbwNC','0865111349','Nguyễn Văn Tuấn An','1747559667.png','ADM',NULL,'2025-05-18 06:12:14','2025-05-18 09:14:27'),(19,'Tài Đức','tieula.9030@gmail.com',NULL,'$2y$12$V38hyLpfkTfRihefu8pKJ.eNZ0aoSqnskk15zq1IMUWGlaFBfapkm','0909999112','Nguyễn Văn Tài','1747732254.png','VIP',NULL,'2025-05-20 09:10:02','2025-05-20 09:47:41'),(23,'acc2','acc-2-demo@gmail.com',NULL,'$2y$12$hBrsJJETr7glFg92lZFEYOQaHxRt/PPSBJ8SNVqPpqiaWm84QQXtW','0949076667','Nguyễn Văn An','1747737852.jpg','VIP',NULL,'2025-05-20 10:43:47','2025-05-20 13:08:52');
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

-- Dump completed on 2025-05-20 20:43:21
