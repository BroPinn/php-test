<?php

class Database {
    private static ?PDO $instance = null;

    public static function connect(): PDO {
        if (self::$instance === null) {
            self::loadEnv(__DIR__ . '/../.env');

            $host    = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: null;
            $dbname  = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?: null;
            $user    = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? null;
            $pass    = $_ENV['DB_PASS'] ?? getenv('DB_PASS') ?? '';
            $charset = $_ENV['DB_CHARSET'] ?? getenv('DB_CHARSET') ?: 'utf8mb4';

            if (!$host || !$dbname || $user === null) {
                throw new RuntimeException("Database configuration missing in environment (.env).");
            }

            $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            self::$instance = new PDO($dsn, $user, $pass, $options);
        }

        return self::$instance;
    }

    private static function loadEnv(string $filePath): void {
        if (!file_exists($filePath)) {
            return;
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            [$key, $val] = explode('=', $line, 2) + [null, null];
            if ($key !== null) {
                $key = trim($key);
                $val = trim($val ?? '', " \t\n\r\0\x0B\"'");
                $_ENV[$key] = $val;
                putenv("{$key}={$val}");
            }
        }
    }
}
