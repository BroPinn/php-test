<!-- Welcome Header -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-1">Welcome back, Administrator!</h2>
                <p class="text-muted mb-0">Here is what is happening with your store today.</p>
            </div>
            <div class="col-auto">
                <span class="badge bg-success">Online</span>
                <small class="text-muted ms-2"><?= date('M d, Y') ?></small>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Products</p>
                            <h4 class="card-title">48</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Orders</p>
                            <h4 class="card-title">128</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Revenue</p>
                            <h4 class="card-title">$24,850</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Total Customers</p>
                            <h4 class="card-title">89</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row">
    <!-- Recent Orders -->
    <div class="col-xl-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock me-2"></i>Recent Orders
                </h5>
                <a href="<?= admin_url('orders') ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7829</a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-2">
                                            <span class="avatar-title rounded-circle bg-primary-light text-primary">SJ</span>
                                        </div>
                                        <span>Sarah Johnson</span>
                                    </div>
                                </td>
                                <td>Oct 22, 2026</td>
                                <td class="fw-semibold">$249.00</td>
                                <td><span class="badge bg-primary">Shipped</span></td>
                                <td>
                                    <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7828</a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-2">
                                            <span class="avatar-title rounded-circle bg-success-light text-success">MC</span>
                                        </div>
                                        <span>Michael Chen</span>
                                    </div>
                                </td>
                                <td>Oct 21, 2026</td>
                                <td class="fw-semibold">$124.50</td>
                                <td><span class="badge bg-success">Delivered</span></td>
                                <td>
                                    <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7827</a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-2">
                                            <span class="avatar-title rounded-circle bg-warning-light text-warning">ED</span>
                                        </div>
                                        <span>Emily Davis</span>
                                    </div>
                                </td>
                                <td>Oct 21, 2026</td>
                                <td class="fw-semibold">$89.00</td>
                                <td><span class="badge bg-info">Processing</span></td>
                                <td>
                                    <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7826</a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-2">
                                            <span class="avatar-title rounded-circle bg-info-light text-info">DK</span>
                                        </div>
                                        <span>David Kim</span>
                                    </div>
                                </td>
                                <td>Oct 20, 2026</td>
                                <td class="fw-semibold">$45.00</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7825</a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-xs me-2">
                                            <span class="avatar-title rounded-circle bg-danger-light text-danger">JT</span>
                                        </div>
                                        <span>Jessica Taylor</span>
                                    </div>
                                </td>
                                <td>Oct 19, 2026</td>
                                <td class="fw-semibold">$320.00</td>
                                <td><span class="badge bg-success">Delivered</span></td>
                                <td>
                                    <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions and Store Summary -->
    <div class="col-xl-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= admin_url('products') ?>" class="btn btn-outline-primary text-start py-2">
                        <i class="fas fa-plus-circle me-2"></i>Add / Manage Products
                    </a>
                    <a href="<?= admin_url('orders') ?>" class="btn btn-outline-success text-start py-2">
                        <i class="fas fa-shopping-bag me-2"></i>View All Orders
                    </a>
                    <a href="<?= admin_url('customers') ?>" class="btn btn-outline-info text-start py-2">
                        <i class="fas fa-user-friends me-2"></i>Manage Customers
                    </a>
                    <a href="<?= admin_url('slider') ?>" class="btn btn-outline-secondary text-start py-2">
                        <i class="fas fa-images me-2"></i>Homepage Slider
                    </a>
                    <a href="<?= url('') ?>" target="_blank" class="btn btn-outline-dark text-start py-2">
                        <i class="fas fa-external-link-alt me-2"></i>Preview Storefront
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-pie me-2"></i>Top Categories
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Women's Fashion</span>
                        <span class="fw-bold">45%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 45%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Men's Apparel</span>
                        <span class="fw-bold">30%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 30%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Accessories & Bags</span>
                        <span class="fw-bold">15%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 15%"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-1">
                        <span>Footwear</span>
                        <span class="fw-bold">10%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
