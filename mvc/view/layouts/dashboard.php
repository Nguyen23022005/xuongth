<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Bảng Quản Trị" ?></title>

    <!-- Bootstrap CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 260px;
            /* height: 100vh; */
            min-height: 500px;
            background: #ffffff;
            color: #212121;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #ddd;
        }

        .sidebar h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .sidebar hr {
            border-color: rgba(0, 0, 0, 0.2);
        }

        .sidebar a {
            color: #212121;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease-in-out;
            font-size: 16px;
            border-radius: 5px;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #f1f1f1;
            padding-left: 25px;
        }

        .sidebar a.text-danger {
            color: #e74c3c;
            font-weight: bold;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .sidebar a {
                font-size: 14px;
                padding: 10px 15px;
            }

            .sidebar a i {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>THÔNG TIN CÁ NHÂN</h4>
        <hr>
        <a href="/"><i class="fas fa-home"></i> Trang Chủ</a>
        <a href="/profile/edit/<?= $_SESSION['user']['id'] ?>"><i class="fas fa-chart-bar"></i>Hồ Sơ</a>
        <hr>
        <a href="/logout" class="text-danger"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>
    </div>

</body>

</html>
