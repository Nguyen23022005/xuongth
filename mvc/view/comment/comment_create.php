<!-- filepath: c:\xampp\htdocs\XuongThucHanh\xuongth\mvc\view\comment\comment_create.php -->
<h1 class="mb-4 text-center text-primary">Add Comment</h1>

<form action="/comments/create/<?= htmlspecialchars($lessonId) ?>" method="POST">
    <div class="mb-3">
        <label for="content" class="form-label">Comment Content</label>
        <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>