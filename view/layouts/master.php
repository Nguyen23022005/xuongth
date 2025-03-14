<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "My App" ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Đảm bảo toàn bộ trang chiếm ít nhất 100vh */
        html,
        body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Nội dung chính sẽ mở rộng để đẩy footer xuống */
        main {
            flex: 1;
        }

        /* Header */
        .header-tier {
            background-color: #2c2f33;
            color: white;
            padding: 10px 0;
        }

        .logo-profile-tier {
            background-color: #000000;
            color: white;
        }

        /* Footer luôn ở dưới */
        footer {
            background-color: #212529;
            color: white;
            padding: 15px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-tier">
            <div class="container d-flex justify-content-between align-items-center">
                <div></div>
                <div>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <a href="/admin" class="btn btn-warning btn-sm">Admin Panel</a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="me-3">Welcome, <?= htmlspecialchars($_SESSION['user']['name']); ?></span>
                        <a href="/profile" class="btn btn-primary me-2">Tài khoản</a>
                        <a href="/logout" class="btn btn-danger btn-sm">Đăng Xuất</a>
                    <?php else: ?>
                        <a href="/login" class="btn btn-light btn-sm">Login</a>
                        <a href="/register" class="btn btn-light btn-sm">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="logo-profile-tier py-3">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <!-- <a href="/"><img src="/view/img/2.jpg" alt="Logo" class="img-fluid me-5" style="max-height: 100px;"></a> -->
                    <a href="/" class="btn btn-primary">Trang Chủ</a>
                </div>
                <div>
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="/orders/my_order/<?= $_SESSION['user']['id'] ?>" class="text-white me-3 btn btn-primary">Đơn Hàng</a>
                    <?php endif; ?>
                    <a href="/carts" class="text-white me-3 btn btn-primary"><i class="fa fa-shopping-cart"></i> Giỏ Hàng</a>
                </div>
            </div>
        </div>
    </header>

    <main class="container my-4">
        <?= $content ?>
    </main>

    <footer>
        <div class="container">
            <h1>LOL</h1>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>