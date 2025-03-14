<h1>Create Lesson</h1>
<form method="POST">
    <!-- Chọn Môn Học -->
    <div class="form-group">
        <label for="subject_id">Chọn Môn Học</label>
        <select name="subject_id" class="form-control" id="subject_id">
            <option value="">Chọn Môn Học</option>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?= htmlspecialchars($subject['id']) ?>"
                    <?= (isset($_POST['subject_id']) && $_POST['subject_id'] == $subject['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($subject['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['subject_id'])): ?>
            <span class="text-danger"><?= $errors['subject_id'] ?></span>
        <?php endif; ?>
    </div>

    <!-- Nhập Tiêu Đề Bài Học -->
    <div class="form-group">
        <label for="title">Tiêu Đề Bài Học</label>
        <input type="text" name="title" class="form-control" id="title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
        <?php if (isset($errors['title'])): ?>
            <span class="text-danger"><?= $errors['title'] ?></span>
        <?php endif; ?>
    </div>

    <!-- Nhập URL Video -->
    <div class="form-group">
        <label for="video">URL Video</label>
        <input type="text" name="video" class="form-control" id="video" value="<?= htmlspecialchars($_POST['video'] ?? '') ?>">
        <?php if (isset($errors['video'])): ?>
            <span class="text-danger"><?= $errors['video'] ?></span>
        <?php endif; ?>
    </div>

    <!-- Nhập Trạng Thái -->
    <div class="form-group">
        <label for="status">Trạng Thái Bài Học</label>
        <input type="text" name="status" class="form-control" id="status" value="<?= htmlspecialchars($_POST['status'] ?? '') ?>">
        <?php if (isset($errors['status'])): ?>
            <span class="text-danger"><?= $errors['status'] ?></span>
        <?php endif; ?>
    </div>

    <!-- Nút Submit -->
    <button type="submit" class="btn btn-success">Tạo Bài Học</button>
</form>
