<br>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h3 class="">KHÓA HỌC</h3>
            <div class="card shadow-sm border-0">
                <img src="<?= htmlspecialchars($subjects['image']) ?>" alt="image" class="card-img-top rounded-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary"><?= htmlspecialchars($subjects['name']) ?></h5>
                    <p class="text-muted mb-2">SKU: <span class="fw-semibold"><?= htmlspecialchars($subjects['sku']) ?></span></p>
                    <p class="text-success fw-bold">$<?= htmlspecialchars(number_format($subjects['price'], 2)) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3 class="">DANH SÁCH BÀI HỌC</h3>
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
                        <a href="/lessons/create" class="btn btn-success mb-3"><i class="fas fa-plus-circle"></i> Bài Học Mới</a>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Khóa Học</th>
                                <th>Bài Học</th>
                                <th>Video</th>
                                <th>Tình Trạng</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Khóa Học</th>
                                <th>Bài Học</th>
                                <th>Video</th>
                                <th>Tình Trạng</th>
                                <th>Hành Động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($lessons as $lesson): if ($lesson['subject_id'] == $subjects['id']) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($lesson['id']) ?></td>
                                        <td><?= htmlspecialchars($lesson['subject_name'] ?? 'No Subject') ?></td>
                                        <td><?= htmlspecialchars($lesson['title']) ?></td>
                                        <td>
                                            <a href="<?= htmlspecialchars($lesson['video']) ?>" target="_blank">Watch Video</a>
                                        </td>
                                        <td><?= htmlspecialchars($lesson['status']) ?></td>
                                        <td>
                                            <a href="/lessons/edit/<?= $lesson['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="/lessons/delete/<?= $lesson['id']; ?>" method="POST" style="display:inline;">
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this lesson?');">
                                                    Delete
                                                </button>
                                            </form>
                                            <a href="/tests/setup/<?= $lesson['id'] ?>" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Test</a>
                                        </td>
                                    </tr>
                            <?php }
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>