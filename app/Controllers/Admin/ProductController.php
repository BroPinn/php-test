<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use Exception;

class ProductController extends AdminController
{
    protected function getViewPath($view)
    {
        return __DIR__ . '/../../Views/Admin/' . $view . '.php';
    }

    public function index()
    {
        $this->setAdminTitle('Product Management');
        $this->requirePermission('manage_products');

        try {
            $pdo = $this->connectDatabase();
            if (!$pdo)
                throw new Exception('Database connection failed');

            $products = $pdo->query("
                SELECT p.*, p.productName as name, c.catName as category_name, b.brandName as brand_name
                FROM tbl_product p
                LEFT JOIN tbl_category c ON p.categoryID = c.categoryID
                LEFT JOIN tbl_brand b ON p.brandID = b.brandID
                ORDER BY p.productID ASC
            ")->fetchAll(\PDO::FETCH_ASSOC);

            $categories = $pdo->query("SELECT categoryID, catName as name FROM tbl_category WHERE status = 1 ORDER BY catName")->fetchAll(\PDO::FETCH_ASSOC);
            $brands = $pdo->query("SELECT brandID, brandName as name FROM tbl_brand WHERE status = 1 ORDER BY brandName")->fetchAll(\PDO::FETCH_ASSOC);

            $this->adminView('products/index', [
                'title' => 'Product Management - OneStore Admin',
                'products' => $products,
                'categories' => $categories,
                'brands' => $brands,
                'success' => $this->getFlash('success'),
                'error' => $this->getFlash('error')
            ]);

        } catch (Exception $e) {
            error_log("Product listing error: " . $e->getMessage());
            $this->flashRedirect('error', 'Error loading products: ' . $e->getMessage(), '/admin/dashboard');
        }
    }

    public function create()
    {
        $this->setAdminTitle('Add New Product');
        $this->requirePermission('manage_products');

        $this->adminView('products/create', [
            'title' => 'Add New Product - OneStore Admin',
            'admin_user' => $this->adminUser,
            'error' => $this->getFlash('error')
        ]);
    }

    public function store()
    {
        $this->requirePermission('manage_products');
        if (!$this->isPost())
            return $this->redirect('/admin/products');

        $data = $this->getProductData();

        if (empty($data['name']) || $data['price'] <= 0 || !$data['categoryID']) {
            return $this->jsonError('Product name, valid price, and category are required');
        }

        try {
            $pdo = $this->connectDatabase();
            if (!$pdo)
                throw new Exception('Database connection failed');

            $imagePath = $this->processImageUpload();

            $slug = $this->createSlug($data['name']);
            $stmt = $pdo->prepare("
                INSERT INTO tbl_product 
                (categoryID, brandID, productName, slug, description, short_description, price, sale_price, sku, stock_quantity, image_path, status, featured, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $data['categoryID'],
                $data['brandID'] ?: null,
                $data['name'],
                $slug,
                $data['description'],
                $data['shortDescription'],
                $data['price'],
                $data['salePrice'] ?: null,
                $data['sku'],
                $data['stock'],
                $imagePath,
                $data['status'],
                $data['featured']
            ]);

            $_SESSION['flash_success'] = 'Product created successfully';
            $this->jsonSuccess('Product created successfully');

        } catch (Exception $e) {
            error_log("Product creation error: " . $e->getMessage());
            $this->jsonError('Error creating product: ' . $e->getMessage());
        }
    }

    public function edit()
    {
        $this->setAdminTitle('Edit Product');
        $this->requirePermission('manage_products');

        $id = intval($_GET['id'] ?? 0);
        if (!$id)
            return $this->flashRedirect('error', 'Product not found', '/admin/products');

        try {
            $pdo = $this->connectDatabase();
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$product)
                return $this->flashRedirect('error', 'Product not found', '/admin/products');

            $this->adminView('products/edit', [
                'title' => 'Edit Product - OneStore Admin',
                'product' => $product,
                'admin_user' => $this->adminUser,
                'error' => $this->getFlash('error')
            ]);

        } catch (Exception $e) {
            error_log("Product edit error: " . $e->getMessage());
            $this->flashRedirect('error', 'Error loading product', '/admin/products');
        }
    }

    public function update()
    {
        $this->requirePermission('manage_products');
        if (!$this->isPost())
            return $this->redirect('/admin/products');

        $productID = intval($_GET['id'] ?? 0);
        $data = $this->getProductData();

        if (!$productID || empty($data['name']) || $data['price'] <= 0 || !$data['categoryID']) {
            return $this->jsonError('Invalid product data');
        }

        try {
            $pdo = $this->connectDatabase();

            $stmt = $pdo->prepare("SELECT image_path FROM tbl_product WHERE productID = ?");
            $stmt->execute([$productID]);
            $currentProduct = $stmt->fetch(\PDO::FETCH_ASSOC);

            $imagePath = $currentProduct['image_path'] ?? null;

            // Handle new image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                if ($imagePath)
                    @unlink(__DIR__ . "/../../../public/uploads/$imagePath");
                $result = $this->handleImageUpload($_FILES['image']);
                if ($result['success']) {
                    $imagePath = $result['filename'];
                } else {
                    return $this->jsonError('Image upload failed: ' . $result['error']);
                }
            }

            $slug = $this->createSlug($data['name']);
            $stmt = $pdo->prepare("
                UPDATE tbl_product SET 
                categoryID = ?, brandID = ?, productName = ?, slug = ?, description = ?, 
                short_description = ?, price = ?, sale_price = ?, sku = ?, stock_quantity = ?, 
                image_path = ?, status = ?, featured = ?, updated_at = NOW() 
                WHERE productID = ?
            ");
            $stmt->execute([
                $data['categoryID'],
                $data['brandID'] ?: null,
                $data['name'],
                $slug,
                $data['description'],
                $data['shortDescription'],
                $data['price'],
                $data['salePrice'] ?: null,
                $data['sku'],
                $data['stock'],
                $imagePath,
                $data['status'],
                $data['featured'],
                $productID
            ]);

            $_SESSION['flash_success'] = 'Product updated successfully';
            $this->jsonSuccess('Product updated successfully');

        } catch (Exception $e) {
            error_log("Product update error: " . $e->getMessage());
            $this->jsonError('Error updating product: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->requirePermission('manage_products');
        $productID = intval($_GET['id'] ?? 0);

        if (!$productID)
            return $this->flashRedirect('error', 'Product not found', '/admin/products');

        try {
            $pdo = $this->connectDatabase();
            $stmt = $pdo->prepare("DELETE FROM tbl_product WHERE productID = ?");
            $stmt->execute([$productID]);

            $this->flashRedirect('success', 'Product deleted successfully', '/admin/products');

        } catch (Exception $e) {
            error_log("Product deletion error: " . $e->getMessage());
            $this->flashRedirect('error', 'Error deleting product: ' . $e->getMessage(), '/admin/products');
        }
    }

    public function get()
    {
        $this->requirePermission('manage_products');
        $productID = intval($_GET['id'] ?? 0);

        if (!$productID)
            return $this->jsonError('Product not found', 404);

        try {
            $pdo = $this->connectDatabase();
            $stmt = $pdo->prepare("SELECT *, productName as name, stock_quantity as stock FROM tbl_product WHERE productID = ?");
            $stmt->execute([$productID]);
            $product = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$product)
                return $this->jsonError('Product not found', 404);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'product' => $product]);
            exit;

        } catch (Exception $e) {
            $this->jsonError('Database error', 500);
        }
    }

    // =========================================================================
    // HELPER METHODS
    // =========================================================================



    private function getProductData(): array
    {
        return [
            'name' => trim($_POST['name'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'shortDescription' => trim($_POST['short_description'] ?? ''),
            'price' => floatval($_POST['price'] ?? 0),
            'salePrice' => floatval($_POST['sale_price'] ?? 0),
            'categoryID' => intval($_POST['category_id'] ?? 0),
            'brandID' => intval($_POST['brand_id'] ?? 0),
            'sku' => trim($_POST['sku'] ?? ''),
            'stock' => intval($_POST['stock'] ?? 0),
            'status' => intval($_POST['status'] ?? 1),
            'featured' => intval($_POST['featured'] ?? 0)
        ];
    }

    private function createSlug(string $text): string
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
    }

    private function processImageUpload(): ?string
    {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        $result = $this->handleImageUpload($_FILES['image']);
        if (!$result['success']) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Image upload failed: ' . $result['error']]);
            exit;
        }
        return $result['filename'];
    }

    private function getFlash(string $key): ?string
    {
        $value = $_SESSION["flash_$key"] ?? null;
        unset($_SESSION["flash_$key"]);
        return $value;
    }

    private function flashRedirect(string $type, string $message, string $url): void
    {
        $_SESSION["flash_$type"] = $message;
        header("Location: $url");
        exit;
    }



    private function jsonSuccess(string $message): void
    {
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => $message]);
        exit;
    }

    private function jsonError(string $message, int $code = 200): void
    {
        if ($code !== 200)
            http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => $message]);
        exit;
    }

    private function handleImageUpload($file): array
    {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $maxSize = 5 * 1024 * 1024;

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Upload error code: ' . $file['error']];
        }
        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'File too large (max 5MB)'];
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedTypes)) {
            return ['success' => false, 'error' => 'Invalid file type'];
        }

        $uploadDir = __DIR__ . '/../../../public/uploads/products/';
        if (!is_dir($uploadDir))
            mkdir($uploadDir, 0755, true);
        if (!is_writable($uploadDir)) {
            return ['success' => false, 'error' => 'Upload directory not writable'];
        }

        $filename = uniqid() . '_' . time() . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            return ['success' => true, 'filename' => 'products/' . $filename];
        }
        return ['success' => false, 'error' => 'Failed to move file'];
    }

    protected function adminView($view, $data = [])
    {
        extract($data);
        $viewPath = $this->getViewPath($view);
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "Admin view not found: $view";
        }
    }
}