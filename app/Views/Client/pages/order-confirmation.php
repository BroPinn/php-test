<!-- Order Confirmation Page -->
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8 m-lr-auto p-b-80">
                <!-- Success Message -->
                <div class="text-center p-b-50">
                    <div class="p-b-20">
                        <i class="zmdi zmdi-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    <h3 class="mtext-111 cl2 p-b-16">Thank You for Your Order!</h3>
                    <p class="stext-113 cl6 p-b-20">
                        Your order has been received and is currently being processed. A confirmation email has been sent to your inbox.
                    </p>
                    <div class="bor10 p-lr-40 p-t-20 p-b-20 bg-light d-inline-block">
                        <span class="stext-113 cl2">
                            <strong>Order Number:</strong> <span class="text-primary font-weight-bold">#ORD-2025-89412</span>
                        </span>
                    </div>
                </div>

                <!-- Order Receipt Card -->
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-b-40 bg0">
                    <h4 class="mtext-109 cl2 p-b-30">Order Summary</h4>
                    
                    <div class="row p-b-25 bor12">
                        <div class="col-md-6 m-b-20">
                            <h6 class="stext-102 cl3 p-b-10 font-weight-bold">Order Information</h6>
                            <p class="stext-104 cl6 p-b-5"><strong>Date:</strong> <?= date('F j, Y') ?></p>
                            <p class="stext-104 cl6 p-b-5"><strong>Payment:</strong> Credit Card (ending in •••• 4242)</p>
                            <p class="stext-104 cl6"><strong>Status:</strong> <span class="badge badge-success p-2">Processing</span></p>
                        </div>
                        <div class="col-md-6 m-b-20">
                            <h6 class="stext-102 cl3 p-b-10 font-weight-bold">Shipping Address</h6>
                            <p class="stext-104 cl6 p-b-3">Jane Doe</p>
                            <p class="stext-104 cl6 p-b-3">742 Evergreen Terrace</p>
                            <p class="stext-104 cl6 p-b-3">Springfield, OR 97477</p>
                            <p class="stext-104 cl6">United States</p>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="p-t-30">
                        <h6 class="stext-102 cl3 p-b-15 font-weight-bold">Items Ordered</h6>
                        
                        <div class="flex-w flex-sb-m p-b-15 bor12">
                            <div class="flex-w flex-m">
                                <img src="<?= asset('images/product-01.jpg') ?>" alt="White Summer Shirt" style="width: 50px; height: 50px; object-fit: cover;" class="m-r-15">
                                <div>
                                    <h6 class="stext-104 cl2">White Summer Shirt</h6>
                                    <small class="text-muted">Size: M | Qty: 1</small>
                                </div>
                            </div>
                            <span class="stext-105 cl3 font-weight-bold">$45.00</span>
                        </div>

                        <div class="flex-w flex-sb-m p-t-15 p-b-15 bor12">
                            <div class="flex-w flex-m">
                                <img src="<?= asset('images/product-02.jpg') ?>" alt="Slim Fit Denim Jeans" style="width: 50px; height: 50px; object-fit: cover;" class="m-r-15">
                                <div>
                                    <h6 class="stext-104 cl2">Slim Fit Denim Jeans</h6>
                                    <small class="text-muted">Size: 32 | Qty: 1</small>
                                </div>
                            </div>
                            <span class="stext-105 cl3 font-weight-bold">$78.00</span>
                        </div>

                        <div class="flex-w flex-sb-m p-t-20 p-b-10">
                            <span class="stext-115 cl2">Subtotal</span>
                            <span class="stext-115 cl2 font-weight-bold">$123.00</span>
                        </div>

                        <div class="flex-w flex-sb-m p-b-10">
                            <span class="stext-115 cl2">Shipping</span>
                            <span class="stext-115 cl2 font-weight-bold">$10.00</span>
                        </div>

                        <div class="flex-w flex-sb-m p-t-15 p-b-10 bor12">
                            <span class="mtext-101 cl2">Total Paid</span>
                            <span class="mtext-110 cl2 font-weight-bold text-success">$133.00</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Action Buttons -->
                <div class="text-center">
                    <a href="<?= url('shop') ?>" class="btn btn-primary btn-lg m-r-10 m-b-10">
                        Continue Shopping
                    </a>
                    <a href="<?= url('account') ?>" class="btn btn-outline-secondary btn-lg m-b-10">
                        View Order in Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
