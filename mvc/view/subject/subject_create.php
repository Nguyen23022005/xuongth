<h1>Create Subject</h1>
<form method="POST">
    <div class="mb-3">
        <label for="category" class="form-label">Chọn danh mục</label>
        <select name="category_id" class="form-control" id="category">
            <option value="">Chọn danh mục</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>"
                    <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['category_id'])): ?>
            <span class="text-danger"><?= $errors['category_id'] ?></span>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $_POST['name'] ?? '' ?>">
        <?php if (isset($errors['name'])): ?>
            <span class="text-danger"><?= $errors['name'] ?></span>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="text" class="form-control" id="image" name="image" value="<?= $_POST['image'] ?? '' ?>">
        <?php if (isset($errors['image'])): ?>
            <span class="text-danger"><?= $errors['image'] ?></span>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= $_POST['price'] ?? '' ?>" step="0.01">
        <?php if (isset($errors['price'])): ?>
            <span class="text-danger"><?= $errors['price'] ?></span>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" class="form-control" id="sku" name="sku" value="<?= $_POST['sku'] ?? '' ?>">
        <?php if (isset($errors['sku'])): ?>
            <span class="text-danger"><?= $errors['sku'] ?></span>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <input type="text" class="form-control" id="status" name="status" value="<?= $_POST['status'] ?? 'active' ?>">
        <?php if (isset($errors['status'])): ?>
            <span class="text-danger"><?= $errors['status'] ?></span>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= $_POST['description'] ?? '' ?></textarea>
        <?php if (isset($errors['description'])): ?>
            <span class="text-danger"><?= $errors['description'] ?></span>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-success">Create</button>
</form>
