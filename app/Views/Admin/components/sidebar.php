<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="<?= admin_url('dashboard') ?>" class="logo">
                <img src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/img/kaiadmin/logo_light.svg" 
                     alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item <?= is_admin_active('dashboard') ?>">
                    <a href="<?= admin_url('dashboard') ?>">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">E-Commerce</h4>
                </li>
                <li class="nav-item <?= is_admin_active('products') ?>">
                    <a href="<?= admin_url('products') ?>">
                        <i class="fa fa-box"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item <?= is_admin_active('categories') ?>">
                    <a href="<?= admin_url('categories') ?>">
                        <i class="fas fa-table"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item <?= is_admin_active('brands') ?>">
                    <a href="<?= admin_url('brands') ?>">
                        <i class="fa fa-tag"></i>
                        <p>Brands</p>
                    </a>
                </li>
                <li class="nav-item <?= is_admin_active('orders') ?>">
                    <a href="<?= admin_url('orders') ?>">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li class="nav-item <?= is_admin_active('customers') ?>">
                    <a href="<?= admin_url('customers') ?>">
                        <i class="fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Content</h4>
                </li>
                <li class="nav-item <?= is_admin_active('slider') ?>">
                    <a href="<?= admin_url('slider') ?>">
                        <i class="fas fa-th-list"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Store</h4>
                </li>
                <li class="nav-item">
                    <a href="<?= url('') ?>" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        <p>View Storefront</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= admin_url('login') ?>">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>