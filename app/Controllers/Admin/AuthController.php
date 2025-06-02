<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Helper;

class AuthController extends BaseController {
    
    public function __construct() {
        // Don't call parent::__construct() to skip admin auth check
        // Initialize database and other base functionality manually
        $this->initializeBase();
    }
    
    private function initializeBase() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    protected function getViewPath($view) {
        return __DIR__ . '/../../Views/Admin/' . $view . '.php';
    }
    
    /**
     * Show login form
     */
    public function showLogin() {
        // If already logged in, redirect to dashboard
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
            header('Location: /admin/dashboard');
            exit;
        }
        
        $data = [
            'title' => 'Admin Login - OneStore',
            'error' => $_SESSION['flash_error'] ?? null,
            'success' => $_SESSION['flash_success'] ?? null
        ];
        
        // Clear flash messages
        unset($_SESSION['flash_error']);
        unset($_SESSION['flash_success']);
        
        $this->adminView('auth/login', $data);
    }
    
    /**
     * Process login
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/login');
            exit;
        }
        
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $_SESSION['flash_error'] = 'Please enter both username and password';
            header('Location: /admin/login');
            exit;
        }
        
        try {
            // Create database connection with auto-setup
            $pdo = $this->setupDatabase();
            
            if (!$pdo) {
                throw new \Exception('Database connection failed');
            }
            
            // Check if admin_users table exists, if not create it
            $this->createAdminTable($pdo);
            
            $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ? AND status = 'active'");
            $stmt->execute([$username]);
            $admin = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if ($admin && password_verify($password, $admin['password'])) {
                // Login successful
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_last_activity'] = time();
                
                // Update last login
                $stmt = $pdo->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
                $stmt->execute([$admin['id']]);
                
                $_SESSION['flash_success'] = 'Welcome back, ' . $admin['name'];
                header('Location: /admin/dashboard');
                exit;
                
            } else {
                $_SESSION['flash_error'] = 'Invalid username or password';
                header('Location: /admin/login');
                exit;
            }
            
        } catch (\Exception $e) {
            error_log("Admin login error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Database error: ' . $e->getMessage();
            header('Location: /admin/login');
            exit;
        }
    }
    
    /**
     * Setup database connection and create database if needed
     */
    private function setupDatabase() {
        try {
            // First connect without database to create it
            $dsn = "mysql:host=localhost;charset=utf8mb4";
            $pdo = new \PDO($dsn, 'root', '', [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
            
            // Create database if it doesn't exist
            $pdo->exec("CREATE DATABASE IF NOT EXISTS onestore_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
            $pdo->exec("USE onestore_db");
            
            return $pdo;
            
        } catch (\PDOException $e) {
            error_log("Database setup error: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Logout admin
     */
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Clear admin session data
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        unset($_SESSION['admin_last_activity']);
        
        $_SESSION['flash_success'] = 'You have been logged out successfully';
        header('Location: /admin/login');
        exit;
    }
    
    /**
     * Create admin_users table if it doesn't exist
     */
    private function createAdminTable($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS admin_users (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100),
            role ENUM('admin', 'manager') DEFAULT 'admin',
            status ENUM('active', 'inactive') DEFAULT 'active',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            last_login TIMESTAMP NULL
        )";
        
        $pdo->exec($sql);
        
        // Check if default admin exists, if not create one
        $stmt = $pdo->query("SELECT COUNT(*) FROM admin_users");
        $count = $stmt->fetchColumn();
        
        if ($count == 0) {
            // Create default admin (username: admin, password: admin123)
            $defaultPassword = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO admin_users (username, password, name, email, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(['admin', $defaultPassword, 'Administrator', 'admin@onestore.com', 'admin']);
        }
    }
    
    /**
     * Render admin view without authentication check
     */
    private function adminView($view, $data = []) {
        extract($data);
        
        $viewPath = __DIR__ . '/../../Views/Admin/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "Admin view not found: $view";
        }
    }
} 