<?php
/**
 * OneStore Application Configuration
 * 
 * Loads environment variables from .env file and defines application constants.
 * This is the single source of truth for all configuration.
 */

// Prevent direct access
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}

/**
 * Load and parse .env file
 */
function loadEnvFile($path)
{
    if (!file_exists($path)) {
        return [];
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $env = [];

    foreach ($lines as $line) {
        // Skip comments
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }

        // Parse KEY=value
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Remove quotes if present
            if (preg_match('/^(["\'])(.*)\\1$/', $value, $matches)) {
                $value = $matches[2];
            }

            $env[$key] = $value;

            // Also set in $_ENV for compatibility
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }

    return $env;
}

/**
 * Get environment variable with default fallback
 * 
 * @param string $key The environment variable name
 * @param mixed $default Default value if not found
 * @return mixed
 */
function env($key, $default = null)
{
    global $_loadedEnv;

    // Check loaded env first
    if (isset($_loadedEnv[$key])) {
        return parseEnvValue($_loadedEnv[$key]);
    }

    // Check $_ENV
    if (isset($_ENV[$key])) {
        return parseEnvValue($_ENV[$key]);
    }

    // Check getenv()
    $value = getenv($key);
    if ($value !== false) {
        return parseEnvValue($value);
    }

    return $default;
}

/**
 * Parse environment value to appropriate type
 */
function parseEnvValue($value)
{
    if ($value === 'true' || $value === 'TRUE')
        return true;
    if ($value === 'false' || $value === 'FALSE')
        return false;
    if ($value === 'null' || $value === 'NULL')
        return null;
    if ($value === '' || $value === '""' || $value === "''")
        return '';
    if (is_numeric($value)) {
        return strpos($value, '.') !== false ? (float) $value : (int) $value;
    }
    return $value;
}

// ============================================================================
// LOAD ENVIRONMENT
// ============================================================================

// Load .env file
$_loadedEnv = loadEnvFile(ROOT_PATH . '/.env');

// ============================================================================
// APPLICATION SETTINGS
// ============================================================================

// Core application
if (!defined('APP_ENV'))
    define('APP_ENV', env('APP_ENV', 'development'));
if (!defined('APP_DEBUG'))
    define('APP_DEBUG', env('APP_DEBUG', true));
if (!defined('APP_NAME'))
    define('APP_NAME', env('APP_NAME', 'OneStore'));
if (!defined('APP_VERSION'))
    define('APP_VERSION', env('APP_VERSION', '2.0.0'));
if (!defined('APP_URL'))
    define('APP_URL', env('APP_URL', 'http://localhost:8000'));
if (!defined('BASE_PATH'))
    define('BASE_PATH', env('BASE_PATH', ''));

// Debug mode based on environment
if (!defined('DEBUG_MODE'))
    define('DEBUG_MODE', APP_ENV === 'development');

// ============================================================================
// DATABASE SETTINGS
// ============================================================================

if (!defined('DB_HOST'))
    define('DB_HOST', env('DB_HOST', 'localhost'));
if (!defined('DB_NAME'))
    define('DB_NAME', env('DB_NAME', 'onestore_db'));
if (!defined('DB_USER'))
    define('DB_USER', env('DB_USER', 'root'));
if (!defined('DB_PASS'))
    define('DB_PASS', env('DB_PASS', ''));
if (!defined('DB_CHARSET'))
    define('DB_CHARSET', env('DB_CHARSET', 'utf8mb4'));

// ============================================================================
// PAYPAL SETTINGS
// ============================================================================

if (!defined('PAYPAL_MODE'))
    define('PAYPAL_MODE', env('PAYPAL_MODE', 'sandbox'));
if (!defined('PAYPAL_CLIENT_ID'))
    define('PAYPAL_CLIENT_ID', env('PAYPAL_CLIENT_ID', ''));
if (!defined('PAYPAL_CLIENT_SECRET'))
    define('PAYPAL_CLIENT_SECRET', env('PAYPAL_CLIENT_SECRET', ''));
if (!defined('PAYPAL_API_URL')) {
    define(
        'PAYPAL_API_URL',
        PAYPAL_MODE === 'live'
        ? 'https://api.paypal.com'
        : 'https://api.sandbox.paypal.com'
    );
}

// ============================================================================
// FILE UPLOAD SETTINGS
// ============================================================================

if (!defined('MAX_FILE_SIZE'))
    define('MAX_FILE_SIZE', env('MAX_FILE_SIZE', 5 * 1024 * 1024));
if (!defined('ALLOWED_IMAGE_TYPES'))
    define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// ============================================================================
// SESSION SETTINGS
// ============================================================================

if (!defined('SESSION_TIMEOUT'))
    define('SESSION_TIMEOUT', env('SESSION_TIMEOUT', 7200));
if (!defined('SESSION_NAME'))
    define('SESSION_NAME', env('SESSION_NAME', 'onestore_session'));
if (!defined('CSRF_TOKEN_NAME'))
    define('CSRF_TOKEN_NAME', '_token');
if (!defined('PASSWORD_HASH_ALGO'))
    define('PASSWORD_HASH_ALGO', PASSWORD_DEFAULT);

// ============================================================================
// HELPER FUNCTIONS
// ============================================================================

/**
 * Get environment-aware base URL
 */
function getBaseUrl()
{
    return defined('BASE_PATH') && !empty(BASE_PATH) ? BASE_PATH : '';
}
?>