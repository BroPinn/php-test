<?php
use App\Helpers\Helper;

$page_title = 'Admin Dashboard - OneStore';
$content = ob_start();
?>

<!-- Welcome Header -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-4">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-1">Welcome back, <?= htmlspecialchars($admin_user['name'] ?? 'Admin') ?>!</h2>
                <p class="text-muted mb-0">Here's what's happening with your store today.</p>
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
                            <h4 class="card-title"><?= $stats['total_products'] ?? 0 ?></h4>
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
                            <h4 class="card-title"><?= $stats['total_orders'] ?? 0 ?></h4>
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
                            <h4 class="card-title"><?= $stats['total_customers'] ?? 0 ?></h4>
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
                            <h4 class="card-title">$<?= number_format($stats['total_revenue'] ?? 0, 2) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line me-2"></i>Recent Orders
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($recent_orders)): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-shopping-cart fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No recent orders found</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_orders as $order): ?>
                                    <tr>
                                        <td><strong>#<?= $order['orderID'] ?></strong></td>
                                        <td><?= htmlspecialchars($order['customer_name'] ?? 'Unknown') ?></td>
                                        <td>$<?= number_format($order['total_amount'], 2) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $order['status'] === 'completed' ? 'success' : ($order['status'] === 'pending' ? 'warning' : 'secondary') ?>">
                                                <?= ucfirst($order['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-star me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= Helper::adminUrl('products') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Add New Product
                    </a>
                    <a href="<?= Helper::adminUrl('orders') ?>" class="btn btn-outline-success">
                        <i class="fas fa-eye me-2"></i>View All Orders
                    </a>
                    <a href="<?= Helper::adminUrl('customers') ?>" class="btn btn-outline-info">
                        <i class="fas fa-users me-2"></i>Manage Customers
                    </a>
                    <a href="<?= Helper::adminUrl('settings') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-cog me-2"></i>Store Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

// Dashboard-specific CSS
$additional_css = [];

// Dashboard-specific inline styles
$inline_scripts = '
document.addEventListener("DOMContentLoaded", function() {
    console.log("Dashboard loaded successfully");
});
';

// Include the admin layout
include ROOT_PATH . '/app/Views/Admin/layouts/admin.php';
?> 
