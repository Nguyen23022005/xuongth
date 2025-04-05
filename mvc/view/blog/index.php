<!-- <h1 class="mb-4 text-center text-primary">List blog</h1> -->
<a href="/blog/create" class="btn btn-success mb-3"><i class="fas fa-plus-circle"></i> Create blog</a>
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
        <span class="fw-bold">blog Management</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatablesSimple" class="table table-hover table-bordered align-middle">
                <thead class="bg-dark text-white" >
                    <tr class="text-center">
                        <th>ID</th>
                        <th>title</th>
                        <th>author</th>
                        <th>image</th>
                        <th>nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blog as $post): ?>
                        <tr>
                            <td><?= htmlspecialchars($post['id']) ?></td>
                            <td><?= htmlspecialchars($post['title']) ?></td>
                            <td><?= htmlspecialchars($post['author']) ?></td>
                            <td>
                                <?php if (!empty($post['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Image for <?php echo htmlspecialchars($post['title']); ?>" width="100" height="100">
                                <?php endif; ?>
                            </td>
                            <td>
                            <?php echo $post['content']; ?>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($post['created_at'] ?? 'now')); ?></td>
                            <td>
                                <a href="/blog/edit/<?= $post['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form action="/blog/delete/<?= $post['id']; ?>" method="POST" style="display:inline;">
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this post?');">
                                        Delete
                                    </button>
                                </form>
                                <a href="/blogg/<?= $post['id'] ?>" class="btn btn-info btn-sm">show</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>