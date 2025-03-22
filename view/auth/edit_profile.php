
<style>
    .container12 {
        max-width: 600px;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #0056b3;
    }
    .error {
        color: red;
        font-size: 14px;
    }
    .avatar-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-top: 10px;
    }
</style>

<div class="container12">
    <h1>Chỉnh sửa hồ sơ</h1>
    <?php if (isset($errors['general'])) : ?>
        <p class="error"><?= htmlspecialchars($errors['general']) ?></p>
    <?php endif; ?>

    <form method="POST" action="/profile/edit/<?= $profile['id'] ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($profile['name']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($profile['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($profile['phone'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu mới (để trống nếu không thay đổi):</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="image">Ảnh đại diện:</label>
            <?php if (!empty($profile['image'])) : ?>
                <img src="/<?= htmlspecialchars($profile['image']) ?>" alt="Avatar" class="avatar-preview">
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if (isset($errors['image'])) : ?>
                <p class="error"><?= htmlspecialchars($errors['image']) ?></p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn">Cập nhật</button>
    </form>
</div>

