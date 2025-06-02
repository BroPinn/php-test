# 🏗️ OneStore Project Refactoring Plan

## Current Issues:
- ❌ Mixed client/admin code in root
- ❌ No clear separation of concerns  
- ❌ Duplicate code patterns
- ❌ Hard to maintain and scale
- ❌ No proper autoloading
- ❌ Global variables and functions

## 🎯 New Structure Goals:
- ✅ Clear separation of client vs admin
- ✅ Shared models and services
- ✅ Easy to maintain and extend
- ✅ Follow MVC principles
- ✅ Remove code duplication
- ✅ Better error handling

## 📁 New Project Structure:

```
php-test/
├── app/
│   ├── Controllers/
│   │   ├── Client/              # Client controllers
│   │   │   ├── HomeController.php
│   │   │   ├── ShopController.php
│   │   │   ├── ProductController.php
│   │   │   └── CartController.php
│   │   └── Admin/               # Admin controllers
│   │       ├── DashboardController.php
│   │       ├── ProductController.php
│   │       ├── CategoryController.php
│   │       └── OrderController.php
│   ├── Models/                  # Shared data models
│   │   ├── BaseModel.php        # Base model with common methods
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Customer.php
│   │   ├── Order.php
│   │   └── Admin.php
│   ├── Services/                # Business logic layer
│   │   ├── ProductService.php
│   │   ├── CartService.php
│   │   ├── OrderService.php
│   │   └── EmailService.php
│   ├── Middleware/              # Request processing
│   │   ├── AuthMiddleware.php
│   │   ├── AdminMiddleware.php
│   │   └── ValidationMiddleware.php
│   ├── Helpers/                 # Utility functions
│   │   ├── Helper.php
│   │   ├── FileHelper.php
│   │   └── ValidationHelper.php
│   └── Views/
│       ├── Client/              # Client templates
│       │   ├── layouts/
│       │   ├── pages/
│       │   └── components/
│       └── Admin/               # Admin templates
│           ├── layouts/
│           ├── pages/
│           └── components/
├── public/                      # Public web files
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   ├── uploads/
│   ├── admin.php               # Admin entry point
│   └── index.php               # Client entry point
├── config/                     # Configuration
│   ├── database.php
│   ├── app.php
│   └── constants.php
├── database/                   # Database files
│   ├── migrations/
│   └── seeds/
├── storage/                    # Storage
│   ├── logs/
│   └── cache/
├── vendor/                     # Composer packages (future)
├── .env                        # Environment variables
├── .htaccess                   # Apache rules
├── composer.json               # Dependencies
└── README.md
```

## 🔄 Migration Steps:

### Phase 1: Create New Structure
1. Create `app/` directory with subdirectories
2. Create `public/` directory
3. Move existing files to appropriate locations
4. Create base classes and helpers

### Phase 2: Refactor Models
1. Create `BaseModel` with common database methods
2. Convert existing models to new structure
3. Remove duplicate database connection code
4. Add proper error handling

### Phase 3: Refactor Controllers
1. Create base controller classes
2. Move client controllers to `app/Controllers/Client/`
3. Move admin controllers to `app/Controllers/Admin/`
4. Implement proper routing

### Phase 4: Refactor Views
1. Create layout templates
2. Move views to appropriate directories
3. Create reusable components
4. Implement template inheritance

### Phase 5: Add Services Layer
1. Extract business logic from controllers
2. Create service classes for complex operations
3. Implement dependency injection

### Phase 6: Add Middleware
1. Create authentication middleware
2. Add validation middleware
3. Implement CSRF protection

## 🎨 Key Improvements:

### 1. Autoloading System
```php
// app/autoload.php
spl_autoload_register(function($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});
```

### 2. Base Model Pattern
```php
// app/Models/BaseModel.php
abstract class BaseModel {
    protected $pdo;
    protected $table;
    
    public function __construct() {
        $this->pdo = Database::getInstance();
    }
    
    public function find($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Common CRUD methods...
}
```

### 3. Service Layer Pattern
```php
// app/Services/ProductService.php
class ProductService {
    private $productModel;
    private $categoryModel;
    
    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }
    
    public function getProductsWithCategory($filters = []) {
        // Business logic here
    }
}
```

### 4. Controller Base Classes
```php
// app/Controllers/BaseController.php
abstract class BaseController {
    protected function render($view, $data = []) {
        extract($data);
        require "app/Views/{$view}.php";
    }
    
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}
```

## 📋 Benefits of New Structure:

1. **Maintainability**: Clear separation of concerns
2. **Scalability**: Easy to add new features
3. **Testability**: Isolated components
4. **Reusability**: Shared models and services
5. **Security**: Better middleware and validation
6. **Performance**: Optimized autoloading
7. **Standards**: Follow PSR standards

## ⚠️ Migration Considerations:

1. **Backward Compatibility**: Keep old URLs working during transition
2. **Database**: Update existing code to work with new models
3. **Assets**: Update asset paths in views
4. **Configuration**: Centralize all configuration
5. **Testing**: Test each migrated component thoroughly 