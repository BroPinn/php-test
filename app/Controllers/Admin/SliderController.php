<?php
namespace App\Controllers\Admin;

use Exception;

class SliderController extends AdminController
{
    protected function getViewPath($view)
    {
        return __DIR__ . '/../../Views/Admin/' . $view . '.php';
    }

    public function index()
    {
        $this->setAdminTitle('Slider Management');
        $this->requirePermission('manage_products');

        try {
            $pdo = $this->connectDatabase();
            if (!$pdo)
                throw new Exception('Database connection failed');

            $sliders = $pdo->query("SELECT * FROM tbl_slider ORDER BY position ASC, sliderID ASC")->fetchAll(\PDO::FETCH_ASSOC);

            $this->adminView('slider/index', [
                'title' => 'Slider Management - OneStore Admin',
                'sliders' => $sliders,
                'admin_user' => $this->adminUser,
                'success' => $this->getFlash('success'),
                'error' => $this->getFlash('error')
            ]);

        } catch (Exception $e) {
            error_log("Slider listing error: " . $e->getMessage());
            $this->flashRedirect('error', 'Error loading sliders: ' . $e->getMessage(), '/admin/dashboard');
        }
    }

    public function store()
    {
        $this->requirePermission('manage_products');
        if (!$this->isPost())
            return $this->jsonError('Invalid request method');

        $data = $this->getSliderData();

        if (empty($data['title']))
            return $this->jsonError('Slider title is required');
        if (!isset($_FILES['slider_image']) || $_FILES['slider_image']['error'] !== UPLOAD_ERR_OK) {
            return $this->jsonError('Slider image is required');
        }

        try {
            $pdo = $this->connectDatabase();
            if (!$pdo)
                throw new Exception('Database connection failed');

            $uploadResult = $this->handleImageUpload($_FILES['slider_image']);
            if (!$uploadResult['success']) {
                return $this->jsonError('Image upload failed: ' . $uploadResult['error']);
            }

            $stmt = $pdo->prepare("
                INSERT INTO tbl_slider (title, subtitle, description, image, link_url, button_text, position, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $data['title'],
                $data['subtitle'],
                $data['description'],
                $uploadResult['filename'],
                $data['linkUrl'],
                $data['buttonText'],
                $data['position'],
                $data['status']
            ]);

            $this->jsonSuccess('Slider created successfully');

        } catch (Exception $e) {
            error_log("Slider creation error: " . $e->getMessage());
            $this->jsonError('Error creating slider: ' . $e->getMessage());
        }
    }

    public function update()
    {
        $this->requirePermission('manage_products');
        if (!$this->isPost())
            return $this->jsonError('Invalid request method');

        $sliderID = intval($_GET['id'] ?? 0);
        $data = $this->getSliderData();

        if (!$sliderID || empty($data['title'])) {
            return $this->jsonError('Slider ID and title are required');
        }

        try {
            $pdo = $this->connectDatabase();

            $stmt = $pdo->prepare("SELECT image FROM tbl_slider WHERE sliderID = ?");
            $stmt->execute([$sliderID]);
            $currentSlider = $stmt->fetch(\PDO::FETCH_ASSOC);

            $imagePath = $currentSlider['image'] ?? null;

            // Handle new image upload
            if (isset($_FILES['slider_image']) && $_FILES['slider_image']['error'] === UPLOAD_ERR_OK) {
                $this->deleteOldImage($imagePath);
                $uploadResult = $this->handleImageUpload($_FILES['slider_image']);
                if ($uploadResult['success']) {
                    $imagePath = $uploadResult['filename'];
                } else {
                    return $this->jsonError('Image upload failed: ' . $uploadResult['error']);
                }
            }

            $stmt = $pdo->prepare("
                UPDATE tbl_slider SET 
                title = ?, subtitle = ?, description = ?, image = ?, 
                link_url = ?, button_text = ?, position = ?, status = ? 
                WHERE sliderID = ?
            ");
            $stmt->execute([
                $data['title'],
                $data['subtitle'],
                $data['description'],
                $imagePath,
                $data['linkUrl'],
                $data['buttonText'],
                $data['position'],
                $data['status'],
                $sliderID
            ]);

            $this->jsonSuccess('Slider updated successfully');

        } catch (Exception $e) {
            error_log("Slider update error: " . $e->getMessage());
            $this->jsonError('Error updating slider: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $this->requirePermission('manage_products');
        if (!$this->isPost())
            return $this->jsonError('Invalid request method');

        $sliderID = intval($_GET['id'] ?? $_POST['sliderID'] ?? 0);
        if (!$sliderID)
            return $this->jsonError('Slider ID required');

        try {
            $pdo = $this->connectDatabase();

            $stmt = $pdo->prepare("SELECT image FROM tbl_slider WHERE sliderID = ?");
            $stmt->execute([$sliderID]);
            $slider = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$slider)
                return $this->jsonError('Slider not found');

            $this->deleteOldImage($slider['image']);

            $stmt = $pdo->prepare("DELETE FROM tbl_slider WHERE sliderID = ?");
            $success = $stmt->execute([$sliderID]);

            if ($success && $stmt->rowCount() > 0) {
                $this->jsonSuccess('Slider deleted successfully');
            } else {
                $this->jsonError('Failed to delete slider');
            }

        } catch (Exception $e) {
            error_log("Slider deletion error: " . $e->getMessage());
            $this->jsonError('Error deleting slider: ' . $e->getMessage());
        }
    }

    public function get()
    {
        $this->requirePermission('manage_products');
        $sliderID = intval($_GET['id'] ?? 0);

        if (!$sliderID)
            return $this->jsonError('Slider ID required');

        try {
            $pdo = $this->connectDatabase();
            $stmt = $pdo->prepare("SELECT * FROM tbl_slider WHERE sliderID = ?");
            $stmt->execute([$sliderID]);
            $slider = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$slider)
                return $this->jsonError('Slider not found');

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'slider' => $slider]);
            exit;

        } catch (Exception $e) {
            error_log("Slider get error: " . $e->getMessage());
            $this->jsonError('Error loading slider');
        }
    }

    // =========================================================================
    // HELPER METHODS
    // =========================================================================



    private function getSliderData(): array
    {
        return [
            'title' => trim($_POST['title'] ?? ''),
            'subtitle' => trim($_POST['subtitle'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'linkUrl' => trim($_POST['link_url'] ?? ''),
            'buttonText' => trim($_POST['button_text'] ?? ''),
            'position' => intval($_POST['position'] ?? 1),
            'status' => intval($_POST['status'] ?? 1)
        ];
    }

    private function deleteOldImage(?string $imagePath): void
    {
        if (!$imagePath)
            return;

        $paths = [
            __DIR__ . '/../../../public/uploads/slider/' . basename($imagePath),
            __DIR__ . '/../../../public/uploads/' . $imagePath
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                @unlink($path);
                break;
            }
        }
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

    private function jsonError(string $message): void
    {
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

        $uploadDir = __DIR__ . '/../../../public/uploads/slider/';
        if (!is_dir($uploadDir))
            mkdir($uploadDir, 0755, true);
        if (!is_writable($uploadDir)) {
            return ['success' => false, 'error' => 'Upload directory not writable'];
        }

        $filename = uniqid() . '_' . time() . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            return ['success' => true, 'filename' => 'slider/' . $filename];
        }
        return ['success' => false, 'error' => 'Failed to move file'];
    }
}