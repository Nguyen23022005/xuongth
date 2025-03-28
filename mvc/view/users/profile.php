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
                            <div class="profile-img"></div>
                            <div class="image-upload">
                                <!-- Ẩn input file -->
                                <input type="file" name="image" id="image" accept="image/*" style="display: none;" onchange="previewImage(event)">

                                <!-- Nút đổi ảnh -->
                                <button type="button" class="btn-upload" onclick="document.getElementById('image').click()">Đổi ảnh</button>

                                <!-- Hiển thị ảnh hiện tại -->
                                <?php if (!empty($user['image'])): ?>
                                    <p>Ảnh hiện tại:</p>
                                    <img id="preview" src="/uploads/<?= htmlspecialchars($user['image']) ?>" alt="Avatar" width="100">
                                <?php else: ?>
                                    <img id="preview" src="" alt="Chưa có ảnh" width="100" style="display: none;">
                                <?php endif; ?>
                            </div>
                            <br>
                            <h4>Edogaru</h4>
                            <p>edogaru@mail.com.my</p>
                        </div>
                        <div class="right-panel">
                            <h3>Profile Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" placeholder="First name">
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Surname">
                                </div>
                            </div>
                            <label>Số Điện Thoại Di Động</label>
                            <input type="text" class="form-control" placeholder="Enter phone number">
                            <button class="btn btn-save mt-3">Save Profile</button>
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