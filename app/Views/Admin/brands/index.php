<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="fas fa-tag text-primary me-2"></i>Brand Management
        </h2>
        <p class="text-muted mb-0">Manage manufacturer and designer brands</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#brandModal" onclick="openCreateModal()">
        <i class="fas fa-plus me-2"></i>Add New Brand
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
                            <i class="fas fa-tag"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Brands</p>
                            <h4 class="card-title">8</h4>
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
                            <p class="card-category">Active Brands</p>
                            <h4 class="card-title">8</h4>
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
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Featured Brands</p>
                            <h4 class="card-title">4</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Brand Name</th>
                        <th>Description</th>
                        <th>Total Products</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>#1</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2 bg-dark text-white rounded d-flex align-items-center justify-content-center fw-bold">
                                    NK
                                </div>
                                <span class="fw-bold">Nike</span>
                            </div>
                        </td>
                        <td><small class="text-muted">Athletic footwear, training gear and sportswear</small></td>
                        <td><span class="badge bg-light text-dark border">12 products</span></td>
                        <td><span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editBrand('Nike', 'Athletic footwear, training gear and sportswear', true)">
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
                                <div class="avatar-sm me-2 bg-secondary text-white rounded d-flex align-items-center justify-content-center fw-bold">
                                    ZR
                                </div>
                                <span class="fw-bold">Zara</span>
                            </div>
                        </td>
                        <td><small class="text-muted">Contemporary European fashion, coats, and urban apparel</small></td>
                        <td><span class="badge bg-light text-dark border">10 products</span></td>
                        <td><span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editBrand('Zara', 'Contemporary European fashion, coats, and urban apparel', true)">
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
                                <div class="avatar-sm me-2 bg-primary text-white rounded d-flex align-items-center justify-content-center fw-bold">
                                    RL
                                </div>
                                <span class="fw-bold">Ralph Lauren</span>
                            </div>
                        </td>
                        <td><small class="text-muted">Classic polo shirts, oxford button-downs, and luxury knitwear</small></td>
                        <td><span class="badge bg-light text-dark border">8 products</span></td>
                        <td><span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editBrand('Ralph Lauren', 'Classic polo shirts, oxford button-downs, and luxury knitwear', true)">
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
                                <div class="avatar-sm me-2 bg-danger text-white rounded d-flex align-items-center justify-content-center fw-bold">
                                    LV
                                </div>
                                <span class="fw-bold">Levi's</span>
                            </div>
                        </td>
                        <td><small class="text-muted">Authentic denim jeans, jackets, and heritage workwear</small></td>
                        <td><span class="badge bg-light text-dark border">6 products</span></td>
                        <td><span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Featured</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editBrand('Levi\'s', 'Authentic denim jeans, jackets, and heritage workwear', true)">
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
                                <div class="avatar-sm me-2 bg-info text-white rounded d-flex align-items-center justify-content-center fw-bold">
                                    FS
                                </div>
                                <span class="fw-bold">Fossil</span>
                            </div>
                        </td>
                        <td><small class="text-muted">Timepieces, minimalist chronograph watches, and leather bags</small></td>
                        <td><span class="badge bg-light text-dark border">4 products</span></td>
                        <td><span class="badge bg-light text-muted border">Standard</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editBrand('Fossil', 'Timepieces, minimalist chronograph watches, and leather bags', false)">
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
                                <div class="avatar-sm me-2 bg-success text-white rounded d-flex align-items-center justify-content-center fw-bold">
                                    GC
                                </div>
                                <span class="fw-bold">Gucci</span>
                            </div>
                        </td>
                        <td><small class="text-muted">High-end Italian luxury bags, leather belts, and accessories</small></td>
                        <td><span class="badge bg-light text-dark border">3 products</span></td>
                        <td><span class="badge bg-light text-muted border">Standard</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editBrand('Gucci', 'High-end Italian luxury bags, leather belts, and accessories', false)">
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
                                <div class="avatar-sm me-2 bg-dark text-white rounded d-flex align-items-center justify-content-center fw-bold">
                                    RB
                                </div>
                                <span class="fw-bold">Ray-Ban</span>
                            </div>
                        </td>
                        <td><small class="text-muted">Iconic aviator sunglasses and polarized premium eyewear</small></td>
                        <td><span class="badge bg-light text-dark border">3 products</span></td>
                        <td><span class="badge bg-light text-muted border">Standard</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editBrand('Ray-Ban', 'Iconic aviator sunglasses and polarized premium eyewear', false)">
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
                                <div class="avatar-sm me-2 bg-primary text-white rounded d-flex align-items-center justify-content-center fw-bold">
                                    AD
                                </div>
                                <span class="fw-bold">Adidas</span>
                            </div>
                        </td>
                        <td><small class="text-muted">Originals sneakers, activewear, and running essentials</small></td>
                        <td><span class="badge bg-light text-dark border">2 products</span></td>
                        <td><span class="badge bg-light text-muted border">Standard</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editBrand('Adidas', 'Originals sneakers, activewear, and running essentials', false)">
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
</div>

<!-- Add/Edit Brand Modal -->
<div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brandModalLabel">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="brandForm" onsubmit="event.preventDefault(); bootstrap.Modal.getInstance(document.getElementById('brandModal')).hide(); alert('Brand saved successfully (Mockup mode).');">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand Name *</label>
                        <input type="text" class="form-control" id="brand_name" required placeholder="e.g. Calvin Klein">
                    </div>
                    <div class="mb-3">
                        <label for="brand_desc" class="form-label">Description</label>
                        <textarea class="form-control" id="brand_desc" rows="3" placeholder="Brand overview and details..."></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="brand_featured">
                            <label class="form-check-label" for="brand_featured">
                                Mark as Featured Brand
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="brand_status" class="form-label">Status</label>
                        <select class="form-select" id="brand_status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveBrandBtn">Save Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('brandModalLabel').textContent = 'Add New Brand';
    document.getElementById('brandForm').reset();
    document.getElementById('saveBrandBtn').textContent = 'Create Brand';
}

function editBrand(name, desc, featured) {
    document.getElementById('brandModalLabel').textContent = 'Edit Brand: ' + name;
    document.getElementById('brand_name').value = name;
    document.getElementById('brand_desc').value = desc;
    document.getElementById('brand_featured').checked = featured;
    document.getElementById('saveBrandBtn').textContent = 'Save Changes';
    new bootstrap.Modal(document.getElementById('brandModal')).show();
}

function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this brand? (Mockup mode)')) {
        alert('Brand deleted successfully (Mockup mode).');
    }
}
</script>
