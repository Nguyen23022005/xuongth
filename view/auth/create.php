<h1>Create user</h1>
<form action="" method="POST">
    <div>
        <label for="name">Tài khoản</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($name ?? '') ?>">
        <?php if (!empty($errors['name'])): ?>
            <p style="color: red;"><?= htmlspecialchars($errors['name']) ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="email">email</label>
        <textarea name="email" id="email"><?= htmlspecialchars($email ?? '') ?></textarea>
        <?php if (!empty($errors['email'])): ?>
            <p style="color: red;"><?= htmlspecialchars($errors['email']) ?></p>
        <?php endif; ?>
    </div>
    <div>
        <label for="password">password</label>
        <input type="text" name="password" id="password" value="<?= htmlspecialchars($password ?? '') ?>">
        <?php if (!empty($errors['password'])): ?>
            <p style="color: red;"><?= htmlspecialchars($errors['password']) ?></p>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
