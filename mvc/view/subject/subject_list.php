<h1 class="mb-4 text-center">Danh Sách Khóa Học </h1>
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
        <table id="datatablesSimple">
            <a href="/subjects/create" class="btn btn-success mb-3">
                <i class="fas fa-plus-circle"></i> Khóa Học Mới
            </a>
            <thead>
                <tr>
                    <th>Danh Mục</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Tình Trạng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Danh Mục</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Tình Trạng</th>
                    <th>Hành Động</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($subjects as $subject): ?>
                    <tr>
                        <td><?= htmlspecialchars($subject['category_name'] ?? 'No Category') ?></td>
                        <td><?= htmlspecialchars($subject['name']) ?></td>
                        <td class="text-center">
                            <img src="<?= htmlspecialchars($subject['image']) ?>" alt="image"
                                class="rounded shadow-sm" width="60" height="60">
                        </td>
                        <td class="text-center text-success fw-bold">$<?= htmlspecialchars(number_format($subject['price'], 2)) ?></td>
                        <td class="text-center">
                            <?php if ($subject['status'] === 'Active'): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="/subjects/<?= $subject['id'] ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="/subjects/edit/<?= $subject['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/subjects/delete/<?= $subject['id']; ?>" method="POST"
                                style="display:inline;">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this subject?');">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="/subjects/detail/<?= $subject['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>