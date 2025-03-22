<h1 class="text-center my-4">Thanh toán</h1>

<div class="container bg-white p-4 rounded shadow-sm">
    <h4>Thông tin đơn hàng</h4>
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Khóa học</th>
                <th class="text-center">Giá</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carts as $cart): ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="<?= htmlspecialchars($cart['image']) ?>" alt="Subject" class="rounded me-2" style="width: 60px; height: 60px; object-fit: cover;">
                            <strong><?= htmlspecialchars($cart['subject_name'] ?? 'Không xác định') ?></strong>
                        </div>
                    </td>
                    <td class="text-center text-danger fw-bold">
                        <?= number_format($cart['price'], 0) ?> VND
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center border-top pt-3">
        <span class="fw-bold fs-5">Tổng cộng: <span class="text-danger"><?= number_format($total_price, 0) ?> VND</span></span>
    </div>

    <form action="/checkout/process" method="POST" class="mt-4">
        <h4>Phương thức thanh toán</h4>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
            <label class="form-check-label" for="cod">
                Thanh toán khi nhận hàng (COD)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
            <label class="form-check-label" for="cod">
                Thanh toán online
            </label>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success btn-lg">Xác nhận đặt hàng</button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="/carts" class="btn btn-primary">Quay lại giỏ hàng</a>
    </div>
</div>