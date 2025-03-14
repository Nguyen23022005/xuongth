<h1>Edit Lesson</h1>
<form method="POST">
    <div class="mb-3">
        <label for="subject_id" class="form-label">Chọn Môn Học</label>
        <select name="subject_id" class="form-control" id="subject_id" required>
            <?php foreach ($subjects as $subject): ?>
                <option value="<?= htmlspecialchars($subject['id']) ?>"
                    <?= $lesson['subject_id'] == $subject['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($subject['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Tiêu Đề Bài Học</label>
        <input type="text" class="form-control" id="title" name="title"
               value="<?= htmlspecialchars($lesson['title']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="video" class="form-label">Video Link</label>
        <input type="text" class="form-control" id="video" name="video"
               value="<?= htmlspecialchars($lesson['video']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Trạng Thái Bài Học</label>
        <input type="text" class="form-control" id="status" name="status"
               value="<?= htmlspecialchars($lesson['status']) ?>" required>
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
</form>
