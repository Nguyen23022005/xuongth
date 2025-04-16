<?php
require_once "Database.php";

class TestModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAlltests()
    {
        $query = "SELECT * FROM tests";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllquestions()
    {
        $query = "SELECT * FROM questions";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTestGroupedByCategory()
    {
        $query = "
        SELECT subjects.*, categories.name AS category_name, categories.id AS category_id
        FROM subjects
        LEFT JOIN categories ON subjects.category_id = categories.id
        ORDER BY categories.id
    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nhóm sản phẩm theo danh mục
        $groupedsubjects = [];
        foreach ($subjects as $subject) {
            $groupedsubjects[$subject['category_name']][] = $subject;
        }

        return $groupedsubjects;
    }

    public function getTestById($id)
    {
        $query = "SELECT * FROM tests WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getQuestionsById($id)
    {
        $query = "SELECT * FROM questions WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // public function createTest($lessons_id, $title)
    // {
    //     $query = "INSERT INTO tests (lessons_id, title) VALUES (:lessons_id, :title)";
    //     $query = "INSERT INTO progresses";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':lessons_id', $lessons_id);
    //     $stmt->bindParam(':title', $title);
    //     return $stmt->execute();
    // }

    public function createTest($lessons_id, $title)
{
    try {
        // Bắt đầu transaction
        $this->conn->beginTransaction();

        // 1. Thêm bài test mới vào bảng tests
        $query1 = "INSERT INTO tests (lessons_id, title) VALUES (:lessons_id, :title)";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bindParam(':lessons_id', $lessons_id);
        $stmt1->bindParam(':title', $title);
        $stmt1->execute();

        // 2. Cập nhật tăng number_test trong bảng progresses
        $query2 = "UPDATE progresses SET number_test = number_test + 1 WHERE subject_id = (
                        SELECT subject_id FROM lessons WHERE id = :lessons_id
                    )";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bindParam(':lessons_id', $lessons_id);
        $stmt2->execute();

        // Hoàn tất transaction
        $this->conn->commit();
        return true;
    } catch (PDOException $e) {
        // Rollback nếu có lỗi
        $this->conn->rollBack();
        error_log("Create test failed: " . $e->getMessage());
        return false;
    }
}

    public function createQuestions($tests_id, $questions_text, $option_a, $option_b, $option_c, $option_d, $correct_option)
    {
        $query = "INSERT INTO questions (tests_id, questions_text, option_a,option_b, option_c, option_d, correct_option) VALUES (:tests_id, :questions_text, :option_a, :option_b, :option_c, :option_d, :correct_option)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tests_id', $tests_id);
        $stmt->bindParam(':questions_text', $questions_text);
        $stmt->bindParam(':option_a', $option_a);
        $stmt->bindParam(':option_b', $option_b);
        $stmt->bindParam(':option_c', $option_c);
        $stmt->bindParam(':option_d', $option_d);
        $stmt->bindParam(':correct_option', $correct_option);
        return $stmt->execute();
    }

    public function updateTest($id, $lessons_id, $title)
    {
        $query = "UPDATE tests SET lessons_id = :lessons_id, title = :title WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':lessons_id', $lessons_id);
        $stmt->bindParam(':title', $title);
        return $stmt->execute();
    }

    public function updateQuestions($id, $tests_id, $questions_text, $option_a, $option_b, $option_c, $option_d, $corect_option)
    {
        $query = "UPDATE questions SET tests_id = :tests_id, questions_text = :questions_text, option_a = :option_a, option_b = :option_b, option_c = :option_c, option_d = :option_d, corect_option = :corect_option WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tests_id', $tests_id);
        $stmt->bindParam(':questions_text', $questions_text);
        $stmt->bindParam(':option_a', $option_a);
        $stmt->bindParam(':option_b', $option_b);
        $stmt->bindParam(':option_c', $option_c);
        $stmt->bindParam(':option_d', $option_d);
        $stmt->bindParam(':corect_option', $corect_option);
        return $stmt->execute();
    }

    public function deleteTest($id)
    {
        $query = "DELETE FROM tests WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteQuestions($id)
    {
        $query = "DELETE FROM questions WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getQuestionsForUser($test_id, $user_id)
    {
        $query = "
            SELECT 
                q.*, 
                ua.selected_option AS user_answer  -- Lấy câu trả lời của người dùng nếu có
            FROM questions q
            LEFT JOIN user_answers ua 
                ON q.id = ua.question_id 
                AND ua.user_id = :user_id
            WHERE q.tests_id = :test_id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':test_id', $test_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isValidQuestionId($question_id)
    {
        $query = "SELECT COUNT(*) FROM questions WHERE id = :question_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function saveUserAnswer($user_id, $subject_id, $test_id, $question_id, $selected_option)
    {
        // if (!$this->isValidQuestionId($question_id)) {
        //     throw new Exception("Question ID không hợp lệ.");
        // }

        // Thêm câu trả lời vào bảng user_answers
        $query = "INSERT INTO user_answers (user_id, subject_id, test_id, question_id, selected_option) 
              VALUES (:user_id, :subject_id, :test_id, :question_id, :selected_option)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
        $stmt->bindParam(':test_id', $test_id, PDO::PARAM_INT);
        $stmt->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $stmt->bindParam(':selected_option', $selected_option);

        $success = $stmt->execute();

        // Nếu thêm câu trả lời thành công, cập nhật progress
        if ($success) {
            $updateQuery = "UPDATE progresses 
                        SET number_submit = number_submit + 1 
                        WHERE user_id = :user_id AND subject_id = :subject_id";
            $updateStmt = $this->conn->prepare($updateQuery);
            $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $updateStmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $updateStmt->execute();
        }

        return $success;
    }
}
