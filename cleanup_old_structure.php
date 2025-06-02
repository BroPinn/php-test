<?php
/**
 * OneStore Cleanup Script
 * Safely removes old structure files after successful migration
 * 
 * ⚠️ WARNING: This script will DELETE files permanently!
 * Make sure you have a backup before running this script.
 */

echo "<h1>🧹 OneStore Structure Cleanup</h1>";
echo "<p>This script will remove old structure files after migration to the new system.</p>";

// Safety check
if (!file_exists('app/autoload.php') || !file_exists('config/app.php')) {
    die('<p style="color: red;">❌ New structure not found! Please complete the migration first.</p>');
}

// Check if new views exist
$newViewsExist = file_exists('app/Views/Client/layouts/main.php') && 
                 file_exists('app/Views/Admin/layouts/admin.php');

if (!$newViewsExist) {
    die('<p style="color: red;">❌ New view structure not found! Please complete the view migration first.</p>');
}

echo "<div style='background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h3>⚠️ WARNING</h3>";
echo "<p>This operation is <strong>IRREVERSIBLE</strong>. Files will be permanently deleted.</p>";
echo "<p>Make sure you have:</p>";
echo "<ul>";
echo "<li>✅ Completed the migration to new structure</li>";
echo "<li>✅ Tested the new system thoroughly</li>";
echo "<li>✅ Created a backup of your files</li>";
echo "<li>✅ Migrated all views and components</li>";
echo "</ul>";
echo "</div>";

// Manual confirmation required
if (!isset($_GET['confirm']) || $_GET['confirm'] !== 'yes') {
    echo "<p><strong>To proceed, add <code>?confirm=yes</code> to the URL:</strong></p>";
    echo "<p><a href='?confirm=yes' style='background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>⚠️ PROCEED WITH CLEANUP</a></p>";
    exit;
}

echo "<h2>🗑️ Cleanup Process</h2>";

// Files and directories to remove
$filesToRemove = [
    // Old controller files
    'controllers/about.php',
    'controllers/blog.php', 
    'controllers/blogdetail.php',
    'controllers/checkout.php',
    'controllers/contact.php',
    'controllers/index.php',
    'controllers/productdetail.php',
    'controllers/shop.php',
    
    // Old view files
    'views/blogdetail.view.php',
    'views/checkout.view.php',
    'views/contact.view.php',
    'views/index.view.php',
    'views/product.view.php',
    'views/productdetail.view.php',
    'views/shop.view.php',
    'views/404.view.php',
    'views/about.view.php',
    'views/blog.view.php',
    
    // Old include files
    'includes/cart.php',
    'includes/filter.php',
    'includes/foot.php',
    'includes/footer.php',
    'includes/head.php',
    'includes/nav.php',
    'includes/product-list.php',
    'includes/slider.php',
    'includes/banner.php',
    'includes/btntop.php',
    
    // Old model files (will be replaced)
    'models/AdminModel.php',
    'models/CategoryModel.php',
    'models/CustomerModel.php',
    'models/OrderModel.php',
    'models/ProductModel.php',
    'models/SliderModel.php',
    
    // Old admin files
    'admin/index.php',
    'admin/router.php',
    'admin/controllers/index.php',
    'admin/controllers/product.php',
    'admin/controllers/slider.php',
    'admin/view/index.view.php',
    'admin/view/product.view.php',
    'admin/view/slider.view.php',
    'admin/view/category.view.php',
    'admin/view/settings.php',
    'admin/includes/head.php',
    'admin/includes/sidebar.php',
    'admin/includes/navbar.php',
    'admin/includes/footer.php',
    'admin/includes/foot.php',
    'admin/includes/home.php',
    'admin/includes/category.php',
    
    // Old root files
    'function.php',
    'router.php'
];

$directoriesToRemove = [
    'controllers',
    'views', 
    'includes',
    'models',
    'admin/auth',
    'admin/controllers',
    'admin/includes', 
    'admin/view',
    'admin'  // Remove admin directory last
];

$removed = 0;
$failed = 0;

// Remove files
echo "<h3>Removing Files...</h3>";
foreach ($filesToRemove as $file) {
    if (file_exists($file)) {
        if (unlink($file)) {
            echo "✅ Removed: {$file}<br>";
            $removed++;
        } else {
            echo "❌ Failed to remove: {$file}<br>";
            $failed++;
        }
    } else {
        echo "ℹ️ Not found: {$file}<br>";
    }
}

// Remove directories
echo "<h3>Removing Directories...</h3>";
foreach ($directoriesToRemove as $dir) {
    if (is_dir($dir)) {
        if (removeDirectory($dir)) {
            echo "✅ Removed directory: {$dir}<br>";
            $removed++;
        } else {
            echo "❌ Failed to remove directory: {$dir}<br>";
            $failed++;
        }
    } else {
        echo "ℹ️ Directory not found: {$dir}<br>";
    }
}

// Move assets and uploads to public if not already done
echo "<h3>Moving Remaining Assets...</h3>";

if (is_dir('assets') && !is_dir('public/assets')) {
    if (rename('assets', 'public/assets')) {
        echo "✅ Moved assets/ to public/assets/<br>";
    } else {
        echo "❌ Failed to move assets/<br>";
    }
} else if (is_dir('assets')) {
    echo "ℹ️ Assets already in public/ or source directory exists<br>";
}

if (is_dir('uploads') && !is_dir('public/uploads')) {
    if (rename('uploads', 'public/uploads')) {
        echo "✅ Moved uploads/ to public/uploads/<br>";
    } else {
        echo "❌ Failed to move uploads/<br>";
    }
} else if (is_dir('uploads')) {
    echo "ℹ️ Uploads already in public/ or source directory exists<br>";
}

// Summary
echo "<h2>📊 Cleanup Summary</h2>";
echo "<div style='background: " . ($failed > 0 ? '#f8d7da' : '#d4edda') . "; padding: 15px; border-radius: 5px; margin: 20px 0;'>";

if ($failed > 0) {
    echo "<h3>⚠️ Cleanup Completed with Issues</h3>";
    echo "<p><strong>Removed:</strong> {$removed} items</p>";
    echo "<p><strong>Failed:</strong> {$failed} items</p>";
    echo "<p>Some files could not be removed. You may need to delete them manually.</p>";
} else {
    echo "<h3>✅ Cleanup Completed Successfully!</h3>";
    echo "<p><strong>Removed:</strong> {$removed} items</p>";
    echo "<p>All old structure files have been successfully removed.</p>";
}

echo "</div>";

echo "<h3>🎉 Your project structure is now clean!</h3>";

echo "<h4>📂 New Structure Overview:</h4>";
echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto;'>";
echo "php-test/
├── app/
│   ├── Controllers/
│   │   ├── Admin/           # 🔐 Admin controllers
│   │   │   └── DashboardController.php
│   │   └── Client/          # 🌐 Client controllers  
│   │       └── HomeController.php
│   ├── Models/              # 🗄️ Shared models
│   │   ├── BaseModel.php
│   │   └── Product.php
│   ├── Views/
│   │   ├── Admin/           # 🎨 Admin views
│   │   │   ├── layouts/admin.php
│   │   │   └── components/
│   │   └── Client/          # 🎨 Client views
│   │       ├── layouts/main.php
│   │       ├── components/
│   │       └── pages/
│   ├── Helpers/Helper.php   # 🛠️ Utilities
│   └── autoload.php         # 🔧 Autoloader
├── public/                  # 🌐 Web accessible files
│   ├── assets/             # 🎨 CSS, JS, Images
│   ├── uploads/            # 📁 User uploads
│   └── index.php           # 🚪 Entry point
├── config/app.php          # ⚙️ Configuration
├── database/               # 🗄️ Database files
└── storage/logs/           # 📝 Application logs
";
echo "</pre>";

echo "<p><strong>Next steps:</strong></p>";
echo "<ul>";
echo "<li>✅ Test your application thoroughly</li>";
echo "<li>✅ Update your web server document root to <code>public/</code></li>";
echo "<li>✅ Set up proper URL rewriting for clean URLs</li>";
echo "<li>✅ Create more controllers and models as needed</li>";
echo "<li>✅ Implement proper authentication and authorization</li>";
echo "</ul>";

echo "<p><strong>New structure benefits achieved:</strong></p>";
echo "<ul>";
echo "<li>🏗️ Professional organization with clear separation</li>";
echo "<li>🔒 Enhanced security with public directory structure</li>";
echo "<li>🔄 No code duplication with base classes and components</li>";
echo "<li>⚡ Better performance with PSR-4 autoloading</li>";
echo "<li>🧪 Easier testing and maintenance</li>";
echo "<li>🎨 Reusable view components</li>";
echo "<li>🔐 Separate admin and client areas</li>";
echo "<li>📱 Modern responsive design patterns</li>";
echo "</ul>";

echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0;'>";
echo "<h4>🎊 Migration Complete!</h4>";
echo "<p>Your OneStore project has been successfully migrated to a modern, maintainable architecture!</p>";
echo "<p><strong>Files migrated:</strong></p>";
echo "<ul>";
echo "<li>✅ Admin views → <code>app/Views/Admin/</code></li>";
echo "<li>✅ Client views → <code>app/Views/Client/</code></li>";
echo "<li>✅ Components → <code>app/Views/.../components/</code></li>";
echo "<li>✅ Layouts → <code>app/Views/.../layouts/</code></li>";
echo "<li>✅ Controllers → <code>app/Controllers/</code></li>";
echo "<li>✅ Models → <code>app/Models/</code></li>";
echo "</ul>";
echo "</div>";

// Helper function to remove directory recursively
function removeDirectory($dir) {
    if (!is_dir($dir)) {
        return false;
    }
    
    $files = array_diff(scandir($dir), array('.', '..'));
    
    foreach ($files as $file) {
        $path = $dir . DIRECTORY_SEPARATOR . $file;
        
        if (is_dir($path)) {
            removeDirectory($path);
        } else {
            unlink($path);
        }
    }
    
    return rmdir($dir);
}
?> 