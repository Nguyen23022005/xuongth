<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Bảng Quản Trị" ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #9d1c72;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #1864b0;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <?php
  
    $role = $_SESSION['user']['role'] ?? 'guest';
    ?>

    <?php if ($role === 'admin'): ?>
        <!-- Giao diện Admin -->
        <div class="sidebar">
            <h4 class="text-center">Bảng Quản Trị</h4>
            <hr>
            <a href="/">Trang Chủ</a>
            <a href="/users">Quản Lý Người Dùng</a>
            <a href="/categories">Quản Lý Danh Mục</a>
            <a href="/subjects">Quản Lý Môn Học</a>
            <a href="/lessons">Quản Lý Bài Học</a>
            <a href="/settings">Cài Đặt Hệ Thống</a>
            <hr>
            <a href="/logout" class="text-danger">Đăng Xuất</a>
        </div>
    <?php elseif ($role === 'quanly'): ?>
        <!-- Giao diện Quản Lý -->
        <div class="sidebar">
            <h4 class="text-center">Bảng Quản Lý</h4>
            <hr>
            <a href="/">Trang Chủ</a>
            <a href="/orders">Quản Lý Đơn Hàng</a>
            <a href="/products">Quản Lý Sản Phẩm</a>
            <hr>
            <a href="/logout" class="text-danger">Đăng Xuất</a>
        </div>
    <?php elseif ($role === 'user'): ?>
        <!-- Giao diện Người Dùng -->
        <div class="container mt-4">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="/">Trang Chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="/categories">Danh Mục</a>
                                </li>
                            </ul>
                            <div class="d-flex">
                                <span class="navbar-text me-3 text-dark">Chào, <?= htmlspecialchars($_SESSION['user']['name']); ?></span>
                                <a href="/logout" class="btn btn-outline-danger btn-sm">Đăng Xuất</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
    <?php endif; ?>

    <div class="content">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($_SESSION['message']); ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?= $content ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
