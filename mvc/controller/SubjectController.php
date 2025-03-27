<?php
require_once "model/SubjectModel.php";
require_once "model/LessonModel.php";
require_once "model/TestModel.php";
require_once "view/helpers.php";

class SubjectController
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
        renderAdminView("view/subject/subject_detail_admin.php", compact('subjects','lessons'), "subjects List", true);
    }
    public function quiz_index($id)
    {
        $tests = $this->testModel->getTestById($id);
        $questions = $this->testModel->getAllquestions();
        renderView("view/subject/subject_quiz.php", compact('tests','questions'), "subjects List", true);
    }

    public function show($id)
    {
        $subject = $this->subjectsModel->getSubjectById($id);
        $lessons = $this->lessonModel->getLessonsBySubjectId($id); // Lấy tất cả bài học của subject_id
        $tests = $this->testModel->getAlltests(); // Lấy tất cả bài kiểm tra của subject_id
        $questions = $this->testModel->getAllQuestions(); // L
        renderView("view/subject/subject_detail.php", compact('lessons', 'subject','tests','questions'), "Subject Detail");
    }

    public function shows()
{
    $limit = 6; // Số mục trên mỗi trang
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $subjects = $this->subjectsModel->getPaginatedSubjects($limit, $offset);
    $totalSubjects = $this->subjectsModel->getTotalSubjects();
    $totalPages = ceil($totalSubjects / $limit);

    renderView("view/subject/subject_show_2.php", compact('subjects', 'totalPages', 'page'));
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
                $this->subjectsModel->createSubject($category_id, $name, $image, $price, $sku, $status, $description);
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
}
