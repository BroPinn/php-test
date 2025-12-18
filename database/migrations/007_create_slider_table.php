<?php
/**
 * Migration: Create Slider Table
 */

return [
    'up' => function (PDO $pdo) {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `tbl_slider` (
                `sliderID` INT NOT NULL AUTO_INCREMENT,
                `title` VARCHAR(255) DEFAULT NULL,
                `subtitle` VARCHAR(255) DEFAULT NULL,
                `description` TEXT NULL,
                `image` VARCHAR(255) NOT NULL,
                `link_url` VARCHAR(255) DEFAULT NULL,
                `button_text` VARCHAR(100) DEFAULT NULL,
                `position` INT DEFAULT 0,
                `status` TINYINT(1) DEFAULT 1,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`sliderID`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
        ");
    },

    'down' => function (PDO $pdo) {
        $pdo->exec("DROP TABLE IF EXISTS `tbl_slider`");
    }
];
