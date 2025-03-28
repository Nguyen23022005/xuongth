<h3 class="">DANH SÁCH BÀI KIỂM TRA</h3>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <a href="/tests/setup_create/<?= $lessons['id']; ?>" class="btn btn-success mb-3">
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