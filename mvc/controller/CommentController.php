<?php
require_once "model/CommentModel.php";
require_once "model/LessonModel.php";
require_once "view/helpers.php";

class CommentController
{
    private $commentModel;
    private $lessonModel;

    public function __construct()
    {
        // Khởi tạo các model cần thiết
        $this->commentModel = new CommentModel();
        $this->lessonModel = new LessonsModel();
    }

    // Hiển thị danh sách bình luận của bài học
    // Trong CommentController:
    public function index($lessonId = null)
    {
        if (!$lessonId) {
            // Trả về lỗi nếu không có ID bài học
            http_response_code(400);
            echo json_encode(['error' => 'Không tìm thấy bài học.']);
            exit;
        }

        // Lấy danh sách bình luận từ model
        $comments = $this->commentModel->getAllCommentsByLessonId($lessonId);

        // Thêm ID người dùng hiện tại vào phản hồi
        $currentUserId = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;

        // Trả về dữ liệu bình luận dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode([
            'comments' => $comments,
            'currentUserId' => $currentUserId
        ]);
        exit;
    }

    // Thêm bình luận mới
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lessonId = $_POST['lesson_id'] ?? null;
            $content = $_POST['content'] ?? '';
            $userId = $_SESSION['user']['id'] ?? null;

            // Kiểm tra người dùng đã đăng nhập chưa
            if (!$userId) {
                echo json_encode(['success' => false, 'error' => 'Bạn phải đăng nhập để thêm bình luận.']);
                exit;
            }

            // Kiểm tra dữ liệu hợp lệ
            if (empty($lessonId) || empty($content)) {
                echo json_encode(['success' => false, 'error' => 'Dữ liệu không hợp lệ.']);
                exit;
            }

            // Thêm bình luận vào cơ sở dữ liệu
            $result = $this->commentModel->createComment($lessonId, $userId, $content);

            if ($result) {
                // Lấy thông tin bình luận mới và giải mã nội dung
                $newComment = [
                    'user_name' => $_SESSION['user']['name'], // Lấy tên người dùng từ session
                    'content' => html_entity_decode($content), // Giải mã Unicode
                    'created_at' => date('Y-m-d H:i:s')
                ];

                echo json_encode(['success' => true, 'comment' => $newComment]);

                // Chuyển hướng về trang subject với lesson_id là query parameter
                $subjectId = $this->lessonModel->getLessonsBySubjectId($lessonId);
                header("Location: /subjects/{$subjectId}?lesson_id={$lessonId}");
                exit;
            } else {
                echo json_encode(['success' => false, 'error' => 'Không thể thêm bình luận.']);
            }
        }
    }

    // Chỉnh sửa bình luận
// Chỉnh sửa bình luận
public function edit($id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiểm tra người dùng đã đăng nhập chưa
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            echo json_encode(['success' => false, 'error' => 'Bạn phải đăng nhập để chỉnh sửa bình luận.']);
            exit;
        }

        // Lấy bình luận từ cơ sở dữ liệu
        $comment = $this->commentModel->getCommentById($id);
        if (!$comment || $comment['user_id'] != $userId) {
            echo json_encode(['success' => false, 'error' => 'Bạn không có quyền chỉnh sửa bình luận này.']);
            exit;
        }

        // Lấy nội dung mới của bình luận từ form
        $content = $_POST['content'] ?? '';
        if (empty($content)) {
            echo json_encode(['success' => false, 'error' => 'Nội dung bình luận không được để trống.']);
            exit;
        }

        // Cập nhật bình luận
        $this->commentModel->updateComment($id, $content);

        // Lấy lesson_id từ comment để chuyển hướng
        $lessonId = $comment['lesson_id'];
        
        // Lấy subject_id từ lesson
        $subjectId = $this->lessonModel->getLessonsBySubjectId($lessonId);
        
        // Chuyển hướng về trang subject với lesson_id là query parameter
        header("Location: /subjects/{$subjectId}?lesson_id={$lessonId}");
        exit;
    } else {
        // Hiển thị form chỉnh sửa bình luận
        $comment = $this->commentModel->getCommentById($id);
        if (!$comment || $comment['user_id'] != $_SESSION['user']['id']) {
            echo json_encode(['success' => false, 'error' => 'Bạn không có quyền chỉnh sửa bình luận này.']);
            exit;
        }

        renderView("view/comment/comment_edit.php", compact('comment'), "Chỉnh sửa bình luận");
    }
}

// Xóa bình luận
public function delete($id)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiểm tra người dùng đã đăng nhập chưa
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            echo json_encode(['success' => false, 'error' => 'Bạn phải đăng nhập để xóa bình luận.']);
            exit;
        }

        // Lấy bình luận từ cơ sở dữ liệu
        $comment = $this->commentModel->getCommentById($id);
        if (!$comment || $comment['user_id'] != $userId) {
            echo json_encode(['success' => false, 'error' => 'Bạn không có quyền xóa bình luận này.']);
            exit;
        }
        
        // Lấy lesson_id từ comment để chuyển hướng sau khi xóa
        $lessonId = $comment['lesson_id'];
        
        // Lấy subject_id từ lesson
        $subjectId = $this->lessonModel->getLessonsBySubjectId($lessonId);

        // Xóa bình luận
        $this->commentModel->deleteComment($id);

        // Chuyển hướng về trang subject với lesson_id là query parameter
        header("Location: /subjects/{$subjectId}?lesson_id={$lessonId}");
        exit;
    }
}
}
