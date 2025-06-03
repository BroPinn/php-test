# OneStore - System Patterns & Architecture

## Core Architecture Pattern

### MVC (Model-View-Controller)
The system follows a strict MVC pattern with clear separation of concerns:

```
app/
├── Controllers/     # Business logic and request handling
│   ├── Admin/      # Admin-specific controllers
│   └── Client/     # Customer-facing controllers
├── Models/         # Data access and business entities
├── Views/          # Presentation layer templates
│   ├── Admin/      # Admin panel templates
│   └── Client/     # Customer-facing templates
└── Services/       # Business logic layer
```

## Key Design Patterns

### 1. Base Model Pattern
**Purpose**: Provide common database operations and reduce code duplication

**Implementation**:
```php
// app/Models/BaseModel.php
abstract class BaseModel {
    protected $pdo;
    protected $table;
    
    // Common CRUD operations
    public function find($id) { /* ... */ }
    public function findAll() { /* ... */ }
    public function create($data) { /* ... */ }
    public function update($id, $data) { /* ... */ }
    public function delete($id) { /* ... */ }
}
```

**Usage**: All models extend BaseModel for consistent database operations

### 2. Service Layer Pattern
**Purpose**: Encapsulate complex business logic separate from controllers

**Structure**:
- ProductService: Product-related business operations
- CartService: Shopping cart management
- OrderService: Order processing logic
- EmailService: Email notifications

### 3. Repository Pattern (Implicit)
**Purpose**: Abstract data access layer from business logic

**Implementation**: Models act as repositories, providing data access methods while hiding database specifics

### 4. Front Controller Pattern
**Purpose**: Single entry point for all requests

**Implementation**:
- `index.php`: Main entry point for client requests
- `public/admin.php`: Entry point for admin requests
- Clean URL routing through `.htaccess`

## Directory Structure & Organization

### Application Layer (`app/`)
```
app/
├── Controllers/
│   ├── BaseController.php      # Common controller functionality
│   ├── Admin/
│   │   ├── DashboardController.php
│   │   ├── ProductController.php
│   │   └── OrderController.php
│   └── Client/
│       ├── HomeController.php
│       ├── ShopController.php
│       └── ProductController.php
├── Models/
│   ├── BaseModel.php          # Base model with common methods
│   ├── Product.php
│   ├── Category.php
│   ├── Order.php
│   └── Customer.php
├── Views/
│   ├── Admin/                 # Admin panel templates
│   └── Client/                # Customer-facing templates
├── Services/                  # Business logic layer
├── Helpers/                   # Utility functions
└── Middleware/                # Request processing middleware
```

### Public Layer (`public/`)
```
public/
├── assets/                    # CSS, JS, images
├── uploads/                   # User-uploaded files
├── index.php                  # Main entry point
└── admin.php                  # Admin entry point
```

### Configuration Layer (`config/`)
```
config/
├── database.php              # Database connection
├── app.php                   # Application settings
└── constants.php             # Application constants
```

## Component Relationships

### Data Flow Pattern
```
Request → Router → Controller → Service → Model → Database
                              ↓
Response ← View ← Controller ← Service ← Model ← Database
```

### Admin vs Client Separation
- **Shared Components**: Models, Services, Helpers
- **Separate Controllers**: Different business logic for admin vs client
- **Separate Views**: Different UI/UX for admin vs client
- **Separate Entry Points**: Different routing and authentication

## Key Technical Decisions

### 1. Autoloading Strategy
- **PSR-4 Autoloading**: Automatic class loading based on namespace
- **Namespace Structure**: `App\Controllers\`, `App\Models\`, etc.
- **No Manual Includes**: Eliminates require/include statements

### 2. Database Access Pattern
- **PDO with Prepared Statements**: Secure database access
- **Connection Singleton**: Single database connection instance
- **Model-based Access**: Database operations through model classes

### 3. Template System
- **PHP Native Templates**: No external template engine dependency
- **Layout Inheritance**: Base layouts with content blocks
- **Component System**: Reusable template components

### 4. URL Routing
- **Clean URLs**: SEO-friendly URL structure
- **Route-to-Controller Mapping**: Direct mapping for simplicity
- **Admin Namespace**: Separate routing for admin functionality

## Security Patterns

### Authentication
- **Session-based Authentication**: PHP sessions for user state
- **Password Security**: Secure password handling
- **Admin Separation**: Isolated admin authentication

### Data Protection
- **Prepared Statements**: SQL injection prevention
- **Input Validation**: Server-side validation
- **File Upload Security**: Secure file handling

## Performance Considerations

### Database Optimization
- **Prepared Statements**: Query optimization and security
- **Selective Loading**: Load only required data
- **Connection Pooling**: Efficient database connections

### Asset Management
- **Static Assets**: Organized in public directory
- **Image Optimization**: Proper image handling and storage
- **Caching Headers**: Browser caching for static resources 