<!-- Account Dashboard -->
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <!-- Welcome Section -->
        <div class="row p-b-40">
            <div class="col-md-12">
                <div class="bg-light p-lr-40 p-t-30 p-b-30 bor10">
                    <h3 class="mtext-111 cl2 p-b-10">
                        <i class="fa fa-user-circle m-r-10 text-primary"></i>
                        Welcome back, Jane Doe!
                    </h3>
                    <p class="stext-113 cl6">
                        Manage your account profile, track your active orders, and view past purchases.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Account Navigation Sidebar -->
            <div class="col-md-3 p-b-30">
                <div class="bor10 p-lr-20 p-t-30 p-b-30">
                    <h5 class="mtext-108 cl2 p-b-20 font-weight-bold">
                        Account Navigation
                    </h5>
                    
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active text-left p-tb-10" id="tab-overview" data-bs-toggle="pill" data-bs-target="#overview" type="button" role="tab">
                            <i class="fa fa-dashboard m-r-10"></i> Overview
                        </button>
                        <button class="nav-link text-left p-tb-10" id="tab-orders" data-bs-toggle="pill" data-bs-target="#orders" type="button" role="tab">
                            <i class="fa fa-shopping-bag m-r-10"></i> My Orders
                        </button>
                        <button class="nav-link text-left p-tb-10" id="tab-profile" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
                            <i class="fa fa-user m-r-10"></i> Profile Details
                        </button>
                        <button class="nav-link text-left p-tb-10" id="tab-addresses" data-bs-toggle="pill" data-bs-target="#addresses" type="button" role="tab">
                            <i class="fa fa-map-marker m-r-10"></i> Addresses
                        </button>
                        <a href="<?= url('login') ?>" class="nav-link text-left p-tb-10 text-danger">
                            <i class="fa fa-sign-out m-r-10"></i> Logout
                        </a>
                    </div>
                </div>
            </div>

            <!-- Account Content -->
            <div class="col-md-9 p-b-30">
                <div class="tab-content bor10 p-lr-40 p-t-30 p-b-40" id="v-pills-tabContent">
                    <!-- Overview Tab -->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                        <h4 class="mtext-109 cl2 p-b-20">Account Overview</h4>
                        <div class="row g-3 m-b-30">
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded text-center">
                                    <h3 class="text-primary font-weight-bold">5</h3>
                                    <span class="stext-115 cl6">Total Orders</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded text-center">
                                    <h3 class="text-success font-weight-bold">1</h3>
                                    <span class="stext-115 cl6">In Transit</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3 bg-light rounded text-center">
                                    <h3 class="text-info font-weight-bold">$540</h3>
                                    <span class="stext-115 cl6">Total Spent</span>
                                </div>
                            </div>
                        </div>

                        <h5 class="mtext-108 cl2 p-b-15">Recent Order</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>#ORD-2025-89412</strong></td>
                                        <td><?= date('M d, Y') ?></td>
                                        <td><span class="badge badge-success p-2">Processing</span></td>
                                        <td>$133.00</td>
                                        <td><a href="<?= url('order-confirmation') ?>" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                    <tr>
                                        <td><strong>#ORD-2025-78119</strong></td>
                                        <td>Dec 14, 2024</td>
                                        <td><span class="badge badge-secondary p-2">Delivered</span></td>
                                        <td>$88.50</td>
                                        <td><a href="<?= url('order-confirmation') ?>" class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Orders Tab -->
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                        <h4 class="mtext-109 cl2 p-b-20">Order History</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Items</th>
                                        <th>Date</th>
                                        <th>Payment</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>#ORD-2025-89412</strong></td>
                                        <td>2 items</td>
                                        <td><?= date('M d, Y') ?></td>
                                        <td>Credit Card</td>
                                        <td>$133.00</td>
                                        <td><span class="badge badge-success">Processing</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>#ORD-2025-78119</strong></td>
                                        <td>1 item</td>
                                        <td>Dec 14, 2024</td>
                                        <td>PayPal</td>
                                        <td>$88.50</td>
                                        <td><span class="badge badge-secondary">Delivered</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>#ORD-2024-65021</strong></td>
                                        <td>3 items</td>
                                        <td>Nov 02, 2024</td>
                                        <td>Cash on Delivery</td>
                                        <td>$215.00</td>
                                        <td><span class="badge badge-secondary">Delivered</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <h4 class="mtext-109 cl2 p-b-20">Profile Information</h4>
                        <form onsubmit="event.preventDefault(); alert('Profile updated successfully!');">
                            <div class="row">
                                <div class="col-md-6 m-b-20">
                                    <label class="stext-102 cl3 m-b-5">First Name</label>
                                    <input type="text" class="form-control" value="Jane">
                                </div>
                                <div class="col-md-6 m-b-20">
                                    <label class="stext-102 cl3 m-b-5">Last Name</label>
                                    <input type="text" class="form-control" value="Doe">
                                </div>
                            </div>
                            <div class="m-b-20">
                                <label class="stext-102 cl3 m-b-5">Email Address</label>
                                <input type="email" class="form-control" value="jane.doe@example.com">
                            </div>
                            <div class="m-b-20">
                                <label class="stext-102 cl3 m-b-5">Phone Number</label>
                                <input type="tel" class="form-control" value="+1 (555) 019-2834">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>

                    <!-- Addresses Tab -->
                    <div class="tab-pane fade" id="addresses" role="tabpanel">
                        <h4 class="mtext-109 cl2 p-b-20">Saved Addresses</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="border p-3 rounded bg-light">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Default Shipping</strong>
                                        <span class="badge bg-primary">Default</span>
                                    </div>
                                    <p class="stext-111 mb-1">Jane Doe</p>
                                    <p class="stext-111 mb-1">742 Evergreen Terrace</p>
                                    <p class="stext-111 mb-1">Springfield, OR 97477</p>
                                    <p class="stext-111 text-muted">Phone: +1 555-019-2834</p>
                                    <button class="btn btn-sm btn-outline-secondary mt-2">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>