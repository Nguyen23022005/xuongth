<!-- filepath: c:\xampp\htdocs\XuongThucHanh\xuongth\mvc\view\comment\comment_list_user.php -->
<h2>Bình luận</h2>

<div class="comment-list">
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <strong>Người dùng <?= htmlspecialchars($comment['user_id']) ?>:</strong>
                <p><?= htmlspecialchars($comment['content']) ?></p>
                <small>Ngày: <?= htmlspecialchars($comment['created_at']) ?></small>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Chưa có bình luận nào.</p>
    <?php endif; ?>
</div>

<?php if (isset($_SESSION['user_id'])): ?>
    <h3>Thêm bình luận</h3>
    <form action="/lessons/<?= $lessonId ?>/comments/create" method="POST">
        <textarea name="content" rows="5" placeholder="Nhập bình luận của bạn..." required></textarea><br>
        <button type="submit">Gửi bình luận</button>
    </form>
<?php else: ?>
    <p><a href="/login">Đăng nhập</a> để thêm bình luận.</p>
<?php endif; ?>