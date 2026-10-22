<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="<?= url('shop') ?>" class="stext-107 cl7 hov-cl1 trans-04">Women</a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= url('shop') ?>" class="stext-107 cl7 hov-cl1 trans-04">Men</a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= url('shop') ?>" class="stext-107 cl7 hov-cl1 trans-04">Shoes</a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= url('shop') ?>" class="stext-107 cl7 hov-cl1 trans-04">Watches</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Help & Links
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="<?= url('account') ?>" class="stext-107 cl7 hov-cl1 trans-04">My Account</a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= url('cart') ?>" class="stext-107 cl7 hov-cl1 trans-04">Shopping Cart</a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= url('checkout') ?>" class="stext-107 cl7 hov-cl1 trans-04">Checkout</a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= url('about') ?>" class="stext-107 cl7 hov-cl1 trans-04">About OneStore</a>
                    </li>
                    <li class="p-b-10">
                        <a href="<?= url('contact') ?>" class="stext-107 cl7 hov-cl1 trans-04">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    GET IN TOUCH
                </h4>

                <p class="stext-107 cl7 size-201">
                    Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
                </p>

                <div class="p-t-27">
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <form onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="email" name="email" placeholder="email@example.com" required>
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button type="submit" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <div class="flex-c-m flex-w p-b-18">
                <span class="m-all-1"><img src="<?= asset('images/icons/icon-pay-01.png') ?>" alt="ICON-PAY"></span>
                <span class="m-all-1"><img src="<?= asset('images/icons/icon-pay-02.png') ?>" alt="ICON-PAY"></span>
                <span class="m-all-1"><img src="<?= asset('images/icons/icon-pay-03.png') ?>" alt="ICON-PAY"></span>
                <span class="m-all-1"><img src="<?= asset('images/icons/icon-pay-04.png') ?>" alt="ICON-PAY"></span>
                <span class="m-all-1"><img src="<?= asset('images/icons/icon-pay-05.png') ?>" alt="ICON-PAY"></span>
            </div>

            <p class="stext-107 cl6 txt-center">
                Copyright &copy; <?= date('Y') ?> OneStore. All rights reserved.
            </p>
        </div>
    </div>
</footer>