<?php
require_once "model/SubjectModel.php";
require_once "model/LessonModel.php";
require_once "model/TestModel.php";
require_once "view/helpers.php";

class TestController
{
    private $subjectsModel;
    private $lessonModel;
    private $testModel;

    public function __construct()
    {
        $this->subjectsModel = new SubjectsModel();
        $this->lessonModel = new LessonsModel();
        $this->testModel = new TestModel();
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

    public function tests_index($id)
    {
        $lessons = $this->lessonModel->getLessonById($id);
        $tests = $this->testModel->getAlltests();
        renderAdminView("view/tests/list.php", compact('lessons', 'tests'), "subjects List", true);
    }
    public function tests_create($id)
    {
        $lessons = $this->lessonModel->getLessonById($id);
        $tests = $this->testModel->getAlltests();
        renderAdminView("view/tests/create.php", compact('lessons', 'tests'), "subjects List", true);
    }
    public function questions_index($id)
    {
        $tests = $this->testModel->getTestById($id);
        $questions = $this->testModel->getAllquestions();
        renderAdminView("view/questions/create.php", compact('tests', 'questions'), "subjects List", true);
    }
    public function show($id)
    {
        $subject = $this->subjectsModel->getSubjectById($id);
        $lessons = $this->lessonModel->getLessonsBySubjectId($id); // Lấy tất cả bài học của subject_id
        renderView("view/subject/subject_detail.php", compact('lessons', 'subject'), "Subject Detail");
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
            $title = $_POST['title'] ?? '';
            $lessons_id = $_POST['lessons_id'];
            $validate->checkRequired('title', $title, "Tests name is required.");
            $validate->checkRequired('lessons_id', $lessons_id, "Lesson ID is required.");
            if ($validate->passed()) {
                $this->testModel->createTest($lessons_id, $title);
                $_SESSION['success_message'] = "Subject created successfully!";
                header("Location: /tests/setup/$lessons_id");
                exit;
            } else {
                // Nếu có lỗi, hiển thị lại form
                $errors = $validate->getErrors();
                renderAdminView("view/tests/create.php", compact('errors'), "Create Subject");
            }
        } else {
            // Hiển thị form tạo môn học với danh sách danh mục
            renderAdminView("view/tests/create.php", [], "Create Subject");
        }
    }

    // 

    public function questions_create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";
            $validate = new Validate();
            $tests_id = $_POST['tests_id'] ?? '';
            $questions_text = $_POST['questions_text'] ?? '';
            $option_a = $_POST['option_a'] ?? '';
            $option_b = $_POST['option_b'] ?? '';
            $option_c = $_POST['option_c'] ?? '';
            $option_d = $_POST['option_d'] ?? '';
            $correct_option = $_POST['correct_option'] ?? '';
            $validate->checkRequired('tests_id', $tests_id, "Tests ID is required.");
            $validate->checkRequired('questions_text', $questions_text, "Questions text is required.");
            $validate->checkRequired('option_a', $option_a, "Option A is required.");
            $validate->checkRequired('option_b', $option_b, "Option B is required.");
            $validate->checkRequired('option_c', $option_c, "Option C is required.");
            $validate->checkRequired('option_d', $option_d, "Option D is required.");
            $validate->checkRequired('correct_option', $correct_option, "Correct option is required.");
            if ($validate->passed()) {
                $this->testModel->createQuestions($tests_id, $questions_text, $option_a, $option_b, $option_c, $option_d, $correct_option);
                $_SESSION['success_message'] = "Subject created successfully!";
                header("Location: /questions/setup/$tests_id");
                exit;
            } else {
                // Nếu có lỗi, hiển thị lại form
                $errors = $validate->getErrors();
                renderAdminView("view/questions/create.php", compact('errors'), "Create Subject");
            }
        } else {
            // Hiển thị form tạo môn học với danh sách danh mục
            renderAdminView("view/tests/questions.php", [], "Create Subject");
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
            $lessons = $this->lessonModel->getAllLessons();
            $categoryModel = new CategoryModel();
            $categories = $categoryModel->getAllCategories();
            renderAdminView("view/subject/subject_edit.php", compact('subject', 'categories', 'lessons'), "Edit Subject");
        }
    }

    // Xóa môn học
    public function deletetests($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->testModel->deleteTest($id);
            $_SESSION['success_message'] = "Subject deleted successfully!";
        }
        header("Location: /subjects");
        exit;
    }
    public function deletequestions($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->testModel->deleteQuestions($id);
            $_SESSION['success_message'] = "Subject deleted successfully!";
        }
        header("Location: /subjects");
        exit;
    }

    // Xử lý bài kiểm tra và lưu câu trả lời của người dùng
    public function submitQuiz($test_id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $user_answers = json_decode($_POST['user_answers'], true);

        // Kiểm tra nếu câu trả lời có question_id hợp lệ
        foreach ($user_answers as $answer) {
            $question_id = $answer['question_id'];
            if (!$this->testModel->isValidQuestionId($question_id)) {
                throw new Exception("Question ID không hợp lệ.");
            }

            $this->testModel->saveUserAnswer($user_id, $test_id, $question_id, $answer['selected_option']);
        }

        // Chuyển hướng đến trang kết quả
        header("Location: /subjects/quiz/$test_id");
        exit;
    }
}
