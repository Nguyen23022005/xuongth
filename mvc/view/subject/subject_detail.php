<div class="container py-5">
    <!-- Tiêu đề -->
    <h2 class="text-center mb-5 fw-bold"><?= htmlspecialchars($subject['name']) ?></h2>

    <div class="row g-4">
        <!-- Cột Video & Bình luận -->
        <div class="col-lg-8">
            <!-- Video Player -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-3 text-center">
                    <iframe
                        id="lessonVideo"
                        class="w-100 rounded"
                        height="400"
                        style="display: none; border: none;"
                        allowfullscreen></iframe>
                    <p id="noVideoMessage" class="text-danger mt-3" style="display: none;">
                        Không có video cho bài học này.
                    </p>
                </div>
            </div>

            <!-- Bình luận -->
            <div id="commentsSection" class="card shadow-sm">
                <div class="card-header text-white">
                    <h5 class="mb-0">💬 Bình Luận</h5>
                </div>
                <div class="card-body">
                    <div class="comment-list mb-4">
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class="border-bottom pb-3 mb-3">
                                    <strong><?= htmlspecialchars($comment['user_name']) ?>:</strong>
                                    <p class="mb-1"><?= htmlspecialchars($comment['content']) ?></p>
                                    <small class="text-muted">Ngày: <?= htmlspecialchars($comment['created_at']) ?></small>
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $comment['user_id']): ?>
                                        <div class="mt-2">
                                            <a href="/comments/edit/<?= $comment['id'] ?>" class="btn btn-sm btn-outline-warning me-2">Sửa</a>
                                            <form action="/comments/delete/<?= $comment['id'] ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này?')">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Xóa</button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">Chưa có bình luận nào.</p>
                        <?php endif; ?>
                    </div>

                    <?php if (isset($_SESSION['user'])): ?>
                        <h5 class="fw-bold mb-3">Thêm bình luận</h5>
                        <form action="/comments/create/<?= htmlspecialchars($lessonId) ?>" method="POST">
                            <input type="hidden" name="lesson_id" value="<?= htmlspecialchars($lessonId) ?>">
                            <div class="mb-3">
                                <label for="content" class="form-label">Nội dung bình luận</label>
                                <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </form>
                    <?php else: ?>
                        <p><a href="/login">Đăng nhập</a> để thêm bình luận.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Cột Danh sách bài học -->
        <div class="col-lg-4">
            <?php if (!empty($lessons)): ?>
                <div class="mb-4">
                    <?php foreach ($progresses as $progress): if ($subject['id'] === $progress['subject_id'] && $progress['user_id'] === $_SESSION['user']['id']) { ?>
                            <div class="mb-2 fw-semibold">Tiến độ khóa học: <span class="text-success"><?= htmlspecialchars(($progress['number_submit'] / $progress['number_test']) * 100) ?> %</span></div>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" style="width:<?= htmlspecialchars(($progress['number_submit'] / $progress['number_test']) * 100) ?>%;"></div>
                            </div>
                            <?php if(($progress['number_submit'] / $progress['number_test']) * 100 === 100){?>
                            <form action="/create/sendemail" method="POST" class="mt-3">
                                <input type="hidden" name="name" value="<?= htmlspecialchars($subject['name']) ?>">
                                <input type="hidden" name="image" value="<?= htmlspecialchars($subject['image']) ?>">
                                <input type="hidden" name="sku" value="<?= htmlspecialchars($subject['sku']) ?>">
                                <button type="submit" class="btn btn-outline-primary w-100">
                                    🎓 Nhận Chứng Chỉ
                                </button>
                            </form>
                            <?php }?>
                    <?php }
                    endforeach; ?>
                </div>

                <!-- Accordion danh sách bài -->
                <div class="accordion" id="lessonAccordion">
                    <?php foreach ($lessons as $index => $lesson): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?= $lesson['id'] ?>">
                                <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $lesson['id'] ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>">
                                    <?= htmlspecialchars($lesson['title']) ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $lesson['id'] ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#lessonAccordion">
                                <div class="accordion-body">
                                    <a href="javascript:void(0);" class="lesson-link text-primary fw-semibold" data-id="<?= htmlspecialchars($lesson['id']) ?>" data-video="<?= htmlspecialchars($lesson['video']) ?>">
                                        ▶️ Xem Video Bài Học
                                    </a>

                                    <?php foreach ($tests as $test): ?>
                                        <?php if ($test['lessons_id'] == $lesson['id']): ?>
                                            <div class="mt-2">
                                                <a href="/subjects/quiz/<?= htmlspecialchars($test['id']) ?>" class="text-success fw-semibold">
                                                    📝 Quiz: <?= htmlspecialchars($test['title']) ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">Không có bài học nào cho môn học này.</div>
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
                            if (response.currentUserId == comment.user_id) {
                                editDeleteButtons = `
                        <a href="/comments/edit/${comment.id}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="/comments/delete/${comment.id}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này?')" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    `;
                            }

                            var commentHtml = `
                    <div class="comment mb-3">
                        <strong>${comment.user_name}:</strong>
                        <p>${comment.content}</p>
                        <small class="text-muted">Ngày: ${comment.created_at}</small>
                        ${editDeleteButtons}
                    </div>
                    <hr>
                `;
                            commentsList.append(commentHtml);
                        });
                    } else {
                        commentsList.append('<p class="text-muted">Chưa có bình luận nào.</p>');
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