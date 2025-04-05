<!-- filepath: c:\xampp\htdocs\XuongThucHanh\xuongth\mvc\view\comment\comment_edit.php -->
<h1 class="mb-4 text-center text-primary">Edit Comment</h1>

<form action="/comments/edit/<?= htmlspecialchars($comment['id']) ?>" method="POST">
    <div class="mb-3">
        <label for="content" class="form-label">Comment Content</label>
        <textarea name="content" id="content" class="form-control" rows="5" required><?= htmlspecialchars($comment['content']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>