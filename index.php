<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', __DIR__);

$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$basePath = ($scriptDir === '/' || $scriptDir === '\\') ? '' : $scriptDir;

$path = substr($requestUri, strlen($basePath));
$path = '/' . trim($path, '/');
if ($path === '//' || $path === '') {
    $path = '/';
}

function url($route = '') {
    global $basePath;
    return $basePath . '/' . ltrim($route, '/');
}

function admin_url($route = '') {
    global $basePath;
    return $basePath . '/admin/' . ltrim($route, '/');
}

function asset($file = '') {
    global $basePath;
    return $basePath . '/public/assets/' . ltrim($file, '/');
}

function upload($file = '') {
    global $basePath;
    if (empty($file)) {
        return asset('images/no-image.png');
    }
    return $basePath . '/public/uploads/' . ltrim($file, '/');
}

function is_admin_active($segment) {
    global $path;
    if ($segment === 'dashboard' && ($path === '/admin' || $path === '/admin/dashboard')) {
        return 'active';
    }
    return str_starts_with($path, '/admin/' . $segment) ? 'active' : '';
}

$routes = [
    '/' => [
        'view' => 'Client/pages/home.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Home - OneStore'
    ],
    '/home' => [
        'view' => 'Client/pages/home.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Home - OneStore'
    ],
    '/shop' => [
        'view' => 'Client/pages/shop.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Shop - OneStore'
    ],
    '/product' => [
        'view' => 'Client/pages/product-detail.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Product Details - OneStore'
    ],
    '/cart' => [
        'view' => 'Client/pages/cart.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Shopping Cart - OneStore'
    ],
    '/checkout' => [
        'view' => 'Client/pages/checkout.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Checkout - OneStore'
    ],
    '/order-confirmation' => [
        'view' => 'Client/pages/order-confirmation.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Order Confirmed - OneStore'
    ],
    '/about' => [
        'view' => 'Client/pages/about.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'About Us - OneStore'
    ],
    '/contact' => [
        'view' => 'Client/pages/contact.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Contact Us - OneStore'
    ],
    '/blog' => [
        'view' => 'Client/pages/blog.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Blog - OneStore'
    ],
    '/account' => [
        'view' => 'Client/pages/account.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'My Account - OneStore'
    ],
    '/login' => [
        'view' => 'Client/auth/login.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Login - OneStore'
    ],
    '/register' => [
        'view' => 'Client/auth/register.php',
        'layout' => 'Client/layouts/main.php',
        'title' => 'Register - OneStore'
    ],
    '/admin' => [
        'view' => 'Admin/dashboard/index.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Dashboard - OneStore Admin'
    ],
    '/admin/dashboard' => [
        'view' => 'Admin/dashboard/index.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Dashboard - OneStore Admin'
    ],
    '/admin/products' => [
        'view' => 'Admin/products/index.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Products - OneStore Admin'
    ],
    '/admin/categories' => [
        'view' => 'Admin/categories/index.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Categories - OneStore Admin'
    ],
    '/admin/brands' => [
        'view' => 'Admin/brands/index.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Brands - OneStore Admin'
    ],
    '/admin/orders' => [
        'view' => 'Admin/orders/index.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Orders - OneStore Admin'
    ],
    '/admin/orders/view' => [
        'view' => 'Admin/orders/view.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Order Details - OneStore Admin'
    ],
    '/admin/customers' => [
        'view' => 'Admin/customers/index.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Customers - OneStore Admin'
    ],
    '/admin/slider' => [
        'view' => 'Admin/slider/index.php',
        'layout' => 'Admin/layouts/admin.php',
        'title' => 'Slider - OneStore Admin'
    ],
    '/admin/login' => [
        'view' => 'Admin/auth/login.php',
        'layout' => null,
        'title' => 'Admin Login - OneStore'
    ],
];

if (preg_match('#^/product(/\d+)?$#', $path)) {
    $path = '/product';
}
if (preg_match('#^/order-confirmation(/\d+)?$#', $path)) {
    $path = '/order-confirmation';
}

if ($path === '/admin/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/app/Controllers/Admin/AuthController.php';
    AuthController::login();
}

if ($path === '/admin/logout') {
    require_once __DIR__ . '/app/Controllers/Admin/AuthController.php';
    AuthController::logout();
}

if (str_starts_with($path, '/admin')) {
    if ($path === '/admin/login') {
        if (isset($_SESSION['admin'])) {
            header('Location: ' . admin_url('dashboard'));
            exit;
        }
    } elseif (!isset($_SESSION['admin'])) {
        header('Location: ' . admin_url('login'));
        exit;
    }
}

if (isset($routes[$path])) {
    $route = $routes[$path];
    $page_title = $route['title'];
    $viewPath = __DIR__ . '/app/Views/' . $route['view'];

    if (!file_exists($viewPath)) {
        die("View not found: " . htmlspecialchars($viewPath));
    }

    if (!empty($route['layout'])) {
        ob_start();
        include $viewPath;
        $content = ob_get_clean();
        include __DIR__ . '/app/Views/' . $route['layout'];
    } else {
        include $viewPath;
    }
    exit;
}

http_response_code(404);
if (str_starts_with($path, '/admin')) {
    $page_title = '404 - Page Not Found | OneStore Admin';
    ob_start();
    include __DIR__ . '/app/Views/Admin/errors/404.php';
    $content = ob_get_clean();
    include __DIR__ . '/app/Views/Admin/layouts/admin.php';
} else {
    $page_title = '404 Not Found - OneStore';
    ob_start();
    include __DIR__ . '/app/Views/Client/errors/404.php';
    $content = ob_get_clean();
    include __DIR__ . '/app/Views/Client/layouts/main.php';
}
