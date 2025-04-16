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
}
?>
