<h1>Edit Subject</h1>
<form method="POST">
    <div class="form-group">
        <label for="category">Chọn danh mục</label>
        <select name="category_id" class="form-control" id="category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>" <?= $subject['category_id'] == $category['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($subject['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="text" class="form-control" id="image" name="image" value="<?= htmlspecialchars($subject['image']) ?>">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($subject['price']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" class="form-control" id="sku" name="sku" value="<?= htmlspecialchars($subject['sku']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <input type="text" class="form-control" id="status" name="status" value="<?= htmlspecialchars($subject['status']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($subject['description']) ?></textarea>
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
</form>