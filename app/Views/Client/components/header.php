<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard orders over $100
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="<?= url('about') ?>" class="flex-c-m trans-04 p-lr-25">
                        Help & FAQs
                    </a>

                    <a href="<?= url('account') ?>" class="flex-c-m trans-04 p-lr-25">
                        My Account
                    </a>

                    <a href="<?= url('login') ?>" class="flex-c-m trans-04 p-lr-25">
                        Sign In
                    </a>

                    <a href="<?= admin_url('') ?>" class="flex-c-m trans-04 p-lr-25 text-warning font-weight-bold">
                        <i class="fa fa-lock m-r-5"></i> Admin
                    </a>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                
                <!-- Logo desktop -->		
                <a href="<?= url('') ?>" class="logo">
                    <img src="<?= asset('images/icons/logo-01.png') ?>" alt="OneStore">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="<?= url('') ?>">Home</a>
                        </li>

                        <li>
                            <a href="<?= url('shop') ?>">Shop</a>
                        </li>

                        <li class="label1" data-label1="hot">
                            <a href="<?= url('checkout') ?>">Checkout</a>
                        </li>

                        <li>
                            <a href="<?= url('blog') ?>">Blog</a>
                        </li>

                        <li>
                            <a href="<?= url('about') ?>">About</a>
                        </li>

                        <li>
                            <a href="<?= url('contact') ?>">Contact</a>
                        </li>
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="<?= url('account') ?>" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="1">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <div class="logo-mobile">
            <a href="<?= url('') ?>"><img src="<?= asset('images/icons/logo-01.png') ?>" alt="OneStore"></a>
        </div>

        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="<?= url('account') ?>" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="1">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard orders over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="<?= url('account') ?>" class="flex-c-m p-lr-10 trans-04">My Account</a>
                    <a href="<?= url('login') ?>" class="flex-c-m p-lr-10 trans-04">Sign In</a>
                    <a href="<?= admin_url('') ?>" class="flex-c-m p-lr-10 trans-04 text-warning">Admin</a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li><a href="<?= url('') ?>">Home</a></li>
            <li><a href="<?= url('shop') ?>">Shop</a></li>
            <li><a href="<?= url('checkout') ?>" class="label1 rs1" data-label1="hot">Checkout</a></li>
            <li><a href="<?= url('blog') ?>">Blog</a></li>
            <li><a href="<?= url('about') ?>">About</a></li>
            <li><a href="<?= url('contact') ?>">Contact</a></li>
        </ul>
    </div>
</header>
