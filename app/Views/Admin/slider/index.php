<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Slider Management - OneStore Admin' ?></title>
    
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
        
        .slider-image {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .slider-preview {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }
        
        .slider-preview img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.3;
        }
        
        .slider-content {
            position: relative;
            z-index: 2;
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
                        <a class="nav-link" href="/admin/products">
                            <i class="fas fa-box me-2"></i>Products
                        </a>
                        <a class="nav-link active" href="/admin/slider">
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
                                <i class="fas fa-images text-primary me-2"></i>Slider Management
                            </h2>
                            <p class="text-muted mb-0">Manage homepage banner slides</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal" onclick="openCreateModal()">
                            <i class="fas fa-plus me-2"></i>Add New Slide
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
                    
                    <!-- Sliders Grid -->
                    <?php if (empty($sliders)): ?>
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No slides found</h5>
                                <p class="text-muted">Create your first homepage banner slide!</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sliderModal" onclick="openCreateModal()">
                                    <i class="fas fa-plus me-2"></i>Add New Slide
                                </button>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($sliders as $slider): ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100">
                                        <div class="slider-preview" style="height: 200px;">
                                            <?php if (!empty($slider['image'])): ?>
                                                <img src="/public/uploads/slider/<?= htmlspecialchars($slider['image']) ?>" alt="Slider Image">
                                            <?php endif; ?>
                                            <div class="slider-content">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <span class="badge <?= $slider['status'] ? 'bg-success' : 'bg-danger' ?>">
                                                        <?= $slider['status'] ? 'Active' : 'Inactive' ?>
                                                    </span>
                                                    <span class="badge bg-light text-dark">Position: <?= $slider['position'] ?></span>
                                                </div>
                                                <h5 class="mb-1"><?= htmlspecialchars($slider['title']) ?></h5>
                                                <?php if (!empty($slider['subtitle'])): ?>
                                                    <p class="mb-2 small"><?= htmlspecialchars($slider['subtitle']) ?></p>
                                                <?php endif; ?>
                                                <?php if (!empty($slider['button_text'])): ?>
                                                    <button class="btn btn-light btn-sm">
                                                        <?= htmlspecialchars($slider['button_text']) ?>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    #<?= $slider['sliderID'] ?> • Created: <?= date('M j, Y', strtotime($slider['created_at'])) ?>
                                                </small>
                                                <div>
                                                    <button type="button" class="btn btn-outline-primary btn-sm" 
                                                            onclick="openEditModal(<?= $slider['sliderID'] ?>)" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" 
                                                            onclick="confirmDelete(<?= $slider['sliderID'] ?>, '<?= htmlspecialchars($slider['title']) ?>')" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Slider Modal -->
    <div class="modal fade" id="sliderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sliderModalTitle">Add New Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="sliderForm" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="sliderID" name="sliderID">
                        
                        <!-- Image Upload Section -->
                        <div class="mb-4">
                            <label class="form-label">Slider Image *</label>
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="slider_image" name="slider_image" 
                                           accept="image/*" onchange="previewImage(this)">
                                    <small class="text-muted">Accepted formats: JPG, PNG, GIF, WebP (Max: 5MB) | Recommended size: 1920x600px</small>
                                </div>
                                <div class="col-md-4">
                                    <div id="imagePreview" class="text-center">
                                        <div id="currentImage" style="display: none;">
                                            <img id="previewImg" src="" alt="Slider Image" 
                                                 style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid #dee2e6;">
                                        </div>
                                        <div id="noImage" class="p-3 bg-light rounded" style="width: 120px; height: 80px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                            <i class="fas fa-image text-muted fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="number" class="form-control" id="position" name="position" value="1" min="1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle">
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="link_url" class="form-label">Link URL</label>
                                    <input type="text" class="form-control" id="link_url" name="link_url" placeholder="/shop or https://...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control" id="button_text" name="button_text" placeholder="Shop Now">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Save Slide</button>
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
                    <p>Are you sure you want to delete this slide?</p>
                    <p><strong id="deleteSliderTitle"></strong></p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="deleteBtn" class="btn btn-danger">Delete Slide</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function openCreateModal() {
            document.getElementById('sliderModalTitle').textContent = 'Add New Slide';
            document.getElementById('sliderForm').action = '/admin/slider/store';
            document.getElementById('submitBtn').textContent = 'Save Slide';
            document.getElementById('sliderForm').reset();
            document.getElementById('sliderID').value = '';
            
            // Reset image preview
            resetImagePreview();
        }
        
        function openEditModal(sliderID) {
            document.getElementById('sliderModalTitle').textContent = 'Edit Slide';
            document.getElementById('sliderForm').action = '/admin/slider/update';
            document.getElementById('submitBtn').textContent = 'Update Slide';
            
            // Fetch slider data
            fetch('/admin/slider/get?id=' + sliderID)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert('Error loading slider data');
                        return;
                    }
                    
                    // Populate form fields
                    document.getElementById('sliderID').value = data.sliderID;
                    document.getElementById('title').value = data.title || '';
                    document.getElementById('subtitle').value = data.subtitle || '';
                    document.getElementById('description').value = data.description || '';
                    document.getElementById('link_url').value = data.link_url || '';
                    document.getElementById('button_text').value = data.button_text || '';
                    document.getElementById('position').value = data.position || 1;
                    document.getElementById('status').value = data.status || 1;
                    
                    // Handle existing image
                    if (data.image) {
                        showExistingImage('/public/uploads/slider/' + data.image);
                    } else {
                        resetImagePreview();
                    }
                    
                    // Show modal
                    new bootstrap.Modal(document.getElementById('sliderModal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading slider data');
                });
        }
        
        function confirmDelete(sliderID, sliderTitle) {
            document.getElementById('deleteSliderTitle').textContent = sliderTitle;
            document.getElementById('deleteBtn').href = '/admin/slider/delete?id=' + sliderID;
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
            document.getElementById('slider_image').value = '';
        }
    </script>
</body>
</html> 