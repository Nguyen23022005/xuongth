<?php 
    $totalRevenue = 0;
    $totalUser = 0;
    $totalprice = 0;
    $doanhthu = 0;
    $totalAdmin = 0;
?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">📊 Thống Kê Doanh Thu Toàn Hệ Thống</h2>

    <?php if (!empty($subjects) && is_array($subjects)): ?>
        <div class="row text-center mb-4">
            <?php 
                foreach ($subjects as $subject) {
                    if ($subject['user_quantity'] !== 0 ) {
                        $totalprice += ((int)$subject['price'] *20) / 100;
                        $totalRevenue += $totalprice * (int)$subject['user_quantity'];
                        $totalUser += (int)$subject['user_quantity'];
                        $doanhthu = $totalRevenue;
                    }
                }
                foreach ($users as $user) {
                    if ($user['role'] === 'admin' ) {
                        $totalAdmin ++ ;
                    }
                }
            ?>
            <div class="col-md-6 mb-3">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-success">👨‍🎓 Tổng Lượt Học Viên</h5>
                        <p class="card-text fs-4 fw-bold text-success">
                            <?= number_format($totalUser, 0, ',', '.') ?> lượt
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title text-success">👨‍🎓 Tổng Số Giảng Viên</h5>
                        <p class="card-text fs-4 fw-bold text-success">
                            <?= number_format($totalAdmin, 0, ',', '.') ?> 
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
    <?php endif; ?>
</div>


