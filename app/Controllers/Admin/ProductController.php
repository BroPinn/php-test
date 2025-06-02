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
            
            // Get all products with category and brand information - sorted by ID
            $sql = "SELECT p.*, c.catName as categoryName, b.brandName 
                    FROM tbl_product p 
                    LEFT JOIN tbl_category c ON p.categoryID = c.categoryID 
                    LEFT JOIN tbl_brand b ON p.brandID = b.brandID 
                    ORDER BY p.productID ASC";
            $stmt = $pdo->query($sql);
            $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            // Get categories for the modal
            $categoriesStmt = $pdo->query("SELECT * FROM tbl_category WHERE status = 1 ORDER BY catName");
            $categories = $categoriesStmt->fetchAll(\PDO::FETCH_ASSOC);
            
            // Get brands for the modal
            $brandsStmt = $pdo->query("SELECT * FROM tbl_brand WHERE status = 1 ORDER BY brandName");
            $brands = $brandsStmt->fetchAll(\PDO::FETCH_ASSOC);
            
            $data = [
                'title' => 'Product Management - OneStore Admin',
                'products' => $products,
                'categories' => $categories,
                'brands' => $brands,
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
            header('Location: /admin/products');
            exit;
        }
        
        $productName = trim($_POST['productName'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $shortDescription = trim($_POST['short_description'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $salePrice = floatval($_POST['sale_price'] ?? 0);
        $categoryID = intval($_POST['categoryID'] ?? 0);
        $brandID = intval($_POST['brandID'] ?? 0);
        $sku = trim($_POST['sku'] ?? '');
        $stockQuantity = intval($_POST['stock_quantity'] ?? 0);
        $status = intval($_POST['status'] ?? 1);
        $featured = intval($_POST['featured'] ?? 0);
        
        if (empty($productName) || $price <= 0 || !$categoryID) {
            $_SESSION['flash_error'] = 'Product name, valid price, and category are required';
            header('Location: /admin/products');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            if (!$pdo) {
                throw new Exception('Database connection failed');
            }
            
            // Handle image upload
            $imagePath = null;
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['product_image']);
                if ($uploadResult['success']) {
                    $imagePath = $uploadResult['filename'];
                } else {
                    $_SESSION['flash_error'] = 'Image upload failed: ' . $uploadResult['error'];
                    header('Location: /admin/products');
                    exit;
                }
            }
            
            // Generate slug from product name
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $productName)));
            
            $stmt = $pdo->prepare("INSERT INTO tbl_product (categoryID, brandID, productName, slug, description, short_description, price, sale_price, sku, stock_quantity, image_path, status, featured, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$categoryID, $brandID ?: null, $productName, $slug, $description, $shortDescription, $price, $salePrice ?: null, $sku, $stockQuantity, $imagePath, $status, $featured]);
            
            $_SESSION['flash_success'] = 'Product created successfully';
            header('Location: /admin/products');
            exit;
            
        } catch (\Exception $e) {
            error_log("Product creation error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error creating product: ' . $e->getMessage();
            header('Location: /admin/products');
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
        
        $productID = intval($_POST['productID'] ?? 0);
        $productName = trim($_POST['productName'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $shortDescription = trim($_POST['short_description'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $salePrice = floatval($_POST['sale_price'] ?? 0);
        $categoryID = intval($_POST['categoryID'] ?? 0);
        $brandID = intval($_POST['brandID'] ?? 0);
        $sku = trim($_POST['sku'] ?? '');
        $stockQuantity = intval($_POST['stock_quantity'] ?? 0);
        $status = intval($_POST['status'] ?? 1);
        $featured = intval($_POST['featured'] ?? 0);
        
        if (!$productID || empty($productName) || $price <= 0 || !$categoryID) {
            $_SESSION['flash_error'] = 'Invalid product data';
            header('Location: /admin/products');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            // Get current product data
            $stmt = $pdo->prepare("SELECT image_path FROM tbl_product WHERE productID = ?");
            $stmt->execute([$productID]);
            $currentProduct = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            $imagePath = $currentProduct['image_path'] ?? null;
            
            // Handle image upload
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                // Delete old image if it exists
                if ($imagePath && file_exists("public/uploads/products/$imagePath")) {
                    unlink("public/uploads/products/$imagePath");
                }
                
                $uploadResult = $this->handleImageUpload($_FILES['product_image']);
                if ($uploadResult['success']) {
                    $imagePath = $uploadResult['filename'];
                } else {
                    $_SESSION['flash_error'] = 'Image upload failed: ' . $uploadResult['error'];
                    header('Location: /admin/products');
                    exit;
                }
            }
            
            // Generate slug from product name
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $productName)));
            
            $stmt = $pdo->prepare("UPDATE tbl_product SET categoryID = ?, brandID = ?, productName = ?, slug = ?, description = ?, short_description = ?, price = ?, sale_price = ?, sku = ?, stock_quantity = ?, image_path = ?, status = ?, featured = ?, updated_at = NOW() WHERE productID = ?");
            $stmt->execute([$categoryID, $brandID ?: null, $productName, $slug, $description, $shortDescription, $price, $salePrice ?: null, $sku, $stockQuantity, $imagePath, $status, $featured, $productID]);
            
            $_SESSION['flash_success'] = 'Product updated successfully';
            header('Location: /admin/products');
            exit;
            
        } catch (\Exception $e) {
            error_log("Product update error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error updating product: ' . $e->getMessage();
            header('Location: /admin/products');
            exit;
        }
    }
    
    public function delete() {
        $this->requirePermission('manage_products');
        
        $productID = intval($_GET['id'] ?? 0);
        
        if (!$productID) {
            $_SESSION['flash_error'] = 'Product not found';
            header('Location: /admin/products');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            $stmt = $pdo->prepare("DELETE FROM tbl_product WHERE productID = ?");
            $stmt->execute([$productID]);
            
            $_SESSION['flash_success'] = 'Product deleted successfully';
            header('Location: /admin/products');
            exit;
            
        } catch (\Exception $e) {
            error_log("Product deletion error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error deleting product: ' . $e->getMessage();
            header('Location: /admin/products');
            exit;
        }
    }
    
    public function get() {
        $this->requirePermission('manage_products');
        
        $productID = intval($_GET['id'] ?? 0);
        
        if (!$productID) {
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            $stmt = $pdo->prepare("SELECT * FROM tbl_product WHERE productID = ?");
            $stmt->execute([$productID]);
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if (!$product) {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
                exit;
            }
            
            header('Content-Type: application/json');
            echo json_encode($product);
            exit;
            
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Database error']);
            exit;
        }
    }
    
    /**
     * Handle image upload
     */
    private function handleImageUpload($file) {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        
        // Check if file was uploaded
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'File upload error'];
        }
        
        // Check file size
        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'File size too large (max 5MB)'];
        }
        
        // Check file type
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedTypes)) {
            return ['success' => false, 'error' => 'Invalid file type. Allowed: ' . implode(', ', $allowedTypes)];
        }
        
        // Create upload directory if it doesn't exist
        $uploadDir = 'public/uploads/products/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return ['success' => true, 'filename' => $filename];
        } else {
            return ['success' => false, 'error' => 'Failed to move uploaded file'];
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