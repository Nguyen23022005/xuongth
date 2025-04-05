<title>Blog Cá Nhân</title>
<style>
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

  /* main1 Layout */
  .main1 {
    display: flex;
    max-width: 1000px;
    margin: 20px auto;
    padding: 0 20px;
  }

  /* Blog Container */
  .container {
    flex: 3;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(187, 13, 13, 0.1);
    border-radius: 10px;
    margin-right: 20px;
  }

  .post {
    margin-bottom: 30px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
  }

  .post h2 {
    color: #6a11cb;
  }

  .post p {
    color: #555;
  }

  /* Sidebar */
  .sidebar {
    flex: 1;
    background: #fff;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
  }

  .sidebar h3 {
    color: #6a11cb;
    margin-bottom: 10px;
  }

  .sidebar ul {
    list-style: none;
    padding: 0;
  }

  .sidebar ul li {
    margin-bottom: 10px;
  }

  .sidebar ul li a {
    text-decoration: none;
    color: #333;
    padding: 5px 10px;
    display: block;
    transition: 0.3s;
  }

  .sidebar ul li a:hover {
    background: #6a11cb;
    color: white;
    border-radius: 5px;
  }

  /* Footer */
  footer {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 15px;
    margin-top: 20px;
    border-radius: 10px;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .main1 {
      flex-direction: column;
    }

    .container {
      margin-right: 0;
      margin-bottom: 20px;
    }
  }
</style>
</head>

<body>
  <header class="hh">
    <h1>Blog Cá Nhân</h1>
    <p>Chia sẻ kiến thức và cuộc sống hàng ngày</p>
  </header>

  <div class="main1">
    <div class="container">
      <?php foreach ($blog as $post): ?>
        <div class="post">
          <h2><?= htmlspecialchars($post['title']) ?></h2>
          <p><?php if (!empty($post['image'])): ?>
              <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Image for <?php echo htmlspecialchars($post['title']); ?>" width="100" height="100">
            <?php endif; ?>
          </p>
        </div>

      <?php endforeach; ?>
    </div>
    <aside class="sidebar">
      <h3>Tin Tức Mới</h3>
      <?php foreach ($blog as $post): ?>
        <ul>
          <li><a href="/blogg/<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></li>

        </ul>
      <?php endforeach; ?>
    </aside>
  </div>
  <footer>
    <p>&copy; 2025 Blog Cá Nhân. Mọi quyền được bảo lưu.</p>
  </footer>