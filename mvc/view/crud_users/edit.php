
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark text-center">
            <h2 class="mb-0">Chỉnh Sửa Thông Tin</h2>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Tài khoản</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($auth['name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($auth['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Quyền</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="user" <?= $auth['role'] === 'user' ? 'selected' : '' ?>>Học Viên</option>
                        <option value="admin" <?= $auth['role'] === 'admin' ? 'selected' : '' ?>>Giảng Viên</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning w-100">💾 Cập Nhật</button>
            </form>
        </div>
    </div>
</div>
