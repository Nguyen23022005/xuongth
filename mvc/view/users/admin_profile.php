<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .profile-container {
        max-width: 900px;
        margin: 40px auto;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        gap: 20px;
    }

    .left-panel {
        width: 30%;
        text-align: center;
        padding-right: 20px;
        border-right: 1px solid #ddd;
    }

    .right-panel {
        width: 70%;
    }

    .profile-img img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 3px solid #5FCF80;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .btn-save {
        background-color: #5FCF80;
        color: white;
        width: 100%;
        padding: 12px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        margin-top: 20px;
        transition: background 0.3s ease;
    }

    .btn-save:hover {
        background-color: #3eaf5c;
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
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        transition: background 0.3s;
    }

    .btn-upload:hover {
        background-color: rgb(0, 103, 5);
    }

    label {
        font-weight: 600;
        margin-top: 10px;
    }

    .form-control {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
</style>

<body>
    <div class="container-fluid">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="profile-container">
                <div class="left-panel">
                    <div class="profile-img">
                        <img src="/uploads/<?= htmlspecialchars($user['image']) ?>" alt="Ảnh đại diện">
                    </div>
                    <div class="image-upload">
                        <input type="file" name="image" id="image" accept="image/*" style="display: none;" onchange="previewImage(event)">
                        <button type="button" class="btn-upload" onclick="document.getElementById('image').click()">Đổi ảnh</button>
                    </div>
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
                    <input type="text" name="phone" class="form-control" id="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>

                    <label>Địa Chỉ Liên Hệ</label>
                    <input type="text" name="diachi" class="form-control" id="diachi" value="<?= htmlspecialchars($user['diachi'] ?? '') ?>" required>

                    <label>Kinh Nghiệm Làm Việc</label>
                    <input type="text" name="kinhnghiem" class="form-control" id="kinhnghiem" value="<?= htmlspecialchars($user['kinhnghiem'] ?? '') ?>" required>

                    <label>Bằng Cấp</label>
                    <input type="text" name="bangcap" class="form-control" id="bangcap" value="<?= htmlspecialchars($user['bangcap'] ?? '') ?>" required>

                    <label>Trường Học</label>
                    <input type="text" name="truonghoc" class="form-control" id="truonghoc" value="<?= htmlspecialchars($user['truonghoc'] ?? '') ?>" required>

                    <label>Năm Tốt Nghiệp</label>
                    <input type="text" name="namhoc" class="form-control" id="namhoc" value="<?= htmlspecialchars($user['namhoc'] ?? '') ?>" required>

                    <button class="btn btn-save">Lưu Thay Đổi</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.querySelector(".profile-img img");

            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        }
    </script>
</body>
