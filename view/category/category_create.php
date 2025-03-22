<h1>Create Category</h1>
<form action="" method="POST">
    <div class="mb-3">
        <label for="title" class="form-label">title</label>
        <input type="text" class="form-control" id="title" name="title">
        <?php
        if (isset($errors['title'])) {
            echo "<span class='text-danger'>{$errors['title']}</span>";
        }
        ?>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>