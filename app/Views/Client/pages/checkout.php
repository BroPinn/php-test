<!-- Checkout Page -->
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-b-30 p-lr-0-lg">
            <a href="<?= url('') ?>" class="stext-109 cl8 hov-cl1 trans-04">
                Home <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <a href="<?= url('cart') ?>" class="stext-109 cl8 hov-cl1 trans-04">
                Cart <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Checkout
            </span>
        </div>

        <form action="<?= url('order-confirmation') ?>" method="GET">
            <div class="row">
                <!-- Billing & Shipping Information -->
                <div class="col-lg-7 col-xl-7 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-20">
                            Billing Details
                        </h4>

                        <div class="row">
                            <div class="col-md-6 m-b-20">
                                <label class="stext-102 cl3 m-b-5">First Name *</label>
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full" type="text" name="first_name" value="Jane" required>
                            </div>
                            <div class="col-md-6 m-b-20">
                                <label class="stext-102 cl3 m-b-5">Last Name *</label>
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full" type="text" name="last_name" value="Doe" required>
                            </div>
                        </div>

                        <div class="m-b-20">
                            <label class="stext-102 cl3 m-b-5">Email Address *</label>
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full" type="email" name="email" value="jane.doe@example.com" required>
                        </div>

                        <div class="m-b-20">
                            <label class="stext-102 cl3 m-b-5">Phone Number *</label>
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full" type="tel" name="phone" value="+1 (555) 019-2834" required>
                        </div>

                        <div class="m-b-20">
                            <label class="stext-102 cl3 m-b-5">Street Address *</label>
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full m-b-10" type="text" name="address1" value="742 Evergreen Terrace" required>
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full" type="text" name="address2" placeholder="Apartment, suite, unit (optional)">
                        </div>

                        <div class="row">
                            <div class="col-md-5 m-b-20">
                                <label class="stext-102 cl3 m-b-5">Town / City *</label>
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full" type="text" name="city" value="Springfield" required>
                            </div>
                            <div class="col-md-4 m-b-20">
                                <label class="stext-102 cl3 m-b-5">State *</label>
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full" type="text" name="state" value="OR" required>
                            </div>
                            <div class="col-md-3 m-b-20">
                                <label class="stext-102 cl3 m-b-5">ZIP Code *</label>
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 w-full" type="text" name="zip" value="97477" required>
                            </div>
                        </div>

                        <div class="m-t-20 m-b-20">
                            <label class="stext-102 cl3 m-b-5">Order Notes (Optional)</label>
                            <textarea class="stext-104 cl2 plh4 bor13 p-lr-20 p-tb-10 w-full" rows="3" name="notes" placeholder="Notes about your order, e.g. special delivery instructions."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Order Summary & Payment -->
                <div class="col-lg-5 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 p-lr-15-sm bg6">
                        <h4 class="mtext-109 cl2 p-b-20">
                            Your Order
                        </h4>

                        <div class="flex-w flex-sb-m bor12 p-b-15">
                            <span class="stext-115 cl2 font-weight-bold">Product</span>
                            <span class="stext-115 cl2 font-weight-bold">Subtotal</span>
                        </div>

                        <div class="flex-w flex-sb-m p-t-15 p-b-10">
                            <span class="stext-111 cl6">White Summer Shirt × 1</span>
                            <span class="stext-111 cl6 font-weight-bold">$45.00</span>
                        </div>

                        <div class="flex-w flex-sb-m p-b-15 bor12">
                            <span class="stext-111 cl6">Slim Fit Denim Jeans × 1</span>
                            <span class="stext-111 cl6 font-weight-bold">$78.00</span>
                        </div>

                        <div class="flex-w flex-sb-m p-t-15 p-b-10">
                            <span class="stext-115 cl2">Cart Subtotal</span>
                            <span class="stext-115 cl2 font-weight-bold">$123.00</span>
                        </div>

                        <div class="flex-w flex-sb-m p-b-15 bor12">
                            <span class="stext-115 cl2">Shipping</span>
                            <span class="stext-115 cl2 font-weight-bold">$10.00</span>
                        </div>

                        <div class="flex-w flex-sb-m p-t-20 p-b-25 bor12">
                            <span class="mtext-101 cl2">Total</span>
                            <span class="mtext-110 cl2 font-weight-bold text-success">$133.00</span>
                        </div>

                        <!-- Payment Methods -->
                        <h5 class="mtext-108 cl2 p-t-25 p-b-15">
                            Payment Method
                        </h5>

                        <div class="m-b-15">
                            <div class="form-check m-b-10">
                                <input class="form-check-input" type="radio" name="payment_method" id="pay-cc" value="credit_card" checked>
                                <label class="form-check-label stext-102 cl3" for="pay-cc">
                                    <strong>Credit or Debit Card</strong>
                                    <p class="stext-111 cl6 m-t-4">Safe & secure online payment via Stripe/Mastercard/Visa.</p>
                                </label>
                            </div>

                            <div class="form-check m-b-10">
                                <input class="form-check-input" type="radio" name="payment_method" id="pay-paypal" value="paypal">
                                <label class="form-check-label stext-102 cl3" for="pay-paypal">
                                    <strong>PayPal Express</strong>
                                    <p class="stext-111 cl6 m-t-4">Pay via your PayPal account or linked cards.</p>
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="pay-cod" value="cod">
                                <label class="form-check-label stext-102 cl3" for="pay-cod">
                                    <strong>Cash on Delivery</strong>
                                    <p class="stext-111 cl6 m-t-4">Pay in cash when your order is delivered.</p>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer m-t-25 w-full">
                            Place Order ($133.00)
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
