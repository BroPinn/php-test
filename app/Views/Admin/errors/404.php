<div class="row justify-content-center py-5">
    <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center p-5">
                <!-- Error Icon -->
                <div class="mb-4">
                    <i class="fas fa-exclamation-triangle" style="font-size: 80px; color: #fd7e14;"></i>
                </div>
                
                <!-- Error Title -->
                <h1 class="display-4 fw-bold text-danger mb-3">404</h1>
                <h2 class="h4 mb-3">Admin Page Not Found</h2>
                
                <!-- Error Message -->
                <p class="text-muted mb-4">
                    The admin page you requested could not be found or does not exist.
                </p>
                
                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a href="<?= admin_url('dashboard') ?>" class="btn btn-primary me-md-2">
                        <i class="fas fa-tachometer-alt me-2"></i>Return to Dashboard
                    </a>
                    <a href="<?= admin_url('products') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-box me-2"></i>Products
                    </a>
                </div>
                
                <!-- Additional Links -->
                <div class="mt-4 pt-3 border-top">
                    <p class="small text-muted mb-0">
                        <a href="<?= url('') ?>" target="_blank" class="text-decoration-none me-3">
                            <i class="fas fa-external-link-alt me-1"></i>View Storefront
                        </a>
                        <a href="<?= admin_url('login') ?>" class="text-decoration-none">
                            <i class="fas fa-sign-out-alt me-1"></i>Admin Logout
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>