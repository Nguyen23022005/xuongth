<!-- filepath: c:\xampp\htdocs\XuongThucHanh\xuongth\mvc\view\comment\comment_list.php -->
<h1 class="mb-4 text-center text-primary">Comment Management</h1>

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
        <span class="fw-bold">Lessons and Comments</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-hover table-bordered align-middle">
                <thead class="bg-dark text-white">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lessons as $lesson): ?>
                        <tr>
                            <td><?= htmlspecialchars($lesson['id']) ?></td>
                            <td><?= htmlspecialchars($lesson['title']) ?></td>
                            <td class="text-center">
                                <a href="/comments/<?= $lesson['id'] ?>" class="btn btn-info btn-sm">
                                    View Comments
                                </a>
                                <a href="/comments/create/<?= $lesson['id'] ?>" class="btn btn-success btn-sm">
                                    Add Comment
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (!empty($lessonId)): ?>
    <h2 class="mt-5 text-center text-primary">Comments for Lesson ID: <?= htmlspecialchars($lessonId) ?></h2>
    <div class="card mt-3">
        <div class="card-header bg-secondary text-white d-flex align-items-center">
            <i class="fas fa-comments me-2"></i>
            <span class="fw-bold">Comments</span>
        </div>
        <div class="card-body">
            <?php if (!empty($comments)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="bg-dark text-white">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Content</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($comments as $comment): ?>
                                <tr>
                                    <td><?= htmlspecialchars($comment['id']) ?></td>
                                    <td><?= htmlspecialchars($comment['content']) ?></td>
                                    <td><?= htmlspecialchars($comment['user_id']) ?></td>
                                    <td><?= htmlspecialchars($comment['created_at']) ?></td>
                                    <td class="text-center">
                                        <a href="/comments/edit/<?= $comment['id'] ?>" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="/comments/delete/<?= $comment['id'] ?>" method="POST" style="display:inline;">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this comment?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-center text-muted">No comments available for this lesson.</p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>