<?php
/**
 * Database Migration Runner
 * 
 * Run migrations to set up or update the database schema.
 * Usage: php database/migrate.php [fresh|rollback]
 */

// Load configuration
define('ROOT_PATH', dirname(__DIR__));
require_once ROOT_PATH . '/config/app.php';

class Migration
{
    private $pdo;
    private $migrationsPath;
    private $migrationsTable = 'migrations';

    public function __construct()
    {
        $this->migrationsPath = __DIR__ . '/migrations';
        $this->connect();
        $this->createMigrationsTable();
    }

    private function connect()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            // Create database if not exists
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` 
                             CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
            $this->pdo->exec("USE `" . DB_NAME . "`");

            echo "✅ Connected to database: " . DB_NAME . "\n";
        } catch (PDOException $e) {
            die("❌ Database connection failed: " . $e->getMessage() . "\n");
        }
    }

    private function createMigrationsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `{$this->migrationsTable}` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `migration` VARCHAR(255) NOT NULL,
            `batch` INT NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
        $this->pdo->exec($sql);
    }

    public function run()
    {
        $migrated = $this->getMigratedMigrations();
        $files = $this->getMigrationFiles();
        $batch = $this->getNextBatch();
        $ran = 0;

        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);

            if (!in_array($name, $migrated)) {
                echo "⏳ Running migration: {$name}\n";

                $migration = require $file;

                try {
                    $migration['up']($this->pdo);
                    $this->logMigration($name, $batch);
                    echo "✅ Migrated: {$name}\n";
                    $ran++;
                } catch (PDOException $e) {
                    echo "❌ Migration failed: {$name}\n";
                    echo "   Error: " . $e->getMessage() . "\n";
                    return;
                }
            }
        }

        if ($ran === 0) {
            echo "✅ Nothing to migrate.\n";
        } else {
            echo "\n✅ Ran {$ran} migrations.\n";
        }
    }

    public function rollback()
    {
        $lastBatch = $this->getLastBatch();

        if ($lastBatch === 0) {
            echo "✅ Nothing to rollback.\n";
            return;
        }

        $migrations = $this->pdo->query(
            "SELECT migration FROM {$this->migrationsTable} 
             WHERE batch = {$lastBatch} ORDER BY id DESC"
        )->fetchAll(PDO::FETCH_COLUMN);

        foreach ($migrations as $name) {
            $file = $this->migrationsPath . '/' . $name . '.php';

            if (file_exists($file)) {
                echo "⏳ Rolling back: {$name}\n";
                $migration = require $file;

                try {
                    $migration['down']($this->pdo);
                    $this->pdo->exec("DELETE FROM {$this->migrationsTable} WHERE migration = '{$name}'");
                    echo "✅ Rolled back: {$name}\n";
                } catch (PDOException $e) {
                    echo "❌ Rollback failed: {$name}\n";
                    echo "   Error: " . $e->getMessage() . "\n";
                    return;
                }
            }
        }
    }

    public function fresh()
    {
        echo "⚠️  Dropping all tables...\n";

        $this->pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
        $tables = $this->pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            $this->pdo->exec("DROP TABLE IF EXISTS `{$table}`");
            echo "   Dropped: {$table}\n";
        }

        $this->pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
        $this->createMigrationsTable();

        echo "\n";
        $this->run();
    }

    private function getMigrationFiles()
    {
        if (!is_dir($this->migrationsPath)) {
            mkdir($this->migrationsPath, 0755, true);
        }

        $files = glob($this->migrationsPath . '/*.php');
        sort($files);
        return $files;
    }

    private function getMigratedMigrations()
    {
        return $this->pdo->query(
            "SELECT migration FROM {$this->migrationsTable}"
        )->fetchAll(PDO::FETCH_COLUMN);
    }

    private function getNextBatch()
    {
        return $this->getLastBatch() + 1;
    }

    private function getLastBatch()
    {
        $result = $this->pdo->query(
            "SELECT MAX(batch) FROM {$this->migrationsTable}"
        )->fetchColumn();
        return (int) $result;
    }

    private function logMigration($name, $batch)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->migrationsTable} (migration, batch) VALUES (?, ?)"
        );
        $stmt->execute([$name, $batch]);
    }
}

// CLI Entry Point
$migration = new Migration();

$command = $argv[1] ?? 'run';

switch ($command) {
    case 'fresh':
        $migration->fresh();
        break;
    case 'rollback':
        $migration->rollback();
        break;
    default:
        $migration->run();
        break;
}
