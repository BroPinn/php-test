<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\Helper;
use PDO;
use PDOException;

/**
 * Base Admin Controller
 * All admin controllers should extend this class
 */
abstract class AdminController extends BaseController {
    
    protected $adminUser;
    protected $adminTitle;
    protected $adminBreadcrumbs;
    
    public function __construct() {
        parent::__construct();
        
        // Check admin authentication
        $this->checkAdminAuth();
        
        // Set admin-specific data
        $this->setAdminData();
    }
    
    /**
     * Check if admin is authenticated
     */
    protected function checkAdminAuth() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
            $this->redirectToLogin();
        }
        
        // Check session expiry (2 hours default)
        $sessionTimeout = 7200; // 2 hours in seconds
        if (isset($_SESSION['admin_last_activity']) && 
            (time() - $_SESSION['admin_last_activity']) > $sessionTimeout) {
            $this->logout();
        }
        
        $_SESSION['admin_last_activity'] = time();
    }
    
    /**
     * Set admin user data
     */
    protected function setAdminData() {
        if (isset($_SESSION['admin_id'])) {
            // Load admin user data
            try {
                $pdo = $this->connectDatabase();
                
                if (!$pdo) {
                    $this->logout();
                    return;
                }
                
                $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE id = ?");
                $stmt->execute([$_SESSION['admin_id']]);
                $this->adminUser = $stmt->fetch(\PDO::FETCH_ASSOC);
                
                if (!$this->adminUser) {
                    $this->logout();
                }
                
            } catch (\Exception $e) {
                error_log("Admin auth error: " . $e->getMessage());
                $this->logout();
            }
        }
    }
    
    /**
     * Redirect to admin login
     */
    protected function redirectToLogin() {
        $_SESSION['flash_error'] = 'Please login to access admin area';
        header('Location: /admin/login');
        exit;
    }
    
    /**
     * Logout admin user
     */
    protected function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Clear admin session data
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        unset($_SESSION['admin_last_activity']);
        
        $_SESSION['flash_success'] = 'You have been logged out';
        header('Location: /admin/login');
        exit;
    }
    
    /**
     * Check admin permissions
     */
    protected function checkPermission($permission) {
        if (!$this->adminUser) {
            return false;
        }
        
        // Simple role-based check (can be enhanced)
        $adminRole = $this->adminUser['role'] ?? 'admin';
        
        switch ($permission) {
            case 'manage_products':
            case 'manage_orders':
            case 'manage_customers':
                return in_array($adminRole, ['admin', 'manager']);
                
            case 'manage_users':
            case 'manage_settings':
                return $adminRole === 'admin';
                
            default:
                return $adminRole === 'admin';
        }
    }
    
    /**
     * Require specific permission
     */
    protected function requirePermission($permission) {
        if (!$this->checkPermission($permission)) {
            $_SESSION['flash_error'] = 'You do not have permission to access this resource';
            header('Location: /admin/dashboard');
            exit;
        }
    }
    
    /**
     * Set page title for admin
     */
    protected function setAdminTitle($title) {
        $this->adminTitle = $title . ' - OneStore Admin';
    }
    
    /**
     * Set breadcrumbs for admin
     */
    protected function setAdminBreadcrumbs($breadcrumbs) {
        $adminBreadcrumbs = [
            ['title' => 'Dashboard', 'url' => '/admin/dashboard']
        ];
        
        foreach ($breadcrumbs as $crumb) {
            $adminBreadcrumbs[] = $crumb;
        }
        
        $this->adminBreadcrumbs = $adminBreadcrumbs;
    }
    
    /**
     * Get admin statistics
     */
    protected function getAdminStats() {
        try {
            $pdo = $this->connectDatabase();
            
            if (!$pdo) {
                return $this->getDefaultStats();
            }
            
            // Create products table if it doesn't exist
            $this->createProductsTable($pdo);
            
            $stats = [];
            
            // Total products
            $stmt = $pdo->query("SELECT COUNT(*) FROM products");
            $stats['total_products'] = $stmt->fetchColumn();
            
            // Total orders (check if table exists)
            try {
                $stmt = $pdo->query("SELECT COUNT(*) FROM orders");
                $stats['total_orders'] = $stmt->fetchColumn();
            } catch (\Exception $e) {
                $stats['total_orders'] = 0;
            }
            
            // Total customers (check if table exists)
            try {
                $stmt = $pdo->query("SELECT COUNT(*) FROM customers");
                $stats['total_customers'] = $stmt->fetchColumn();
            } catch (\Exception $e) {
                $stats['total_customers'] = 0;
            }
            
            // Revenue today (if orders table exists)
            try {
                $stmt = $pdo->prepare("SELECT SUM(total_amount) FROM orders WHERE DATE(created_at) = CURDATE()");
                $stmt->execute();
                $stats['revenue_today'] = $stmt->fetchColumn() ?: 0;
            } catch (\Exception $e) {
                $stats['revenue_today'] = 0;
            }
            
            // Revenue this month
            try {
                $stmt = $pdo->prepare("SELECT SUM(total_amount) FROM orders WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
                $stmt->execute();
                $stats['revenue_month'] = $stmt->fetchColumn() ?: 0;
            } catch (\Exception $e) {
                $stats['revenue_month'] = 0;
            }
            
            return $stats;
            
        } catch (\Exception $e) {
            error_log("Admin stats error: " . $e->getMessage());
            return $this->getDefaultStats();
        }
    }
    
    /**
     * Connect to database with proper error handling
     */
    protected function connectDatabase() {
        try {
            $dsn = "mysql:host=localhost;dbname=onestore_db;charset=utf8mb4";
            $pdo = new PDO($dsn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            
            return $pdo;
            
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Create products table if it doesn't exist
     */
    protected function createProductsTable($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            description TEXT,
            price DECIMAL(10,2) NOT NULL,
            category_id INT DEFAULT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($sql);
    }
    
    /**
     * Get default statistics when database is unavailable
     */
    private function getDefaultStats() {
        return [
            'total_products' => 0,
            'total_orders' => 0,
            'total_customers' => 0,
            'revenue_today' => 0,
            'revenue_month' => 0
        ];
    }
    
    /**
     * Log admin activity
     */
    protected function logActivity($action, $details = '') {
        try {
            require_once __DIR__ . '/../../../database.php';
            global $pdo;
            
            // Check if admin_activity_log table exists, if not create it
            $stmt = $pdo->prepare("
                CREATE TABLE IF NOT EXISTS admin_activity_log (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    admin_id INT,
                    action VARCHAR(255),
                    details TEXT,
                    ip_address VARCHAR(45),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");
            $stmt->execute();
            
            $stmt = $pdo->prepare("
                INSERT INTO admin_activity_log (admin_id, action, details, ip_address, created_at) 
                VALUES (?, ?, ?, ?, NOW())
            ");
            
            $stmt->execute([
                $this->adminUser['id'] ?? 0,
                $action,
                $details,
                $_SERVER['REMOTE_ADDR'] ?? 'unknown'
            ]);
            
        } catch (\Exception $e) {
            error_log("Admin activity log error: " . $e->getMessage());
        }
    }
    
    /**
     * Handle file uploads for admin
     */
    protected function handleAdminUpload($file, $uploadDir = 'admin', $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']) {
        if (!$this->isValidUpload($file, $allowedTypes)) {
            return false;
        }
        
        $uploadPath = "public/uploads/{$uploadDir}/";
        
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        $filename = $this->generateUniqueFilename($file['name']);
        $fullPath = $uploadPath . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $fullPath)) {
            $this->logActivity('File Upload', "Uploaded: {$filename}");
            return "{$uploadDir}/{$filename}";
        }
        
        return false;
    }
    
    /**
     * Render admin view with admin-specific data
     */
    protected function adminView($view, $data = []) {
        // Add admin-specific data
        $data['admin_user'] = $this->adminUser;
        $data['page_title'] = $this->adminTitle ?? 'OneStore Admin';
        $data['breadcrumbs'] = $this->adminBreadcrumbs ?? [];
        
        // Extract data for the view
        extract($data);
        
        // Build view path
        $viewPath = $this->getViewPath($view);
        
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "Admin view not found: $view";
        }
    }
    
    /**
     * JSON response with admin logging
     */
    protected function adminJson($data, $statusCode = 200) {
        if ($statusCode >= 400) {
            $this->logActivity('API Error', json_encode($data));
        }
        
        return $this->json($data, $statusCode);
    }
    
    /**
     * Helper method to check if file upload is valid
     */
    private function isValidUpload($file, $allowedTypes) {
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return false;
        }
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        return in_array($fileExtension, $allowedTypes);
    }
    
    /**
     * Generate unique filename for uploads
     */
    private function generateUniqueFilename($originalName) {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        return uniqid() . '_' . time() . '.' . $extension;
    }
}
?> 