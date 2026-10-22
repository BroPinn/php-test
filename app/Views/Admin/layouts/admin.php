<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $page_title ?? 'OneStore Admin' ?></title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    
    <link rel="icon" type="image/png" href="<?= asset('images/icons/favicon.png') ?>"/>

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
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include __DIR__ . '/../components/sidebar.php'; ?>

        <div class="main-panel">
            <!-- Header -->
            <?php include __DIR__ . '/../components/header.php'; ?>

            <div class="container">
                <div class="page-inner">
                    <!-- Main Content -->
                    <?= $content ?>
                </div>
            </div>

            <!-- Footer -->
            <?php include __DIR__ . '/../components/footer.php'; ?>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/kaiadmin.min.js"></script>

    <!-- OneStore Admin Configuration -->
    <script>
        window.OneStoreAdmin = {
            baseUrl: '<?= url('') ?>',
            adminUrl: function(path) {
                const cleanPath = (path || '').replace(/^\//, '');
                return '<?= admin_url('') ?>' + cleanPath;
            },
            assetUrl: '<?= asset('') ?>'
        };
    </script>
</body>
</html>
