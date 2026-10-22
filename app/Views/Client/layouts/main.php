<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_title ?? 'OneStore - Modern E-Commerce' ?></title>
    <meta name="description" content="OneStore - Your trusted online shopping destination">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= asset('images/icons/favicon.png') ?>"/>
    
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900">
    
    <!-- CSS Assets -->
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('fonts/iconic/css/material-design-iconic-font.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('fonts/linearicons-v1.0.0/icon-font.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/animate/animate.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/css-hamburgers/hamburgers.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/animsition/css/animsition.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/select2/select2.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/daterangepicker/daterangepicker.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/slick/slick.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/MagnificPopup/magnific-popup.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('vendor/perfect-scrollbar/perfect-scrollbar.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('css/util.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('css/main.css') ?>">
</head>
<body class="animsition">

    <!-- Header -->
    <?php include __DIR__ . '/../components/header.php'; ?>

    <!-- Cart Modal -->
    <?php include __DIR__ . '/../components/cart.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/../components/footer.php'; ?>

    <!-- Back to Top Button -->
    <?php include __DIR__ . '/../components/back-to-top.php'; ?>

    <!-- JavaScript Assets -->
    <script src="<?= asset('vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
    <script src="<?= asset('vendor/animsition/js/animsition.min.js') ?>"></script>
    <script src="<?= asset('vendor/bootstrap/js/popper.js') ?>"></script>
    <script src="<?= asset('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset('vendor/select2/select2.min.js') ?>"></script>
    <script>
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        });
    </script>
    <script src="<?= asset('vendor/daterangepicker/moment.min.js') ?>"></script>
    <script src="<?= asset('vendor/daterangepicker/daterangepicker.js') ?>"></script>
    <script src="<?= asset('vendor/slick/slick.min.js') ?>"></script>
    <script src="<?= asset('js/slick-custom.js') ?>"></script>
    <script src="<?= asset('vendor/parallax100/parallax100.js') ?>"></script>
    <script>
        if (typeof $.fn.parallax100 === 'function') {
            $('.parallax100').parallax100();
        }
    </script>
    <script src="<?= asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') ?>"></script>
    <script>
        $('.gallery-lb').each(function() {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: { enabled: true },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <script src="<?= asset('vendor/isotope/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= asset('vendor/sweetalert/sweetalert.min.js') ?>"></script>
    <script>
        $('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
            e.preventDefault();
            swal("Product", "is added to wishlist!", "success");
            $(this).addClass('js-addedwish-b2');
        });

        $('.js-addcart-detail').on('click', function(e){
            e.preventDefault();
            swal("Product", "is added to cart!", "success");
        });
    </script>
    <script src="<?= asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script>
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            });
        });
    </script>
    <script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
