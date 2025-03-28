<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khóa học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Danh sách khóa học đã đăng ký</h2>
        <div class="row">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img src="<?= htmlspecialchars($course['image'] ?? 'default-image.jpg') ?>" class="card-img-top" alt="<?= htmlspecialchars($course['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($course['name']) ?></h5>
                                <p class="card-text">Mô tả: <?= htmlspecialchars($course['description'] ?? 'Không có mô tả') ?></p>
                                <p class="card-text">Giá: <?= htmlspecialchars($course['price'] )?> </p>

                                <a href="course_detail.php?id=<?= $course['id'] ?>" class="btn btn-primary">Tham gia học ngay</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Bạn chưa đăng ký khóa học nào.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
