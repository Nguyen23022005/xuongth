<style>
    .course-item:hover {
        transform: translateY(-10px);
        transition: transform 0.3s ease-in-out;
    }

    .pagination .page-item.active .page-link {
        background-color: white;
        border: #5FCF80 solid 2px !important;
        color: #5FCF80;
    }

    .page-link {
        color: #5FCF80;
    }

    .btn_2 {
        background-color: #5FCF80;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
        text-decoration: none;
    }

    .btn_2:hover {
        background-color: white;
        color: #5FCF80;
        border: #5FCF80 solid 2px;
    }

    .trainer-rank {
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        color: #5FCF80;
    }

    .progress {
        height: 10px;
        border-radius: 10px;
        overflow: hidden;
        background-color: #e9ecef;
    }

    .progress-bar-custom {
        background-color: #5FCF80;
        transition: width 0.6s ease;
    }
</style>

<body>
    <section id="courses">
        <div class="container" data-aos="fade-up">
            <div class="section-title mb-4">
                <h2 class="fw-bold">Các Khóa Học Đã Tham Gia</h2>
                <p class="text-muted">Danh sách khóa học đã đăng ký</p>
            </div>

            <div class="row g-4">
                <?php foreach ($courses as $course): ?>
                    <?php foreach ($progresses as $progress): ?>
                        <?php 
                            if ($progress['subject_id'] === $course['id'] && $course['user_id'] === $progress['user_id']): 
                                $submit = (int)$progress['number_submit'];
                                $total = (int)$progress['number_test'];
                                $percent = ($total > 0) ? round(($submit / $total) * 100, 2) : 0;
                        ?>
                            <div class="col-lg-3 col-md-6 course-item">
                                <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-delay="100">
                                    <a href="/subjects/<?= $course['id'] ?>" class="text-decoration-none">
                                        <div class="image-container" style="height: 200px; overflow: hidden;">
                                            <img src="<?= !empty($course['image']) ? htmlspecialchars($course['image']) : 'https://via.placeholder.com/300x200' ?>" class="card-img-top rounded" alt="image" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title text-center">
                                            <?= htmlspecialchars($course['name']); ?>
                                        </h5>
                                        <p class="card-text text-muted text-center"><?= htmlspecialchars($course['description'] ?? 'Không có mô tả.'); ?></p>
                                        <div class="trainer-rank">
                                            <i class="bi bi-person user-icon"></i>&nbsp;<?= $course['user_quantity'] ?> Học Viên
                                        </div>
                                        <br>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-custom" style="width: <?= $percent ?>%;"></div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
            <br>
        </div>
    </section>
</body>
