<?php
// controllers/ProgressController.php

require_once 'model/ProgressModel.php';

class ProgressController {

    private $progressModel;

    public function __construct($pdo) {
        $this->progressModel = new Progress($pdo);
    }

    // Hiển thị tiến độ học
    public function showProgress($user_id, $course_id) {
        $progress = $this->progressModel->getProgress($user_id, $course_id);
        renderView("view/subject/subject_detail.php", compact('progress'));
    }

    // Cập nhật tiến độ học khi xem video
    public function updateVideoProgress($user_id, $course_id, $completed_lessons, $video_time) {
        $this->progressModel->updateProgress($user_id, $course_id, $completed_lessons, $video_time);
        echo "Tiến độ đã được cập nhật.";
    }
}
?>
