<?php use App\Helpers\Helper; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $page_title ?? 'OneStore Admin' ?></title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?= $csrf_token ?>">
    
    <link rel="icon" href="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular", 
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/css/plugins.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/css/kaiadmin.min.css">
    
    <!-- Additional CSS -->
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link href="<?= Helper::asset($css) ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <div class="wrapper">
        <!-- Flash Messages -->
        <?php if (!empty($flash_messages)): ?>
            <div class="flash-messages">
                <?php foreach ($flash_messages as $type => $message): ?>
                    <div class="alert alert-<?= $type === 'error' ? 'danger' : $type ?> alert-dismissible fade show">
                        <?= $message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Sidebar -->
        <?php include ROOT_PATH . '/app/Views/Admin/components/sidebar.php'; ?>

        <div class="main-panel">
            <!-- Header -->
            <?php include ROOT_PATH . '/app/Views/Admin/components/header.php'; ?>

            <div class="container">
                <div class="page-inner">
                    <!-- Main Content -->
                    <?= $content ?>
                </div>
            </div>

            <!-- Footer -->
            <?php include ROOT_PATH . '/app/Views/Admin/components/footer.php'; ?>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/kaiadmin.min.js"></script>

    <!-- Additional JS -->
    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <script src="<?= Helper::asset($js) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Inline Scripts -->
    <?php if (isset($inline_scripts)): ?>
        <script>
            <?= $inline_scripts ?>
        </script>
    <?php endif; ?>
</body>
</html> 