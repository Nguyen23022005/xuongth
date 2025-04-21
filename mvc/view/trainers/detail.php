<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 900px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .profile {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }

    .profile img {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
        margin-right: 30px;
        border: 4px solid #5FCF80;
    }

    .profile-info h2 {
        margin: 0 0 10px;
        color: #333;
    }

    .profile-info p {
        margin: 5px 0;
        color: #555;
    }

    .section {
        margin-bottom: 5px;
    }

    .section h3 {
        color: #5FCF80;
        border-bottom: 2px solidrgb(34, 188, 80);
        padding-bottom: 5px;
    }

    ul.courses {
        list-style: square;
        margin-left: 20px;
        color: #444;
    }

    .contact a {
        color: #007bff;
        text-decoration: none;
    }

    .contact a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <div class="profile">
        <img src="/uploads/<?= $user['image'] ?>" alt="Giảng viên">
        <div class="profile-info">
            <h2><?= $user['name'] ?></h2>
            <p><strong>Chức vụ:</strong> Giảng viên </p>
        </div>
    </div>
    <div class="section">
        <h3>Giới thiệu</h3>
        <p>Thầy Nguyễn Văn A có hơn 10 năm kinh nghiệm giảng dạy và nghiên cứu trong lĩnh vực Lập trình Web và Trí tuệ nhân tạo. Thầy luôn mang đến phương pháp giảng dạy sinh động và thực tiễn.</p>
    </div>
    <div class="section">
        <h3>Thông tin liên hệ</h3>
        <p class="contact">📧 Email: <a href="<?= $user['email'] ?>"><?= $user['email'] ?></a></p>
        <p>📞 Điện thoại: <?= $user['phone'] ?></p>
        <p>🏫 Văn phòng: <?= $user['diachi'] ?></p>
    </div>
    <div class="section">
        <h3>Khóa học đang giảng dạy</h3>
        <ul class="courses">
            <?php foreach ($subjects as $subject): if ($subject['user_id'] === $user['id']) { ?>
                <li><?= $subject['name'] ?></li>
            <?php }
            endforeach; ?>
        </ul>
    </div>
</div>