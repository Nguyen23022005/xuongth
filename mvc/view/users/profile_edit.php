<style>
    .profile-container {
        max-width: 900px;
        /* margin: 50px auto; */
        background: white;
        /* padding: 20px; */
        border-radius: 10px;
        display: flex;
    }

    .left-panel {
        width: 30%;
        text-align: center;
        padding: 20px;
        border-right: 1px solid #ddd;
    }

    .right-panel {
        width: 70%;
        padding: 20px;
    }

    .profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #ddd;
        margin: 0 auto 10px;
    }

    .btn-save {
        background-color: #5FCF80;
        color: white;
        width: 100%;
    }

    .image-upload {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .btn-upload {
        background-color: #5FCF80;
        color: white;
        padding: 4px 8px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-upload:hover {
        background-color:rgb(0, 103, 5);
    }

    #preview {
        border-radius: 10px;
        border: 2px solid #ddd;
        padding: 5px;
        max-width: 120px;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php
                include("view/layouts/dashboard.php");
                ?>
            </div>
            <div class="col-md-9">
                <br>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="profile-container">
                        <div class="left-panel">
                            <div class="profile-img"><img src="/uploads/<?= htmlspecialchars($user['image']) ?>" class="profile-img" alt=""></div>
                            <div class="image-upload">
                                <!-- Ẩn input file -->
                                <input type="file" name="image" id="image" accept="image/*" style="display: none;" onchange="previewImage(event)">

                                <!-- Nút đổi ảnh -->
                                <button type="button" class="btn-upload" onclick="document.getElementById('image').click()">Đổi ảnh</button>
                            </div>
                            <br>
                            <h4><?= htmlspecialchars($user['name'] ?? '') ?></h4>
                            <p><?= htmlspecialchars($user['email'] ?? '') ?></p>
                        </div>
                        <div class="right-panel">
                            <h3>Thông Tin Hồ Sơ</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                                    </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                                    </div>
                            </div>
                            <label>Số Điện Thoại Di Động</label>
                            <input type="number" name="phone" class="form-control" id="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
                            <button class="btn btn-save mt-3">Lưu Thay Đổi</button>
                </form>
            </div>
        </div>
        <br>
    </div>
    </div>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = "block"; // Hiển thị ảnh sau khi chọn
            }
        }
    </script>
</body>