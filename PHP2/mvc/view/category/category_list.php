<h1>Category List</h1>
<a href="/categories/create" class="btn btn-primary mb-3">Create category</a>
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
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $category['id'] ?></td>
                <td><?= $category['name'] ?></td>
                <td>
                    <!-- <a href="/categories/<?= $category['id'] ?>" class="btn btn-info btn-sm">View</a> -->
                    <a href="/categories/edit/<?= $category['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <!-- <a href="/categories/delete/<?= $category['id'] ?>" class="btn btn-danger btn-sm">Delete</a> -->
                    <form action="/categories/delete/<?= $category['id']; ?>" method="POST" style="display:inline;">
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this category?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>