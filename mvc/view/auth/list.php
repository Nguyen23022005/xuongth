<h1>user List</h1>

<a href="/auths/create" class="btn btn-primary mb-3">Create user</a>

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
            <th>Email</th>
            <th>password</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($auth as $auths): ?>
        <tr>
            <td><?= $auths['id'] ?></td>
            <td><?= $auths['name'] ?></td>
            <td><?= $auths['email'] ?></td>
            <td><?= $auths['password'] ?></td>
            <td>
                <a href="/auth/edit/<?= $auths['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/auth/delete/<?= $auths['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>