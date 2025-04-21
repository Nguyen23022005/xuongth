<?php
$step = isset($_POST['step']) ? $_POST['step'] : '1';
?>

<h1 class="text-center my-4">Register</h1>
<?php if (isset($errors['general'])): ?>
    <div class="alert alert-danger text-center" role="alert">
        <?= $errors['general'] ?>
    </div>
<?php endif; ?>

<div class="container">
    <form method="POST" class="w-50 mx-auto border p-4 rounded shadow">
        <input type="hidden" name="step" value="<?= $step ?>">

        <?php if ($step == '1'): ?>
            <!-- Step 1: Tên, email, mật khẩu -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name"
                       value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
                <?php if (isset($errors['name'])): ?>
                    <span class="text-danger"><?= $errors['name'] ?></span>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                       value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
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

            <button type="submit" name="step" value="2" class="btn btn-primary w-100">Tiếp theo</button>

        <?php elseif ($step == '2'): ?>
            <!-- Step 2: Chọn quyền -->
            <h4 class="mb-3">Chọn vai trò của bạn</h4>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role_user" value="user"
                        <?= (isset($_POST['role']) && $_POST['role'] === 'user') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="role_user">
                        <strong>Học viên:</strong> Có thể tham gia khoá học, xem nội dung bài giảng.
                    </label>
                </div>

                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="role" id="role_admin" value="admin"
                        <?= (isset($_POST['role']) && $_POST['role'] === 'admin') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="role_admin">
                        <strong>Giảng viên:</strong> Có thể tạo khoá học, quản lý học viên, tuy nhiên bạn sẽ phải chi 20% giá bán mỗi khóa học cho vai trò này .
                    </label>
                </div>

                <?php if (isset($errors['role'])): ?>
                    <span class="text-danger"><?= $errors['role'] ?></span>
                <?php endif; ?>
            </div>

            <!-- Hidden input để giữ dữ liệu bước 1 -->
            <input type="hidden" name="name" value="<?= htmlspecialchars($_POST['name']) ?>">
            <input type="hidden" name="email" value="<?= htmlspecialchars($_POST['email']) ?>">
            <input type="hidden" name="password" value="<?= htmlspecialchars($_POST['password']) ?>">

            <button type="submit" class="btn btn-success w-100">Hoàn tất đăng ký</button>
        <?php endif; ?>
    </form>

    <p class="text-center mt-3">
        Already have an account? <a href="/login">Login</a>
    </p>
</div>
