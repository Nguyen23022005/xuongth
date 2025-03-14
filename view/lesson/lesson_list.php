<h1>Lessons List</h1>
<a href="/lessons/create" class="btn btn-primary mb-3">Create Lesson</a>

<?php if (!empty($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Title</th>
            <th>Video</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($lessons as $lesson): ?>
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
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
