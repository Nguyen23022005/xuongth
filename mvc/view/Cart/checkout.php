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
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4 border-bottom pb-2 fw-bold text-center">
            Checkout Subject
        </h2>
        <div class="row g-4">
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
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-8 col-sm-6 md-4">
                <h3 class="fs-4 fw-bold text-center">Thông tin đơn hàng</h3>

                <div class="mb-3">
                    <label for="price" class="form-label">Tổng Tiền</label>
                    <input type="text" class="form-control" id="total_price" value="<?= number_format($subject['price'], 0) ?>đ" readonly>
                </div>

                <!-- Nhập mã giảm giá -->
                <div class="mb-3">
                    <label for="discount_code" class="form-label">Mã Giảm Giá</label>
                    <input type="text" class="form-control" id="discount_code" placeholder="Nhập mã giảm giá">
                    <button type="button" class="btn btn-primary mt-2" onclick="applyDiscount()">Áp dụng</button>
                    <p class="text-danger mt-2" id="discount_message"></p>
                </div>

                <!-- Form thanh toán -->
                <form action="/carts/create" method="POST">
                    <input type="hidden" id="final_price_input" name="final_price" value="<?= $subject['price'] ?>">
                    <input type="hidden" name="subject_id" value="<?= htmlspecialchars($subject['id']) ?>">
                    <input type="hidden" name="categories_id" value="<?= htmlspecialchars($subject['category_id']) ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($subject['name']) ?>">
                    <input type="hidden" name="image" value="<?= htmlspecialchars($subject['image']) ?>">
                    <input type="hidden" name="sku" value="<?= htmlspecialchars($subject['sku']) ?>">
                    <input type="hidden" name="description" value="<?= htmlspecialchars($subject['description']) ?>">

                    <div class="mb-3">
                        <label for="pttt" class="form-label">Phương Thức Thanh Toán</label>
                        <select name="pttt" id="pttt" class="form-control" required>
                            <option value="cod">COD</option>
                            <option value="vnpay">VNPAY</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning">Checkout</button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function applyDiscount() {
            let discountCode = document.getElementById('discount_code').value.trim();
            let originalPrice = <?= $subject['price'] ?>;
            let discountAmount = 0;

            if (discountCode === "123456") {
                discountAmount = 100000;
                document.getElementById('discount_message').textContent = "Mã giảm giá hợp lệ! Bạn được giảm 100,000đ.";
                document.getElementById('discount_message').style.color = "blue";
            } else {
                document.getElementById('discount_message').textContent = "Mã giảm giá không hợp lệ!";
                document.getElementById('discount_message').style.color = "red";
            }

            let finalPrice = Math.max(0, originalPrice - discountAmount);
            document.getElementById('total_price').value = finalPrice.toLocaleString() + "đ";
            document.getElementById('final_price_input').value = finalPrice;
        }
    </script>

</body>

</html>