<?php
session_start();
require 'Database.php'; // Kết nối database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? 0;
    $lessonId = $_POST['lesson_id'] ?? 0;

    if ($userId && $lessonId) {
        $stmt = $conn->prepare("INSERT INTO progress (user_id, lesson_id, completed_at) VALUES (?, ?, NOW()) ON DUPLICATE KEY UPDATE completed_at = NOW()");
        $stmt->bind_param("ii", $userId, $lessonId);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Tiến độ đã được cập nhật.</div>";
        } else {
            echo "<div class='alert alert-danger'>Lỗi khi lưu tiến độ.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Dữ liệu không hợp lệ.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Phương thức không hợp lệ.</div>";
}
