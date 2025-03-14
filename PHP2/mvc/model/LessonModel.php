<?php
require_once "Database.php";

class LessonsModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy tất cả bài học
    public function getAllLessons()
    {
        $query = "
            SELECT 
                lessons.*, 
                subjects.name AS subject_name
            FROM lessons
            LEFT JOIN subjects ON lessons.subject_id = subjects.id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    // Lấy bài học theo ID
    public function getLessonById($id)
    {
        $query = "SELECT * FROM lessons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLessonsBySubjectId($subject_id)
    {
        $query = "SELECT id, title, video, status 
                  FROM lessons 
                  WHERE subject_id = :subjectId";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':subjectId', $subject_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    // Thêm bài học mới
    public function createLesson($subject_id, $title, $video, $status)
    {
        $query = "INSERT INTO lessons (subject_id, title, video, status) 
                  VALUES (:subject_id, :title, :video, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':video', $video, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Cập nhật bài học
    public function updateLesson($id, $subject_id, $title, $video, $status)
    {
        $query = "UPDATE lessons 
                  SET subject_id = :subject_id, title = :title, video = :video, status = :status 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':video', $video, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Xóa bài học
    public function deleteLesson($id)
    {
        $query = "DELETE FROM lessons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
