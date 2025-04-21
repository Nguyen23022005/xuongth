<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thanh Toán Môn Học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(to right, #f8f9fa, #e0eafc);
            color: #2c3e50;
        }

        .container {
            max-width: 1100px;
            margin: 60px auto;
        }

        .checkout-form {
            padding: 30px;
            border-radius: 16px;
            background: white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            animation: fadeIn 0.6s ease;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-checkout {
            background: linear-gradient(135deg, #5FCF80,rgb(8, 158, 53));
            border: none;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-checkout:hover {
            background: linear-gradient(135deg, rgb(8, 158, 53), #5FCF80);
        }

       
    </style>
</head>

<body>
    <br><br>
    <main class="main">
        <!-- Courses Course Details Section -->
        <section id="courses-course-details" class="courses-course-details section">

            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-8">
                        <img src="<?= htmlspecialchars($subject['image']); ?>" class="img-fluid" alt="">
                        <h3><?= htmlspecialchars($subject['name']); ?></h3>
                        <p class="text-muted"><?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?></p>
                    </div>
                    <div class="col-lg-4">

                        <div class="course-info d-flex justify-content-between align-items-center">
                            <h5>Tên Khóa Học</h5>
                            <p><a href="#" style="text-decoration: none;"><?= htmlspecialchars($subject['name']); ?></a></p>
                        </div>

                        <div class="course-info d-flex justify-content-between align-items-center">
                            <h5>Tổng Tiền</h5>
                            <p><?= number_format($subject['price'], 0) ?> VND</p>
                        </div>

                        <div class="course-info d-flex justify-content-between align-items-center">
                            <h5>Số Học Viên</h5>
                            <p><?= htmlspecialchars($subject['user_quantity']); ?></p>
                        </div>

                        <div class="course-info d-flex justify-content-between align-items-center">
                            <?php
                            $totalTests = 0;
                            foreach ($lessons as $lesson):
                                if ($lesson['subject_id'] === $subject['id']) {
                                    foreach ($tests as $test):
                                        if ($test['lessons_id'] === $lesson['id']) {
                                            $totalTests++;
                                            // Nếu bạn vẫn cần in input:
                                            // echo '<input type="hidden" name="test_id" value="' . htmlspecialchars($test['id']) . '">';
                                        }
                                    endforeach;
                                }
                            endforeach;
                            ?>
                            <form action="/carts/create" method="POST">
                                <input type="hidden" id="final_price_input" name="final_price" value="<?= $subject['price'] ?>">
                                <input type="hidden" name="subject_id" value="<?= htmlspecialchars($subject['id']) ?>">
                                <input type="hidden" name="number_test" value="<?= $totalTests ?>">
                                <input type="hidden" name="categories_id" value="<?= htmlspecialchars($subject['category_id']) ?>">
                                <input type="hidden" name="name" value="<?= htmlspecialchars($subject['name']) ?>">
                                <input type="hidden" name="image" value="<?= htmlspecialchars($subject['image']) ?>">
                                <input type="hidden" name="sku" value="<?= htmlspecialchars($subject['sku']) ?>">
                                <input type="hidden" name="description" value="<?= htmlspecialchars($subject['description']) ?>">

                                <div class="mb-4">
                                    <label for="pttt" class="form-label">Phương Thức Thanh Toán</label>
                                    <select name="pttt" id="pttt" class="form-select" required>
                                        <option value="cod">💵 COD - Thanh toán khi nhận hàng</option>
                                        <option value="vnpay">💳 VNPAY - Thanh toán trực tuyến</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-checkout w-100 py-2">
                                    <i class="bi bi-cash-stack me-2"></i>Tiến Hành Thanh Toán
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Courses Course Details Section -->
    </main>

</body>

</html>