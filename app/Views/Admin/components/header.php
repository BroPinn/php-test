<!-- Main Header -->
<div class="main-header">
    <div class="main-header-logo">
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
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pe-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" placeholder="Search products, orders, customers..." class="form-control" />
                </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" 
                       aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </form>
                    </ul>
                </li>

                <!-- View Storefront Link -->
                <li class="nav-item topbar-icon">
                    <a class="nav-link" href="<?= url('') ?>" target="_blank" title="View Storefront">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </li>

                <!-- Notifications -->
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">4</span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">You have 4 new notifications</div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <a href="<?= admin_url('orders') ?>">
                                        <div class="notif-icon notif-primary">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">New order #ORD-7829 received</span>
                                            <span class="time">5 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="<?= admin_url('customers') ?>">
                                        <div class="notif-icon notif-success">
                                            <i class="fa fa-user-plus"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">New customer registered</span>
                                            <span class="time">15 minutes ago</span>
                                        </div>
                                    </a>
                                    <a href="<?= admin_url('products') ?>">
                                        <div class="notif-icon notif-warning">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">Product stock low alert</span>
                                            <span class="time">1 hour ago</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="<?= admin_url('orders') ?>">
                                See all notifications<i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User Profile -->
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/img/profile.jpg" 
                                 alt="Admin" class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold"><?= htmlspecialchars($_SESSION['admin']['name'] ?? 'Administrator') ?></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/img/profile.jpg" 
                                             alt="image profile" class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4><?= htmlspecialchars($_SESSION['admin']['name'] ?? 'Administrator') ?></h4>
                                        <p class="text-muted"><?= htmlspecialchars($_SESSION['admin']['email'] ?? 'admin@onestore.com') ?></p>
                                        <a href="<?= admin_url('dashboard') ?>" class="btn btn-xs btn-secondary btn-sm">Dashboard</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= admin_url('products') ?>">Manage Products</a>
                                <a class="dropdown-item" href="<?= admin_url('orders') ?>">Manage Orders</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= admin_url('logout') ?>">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>