-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for onestore_db
DROP DATABASE IF EXISTS `onestore_db`;
CREATE DATABASE IF NOT EXISTS `onestore_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `onestore_db`;

-- Dumping structure for table onestore_db.tbl_admin
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `adminID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `firstName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('super_admin','admin','manager') COLLATE utf8mb4_general_ci DEFAULT 'admin',
  `permissions` text COLLATE utf8mb4_general_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_admin: ~2 rows (approximately)
INSERT INTO `tbl_admin` (`adminID`, `username`, `email`, `password`, `firstName`, `lastName`, `avatar`, `role`, `permissions`, `last_login`, `status`, `created_at`) VALUES
	(1, 'admin', 'admin@onestore.com', '$2y$12$EuN4RkSC1clXzxlGPkDHluX5UZNnlCmL0mpAwOPbcpIbLrgekPeH.', 'Admin', 'User', NULL, 'super_admin', NULL, '2025-06-03 01:34:00', 1, '2025-06-03 01:13:39'),
	(2, 'manager', 'manager@onestore.com', '$2y$12$zMLi4wNr9tDIi.PEnfT3YOIjGwwOn54NsDTt9x2jyJR0E6a2svzKm', 'Manager', 'User', NULL, 'manager', NULL, '2025-06-03 08:47:04', 1, '2025-06-03 01:13:39');

-- Dumping structure for table onestore_db.tbl_brand
DROP TABLE IF EXISTS `tbl_brand`;
CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brandID` int NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`brandID`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_brand: ~2 rows (approximately)
INSERT INTO `tbl_brand` (`brandID`, `brandName`, `slug`, `description`, `logo`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'TechBrand', 'techbrand', 'Leading technology brand', 'brands/brand_683eb3821bff7.jpg', 1, '2025-06-03 01:13:39', '2025-06-03 08:34:10'),
	(2, 'FashionCorp', 'fashioncorp', 'Premium fashion brand', 'brands/brand_683eb398a8577.jpg', 1, '2025-06-03 01:13:39', '2025-06-03 08:34:32'),
	(3, 'Fashion Corp', 'fashion-corp', '', 'brands/brand_683eb4171392b.jpg', 0, '2025-06-03 08:36:39', '2025-06-03 08:37:14');

-- Dumping structure for table onestore_db.tbl_cart
DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cartID` int NOT NULL AUTO_INCREMENT,
  `customerID` int DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `productID` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cartID`),
  KEY `customerID` (`customerID`),
  KEY `productID` (`productID`),
  CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_cart: ~0 rows (approximately)
INSERT INTO `tbl_cart` (`cartID`, `customerID`, `session_id`, `productID`, `quantity`, `created_at`, `updated_at`) VALUES
	(5, NULL, '7e6800ff6741728b2791872aadd3079a', 1, 1, '2025-06-02 20:48:32', '2025-06-02 20:48:32'),
	(6, NULL, 'dec77fa60b31c9150a9f8b5c8a363988', 1, 1, '2025-06-02 20:49:00', '2025-06-02 20:49:00'),
	(7, NULL, 'a266534473334342cb14d7e0c3003f19', 1, 1, '2025-06-02 20:49:31', '2025-06-02 20:49:31'),
	(8, NULL, 'c724a76aed3368c600721653349448b0', 1, 1, '2025-06-02 20:50:16', '2025-06-02 20:50:16'),
	(9, NULL, '3348be3bf5da08c9e453ff4199ab766c', 1, 1, '2025-06-02 20:50:16', '2025-06-02 20:50:16'),
	(10, NULL, 'bae6d3df7d81d5fa512c82ff491267b5', 1, 1, '2025-06-02 20:50:56', '2025-06-02 20:50:56'),
	(11, NULL, 'f5688d47298334a0b96e5d8aab006d9c', 1, 1, '2025-06-02 20:50:56', '2025-06-02 20:50:56'),
	(12, NULL, '90202f9ebd7f8413dd271b25b2804d6c', 1, 1, '2025-06-02 20:52:37', '2025-06-02 20:52:37');

-- Dumping structure for table onestore_db.tbl_category
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `categoryID` int NOT NULL AUTO_INCREMENT,
  `catName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoryID`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_category: ~2 rows (approximately)
INSERT INTO `tbl_category` (`categoryID`, `catName`, `slug`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Electronics', 'electronics', 'Electronic devices and gadgets', 'categories/category_683eaf62ca7c6.jpg', 1, '2025-06-03 01:13:39', '2025-06-03 08:20:53'),
	(2, 'Clothing', 'clothing', 'Fashion and apparel', 'categories/category_683eb0953b459.jpg', 1, '2025-06-03 01:13:39', '2025-06-03 01:21:41'),
	(3, 'Accessories', 'accessories', '', 'categories/category_683eaf8200e1f.jpg', 1, '2025-06-03 01:17:06', '2025-06-03 08:20:53');

-- Dumping structure for table onestore_db.tbl_coupon
DROP TABLE IF EXISTS `tbl_coupon`;
CREATE TABLE IF NOT EXISTS `tbl_coupon` (
  `couponID` int NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('percentage','fixed') COLLATE utf8mb4_general_ci NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `minimum_amount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int DEFAULT NULL,
  `used_count` int DEFAULT '0',
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`couponID`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_coupon: ~0 rows (approximately)
INSERT INTO `tbl_coupon` (`couponID`, `code`, `type`, `value`, `minimum_amount`, `usage_limit`, `used_count`, `valid_from`, `valid_until`, `status`, `created_at`) VALUES
	(1, 'SAVE10', 'percentage', 10.00, 50.00, 100, 0, '2025-01-01', '2025-12-31', 1, '2025-06-03 01:13:39');

-- Dumping structure for table onestore_db.tbl_customer
DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `customerID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customerID`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_customer_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_customer: ~2 rows (approximately)
INSERT INTO `tbl_customer` (`customerID`, `firstName`, `lastName`, `email`, `password`, `phone`, `dateOfBirth`, `gender`, `avatar`, `email_verified`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'John', 'Doe', 'john@example.com', 'password123', '+1234567890', NULL, NULL, NULL, 1, 1, '2025-06-03 01:13:39', '2025-06-03 08:52:20'),
	(2, 'Jane', 'Smith', 'jane@example.com', 'password456', '+0987654321', NULL, NULL, NULL, 0, 1, '2025-06-03 01:13:39', '2025-06-03 01:13:39'),
	(3, 'Sara', 'david', 'user001@gmail.com', '$2y$12$4P6qL35MLA2Dk.ehzGXkJ.4Qhxdc7z6qZEd4r0UJY59.EOI5pSPfe', '01234567', NULL, NULL, NULL, 0, 1, '2025-06-02 22:53:35', '2025-06-02 22:53:35');

-- Dumping structure for table onestore_db.tbl_customer_address
DROP TABLE IF EXISTS `tbl_customer_address`;
CREATE TABLE IF NOT EXISTS `tbl_customer_address` (
  `addressID` int NOT NULL AUTO_INCREMENT,
  `customerID` int NOT NULL,
  `type` enum('billing','shipping') COLLATE utf8mb4_general_ci NOT NULL,
  `firstName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`addressID`),
  KEY `customerID` (`customerID`),
  CONSTRAINT `tbl_customer_address_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_customer_address: ~0 rows (approximately)

-- Dumping structure for table onestore_db.tbl_order
DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `orderID` int NOT NULL AUTO_INCREMENT,
  `customerID` int DEFAULT NULL,
  `order_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `order_status` enum('pending','processing','shipped','delivered','cancelled','refunded') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) DEFAULT '0.00',
  `shipping_amount` decimal(10,2) DEFAULT '0.00',
  `discount_amount` decimal(10,2) DEFAULT '0.00',
  `total_amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_general_ci DEFAULT 'USD',
  `billing_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `shipping_address` text COLLATE utf8mb4_general_ci,
  `notes` text COLLATE utf8mb4_general_ci,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderID`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `customerID` (`customerID`),
  KEY `idx_order_status` (`order_status`),
  KEY `idx_order_date` (`created_at`),
  CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_order: ~0 rows (approximately)
INSERT INTO `tbl_order` (`orderID`, `customerID`, `order_number`, `order_status`, `payment_status`, `payment_method`, `subtotal`, `tax_amount`, `shipping_amount`, `discount_amount`, `total_amount`, `currency`, `billing_address`, `shipping_address`, `notes`, `shipped_at`, `delivered_at`, `created_at`, `updated_at`) VALUES
	(1, 1, 'ORD-2025-001', 'delivered', 'paid', NULL, 699.99, 0.00, 0.00, 0.00, 699.99, 'USD', 'John Doe, 123 Main St, New York, NY 10001, USA', NULL, NULL, NULL, NULL, '2025-06-03 01:13:39', '2025-06-03 01:13:39'),
	(11, 3, 'ORD-20250603064846-387', 'processing', 'paid', 'paypal', 29.00, 2.90, 10.00, 0.00, 41.90, 'USD', 'Sara david, cambodia, Phnom Penh, 1200, 12000, CAM, Phone: 01234567, Email: user001@gmail.com', 'Sara david, cambodia, Phnom Penh, 1200, 12000, CAM, Phone: 01234567, Email: user001@gmail.com', '', NULL, NULL, '2025-06-02 23:48:46', '2025-06-03 06:48:46'),
	(12, 3, 'ORD-20250603074402-281', 'pending', 'pending', 'cod', 29.99, 3.00, 10.00, 0.00, 42.99, 'USD', 'Sara david, cambodia, Phnom Penh, 1200, 12000, US, Phone: 01234567, Email: user001@gmail.com', 'Sara david, cambodia, Phnom Penh, 1200, 12000, US, Phone: 01234567, Email: user001@gmail.com', '', NULL, NULL, '2025-06-03 00:44:02', '2025-06-03 00:44:02'),
	(13, 3, 'ORD-20250603074549-511', 'pending', 'pending', 'cod', 532.00, 53.20, 10.00, 0.00, 595.20, 'USD', 'Sara david, cambodia, Phnom Penh, 1200, 12000, CAM, Phone: 01234567, Email: user001@gmail.com', 'Sara david, cambodia, Phnom Penh, 1200, 12000, CAM, Phone: 01234567, Email: user001@gmail.com', '', NULL, NULL, '2025-06-03 00:45:49', '2025-06-03 00:45:49'),
	(14, 3, 'ORD-20250603074952-691', 'pending', 'pending', 'cod', 2727.99, 272.80, 10.00, 0.00, 3010.79, 'USD', 'Sara david, cambodia, Phnom Penh, 1200, 12000, CAM, Phone: 01234567, Email: user001@gmail.com', 'Sara david, cambodia, Phnom Penh, 1200, 12000, CAM, Phone: 01234567, Email: user001@gmail.com', '', NULL, NULL, '2025-06-03 00:49:52', '2025-06-03 00:49:52');

-- Dumping structure for table onestore_db.tbl_order_item
DROP TABLE IF EXISTS `tbl_order_item`;
CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `orderItemID` int NOT NULL AUTO_INCREMENT,
  `orderID` int NOT NULL,
  `productID` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_sku` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderItemID`),
  KEY `orderID` (`orderID`),
  KEY `productID` (`productID`),
  CONSTRAINT `tbl_order_item_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `tbl_order` (`orderID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_order_item_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_order_item: ~0 rows (approximately)
INSERT INTO `tbl_order_item` (`orderItemID`, `orderID`, `productID`, `product_name`, `product_sku`, `quantity`, `price`, `total`, `created_at`) VALUES
	(1, 1, 1, 'Smartphone Pro', 'PHONE001', 1, 699.99, 699.99, '2025-06-03 01:13:39'),
	(11, 11, 6, 'T-Shirt', '', 1, 29.00, 29.00, '2025-06-03 06:48:46'),
	(12, 12, 2, 'Designer T-Shirt', '', 1, 29.99, 29.99, '2025-06-03 07:44:02'),
	(13, 13, 5, 'CowBoy', '', 15, 19.00, 285.00, '2025-06-03 07:45:49'),
	(15, 14, 4, 'apple-iphone-15-pro-max', '', 1, 1999.00, 1999.00, '2025-06-03 07:49:52'),
	(16, 14, 1, 'Smartphone Pro', '', 1, 699.99, 699.99, '2025-06-03 07:49:52'),
	(17, 14, 6, 'T-Shirt', '', 1, 29.00, 29.00, '2025-06-03 07:49:52');

-- Dumping structure for table onestore_db.tbl_product
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productID` int NOT NULL AUTO_INCREMENT,
  `categoryID` int NOT NULL,
  `brandID` int DEFAULT NULL,
  `productName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `short_description` text COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `sku` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stock_quantity` int DEFAULT '0',
  `weight` decimal(8,2) DEFAULT NULL,
  `dimensions` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gallery` text COLLATE utf8mb4_general_ci,
  `featured` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `meta_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`productID`),
  UNIQUE KEY `slug` (`slug`),
  KEY `categoryID` (`categoryID`),
  KEY `brandID` (`brandID`),
  KEY `idx_product_price` (`price`),
  KEY `idx_product_featured` (`featured`),
  CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `tbl_category` (`categoryID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`brandID`) REFERENCES `tbl_brand` (`brandID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_product: ~2 rows (approximately)
INSERT INTO `tbl_product` (`productID`, `categoryID`, `brandID`, `productName`, `slug`, `description`, `short_description`, `price`, `sale_price`, `sku`, `stock_quantity`, `weight`, `dimensions`, `image_path`, `gallery`, `featured`, `status`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'Smartphone Pro', 'smartphone-pro', 'Latest smartphone with advanced features', '', 699.99, NULL, '', 50, NULL, NULL, 'products/683ea76c50e1f_1748936556.jpg', NULL, 0, 1, NULL, NULL, '2025-06-03 01:13:39', '2025-06-03 07:42:36'),
	(2, 2, 2, 'Designer T-Shirt', 'designer-t-shirt', 'Premium cotton t-shirt with modern design', '', 29.99, NULL, 'SHIRT001', 100, NULL, NULL, 'products/1741002937_product-03.jpg', NULL, 1, 1, NULL, NULL, '2025-06-03 01:13:39', '2025-06-03 03:01:27'),
	(3, 2, 2, 'Male T-Shirt', 'male-t-shirt', '', '', 10.00, NULL, '', 10, NULL, NULL, 'products/1741006426_product-11.jpg', NULL, 1, 1, NULL, NULL, '2025-06-03 01:42:31', '2025-06-03 05:47:10'),
	(4, 1, 1, 'apple-iphone-15-pro-max', 'apple-iphone-15-pro-max', '', '', 1999.00, NULL, '', 19, NULL, NULL, 'products/683e5d9c9799a_1748917660.jpg', NULL, 0, 1, NULL, NULL, '2025-06-03 02:11:11', '2025-06-02 22:28:46'),
	(5, 2, 2, 'CowBoy', 'cowboy', '', '', 19.00, NULL, '', 89, NULL, NULL, 'products/683e648205727_1748919426.jpg', NULL, 1, 1, NULL, NULL, '2025-06-03 02:20:41', '2025-06-02 22:44:28'),
	(6, 2, 2, 'T-Shirt', 't-shirt', '', '', 29.00, NULL, '', 99, NULL, NULL, 'products/683e64ca702f5_1748919498.jpg', NULL, 0, 1, NULL, NULL, '2025-06-03 02:58:18', '2025-06-03 08:02:15');

-- Dumping structure for table onestore_db.tbl_review
DROP TABLE IF EXISTS `tbl_review`;
CREATE TABLE IF NOT EXISTS `tbl_review` (
  `reviewID` int NOT NULL AUTO_INCREMENT,
  `productID` int NOT NULL,
  `customerID` int DEFAULT NULL,
  `customer_name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` tinyint(1) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_general_ci,
  `approved` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reviewID`),
  KEY `productID` (`productID`),
  KEY `customerID` (`customerID`),
  CONSTRAINT `tbl_review_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_review_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE SET NULL,
  CONSTRAINT `tbl_review_chk_1` CHECK (((`rating` >= 1) and (`rating` <= 5)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_review: ~0 rows (approximately)

-- Dumping structure for table onestore_db.tbl_shipping
DROP TABLE IF EXISTS `tbl_shipping`;
CREATE TABLE IF NOT EXISTS `tbl_shipping` (
  `shippingID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `cost` decimal(10,2) NOT NULL,
  `free_shipping_minimum` decimal(10,2) DEFAULT NULL,
  `estimated_days` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`shippingID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_shipping: ~2 rows (approximately)
INSERT INTO `tbl_shipping` (`shippingID`, `name`, `description`, `cost`, `free_shipping_minimum`, `estimated_days`, `status`, `created_at`) VALUES
	(1, 'Standard Shipping', 'Regular delivery service', 5.99, NULL, '5-7 business days', 1, '2025-06-03 01:13:39'),
	(2, 'Express Shipping', 'Fast delivery service', 15.99, NULL, '1-2 business days', 1, '2025-06-03 01:13:39');

-- Dumping structure for table onestore_db.tbl_slider
DROP TABLE IF EXISTS `tbl_slider`;
CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `sliderID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `button_text` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` int DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sliderID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table onestore_db.tbl_slider: ~2 rows (approximately)
INSERT INTO `tbl_slider` (`sliderID`, `title`, `subtitle`, `description`, `image`, `link_url`, `button_text`, `position`, `status`, `created_at`, `updated_at`) VALUES
	(3, 'Best Selling Ever', 'Best Products at Best Prices', '', 'slider/683ebb6b53d88_1748941675.jpg', '/shop', 'Shop Now', 1, 1, '2025-06-03 01:44:53', '2025-06-03 09:07:55'),
	(4, 'Welcome to OneStore', 'Best Products at Best Prices', '', 'slider/1741017629_slide-03.jpg', '', '', 2, 1, '2025-06-03 02:10:24', '2025-06-03 03:13:33');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
