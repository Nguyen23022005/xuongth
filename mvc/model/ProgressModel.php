<?php
require_once "Database.php";

class Progress {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lấy tiến độ của người học trong khóa học
    public function getProgress($user_id, $subjects_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM progress WHERE user_id = :user_id AND subjects_id = :subjects_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':subjects_id', $subjects_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật tiến độ học
    public function updateProgress($user_id, $subjects_id, $completed_lessons, $video_time) {
        // Lấy tổng số bài học trong khóa học
        $stmt = $this->pdo->prepare("SELECT total_lessons FROM subjects WHERE subjects_id = :subjects_id");
        $stmt->bindParam(':subjects_id', $subjects_id);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_lessons = $course['total_lessons'];

        // Tính tỷ lệ tiến độ dựa trên số bài học và thời gian video xem
        $progress_percentage = ($completed_lessons / $total_lessons) * 100;

        // Cập nhật vào bảng progress
        $stmt = $this->pdo->prepare("UPDATE progress SET completed_lessons = :completed_lessons, progress_percentage = :progress_percentage, video_time = :video_time WHERE user_id = :user_id AND course_id = :course_id");
        $stmt->bindParam(':completed_lessons', $completed_lessons);
        $stmt->bindParam(':progress_percentage', $progress_percentage);
        $stmt->bindParam(':video_time', $video_time);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':subjects_id', $subjects_id);
        $stmt->execute();
    }
}
?>
