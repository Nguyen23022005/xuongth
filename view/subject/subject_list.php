<h1>Subject List</h1>
<a href="/subjects/create" class="btn btn-primary mb-3">Create Subject</a>

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
            <th>Category</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>SKU</th>
            <th>Status</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($subjects as $subject): ?>
            <tr>
                <td><?= htmlspecialchars($subject['id']) ?></td>
                <td><?= htmlspecialchars($subject['category_name'] ?? 'No Category') ?></td>
                <td><?= htmlspecialchars($subject['name']) ?></td>
                <td><img src="<?= htmlspecialchars($subject['image']) ?>" alt="image" width="100" height="100" class="ml-3" /></td>
                <td><?= htmlspecialchars($subject['price']) ?></td>
                <td><?= htmlspecialchars($subject['sku']) ?></td>
                <td><?= htmlspecialchars($subject['status']) ?></td>
                <td><?= htmlspecialchars($subject['description']) ?></td>
                <td>
                    <a href="/subjects/<?= $subject['id'] ?>" class="btn btn-info btn-sm">View</a>
                    <a href="/subjects/edit/<?= $subject['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <form action="/subjects/delete/<?= $subject['id']; ?>" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this subject?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
