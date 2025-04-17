<title>Blog Cá Nhân</title>
<style>
  /* Reset CSS */

  /* Reset CSS */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
  }

  body {
    background-color: #f8f9fa;
    color: #333;
    line-height: 1.6;
  }

  /* Header */
  .hh {
    background: linear-gradient(to right, #6a11cb, #2575fc);
    color: #fff;
    text-align: center;
    padding: 20px 0;
    border-radius: 0 0 15px 15px;
  }

  nav a {
    color: white;
    margin: 0 15px;
    text-decoration: none;
    font-weight: bold;
    padding: 8px 12px;
    transition: 0.3s;
  }

  nav a:hover {
    background: #2575fc;
    border-radius: 5px;
  }

  /* Layout chính */
  .main1 {
    display: flex;
    max-width: 1000px;
    margin: 20px auto;
    padding: 0 20px;
    gap: 20px; /* Khoảng cách giữa content và sidebar */
  }

  .container {
    flex: 3;
  }

  .sidebar {
    flex: 1;
    background: #fff;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    height: fit-content;
  }

  /* Bài viết */
  .post {
    margin-bottom: 30px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
    display: flex;
    gap: 20px;
  }

  .post img {
    width: 100%;
    max-width: 250px;
    border-radius: 10px;
  }

  .post h2 {
    color: #6a11cb;
  }

  .post p {
    color: #555;
  }

  /* Sidebar */
  .sidebar h3 {
    color: #6a11cb;
    margin-bottom: 15px;
  }

  .sidebar ul {
    list-style: none;
    padding: 0;
  }

  .sidebar ul li {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }

  .sidebar ul li img {
    width: 80px;
    height: 50px;
    object-fit: cover;
    border-radius: 5px;
    margin-right: 10px;
  }

  .sidebar ul li a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
    transition: 0.3s;
  }

  .sidebar ul li a:hover {
    background: #6a11cb;
    color: white;
    padding: 2px 5px;
    border-radius: 5px;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .main1 {
      flex-direction: column;
    }

    .container {
      width: 100%;
      margin-bottom: 20px;
    }

    .sidebar {
      width: 100%;
      margin-top: 10px;
    }

    .post {
      flex-direction: column;
    }

    .post img {
      max-width: 100%;
    }
  
  }
</style>
</head>

<body>
  <header class="hh">
    <h1>Trang Tin Tức</h1>
    <p>Chia sẻ các khoá học kiến thức</p>
  </header>

  <div class="main1">
    <div class="container">

      <!-- FORM TÌM KIẾM -->
      <form method="get" action="" style="margin-bottom: 20px;">
        <input type="text" name="keyword" placeholder="Tìm kiếm bài viết..." value="<?= htmlspecialchars($keyword ?? '') ?>"
               style="padding: 8px; width: 70%; border: 1px solid #ccc; border-radius: 5px;">
        <button type="submit"
                style="padding: 8px 12px; background: #6a11cb; color: white; border: none; border-radius: 5px;">
          Tìm kiếm
        </button>
      </form>

      <!-- DANH SÁCH BÀI VIẾT -->
      <?php if (!empty($blog)): ?>
        <?php foreach ($blog as $post): ?>
          <div class="post" style="display: flex; margin-bottom: 30px;">
            <div style="flex: 1;">
              <?php if (!empty($post['image'])): ?>
                <img src="<?= htmlspecialchars($post['image']); ?>" alt="Image for <?= htmlspecialchars($post['title']); ?>" style="width: 100%; max-width: 250px; border-radius: 10px;">
              <?php endif; ?>
            </div>
            <div style="flex: 2; padding-left: 20px;">
              <h2><?= htmlspecialchars($post['title']) ?></h2>
              <p style="font-size: 14px; color: gray;">
                📅 <?= date('D d/m/Y', strtotime($post['created_at'])) ?> &nbsp; ⏱ 6 phút đọc
              </p>
              <a href="/blogg/<?= $post['id'] ?>" style="color: #6a11cb; font-weight: bold;">Đọc tiếp</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Không tìm thấy bài viết nào.</p>
      <?php endif; ?>

      <!-- PHÂN TRANG -->
      <?php if (!empty($totalPages) && $totalPages > 1): ?>
        <div style="text-align: center; margin-top: 30px;">
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?><?= $keyword ? '&keyword=' . urlencode($keyword) : '' ?>"
               style="margin: 0 5px; padding: 8px 12px; text-decoration: none; border-radius: 5px;
                      <?= $currentPage == $i ? 'background: #6a11cb; color: white; font-weight: bold;' : 'background: #eee; color: #333;' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- SIDEBAR -->
    <aside class="sidebar">
      <h3>Tin Mới Nhất</h3>
      <ul>
        <?php foreach ($blog as $post): ?>
          <li style="display: flex; margin-bottom: 15px;">
            <?php if (!empty($post['image'])): ?>
              <img src="<?= htmlspecialchars($post['image']); ?>" alt="Image for <?= htmlspecialchars($post['title']); ?>" style="width: 80px; height: 50px; object-fit: cover; border-radius: 5px; margin-right: 10px;">
            <?php endif; ?>
            <a href="/blogg/<?= $post['id'] ?>" style="flex: 1; font-size: 14px;"><?= htmlspecialchars($post['title']) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>
  </div>
