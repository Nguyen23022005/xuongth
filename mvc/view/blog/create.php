<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bài Viết Mới</title>
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>

    <style>
        /* Your existing styles remain unchanged */
    </style>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | removeformat | help',
            images_upload_url: 'postAcceptor.php', // Ensure this endpoint exists if used
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
            const image = document.getElementById('image').files.length;
            const author = document.getElementById('author').value.trim();

            if (!title || !content || !image || !author) {
                alert("Vui lòng điền đầy đủ các trường, bao gồm hình ảnh và tác giả.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Thêm Bài Viết Mới</h2>
        <form action="/blog/create" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="title">Tiêu đề</label>
            <input type="text" id="title" name="name" placeholder="Nhập tiêu đề bài viết" value="<?php echo htmlspecialchars($title ?? ''); ?>" required>

            <label for="author">Tác giả</label>
            <input type="text" id="author" name="author" placeholder="Nhập tên tác giả" value="<?php echo htmlspecialchars($author ?? ''); ?>" required>

            <label for="image">Hình ảnh</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <label for="content">Nội dung bài viết</label>
            <textarea id="content" name="content"><?php echo htmlspecialchars($content ?? ''); ?></textarea>

            <button type="submit" class="btn-submit">Đăng bài</button>
        </form>
    </div>
</body>
</html>