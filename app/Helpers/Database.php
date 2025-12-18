<?php
namespace App\Helpers;

/**
 * Database Singleton Class
 * 
 * Provides a single database connection instance throughout the application.
 * Usage: Database::getInstance() or Database::getConnection()
 */
class Database
{

    private static $instance = null;
    private $pdo;

    /**
     * Private constructor - prevents direct instantiation
     */
    private function __construct()
    {
        $this->connect();
    }

    /**
     * Prevent cloning
     */
    private function __clone()
    {
    }

    /**
     * Prevent unserialization
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * Get the singleton instance
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get PDO connection directly
     */
    public static function getConnection(): \PDO
    {
        return self::getInstance()->pdo;
    }

    /**
     * Create database connection
     */
    private function connect(): void
    {
        try {
            $dsn = sprintf(
                "mysql:host=%s;dbname=%s;charset=%s",
                defined('DB_HOST') ? DB_HOST : 'localhost',
                defined('DB_NAME') ? DB_NAME : 'onestore_db',
                defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4'
            );

            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->pdo = new \PDO(
                $dsn,
                defined('DB_USER') ? DB_USER : 'root',
                defined('DB_PASS') ? DB_PASS : '',
                $options
            );

        } catch (\PDOException $e) {
            if (defined('DEBUG_MODE') && DEBUG_MODE) {
                throw new \Exception("Database Connection Error: " . $e->getMessage());
            } else {
                error_log("Database Connection Error: " . $e->getMessage());
                throw new \Exception("Database connection failed. Please check your configuration.");
            }
        }
    }

    /**
     * Get PDO instance (non-static)
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    /**
     * Execute a query and return results
     */
    public static function query(string $sql, array $params = []): array
    {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Execute a query and return single row
     */
    public static function queryOne(string $sql, array $params = []): ?array
    {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /**
     * Execute an insert/update/delete and return affected rows
     */
    public static function execute(string $sql, array $params = []): int
    {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    /**
     * Get last insert ID
     */
    public static function lastInsertId(): string
    {
        return self::getConnection()->lastInsertId();
    }

    /**
     * Begin transaction
     */
    public static function beginTransaction(): bool
    {
        return self::getConnection()->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public static function commit(): bool
    {
        return self::getConnection()->commit();
    }

    /**
     * Rollback transaction
     */
    public static function rollback(): bool
    {
        return self::getConnection()->rollBack();
    }
}
