<!-- Bootstrap CSS (nếu chưa có) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .table td,
    .table th {
        vertical-align: middle;
        /* Căn giữa nội dung theo chiều dọc */
    }

    .table .content-column {
        white-space: nowrap;
        /* Ngăn xuống dòng */
        overflow: hidden;
        /* Ẩn nội dung dư thừa */
        text-overflow: ellipsis;
        /* Thêm dấu ... nếu nội dung bị cắt */
        max-width: 250px;
        /* Giới hạn chiều rộng cột nội dung */
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        /* Nút nhỏ gọn hơn */
        font-size: 0.875rem;
    }

    .btn-group .btn {
        margin-right: 5px;
        /* Khoảng cách giữa các nút */
    }

    .card {
        border-radius: 10px;
        /* Bo góc card */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Đổ bóng nhẹ */
    }

    .card-header {
        border-radius: 10px 10px 0 0;
        /* Bo góc trên của card-header */
    }

    .alert {
        border-radius: 8px;
        /* Bo góc cho alert */
    }
</style>

<div class="container mt-4">
    <!-- Nút tạo blog -->
    <div class="d-flex justify-content-end mb-3">
        <a href="/blog/create" class="btn btn-success btn-sm">
            <i class="fas fa-plus-circle me-1"></i> Create Blog
        </a>
    </div>

    <!-- Thông báo thành công -->
    <?php if (!empty($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= htmlspecialchars($_SESSION['success_message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <!-- Card chứa bảng -->
    <div class="card">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fas fa-table me-2"></i>
            <span class="fw-bold">Blog Management</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-hover table-bordered align-middle">
                    <thead class="bg-dark text-white">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($blog as $post): ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($post['id']) ?></td>
                                <td><?= htmlspecialchars($post['title']) ?></td>
                                <td><?= htmlspecialchars($post['author']) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($post['image'])): ?>
                                        <img src="<?= htmlspecialchars($post['image']); ?>"
                                            alt="Image for <?= htmlspecialchars($post['title']); ?>"
                                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                    <?php else: ?>
                                        <span class="text-muted">No image</span>
                                    <?php endif; ?>
                                </td>
                                <td class="content-column">
                                    <?php
                                    $content = strip_tags($post['content']); // Loại bỏ thẻ HTML
                                    echo htmlspecialchars(substr($content, 0, 100)) . (strlen($content) > 100 ? '...' : '');
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?= date('d/m/Y', strtotime($post['created_at'] ?? 'now')); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="/blog/edit/<?= $post['id'] ?>"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="/blog/delete/<?= $post['id']; ?>"
                                            method="POST"
                                            style="display:inline;">
                                            <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this post?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                        <a href="/blogg/<?= $post['id'] ?>"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Show
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>