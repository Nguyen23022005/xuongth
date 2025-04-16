<?php
require_once "Database.php";

class Progress {
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy tiến độ của người học trong khóa học
    public function getProgressShow($user_id, $subjects_id) {
        $stmt = $this->conn->prepare("SELECT * FROM progresses WHERE user_id = :user_id AND subjects_id = :subjects_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':subjects_id', $subjects_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllAnswers()
    {
        $query = "SELECT * FROM user_answers";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProgress()
    {
        $query = "SELECT * FROM progresses";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createprogress($user_id,$subject_id,$number_test,$number_submit,$progress)
    {
        $query = "INSERT INTO progresses (user_id,subject_id,number_test,number_submit,progress) VALUES (:user_id, :subject_id, :number_test, :number_submit, :progress )";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->bindParam(':number_test', $number_test);
        $stmt->bindParam(':number_submit', $number_submit);
        $stmt->bindParam(':progress', $progress);
        return $stmt->execute();
    }
}
?>
