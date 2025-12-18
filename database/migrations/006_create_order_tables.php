<?php
/**
 * Migration: Create Order and Order Items Tables
 */

return [
    'up' => function (PDO $pdo) {
        // Create orders table
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tbl_order` (
                `orderID` INT NOT NULL AUTO_INCREMENT,
                `customerID` INT DEFAULT NULL,
                `order_number` VARCHAR(50) NOT NULL,
                `order_status` ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled', 'refunded') DEFAULT 'pending',
                `payment_status` ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
                `payment_method` VARCHAR(50) DEFAULT NULL,
                `subtotal` DECIMAL(10,2) NOT NULL,
                `tax_amount` DECIMAL(10,2) DEFAULT 0.00,
                `shipping_amount` DECIMAL(10,2) DEFAULT 0.00,
                `discount_amount` DECIMAL(10,2) DEFAULT 0.00,
                `total_amount` DECIMAL(10,2) NOT NULL,
                `currency` VARCHAR(3) DEFAULT 'USD',
                `billing_address` TEXT NOT NULL,
                `shipping_address` TEXT NULL,
                `notes` TEXT NULL,
                `shipped_at` TIMESTAMP NULL DEFAULT NULL,
                `delivered_at` TIMESTAMP NULL DEFAULT NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`orderID`),
                UNIQUE KEY `order_number` (`order_number`),
                KEY `customerID` (`customerID`),
                KEY `idx_order_status` (`order_status`),
                KEY `idx_order_date` (`created_at`),
                CONSTRAINT `fk_order_customer` FOREIGN KEY (`customerID`) 
                    REFERENCES `tbl_customer` (`customerID`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");

        // Create order items table
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tbl_order_item` (
                `orderItemID` INT NOT NULL AUTO_INCREMENT,
                `orderID` INT NOT NULL,
                `productID` INT NOT NULL,
                `product_name` VARCHAR(255) NOT NULL,
                `product_sku` VARCHAR(100) DEFAULT NULL,
                `quantity` INT NOT NULL,
                `price` DECIMAL(10,2) NOT NULL,
                `total` DECIMAL(10,2) NOT NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`orderItemID`),
                KEY `orderID` (`orderID`),
                KEY `productID` (`productID`),
                CONSTRAINT `fk_orderitem_order` FOREIGN KEY (`orderID`) 
                    REFERENCES `tbl_order` (`orderID`) ON DELETE CASCADE,
                CONSTRAINT `fk_orderitem_product` FOREIGN KEY (`productID`) 
                    REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
    },

    'down' => function (PDO $pdo) {
        $pdo->exec("DROP TABLE IF EXISTS `tbl_order_item`");
        $pdo->exec("DROP TABLE IF EXISTS `tbl_order`");
    }
];
