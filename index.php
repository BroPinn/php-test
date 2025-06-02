<?php
/**
 * OneStore Application Entry Point
 */

// Load configuration
require_once 'config/app.php';

// Load autoloader
require_once 'app/autoload.php';

// Import required classes
use App\Controllers\Client\HomeController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\ProductController;
use App\Helpers\Helper;

try {
    // Initialize the application
    $uri = $_SERVER['REQUEST_URI'];
    $path = parse_url($uri, PHP_URL_PATH);
    $path = str_replace('/php-test', '', $path); // Remove base path
    
    // Admin Routes
    if (strpos($path, '/admin') === 0) {
        
        // Remove /admin prefix for admin routing
        $adminPath = substr($path, 6);
        
        switch ($adminPath) {
            case '':
            case '/':
            case '/dashboard':
                $controller = new DashboardController();
                $controller->index();
                break;
                
            case '/login':
                $controller = new AuthController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->login();
                } else {
                    $controller->showLogin();
                }
                break;
                
            case '/logout':
                $controller = new AuthController();
                $controller->logout();
                break;
                
            case '/products':
                $controller = new ProductController();
                $controller->index();
                break;
                
            case '/products/create':
                $controller = new ProductController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->store();
                } else {
                    $controller->create();
                }
                break;
                
            case '/products/edit':
                $controller = new ProductController();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->update();
                } else {
                    $controller->edit();
                }
                break;
                
            case '/products/delete':
                $controller = new ProductController();
                $controller->delete();
                break;
                
            default:
                http_response_code(404);
                echo '<h1>404 - Admin Page Not Found</h1>';
                break;
        }
        
    } else {
        // Client Routes
        $controller = new HomeController();
        
        switch ($path) {
            case '/':
            case '/home':
                $controller->home();
                break;
                
            case '/about':
                $controller->about();
                break;
                
            case '/shop':
                $controller->shop();
                break;
                
            case '/checkout':
                $controller->checkout();
                break;
                
            case '/blog':
                $controller->blog();
                break;
                
            case '/contact':
                $controller->contact();
                break;
                
            default:
                http_response_code(404);
                echo '<h1>404 - Page Not Found</h1>';
                break;
        }
    }
    
} catch (Exception $e) {
    // Handle errors gracefully
    if (DEBUG_MODE) {
        echo '<h1>Application Error</h1>';
        echo '<pre>' . $e->getMessage() . '</pre>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    } else {
        echo '<h1>Something went wrong</h1>';
        error_log($e->getMessage());
    }
}
?>
