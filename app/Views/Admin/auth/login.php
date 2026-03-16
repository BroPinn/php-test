<?php use App\Helpers\Helper; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Login - OneStore' ?></title>

    <link rel="icon" type="image/png" href="<?= Helper::asset('images/icons/favicon.png') ?>"/>

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
                                <span class="btn btn-primary btn-icon btn-round btn-lg disabled">
                                    <i class="fas fa-shield-alt"></i>
                                </span>
                            </div>
                            <h2 class="fw-bold mb-1">OneStore Admin</h2>
                            <p class="text-muted mb-0">Sign in to access the dashboard</p>
                        </div>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($success) ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= Helper::adminUrl('login') ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="username"
                                        name="username"
                                        placeholder="Enter your username"
                                        required
                                        autocomplete="username"
                                    >
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="password"
                                        name="password"
                                        placeholder="Enter your password"
                                        required
                                        autocomplete="current-password"
                                    >
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/core/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BroPinn/cdn-file@main/admin/js/kaiadmin.min.js"></script>
</body>
</html>
