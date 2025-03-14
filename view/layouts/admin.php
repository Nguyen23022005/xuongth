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
            overflow: auto;
        }

        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <!-- Sidebar dành cho Quản Trị -->
        <div class="sidebar">
            <h4 class="text-center">Bảng Quản Trị</h4>
            <hr>
            <a href="/">Trang Chủ</a>
            <a href="/admin">THỐNG KÊ</a>
            <a href="/auth">Quản Lý Người Dùng</a>
            <a href="/categories">Quản Lý Danh Mục</a>
            <a href="/subjects">Quản Lý Môn Học</a>
            <a href="/lessons">Quản Lý Bài Học</a>
            <hr>
            <a href="/logout" class="text-danger">Đăng Xuất</a>
        </div>

        <div class="content">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info" role="alert">
                    <?= htmlspecialchars($_SESSION['message']); ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <?= $content ?>
        </div>
    <?php else: ?>
        <!-- Nếu không phải admin, chuyển hướng hoặc thông báo lỗi -->
        <div class="container mt-4">
            <div class="alert alert-danger" role="alert">
                Bạn không có quyền truy cập vào trang này.
            </div>
        </div>
    <?php endif; ?>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>