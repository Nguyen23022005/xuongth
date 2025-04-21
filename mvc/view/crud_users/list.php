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
        DANH SÁCH NGƯỜI DÙNG
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <a href="/users/create" class="btn btn-success mb-3">
                <i class="fas fa-plus-circle"></i> Người Dùng Mới 
            </a>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>email</th>
                    <th>Địa Chỉ</th>
                    <th>Vai Trò</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>email</th>
                    <th>Địa Chỉ</th>
                    <th>Vai Trò</th>
                    <th>Hành Động</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td class="text-center">
                            <img src="/uploads/<?= htmlspecialchars($user['image']) ?>" alt="image"
                                class="rounded shadow-sm" width="60" height="60">
                        </td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['diachi']) ?></td>
                        <td>
                            <?= htmlspecialchars($user['role'] === 'admin' ? 'Giảng viên' : ($user['role'] === 'user' ? 'Học viên' : 'Không xác định')) ?>
                        </td>


                        <td class="text-center">
                            <a href="/users/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="/users/delete/<?= $user['id']; ?>" method="POST"
                                style="display:inline;">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>