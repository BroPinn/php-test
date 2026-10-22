<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="fas fa-images text-primary me-2"></i>Slider Management
        </h2>
        <p class="text-muted mb-0">Manage homepage hero banners and promotions</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal" onclick="openCreateModal()">
        <i class="fas fa-plus me-2"></i>Add New Slide
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
                            <i class="fas fa-images"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Slides</p>
                            <h4 class="card-title">3</h4>
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
                            <p class="card-category">Active Slides</p>
                            <h4 class="card-title">3</h4>
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
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Views</p>
                            <h4 class="card-title">14,250</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Slides Table -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">Order</th>
                        <th>Banner Image</th>
                        <th>Title & Subtitle</th>
                        <th>CTA Button</th>
                        <th>Target Link</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>#1</strong></td>
                        <td>
                            <img src="<?= asset('images/slide-01.jpg') ?>" alt="Slide 1" class="rounded shadow-sm" style="width: 120px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold">Women Collection 2026</div>
                            <small class="text-muted">NEW SEASON</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">SHOP NOW</span></td>
                        <td><code>/shop</code></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editSlide('Women Collection 2026', 'NEW SEASON', 'SHOP NOW', '/shop', 1)">
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
                            <img src="<?= asset('images/slide-02.jpg') ?>" alt="Slide 2" class="rounded shadow-sm" style="width: 120px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold">Men New-Season</div>
                            <small class="text-muted">JACKETS & COATS</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">DISCOVER</span></td>
                        <td><code>/shop</code></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editSlide('Men New-Season', 'JACKETS & COATS', 'DISCOVER', '/shop', 2)">
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
                            <img src="<?= asset('images/slide-03.jpg') ?>" alt="Slide 3" class="rounded shadow-sm" style="width: 120px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold">Men & Women Collection</div>
                            <small class="text-muted">NEW ARRIVALS</small>
                        </td>
                        <td><span class="badge bg-light text-dark border">SHOP NOW</span></td>
                        <td><code>/shop</code></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="editSlide('Men & Women Collection', 'NEW ARRIVALS', 'SHOP NOW', '/shop', 3)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete(3)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Slide Modal -->
<div class="modal fade" id="slideModal" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="slideModalLabel">Add New Slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="event.preventDefault(); bootstrap.Modal.getInstance(document.getElementById('slideModal')).hide(); alert('Slide saved successfully (Mockup mode).');">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="slide_title" class="form-label">Headline Title *</label>
                            <input type="text" class="form-control" id="slide_title" required placeholder="e.g. Summer Clearance Sale">
                        </div>
                        <div class="col-md-6">
                            <label for="slide_subtitle" class="form-label">Subtitle / Tagline</label>
                            <input type="text" class="form-control" id="slide_subtitle" placeholder="e.g. UP TO 50% OFF">
                        </div>
                        <div class="col-md-6">
                            <label for="slide_btn_text" class="form-label">Button Label</label>
                            <input type="text" class="form-control" id="slide_btn_text" placeholder="e.g. Shop Now">
                        </div>
                        <div class="col-md-6">
                            <label for="slide_url" class="form-label">Target URL</label>
                            <input type="text" class="form-control" id="slide_url" placeholder="e.g. /shop">
                        </div>
                        <div class="col-md-6">
                            <label for="slide_order" class="form-label">Display Priority Order</label>
                            <input type="number" class="form-control" id="slide_order" value="1">
                        </div>
                        <div class="col-md-6">
                            <label for="slide_status" class="form-label">Status</label>
                            <select class="form-select" id="slide_status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="slide_image" class="form-label">Upload Slide Background Image</label>
                            <input type="file" class="form-control" id="slide_image" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveSlideBtn">Save Slide</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('slideModalLabel').textContent = 'Add New Slide';
    document.getElementById('slide_title').value = '';
    document.getElementById('slide_subtitle').value = '';
    document.getElementById('slide_btn_text').value = 'SHOP NOW';
    document.getElementById('slide_url').value = '/shop';
    document.getElementById('slide_order').value = 4;
    document.getElementById('saveSlideBtn').textContent = 'Create Slide';
}

function editSlide(title, subtitle, btnText, url, order) {
    document.getElementById('slideModalLabel').textContent = 'Edit Slide: ' + title;
    document.getElementById('slide_title').value = title;
    document.getElementById('slide_subtitle').value = subtitle;
    document.getElementById('slide_btn_text').value = btnText;
    document.getElementById('slide_url').value = url;
    document.getElementById('slide_order').value = order;
    document.getElementById('saveSlideBtn').textContent = 'Save Changes';
    new bootstrap.Modal(document.getElementById('slideModal')).show();
}

function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this slide? (Mockup mode)')) {
        alert('Slide deleted successfully (Mockup mode).');
    }
}
</script>
