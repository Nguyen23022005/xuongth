<h1 class="text-center my-4">Login</h1>
<?php if (isset($errors['login'])): ?>
    <div class="alert alert-danger text-center" role="alert">
        <?= $errors['login'] ?>
    </div>
<?php endif; ?>
<div class="container">
    <form method="POST" class="w-50 mx-auto border p-4 rounded shadow">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            <?php if (isset($errors['email'])): ?>
                <span class="text-danger"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
            <?php if (isset($errors['password'])): ?>
                <span class="text-danger"><?= $errors['password'] ?></span>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <p class="text-center mt-3">
        Chưa có tài khoản? <a href="/register">Register</a>
    </p>
    <p class="text-center mt-2">
    <a href="/quenmatkhau">Quên mật khẩu?</a>
</p>
</div>