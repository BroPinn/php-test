<?php
/**
 * Migration: Create Admin Table
 */

return [
    'up' => function (PDO $pdo) {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tbl_admin` (
                `adminID` INT NOT NULL AUTO_INCREMENT,
                `username` VARCHAR(100) NOT NULL,
                `email` VARCHAR(255) NOT NULL,
                `password` VARCHAR(255) NOT NULL,
                `firstName` VARCHAR(100) DEFAULT NULL,
                `lastName` VARCHAR(100) DEFAULT NULL,
                `avatar` VARCHAR(255) DEFAULT NULL,
                `role` ENUM('super_admin', 'admin', 'manager') DEFAULT 'admin',
                `permissions` TEXT NULL,
                `last_login` TIMESTAMP NULL DEFAULT NULL,
                `status` TINYINT(1) DEFAULT 1,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`adminID`),
                UNIQUE KEY `username` (`username`),
                UNIQUE KEY `email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
    },

    'down' => function (PDO $pdo) {
        $pdo->exec("DROP TABLE IF EXISTS `tbl_admin`");
    }
];
