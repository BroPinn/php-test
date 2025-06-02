<?php
/**
 * OneStore Structure Migration Script
 * This script helps migrate from the old structure to the new refactored structure
 */

echo "<h1>🏗️ OneStore Structure Migration</h1>";
echo "<p>This script will help you migrate to the new improved structure.</p>";

// Check if we're in the correct directory
if (!file_exists('config.php') || !file_exists('index.php')) {
    die('<p style="color: red;">❌ Please run this script from the root directory of your project.</p>');
}

echo "<h2>📋 Migration Steps</h2>";

// Step 1: Create new directories
echo "<h3>Step 1: Creating new directory structure...</h3>";

$directories = [
    'app/Controllers/Client',
    'app/Controllers/Admin', 
    'app/Models',
    'app/Services',
    'app/Middleware',
    'app/Helpers',
    'app/Views/Client/layouts',
    'app/Views/Client/pages',
    'app/Views/Client/components',
    'app/Views/Admin/layouts',
    'app/Views/Admin/pages',
    'app/Views/Admin/components',
    'config',
    'database/migrations',
    'database/seeds',
    'storage/logs',
    'storage/cache',
    'public/assets/css',
    'public/assets/js',
    'public/assets/images',
    'public/uploads/products',
    'public/uploads/categories',
    'public/uploads/slider'
];

$created = 0;
$existed = 0;

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        if (mkdir($dir, 0755, true)) {
            echo "✅ Created: {$dir}<br>";
            $created++;
        } else {
            echo "❌ Failed to create: {$dir}<br>";
        }
    } else {
        echo "ℹ️ Already exists: {$dir}<br>";
        $existed++;
    }
}

echo "<p><strong>Summary:</strong> Created {$created} directories, {$existed} already existed.</p>";

echo "<h2>🎉 Migration Structure Created!</h2>";
echo "<p>The new directory structure has been created. You can now:</p>";
echo "<ol>";
echo "<li>Move your existing files to the new structure</li>";
echo "<li>Update file paths and includes</li>";
echo "<li>Test the application</li>";
echo "</ol>";
?> 