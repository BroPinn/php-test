<?php
/**
 * Migration: Create Brand Table
 */

return [
    'up' => function (PDO $pdo) {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tbl_brand` (
                `brandID` INT NOT NULL AUTO_INCREMENT,
                `brandName` VARCHAR(100) NOT NULL,
                `slug` VARCHAR(100) NOT NULL,
                `description` TEXT NULL,
                `logo` VARCHAR(255) DEFAULT NULL,
                `status` TINYINT(1) DEFAULT 1,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`brandID`),
                UNIQUE KEY `slug` (`slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
    },

    'down' => function (PDO $pdo) {
        $pdo->exec("DROP TABLE IF EXISTS `tbl_brand`");
    }
];
