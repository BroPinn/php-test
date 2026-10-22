<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="fas fa-tags text-primary me-2"></i>Category Management
        </h2>
        <p class="text-muted mb-0">Organize and manage store catalog categories</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="openCreateModal()">
        <i class="fas fa-plus me-2"></i>Add New Category
    </button>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-tags"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Categories</p>
                            <h4 class="card-title">6</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Active Categories</p>
                            <h4 class="card-title">6</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Catalog Items</p>
                            <h4 class="card-title">48</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Total Products</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>#1</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs me-2">
                                    <span class="avatar-title rounded bg-primary-light text-primary"><i class="fas fa-female"></i></span>
                                </div>
                                <span class="fw-bold">Women</span>
                            </div>
                        </td>
                        <td><code>women</code></td>
                        <td><small class="text-muted">Dresses, tops, outerwear and fashion wear for women</small></td>
                        <td><span class="badge bg-light text-dark border">18 items</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editCategory('Women', 'women', 'Dresses, tops, outerwear and fashion wear for women')">
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
                                <div class="avatar-xs me-2">
                                    <span class="avatar-title rounded bg-info-light text-info"><i class="fas fa-male"></i></span>
                                </div>
                                <span class="fw-bold">Men</span>
                            </div>
                        </td>
                        <td><code>men</code></td>
                        <td><small class="text-muted">Shirts, denim, jackets, and streetwear for men</small></td>
                        <td><span class="badge bg-light text-dark border">14 items</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editCategory('Men', 'men', 'Shirts, denim, jackets, and streetwear for men')">
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
                                <div class="avatar-xs me-2">
                                    <span class="avatar-title rounded bg-warning-light text-warning"><i class="fas fa-shopping-bag"></i></span>
                                </div>
                                <span class="fw-bold">Accessories</span>
                            </div>
                        </td>
                        <td><code>accessories</code></td>
                        <td><small class="text-muted">Handbags, sunglasses, belts, and leather accessories</small></td>
                        <td><span class="badge bg-light text-dark border">8 items</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editCategory('Accessories', 'accessories', 'Handbags, sunglasses, belts, and leather accessories')">
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
                                <div class="avatar-xs me-2">
                                    <span class="avatar-title rounded bg-success-light text-success"><i class="fas fa-shoe-prints"></i></span>
                                </div>
                                <span class="fw-bold">Footwear</span>
                            </div>
                        </td>
                        <td><code>footwear</code></td>
                        <td><small class="text-muted">Sneakers, boots, sandals, and formal shoes</small></td>
                        <td><span class="badge bg-light text-dark border">4 items</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editCategory('Footwear', 'footwear', 'Sneakers, boots, sandals, and formal shoes')">
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
                                <div class="avatar-xs me-2">
                                    <span class="avatar-title rounded bg-secondary-light text-secondary"><i class="fas fa-clock"></i></span>
                                </div>
                                <span class="fw-bold">Watches</span>
                            </div>
                        </td>
                        <td><code>watches</code></td>
                        <td><small class="text-muted">Classic and modern luxury wristwatches</small></td>
                        <td><span class="badge bg-light text-dark border">2 items</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editCategory('Watches', 'watches', 'Classic and modern luxury wristwatches')">
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
                                <div class="avatar-xs me-2">
                                    <span class="avatar-title rounded bg-danger-light text-danger"><i class="fas fa-tshirt"></i></span>
                                </div>
                                <span class="fw-bold">Outerwear</span>
                            </div>
                        </td>
                        <td><code>outerwear</code></td>
                        <td><small class="text-muted">Coats, jackets, cardigans, and windbreakers</small></td>
                        <td><span class="badge bg-light text-dark border">2 items</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editCategory('Outerwear', 'outerwear', 'Coats, jackets, cardigans, and windbreakers')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(6)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="categoryForm" onsubmit="event.preventDefault(); bootstrap.Modal.getInstance(document.getElementById('categoryModal')).hide(); alert('Category saved successfully (Mockup mode).');">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cat_name" class="form-label">Category Name *</label>
                        <input type="text" class="form-control" id="cat_name" required placeholder="e.g. Athleisure">
                    </div>
                    <div class="mb-3">
                        <label for="cat_slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="cat_slug" placeholder="e.g. athleisure">
                    </div>
                    <div class="mb-3">
                        <label for="cat_desc" class="form-label">Description</label>
                        <textarea class="form-control" id="cat_desc" rows="3" placeholder="Category summary for storefront..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cat_status" class="form-label">Status</label>
                        <select class="form-select" id="cat_status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveCategoryBtn">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('categoryModalLabel').textContent = 'Add New Category';
    document.getElementById('categoryForm').reset();
    document.getElementById('saveCategoryBtn').textContent = 'Create Category';
}

function editCategory(name, slug, desc) {
    document.getElementById('categoryModalLabel').textContent = 'Edit Category: ' + name;
    document.getElementById('cat_name').value = name;
    document.getElementById('cat_slug').value = slug;
    document.getElementById('cat_desc').value = desc;
    document.getElementById('saveCategoryBtn').textContent = 'Save Changes';
    new bootstrap.Modal(document.getElementById('categoryModal')).show();
}

function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this category? (Mockup mode)')) {
        alert('Category deleted successfully (Mockup mode).');
    }
}
</script>
