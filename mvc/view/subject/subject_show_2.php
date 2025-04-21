<style>
  .course-item:hover {
    transform: translateY(-10px);
    transition: transform 0.3s ease-in-out;
  }

  .pagination .page-item.active .page-link {
    background-color: white;
    border: #5FCF80 solid 2px !important;
    color: #5FCF80;

  }

  .page-link {
    color: #5FCF80;
  }

  .btn_2 {
    background-color: #5FCF80;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    text-decoration: none;
  }

  .btn_2:hover {
    background-color: white;
    color: #5FCF80;
    border: #5FCF80 solid 2px;
  }
</style>
<section id="hero" class="hero section dark-background">
  <img src="/public/assets/img/hero-bg.jpg" alt="" data-aos="fade-in">
  <div class="container">
    <h2 data-aos="fade-up" data-aos-delay="100">Học Tập Hôm Nay ,<br>Dẫn Đầu Ngay Mai</h2>
    <p data-aos="fade-up" data-aos-delay="200">Chúng tôi là đội ngũ chuyên nghiệp chuyên cung cấp những khóa học chất lượng </p>
    <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
      <a href="/" class="btn-get-started">Bắt đầu</a>
    </div>
  </div>

</section><!-- /Hero Section -->
<!-- Counts Section -->
<section id="counts" class="section counts light-background">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100">
          <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"></span>
          <p>Học Viên</p>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100">
          <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1" class="purecounter"></span>
          <p>Khóa Học</p>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100">
          <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1" class="purecounter"></span>
          <p>Events</p>
        </div>
      </div><!-- End Stats Item -->

      <div class="col-lg-3 col-md-6">
        <div class="stats-item text-center w-100 h-100">
          <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
          <p>Trainers</p>
        </div>
      </div><!-- End Stats Item -->

    </div>

  </div>

</section><!-- /Counts Section -->

<!-- Features Section -->


<!-- Courses Section -->
<section id="courses">
  <div class="container" data-aos="fade-up">
    <!-- Section Title -->
    <div class="section-title mb-4">
      <h2 class="fw-bold">Khóa Học Phổ Biến</h2>
      <p class="text-muted">Chọn một khóa học phù hợp với bạn</p>
    </div>
    <?php if (empty($_SESSION['user'])) { ?>
      <div class="row g-4">
        <?php foreach ($subjects as $subject): ?>
          <div class="col-lg-4 col-md-6 course-item">
            <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-delay="100">
              <a href="/subjects/<?= $subject['id'] ?>" class="text-decoration-none">
                <div class="image-container" style="height: 200px; overflow: hidden;">
                  <img src="<?= !empty($subject['image']) ? htmlspecialchars($subject['image']) : 'https://via.placeholder.com/300x200' ?>" class="card-img-top rounded" alt="image" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
              </a>
              <div class="card-body">
                <h5 class="card-title">
                  <a href="/subjects/<?= $subject['id'] ?>" class="text-dark fw-bold" style="text-decoration: none;"> <?= htmlspecialchars($subject['name']); ?> </a>
                </h5>
                <p class="card-text text-muted"> <?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?> </p>
                <div class="trainer-rank d-flex align-items-center" style=" font-weight: bold;color: #5FCF80;">
                  <i class="bi bi-person user-icon"></i>&nbsp;<?= $subject['user_quantity'] ?>
                  &nbsp;&nbsp;
                </div>
                <br>
                <div class="d-flex justify-content-between align-items-center">
                  <a href="/carts/checkout/<?= $subject['id'] ?>" class="btn_2">Tham Gia Khóa Học</a>
                  <span class="text-secondary fw-bold"> <?= number_format($subject['price'], 0); ?> VND</span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php } else { ?>
      <div class="row g-4">
        <?php foreach ($subjects as $subject): ?>
          <div class="col-lg-4 col-md-6 course-item">
            <div class="card shadow-sm border-0" data-aos="zoom-in" data-aos-delay="100">
              <?php
              // Initialize a flag to check if the user has already registered for the course
              $isRegistered = false;
              $isCompleted = false;

              // Loop through user_subjects to check the registration status
              foreach ($user_subjects as $user_subject) {
                if ($subject['id'] === $user_subject['subject_id'] && $user_subject['user_id'] === $_SESSION['user']['id']) {
                  if ($user_subject['status'] === "Đã Tham Gia") {
                    $isCompleted = true;
                  } else {
                    $isRegistered = true;
                  }
                  break; // No need to continue checking once we find the user subject
                }
              }
              ?>

              <?php if ($isCompleted): ?>
                <a href="/subjects/<?= $subject['id'] ?>" class="text-decoration-none">
                  <div class="image-container" style="height: 200px; overflow: hidden;">
                    <img src="<?= !empty($subject['image']) ? htmlspecialchars($subject['image']) : 'https://via.placeholder.com/300x200' ?>" class="card-img-top rounded" alt="image" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                </a>
              <?php elseif ($isRegistered): ?>
                <a href="/subjects/register/<?= $subject['id'] ?>" class="text-decoration-none">
                  <div class="image-container" style="height: 200px; overflow: hidden;">
                    <img src="<?= !empty($subject['image']) ? htmlspecialchars($subject['image']) : 'https://via.placeholder.com/300x200' ?>" class="card-img-top rounded" alt="image" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                </a>
              <?php else: ?>
                <a href="/subjects/register/<?= $subject['id'] ?>" class="text-decoration-none">
                  <div class="image-container" style="height: 200px; overflow: hidden;">
                    <img src="<?= !empty($subject['image']) ? htmlspecialchars($subject['image']) : 'https://via.placeholder.com/300x200' ?>" class="card-img-top rounded" alt="image" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                </a>
              <?php endif; ?>

              <div class="card-body">
                <h5 class="card-title">
                  <a href="/subjects/<?= $subject['id'] ?>" class="text-dark fw-bold" style="text-decoration: none;"> <?= htmlspecialchars($subject['name']); ?> </a>
                </h5>
                <p class="card-text text-muted"> <?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?> </p>
                <div class="trainer-rank d-flex align-items-center" style=" font-weight: bold;color: #5FCF80;">
                  <i class="bi bi-person user-icon"></i>&nbsp;<?= $subject['user_quantity'] ?>
                  &nbsp;&nbsp;
                </div>
                <br>
                <div class="d-flex justify-content-between align-items-center">
                  <?php
                  $isRegistered = false;
                  $isCompleted = false;
                  foreach ($user_subjects as $user_subject) {
                    if ($subject['id'] === $user_subject['subject_id'] && $user_subject['user_id'] === $_SESSION['user']['id']) {
                      if ($user_subject['status'] === "Đã Tham Gia") {
                        $isCompleted = true;
                      } else {
                        $isRegistered = true;
                      }
                      break;
                    }
                  }

                  if ($isCompleted) {
                    echo '<a href="/subjects/' . $subject['id'] . '" class="btn_2">Xem Khóa Học</a>';
                  } elseif ($isRegistered) {
                    // If user is registered but not yet completed, show "Tham Gia Khóa Học"
                    echo '<a href="/carts/checkout/' . $subject['id'] . '" class="btn_2">Tiếp Tục Tham Gia</a>';
                  } else {
                    // If user has not registered yet, show "Tham Gia Khóa Học"
                    echo '<a href="/carts/checkout/' . $subject['id'] . '" class="btn_2">Tham Gia Khóa Học</a>';
                  }
                  ?>
                  <span class="text-secondary fw-bold"> <?= number_format($subject['price'], 0); ?> VND</span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php } ?>
    <br>
    <nav class="d-flex justify-content-center">
      <ul class="pagination">
        <li class="page-item <?= ($page > 1) ? '' : 'disabled' ?>">
          <a class="page-link" href="?page=<?= max(1, $page - 1) ?>">&laquo; </a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?= ($page < $totalPages) ? '' : 'disabled' ?>">
          <a class="page-link" href="?page=<?= min($totalPages, $page + 1) ?>"> &raquo;</a>
        </li>
      </ul>
    </nav>
  </div>
</section>

<section id="features" class="features section">

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="features-item">
          <i class="bi bi-eye" style="color: #ffbb2c;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Lorem Ipsum</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="features-item">
          <i class="bi bi-infinity" style="color: #5578ff;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Dolor Sitema</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="features-item">
          <i class="bi bi-mortarboard" style="color: #e80368;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Sed perspiciatis</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="400">
        <div class="features-item">
          <i class="bi bi-nut" style="color: #e361ff;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Magni Dolores</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="500">
        <div class="features-item">
          <i class="bi bi-shuffle" style="color: #47aeff;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Nemo Enim</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="600">
        <div class="features-item">
          <i class="bi bi-star" style="color: #ffa76e;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Eiusmod Tempor</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="700">
        <div class="features-item">
          <i class="bi bi-x-diamond" style="color: #11dbcf;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Midela Teren</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="800">
        <div class="features-item">
          <i class="bi bi-camera-video" style="color: #4233ff;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Pira Neve</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="900">
        <div class="features-item">
          <i class="bi bi-command" style="color: #b2904f;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Dirada Pack</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1000">
        <div class="features-item">
          <i class="bi bi-dribbble" style="color: #b20969;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Moton Ideal</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1100">
        <div class="features-item">
          <i class="bi bi-activity" style="color: #ff5828;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Verdo Park</a></h3>
        </div>
      </div><!-- End Feature Item -->

      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="1200">
        <div class="features-item">
          <i class="bi bi-brightness-high" style="color: #29cc61;"></i>
          <h3><a href="" class="stretched-link" style="text-decoration: none;">Flavor Nivelanda</a></h3>
        </div>
      </div><!-- End Feature Item -->

    </div>

  </div>

</section><!-- /Features Section -->