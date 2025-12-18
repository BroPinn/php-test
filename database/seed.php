<?php
/**
 * Database Seeder Runner
 * 
 * Run seeders to populate the database with sample data.
 * Usage: php database/seed.php [SeederName]
 */

// Load configuration
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/app.php';

class Seeder
{
    protected $pdo;
    protected $seedersPath;

    public function __construct()
    {
        $this->seedersPath = __DIR__ . '/seeders';
        $this->connect();
    }

    private function connect()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            echo "✅ Connected to database: " . DB_NAME . "\n";
        } catch (PDOException $e) {
            die("❌ Database connection failed: " . $e->getMessage() . "\n");
        }
    }

    public function run($seederName = null)
    {
        if ($seederName) {
            $this->runSeeder($seederName);
        } else {
            $this->runAllSeeders();
        }
    }

    private function runSeeder($name)
    {
        $file = $this->seedersPath . '/' . $name . 'Seeder.php';

        if (!file_exists($file)) {
            die("❌ Seeder not found: {$name}Seeder.php\n");
        }

        echo "⏳ Seeding: {$name}\n";

        $seeder = require $file;

        try {
            $seeder($this->pdo);
            echo "✅ Seeded: {$name}\n";
        } catch (PDOException $e) {
            echo "❌ Seeding failed: {$name}\n";
            echo "   Error: " . $e->getMessage() . "\n";
        }
    }

    private function runAllSeeders()
    {
        if (!is_dir($this->seedersPath)) {
            mkdir($this->seedersPath, 0755, true);
        }

        $files = glob($this->seedersPath . '/*Seeder.php');
        sort($files);

        if (empty($files)) {
            echo "⚠️  No seeders found in {$this->seedersPath}\n";
            return;
        }

        foreach ($files as $file) {
            $name = str_replace('Seeder.php', '', basename($file));
            $this->runSeeder($name);
        }

        echo "\n✅ All seeders completed.\n";
    }
}

// CLI Entry Point
$seeder = new Seeder();
$seederName = $argv[1] ?? null;
$seeder->run($seederName);
