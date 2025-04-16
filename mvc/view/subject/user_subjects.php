<?php if (!empty($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <?= $_SESSION['success_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
    </div>
    <div class="card-body">
        <h2 class="mb-4 text-center">SỐ HỌC VIÊN</h2>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>Họ Tên</th>
                    <th>Ảnh</th>
                    <th>Tiến Độ</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Họ Tên</th>
                    <th>Ảnh</th>
                    <th>Tiến Độ</th>
                    <th>Hành Động</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($user_subjects as $user_subject): ?>
                    <?php if ($user_subject['subject_id'] == $subject['id']): ?>
                        <?php 
                            $userId = $user_subject['user_id'];
                            // Tìm user tương ứng
                            $user = array_filter($users, fn($u) => $u['id'] == $userId);
                            $user = reset($user);
                            
                            // Tìm progress tương ứng
                            $progress = array_filter($progresses, fn($p) => $p['user_id'] == $userId);
                            $progress = reset($progress);

                            if (!$user || !$progress) continue;

                            $percent = ($progress['number_test'] > 0) 
                                ? round(($progress['number_submit'] / $progress['number_test']) * 100, 2)
                                : 0;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td class="text-center">
                                <img src="/uploads/<?= htmlspecialchars($user['image']) ?>" alt="image"
                                    class="rounded shadow-sm" width="60" height="60">
                            </td>
                            <td class="text-center text-success fw-bold"><?= $percent ?>%</td>
                            <td class="text-center">
                                <a href="/subjects/<?= $subject['id'] ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
