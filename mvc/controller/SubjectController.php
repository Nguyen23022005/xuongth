<?php
require_once "model/SubjectModel.php";
require_once "model/LessonModel.php";
require_once "model/TestModel.php";
require_once "model/CommentModel.php";  
require_once "view/helpers.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer
class SubjectController
{
    private $subjectsModel;
    private $lessonModel;
    private $testModel;
    private $commentModel;

    public function __construct()
    {
        $this->subjectsModel = new SubjectsModel();
        $this->lessonModel = new LessonsModel();
        $this->testModel = new TestModel();
        $this->commentModel = new CommentModel();
    }

    public function index()
    {
        $subjects = $this->subjectsModel->getAllSubjects();
        renderAdminView("view/subject/subject_list.php", compact('subjects'), "subjects List", true);
    }

    public function admin_index($id)
    {
        $subjects = $this->subjectsModel->getSubjectById($id);
        $lessons = $this->lessonModel->getAllLessons();
        renderAdminView("view/subject/subject_detail_admin.php", compact('subjects', 'lessons'), "subjects List", true);
    }
    
    public function quiz_index($id)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: /login');
            exit;
        }

        $user_id = $_SESSION['user_id'];  // Lấy user_id từ session

        // Lấy bài kiểm tra theo id
        $test = $this->testModel->getTestById($id);

        // Lấy các câu hỏi của bài kiểm tra
        $questions = $this->testModel->getQuestionsForUser($id, $user_id);  // Lọc câu hỏi cho người dùng

        renderView("view/subject/subject_quiz.php", compact('test', 'questions'), "Làm bài quiz");
    }

    public function show($id)
    {
        // Lấy thông tin môn học
        $subject = $this->subjectsModel->getSubjectById($id);
    
        // Kiểm tra nếu môn học không tồn tại
        if (!$subject) {
            $_SESSION['error_message'] = "Môn học không tồn tại.";
            header("Location: /");
            exit;
        }
    
        // Lấy danh sách bài học của môn học
        $lessons = $this->lessonModel->getLessonsBySubjectId($id);
    
        // Lấy danh sách bình luận của bài học đầu tiên (nếu có)
        $comments = [];
        $lessonId = null;
        if (!empty($lessons)) {
            $lessonId = $lessons[0]['id'];
            $comments = $this->commentModel->getAllCommentsByLessonId($lessonId);
        }
    
        // Lấy danh sách bài kiểm tra và câu hỏi
        $tests = $this->testModel->getAlltests(); // Lấy tất cả bài kiểm tra
        $questions = $this->testModel->getAllQuestions(); // Lấy tất cả câu hỏi
    
        // Render view subject_detail với thông tin môn học, bài học, bình luận, bài kiểm tra và câu hỏi
        renderView(
            "view/subject/subject_detail.php",
            compact('subject', 'lessons', 'comments', 'lessonId', 'tests', 'questions'),
            "Chi tiết môn học"
        );
    }
    public function shows()
    {
        $limit = 6; // Số mục trên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $subjects = $this->subjectsModel->getPaginatedSubjects($limit, $offset);
        $user_subjects = $this->subjectsModel->getAllUserSubjects();
        $totalSubjects = $this->subjectsModel->getTotalSubjects();
        $totalPages = ceil($totalSubjects / $limit);

        renderView("view/subject/subject_show_2.php", compact('subjects', 'user_subjects', 'totalPages', 'page'));
    }

    public function show_register($id)
    {
        $subject = $this->subjectsModel->getSubjectById($id);
        renderView("view/subject/subject_register.php", compact('subject'), "Subject Detail");
    }
    public function showAllByCategory()
    {
        $subjectsByCategory = $this->subjectsModel->getSubjectsGroupedByCategory();

        foreach ($subjectsByCategory as $categoryName => &$subjects) {
            foreach ($subjects as &$subject) {
                // Lấy danh sách bài học theo subject_id
                $subject['lessons'] = $this->lessonModel->getLessonsBySubjectId($subject['id']);
            }
        }

        renderView("view/subject/subject_show.php", compact('subjectsByCategory'), "All subjects by Category");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";

            $validate = new Validate();

            // Lấy dữ liệu từ form
            $category_id = $_POST['category_id'] ?? '';
            $user_id = $_SESSION['user']['id'];
            $name = $_POST['name'] ?? '';
            $image = $_POST['image'] ?? '';
            $price = $_POST['price'] ?? 0;
            $sku = $_POST['sku'] ?? '';
            $status = $_POST['status'] ?? 'active';
            $description = $_POST['description'] ?? '';

            // Kiểm tra dữ liệu đầu vào
            $validate->checkRequired('category_id', $category_id, "Subject category is required.");
            $validate->checkRequired('name', $name, "Subject name is required.");
            $validate->checkRequired('image', $image, "Image is required.");
            $validate->checkRequired('price', $price, "Price is required.");
            $validate->checkRequired('sku', $sku, "SKU is required.");
            $validate->checkRequired('status', $status, "Status is required.");
            $validate->checkRequired('description', $description, "Description is required.");

            // Kiểm tra category_id có hợp lệ không
            $categoryModel = new CategoryModel();
            $categories = $categoryModel->getAllCategories();
            $validCategoryIds = array_column($categories, 'id');

            if (!in_array($category_id, $validCategoryIds)) {
                $validate->checkRequired('category_id', "Selected category does not exist.");
            }

            // Nếu không có lỗi, thêm môn học
            if ($validate->passed()) {
                $this->subjectsModel->createSubject($category_id, $user_id, $name, $image, $price, $sku, $status, $description);
                $_SESSION['success_message'] = "Subject created successfully!";
                header("Location: /subjects");
                exit;
            } else {
                // Nếu có lỗi, hiển thị lại form
                $errors = $validate->getErrors();
                renderAdminView("view/subject/subject_create.php", compact('errors', 'categories'), "Create Subject");
            }
        } else {
            // Hiển thị form tạo môn học với danh sách danh mục
            $categoryModel = new CategoryModel();
            $categories = $categoryModel->getAllCategories();
            renderAdminView("view/subject/subject_create.php", compact('categories'), "Create Subject");
        }
    }

    // Chỉnh sửa môn học
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = $_POST['category_id'] ?? '';
            $name = $_POST['name'] ?? '';
            $image = $_POST['image'] ?? '';
            $price = $_POST['price'] ?? 0;
            $sku = $_POST['sku'] ?? '';
            $status = $_POST['status'] ?? 'active';
            $description = $_POST['description'] ?? '';

            // Cập nhật môn học
            $this->subjectsModel->updateSubject($id, $category_id, $name, $image, $price, $sku, $status, $description);
            $_SESSION['success_message'] = "Subject updated successfully!";
            header("Location: /subjects");
            exit;
        } else {
            // Lấy thông tin môn học và danh mục
            $subject = $this->subjectsModel->getSubjectById($id);
            $categoryModel = new CategoryModel();
            $categories = $categoryModel->getAllCategories();
            renderAdminView("view/subject/subject_edit.php", compact('subject', 'categories'), "Edit Subject");
        }
    }

    // Xóa môn học
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->subjectsModel->deleteSubject($id);
            $_SESSION['success_message'] = "Subject deleted successfully!";
        }
        header("Location: /subjects");
        exit;
    }
    //hiển thị khoá học đã tham gia
    public function showCourse()
    {
        // Lấy user_id từ session
        $user_id = $_SESSION['user']['id'] ?? null;
        $limit = 6; // Số mục trên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
        // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
        if (!$user_id) {
            header("Location: /login");
            exit();
        }

        // Lấy danh sách khóa học theo user_id
        $courses = $this->subjectsModel->getSubjectsByUser($user_id);

        // Hiển thị view với danh sách khóa học
        renderView("view/user_subject/list.php", compact('courses'), "Course List");
    }

    public function subject_email()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        // Kiểm tra và làm sạch dữ liệu gửi từ form
        $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
        $image = isset($_POST['image']) ? htmlspecialchars(trim($_POST['image'])) : '';
        $sku = isset($_POST['sku']) ? htmlspecialchars(trim($_POST['sku'])) : '';

        // Gọi hàm gửi email
        $this->sendOrderEmail($user_id, $name, $image, $sku);

        // Sau khi gửi thành công, chuyển hướng về trang khóa học hoặc thông báo
        renderView("view/subject/subject_email.php");
        exit;
    }
    private function sendOrderEmail($user_id, $name, $image, $sku)
    {
        $user = (new AuthModel())->getAuthById($user_id);
        if (!$user || empty($user['email'])) {
            return;
        }

        $mail = new PHPMailer(true);
        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ebanythanh1@gmail.com'; // Thay bằng email của bạn
            $mail->Password   = 'frfwivokncfsmqci'; // Thay bằng mật khẩu ứng dụng
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Thông tin người gửi và người nhận
            $mail->setFrom('ebanythanh1@gmail.com', 'E-Learning System');
            $mail->addAddress($user['email'], $user['name']);

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = "Congratulations! You have successfully completed the course.";
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px;'>
            <div style='max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>

            <div style='padding: 20px 30px; text-align: center; background-color: #5FCF80; color: white;'>
            <h2 style='margin: 0;'>🎓 Chứng Nhận Hoàn Thành</h2>
            </div>

            <div style='padding: 30px;'>
            <h3 style='color: #333;'>Xin chúc mừng, {$user['name']}!</h3>
            <p style='font-size: 16px; color: #555;'>
            Bạn đã hoàn thành khóa học <strong style='color: #5FCF80;'>$name</strong>. Đây là một thành tựu tuyệt vời và chúng tôi rất tự hào về bạn!
           </p>

           <div style='text-align: center; margin: 30px 0;'>
           <img src='$image' alt='Certificate Image' style='max-width: 100%; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);'>
           </div>

          <p style='font-size: 16px; color: #555;'>
          Chúng tôi hy vọng bạn đã có một trải nghiệm học tập tuyệt vời và mong sớm gặp lại bạn trong các khóa học tiếp theo.
          </p>

          <p style='margin-top: 40px; font-size: 14px; color: #999;'>
          Trân trọng,<br>
          <strong>Đội ngũ Hệ thống đào tạo</strong>
         </p>
       </div>

    </div>
  </div>
";
            // Gửi email
            $mail->send();
        } catch (Exception $e) {
            error_log("Không thể gửi email: " . $mail->ErrorInfo);
        }
    }
}
