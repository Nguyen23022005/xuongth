<div class="container mt-5">
    <h2 class="mb-4">Danh sách khóa học đã đăng ký</h2>
    
    <?php if (!empty($courses)): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($courses as $course): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($course['image'] ?? '/images/default-image.jpg') ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($course['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($course['name']) ?></h5>
                            <p class="card-text">
                                <?= htmlspecialchars($course['description'] ?? 'Không có mô tả') ?>
                            </p>
                            <p class="card-text">
                                <strong>Giá:</strong> <?= number_format($course['price'], 0, ',', '.') ?> VNĐ
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="course_detail.php?id=<?= htmlspecialchars($course['id']) ?>" 
                               class="btn btn-primary w-100">
                                Tham gia học ngay
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            Bạn chưa đăng ký khóa học nào.
        </div>
    <?php endif; ?>
</div>