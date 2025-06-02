<?php
namespace App\Controllers\Admin;

use Exception;

class SliderController extends AdminController {
    
    protected function getViewPath($view) {
        return __DIR__ . '/../../Views/Admin/' . $view . '.php';
    }
    
    public function index() {
        $this->setAdminTitle('Slider Management');
        $this->requirePermission('manage_products');
        
        try {
            $pdo = $this->connectDatabase();
            
            if (!$pdo) {
                throw new Exception('Database connection failed');
            }
            
            // Get all sliders sorted by position
            $sql = "SELECT * FROM tbl_slider ORDER BY position ASC, sliderID ASC";
            $stmt = $pdo->query($sql);
            $sliders = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            $data = [
                'title' => 'Slider Management - OneStore Admin',
                'sliders' => $sliders,
                'admin_user' => $this->adminUser,
                'success' => $_SESSION['flash_success'] ?? null,
                'error' => $_SESSION['flash_error'] ?? null
            ];
            
            // Clear flash messages
            unset($_SESSION['flash_success']);
            unset($_SESSION['flash_error']);
            
            $this->adminView('slider/index', $data);
            
        } catch (\Exception $e) {
            error_log("Slider listing error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error loading sliders: ' . $e->getMessage();
            header('Location: /admin/dashboard');
            exit;
        }
    }
    
    public function store() {
        $this->requirePermission('manage_products');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/slider');
            exit;
        }
        
        $title = trim($_POST['title'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $linkUrl = trim($_POST['link_url'] ?? '');
        $buttonText = trim($_POST['button_text'] ?? '');
        $position = intval($_POST['position'] ?? 1);
        $status = intval($_POST['status'] ?? 1);
        
        if (empty($title)) {
            $_SESSION['flash_error'] = 'Slider title is required';
            header('Location: /admin/slider');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            if (!$pdo) {
                throw new Exception('Database connection failed');
            }
            
            // Handle image upload
            $imagePath = null;
            if (isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $this->handleImageUpload($_FILES['slider_image']);
                if ($uploadResult['success']) {
                    $imagePath = $uploadResult['filename'];
                } else {
                    $_SESSION['flash_error'] = 'Image upload failed: ' . $uploadResult['error'];
                    header('Location: /admin/slider');
                    exit;
                }
            }
            
            $stmt = $pdo->prepare("INSERT INTO tbl_slider (title, subtitle, description, image, link_url, button_text, position, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$title, $subtitle, $description, $imagePath, $linkUrl, $buttonText, $position, $status]);
            
            $_SESSION['flash_success'] = 'Slider created successfully';
            header('Location: /admin/slider');
            exit;
            
        } catch (\Exception $e) {
            error_log("Slider creation error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error creating slider: ' . $e->getMessage();
            header('Location: /admin/slider');
            exit;
        }
    }
    
    public function update() {
        $this->requirePermission('manage_products');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/slider');
            exit;
        }
        
        $sliderID = intval($_POST['sliderID'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $subtitle = trim($_POST['subtitle'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $linkUrl = trim($_POST['link_url'] ?? '');
        $buttonText = trim($_POST['button_text'] ?? '');
        $position = intval($_POST['position'] ?? 1);
        $status = intval($_POST['status'] ?? 1);
        
        if (!$sliderID || empty($title)) {
            $_SESSION['flash_error'] = 'Invalid slider data';
            header('Location: /admin/slider');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            // Get current slider data
            $stmt = $pdo->prepare("SELECT image FROM tbl_slider WHERE sliderID = ?");
            $stmt->execute([$sliderID]);
            $currentSlider = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            $imagePath = $currentSlider['image'] ?? null;
            
            // Handle image upload
            if (isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] === UPLOAD_ERR_OK) {
                // Delete old image if it exists
                if ($imagePath && file_exists("public/uploads/slider/$imagePath")) {
                    unlink("public/uploads/slider/$imagePath");
                }
                
                $uploadResult = $this->handleImageUpload($_FILES['slider_image']);
                if ($uploadResult['success']) {
                    $imagePath = $uploadResult['filename'];
                } else {
                    $_SESSION['flash_error'] = 'Image upload failed: ' . $uploadResult['error'];
                    header('Location: /admin/slider');
                    exit;
                }
            }
            
            $stmt = $pdo->prepare("UPDATE tbl_slider SET title = ?, subtitle = ?, description = ?, image = ?, link_url = ?, button_text = ?, position = ?, status = ?, updated_at = NOW() WHERE sliderID = ?");
            $stmt->execute([$title, $subtitle, $description, $imagePath, $linkUrl, $buttonText, $position, $status, $sliderID]);
            
            $_SESSION['flash_success'] = 'Slider updated successfully';
            header('Location: /admin/slider');
            exit;
            
        } catch (\Exception $e) {
            error_log("Slider update error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error updating slider: ' . $e->getMessage();
            header('Location: /admin/slider');
            exit;
        }
    }
    
    public function delete() {
        $this->requirePermission('manage_products');
        
        $sliderID = intval($_GET['id'] ?? 0);
        
        if (!$sliderID) {
            $_SESSION['flash_error'] = 'Slider not found';
            header('Location: /admin/slider');
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            // Get slider image to delete file
            $stmt = $pdo->prepare("SELECT image FROM tbl_slider WHERE sliderID = ?");
            $stmt->execute([$sliderID]);
            $slider = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            // Delete image file if exists
            if ($slider && $slider['image'] && file_exists("public/uploads/slider/{$slider['image']}")) {
                unlink("public/uploads/slider/{$slider['image']}");
            }
            
            // Delete slider from database
            $stmt = $pdo->prepare("DELETE FROM tbl_slider WHERE sliderID = ?");
            $stmt->execute([$sliderID]);
            
            $_SESSION['flash_success'] = 'Slider deleted successfully';
            header('Location: /admin/slider');
            exit;
            
        } catch (\Exception $e) {
            error_log("Slider deletion error: " . $e->getMessage());
            $_SESSION['flash_error'] = 'Error deleting slider: ' . $e->getMessage();
            header('Location: /admin/slider');
            exit;
        }
    }
    
    public function get() {
        $this->requirePermission('manage_products');
        
        $sliderID = intval($_GET['id'] ?? 0);
        
        if (!$sliderID) {
            http_response_code(404);
            echo json_encode(['error' => 'Slider not found']);
            exit;
        }
        
        try {
            $pdo = $this->connectDatabase();
            
            $stmt = $pdo->prepare("SELECT * FROM tbl_slider WHERE sliderID = ?");
            $stmt->execute([$sliderID]);
            $slider = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if (!$slider) {
                http_response_code(404);
                echo json_encode(['error' => 'Slider not found']);
                exit;
            }
            
            header('Content-Type: application/json');
            echo json_encode($slider);
            exit;
            
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Database error']);
            exit;
        }
    }
    
    /**
     * Handle image upload for sliders
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
        $uploadDir = 'public/uploads/slider/';
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
} 