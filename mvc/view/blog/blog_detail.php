<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi Tiết Bài Viết</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f4f6f8;
      color: #333;
      line-height: 1.6;
    }

    .hh {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      color: #fff;
      text-align: center;
      padding: 30px 15px;
      border-radius: 0 0 20px 20px;
    }

    .hh h1 {
      font-size: 36px;
      margin-bottom: 5px;
    }

    .container {
      max-width: 900px;
      margin: 30px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .post h3 {
      color: #6a11cb;
      font-size: 28px;
      margin-bottom: 15px;
      text-align: center;
    }

    .post img {
      display: block;
      max-width: 100%;
      height: auto;
      margin: 0 auto 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .post-content {
      font-size: 17px;
      color: #444;
      margin-bottom: 25px;
      line-height: 1.8;
    }

    .post-meta {
      font-size: 14px;
      color: #888;
      text-align: center;
      padding-top: 10px;
      border-top: 1px solid #ddd;
    }

    .error {
      background: #ffe5e5;
      color: #b00020;
      padding: 15px;
      border-radius: 8px;
      text-align: center;
      margin: 20px 0;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .container {
        padding: 20px;
      }

      .hh h1 {
        font-size: 28px;
      }

      .post h3 {
        font-size: 24px;
      }
    }
  </style>
</head>

<body>
  <header class="hh">
    <h1>Tin Tức</h1>
    <p>Chia sẻ thông tin và cảm hứng mỗi ngày</p>
  </header>

  <div class="container">
    <?php if (isset($errors) && !empty($errors)): ?>
      <div class="error">
        <?php foreach ($errors as $error): ?>
          <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php elseif (isset($blog) && is_array($blog)): ?>
      <div class="post">
        <h3><?= htmlspecialchars($blog['title'] ?? 'Không có tiêu đề') ?></h3>

        <?php if (!empty($blog['image'])): ?>
          <img src="<?= htmlspecialchars($blog['image']) ?>" alt="Ảnh bài viết: <?= htmlspecialchars($blog['title'] ?? '') ?>">
        <?php endif; ?>

        <div class="post-content">
          <?= $blog['content'] // Render nội dung HTML ?>
        </div>

        <div class="post-meta">
          <span>Tác giả: <?= htmlspecialchars($blog['author'] ?? 'Không rõ') ?></span> |
          <span>Ngày đăng: <?= date('d/m/Y', strtotime($blog['created_at'] ?? 'now')) ?></span>
        </div>
      </div>
    <?php else: ?>
      <p class="error">Không tìm thấy bài viết hoặc dữ liệu không hợp lệ.</p>
    <?php endif; ?>
  </div>
</body>

</html>
