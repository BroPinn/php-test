<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Product Management - OneStore Admin' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
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
        
        .page-header {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            margin: 0 0.125rem;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background: #f8d7da;
            color: #721c24;
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
                        <a class="nav-link" href="/admin/dashboard">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                        <a class="nav-link active" href="/admin/products">
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
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2><i class="fas fa-box me-2"></i>Product Management</h2>
                                <p class="text-muted mb-0">Manage your store products</p>
                            </div>
                            <div class="col-auto">
                                <a href="/admin/products/create" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add New Product
                                </a>
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
                    
                    <!-- Products Table -->
                    <div class="table-container">
                        <table id="productsTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($product['id']) ?></td>
                                            <td>
                                                <strong><?= htmlspecialchars($product['name']) ?></strong>
                                                <?php if (!empty($product['description'])): ?>
                                                    <br><small class="text-muted"><?= htmlspecialchars(substr($product['description'], 0, 50)) ?>...</small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong>$<?= number_format($product['price'], 2) ?></strong>
                                            </td>
                                            <td>
                                                <?php if (!empty($product['category_id'])): ?>
                                                    <span class="badge bg-secondary">Category <?= $product['category_id'] ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">No Category</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="status-badge <?= $product['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                                                    <?= ucfirst($product['status']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= date('M d, Y', strtotime($product['created_at'])) ?>
                                            </td>
                                            <td>
                                                <a href="/admin/products/edit?id=<?= $product['id'] ?>" 
                                                   class="btn btn-sm btn-outline-primary btn-action" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="/admin/products/delete?id=<?= $product['id'] ?>" 
                                                   class="btn btn-sm btn-outline-danger btn-action" 
                                                   title="Delete"
                                                   onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-box fa-3x mb-3 d-block"></i>
                                                <h5>No products found</h5>
                                                <p>Start by adding your first product!</p>
                                                <a href="/admin/products/create" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Add New Product
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable({
                pageLength: 25,
                responsive: true,
                order: [[0, 'desc']],
                columnDefs: [
                    { orderable: false, targets: [6] }
                ]
            });
        });
    </script>
</body>
</html> 