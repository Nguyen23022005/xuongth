
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Tạo Người Dùng Mới</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Tài khoản</label>
                    <input type="text" class="form-control <?= !empty($errors['name']) ? 'is-invalid' : '' ?>" name="name" id="name" placeholder="Nhập tên tài khoản" value="<?= htmlspecialchars($name ?? '') ?>">
                    <?php if (!empty($errors['name'])): ?>
                        <div class="invalid-feedback">
                            <?= htmlspecialchars($errors['name']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" name="email" id="email" placeholder="Nhập email" value="<?= htmlspecialchars($email ?? '') ?>">
                    <?php if (!empty($errors['email'])): ?>
                        <div class="invalid-feedback">
                            <?= htmlspecialchars($errors['email']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="Nhập mật khẩu" value="<?= htmlspecialchars($password ?? '') ?>">
                    <?php if (!empty($errors['password'])): ?>
                        <div class="invalid-feedback">
                            <?= htmlspecialchars($errors['password']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Vai trò</label>
                    <select name="role" id="role" class="form-select <?= !empty($errors['role']) ? 'is-invalid' : '' ?>">
                        <option value="user" <?= isset($_POST['role']) && $_POST['role'] === 'user' ? 'selected' : '' ?>>Học Viên</option>
                        <option value="admin" <?= isset($_POST['role']) && $_POST['role'] === 'admin' ? 'selected' : '' ?>>Giảng Viên</option>
                    </select>
                    <?php if (!empty($errors['role'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['role'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-success w-100">➕ Thêm Mới</button>
            </form>
        </div>
    </div>
</div>
