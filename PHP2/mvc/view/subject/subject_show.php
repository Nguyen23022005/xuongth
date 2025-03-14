<?php if (!empty($subjectsByCategory)): ?>
    <div class="container mt-5">
        <?php foreach ($subjectsByCategory as $categoryName => $subjects): ?>
            <h2 class="text-center"><?= htmlspecialchars($categoryName) ?></h2>
            <br>
            <div class="row">
                <?php foreach ($subjects as $subject): ?>
                    <div class="col-md-3 mb-4"> <!-- Hiển thị tối đa 4 môn học mỗi hàng -->
                        <div class="card h-100"> <!-- Card có chiều cao bằng nhau -->
                            <?php
                            $subjectImage = !empty($subject['image']) ? htmlspecialchars($subject['image']) : 'path/to/default-image.jpg';
                            ?>
                            <img src="<?= $subjectImage ?>" alt="image" class="card-img-top" />
                            <div class="card-body d-flex flex-column">
                                <h3 class="card-name"><?= htmlspecialchars($subject['name']); ?></h3>
                                <p class="card-price"><?= number_format($subject['price'], 0); ?>đ</p>
                                <p class="card-text flex-grow-1"><?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?></p>
                                <a href="/subjects/<?= $subject['id'] ?>" class="btn btn-info btn-sm mb-2">Xem Chi Tiết</a>
                                <form action="/carts/add" method="post">
                                    <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="container mt-5">
        <p class="text-center">Không có môn học nào.</p>
    </div>
<?php endif; ?>
