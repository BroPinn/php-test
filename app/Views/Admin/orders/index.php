<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="fas fa-shopping-cart text-primary me-2"></i>Order Management
        </h2>
        <p class="text-muted mb-0">Track and fulfill customer orders</p>
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
                            <i class="fas fa-shopping-bag"></i>
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
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Pending Orders</p>
                            <h4 class="card-title">12</h4>
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
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Processing</p>
                            <h4 class="card-title">24</h4>
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
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Completed</p>
                            <h4 class="card-title">92</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Orders Card -->
<div class="card">
    <div class="card-header border-bottom-0 pb-0">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search order ID or customer...">
                </div>
            </div>
            <div class="col-md-8 text-md-end">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-outline-secondary active">All (128)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Pending (12)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Processing (24)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Shipped (18)</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Delivered (92)</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0 mt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date Placed</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Fulfillment</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7829</a>
                        </td>
                        <td>
                            <div class="fw-bold">Sarah Johnson</div>
                            <small class="text-muted">sarah.j@example.com</small>
                        </td>
                        <td>Oct 22, 2026</td>
                        <td>3 items</td>
                        <td class="fw-bold">$249.00</td>
                        <td><span class="badge bg-success-light text-success border border-success">Paid (Card)</span></td>
                        <td><span class="badge bg-primary">Shipped</span></td>
                        <td class="text-end pe-4">
                            <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-primary me-1" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatus('ORD-7829', 'Shipped')">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7828</a>
                        </td>
                        <td>
                            <div class="fw-bold">Michael Chen</div>
                            <small class="text-muted">mchen@example.com</small>
                        </td>
                        <td>Oct 21, 2026</td>
                        <td>1 item</td>
                        <td class="fw-bold">$124.50</td>
                        <td><span class="badge bg-success-light text-success border border-success">Paid (PayPal)</span></td>
                        <td><span class="badge bg-success">Delivered</span></td>
                        <td class="text-end pe-4">
                            <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-primary me-1" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatus('ORD-7828', 'Delivered')">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7827</a>
                        </td>
                        <td>
                            <div class="fw-bold">Emily Davis</div>
                            <small class="text-muted">emily.d@example.com</small>
                        </td>
                        <td>Oct 21, 2026</td>
                        <td>2 items</td>
                        <td class="fw-bold">$89.00</td>
                        <td><span class="badge bg-success-light text-success border border-success">Paid (Card)</span></td>
                        <td><span class="badge bg-info">Processing</span></td>
                        <td class="text-end pe-4">
                            <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-primary me-1" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatus('ORD-7827', 'Processing')">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7826</a>
                        </td>
                        <td>
                            <div class="fw-bold">David Kim</div>
                            <small class="text-muted">dkim99@example.com</small>
                        </td>
                        <td>Oct 20, 2026</td>
                        <td>1 item</td>
                        <td class="fw-bold">$45.00</td>
                        <td><span class="badge bg-warning-light text-warning border border-warning">Pending (COD)</span></td>
                        <td><span class="badge bg-warning">Pending</span></td>
                        <td class="text-end pe-4">
                            <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-primary me-1" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatus('ORD-7826', 'Pending')">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7825</a>
                        </td>
                        <td>
                            <div class="fw-bold">Jessica Taylor</div>
                            <small class="text-muted">jtaylor@example.com</small>
                        </td>
                        <td>Oct 19, 2026</td>
                        <td>4 items</td>
                        <td class="fw-bold">$320.00</td>
                        <td><span class="badge bg-success-light text-success border border-success">Paid (Card)</span></td>
                        <td><span class="badge bg-success">Delivered</span></td>
                        <td class="text-end pe-4">
                            <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-primary me-1" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatus('ORD-7825', 'Delivered')">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7824</a>
                        </td>
                        <td>
                            <div class="fw-bold">Alex Brown</div>
                            <small class="text-muted">abrown@example.com</small>
                        </td>
                        <td>Oct 18, 2026</td>
                        <td>2 items</td>
                        <td class="fw-bold">$158.00</td>
                        <td><span class="badge bg-success-light text-success border border-success">Paid (Card)</span></td>
                        <td><span class="badge bg-primary">Shipped</span></td>
                        <td class="text-end pe-4">
                            <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-primary me-1" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatus('ORD-7824', 'Shipped')">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="<?= admin_url('orders/view') ?>" class="fw-bold text-decoration-none">#ORD-7823</a>
                        </td>
                        <td>
                            <div class="fw-bold">Sophia Wilson</div>
                            <small class="text-muted">swilson@example.com</small>
                        </td>
                        <td>Oct 17, 2026</td>
                        <td>1 item</td>
                        <td class="fw-bold">$75.00</td>
                        <td><span class="badge bg-danger-light text-danger border border-danger">Refunded</span></td>
                        <td><span class="badge bg-danger">Cancelled</span></td>
                        <td class="text-end pe-4">
                            <a href="<?= admin_url('orders/view') ?>" class="btn btn-sm btn-outline-primary me-1" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateStatus('ORD-7823', 'Cancelled')">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center py-3">
        <span class="text-muted small">Showing 1 to 7 of 128 orders</span>
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

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Order Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="event.preventDefault(); bootstrap.Modal.getInstance(document.getElementById('statusModal')).hide(); alert('Order status updated successfully (Mockup mode).');">
                <div class="modal-body">
                    <p>Updating status for <strong id="modalOrderId">#ORD-7829</strong></p>
                    <div class="mb-3">
                        <label for="order_status_select" class="form-label">Fulfillment Status</label>
                        <select class="form-select" id="order_status_select">
                            <option value="Pending">Pending</option>
                            <option value="Processing">Processing</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updateStatus(orderId, currentStatus) {
    document.getElementById('modalOrderId').textContent = '#' + orderId;
    document.getElementById('order_status_select').value = currentStatus;
    new bootstrap.Modal(document.getElementById('statusModal')).show();
}
</script>
