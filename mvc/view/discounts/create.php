<h1>Create Category</h1>
<form method="POST">
    <div class="mb-3">
        <label for="code" class="form-label">code</label>
        <input type="text" class="form-control" id="code" name="code">
        <?php
        if (isset($errors['code'])) {
            echo "<span class='text-danger'>{$errors['code']}</span>";
        }
        ?>
    </div>
    <div class="mb-3">
        <label for="discount_value" class="form-label">discount_value</label>
        <input type="text" class="form-control" id="discount_value" name="discount_value">
        <?php
        if (isset($errors['discount_value'])) {
            echo "<span class='text-danger'>{$errors['discount_value']}</span>";
        }
        ?>
    </div>
    <div class="mb-3">
        <label for="usage_limit" class="form-label">usage_limit</label>
        <input type="text" class="form-control" id="usage_limit" name="usage_limit">
        <?php
        if (isset($errors['usage_limit'])) {
            echo "<span class='text-danger'>{$errors['usage_limit']}</span>";
        }
        ?>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">end_date</label>
        <input type="date" class="form-control" id="end_date" name="end_date">
        <?php
        if (isset($errors['end_date'])) {
            echo "<span class='text-danger'>{$errors['end_date']}</span>";
        }
        ?>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>