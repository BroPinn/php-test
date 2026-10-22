<!-- Modal Shopping Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">Your Cart</span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full" id="header-cart-items">
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="<?= asset('images/product-01.jpg') ?>" alt="White Summer Shirt" style="width: 60px; height: 60px; object-fit: cover;">
                    </div>

                    <div class="header-cart-item-txt p-t-8 flex-grow-1">
                        <a href="<?= url('product') ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            White Summer Shirt
                        </a>

                        <div class="flex-w flex-sb-m">
                            <span class="header-cart-item-info">
                                1 x $45.00
                            </span>
                            <button class="btn-remove-header-cart cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                        </div>
                    </div>
                </li>

                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="<?= asset('images/product-02.jpg') ?>" alt="Slim Fit Denim Jeans" style="width: 60px; height: 60px; object-fit: cover;">
                    </div>

                    <div class="header-cart-item-txt p-t-8 flex-grow-1">
                        <a href="<?= url('product') ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            Slim Fit Denim Jeans
                        </a>

                        <div class="flex-w flex-sb-m">
                            <span class="header-cart-item-info">
                                1 x $78.00
                            </span>
                            <button class="btn-remove-header-cart cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
            
            <!-- Cart Summary -->
            <div id="cart-summary" class="w-full">
                <div class="header-cart-total w-full p-tb-40" id="header-cart-total">
                    Total: $123.00
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="<?= url('cart') ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>

                    <a href="<?= url('checkout') ?>" class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn1 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
