<?php
/**
 * OneStore Application Configuration
 */

// TODO: Remove after complete migration
// Include the old config for backward compatibility during migration
// if (file_exists(__DIR__ . '/../config.php')) {
//     require_once __DIR__ . '/../config.php';
// }

// Application Settings
define('APP_NAME', 'OneStore');
define('APP_VERSION', '2.0.0');
define('APP_ENV', 'development'); // development, production
define('APP_URL', 'http://localhost:8000');

// Path Constants
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('STORAGE_PATH', ROOT_PATH . '/storage');
define('CONFIG_PATH', ROOT_PATH . '/config');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'onestore_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// File Upload Settings
define('UPLOAD_PATH', PUBLIC_PATH . '/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// Session Settings
define('SESSION_TIMEOUT', 7200); // 2 hours
define('SESSION_NAME', 'onestore_session');

// Security Settings
define('CSRF_TOKEN_NAME', '_token');
define('PASSWORD_HASH_ALGO', PASSWORD_DEFAULT);

// PayPal Configuration
define('PAYPAL_CLIENT_ID', 'ATdyQLhtH8ByRKGWfrCSVd13AJhyE9RT0oSvF2fn6oo0Zm4LbBLjL-_hha7DqCvN3dNVOJTqw8jhvb3u'); // Sandbox test client ID
define('PAYPAL_CLIENT_SECRET', 'EEMfzSecZwyG7_JU6fR497ZRA4CRcONB1og0ctUTb9Udk5eH1QoqxpjV_M9vBfZCAi0X6vTD1WmWhEof'); // Sandbox test client secret
define('PAYPAL_MODE', 'sandbox'); // 'sandbox' or 'live'
define('PAYPAL_API_URL', PAYPAL_MODE === 'live' ? 'https://api.paypal.com' : 'https://api.sandbox.paypal.com');

// Error Reporting
if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    define('DEBUG_MODE', true);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
    define('DEBUG_MODE', false);
}

// Timezone
if (!ini_get('date.timezone')) {
    date_default_timezone_set('UTC');
}

// Initialize session safely
if (!headers_sent() && session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
    
    // Session security
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    }
    
    // Session timeout
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
        session_unset();
        session_destroy();
        session_start();
    }
    $_SESSION['last_activity'] = time();
}
?> 