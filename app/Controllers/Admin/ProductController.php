<?php
namespace App\Controllers\Admin;

use Exception;

class ProductController extends AdminController {
    
    protected function getViewPath($view) {
        return __DIR__ . '/../../Views/Admin/' . $view . '.php';
    }
    
    public function index() {
        $this->setAdminTitle('Product Management');
        $this->requirePermission('manage_products');
        
        try {
            $pdo = $this->connectDatabase();
            
            if (!$pdo) {
                throw new Exception('Database connection failed');
            }
            
            // Create products table if it doesn't exist
            $this->createProductsTable($pdo);
            
            // Get all products
            $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
            $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            $data = [
                'title' => 'Product Management - OneStore Admin',
                'products' => $products,
                'admin_user' => $this->adminUser,
                'success' => $_SESSION['flash_success'] ?? null,
                'error' => $_SESSION['flash_error'] ?? null
            ];
            
            // Clear flash messages
            unset($_SESSION['flash_success']);
            unset($_SESSION['flash_error']);
            
            $this->adminView('products/index', $data);
            
        } catch (\Exception $e) {
            error_log("Product listing error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error loading products: ' . $e->getMessage();
            header('Location: /admin/dashboard');
            exit;
        }
    }
    
    public function create() {
        $this->setAdminTitle('Add New Product');
        $this->requirePermission('manage_products');
        
        $data = [
            'title' => 'Add New Product - OneStore Admin',
            'admin_user' => $this->adminUser,
            'error' => $_SESSION['flash_error'] ?? null
        ];
        
        unset($_SESSION['flash_error']);
        
        $this->adminView('products/create', $data);
    }
    
    public function store() {
        $this->requirePermission('manage_products');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/products/create');
            exit;
        }
        
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $category_id = intval($_POST['category_id'] ?? 0);
        $status = $_POST['status'] ?? 'active';
        
        if (empty($name) || $price <= 0) {
            $_SESSION['flash_error'] = 'Product name and valid price are required';
            header('Location: /admin/products/create');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            if (!$pdo) {
                throw new Exception('Database connection failed');
            }
            
            $this->createProductsTable($pdo);
            
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, category_id, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$name, $description, $price, $category_id, $status]);
            
            $_SESSION['flash_success'] = 'Product created successfully';
            header('Location: /admin/products');
            exit;
            
        } catch (\Exception $e) {
            error_log("Product creation error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error creating product: ' . $e->getMessage();
            header('Location: /admin/products/create');
            exit;
        }
    }
    
    public function edit() {
        $this->setAdminTitle('Edit Product');
        $this->requirePermission('manage_products');
        
        $id = intval($_GET['id'] ?? 0);
        
        if (!$id) {
            $_SESSION['flash_error'] = 'Product not found';
            header('Location: /admin/products');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if (!$product) {
                $_SESSION['flash_error'] = 'Product not found';
                header('Location: /admin/products');
                exit;
            }
            
            $data = [
                'title' => 'Edit Product - OneStore Admin',
                'product' => $product,
                'admin_user' => $this->adminUser,
                'error' => $_SESSION['flash_error'] ?? null
            ];
            
            unset($_SESSION['flash_error']);
            
            $this->adminView('products/edit', $data);
            
        } catch (\Exception $e) {
            error_log("Product edit error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error loading product';
            header('Location: /admin/products');
            exit;
        }
    }
    
    public function update() {
        $this->requirePermission('manage_products');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/products');
            exit;
        }
        
        $id = intval($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $category_id = intval($_POST['category_id'] ?? 0);
        $status = $_POST['status'] ?? 'active';
        
        if (!$id || empty($name) || $price <= 0) {
            $_SESSION['flash_error'] = 'Invalid product data';
            header('Location: /admin/products/edit?id=' . $id);
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, category_id = ?, status = ?, updated_at = NOW() WHERE id = ?");
            $stmt->execute([$name, $description, $price, $category_id, $status, $id]);
            
            $_SESSION['flash_success'] = 'Product updated successfully';
            header('Location: /admin/products');
            exit;
            
        } catch (\Exception $e) {
            error_log("Product update error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error updating product';
            header('Location: /admin/products/edit?id=' . $id);
            exit;
        }
    }
    
    public function delete() {
        $this->requirePermission('manage_products');
        
        $id = intval($_GET['id'] ?? 0);
        
        if (!$id) {
            $_SESSION['flash_error'] = 'Product not found';
            header('Location: /admin/products');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$id]);
            
            $_SESSION['flash_success'] = 'Product deleted successfully';
            header('Location: /admin/products');
            exit;
            
        } catch (\Exception $e) {
            error_log("Product deletion error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error deleting product';
            header('Location: /admin/products');
            exit;
        }
    }
    
    /**
     * Render admin view
     */
    protected function adminView($view, $data = []) {
        extract($data);
        
        $viewPath = $this->getViewPath($view);
        
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "Admin view not found: $view";
        }
    }
} 