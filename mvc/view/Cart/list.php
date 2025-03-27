<h1 class="text-center my-4">Giỏ hàng</h1>

<?php if (empty($carts)): ?>
    <div class="text-center py-5">
        <img src="/img/empty-cart.png" alt="Empty Cart" class="img-fluid" style="max-width: 200px;">
        <h5 class="mt-3">Giỏ hàng của bạn đang trống</h5>
        <a href="/" class="btn btn-primary mt-3">Mua sắm ngay</a>
    </div>
<?php else: ?>
    <div class="container bg-white p-4 rounded shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Khóa học</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($carts as $cart): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= htmlspecialchars($cart['image']) ?>" alt="Subject" class="rounded me-2" style="width: 60px; height: 60px; object-fit: cover;">
                                <div>
                                    <strong><?= htmlspecialchars($cart['subject_name'] ?? 'Không xác định') ?></strong>
                                </div>
                            </div>
                        </td>
                        <td class="text-center text-danger fw-bold">
                            <?= number_format($cart['price'], 0) ?> VND
                        </td>
                        <?php $total += $cart['price']; ?>
                        <td class="text-center">
                            <a href="/carts/delete/<?= htmlspecialchars($cart['id']) ?>" class="btn btn-sm btn-outline-danger">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center border-top pt-3">
            <form action="/carts/clear" method="POST">
                <button type="submit" class="btn btn-danger">Xóa toàn bộ</button>
            </form>
            <div>
                <span class="fw-bold fs-5 me-3">Tổng cộng: <span class="text-danger"><?= number_format($total, 0) ?> VND</span></span>
                <a href="/checkout" class="btn btn-success">Thanh toán</a>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="/" class="btn btn-primary">Tiếp tục mua sắm</a>
    </div>
<?php endif; ?>
