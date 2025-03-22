<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách môn học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F1F1F1;
        }
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }
        .card-footer {
            background-color: white;
            border-top: 1px solid #eee;
            padding: 15px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (!empty($subjectsByCategory)): ?>
        <?php foreach ($subjectsByCategory as $categoryName => $subjects): ?>
            <br>
            <br>
            <h2 class="mb-4 border-bottom pb-2 fw-bold text-center">
                <?= htmlspecialchars($categoryName) ?>
            </h2>
            <div class="row g-4">
                <?php foreach ($subjects as $subject): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 md-4">
                        <a href="/subjects/<?= $subject['id'] ?>" class="text-decoration-none">
                            <div class="card h-100">
                                <?php
                                $subjectImage = !empty($subject['image']) ? htmlspecialchars($subject['image']) : 'https://via.placeholder.com/300x200';
                                ?>
                                <img src="<?= $subjectImage ?>" class="card-img-top" alt="image">
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        <?= htmlspecialchars($subject['name']); ?>
                                    </h5>
                                    <p class="text-muted fw-bold text-center">
                                        <?= number_format($subject['price'], 0); ?>đ
                                    </p>
                                    <p class="card-text text-secondary text-center">
                                        <?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?>
                                    </p>
                                </div>
                                <form action="/carts/add" method="post">
                                    <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-danger fs-4 fw-bold">Không có môn học nào.</p>
    <?php endif; ?>
</div>
</body>
</html>