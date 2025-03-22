<h1>Create Subject</h1>
<form method="POST" action="/tests/create">
    <div class="mb-3">
        <label for="title" class="form-label">title</label>
        <input type="text" class="form-control" id="title" name="title">
        <?php if (isset($errors['title'])): ?>
            <span class="text-danger"><?= $errors['title'] ?></span>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" id="lessons_id" name="lessons_id" value="<?= $lessons['id'] ?? '' ?>">
        <?php if (isset($errors['lessons_id'])): ?>
            <span class="text-danger"><?= $errors['lessons_id'] ?></span>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Bài Test Mới</button>
</form>
<br>
<br>
<h3 class="text-primary">DANH SÁCH BÀI KIỂM TRA</h3>
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
                        <th>Lessons_id</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tests as $test): if ($lessons['id'] == $test['lessons_id']) { ?>
                            <tr>
                                <td><?= htmlspecialchars($test['id']) ?></td>
                                <td><?= htmlspecialchars($test['lessons_id'] ?? 'No Subject') ?></td>
                                <td><?= htmlspecialchars($test['title']) ?></td>
                                <td>
                                    <a href="/lessons/edit/<?= $lessons['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="/lessons/delete/<?= $lessons['id']; ?>" method="POST" style="display:inline;">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this lesson?');">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="/questions/setup/<?= $test['id'] ?>" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> questions</a>
                                </td>
                            </tr>
                    <?php }
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>