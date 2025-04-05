<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Môn Học</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.02);
        }
        .card img {
            height: 220px;
            object-fit: cover;
        }
        .checkout-form {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-checkout {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-checkout:hover {
            background: linear-gradient(135deg, #feb47b, #ff7e5f);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4 fw-bold">Thanh Toán Môn Học</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card">
                    <img src="<?= htmlspecialchars($subject['image']); ?>" class="card-img-top" alt="Hình ảnh môn học">
                    <div class="card-body text-center">
                        <h5 class="card-title"> <?= htmlspecialchars($subject['name']); ?> </h5>
                        <p class="fw-bold text-danger fs-4"> <?= number_format($subject['price'], 0); ?>đ </p>
                        <p class="text-secondary"> <?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="checkout-form">
                    <h4 class="text-center mb-3">Thông tin Đơn Hàng</h4>
                    <div class="mb-3">
                        <label class="form-label">Tổng Tiền</label>
                        <input type="text" class="form-control" id="total_price" value="<?= number_format($subject['price'], 0) ?>đ" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mã Giảm Giá</label>
                        <input type="text" class="form-control" id="discount_code" placeholder="Nhập mã giảm giá">
                        <button type="button" class="btn btn-primary mt-2 w-100" onclick="applyDiscount()">Áp dụng</button>
                        <p class="text-danger mt-2" id="discount_message"></p>
                    </div>
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

                    <button type="submit" class="btn btn-checkout w-100 py-2">Tiến hành thanh toán</button>
                </form>
                </div>
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
