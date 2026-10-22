<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1">
            <i class="fas fa-users text-primary me-2"></i>Customer Management
        </h2>
        <p class="text-muted mb-0">Manage customer accounts and purchase history</p>
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
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-success bubble-shadow-small">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Verified Users</p>
                            <h4 class="card-title">84</h4>
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
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">New This Month</p>
                            <h4 class="card-title">16</h4>
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
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                            <p class="card-category">Avg. Order Value</p>
                            <h4 class="card-title">$194</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Customers Table -->
<div class="card">
    <div class="card-header border-bottom-0 pb-0">
        <div class="row g-3 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search customer by name, email, or phone...">
                </div>
            </div>
            <div class="col-md-7 text-md-end">
                <select class="form-select d-inline-block w-auto">
                    <option value="">All Statuses</option>
                    <option value="active">Active Only</option>
                    <option value="inactive">Inactive Only</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body p-0 mt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Joined Date</th>
                        <th>Total Orders</th>
                        <th>Total Spent</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>#101</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title rounded-circle bg-primary-light text-primary fw-bold">SJ</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Sarah Johnson</h6>
                                    <small class="text-muted">sarah.j@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td>+1 (555) 345-6789</td>
                        <td>Jan 15, 2025</td>
                        <td><span class="badge bg-light text-dark border">12 orders</span></td>
                        <td class="fw-bold">$2,140.00</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewCustomer('Sarah Johnson', 'sarah.j@example.com', '+1 (555) 345-6789', '742 Evergreen Terrace, Springfield, OR', '12', '$2,140.00')">
                                <i class="fas fa-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#102</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title rounded-circle bg-success-light text-success fw-bold">MC</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Michael Chen</h6>
                                    <small class="text-muted">mchen@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td>+1 (555) 892-1204</td>
                        <td>Mar 22, 2025</td>
                        <td><span class="badge bg-light text-dark border">8 orders</span></td>
                        <td class="fw-bold">$1,280.50</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewCustomer('Michael Chen', 'mchen@example.com', '+1 (555) 892-1204', '124 Maple St, Austin, TX', '8', '$1,280.50')">
                                <i class="fas fa-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#103</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title rounded-circle bg-warning-light text-warning fw-bold">ED</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Emily Davis</h6>
                                    <small class="text-muted">emily.d@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td>+1 (555) 431-9081</td>
                        <td>May 08, 2025</td>
                        <td><span class="badge bg-light text-dark border">5 orders</span></td>
                        <td class="fw-bold">$670.00</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewCustomer('Emily Davis', 'emily.d@example.com', '+1 (555) 431-9081', '89 Ocean Ave, Santa Monica, CA', '5', '$670.00')">
                                <i class="fas fa-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#104</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title rounded-circle bg-info-light text-info fw-bold">DK</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">David Kim</h6>
                                    <small class="text-muted">dkim99@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td>+1 (555) 672-3319</td>
                        <td>Jul 19, 2025</td>
                        <td><span class="badge bg-light text-dark border">3 orders</span></td>
                        <td class="fw-bold">$340.00</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewCustomer('David Kim', 'dkim99@example.com', '+1 (555) 672-3319', '512 Pinecrest Blvd, Seattle, WA', '3', '$340.00')">
                                <i class="fas fa-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#105</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title rounded-circle bg-danger-light text-danger fw-bold">JT</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Jessica Taylor</h6>
                                    <small class="text-muted">jtaylor@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td>+1 (555) 219-8802</td>
                        <td>Aug 02, 2025</td>
                        <td><span class="badge bg-light text-dark border">9 orders</span></td>
                        <td class="fw-bold">$1,590.00</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewCustomer('Jessica Taylor', 'jtaylor@example.com', '+1 (555) 219-8802', '310 Sunset Dr, Miami, FL', '9', '$1,590.00')">
                                <i class="fas fa-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#106</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title rounded-circle bg-dark-light text-dark fw-bold">AB</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Alex Brown</h6>
                                    <small class="text-muted">abrown@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td>+1 (555) 901-4477</td>
                        <td>Sep 11, 2025</td>
                        <td><span class="badge bg-light text-dark border">4 orders</span></td>
                        <td class="fw-bold">$510.00</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewCustomer('Alex Brown', 'abrown@example.com', '+1 (555) 901-4477', '702 Willowbrook Rd, Chicago, IL', '4', '$510.00')">
                                <i class="fas fa-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td><strong>#107</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title rounded-circle bg-secondary-light text-secondary fw-bold">SW</span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Sophia Wilson</h6>
                                    <small class="text-muted">swilson@example.com</small>
                                </div>
                            </div>
                        </td>
                        <td>+1 (555) 349-2180</td>
                        <td>Oct 04, 2025</td>
                        <td><span class="badge bg-light text-dark border">2 orders</span></td>
                        <td class="fw-bold">$185.00</td>
                        <td><span class="badge bg-secondary">Inactive</span></td>
                        <td class="text-end pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewCustomer('Sophia Wilson', 'swilson@example.com', '+1 (555) 349-2180', '19 Beacon St, Boston, MA', '2', '$185.00')">
                                <i class="fas fa-eye me-1"></i>View
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center py-3">
        <span class="text-muted small">Showing 1 to 7 of 89 customers</span>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

<!-- Customer Details Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="custModalName">Customer Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-lg mx-auto mb-2">
                        <span class="avatar-title rounded-circle bg-primary-light text-primary fs-3" id="custModalAvatar">U</span>
                    </div>
                    <h5 class="mb-0 fw-bold" id="custModalFullName">Sarah Johnson</h5>
                    <p class="text-muted" id="custModalEmail">sarah.j@example.com</p>
                </div>
                <ul class="list-group list-group-flush border-top">
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Phone:</span>
                        <span class="fw-semibold" id="custModalPhone">+1 (555) 345-6789</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Shipping Address:</span>
                        <span class="fw-semibold text-end" id="custModalAddress">Springfield, OR</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Total Completed Orders:</span>
                        <span class="fw-semibold" id="custModalOrders">12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Lifetime Value:</span>
                        <span class="fw-bold text-success" id="custModalSpent">$2,140.00</span>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewCustomer(name, email, phone, address, orders, spent) {
    document.getElementById('custModalName').textContent = name + ' - Details';
    document.getElementById('custModalFullName').textContent = name;
    document.getElementById('custModalEmail').textContent = email;
    document.getElementById('custModalPhone').textContent = phone;
    document.getElementById('custModalAddress').textContent = address;
    document.getElementById('custModalOrders').textContent = orders;
    document.getElementById('custModalSpent').textContent = spent;
    document.getElementById('custModalAvatar').textContent = name.split(' ').map(n => n[0]).join('');
    new bootstrap.Modal(document.getElementById('customerModal')).show();
}
</script>
