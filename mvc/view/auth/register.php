<h1 class="text-center my-4">Register</h1>
<?php if (isset($errors['general'])): ?>
    <div class="alert alert-danger text-center" role="alert">
        <?= $errors['general'] ?>
    </div>
<?php endif; ?>

<div class="container">
    <form method="POST" class="w-50 mx-auto border p-4 rounded shadow">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
            <?php if (isset($errors['name'])): ?>
                <span class="text-danger"><?= $errors['name'] ?></span>
            <?php endif; ?>
        </div>
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
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="text-center mt-3">
        Already have an account? <a href="/login">Login</a>
    </p>
</div>