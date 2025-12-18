<?php
/**
 * Migration: Create Customer Table
 */

return [
    'up' => function (PDO $pdo) {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tbl_customer` (
                `customerID` INT NOT NULL AUTO_INCREMENT,
                `firstName` VARCHAR(100) NOT NULL,
                `lastName` VARCHAR(100) NOT NULL,
                `email` VARCHAR(255) NOT NULL,
                `password` VARCHAR(255) NOT NULL,
                `phone` VARCHAR(20) DEFAULT NULL,
                `dateOfBirth` DATE DEFAULT NULL,
                `gender` ENUM('male', 'female', 'other') DEFAULT NULL,
                `avatar` VARCHAR(255) DEFAULT NULL,
                `email_verified` TINYINT(1) DEFAULT 0,
                `status` TINYINT(1) DEFAULT 1,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`customerID`),
                UNIQUE KEY `email` (`email`),
                KEY `idx_customer_email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
    },

    'down' => function (PDO $pdo) {
        $pdo->exec("DROP TABLE IF EXISTS `tbl_customer`");
    }
];
