<?php
/**
 * OneStore Setup Script
 * Run this script to check if your environment is ready for the application
 */

// Prevent automatic session initialization
define('NO_AUTO_SESSION', true);

echo "<h1>OneStore Project Setup</h1>";
echo "<hr>";

// Check PHP version
echo "<h2>Environment Check</h2>";
$phpVersion = phpversion();
echo "<p><strong>PHP Version:</strong> $phpVersion";
if (version_compare($phpVersion, '7.4.0', '>=')) {
    echo " ✅ (Compatible)</p>";
} else {
    echo " ❌ (Requires PHP 7.4 or higher)</p>";
}

// Check required extensions
$requiredExtensions = ['pdo', 'pdo_mysql', 'json', 'session'];
echo "<p><strong>Required Extensions:</strong></p>";
echo "<ul>";
foreach ($requiredExtensions as $ext) {
    $loaded = extension_loaded($ext);
    $status = $loaded ? "✅" : "❌";
    echo "<li>$ext: $status</li>";
}
echo "</ul>";

// Check database connection
echo "<h2>Database Connection Test</h2>";
try {
    require_once 'database.php';
    $pdo = connectToDatabase();
    
    if ($pdo) {
        echo "<p>✅ Database connection successful!</p>";
        
        // Check if database exists and has tables
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        if (count($tables) > 0) {
            echo "<p>✅ Database tables found: " . implode(', ', $tables) . "</p>";
            
            // Check if admin table exists
            if (in_array('tbl_admin', $tables)) {
                echo "<p>✅ Admin table exists</p>";
                
                // Check if admin user exists
                $stmt = $pdo->query("SELECT COUNT(*) FROM tbl_admin");
                $adminCount = $stmt->fetchColumn();
                if ($adminCount > 0) {
                    echo "<p>✅ Admin user(s) found ($adminCount)</p>";
                } else {
                    echo "<p>⚠️ No admin users found. Please run admin_table.sql</p>";
                }
            } else {
                echo "<p>❌ Admin table missing. Please run admin_table.sql</p>";
            }
        } else {
            echo "<p>❌ No tables found. Please import data.sql first</p>";
        }
    } else {
        echo "<p>❌ Database connection failed!</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Database error: " . $e->getMessage() . "</p>";
    echo "<p><strong>Note:</strong> If the database doesn't exist, create it first using phpMyAdmin or MySQL client.</p>";
}

// Check directory permissions
echo "<h2>Directory Permissions</h2>";
$directories = ['uploads/images/', 'uploads/slider/'];
foreach ($directories as $dir) {
    if (is_dir($dir)) {
        if (is_writable($dir)) {
            echo "<p>✅ $dir is writable</p>";
        } else {
            echo "<p>❌ $dir is not writable</p>";
        }
    } else {
        echo "<p>⚠️ $dir does not exist</p>";
    }
}

// Show setup instructions
echo "<h2>Setup Instructions</h2>";
echo "<ol>";
echo "<li><strong>Create Database:</strong> Create a database named 'onestore_db' in phpMyAdmin or MySQL</li>";
echo "<li><strong>Import Schema:</strong> Import data.sql into the onestore_db database</li>";
echo "<li><strong>Create Admin Table:</strong> Run admin_table.sql to create the admin table and default user</li>";
echo "<li><strong>Check Permissions:</strong> Ensure upload directories have write permissions</li>";
echo "<li><strong>Update Config:</strong> Modify config.php if your database settings are different</li>";
echo "<li><strong>Test Application:</strong> Access your application at: <a href='index.php'>index.php</a></li>";
echo "<li><strong>Access Admin:</strong> Go to admin panel at: <a href='admin/'>admin/</a></li>";
echo "</ol>";

echo "<h2>Default Credentials</h2>";
echo "<p><strong>Admin Username:</strong> admin<br>";
echo "<strong>Admin Password:</strong> admin123</p>";

echo "<h2>Quick Database Setup Commands</h2>";
echo "<p>If you have MySQL command line access, you can run:</p>";
echo "<pre>";
echo "mysql -u root -p\n";
echo "CREATE DATABASE onestore_db;\n";
echo "USE onestore_db;\n";
echo "SOURCE data.sql;\n";
echo "SOURCE admin_table.sql;\n";
echo "EXIT;";
echo "</pre>";

echo "<hr>";
echo "<p><em>Delete this setup.php file after successful setup for security.</em></p>";
?> 