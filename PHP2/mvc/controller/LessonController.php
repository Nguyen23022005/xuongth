<?php
require_once "model/LessonModel.php";
require_once "view/helpers.php";

class LessonController
{
    private $lessonsModel;

    public function __construct()
    {
        $this->lessonsModel = new LessonsModel();
    }

    public function index()
    {
        $lessons = $this->lessonsModel->getAllLessons();
        renderAdminView("view/lesson/lesson_list.php", compact('lessons'), "Lessons List");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";

            $validate = new Validate();

            $subject_id = $_POST['subject_id'] ?? '';
            $title = $_POST['title'] ?? '';
            $video = $_POST['video'] ?? '';
            $status = $_POST['status'] ?? '';

            // Kiểm tra dữ liệu đầu vào
            $validate->checkRequired('subject_id', $subject_id, "Subject ID is required.");
            $validate->checkRequired('title', $title, "Title is required.");
            $validate->checkRequired('video', $video, "Video URL is required.");
            $validate->checkRequired('status', $status, "Status is required.");

            // Kiểm tra tính hợp lệ của subject_id
            $subjectModel = new SubjectsModel();
            $subjects = $subjectModel->getAllSubjects();
            $validSubjectIds = array_column($subjects, 'id');

            if (!in_array($subject_id, $validSubjectIds)) {
                $validate->checkRequired('subject_id', "Selected subject does not exist.");
            }

            if ($validate->passed()) {
                // Thêm bài học vào cơ sở dữ liệu
                $this->lessonsModel->createLesson($subject_id, $title, $video, $status);
                $_SESSION['success_message'] = "Lesson created successfully!";
                header("Location: /lessons");
            } else {
                $errors = $validate->getErrors();
                renderAdminView("view/lesson/lesson_create.php", compact('errors', 'subjects'), "Create Lesson");
            }
        } else {
            // Lấy danh sách subjects để hiển thị trong form
            $subjectModel = new SubjectsModel();
            $subjects = $subjectModel->getAllSubjects();

            renderAdminView("view/lesson/lesson_create.php", compact('subjects'), "Create Lesson");
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $subject_id = $_POST['subject_id'] ?? '';
            $title = $_POST['title'] ?? '';
            $video = $_POST['video'] ?? '';
            $status = $_POST['status'] ?? '';

            // Cập nhật bài học
            $this->lessonsModel->updateLesson($id, $subject_id, $title, $video, $status);
            $_SESSION['success_message'] = "Lesson updated successfully!";
            header("Location: /lessons");
            exit;
        } else {
            // Lấy thông tin bài học
            $lesson = $this->lessonsModel->getLessonById($id);

            // Lấy danh sách các môn học (subjects)
            $subjectModel = new SubjectsModel();
            $subjects = $subjectModel->getAllSubjects();

            // Hiển thị form chỉnh sửa với dữ liệu cần thiết
            renderAdminView("view/lesson/lesson_edit.php", compact('lesson', 'subjects'), "Edit Lesson");
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->lessonsModel->deleteLesson($id);
            $_SESSION['success_message'] = "Lesson deleted successfully!";
            header("Location: /lessons");
            exit;
        } else {
            header("Location: /lessons");
            exit;
        }
    }
}
