<div class="container mt-5">
    <h1 class="text-center"><?= htmlspecialchars($subject['name']) ?></h1>

    <?php if (!empty($lessons)): ?>
        <label for="lessonSelect">Chọn bài học:</label>
        <select id="lessonSelect" class="form-control">
            <option value="">-- Chọn bài học --</option>
            <?php foreach ($lessons as $lesson): ?>
                <option value="<?= htmlspecialchars($lesson['id']) ?>"
                    data-video="<?= htmlspecialchars($lesson['video']) ?>"
                    <?= (isset($_GET['lesson_id']) && $_GET['lesson_id'] == $lesson['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($lesson['title']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="mt-4 text-center">
            <iframe id="lessonVideo" width="80%" height="400" style="display: none; border: none;"
                allowfullscreen></iframe>
            <p id="noVideoMessage" class="text-danger" style="display: none;">Không có video cho bài học này.</p>
        </div>
    <?php else: ?>
        <p class="text-center">Không có bài học nào cho môn học này.</p>
    <?php endif; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selectElement = document.getElementById("lessonSelect");
        let videoElement = document.getElementById("lessonVideo");
        let noVideoMessage = document.getElementById("noVideoMessage");

        function loadVideo(videoUrl, lessonId) {
            if (videoUrl) {
                let youtubeEmbedUrl = convertToEmbedUrl(videoUrl);
                if (youtubeEmbedUrl) {
                    videoElement.src = youtubeEmbedUrl;
                    videoElement.style.display = "block";
                    noVideoMessage.style.display = "none";
                    window.history.pushState({}, "", "?lesson_id=" + lessonId);
                } else {
                    videoElement.style.display = "none";
                    noVideoMessage.style.display = "block";
                }
            } else {
                videoElement.style.display = "none";
                noVideoMessage.style.display = "block";
                window.history.pushState({}, "", window.location.pathname);
            }
        }

        function convertToEmbedUrl(url) {
            if (!url) return null;
            let videoId = null;

            // Kiểm tra nếu URL là dạng https://www.youtube.com/watch?v=...
            let match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
            if (match) {
                videoId = match[1];
            }

            return videoId ? `https://www.youtube.com/embed/${videoId}` : null;
        }

        // Kiểm tra nếu có `lesson_id` từ URL, tự động hiển thị video
        let urlParams = new URLSearchParams(window.location.search);
        let selectedLessonId = urlParams.get("lesson_id");

        if (selectedLessonId) {
            let selectedOption = selectElement.querySelector(`option[value="${selectedLessonId}"]`);
            if (selectedOption) {
                loadVideo(selectedOption.dataset.video, selectedLessonId);
            }
        } else {
            // Nếu không có `lesson_id`, tự động chọn bài học đầu tiên (nếu có)
            if (selectElement.options.length > 1) {
                let firstOption = selectElement.options[1]; // Bỏ option đầu tiên (placeholder)
                firstOption.selected = true;
                loadVideo(firstOption.dataset.video, firstOption.value);
            }
        }

        // Khi chọn bài học, thay đổi video
        selectElement.addEventListener("change", function() {
            let selectedOption = this.options[this.selectedIndex];
            let lessonId = selectedOption.value;
            let videoUrl = selectedOption.dataset.video;
            loadVideo(videoUrl, lessonId);
        });
    });
</script>
