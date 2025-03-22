<h1 class="text-center my-4">Đặt hàng thành công</h1>

<div class="container bg-white p-4 rounded shadow-sm text-center">
    <img src="/img/nick.jpg" alt="Success" class="img-fluid mb-3" style="max-width: 150px;">
    <h4 class="text-success">Cảm ơn bạn đã đặt hàng!</h4>
    <p><?php echo htmlspecialchars($_SESSION['success'] ?? 'Đơn hàng của bạn đã được xử lý thành công.'); ?></p>
    
    <div class="mt-4">
        <a href="/" class="btn btn-primary me-2">Tiếp tục mua sắm</a>
        <!-- <a href="/orders" class="btn btn-outline-secondary">Xem lịch sử đơn hàng</a> -->
    </div>
</div>

<?php
// Clear the success message after displaying it
unset($_SESSION['success']);
?>