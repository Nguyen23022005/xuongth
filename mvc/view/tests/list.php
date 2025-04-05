<<<<<<< HEAD
<h1>BÀI KIỂM TRA MỚI</h1>
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
<br>
=======
>>>>>>> 577123a6da4391f258f4a0d57ee894809e7eb55e
<h3 class="">DANH SÁCH BÀI KIỂM TRA</h3>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
<<<<<<< HEAD
            <a href="/tests/create/<?= $lessons['id']; ?>" class="btn btn-success mb-3">
=======
            <a href="/tests/setup_create/<?= $lessons['id']; ?>" class="btn btn-success mb-3">
>>>>>>> 577123a6da4391f258f4a0d57ee894809e7eb55e
                <i class="fas fa-plus-circle"></i> Khóa Học Mới
            </a>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lessons_id</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Lessons_id</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
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