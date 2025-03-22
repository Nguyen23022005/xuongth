<!-- view/order/list.php -->
<div class="container">
    <h1>Danh sách đơn hàng</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <p>Chưa có đơn hàng nào.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tổng tiền</th>
                    <th>Ngày đặt</th>
                    <th>Sản phẩm</th>
                    <th>Giá từng sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo number_format($order['total_price'], 0, ',', '.'); ?> VNĐ</td>
                        <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                        <td><?php echo htmlspecialchars($order['subject_ids']); ?></td>
                        <td><?php echo htmlspecialchars($order['item_prices']); ?></td>
                        <td>
                            <?php echo $order['status'] === 'pending' ? 'Chưa hoàn thành' : 'Hoàn thành'; ?>
                        </td>
                        <td>
                            <!-- Form chỉnh sửa trạng thái -->

                            <!-- Nút mở form đánh giá -->
                            <?php if ($order['status'] === 'completed'): ?>
                                <button type="button" class="btn btn-sm btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#reviewModal<?php echo $order['id']; ?>">Đánh giá</button>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- Modal đánh giá -->
                    <div class="modal fade" id="reviewModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reviewModalLabel">Đánh giá đơn hàng #<?php echo $order['id']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="/orders/review/<?php echo $order['id']; ?>" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Điểm đánh giá (1-5):</label>
                                            <input type="number" name="rating" class="form-control" min="1" max="5" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="comment" class="form-label">Bình luận:</label>
                                            <textarea name="comment" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="/carts" class="btn btn-primary">Quay lại giỏ hàng</a>
</div>

<!-- Bootstrap JS (cần để modal hoạt động) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>