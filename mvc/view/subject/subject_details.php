<div class="container mt-2">
    <h1 class=" mb-4"><?= htmlspecialchars($subject['name']) ?></h1>
    <div class="row">
        <div class="col-md-8">
            <div class="mt-2 text-center">
                <iframe id="lessonVideo" width="100%" height="400" style="display: none; border: none;" allowfullscreen></iframe>
                <p id="noVideoMessage" class="text-danger mt-3" style="display: none;">Không có video cho bài học này.</p>
            </div>
        </div> 
        <div class="col-md-4">
            <?php if (!empty($lessons)): ?>
                <label class="form-label fw-bold">Nội Dung Khóa Học:</label>
                <ul class="list-group">
                    <?php foreach ($lessons as $index => $lesson): ?>
                        <li class="list-group-item">
                            <p class="mb-1 fw-semibold lesson-title" data-id="<?= htmlspecialchars($lesson['id']) ?>" style="cursor: pointer;">
                                <?= htmlspecialchars($lesson['title']) ?>
                                <span class="toggle-icon float-end">▼</span>
                            </p>
                            <div class="video-link-container" style="display: <?= $index === 0 ? 'block' : 'none' ?>; padding-left: 15px;">
                                <a href="javascript:void(0);" class="lesson-link text-primary"
                                   data-id="<?= htmlspecialchars($lesson['id']) ?>"
                                   data-video="<?= htmlspecialchars($lesson['video']) ?>"
                                   style="text-decoration: none;">
                                    ▶ Xem Video Bài Học 
                                </a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center text-danger">Không có bài học nào cho môn học này.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let videoElement = $("#lessonVideo");
        let noVideoMessage = $("#noVideoMessage");
        let urlParams = new URLSearchParams(window.location.search);
        let selectedLessonId = urlParams.get("lesson_id");

        function loadVideo(videoUrl, lessonId) {
            if (videoUrl) {
                let youtubeEmbedUrl = convertToEmbedUrl(videoUrl);
                if (youtubeEmbedUrl) {
                    videoElement.attr("src", youtubeEmbedUrl).show();
                    noVideoMessage.hide();
                    window.history.pushState({}, "", "?lesson_id=" + lessonId);
                } else {
                    videoElement.hide();
                    noVideoMessage.show();
                }
            } else {
                videoElement.hide();
                noVideoMessage.show();
                window.history.pushState({}, "", window.location.pathname);
            }
        }

        function convertToEmbedUrl(url) {
            if (!url) return null;
            let match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
            return match ? `https://www.youtube.com/embed/${match[1]}` : null;
        }

        // Hiệu ứng mở rộng/thu gọn khi nhấp vào tiêu đề bài học
        $(".lesson-title").click(function () {
            let videoContainer = $(this).next(".video-link-container");
            $(".video-link-container").not(videoContainer).slideUp(); // Ẩn các phần khác
            videoContainer.slideToggle();

            // Đổi icon ▲▼
            let icon = $(this).find(".toggle-icon");
            $(".toggle-icon").not(icon).text("▼");
            icon.text(icon.text() === "▼" ? "▲" : "▼");
        });

        // Khi nhấp vào "Xem Video", phát video
        $(".lesson-link").click(function () {
            let lessonId = $(this).data("id");
            let videoUrl = $(this).data("video");
            loadVideo(videoUrl, lessonId);
        });

        // Nếu có lesson_id trên URL, tự động hiển thị video tương ứng
        if (selectedLessonId) {
            let selectedLesson = $(`.lesson-link[data-id="${selectedLessonId}"]`);
            if (selectedLesson.length) {
                let videoUrl = selectedLesson.data("video");
                loadVideo(videoUrl, selectedLessonId);

                // Hiển thị link video khi tải trang
                let videoContainer = selectedLesson.closest(".video-link-container");
                videoContainer.slideDown();
                selectedLesson.closest(".list-group-item").find(".toggle-icon").text("▲");
            }
        } else {
            // Nếu không có lesson_id, tự động chọn bài học đầu tiên
            let firstLesson = $(".lesson-link").first();
            if (firstLesson.length) {
                let firstLessonId = firstLesson.data("id");
                let firstLessonVideo = firstLesson.data("video");
                loadVideo(firstLessonVideo, firstLessonId);

                // Hiển thị bài học đầu tiên khi vào trang
                firstLesson.closest(".video-link-container").slideDown();
                firstLesson.closest(".list-group-item").find(".toggle-icon").text("▲");
            }
        }
    });
</script>
