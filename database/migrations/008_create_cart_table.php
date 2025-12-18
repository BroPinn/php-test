<?php
/**
 * Migration: Create Cart Table
 */

return [
    'up' => function (PDO $pdo) {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tbl_cart` (
                `cartID` INT NOT NULL AUTO_INCREMENT,
                `customerID` INT DEFAULT NULL,
                `session_id` VARCHAR(128) DEFAULT NULL,
                `productID` INT NOT NULL,
                `quantity` INT NOT NULL DEFAULT 1,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`cartID`),
                KEY `customerID` (`customerID`),
                KEY `session_id` (`session_id`),
                KEY `productID` (`productID`),
                CONSTRAINT `fk_cart_customer` FOREIGN KEY (`customerID`) 
                    REFERENCES `tbl_customer` (`customerID`) ON DELETE CASCADE,
                CONSTRAINT `fk_cart_product` FOREIGN KEY (`productID`) 
                    REFERENCES `tbl_product` (`productID`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
    },

    'down' => function (PDO $pdo) {
        $pdo->exec("DROP TABLE IF EXISTS `tbl_cart`");
    }
];
