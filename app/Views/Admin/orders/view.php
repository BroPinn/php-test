<!-- Breadcrumb and Header -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= admin_url('orders') ?>">Orders</a></li>
        <li class="breadcrumb-item active">Order #ORD-7829</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="fas fa-receipt text-primary me-2"></i>Order #ORD-7829
        </h2>
        <p class="text-muted mb-0">Order placed on October 22, 2026 at 10:30 AM</p>
    </div>
    <div>
        <a href="<?= admin_url('orders') ?>" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i>Back to Orders
        </a>
        <button type="button" class="btn btn-outline-dark me-2" onclick="window.print()">
            <i class="fas fa-print me-1"></i>Print Invoice
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
            <i class="fas fa-edit me-1"></i>Update Status
        </button>
    </div>
</div>

<!-- Order Status Quick Summary -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card bg-light border-0">
            <div class="card-body">
                <small class="text-muted text-uppercase fw-bold">Order Status</small>
                <div class="mt-2">
                    <span class="badge bg-primary px-3 py-2 fs-6">Shipped</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light border-0">
            <div class="card-body">
                <small class="text-muted text-uppercase fw-bold">Payment Status</small>
                <div class="mt-2">
                    <span class="badge bg-success px-3 py-2 fs-6">Paid (Stripe)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light border-0">
            <div class="card-body">
                <small class="text-muted text-uppercase fw-bold">Total Amount</small>
                <div class="mt-2">
                    <h4 class="fw-bold mb-0 text-dark">$249.00</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light border-0">
            <div class="card-body">
                <small class="text-muted text-uppercase fw-bold">Tracking Number</small>
                <div class="mt-2">
                    <span class="fw-semibold text-primary">TRK-98421074-US</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Order Items and Financials -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Purchased Items (3)</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= asset('images/product-01.jpg') ?>" alt="Product" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Women's Trench Coat</h6>
                                            <small class="text-muted">Brand: Zara | Size: M | Color: Beige</small>
                                        </div>
                                    </div>
                                </td>
                                <td>$129.99</td>
                                <td>1</td>
                                <td class="text-end pe-4 fw-bold">$129.99</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= asset('images/product-07.jpg') ?>" alt="Product" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Leather Crossbody Bag</h6>
                                            <small class="text-muted">Brand: Gucci | Color: Brown</small>
                                        </div>
                                    </div>
                                </td>
                                <td>$75.00</td>
                                <td>1</td>
                                <td class="text-end pe-4 fw-bold">$75.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= asset('images/product-12.jpg') ?>" alt="Product" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Classic Aviator Sunglasses</h6>
                                            <small class="text-muted">Brand: Ray-Ban | Color: Gold</small>
                                        </div>
                                    </div>
                                </td>
                                <td>$45.00</td>
                                <td>1</td>
                                <td class="text-end pe-4 fw-bold">$45.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-top p-4">
                <div class="row justify-content-end">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Items Subtotal:</span>
                            <span class="fw-semibold">$249.99</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Promotional Discount:</span>
                            <span class="text-danger fw-semibold">-$0.99</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Standard Shipping:</span>
                            <span class="text-success fw-semibold">FREE</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Estimated Tax:</span>
                            <span class="fw-semibold">$0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fs-5 fw-bold">Total Paid:</span>
                            <span class="fs-5 fw-bold text-primary">$249.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Timeline -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Fulfillment Timeline</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 position-relative">
                    <li class="d-flex mb-4">
                        <div class="me-3 text-success">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Order Confirmed & Payment Verified</h6>
                            <small class="text-muted">October 22, 2026 - 10:32 AM via Stripe</small>
                        </div>
                    </li>
                    <li class="d-flex mb-4">
                        <div class="me-3 text-success">
                            <i class="fas fa-box-open fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Packed at Central Warehouse</h6>
                            <small class="text-muted">October 22, 2026 - 02:15 PM</small>
                        </div>
                    </li>
                    <li class="d-flex mb-4">
                        <div class="me-3 text-primary">
                            <i class="fas fa-shipping-fast fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Shipped with FedEx Ground</h6>
                            <small class="text-muted">October 22, 2026 - 04:45 PM | Tracking: TRK-98421074-US</small>
                        </div>
                    </li>
                    <li class="d-flex opacity-50">
                        <div class="me-3 text-muted">
                            <i class="fas fa-home fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Estimated Delivery</h6>
                            <small class="text-muted">October 25, 2026</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Customer & Delivery Details -->
    <div class="col-lg-4">
        <!-- Customer Info -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Customer Profile</h5>
                <a href="<?= admin_url('customers') ?>" class="btn btn-sm btn-link p-0">View User</a>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-md me-3">
                        <span class="avatar-title rounded-circle bg-primary-light text-primary fs-4">SJ</span>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Sarah Johnson</h6>
                        <small class="text-muted">Member since Jan 2025</small>
                    </div>
                </div>
                <div class="mb-2">
                    <i class="fas fa-envelope text-muted me-2"></i>
                    <a href="mailto:sarah.j@example.com" class="text-decoration-none">sarah.j@example.com</a>
                </div>
                <div class="mb-2">
                    <i class="fas fa-phone text-muted me-2"></i>
                    <span>+1 (555) 345-6789</span>
                </div>
                <div>
                    <i class="fas fa-shopping-bag text-muted me-2"></i>
                    <span>12 previous orders</span>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Shipping Address</h5>
            </div>
            <div class="card-body">
                <p class="mb-1 fw-bold">Sarah Johnson</p>
                <p class="text-muted mb-1">742 Evergreen Terrace</p>
                <p class="text-muted mb-1">Apt 4B</p>
                <p class="text-muted mb-1">Springfield, OR 97477</p>
                <p class="text-muted mb-0">United States</p>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Payment Method</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="fab fa-cc-visa fa-2x text-primary me-2"></i>
                    <div>
                        <div class="fw-bold">Visa ending in 4242</div>
                        <small class="text-muted">Expires 08/2028</small>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>Transaction ID:</span>
                        <code>txn_3N82b94Ksla81</code>
                    </div>
                    <div class="d-flex justify-content-between small text-muted">
                        <span>Payment Gateway:</span>
                        <span>Stripe Payments</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Order #ORD-7829</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="event.preventDefault(); bootstrap.Modal.getInstance(document.getElementById('updateStatusModal')).hide(); alert('Order status updated successfully (Mockup mode).');">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label">Order Fulfillment Status</label>
                        <select class="form-select" id="statusSelect">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped" selected>Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="trackingInput" class="form-label">Tracking Number</label>
                        <input type="text" class="form-control" id="trackingInput" value="TRK-98421074-US">
                    </div>
                    <div class="mb-3">
                        <label for="noteInput" class="form-label">Customer Notification Note</label>
                        <textarea class="form-control" id="noteInput" rows="2" placeholder="Your package is currently in transit..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
