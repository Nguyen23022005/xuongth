<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Bài Viết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .post {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
        }
        .post h3 {
            margin: 0;
            font-size: 1.5em;
        }
        .post p {
            font-size: 1em;
            color: #555;
        }
        .post img {
            max-width: 100%;
            height: auto;
        }
        .post-meta {
            font-size: 0.9em;
            color: #777;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh Sách Bài Viết</h2>
        <a href="/blog/create" class="btn">Tạo bài viết mới</a>

        <?php if (empty($blog)) : ?>
            <p>Không có bài viết nào.</p>
        <?php else: ?>
            <?php foreach ($blog as $post): ?>
                <div class="post">
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <?php if (!empty($post['image'])): ?>
                        <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Image for <?php echo htmlspecialchars($post['title']); ?>">
                    <?php endif; ?>
                    <div class="post-content">
                        <?php echo $post['content']; // Render content as HTML ?>
                    </div>
                    <div class="post-meta">
                        <span>Tác giả: <?php echo htmlspecialchars($post['author']); ?></span> |
                        <span>Ngày đăng: <?php echo date('d/m/Y', strtotime($post['created_at'] ?? 'now')); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>