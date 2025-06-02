-- ======================================
-- OneStore Complete E-commerce Database
-- ======================================
-- Complete e-commerce database with all essential tables
-- Run this in phpMyAdmin or MySQL command line

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `onestore_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `onestore_db`;

-- ======================================
-- TABLE STRUCTURES
-- ======================================

-- Categories Table
CREATE TABLE `tbl_category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`categoryID`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Brands Table
CREATE TABLE `tbl_brand` (
  `brandID` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`brandID`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Products Table
CREATE TABLE `tbl_product` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `brandID` int(11) DEFAULT NULL,
  `productName` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `weight` decimal(8,2) DEFAULT NULL,
  `dimensions` varchar(100) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `gallery` text DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`productID`),
  UNIQUE KEY `slug` (`slug`),
  KEY `categoryID` (`categoryID`),
  KEY `brandID` (`brandID`),
  CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `tbl_category` (`categoryID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`brandID`) REFERENCES `tbl_brand` (`brandID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Customers Table
CREATE TABLE `tbl_customer` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`customerID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Customer Addresses Table
CREATE TABLE `tbl_customer_address` (
  `addressID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) NOT NULL,
  `type` enum('billing','shipping') NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`addressID`),
  KEY `customerID` (`customerID`),
  CONSTRAINT `tbl_customer_address_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Admin Table
CREATE TABLE `tbl_admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('super_admin','admin','manager') DEFAULT 'admin',
  `permissions` text DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Orders Table
CREATE TABLE `tbl_order` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) DEFAULT NULL,
  `order_number` varchar(50) NOT NULL,
  `order_status` enum('pending','processing','shipped','delivered','cancelled','refunded') DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed','refunded') DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) DEFAULT 0.00,
  `shipping_amount` decimal(10,2) DEFAULT 0.00,
  `discount_amount` decimal(10,2) DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) DEFAULT 'USD',
  `billing_address` text NOT NULL,
  `shipping_address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`orderID`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `customerID` (`customerID`),
  CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Order Items Table
CREATE TABLE `tbl_order_item` (
  `orderItemID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_sku` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`orderItemID`),
  KEY `orderID` (`orderID`),
  KEY `productID` (`productID`),
  CONSTRAINT `tbl_order_item_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `tbl_order` (`orderID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_order_item_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Shopping Cart Table
CREATE TABLE `tbl_cart` (
  `cartID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`cartID`),
  KEY `customerID` (`customerID`),
  KEY `productID` (`productID`),
  CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Coupons Table
CREATE TABLE `tbl_coupon` (
  `couponID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `type` enum('percentage','fixed') NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `minimum_amount` decimal(10,2) DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) DEFAULT 0,
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`couponID`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Slider Table
CREATE TABLE `tbl_slider` (
  `sliderID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `position` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sliderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Shipping Methods Table
CREATE TABLE `tbl_shipping` (
  `shippingID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `cost` decimal(10,2) NOT NULL,
  `free_shipping_minimum` decimal(10,2) DEFAULT NULL,
  `estimated_days` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`shippingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Reviews Table
CREATE TABLE `tbl_review` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `productID` int(11) NOT NULL,
  `customerID` int(11) DEFAULT NULL,
  `customer_name` varchar(200) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `rating` tinyint(1) NOT NULL CHECK (rating >= 1 AND rating <= 5),
  `title` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`reviewID`),
  KEY `productID` (`productID`),
  KEY `customerID` (`customerID`),
  CONSTRAINT `tbl_review_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE,
  CONSTRAINT `tbl_review_ibfk_2` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ======================================
-- SAMPLE DATA (MINIMAL)
-- ======================================

-- Insert Categories (2 samples)
INSERT INTO `tbl_category` (`catName`, `slug`, `description`, `status`) VALUES
('Electronics', 'electronics', 'Electronic devices and gadgets', 1),
('Clothing', 'clothing', 'Fashion and apparel', 1);

-- Insert Brands (2 samples)
INSERT INTO `tbl_brand` (`brandName`, `slug`, `description`, `status`) VALUES
('TechBrand', 'techbrand', 'Leading technology brand', 1),
('FashionCorp', 'fashioncorp', 'Premium fashion brand', 1);

-- Insert Products (2 samples)
INSERT INTO `tbl_product` (`categoryID`, `brandID`, `productName`, `slug`, `description`, `price`, `sku`, `stock_quantity`, `image_path`, `status`) VALUES
(1, 1, 'Smartphone Pro', 'smartphone-pro', 'Latest smartphone with advanced features', 699.99, 'PHONE001', 50, 'assets/images/smartphone.jpg', 1),
(2, 2, 'Designer T-Shirt', 'designer-t-shirt', 'Premium cotton t-shirt with modern design', 29.99, 'SHIRT001', 100, 'assets/images/tshirt.jpg', 1);

-- Insert Customers (2 samples)
INSERT INTO `tbl_customer` (`firstName`, `lastName`, `email`, `password`, `phone`, `status`) VALUES
('John', 'Doe', 'john@example.com', 'password123', '+1234567890', 1),
('Jane', 'Smith', 'jane@example.com', 'password456', '+0987654321', 1);

-- Insert Admin Users (2 samples)
INSERT INTO `tbl_admin` (`username`, `email`, `password`, `firstName`, `lastName`, `role`, `status`) VALUES
('admin', 'admin@onestore.com', 'admin123', 'Admin', 'User', 'super_admin', 1),
('manager', 'manager@onestore.com', 'manager123', 'Manager', 'User', 'manager', 1);

-- Insert Orders (1 sample)
INSERT INTO `tbl_order` (`customerID`, `order_number`, `order_status`, `payment_status`, `subtotal`, `total_amount`, `billing_address`) VALUES
(1, 'ORD-2025-001', 'delivered', 'paid', 699.99, 699.99, 'John Doe, 123 Main St, New York, NY 10001, USA');

-- Insert Order Items (1 sample)
INSERT INTO `tbl_order_item` (`orderID`, `productID`, `product_name`, `product_sku`, `quantity`, `price`, `total`) VALUES
(1, 1, 'Smartphone Pro', 'PHONE001', 1, 699.99, 699.99);

-- Insert Slider (2 samples)
INSERT INTO `tbl_slider` (`title`, `subtitle`, `image`, `link_url`, `button_text`, `status`) VALUES
('Welcome to OneStore', 'Best Products at Best Prices', 'assets/images/slider1.jpg', '/shop', 'Shop Now', 1),
('New Arrivals', 'Discover Latest Products', 'assets/images/slider2.jpg', '/products', 'Explore', 1);

-- Insert Shipping Methods (2 samples)
INSERT INTO `tbl_shipping` (`name`, `description`, `cost`, `estimated_days`, `status`) VALUES
('Standard Shipping', 'Regular delivery service', 5.99, '5-7 business days', 1),
('Express Shipping', 'Fast delivery service', 15.99, '1-2 business days', 1);

-- Insert Coupons (1 sample)
INSERT INTO `tbl_coupon` (`code`, `type`, `value`, `minimum_amount`, `usage_limit`, `valid_from`, `valid_until`, `status`) VALUES
('SAVE10', 'percentage', 10.00, 50.00, 100, '2025-01-01', '2025-12-31', 1);

-- ======================================
-- INDEXES FOR PERFORMANCE
-- ======================================

CREATE INDEX idx_product_price ON tbl_product(price);
CREATE INDEX idx_product_featured ON tbl_product(featured);
CREATE INDEX idx_order_status ON tbl_order(order_status);
CREATE INDEX idx_order_date ON tbl_order(created_at);
CREATE INDEX idx_customer_email ON tbl_customer(email);

-- Success message
SELECT 'OneStore complete database setup finished successfully!' as Status;
SELECT 'Admin Login: admin/admin123 | Manager Login: manager/manager123' as Login_Info; 