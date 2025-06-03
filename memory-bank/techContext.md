# OneStore - Technical Context

## Technology Stack

### Backend Technologies
- **PHP**: Version 7.4+ (core application language)
- **MySQL/MariaDB**: Primary database system
- **Apache/Nginx**: Web server with mod_rewrite support
- **PSR-4 Autoloading**: Modern PHP class loading standard

### Frontend Technologies
- **HTML5**: Semantic markup structure
- **CSS3**: Modern styling with responsive design
- **JavaScript**: Client-side interactions and form validation
- **Bootstrap**: CSS framework for responsive design
- **jQuery**: JavaScript library for DOM manipulation

### Asset Libraries
- **Font Awesome 4.7.0**: Icon library
- **Animate.css**: CSS animations
- **Slick Carousel**: Image slider functionality
- **Sweet Alert**: Enhanced alert dialogs
- **Perfect Scrollbar**: Custom scrollbars
- **Select2**: Enhanced select elements

## Development Environment

### Recommended Setup (Windows)
- **Laragon**: Local development environment
  - **Location**: `C:\laragon\www\php-test`
  - **URL Access**: `http://localhost/php-test` or `http://php-test.test`
  - **Features**: Auto virtual hosts, SSL support, quick switching

### Alternative Setups
- **XAMPP**: Cross-platform solution
- **WAMP**: Windows-specific stack
- **Docker**: Containerized development
- **Native PHP Server**: `php -S localhost:8000`

### Database Configuration
```php
// config/database.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'onestore_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');
```

## Project Dependencies

### PHP Extensions Required
- **PDO**: Database abstraction layer
- **PDO_MySQL**: MySQL database driver
- **GD/Imagick**: Image processing for uploads
- **Session**: Session management
- **JSON**: JSON data handling
- **mbstring**: Multi-byte string handling

### File System Requirements
- **Write Permissions**:
  - `public/uploads/products/`
  - `public/uploads/slider/`
  - `storage/logs/` (if implemented)
- **Apache Modules**:
  - `mod_rewrite`: Clean URL support
  - `mod_headers`: HTTP header management

## Configuration Management

### Environment Configuration
```php
// config/app.php
define('APP_NAME', 'OneStore');
define('APP_ENV', 'development'); // development, staging, production
define('APP_DEBUG', true);
define('APP_URL', 'http://localhost:8000');
```

### File Upload Settings
```php
// Maximum file size: 5MB
define('MAX_FILE_SIZE', 5 * 1024 * 1024);
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('UPLOAD_PATH', 'public/uploads/');
```

### Security Configuration
```php
// Session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_secure', 0); // Set to 1 for HTTPS

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## Database Schema

### Core Tables
- **tbl_product**: Product information and inventory
- **tbl_category**: Product categorization
- **tbl_customer**: Customer accounts and profiles
- **tbl_order**: Order records and status
- **tbl_order_items**: Individual order line items
- **tbl_admin**: Administrator accounts
- **tbl_slider**: Homepage slider images

### Sample Data Structure
```sql
-- Products: 6 sample products with categories
-- Customers: 4 test customer accounts
-- Orders: 4 sample orders with items
-- Admin: Default admin user (admin/admin123)
```

## URL Structure & Routing

### Clean URL Implementation
```apache
# .htaccess configuration
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

### URL Patterns
- **Frontend**: 
  - `/` → Homepage
  - `/shop` → Product catalog
  - `/product/{id}` → Product details
  - `/about` → About page
- **Admin**: 
  - `/admin` → Dashboard
  - `/admin/products` → Product management
  - `/admin/orders` → Order management

## Performance Optimization

### Database Optimization
- **Prepared Statements**: Prevent SQL injection and improve performance
- **Connection Pooling**: Singleton database connection
- **Selective Queries**: Load only required fields
- **Indexing**: Database indexes on frequently queried fields

### Frontend Optimization
- **Asset Minification**: Compressed CSS/JS files
- **Image Optimization**: Proper image formats and sizes
- **Browser Caching**: Appropriate cache headers
- **CDN Ready**: Static assets can be served from CDN

### PHP Configuration
```ini
; Recommended PHP settings
memory_limit = 256M
upload_max_filesize = 10M
post_max_size = 12M
max_execution_time = 30
max_input_vars = 3000
```

## Security Considerations

### Input Validation
- **Server-side Validation**: All user input validated
- **Prepared Statements**: SQL injection prevention
- **CSRF Protection**: Cross-site request forgery prevention
- **XSS Prevention**: Output escaping and sanitization

### File Security
- **Upload Restrictions**: Limited file types and sizes
- **File Validation**: Content type verification
- **Secure Storage**: Uploads outside document root when possible
- **Access Control**: Proper file permissions

### Authentication Security
- **Password Hashing**: Secure password storage
- **Session Management**: Secure session handling
- **Admin Separation**: Isolated admin authentication
- **Login Attempts**: Rate limiting (can be implemented)

## Development Tools

### Available Scripts
- **setup.php**: Environment diagnostics and database setup
- **migrate_structure.php**: MVC architecture migration
- **cleanup_old_structure.php**: Legacy file cleanup

### Debugging & Monitoring
- **Error Logging**: Configurable error reporting
- **Database Queries**: Can be logged for optimization
- **Performance Monitoring**: Ready for APM integration

## Deployment Considerations

### Production Setup
- **Environment Variables**: Sensitive data in environment files
- **Error Handling**: Disable debug mode and error display
- **HTTPS**: SSL certificate implementation
- **Database Security**: Restricted database user permissions
- **File Permissions**: Proper production file permissions

### Scaling Options
- **Load Balancing**: Stateless design allows horizontal scaling
- **Database Clustering**: MySQL replication support
- **Caching Layer**: Redis/Memcached integration ready
- **CDN Integration**: Static asset delivery optimization 