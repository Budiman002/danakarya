-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: danakarya
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
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
-- Table structure for table `campaign_faqs`
--

DROP TABLE IF EXISTS `campaign_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign_faqs_campaign_id_foreign` (`campaign_id`),
  CONSTRAINT `campaign_faqs_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_faqs`
--

LOCK TABLES `campaign_faqs` WRITE;
/*!40000 ALTER TABLE `campaign_faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_updates`
--

DROP TABLE IF EXISTS `campaign_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_updates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign_updates_campaign_id_foreign` (`campaign_id`),
  CONSTRAINT `campaign_updates_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_updates`
--

LOCK TABLES `campaign_updates` WRITE;
/*!40000 ALTER TABLE `campaign_updates` DISABLE KEYS */;
INSERT INTO `campaign_updates` VALUES (1,5,'Add new book collection!','Halo #OrangBaik,\r\n\r\nKabar gembira dari Nusa Tenggara! 👋\r\n\r\nAlhamdulillah/Puji Syukur, berkat bantuan teman-teman semua, koleksi buku baru untuk perpustakaan mini kami akhirnya telah tiba! 📚✨\r\n\r\nSeperti yang terlihat pada foto, buku-buku ini meliputi buku cerita bergambar, ensiklopedia anak, dan buku pelajaran. Tak sabar rasanya melihat adik-adik di desa berebut memilih buku bacaan baru mereka nanti sore.\r\n\r\nTambahan koleksi ini sangat berarti untuk membuka jendela dunia bagi mereka di sini. Terima kasih banyak karena telah menjadi bagian dari perjalanan literasi mereka.\r\n\r\nSalam hangat🙏','campaign-updates/Le5yfoie3ZZujg8itRqoqKInuMpFqZpq7EBksObO.jpg','2025-12-09 14:57:39','2025-12-09 14:58:52');
/*!40000 ALTER TABLE `campaign_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `faq_goal` text DEFAULT NULL,
  `target_amount` decimal(15,2) NOT NULL,
  `current_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `deadline` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `status` enum('draft','pending','active','funded','completed','cancelled') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `faq_fund_usage` text DEFAULT NULL,
  `faq_timeline` text DEFAULT NULL,
  `faq_custom_1_question` varchar(255) DEFAULT NULL,
  `faq_custom_1_answer` text DEFAULT NULL,
  `faq_custom_2_question` varchar(255) DEFAULT NULL,
  `faq_custom_2_answer` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaigns_slug_unique` (`slug`),
  KEY `campaigns_user_id_foreign` (`user_id`),
  KEY `campaigns_category_id_foreign` (`category_id`),
  CONSTRAINT `campaigns_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `campaigns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` VALUES (1,7,2,'Warung Makan Padang Bu Siti - Ekspansi Cabang Ketiga','warung-makan-padang-bu-siti','Warung makan Padang yang telah berdiri 10 tahun ingin membuka cabang kedua. Dana akan digunakan untuk sewa tempat, renovasi, peralatan dapur, dan modal awal. Target pembukaan 6 bulan ke depan.','Tujuan kami adalah...',100000000.00,45000000.00,'2025-12-12','images/campaigns/Campaign1WarungBusiti.jpeg',NULL,'cancelled','2025-12-03 19:37:08','2025-12-06 02:15:47','Dana akan digunakan untuk...','Campaign akan terealisasi dalam...',NULL,NULL,NULL,NULL),(2,7,1,'Pengrajin Batik Tulis Yogyakarta - Mesin Modern','pengrajin-batik-tulis-yogyakarta','Usaha batik tulis tradisional membutuhkan mesin modern untuk meningkatkan produksi tanpa mengurangi kualitas. Dana untuk mesin pewarna otomatis dan pelatihan karyawan.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',75000000.00,75000000.00,'2026-12-12','images/campaigns/Campaign2BatikTulis.jpeg',NULL,'funded','2025-12-03 19:37:08','2025-12-09 23:37:09','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(3,7,2,'Kedai Kopi Lokal - Roasting Equipment','kedai-kopi-lokal-roasting','Kedai kopi yang menjual biji kopi lokal Gayo membutuhkan mesin roasting profesional untuk meningkatkan kualitas dan kapasitas produksi. Target: 50kg/hari.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',85000000.00,63000000.00,'2026-12-12','images/campaigns/Campaign3KedaiKopi.jpeg',NULL,'active','2025-12-03 19:37:08','2025-12-08 00:35:39','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(4,3,3,'Aplikasi Pembelajaran Bahasa Daerah untuk Anak SD','aplikasi-pembelajaran-bahasa-daerah','Mengembangkan aplikasi mobile untuk pembelajaran bahasa daerah (Jawa, Sunda, Bali) dengan metode gamifikasi. Dana untuk development, ilustrasi, dan testing.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',120000000.00,37000000.00,'2026-04-04','images/campaigns/Campaign4NusantaraApp.jpeg',NULL,'active','2025-12-03 19:37:08','2025-12-08 00:39:53','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(5,2,4,'Perpustakaan Mini untuk Desa Terpencil Nusa Tenggara','perpustakaan-mini-desa-terpencil','Membangun perpustakaan mini dengan 1000 buku untuk anak-anak di desa terpencil. Termasuk rak buku, meja baca, dan program literasi mingguan selama 1 tahun.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',50000000.00,49000000.00,'2025-12-25','images/campaigns/Campaign5PerpustakaanMini.jpeg',NULL,'active','2025-12-03 19:37:08','2025-12-07 17:44:15','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(6,3,5,'Posyandu Mobile untuk Daerah Pegunungan','posyandu-mobile-pegunungan','Mobil posyandu keliling untuk melayani ibu hamil dan balita di daerah pegunungan. Dilengkapi alat kesehatan dasar, obat-obatan, dan tenaga medis terlatih.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',150000000.00,89000000.00,'2026-02-04','images/campaigns/Campaign6PosyanduMobile.jpeg',NULL,'active','2025-12-03 19:37:08','2025-12-06 02:16:39','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(7,2,6,'Bank Sampah Digital - Aplikasi Pengelolaan Sampah','bank-sampah-digital','Sistem digital untuk bank sampah di 10 kelurahan. Warga bisa tracking sampah yang disetorkan, mendapat poin reward, dan edukasi pengelolaan sampah yang benar.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',95000000.00,35000000.00,'2026-03-04','images/campaigns/Campaign7BankSampah.jpeg',NULL,'active','2025-12-03 19:37:08','2025-12-06 02:16:39','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(8,3,1,'Kerajinan Anyaman Bambu - Ekspor Pasar Eropa','kerajinan-anyaman-bambu-ekspor','Pengrajin anyaman bambu tradisional ingin ekspansi ke pasar Eropa. Dana untuk sertifikasi produk, branding, packaging ramah lingkungan, dan marketing online.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',80000000.00,55000000.00,'2026-02-18','images/campaigns/Campaign8KerajinanBambu.jpeg',NULL,'active','2025-12-03 19:37:08','2025-12-06 02:16:39','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(9,2,2,'Brand Fashion Lokal \"Nusantara Wear\" - Online Store','brand-fashion-nusantara-wear','Brand fashion berbahan kain tradisional Indonesia ingin launching online store. Dana untuk fotografi produk, website e-commerce, inventory awal, dan digital marketing 6 bulan.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',110000000.00,73050000.00,'2026-01-25','images/campaigns/Campaign9NusantaraWear.jpeg',NULL,'active','2025-12-03 19:37:08','2025-12-09 18:24:08','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(10,3,3,'Smart Farming IoT untuk Petani Sayuran Organik','smart-farming-iot-organik','Sistem monitoring tanaman otomatis dengan sensor kelembaban, suhu, dan nutrisi tanah. Data real-time via smartphone untuk 20 petani sayuran organik di Bandung.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',135000000.00,18000000.00,'2026-04-04','images/campaigns/Campaign10SmartFarmingIOT.jpeg',NULL,'active','2025-12-03 19:37:08','2025-12-06 02:16:39','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(11,2,2,'Toko Roti & Kue Tradisional - Oven Industrial','toko-roti-kue-tradisional','Alhamdulillah campaign sudah tercapai! Terima kasih para donatur. Oven industrial sudah dibeli dan produksi meningkat 3x lipat.','Tujuan utama campaign ini adalah untuk mengembangkan usaha dan meningkatkan kualitas produk/layanan agar dapat melayani lebih banyak pelanggan.',60000000.00,65000000.00,'2025-11-04','images/campaigns/Campaign11OvenIndustrial.jpeg',NULL,'funded','2025-12-03 19:37:08','2025-12-06 02:16:39','Dana yang terkumpul akan digunakan untuk: 50% renovasi dan perluasan tempat, 30% pembelian peralatan baru, 20% modal operasional dan promosi.','Setelah campaign selesai, kami akan mulai realisasi dalam 2-4 minggu. Progress akan dilaporkan secara berkala kepada semua backers.',NULL,NULL,NULL,NULL),(12,7,2,'Warung Kopi Pak Budi Berkembang','warung-kopi-pak-budi-berkembang','Warung kopi Pak Budi ini sudah berdiri sejak 1998 di daerah Cibubur. Dengan pelanggan setia dan kualitas kopi yang baik, kami ingin mengembangkan usaha dengan menambah peralatan dan memperluas tempat duduk. Dana yang terkumpul akan digunakan untuk renovasi dan pembelian mesin kopi profesional.','Tujuan utamanya adalah mengembangkan warung kopi dengan menambah kapasitas tempat duduk dan meningkatkan kualitas dengan mesin kopi profesional.',500000.00,0.00,'2025-12-30','images/campaigns/1764999870_campaign12.png',NULL,'active','2025-12-05 22:44:30','2025-12-06 03:19:10','70% untuk renovasi dan perluasan tempat duduk\r\n30% untuk mesin kopi espresso profesional\r\n10% untuk peralatan pendukung lainnya','Renovasi akan dimulai 3 minggu setelah target tercapai dan selesai dalam 1-2 bulan. Progress akan dilaporkan setiap minggu.','Apa yang membedakan warung kopi ini?','Kami menggunakan biji kopi lokal langsung dari petani Jawa timur dan menyajikan dengan resep tradisional turun temurun.',NULL,NULL);
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Seni & Budaya','seni-budaya','Campaign untuk seni, musik, film, teater, dan budaya lokal',NULL,'active','2025-12-03 19:37:06','2025-12-03 19:37:06'),(2,'UMKM','umkm','Campaign untuk usaha mikro, kecil, dan menengah',NULL,'active','2025-12-03 19:37:06','2025-12-03 19:37:06'),(3,'Teknologi','teknologi','Campaign untuk inovasi teknologi dan startup',NULL,'active','2025-12-03 19:37:06','2025-12-03 19:37:06'),(4,'Pendidikan','pendidikan','Campaign untuk program pendidikan dan pelatihan',NULL,'active','2025-12-03 19:37:06','2025-12-03 19:37:06'),(5,'Kesehatan','kesehatan','Campaign untuk kesehatan dan kesejahteraan',NULL,'active','2025-12-03 19:37:06','2025-12-03 19:37:06'),(6,'Lingkungan','lingkungan','Campaign untuk pelestarian lingkungan dan sustainability',NULL,'active','2025-12-03 19:37:06','2025-12-03 19:37:06');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disbursements`
--

DROP TABLE IF EXISTS `disbursements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disbursements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `platform_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `net_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_holder` varchar(100) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `creator_notes` text DEFAULT NULL,
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `disbursements_campaign_id_foreign` (`campaign_id`),
  CONSTRAINT `disbursements_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disbursements`
--

LOCK TABLES `disbursements` WRITE;
/*!40000 ALTER TABLE `disbursements` DISABLE KEYS */;
INSERT INTO `disbursements` VALUES (1,2,75000000.00,3750000.00,71250000.00,'BCA - Bank Central Asia','1234567890','John carter','approved','saya ingin tarik uang saya','okee gan','2025-12-09 23:41:07','2025-12-09 23:42:49','2025-12-09 23:42:49');
/*!40000 ALTER TABLE `disbursements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `campaign_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_method` enum('bank_transfer','ewallet','credit_card','midtrans') NOT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','failed') NOT NULL DEFAULT 'pending',
  `transaction_code` varchar(50) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `donations_transaction_code_unique` (`transaction_code`),
  KEY `donations_user_id_foreign` (`user_id`),
  KEY `donations_campaign_id_foreign` (`campaign_id`),
  CONSTRAINT `donations_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donations`
--

LOCK TABLES `donations` WRITE;
/*!40000 ALTER TABLE `donations` DISABLE KEYS */;
INSERT INTO `donations` VALUES (1,1,12,15000.00,'midtrans','947eec3d-0809-4edc-8e02-c46550a7899f',NULL,'pending','DN17650663846734','semangat pak budi','2025-12-06 17:13:04','2025-12-06 17:13:04'),(2,1,6,10000.00,'midtrans','ed162fcc-cd81-44c6-a2a3-85fbcb43ba95',NULL,'pending','DN17650669545954','semangat','2025-12-06 17:22:34','2025-12-06 17:22:35'),(3,1,6,10000.00,'midtrans','5df9cbb9-fa65-49bc-9014-66ea230d7e37',NULL,'pending','DN17650670811774','semangat','2025-12-06 17:24:41','2025-12-06 17:24:41'),(4,1,9,50000.00,'midtrans',NULL,NULL,'confirmed','DN17650785659653','semangat','2025-12-06 20:36:05','2025-12-06 20:36:05'),(5,1,5,1000000.00,'midtrans',NULL,NULL,'confirmed','DN17651546558045','LANJUTKAN GAN','2025-12-07 17:44:15','2025-12-07 17:44:15'),(6,2,3,1000000.00,'midtrans',NULL,NULL,'confirmed','DN17651793396269','keren euy','2025-12-08 00:35:39','2025-12-08 00:35:39'),(7,2,4,12000000.00,'midtrans',NULL,NULL,'confirmed','DN17651795933096','semangat ges!','2025-12-08 00:39:53','2025-12-08 00:39:53'),(8,4,9,1000000.00,'midtrans',NULL,NULL,'confirmed','DN17653298485371',NULL,'2025-12-09 18:24:08','2025-12-09 18:24:08');
/*!40000 ALTER TABLE `donations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_12_02_040704_create_categories_table',1),(5,'2025_12_02_040818_create_campaigns_table',1),(6,'2025_12_02_041047_create_donations_table',1),(7,'2025_12_02_041133_create_campaign_updates_table',1),(8,'2025_12_02_041243_create_campaign_faqs_table',1),(9,'2025_12_02_041408_create_disbursements_table',1),(10,'2025_12_03_003627_add_address_to_users_table',1),(11,'2025_12_06_051500_add_faq_to_campaigns_table',2),(12,'2025_12_06_234324_add_snap_token_to_donations_table',3),(13,'2025_12_07_001203_add_midtrans_to_payment_method_enum',4),(14,'2025_12_10_010656_create_notifications_table',5),(15,'2025_12_10_061433_update_disbursements_table_add_admin_note',6),(16,'2025_12_10_062308_add_platform_fee_to_disbursements_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_is_read_index` (`user_id`,`is_read`),
  KEY `notifications_created_at_index` (`created_at`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,2,'new_donation','💰 New Donation Received!','Ahmad Wijaya just donated Rp 1.000.000 to your campaign: Brand Fashion Lokal \"Nusantara Wear\" - Online Store','{\"donation_id\":8,\"campaign_id\":\"9\",\"amount\":\"1000000.00\",\"donor_name\":\"Ahmad Wijaya\"}',0,NULL,'2025-12-09 18:24:08','2025-12-09 18:24:08'),(2,4,'donation_success','✅ Donation Successful!','Your donation of Rp 1.000.000 to Brand Fashion Lokal \"Nusantara Wear\" - Online Store was successful. Thank you for your support!','{\"donation_id\":8,\"campaign_id\":\"9\",\"campaign_slug\":\"brand-fashion-nusantara-wear\",\"amount\":\"1000000.00\"}',0,NULL,'2025-12-09 18:24:08','2025-12-09 18:24:08'),(3,1,'new_withdrawal_request','💰 New Withdrawal Request','John Creator has requested withdrawal for campaign \"Pengrajin Batik Tulis Yogyakarta - Mesin Modern\"','{\"disbursement_id\":1,\"campaign_id\":2,\"amount\":71250000}',1,'2025-12-09 23:43:00','2025-12-09 23:41:07','2025-12-09 23:43:00'),(4,7,'withdrawal_approved','✅ Withdrawal Request Approved','Your withdrawal request for campaign \"Pengrajin Batik Tulis Yogyakarta - Mesin Modern\" has been approved. The amount of Rp 71.250.000 will be transferred to your bank account within 3-5 business days.','{\"disbursement_id\":1,\"campaign_id\":2,\"amount\":\"71250000.00\"}',1,'2025-12-09 23:43:24','2025-12-09 23:42:49','2025-12-09 23:43:24');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES ('mG45YH2LoFNlutZvvOjqFVaqHno1jkxMV60n0r4V',7,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:145.0) Gecko/20100101 Firefox/145.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOTc1NnhWTFdhOWR0VmtwRGFtb2xkWm5pOFQwTE1Dd01ob21aT0tLRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jcmVhdG9yL2Rpc2J1cnNlbWVudHMiO3M6NToicm91dGUiO3M6Mjc6ImNyZWF0b3IuZGlzYnVyc2VtZW50cy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7czo2OiJsb2NhbGUiO3M6MjoiaWQiO30=',1765352443),('XXjMBK2GfzZ0gh07Z037K1HiZA3E9j6NsEWX7uzC',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:145.0) Gecko/20100101 Firefox/145.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSFVwWk1SNE9FRExlTU9LVGxRRlJ6V1BTSXhCcnI3dTNuaDVROWRjbSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2NyZWF0b3IvZGlzYnVyc2VtZW50cyI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1765370401);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','creator','backer') NOT NULL DEFAULT 'backer',
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin DanaKarya','admin@danakarya.com',NULL,'$2y$12$DlhqzT52WTRu2l58L0Hewe0sZAIhsyv4EyhwHwDlM.92SEibl9DJO','admin',NULL,'Administrator platform DanaKarya',NULL,NULL,'gKj2ip62Sy8DiBYqMsdxkDLnCqA0sc6lDe1CjuQOp16euV0clMbk5GOOOWr9','2025-12-03 19:37:06','2025-12-03 19:37:06'),(2,'Ibu Siti','siti@example.com',NULL,'$2y$12$YT6YNesLwTCCO/QHmMtj1e.waWjtud4FSkOCkLn/J0tuUfJYTQDnW','creator',NULL,'Pemilik Warung Makan Padang Ibu Siti','081234567890',NULL,NULL,'2025-12-03 19:37:06','2025-12-03 19:37:06'),(3,'Budi Santoso','budi@example.com',NULL,'$2y$12$MdTS5K1UkECs8i0ToKWqzOcFQApG.Z76/MxWavZ0RDBEF0j3M4k6S','creator',NULL,'Pengrajin batik tulis dari Solo','081234567891',NULL,NULL,'2025-12-03 19:37:07','2025-12-03 19:37:07'),(4,'Ahmad Wijaya','ahmad@example.com',NULL,'$2y$12$dYBfxiM2wOsxWls/pgpAMezu3cwyXfnqIgwDP9EOZurU.Jfn.ut0S','backer',NULL,'Mahasiswa yang suka support UMKM lokal',NULL,NULL,NULL,'2025-12-03 19:37:07','2025-12-03 19:37:07'),(5,'Rina Kusuma','rina@example.com',NULL,'$2y$12$gSxLx3VTuuxFe0cycRZHRObQDcHmdQb1Pw2ifbQFAYsuZcOYRjJsC','backer',NULL,NULL,NULL,NULL,NULL,'2025-12-03 19:37:07','2025-12-03 19:37:07'),(6,'Dimas Prasetyo','dimas@example.com',NULL,'$2y$12$9R6JwfXhHH9lMpuBjNzWYO4.LEydnkKcIKPe5Fat1jztt0bC3mzGq','backer',NULL,NULL,NULL,NULL,NULL,'2025-12-03 19:37:08','2025-12-03 19:37:08'),(7,'John Creator','creator@danakarya.com',NULL,'$2y$12$c5VI0lwbxRKapOoAw/q15uVNbLtigwm5GacAHWevlkq95Xvunufda','creator',NULL,NULL,NULL,NULL,NULL,'2025-12-05 21:36:31','2025-12-05 21:36:31');
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

-- Dump completed on 2025-12-10 19:50:16
