<h1>BÀI KIỂM TRA MỚI</h1>
<form method="POST" action="/tests/create">
    <div class="mb-3">
        <label for="title" class="form-label">title</label>
        <input type="text" class="form-control" id="title" name="title">
        <?php if (isset($errors['title'])): ?>
            <span class="text-danger"><?= $errors['title'] ?></span>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" id="lessons_id" name="lessons_id" value="<?= $lessons['id'] ?? '' ?>">
        <?php if (isset($errors['lessons_id'])): ?>
            <span class="text-danger"><?= $errors['lessons_id'] ?></span>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Tạo Mới</button>
</form>
