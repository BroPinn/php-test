<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="fas fa-box text-primary me-2"></i>Product Management
        </h2>
        <p class="text-muted mb-0">Manage and organize store catalog items</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal" onclick="openCreateModal()">
        <i class="fas fa-plus me-2"></i>Add New Product
    </button>
</div>

<!-- Filters and Search -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search product name or SKU...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All Categories</option>
                    <option value="women">Women</option>
                    <option value="men">Men</option>
                    <option value="accessories">Accessories</option>
                    <option value="footwear">Footwear</option>
                    <option value="watches">Watches</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">All Brands</option>
                    <option value="zara">Zara</option>
                    <option value="nike">Nike</option>
                    <option value="levis">Levi's</option>
                    <option value="fossil">Fossil</option>
                    <option value="ralph">Ralph Lauren</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-secondary w-100">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>#1</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= asset('images/product-01.jpg') ?>" alt="Product" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Women's Trench Coat</h6>
                                    <small class="text-muted">SKU: W-COAT-01</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">Women</span></td>
                        <td>Zara</td>
                        <td class="fw-bold">$129.99</td>
                        <td><span class="badge bg-success-light text-success fw-bold">24 in stock</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editProduct('Women\'s Trench Coat', 129.99, 'Women', 'Zara', 24, 'Active')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(1)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#2</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= asset('images/product-02.jpg') ?>" alt="Product" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Men's Slim Fit Shirt</h6>
                                    <small class="text-muted">SKU: M-SHIRT-02</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">Men</span></td>
                        <td>Ralph Lauren</td>
                        <td class="fw-bold">$49.50</td>
                        <td><span class="badge bg-success-light text-success fw-bold">42 in stock</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editProduct('Men\'s Slim Fit Shirt', 49.50, 'Men', 'Ralph Lauren', 42, 'Active')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(2)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#3</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= asset('images/product-03.jpg') ?>" alt="Product" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Classic Denim Jacket</h6>
                                    <small class="text-muted">SKU: M-JACKET-03</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">Men</span></td>
                        <td>Levi's</td>
                        <td class="fw-bold">$89.00</td>
                        <td><span class="badge bg-warning-light text-warning fw-bold">8 in stock</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editProduct('Classic Denim Jacket', 89.00, 'Men', 'Levi\'s', 8, 'Active')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(3)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#4</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= asset('images/product-06.jpg') ?>" alt="Product" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Minimalist Gold Watch</h6>
                                    <small class="text-muted">SKU: W-WATCH-06</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">Watches</span></td>
                        <td>Fossil</td>
                        <td class="fw-bold">$159.00</td>
                        <td><span class="badge bg-success-light text-success fw-bold">15 in stock</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editProduct('Minimalist Gold Watch', 159.00, 'Watches', 'Fossil', 15, 'Active')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(4)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#5</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= asset('images/product-07.jpg') ?>" alt="Product" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Leather Crossbody Bag</h6>
                                    <small class="text-muted">SKU: A-BAG-07</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">Accessories</span></td>
                        <td>Gucci</td>
                        <td class="fw-bold">$75.00</td>
                        <td><span class="badge bg-danger-light text-danger fw-bold">3 in stock</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editProduct('Leather Crossbody Bag', 75.00, 'Accessories', 'Gucci', 3, 'Active')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(5)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#6</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= asset('images/product-09.jpg') ?>" alt="Product" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Urban Running Sneakers</h6>
                                    <small class="text-muted">SKU: F-SNEAK-09</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">Footwear</span></td>
                        <td>Nike</td>
                        <td class="fw-bold">$110.00</td>
                        <td><span class="badge bg-success-light text-success fw-bold">30 in stock</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editProduct('Urban Running Sneakers', 110.00, 'Footwear', 'Nike', 30, 'Active')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(6)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#7</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= asset('images/product-10.jpg') ?>" alt="Product" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Silk Floral Dress</h6>
                                    <small class="text-muted">SKU: W-DRESS-10</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">Women</span></td>
                        <td>Zara</td>
                        <td class="fw-bold">$95.00</td>
                        <td><span class="badge bg-success-light text-success fw-bold">12 in stock</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editProduct('Silk Floral Dress', 95.00, 'Women', 'Zara', 12, 'Active')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(7)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#8</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= asset('images/product-12.jpg') ?>" alt="Product" class="rounded me-3" style="width: 48px; height: 48px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-bold">Classic Aviator Sunglasses</h6>
                                    <small class="text-muted">SKU: A-GLASS-12</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border">Accessories</span></td>
                        <td>Ray-Ban</td>
                        <td class="fw-bold">$45.00</td>
                        <td><span class="badge bg-success-light text-success fw-bold">55 in stock</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editProduct('Classic Aviator Sunglasses', 45.00, 'Accessories', 'Ray-Ban', 55, 'Active')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(8)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center py-3">
        <span class="text-muted small">Showing 1 to 8 of 48 products</span>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

<!-- Add/Edit Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="productForm" onsubmit="event.preventDefault(); bootstrap.Modal.getInstance(document.getElementById('productModal')).hide(); alert('Product updated successfully (Mockup mode).');">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="prod_name" class="form-label">Product Name *</label>
                            <input type="text" class="form-control" id="prod_name" required placeholder="e.g. Classic Oxford Shirt">
                        </div>
                        <div class="col-md-4">
                            <label for="prod_price" class="form-label">Price ($) *</label>
                            <input type="number" step="0.01" class="form-control" id="prod_price" required placeholder="0.00">
                        </div>
                        <div class="col-md-6">
                            <label for="prod_category" class="form-label">Category *</label>
                            <select class="form-select" id="prod_category" required>
                                <option value="Women">Women</option>
                                <option value="Men">Men</option>
                                <option value="Accessories">Accessories</option>
                                <option value="Footwear">Footwear</option>
                                <option value="Watches">Watches</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="prod_brand" class="form-label">Brand *</label>
                            <select class="form-select" id="prod_brand" required>
                                <option value="Zara">Zara</option>
                                <option value="Ralph Lauren">Ralph Lauren</option>
                                <option value="Levi's">Levi's</option>
                                <option value="Nike">Nike</option>
                                <option value="Fossil">Fossil</option>
                                <option value="Gucci">Gucci</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="prod_stock" class="form-label">Stock Quantity *</label>
                            <input type="number" class="form-control" id="prod_stock" required placeholder="10">
                        </div>
                        <div class="col-md-6">
                            <label for="prod_status" class="form-label">Status</label>
                            <select class="form-select" id="prod_status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="prod_desc" class="form-label">Description</label>
                            <textarea class="form-control" id="prod_desc" rows="3" placeholder="Enter product details, material, and features..."></textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="prod_featured">
                                <label class="form-check-label" for="prod_featured">
                                    Feature on homepage
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveProductBtn">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('productModalLabel').textContent = 'Add New Product';
    document.getElementById('productForm').reset();
    document.getElementById('saveProductBtn').textContent = 'Create Product';
}

function editProduct(name, price, category, brand, stock, status) {
    document.getElementById('productModalLabel').textContent = 'Edit Product: ' + name;
    document.getElementById('prod_name').value = name;
    document.getElementById('prod_price').value = price;
    document.getElementById('prod_category').value = category;
    document.getElementById('prod_brand').value = brand;
    document.getElementById('prod_stock').value = stock;
    document.getElementById('prod_status').value = status;
    document.getElementById('saveProductBtn').textContent = 'Save Changes';
    new bootstrap.Modal(document.getElementById('productModal')).show();
}

function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this product? (Mockup mode)')) {
        alert('Product deleted successfully (Mockup mode).');
    }
}
</script>
