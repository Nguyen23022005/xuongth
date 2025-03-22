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
            <h3 class="text-primary">DANH SÁCH BÀI HỌC</h3>
            <?php if (!empty($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?= $_SESSION['success_message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-table me-2"></i>
                    <span class="fw-bold">Category Management</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="table table-hover table-bordered align-middle">
                            <thead class="bg-dark text-white">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Subject</th>
                                    <th>Title</th>
                                    <th>Video</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
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
                            <a href="/lessons/create" class="btn btn-success mb-3"><i class="fas fa-plus-circle"></i> Bài Học Mới</a>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>