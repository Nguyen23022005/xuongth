<?php
$totalRevenue = 0;
$totalUser = 0;
$doanhthu = 0;
?>
<div class="container mt-5">
    <h4 class="mb-4 text-center">📅 Bộ Lọc Thống Kê Doanh Thu</h4>
    <form method="GET" action="" class="row g-3 align-items-end justify-content-center">

        <!-- Lọc theo ngày -->
        <div class="col-md-3">
            <label class="form-label">Từ ngày:</label>
            <input type="date" name="from_date" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">Đến ngày:</label>
            <input type="date" name="to_date" class="form-control">
        </div>

        <!-- Lọc theo loại thời gian -->
        <div class="col-md-3">
            <label class="form-label">Lọc theo:</label>
            <select name="filter_type" class="form-select">
                <option value="">-- Chọn kiểu lọc --</option>
                <option value="day">Ngày</option>
                <option value="week">Tuần</option>
                <option value="month">Tháng</option>
                <option value="year">Năm</option>
            </select>
        </div>

        <!-- Nút lọc -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Lọc ngay</button>
        </div>
    </form>
</div>

<div class="container mt-5">
    <h2 class="mb-4 text-center">📊 Thống Kê Doanh Thu Toàn Hệ Thống</h2>

    <?php if (!empty($subjects) && is_array($subjects)): ?>
        <div class="row text-center mb-4">
            <?php
            foreach ($subjects as $subject) {
                if ($subject['user_quantity'] !== 0 && $subject['user_id'] === $_SESSION['user']['id']) {
                    $totalRevenue += (int)$subject['price'] * (int)$subject['user_quantity'];
                    $totalUser += (int)$subject['user_quantity'];
                    $doanhthu = $totalRevenue;
                }
            }
            ?>
            <div class="col-md-6 mb-3">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-success">👨‍🎓 Tổng Lượt Người Học</h5>
                        <p class="card-text fs-4 fw-bold text-success">
                            <?= number_format($totalUser, 0, ',', '.') ?> lượt
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-warning shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-warning">💰 Tổng Doanh Thu</h5>
                        <p class="card-text fs-4 fw-bold text-warning">
                            <?= number_format($doanhthu, 0, ',', '.') ?> VNĐ
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách doanh thu từng khóa học -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white fw-bold">
                📚 Doanh Thu Theo Từng Khóa Học
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0 text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Tên Khóa Học</th>
                            <th>Lượt Người Học</th>
                            <th>Giá</th>
                            <th>Doanh Thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subjects as $subject): ?>
                            <?php if ($subject['user_quantity'] !== 0 && $subject['user_id'] === $_SESSION['user']['id']): ?>
                                <tr>
                                    <td><?= htmlspecialchars($subject['name']) ?></td>
                                    <td><?= number_format($subject['user_quantity'], 0, ',', '.') ?> lượt</td>
                                    <td><?= number_format($subject['price'], 0, ',', '.') ?> VNĐ</td>
                                    <td class="text-success fw-bold">
                                        <?= number_format($subject['price'] * $subject['user_quantity'], 0, ',', '.') ?> VNĐ
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-info text-center mt-4">
            Không có dữ liệu khóa học nào có người đăng ký.
        </div>
    <?php endif; ?>
</div>