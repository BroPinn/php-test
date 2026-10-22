<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - OneStore</title>

    <link rel="icon" type="image/png" href="<?= asset('images/icons/favicon.png') ?>"/>

    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular", 
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/css/fonts.min.css"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/css/plugins.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/css/kaiadmin.min.css">
</head>
<body class="bg-light">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
        <div class="row justify-content-center w-100">
            <div class="col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <span class="btn btn-primary btn-icon btn-round btn-lg disabled shadow-sm">
                                    <i class="fas fa-shield-alt fa-2x"></i>
                                </span>
                            </div>
                            <h2 class="fw-bold mb-1">OneStore Admin</h2>
                            <p class="text-muted mb-0">Sign in to access store administration</p>
                        </div>

                        <?php if (!empty($_SESSION['auth_error'])): ?>
                            <div class="alert alert-danger py-2 small mb-4" role="alert">
                                <i class="fas fa-exclamation-circle me-1"></i> <?= htmlspecialchars($_SESSION['auth_error']) ?>
                            </div>
                            <?php unset($_SESSION['auth_error']); ?>
                        <?php endif; ?>

                        <form action="<?= admin_url('login') ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password" class="form-label mb-0">Password</label>
                                    <a href="#" class="small text-decoration-none">Forgot password?</a>
                                </div>
                                <div class="input-group mt-1">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                </div>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Keep me logged in</label>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Sign In to Dashboard
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="<?= url('') ?>" class="text-muted small text-decoration-none">
                                    <i class="fas fa-arrow-left me-1"></i>Back to Storefront
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
