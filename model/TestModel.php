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
    public function createTest($lessons_id, $title)
    {
        $query = "INSERT INTO tests (lessons_id, title) VALUES (:lessons_id, :title)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':lessons_id', $lessons_id);
        $stmt->bindParam(':title', $title);
        return $stmt->execute();
    }
    public function createQuestions($tests_id, $questions_text,$option_a,$option_b,$option_c,$option_d,$correct_option)
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

    public function updateQuestions($id,$tests_id, $questions_text,$option_a,$option_b,$option_c,$option_d,$corect_option)
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
}
