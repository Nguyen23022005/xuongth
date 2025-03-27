<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "My App" ?></title>

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .footer {
            background: #343a40;
            color: white;
            padding: 20px 0;
        }

        .footer a {
            color: #ddd;
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }

    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-store"></i> HOCTAP
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Khóa Học</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Liên hệ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> Tài khoản
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile">Thông tin</a></li>
                            <li><a class="dropdown-item" href="/orders">Đơn hàng</a></li>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                <li><a class="dropdown-item" href="/admin">Trang Quản Trị</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <?php if (isset($_SESSION['user'])): ?>
                                <li><a class="dropdown-item text-danger" href="/logout">Đăng xuất <i class="fa-solid fa-right-to-bracket"></i></a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item text-primary" href="/login"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung trang -->
    <main class="container my-4">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Về chúng tôi</h5>
                    <p>YThanh Shop cung cấp giày thể thao chính hãng với chất lượng đảm bảo.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p><i class="fas fa-phone"></i> 0123 456 789</p>
                    <p><i class="fas fa-envelope"></i> admin@ythanh.shop</p>
                </div>
                <div class="col-md-4">
                    <h5>Kết nối với chúng tôi</h5>
                    <a href="#" class="me-2"><i class="fab fa-facebook fa-2x"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
                </div>
            </div>
            <hr>
            <p>© 2025 YThanh Shop. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
