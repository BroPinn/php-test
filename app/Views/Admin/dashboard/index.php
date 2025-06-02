<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard - OneStore' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin: 0.25rem 0;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .main-content {
            padding: 2rem;
        }
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .stats-icon.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .stats-icon.success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .stats-icon.warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .stats-icon.info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }
        
        .stats-label {
            color: #6c757d;
            font-weight: 500;
            margin: 0;
        }
        
        .welcome-header {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .navbar-brand {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0">
                <div class="sidebar">
                    <div class="p-4">
                        <h4 class="mb-0">
                            <i class="fas fa-shield-alt me-2"></i>OneStore
                        </h4>
                        <small class="text-white-50">Admin Dashboard</small>
                    </div>
                    
                    <nav class="nav flex-column px-3">
                        <a class="nav-link active" href="/admin/dashboard">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="/admin/products">
                            <i class="fas fa-box me-2"></i>Products
                        </a>
                        <a class="nav-link" href="/admin/orders">
                            <i class="fas fa-shopping-cart me-2"></i>Orders
                        </a>
                        <a class="nav-link" href="/admin/customers">
                            <i class="fas fa-users me-2"></i>Customers
                        </a>
                        <a class="nav-link" href="/admin/categories">
                            <i class="fas fa-tags me-2"></i>Categories
                        </a>
                        <a class="nav-link" href="/admin/settings">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                        
                        <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
                        
                        <a class="nav-link" href="/" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>View Store
                        </a>
                        <a class="nav-link" href="/admin/logout">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="main-content">
                    <!-- Welcome Header -->
                    <div class="welcome-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2>Welcome back, <?= htmlspecialchars($admin_user['name'] ?? 'Admin') ?>!</h2>
                                <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                            </div>
                            <div class="col-auto">
                                <span class="badge bg-success">Online</span>
                                <small class="text-muted ms-2"><?= date('M d, Y') ?></small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Flash Messages -->
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($success) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Statistics Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon primary me-3">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <h3 class="stats-number"><?= number_format($stats['total_products'] ?? 0) ?></h3>
                                        <p class="stats-label">Total Products</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6">
                            <div class="card stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon success me-3">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div>
                                        <h3 class="stats-number"><?= number_format($stats['total_orders'] ?? 0) ?></h3>
                                        <p class="stats-label">Total Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6">
                            <div class="card stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon warning me-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <h3 class="stats-number"><?= number_format($stats['total_customers'] ?? 0) ?></h3>
                                        <p class="stats-label">Total Customers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6">
                            <div class="card stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon info me-3">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <h3 class="stats-number">$<?= number_format($stats['revenue_month'] ?? 0, 2) ?></h3>
                                        <p class="stats-label">Monthly Revenue</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-plus-circle me-2"></i>Quick Actions
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="/admin/products/create" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Add New Product
                                        </a>
                                        <a href="/admin/products" class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-2"></i>View All Products
                                        </a>
                                        <a href="/admin/orders" class="btn btn-outline-success">
                                            <i class="fas fa-shopping-cart me-2"></i>Manage Orders
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-chart-line me-2"></i>Revenue Today
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <h2 class="text-success">$<?= number_format($stats['revenue_today'] ?? 0, 2) ?></h2>
                                        <p class="text-muted">Today's sales</p>
                                        <small class="text-muted">Compared to yesterday</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 