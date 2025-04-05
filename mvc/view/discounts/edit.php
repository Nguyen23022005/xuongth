<h1>Edit Category</h1>
<form method="POST">
    <div class="mb-3">
        <label for="code" class="form-label">code</label>
        <input type="text" class="form-control" id="code" name ="code" value="<?= $discount['code'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="discount_value" class="form-label">discount_value</label>
        <input type="text" class="form-control" id="discount_value" name ="discount_value" value="<?= $discount['discount_value'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="usage_limit" class="form-label">usage_limit</label>
        <input type="text" class="form-control" id="usage_limit" name ="usage_limit" value="<?= $discount['usage_limit'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">end_date</label>
        <input type="date" class="form-control" id="end_date" name ="end_date" value="<?= $discount['end_date'] ?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>