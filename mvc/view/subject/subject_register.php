<style>
    .course-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .course-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 20px;
    }

    .card-title a {
        color: #333;
        font-size: 1.25rem;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .card-title a:hover {
        color: #5FCF80;
    }

    .card-text {
        color: #777;
        font-size: 1rem;
        line-height: 1.5;
    }

    .trainer-rank {
        color: #5FCF80;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .price-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .price {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }

    .btn_2 {
        background-color: #5FCF80;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn_2:hover {
        background-color: white;
        color: #5FCF80;
        border: 2px solid #5FCF80;
        transform: translateY(-2px);
    }

    .container {
        margin-top: 30px;
    }

    .row {
        display: flex;
        justify-content: space-between;
        gap: 30px;
    }

    .col-md-6 {
        width: 48%;
    }

    .image-container {
        height: 250px;
        overflow: hidden;
        border-radius: 8px;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .detail {
        font-weight: bold;
        color: #5FCF80;
    }
</style>

<div class="container">
<div class="trainer-rank">
<h3 class="text-center detail">CHI TIẾT KHÓA HỌC</h3>
</div>
    <div class="row">
        <div class="col-md-6">
            <section id="courses" class="courses section py-5 bg-light">
                <div class="course-item" data-aos="fade-up">
                    <div class="image-container">
                        <img src="<?= !empty($subject['image']) ? htmlspecialchars($subject['image']) : 'https://via.placeholder.com/300x200' ?>" class="card-img-top" alt="image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/subjects/<?= $subject['id'] ?>" class="text-dark fw-bold"><?= htmlspecialchars($subject['name']); ?></a>
                        </h5>
                        <p class="card-text"><?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?></p>
                        <div class="trainer-rank">
                            <i class="bi bi-person user-icon"></i> <?= $subject['user_quantity'] ?> Học viên
                        </div>
                        <div class="price-container">
                            <span class="price"><?= number_format($subject['price'], 0); ?> VND</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-6">
            <section id="course-details">
                <h5 class="card-title text-dark fw-bold">
                Khóa Học: <?= htmlspecialchars($subject['name']); ?>
                </h5>
                <br>
                <p class="card-text">Mô Tả: <?= htmlspecialchars($subject['description'] ?? 'Không có mô tả.'); ?></p>
                <div class="trainer-rank">
                    <i class="bi bi-person user-icon"></i> <?= $subject['user_quantity'] ?> Học viên
                </div>
                <div class="price-container">
                    <span class="price">Giá: <?= number_format($subject['price'], 0); ?> VND</span>
                </div>
                <div class="price-container">
                <a href="/carts/checkout/<?= $subject['id'] ?>" class="btn_2">Tham Gia Khóa Học</a>
                </div>
            </section>
        </div>
    </div>
</div>
