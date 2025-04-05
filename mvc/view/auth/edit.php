<h1>Edit Product</h1>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <textarea class="form-control" id="email" name="email" rows="4"><?= $user['email'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="text" class="form-control" id="password" name="password" step="0.01" value="<?= $user['password'] ?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>