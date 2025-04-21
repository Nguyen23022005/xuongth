<h1>Create Category</h1>
<form action="" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">name</label>
        <input type="text" class="form-control" id="name" name="name">
        <?php
        if (isset($errors['name'])) {
            echo "<span class='text-danger'>{$errors['name']}</span>";
        }
        ?>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>