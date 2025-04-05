<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Bài Viết</title>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | removeformat | help',
            images_upload_url: 'postAcceptor.php',
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function(callback, value, meta) {
                let input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    let file = this.files[0];
                    let reader = new FileReader();
                    reader.onload = function() {
                        callback(reader.result, {alt: file.name});
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            }
        });

        function validateForm() {
            const title = document.getElementById('title').value.trim();
            const content = tinymce.get('content').getContent().trim();
            const author = document.getElementById('author').value.trim();

            if (!title || !content || !author) {
                alert("Vui lòng điền đầy đủ các trường thông tin.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Chỉnh Sửa Bài Viết</h2>
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="title">Tiêu đề</label>
            <input type="text" id="title" name="name" value="<?php echo htmlspecialchars($title); ?>" required>

            <label for="author">Tác giả</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($author); ?>" required>

            <label for="image">Hình ảnh hiện tại:</label>
            <?php if (!empty($imagePath)): ?>
                <img src="<?php echo htmlspecialchars($imagePath); ?>" width="200">
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">

            <label for="content">Nội dung bài viết</label>
            <textarea id="content" name="content"><?php echo htmlspecialchars($content); ?></textarea>

            <button type="submit">Cập Nhật</button>
        </form>
    </div>
</body>
</html>
