<div class="container mt-4">
    <!-- Tiêu đề môn học -->
    <h1 class="text-center mb-4"><?= htmlspecialchars($subject['name']) ?></h1>

    <div class="row">
        <!-- Cột Video -->
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body text-center">
                    <iframe
                        id="lessonVideo"
                        class="w-100 rounded"
                        height="400"
                        style="display: none; border: none;"
                        allowfullscreen>
                    </iframe>
                    <p id="noVideoMessage" class="text-danger mt-3" style="display: none;">
                        Không có video cho bài học này.
                    </p>
                </div>
            </div>

            <!-- Phần Bình Luận -->
            <div id="commentsSection" class="card shadow mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">💬 Bình Luận</h5>
                </div>
                <div class="card-body">
                    <!-- Danh Sách Bình Luận -->
                    <div class="comment-list">
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment">
                                    <strong><?= htmlspecialchars($comment['user_name']) ?>:</strong>
                                    <p><?= htmlspecialchars($comment['content']) ?></p>
                                    <small>Ngày: <?= htmlspecialchars($comment['created_at']) ?></small>

                                    <!-- Hiển thị nút sửa và xóa nếu bình luận thuộc về người dùng hiện tại -->
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $comment['user_id']): ?>
                                        <a href="/comments/edit/<?= $comment['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                        <form action="/comments/delete/<?= $comment['id'] ?>" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này?')">
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Chưa có bình luận nào.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Form Thêm Bình Luận -->
                    <?php if (isset($_SESSION['user'])): ?>
                        <h3>Thêm bình luận</h3>
                        <form action="/comments/create/<?= htmlspecialchars($lessonId) ?>" method="POST">
                            <input type="hidden" name="lesson_id" value="<?= htmlspecialchars($lessonId) ?>">
                            <div class="mb-3">
                                <label for="content" class="form-label">Nội dung bình luận</label>
                                <textarea
                                    name="content"
                                    id="content"
                                    class="form-control"
                                    rows="5"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Gửi</button>
                        </form>
                    <?php else: ?>
                        <p><a href="/login">Đăng nhập</a> để thêm bình luận.</p>
                    <?php endif; ?>
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
                                    <p
                                        class="mb-1 fw-semibold lesson-title d-flex justify-content-between align-items-center"
                                        data-id="<?= htmlspecialchars($lesson['id']) ?>"
                                        style="cursor: pointer;">
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
                                                        📝 Quiz: <?= htmlspecialchars($test['title']) ?>
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
        let commentsList = $(".comment-list");

        function loadVideo(videoUrl, lessonId) {
            if (videoUrl) {
                let youtubeEmbedUrl = convertToEmbedUrl(videoUrl);
                if (youtubeEmbedUrl) {
                    videoElement.attr("src", youtubeEmbedUrl).fadeIn();
                    noVideoMessage.hide();
                    window.history.pushState({}, "", "?lesson_id=" + lessonId);

                    // Update the comment form's lesson_id input
                    $("input[name='lesson_id']").val(lessonId);
                    // Also update the form action if needed
                    $("form[action^='/comments/create/']").attr("action", "/comments/create/" + lessonId);
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

        function loadComments(lessonId) {
            $.ajax({
                url: '/comments/' + lessonId,
                method: 'GET',
                success: function(response) {
                    commentsList.empty();
                    if (response.comments && response.comments.length > 0) {
                        response.comments.forEach(function(comment) {
                            var editDeleteButtons = '';
                            // Chỉ hiển thị nút Sửa và Xóa nếu bình luận của người dùng hiện tại
                            if (response.currentUserId == comment.user_id) {
                                editDeleteButtons = `
                        <a href="/comments/edit/${comment.id}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="/comments/delete/${comment.id}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này?')">
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    `;
                            }

                            var commentHtml = `
                    <div class="comment">
                        <strong>${comment.user_name}:</strong>
                        <p>${comment.content}</p>
                        <small>Ngày: ${comment.created_at}</small>
                        ${editDeleteButtons}
                    </div>
                    <hr>
                `;
                            commentsList.append(commentHtml);
                        });
                    } else {
                        commentsList.append('<p>Chưa có bình luận nào.</p>');
                    }
                },
                error: function() {
                    commentsList.empty();
                    commentsList.append('<p class="text-danger">Không thể tải bình luận.</p>');
                }
            });
        }

        $(".lesson-title").click(function() {
            let videoContainer = $(this).next(".video-link-container");
            $(".video-link-container").not(videoContainer).slideUp();
            videoContainer.slideToggle();

            let icon = $(this).find(".toggle-icon");
            $(".toggle-icon").not(icon).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            icon.toggleClass("fa-chevron-up fa-chevron-down");
        });

        $(".lesson-link").click(function() {
            let lessonId = $(this).data("id");
            let videoUrl = $(this).data("video");
            loadVideo(videoUrl, lessonId);
            loadComments(lessonId);
        });

        let urlParams = new URLSearchParams(window.location.search);
        let selectedLessonId = urlParams.get("lesson_id");
        if (selectedLessonId) {
            let selectedLesson = $(`.lesson-link[data-id="${selectedLessonId}"]`);
            if (selectedLesson.length) {
                let videoUrl = selectedLesson.data("video");
                loadVideo(videoUrl, selectedLessonId);
                loadComments(selectedLessonId);
            }
        } else {
            let firstLesson = $(".lesson-link").first();
            if (firstLesson.length) {
                let firstLessonId = firstLesson.data("id");
                let firstLessonVideo = firstLesson.data("video");
                loadVideo(firstLessonVideo, firstLessonId);
                loadComments(firstLessonId);
            }
        }
    });
</script>