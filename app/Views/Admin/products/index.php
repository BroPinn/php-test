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
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: #495057;
            background-color: #f8f9fa;
        }
        
        .badge-status {
            font-size: 0.75rem;
        }
        
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            margin: 0 0.125rem;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .modal-header .btn-close {
            filter: invert(1);
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
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
                        <a class="nav-link" href="/admin/slider">
                            <i class="fas fa-images me-2"></i>Slider
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
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="mb-1">
                                <i class="fas fa-box text-primary me-2"></i>Product Management
                            </h2>
                            <p class="text-muted mb-0">Manage your store products</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" onclick="openCreateModal()">
                            <i class="fas fa-plus me-2"></i>Add New Product
                        </button>
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
                    <div class="card">
                        <div class="card-body">
                            <?php if (empty($products)): ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No products found</h5>
                                    <p class="text-muted">Start by adding your first product!</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" onclick="openCreateModal()">
                                        <i class="fas fa-plus me-2"></i>Add New Product
                                    </button>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $product): ?>
                                                <tr>
                                                    <td><strong>#<?= $product['productID'] ?></strong></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <?php if (!empty($product['image_path'])): ?>
                                                                <img src="/public/uploads/products/<?= htmlspecialchars($product['image_path']) ?>" 
                                                                     alt="Product Image" class="product-image me-2">
                                                            <?php else: ?>
                                                                <div class="product-image me-2 bg-light d-flex align-items-center justify-content-center">
                                                                    <i class="fas fa-image text-muted"></i>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div>
                                                                <strong><?= htmlspecialchars($product['productName']) ?></strong>
                                                                <?php if (!empty($product['sku'])): ?>
                                                                    <br><small class="text-muted">SKU: <?= htmlspecialchars($product['sku']) ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <strong>$<?= number_format($product['price'], 2) ?></strong>
                                                        <?php if (!empty($product['sale_price'])): ?>
                                                            <br><small class="text-success">Sale: $<?= number_format($product['sale_price'], 2) ?></small>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-secondary"><?= htmlspecialchars($product['categoryName'] ?? 'No Category') ?></span>
                                                    </td>
                                                    <td>
                                                        <?= htmlspecialchars($product['brandName'] ?? 'No Brand') ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge <?= $product['stock_quantity'] > 10 ? 'bg-success' : ($product['stock_quantity'] > 0 ? 'bg-warning' : 'bg-danger') ?>">
                                                            <?= $product['stock_quantity'] ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-status <?= $product['status'] ? 'bg-success' : 'bg-danger' ?>">
                                                            <?= $product['status'] ? 'Active' : 'Inactive' ?>
                                                        </span>
                                                        <?php if ($product['featured']): ?>
                                                            <br><span class="badge bg-warning text-dark mt-1">Featured</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <small class="text-muted"><?= date('M j, Y', strtotime($product['created_at'])) ?></small>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary btn-action" 
                                                                onclick="openEditModal(<?= $product['productID'] ?>)" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger btn-action" 
                                                                onclick="confirmDelete(<?= $product['productID'] ?>, '<?= htmlspecialchars($product['productName']) ?>')" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="productForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="productID" name="productID">
                        
                        <!-- Image Upload Section -->
                        <div class="mb-4">
                            <label class="form-label">Product Image</label>
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="product_image" name="product_image" 
                                           accept="image/*" onchange="previewImage(this)">
                                    <small class="text-muted">Accepted formats: JPG, PNG, GIF, WebP (Max: 5MB)</small>
                                </div>
                                <div class="col-md-4">
                                    <div id="imagePreview" class="text-center">
                                        <div id="currentImage" style="display: none;">
                                            <img id="previewImg" src="" alt="Product Image" 
                                                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #dee2e6;">
                                        </div>
                                        <div id="noImage" class="p-3 bg-light rounded" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="productName" class="form-label">Product Name *</label>
                                    <input type="text" class="form-control" id="productName" name="productName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" class="form-control" id="sku" name="sku">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea class="form-control" id="short_description" name="short_description" rows="2"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sale_price" class="form-label">Sale Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" class="form-control" id="sale_price" name="sale_price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="categoryID" class="form-label">Category *</label>
                                    <select class="form-select" id="categoryID" name="categoryID" required>
                                        <option value="">Select Category</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['categoryID'] ?>"><?= htmlspecialchars($category['catName']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="brandID" class="form-label">Brand</label>
                                    <select class="form-select" id="brandID" name="brandID">
                                        <option value="">Select Brand</option>
                                        <?php foreach ($brands as $brand): ?>
                                            <option value="<?= $brand['brandID'] ?>"><?= htmlspecialchars($brand['brandName']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
                                        <label class="form-check-label" for="featured">
                                            Featured Product
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <p><strong id="deleteProductName"></strong></p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="deleteBtn" class="btn btn-danger">Delete Product</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function openCreateModal() {
            document.getElementById('productModalTitle').textContent = 'Add New Product';
            document.getElementById('productForm').action = '/admin/products/store';
            document.getElementById('submitBtn').textContent = 'Save Product';
            document.getElementById('productForm').reset();
            document.getElementById('productID').value = '';
            
            // Reset image preview
            resetImagePreview();
        }
        
        function openEditModal(productID) {
            document.getElementById('productModalTitle').textContent = 'Edit Product';
            document.getElementById('productForm').action = '/admin/products/update';
            document.getElementById('submitBtn').textContent = 'Update Product';
            
            // Fetch product data
            fetch('/admin/products/get?id=' + productID)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error loading product data');
                        return;
                    }
                    
                    // Populate form fields
                    document.getElementById('productID').value = data.productID;
                    document.getElementById('productName').value = data.productName || '';
                    document.getElementById('sku').value = data.sku || '';
                    document.getElementById('short_description').value = data.short_description || '';
                    document.getElementById('description').value = data.description || '';
                    document.getElementById('price').value = data.price || '';
                    document.getElementById('sale_price').value = data.sale_price || '';
                    document.getElementById('categoryID').value = data.categoryID || '';
                    document.getElementById('brandID').value = data.brandID || '';
                    document.getElementById('stock_quantity').value = data.stock_quantity || 0;
                    document.getElementById('status').value = data.status || 1;
                    document.getElementById('featured').checked = data.featured == 1;
                    
                    // Handle existing image
                    if (data.image_path) {
                        showExistingImage('/public/uploads/products/' + data.image_path);
                    } else {
                        resetImagePreview();
                    }
                    
                    // Show modal
                    new bootstrap.Modal(document.getElementById('productModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading product data');
                });
        }
        
        function confirmDelete(productID, productName) {
            document.getElementById('deleteProductName').textContent = productName;
            document.getElementById('deleteBtn').href = '/admin/products/delete?id=' + productID;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
        
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    showExistingImage(e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function showExistingImage(imageSrc) {
            document.getElementById('previewImg').src = imageSrc;
            document.getElementById('currentImage').style.display = 'block';
            document.getElementById('noImage').style.display = 'none';
        }
        
        function resetImagePreview() {
            document.getElementById('currentImage').style.display = 'none';
            document.getElementById('noImage').style.display = 'flex';
            document.getElementById('product_image').value = '';
        }
    </script>
</body>
</html> 