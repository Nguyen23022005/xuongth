<?php
require_once "Database.php";

class CommentModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }


    public function getAllCommentsByLessonId($lessonId)
    {
        $query = "SELECT comments.*, users.name AS user_name 
                  FROM comments 
                  JOIN users ON comments.user_id = users.id 
                  WHERE lesson_id = :lesson_id 
                  ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':lesson_id', $lessonId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentById($id)
    {
        $query = "SELECT * FROM comments WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function createComment($lessonId, $userId, $content)
    {
        if (empty($lessonId) || empty($userId) || empty($content)) {
            return false; // Trả về false nếu dữ liệu không hợp lệ
        }

        $query = "INSERT INTO comments (lesson_id, user_id, content, created_at) VALUES (:lesson_id, :user_id, :content, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':lesson_id', $lessonId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':content', $content);

        if (!$stmt->execute()) {
            // Ghi log hoặc xử lý lỗi khi không thực thi được
            return false;
        }
        return true; // Trả về true nếu thành công
    }

    public function updateComment($id, $content)
    {
        $query = "UPDATE comments SET content = :content, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteComment($id)
    {
        $query = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
