<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chi Tiết Bài Viết</title>
    <style>
        h2 {
            text-align: center;
            color: blue;
            font-size: 30px;


        }
    </style>
    
</head>

<body>
    <div class="container">
        <h2 >Tin Tức</h2>

        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php elseif (isset($blog) && is_array($blog)): ?>
            <div class="post">
                <h3><?php echo htmlspecialchars($blog['title'] ?? 'Không có tiêu đề'); ?></h3>
                <?php if (!empty($blog['image'])): ?>
                    <img src="<?php echo htmlspecialchars($blog['image']); ?>"
                        alt="Image for <?php echo htmlspecialchars($blog['title'] ?? ''); ?>"
                        width="100" height="100">
                <?php endif; ?>
                <div class="post-content">
                    <?php echo $blog['content']; // Render content as HTML 
                    ?>
                </div>
                <div class="post-meta">
                    <span>Tác giả: <?php echo htmlspecialchars($blog['author'] ?? 'Không rõ'); ?></span> |
                    <span>Ngày đăng: <?php echo date('d/m/Y', strtotime($blog['created_at'] ?? 'now')); ?></span>
                </div>
            </div>
        <?php else: ?>
            <p class="error">Không tìm thấy bài viết hoặc dữ liệu không hợp lệ.</p>
        <?php endif; ?>
    </div>
</body>

</html>