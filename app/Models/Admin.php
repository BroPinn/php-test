<?php

require_once __DIR__ . '/../Database.php';

class Admin {
    public static function findByUsername(string $username): ?array {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE username = :username AND status = 1 LIMIT 1");
        $stmt->execute(['username' => $username]);
        $admin = $stmt->fetch();
        return $admin ?: null;
    }

    public static function findById(int $id): ?array {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE adminID = :id AND status = 1 LIMIT 1");
        $stmt->execute(['id' => $id]);
        $admin = $stmt->fetch();
        return $admin ?: null;
    }

    public static function updateLastLogin(int $id): void {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE tbl_admin SET last_login = NOW() WHERE adminID = :id");
        $stmt->execute(['id' => $id]);
    }
}
