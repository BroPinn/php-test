<?php
/**
 * Migration: Create Product Table
 */

return [
    'up' => function (PDO $pdo) {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tbl_product` (
                `productID` INT NOT NULL AUTO_INCREMENT,
                `categoryID` INT NOT NULL,
                `brandID` INT DEFAULT NULL,
                `productName` VARCHAR(255) NOT NULL,
                `slug` VARCHAR(255) NOT NULL,
                `description` TEXT NULL,
                `short_description` TEXT NULL,
                `price` DECIMAL(10,2) NOT NULL,
                `sale_price` DECIMAL(10,2) DEFAULT NULL,
                `sku` VARCHAR(100) DEFAULT NULL,
                `stock_quantity` INT DEFAULT 0,
                `weight` DECIMAL(8,2) DEFAULT NULL,
                `dimensions` VARCHAR(100) DEFAULT NULL,
                `image_path` VARCHAR(255) DEFAULT NULL,
                `gallery` TEXT NULL,
                `featured` TINYINT(1) DEFAULT 0,
                `status` TINYINT(1) DEFAULT 1,
                `meta_title` VARCHAR(255) DEFAULT NULL,
                `meta_description` TEXT NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`productID`),
                UNIQUE KEY `slug` (`slug`),
                KEY `categoryID` (`categoryID`),
                KEY `brandID` (`brandID`),
                KEY `idx_product_price` (`price`),
                KEY `idx_product_featured` (`featured`),
                CONSTRAINT `fk_product_category` FOREIGN KEY (`categoryID`) 
                    REFERENCES `tbl_category` (`categoryID`) ON DELETE CASCADE,
                CONSTRAINT `fk_product_brand` FOREIGN KEY (`brandID`) 
                    REFERENCES `tbl_brand` (`brandID`) ON DELETE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
    },

    'down' => function (PDO $pdo) {
        $pdo->exec("DROP TABLE IF EXISTS `tbl_product`");
    }
];
