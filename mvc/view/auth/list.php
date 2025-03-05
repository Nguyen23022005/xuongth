<h1>user List</h1>

<a href="/users/create" class="btn btn-primary mb-3">Create user</a>

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
        <?php foreach ($user as $users): ?>
        <tr>
            <td><?= $users['id'] ?></td>
            <td><?= $users['name'] ?></td>
            <td><?= $users['email'] ?></td>
            <td><?= $users['password'] ?></td>
            <td>
                <a href="/users/<?= $users['id'] ?>" class="btn btn-info btn-sm">View</a>
                <a href="/users/edit/<?= $users['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/users/delete/<?= $users['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>