<h1>Edit Subject</h1>
<h1 class="mb-4 text-center text-primary">Subject List</h1>

<a href="/subjects/create" class="btn btn-success mb-3">
    <i class="fas fa-plus-circle"></i> Create Subject
</a>

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
                        <th>Category</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>SKU</th>
                        <th>Status</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
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
                            <td class="text-center"><?= htmlspecialchars($subject['sku']) ?></td>
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
</div>


<h1 class="mb-4 text-center text-primary">DANH SÁCH BÀI HỌC</h1>
<a href="/lessons/create" class="btn btn-success mb-3"><i class="fas fa-plus-circle"></i> Bài Học Mới</a>
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
                    <?php foreach ($lessons as $lesson): if($lesson['subject_id']==$subject['id']){ ?> 
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
                                <a href="/lessons/edit/<?= $lesson['id'] ?>" class="btn btn-info btn-sm">show</a>
                            </td>
                        </tr>
                    <?php } endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>