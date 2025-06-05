# OneStore PHP E-commerce AWS EC2 Hosting Guide

**Complete deployment guide for OneStore PHP e-commerce platform on AWS EC2**  
**Target Setup**: Subdirectory hosting at `http://54.179.0.116/onestore`  
**Elastic IP**: 54.179.0.116  
**Compatible with existing Laravel/React applications**

## Table of Contents

1. [Prerequisites Check](#1-prerequisites-check)
2. [Connect to Your EC2 Instance](#2-connect-to-your-ec2-instance)
3. [Install PHP Requirements](#3-install-php-requirements)
4. [Deploy OneStore Application](#4-deploy-onestore-application)
5. [Configure Database](#5-configure-database)
6. [Configure Nginx for Subdirectory](#6-configure-nginx-for-subdirectory)
7. [Configure OneStore for Subdirectory](#7-configure-onestore-for-subdirectory)
8. [Verify Deployment](#8-verify-deployment)
9. [Troubleshooting](#9-troubleshooting)
10. [Maintenance & Security](#10-maintenance--security)

---

## 1. Prerequisites Check

### ✅ What You Should Already Have:
- **EC2 Instance**: Running Ubuntu 22.04 LTS
- **Elastic IP**: 54.179.0.116 (assigned to your instance)
- **Existing Applications**: Laravel API (port 8000), React Client (port 80), React Admin (port 8080)
- **Nginx**: Already configured and running
- **MySQL**: Database server running
- **SSH Access**: Key pair for connecting to instance

### 🔍 Verify Current Setup:
Your applications should currently be accessible at:
- Laravel API: `http://54.179.0.116:8000`
- React Client: `http://54.179.0.116`
- React Admin: `http://54.179.0.116:8080`

---

## 2. Connect to Your EC2 Instance

### For Windows Users (PuTTY):
1. Open PuTTY
2. Host Name: `ubuntu@54.179.0.116`
3. Load your `.ppk` private key
4. Click "Open" to connect

### For Mac/Linux Users:
   ```bash
# Replace with your actual key file path
ssh -i /path/to/your-key-pair.pem ubuntu@54.179.0.116
   ```

### Verify Connection:
   ```bash
# Check current directory and permissions
pwd
whoami
sudo systemctl status nginx mysql
   ```

---

## 3. Install PHP Requirements

### Check Current PHP Installation:
```bash
# Check if PHP is already installed
php -v

# Check installed PHP modules
php -m | grep -E "(mysql|mbstring|xml|curl|zip|gd)"
```

### Install PHP and Required Extensions:
```bash
# Update package lists
sudo apt update

# Install PHP and essential extensions for OneStore
sudo apt install -y php-fpm php-mysql php-mbstring php-xml php-curl php-zip php-gd php-json php-common

# Verify installation
php -v
```

### Configure PHP Settings for OneStore:
```bash
# Find your PHP version (e.g., 8.1, 8.2, 8.3)
PHP_VERSION=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
echo "PHP Version: $PHP_VERSION"

# Edit PHP-FPM configuration
sudo nano /etc/php/$PHP_VERSION/fpm/php.ini
```

**Update these settings for OneStore file uploads:**
```ini
; Find and update these lines:
upload_max_filesize = 10M
post_max_size = 12M
memory_limit = 256M
max_execution_time = 60
max_input_vars = 3000

; For better error handling in production:
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log
```

### Restart PHP-FPM:
```bash
# Restart PHP-FPM service
sudo systemctl restart php$PHP_VERSION-fpm
sudo systemctl status php$PHP_VERSION-fpm
```

---

## 4. Deploy OneStore Application

### Create OneStore Directory:
```bash
# Create directory for OneStore
sudo mkdir -p /var/www/onestore
cd /var/www/onestore

# Clone OneStore from your GitHub repository
sudo git clone https://github.com/BroPinn/php-test.git .

# Verify files are present
sudo mv php-test/* .
sudo mv php-test/.* . 2>/dev/null || true  # Move hidden files, ignore errors

# Remove the now-empty php-test directory
sudo rmdir php-test

# Verify the structure is correct now
ls -la
```

### Set Proper File Permissions:
```bash
# Set ownership to web server user
sudo chown -R www-data:www-data /var/www/onestore

# Set directory permissions
sudo find /var/www/onestore -type d -exec chmod 755 {} \;

# Set file permissions
sudo find /var/www/onestore -type f -exec chmod 644 {} \;

# Make upload directories writable
sudo chmod -R 777 /var/www/onestore/public/uploads/products
sudo chmod -R 777 /var/www/onestore/public/uploads/slider
sudo chmod -R 777 /var/www/onestore/public/uploads/brands
sudo chmod -R 777 /var/www/onestore/public/uploads/categories

# Verify permissions
ls -la /var/www/onestore/public/uploads/
```

---

## 5. Configure Database

### Create Dedicated Database for OneStore:
```bash
# Connect to MySQL as root
sudo mysql -u root -p
```

**In MySQL console, create OneStore database:**
```sql
-- Create database for OneStore
CREATE DATABASE onestore_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create dedicated user for OneStore
CREATE USER 'onestore_user'@'localhost' IDENTIFIED BY 'OneStore_Secure_2024!@#';

-- Grant privileges
GRANT ALL PRIVILEGES ON onestore_db.* TO 'onestore_user'@'localhost';

-- Apply changes
FLUSH PRIVILEGES;

-- Verify database creation
SHOW DATABASES;

-- Exit MySQL
EXIT;
```

### Configure OneStore Database Connection:
```bash
# Edit database configuration file
sudo nano /var/www/onestore/database.php
```

**Update with your database credentials:**
```php
<?php
/**
 * OneStore Database Configuration
 * Elastic IP: 54.179.0.116
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'onestore_db');
define('DB_USER', 'onestore_user');
define('DB_PASS', 'OneStore_Secure_2024!@#');
define('DB_CHARSET', 'utf8mb4');

/**
 * PDO Database Connection
 */
function connectToDatabase() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ];
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }
    
    return $pdo;
}

// Test connection
try {
    $pdo = connectToDatabase();
    // Connection successful
} catch (Exception $e) {
    die("Database configuration error: " . $e->getMessage());
}
?>
```

### Import OneStore Database Schema:
```bash
# Import the complete database structure and sample data
mysql -u onestore_user -p onestore_db < /var/www/onestore/complete.sql

# Verify import was successful
mysql -u onestore_user -p onestore_db -e "SHOW TABLES;"

# Check sample data
mysql -u onestore_user -p onestore_db -e "SELECT COUNT(*) as product_count FROM tbl_product;"
```

---

## 6. Configure Nginx for Subdirectory

### Backup Current Nginx Configuration:
```bash
# Create backup of current configuration
sudo cp /etc/nginx/sites-available/client-frontend /etc/nginx/sites-available/client-frontend.backup
```

### Update Nginx Configuration for OneStore:
```bash
# Edit your existing client-frontend configuration
sudo nano /etc/nginx/sites-available/client-frontend
```

**Replace the entire file with this configuration:**
```nginx
server {
    listen 80;
    server_name 54.179.0.116;
    root /var/www/client-frontend;
    index index.html index.php;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Main React Client Application (existing - unchanged)
    location / {
        try_files $uri $uri/ /index.html;
    }

    # OneStore PHP E-commerce Application
    location /onestore {
        alias /var/www/onestore;
        index index.php;
        
        # Handle PHP files in OneStore
        location ~ \.php$ {
            # Use your actual PHP version
            fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
            fastcgi_param SCRIPT_FILENAME $request_filename;
            fastcgi_param DOCUMENT_ROOT /var/www/onestore;
            include fastcgi_params;
            
            # Security parameters
            fastcgi_param PHP_VALUE "upload_max_filesize=10M \n post_max_size=12M";
            fastcgi_read_timeout 300;
        }
        
        # OneStore routing and clean URLs
        try_files $uri $uri/ @onestore_fallback;
    }
    
    # OneStore fallback for clean URLs
    location @onestore_fallback {
        rewrite ^/onestore/(.*)$ /onestore/index.php?$query_string last;
    }
    
    # OneStore static assets with caching
    location ~* ^/onestore/public/assets/(.*\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot|webp))$ {
        alias /var/www/onestore/public/assets/$1;
        expires 1y;
        add_header Cache-Control "public, immutable";
        add_header Access-Control-Allow-Origin "*";
    }
    
    # OneStore uploads with proper MIME types
    location ~* ^/onestore/public/uploads/(.*\.(png|jpg|jpeg|gif|webp|svg))$ {
        alias /var/www/onestore/public/uploads/$1;
        expires 30d;
        add_header Cache-Control "public";
        add_header Access-Control-Allow-Origin "*";
    }

    # General static assets caching (existing applications)
    location ~* \.(ico|css|js|gif|jpe?g|png|woff|woff2|ttf|eot|svg|webp)$ {
        expires max;
        add_header Cache-Control "public, immutable";
        log_not_found off;
    }

    # Security: Block access to sensitive files
    location ~ /\.(env|git|htaccess|htpasswd) {
        deny all;
        return 404;
    }
    
    # Block access to PHP files in uploads
    location ~* ^/onestore/public/uploads/.*\.php$ {
        deny all;
        return 404;
    }

    # Logging
    access_log /var/log/nginx/onestore_access.log;
    error_log /var/log/nginx/onestore_error.log;
}
```

### Find Your PHP Version for Nginx Config:
```bash
# Check available PHP-FPM sockets
ls /var/run/php/

# Update the nginx config with your actual PHP version
# Example: if you see php8.2-fpm.sock, update the config to use php8.2-fpm.sock
```

### Test and Apply Nginx Configuration:
```bash
# Test Nginx configuration for syntax errors
sudo nginx -t

# If test passes, reload Nginx
sudo systemctl reload nginx

# Check Nginx status
sudo systemctl status nginx
```

---

## 7. Configure OneStore for Subdirectory

### Update Helper Class for Subdirectory Support:
```bash
# Edit the Helper class to support subdirectory URLs
sudo nano /var/www/onestore/app/Helpers/Helper.php
```

**Update or create the Helper class:**
```php
<?php
namespace App\Helpers;

class Helper {
    
    // Base path for OneStore subdirectory
    const BASE_PATH = '/onestore';
    
    /**
     * Generate URL for assets
     */
    public static function asset($path) {
        $cleanPath = ltrim($path, '/');
        return self::BASE_PATH . '/public/assets/' . $cleanPath;
    }
    
    /**
     * Generate URL for uploaded files
     */
    public static function upload($path) {
        if (empty($path)) {
            return self::BASE_PATH . '/public/assets/images/no-image.png';
        }
        
        $cleanPath = ltrim($path, '/');
        return self::BASE_PATH . '/public/uploads/' . $cleanPath;
    }
    
    /**
     * Generate URL for OneStore routes
     */
    public static function url($path = '') {
        $cleanPath = ltrim($path, '/');
        return self::BASE_PATH . '/' . $cleanPath;
    }
    
    /**
     * Generate admin URL
     */
    public static function adminUrl($path = '') {
        $cleanPath = ltrim($path, '/');
        return self::BASE_PATH . '/admin/' . $cleanPath;
    }
    
    /**
     * Get current base URL
     */
    public static function baseUrl() {
        return 'http://54.179.0.116' . self::BASE_PATH;
    }
    
    /**
     * Format price
     */
    public static function formatPrice($price) {
        return '$' . number_format((float)$price, 2);
    }
    
    /**
     * Format date
     */
    public static function formatDate($date) {
        return date('M d, Y', strtotime($date));
    }
}
?>
```

### Create Application Configuration:
```bash
# Create app configuration file
sudo nano /var/www/onestore/config/app.php
```

**Add configuration for subdirectory hosting:**
```php
<?php
/**
 * OneStore Application Configuration
 * Deployment: AWS EC2 - 54.179.0.116
 * Path: /onestore
 */

// Application Settings
define('APP_NAME', 'OneStore');
define('APP_ENV', 'production');
define('APP_DEBUG', false);
define('APP_TIMEZONE', 'UTC');

// URL Configuration
define('BASE_URL', '/onestore');
define('ADMIN_URL', '/onestore/admin');
define('ASSETS_URL', '/onestore/public/assets');
define('UPLOADS_URL', '/onestore/public/uploads');

// Server Configuration
define('SERVER_IP', '54.179.0.116');
define('FULL_BASE_URL', 'http://54.179.0.116/onestore');

// File Upload Settings
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif', 'webp']);
define('UPLOAD_PATH', '/var/www/onestore/public/uploads/');

// Session Configuration
define('SESSION_LIFETIME', 7200); // 2 hours
define('SESSION_NAME', 'onestore_session');

// Security Settings
define('HASH_ALGO', 'sha256');
define('ENCRYPTION_KEY', 'OneStore_2024_Secure_Key_' . md5('54.179.0.116'));

// Pagination
define('ITEMS_PER_PAGE', 12);
define('ADMIN_ITEMS_PER_PAGE', 20);

// Application Paths
define('ROOT_PATH', '/var/www/onestore');
define('PUBLIC_PATH', '/var/www/onestore/public');
define('STORAGE_PATH', '/var/www/onestore/storage');

/**
 * Initialize application settings
 */
function initializeApp() {
    // Set timezone
    date_default_timezone_set(APP_TIMEZONE);
    
    // Configure session
    ini_set('session.name', SESSION_NAME);
    ini_set('session.gc_maxlifetime', SESSION_LIFETIME);
    ini_set('session.cookie_lifetime', SESSION_LIFETIME);
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Set error reporting based on environment
    if (APP_DEBUG) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
    }
}

// Initialize application
initializeApp();
?>
```

### Update Router for Subdirectory Support:
```bash
# Check if index.php needs updates for subdirectory routing
sudo nano /var/www/onestore/index.php
```

**Ensure the router handles subdirectory paths correctly.** Add this at the top after includes:
```php
<?php
// Include configuration
require_once 'config/app.php';
require_once 'database.php';

// Set base path for subdirectory hosting
$requestUri = $_SERVER['REQUEST_URI'];
$basePath = '/onestore';

// Remove base path from request URI for internal routing
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

// Continue with existing routing logic...
?>
```

---

## 8. Verify Deployment

### Test Database Connection:
```bash
# Test OneStore database connection
mysql -u onestore_user -p onestore_db -e "SELECT COUNT(*) as total_products FROM tbl_product;"

# Check admin user exists
mysql -u onestore_user -p onestore_db -e "SELECT username FROM tbl_admin LIMIT 1;"
```

### Check File Permissions:
```bash
# Verify upload directories are writable
ls -la /var/www/onestore/public/uploads/

# Test write permissions
sudo -u www-data touch /var/www/onestore/public/uploads/test_write.txt
sudo rm /var/www/onestore/public/uploads/test_write.txt
```

### Test Application Access:

#### **OneStore Frontend:**
Open browser and visit: **`http://54.179.0.116/onestore`**

✅ **Expected Results:**
- OneStore homepage loads
- Product catalog displays
- Navigation menu works
- Product images show correctly
- Categories menu functions

#### **OneStore Admin Panel:**
Open browser and visit: **`http://54.179.0.116/onestore/admin`**

✅ **Expected Results:**
- Admin login page loads
- Can login with: **Username:** `admin`, **Password:** `admin123`
- Dashboard shows statistics
- All admin functions work

#### **Verify Existing Applications Still Work:**
- React Client: `http://54.179.0.116` ✅
- Laravel API: `http://54.179.0.116:8000` ✅
- React Admin: `http://54.179.0.116:8080` ✅

---

## 9. Troubleshooting

### Common Issues and Solutions:

#### **1. 404 Not Found for OneStore**
   ```bash
# Check Nginx error logs
sudo tail -f /var/log/nginx/onestore_error.log

# Verify Nginx configuration
sudo nginx -t

# Check file permissions
ls -la /var/www/onestore/
```

#### **2. 502 Bad Gateway Error**
   ```bash
# Check PHP-FPM status
   sudo systemctl status php8.1-fpm

# Restart PHP-FPM
sudo systemctl restart php8.1-fpm

# Check PHP-FPM logs
sudo tail -f /var/log/php8.1-fpm.log
```

#### **3. Database Connection Errors**
   ```bash
# Test database connectivity
mysql -u onestore_user -p onestore_db

# Check MySQL service
   sudo systemctl status mysql

# Verify database configuration
sudo nano /var/www/onestore/database.php
   ```

#### **4. Images Not Loading**
   ```bash
# Check upload directory permissions
ls -la /var/www/onestore/public/uploads/

# Test image URL directly
curl -I http://54.179.0.116/onestore/public/uploads/products/sample.jpg

# Check Nginx asset configuration
sudo nginx -t
```

#### **5. Admin Panel Not Accessible**
   ```bash
# Check admin table
mysql -u onestore_user -p onestore_db -e "SELECT * FROM tbl_admin;"

# Verify admin routes in index.php
sudo nano /var/www/onestore/index.php
```

### **Log Monitoring:**
```bash
# Monitor all OneStore related logs
sudo tail -f /var/log/nginx/onestore_error.log /var/log/nginx/onestore_access.log

# Monitor PHP errors
sudo tail -f /var/log/php_errors.log

# Monitor system logs
sudo journalctl -f -u nginx -u php8.1-fpm
```

### **Performance Monitoring:**
```bash
# Check server resources
htop

# Check disk usage
df -h

# Check memory usage
free -h

# Monitor MySQL processes
sudo mysqladmin -u root -p processlist
```

---

## 10. Maintenance & Security

### **Regular Backups:**

#### **Database Backup Script:**
   ```bash
# Create backup directory
sudo mkdir -p /home/ubuntu/onestore_backups

# Create backup script
sudo nano /usr/local/bin/onestore_backup.sh
```

**Add this backup script:**
   ```bash
   #!/bin/bash
# OneStore Backup Script
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="/home/ubuntu/onestore_backups"
DB_NAME="onestore_db"
DB_USER="onestore_user"
DB_PASS="OneStore_Secure_2024!@#"

   # Create backup directory
   mkdir -p $BACKUP_DIR

# Database backup
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/onestore_db_$TIMESTAMP.sql

# Files backup
tar -czf $BACKUP_DIR/onestore_files_$TIMESTAMP.tar.gz -C /var/www onestore

# Cleanup old backups (keep last 7 days)
find $BACKUP_DIR -name "onestore_*" -mtime +7 -delete

echo "Backup completed: $TIMESTAMP"
```

**Make executable and schedule:**
   ```bash
# Make script executable
sudo chmod +x /usr/local/bin/onestore_backup.sh

# Add to crontab (daily at 2 AM)
sudo crontab -e
# Add this line:
# 0 2 * * * /usr/local/bin/onestore_backup.sh >> /var/log/onestore_backup.log 2>&1
```

### **Security Hardening:**

#### **Configure Firewall:**
```bash
# Install and configure UFW
sudo ufw status
sudo ufw allow ssh
sudo ufw allow http
sudo ufw allow https
sudo ufw allow 8000  # Laravel API
sudo ufw allow 8080  # React Admin
sudo ufw enable
```

#### **Install Fail2Ban:**
   ```bash
# Install fail2ban for protection against brute force
sudo apt install -y fail2ban

# Configure for nginx
sudo nano /etc/fail2ban/jail.local
```

**Add this configuration:**
```ini
[DEFAULT]
bantime = 3600
findtime = 600
maxretry = 5

[nginx-http-auth]
enabled = true

[nginx-noscript]
enabled = true

[nginx-badbots]
enabled = true

[nginx-noproxy]
enabled = true
```

#### **SSL Certificate (Optional but Recommended):**
```bash
# Install Certbot for Let's Encrypt SSL
sudo apt install -y certbot python3-certbot-nginx

# Note: For SSL, you'll need a domain name pointing to 54.179.0.116
# If you have a domain, you can run:
# sudo certbot --nginx -d yourdomain.com
```

### **Monitoring & Logs:**

#### **Set up Log Rotation:**
   ```bash
# Configure log rotation for OneStore
sudo nano /etc/logrotate.d/onestore
```

**Add this configuration:**
```
/var/log/nginx/onestore_*.log {
    daily
    missingok
    rotate 52
    compress
    delaycompress
    notifempty
    create 644 www-data adm
    postrotate
        systemctl reload nginx
    endscript
}
```

#### **Monitor Disk Space:**
   ```bash
# Create disk monitoring script
sudo nano /usr/local/bin/disk_monitor.sh
```

**Add monitoring script:**
```bash
#!/bin/bash
THRESHOLD=80
USAGE=$(df / | awk 'END{print $(NF-1)}' | sed 's/%//')

if [ $USAGE -gt $THRESHOLD ]; then
    echo "WARNING: Disk usage is ${USAGE}% on $(hostname) at $(date)" | 
    mail -s "Disk Space Alert" your-email@example.com
fi
```

### **Performance Optimization:**

#### **Enable PHP OPcache:**
   ```bash
# Edit PHP configuration
sudo nano /etc/php/8.1/fpm/php.ini
```

**Add/update these settings:**
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=60
opcache.fast_shutdown=1
```

#### **MySQL Optimization:**
   ```bash
# Edit MySQL configuration
sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf
```

**Add under [mysqld] section:**
```ini
# OneStore optimizations
innodb_buffer_pool_size = 256M
query_cache_type = 1
query_cache_size = 64M
query_cache_limit = 2M
max_connections = 100
thread_cache_size = 8
```

**Restart services:**
   ```bash
sudo systemctl restart php8.1-fpm mysql nginx
```

---

## 🎉 Deployment Complete!

### **Your OneStore Application is Now Live:**

#### **Frontend Access:**
- **OneStore Shop**: `http://54.179.0.116/onestore`
- **OneStore Admin**: `http://54.179.0.116/onestore/admin`
- **Admin Login**: Username: `admin`, Password: `admin123`

#### **Existing Applications (Unchanged):**
- **React Client**: `http://54.179.0.116`
- **Laravel API**: `http://54.179.0.116:8000`
- **React Admin**: `http://54.179.0.116:8080`

### **Key Features Available:**
✅ Complete product catalog management  
✅ Category and brand management  
✅ Order processing system  
✅ Customer management  
✅ File upload system for product images  
✅ Responsive design for mobile and desktop  
✅ Professional admin panel  
✅ Sample data for testing  

### **Next Steps:**
1. **Test all functionality** thoroughly
2. **Customize branding** and content
3. **Add real products** and images
4. **Configure payment processing** if needed
5. **Set up SSL certificate** for HTTPS
6. **Configure regular backups**
7. **Monitor performance** and logs

### **Support Resources:**
- **OneStore Documentation**: Available in `/memory-bank/` directory
- **AWS EC2 Docs**: https://docs.aws.amazon.com/ec2/
- **Nginx Docs**: https://nginx.org/en/docs/
- **PHP Docs**: https://www.php.net/docs.php

**Your professional e-commerce platform is now ready to serve customers!** 🚀

For any issues, check the troubleshooting section or monitor the log files mentioned in this guide.












