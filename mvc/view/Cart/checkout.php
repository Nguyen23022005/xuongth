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

        .page-title {
            font-weight: 700;
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }

        .page-title::after {
            content: "";
            width: 80px;
            height: 4px;
            background: #667eea;
            display: block;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            background-color: white;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card-img-top {
            height: 260px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #222;
        }

        .card-price {
            font-size: 1.4rem;
            font-weight: bold;
            color: #e74c3c;
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
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-checkout:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
        }

        .discount-btn {
            background-color: #ff9800;
            font-weight: 600;
            border: none;
            color: white;
        }

        .discount-btn:hover {
            background-color: #fb8c00;
        }

        .text-price-label {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        @media (max-width: 767px) {
            .card-img-top {
                height: 180px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 🔄 Overlay Loading */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .spinner-container {
            text-align: center;
        }

        .spinner-container p {
            color: white;
            margin-top: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="page-title">🧾 Thanh Toán Môn Học</h2>
        <div class="row g-4 align-items-start">
            <!-- Thông tin khóa học -->
            <div class="col-md-6">
                <div class="card">
                    <img src="<?= htmlspecialchars($subject['image']); ?>" class="card-img-top" alt="Hình môn học">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($subject['name']); ?></h5>
                        <p class="card-price"><?= number_format($subject['price'], 0); ?>đ</p>
                        <p class="text-muted"><?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Form thanh toán -->
            <div class="col-md-6">
                <div class="checkout-form">
                    <h4 class="text-center mb-4 fw-bold text-primary"><i class="bi bi-bag-check-fill me-2"></i>Thông Tin Đơn Hàng</h4>

                    <div class="mb-3">
                        <label class="text-price-label">Tổng Tiền</label>
                        <input type="text" class="form-control" id="total_price" value="<?= number_format($subject['price'], 0) ?>đ" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="text-price-label">Mã Giảm Giá</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="discount_code" placeholder="Nhập mã giảm giá...">
                            <button class="btn discount-btn" type="button" onclick="applyDiscount()">
                                <i class="bi bi-percent"></i> Áp dụng
                            </button>
                        </div>
                        <p class="mt-2" id="discount_message"></p>
                    </div>
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

    <!-- 🔄 Overlay Loading -->
    <div id="loading-overlay">
        <div class="spinner-container">
            <div class="spinner-border text-light" role="status"></div>
            <p class="mt-3">Đang xử lý thanh toán...</p>
        </div>
    </div>

    <script>
        function applyDiscount() {
            let code = document.getElementById('discount_code').value.trim();
            let original = <?= $subject['price'] ?>;
            let message = document.getElementById('discount_message');
            let discount = 0;

            if (code === "123456") {
                discount = 100000;
                message.innerHTML = `<i class="bi bi-check-circle-fill me-1"></i> Mã hợp lệ! Giảm 100,000đ.`;
                message.style.color = "green";
            } else {
                message.innerHTML = `<i class="bi bi-x-circle-fill me-1"></i> Mã không hợp lệ.`;
                message.style.color = "red";
            }

            let final = Math.max(0, original - discount);
            document.getElementById('total_price').value = final.toLocaleString() + "đ";
            document.getElementById('final_price_input').value = final;
        }

        // 🌀 Show overlay loading khi submit form
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-checkout');
            btn.disabled = true;
            btn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status"></span>Đang xử lý...`;
            document.getElementById('loading-overlay').style.display = 'flex';
        });
    </script>
</body>

</html>