<style>
    .progress-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        margin-top: 20px;
    }

    .progress-label {
        font-weight: 600;
        margin-bottom: 10px;
        color: #333;
    }

    .progress {
        height: 10px;
        border-radius: 10px;
        overflow: hidden;
        background-color: #e9ecef;
    }

    .progress-bar-custom {
        background-color: #5FCF80;
        transition: width 0.6s ease;
    }

    .btn-certificate {
        background-color: #5FCF80;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
        margin-top: 15px;
        display: inline-block;
        text-decoration: none;
    }

    .btn-certificate:hover {
        background-color: white;
        color: #5FCF80;
        border: 2px solid #5FCF80;
    }
</style>
<div class="container mt-4">
    <h1 class="text-center mb-4"><?= htmlspecialchars($subject['name']) ?></h1>

    <div class="row">
        <!-- Cột Video -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center">
                    <iframe id="lessonVideo" class="w-100 rounded" height="400" style="display: none; border: none;" allowfullscreen></iframe>
                    <p id="noVideoMessage" class="text-danger mt-3" style="display: none;">Không có video cho bài học này.</p>
                </div>
            </div>
        </div>

        <!-- Cột Danh Sách Bài Học -->
        <div class="col-md-4">
            <?php if (!empty($lessons)): ?>
                <div class="progress-container">
                    <div class="progress-label">Tiến độ: <span>100%</span></div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-custom" style="width: 80%;"></div>
                    </div>
                    <form action="/create/sendemail" method="POST">
                        <input type="hidden" name="name" value="<?= htmlspecialchars($subject['name']) ?>">
                        <input type="hidden" name="image" value="<?= htmlspecialchars($subject['image']) ?>">
                        <input type="hidden" name="sku" value="<?= htmlspecialchars($subject['sku']) ?>">

                        <button type="submit" class="btn btn-certificate mt-3">
                            Nhận Chứng Chỉ
                        </button>
                    </form>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <label class="form-label fw-bold"> Nội Dung Khóa Học:</label>
                        <ul class="list-group">
                            <?php foreach ($lessons as $index => $lesson): ?>
                                <li class="list-group-item">
                                    <p class="mb-1 fw-semibold lesson-title d-flex justify-content-between align-items-center"
                                        data-id="<?= htmlspecialchars($lesson['id']) ?>" style="cursor: pointer;">
                                        <?= htmlspecialchars($lesson['title']) ?>
                                        <i class="toggle-icon fas fa-chevron-down"></i>
                                    </p>

                                    <div class="video-link-container" style="display: <?= $index === 0 ? 'block' : 'none' ?>; padding-left: 15px;">
                                        <a href="javascript:void(0);" class="lesson-link text-primary fw-bold"
                                            data-id="<?= htmlspecialchars($lesson['id']) ?>"
                                            data-video="<?= htmlspecialchars($lesson['video']) ?>"
                                            style="text-decoration: none;">
                                            Xem Video Bài Học
                                        </a>

                                        <?php foreach ($tests as $test): if ($test['lessons_id'] == $lesson['id']) { ?>
                                                <div class="mt-1">
                                                    <a class="lesson-link text-success fw-bold" href="/subjects/quiz/<?= htmlspecialchars($test['id']) ?>" style="text-decoration: none;">
                                                        Quiz: <?= htmlspecialchars($test['title']) ?>
                                                    </a>
                                                </div>
                                        <?php }
                                        endforeach; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-center text-danger">Không có bài học nào cho môn học này.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Load jQuery & Bootstrap Icons -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        let videoElement = $("#lessonVideo");
        let noVideoMessage = $("#noVideoMessage");
        let urlParams = new URLSearchParams(window.location.search);
        let selectedLessonId = urlParams.get("lesson_id");

        function loadVideo(videoUrl, lessonId) {
            if (videoUrl) {
                let youtubeEmbedUrl = convertToEmbedUrl(videoUrl);
                if (youtubeEmbedUrl) {
                    videoElement.attr("src", youtubeEmbedUrl).fadeIn();
                    noVideoMessage.hide();
                    window.history.pushState({}, "", "?lesson_id=" + lessonId);
                } else {
                    videoElement.hide();
                    noVideoMessage.fadeIn();
                }
            } else {
                videoElement.hide();
                noVideoMessage.fadeIn();
                window.history.pushState({}, "", window.location.pathname);
            }
        }

        function convertToEmbedUrl(url) {
            if (!url) return null;
            let match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
            return match ? `https://www.youtube.com/embed/${match[1]}` : null;
        }

        // Xử lý khi nhấp vào tiêu đề bài học
        $(".lesson-title").click(function() {
            let videoContainer = $(this).next(".video-link-container");
            $(".video-link-container").not(videoContainer).slideUp();
            videoContainer.slideToggle();

            // Đổi icon
            let icon = $(this).find(".toggle-icon");
            $(".toggle-icon").not(icon).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            icon.toggleClass("fa-chevron-up fa-chevron-down");
        });

        // Khi nhấp vào "Xem Video", phát video
        $(".lesson-link").click(function() {
            let lessonId = $(this).data("id");
            let videoUrl = $(this).data("video");
            loadVideo(videoUrl, lessonId);
        });

        // Nếu có lesson_id trên URL, tự động hiển thị video
        if (selectedLessonId) {
            let selectedLesson = $(`.lesson-link[data-id="${selectedLessonId}"]`);
            if (selectedLesson.length) {
                let videoUrl = selectedLesson.data("video");
                loadVideo(videoUrl, selectedLessonId);

                // Hiển thị phần bài học tương ứng
                let videoContainer = selectedLesson.closest(".video-link-container");
                videoContainer.slideDown();
                selectedLesson.closest(".list-group-item").find(".toggle-icon").addClass("fa-chevron-up").removeClass("fa-chevron-down");
            }
        } else {
            // Mặc định chọn bài học đầu tiên
            let firstLesson = $(".lesson-link").first();
            if (firstLesson.length) {
                let firstLessonId = firstLesson.data("id");
                let firstLessonVideo = firstLesson.data("video");
                loadVideo(firstLessonVideo, firstLessonId);

                // Hiển thị bài học đầu tiên
                firstLesson.closest(".video-link-container").slideDown();
                firstLesson.closest(".list-group-item").find(".toggle-icon").addClass("fa-chevron-up").removeClass("fa-chevron-down");
            }
        }
    });
</script>