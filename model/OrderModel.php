<?php
require_once "Database.php";

class OrderModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createOrder($user_id, $session_id, $total_price) {
        $query = "INSERT INTO orders (user_id, session_id, total_price, status) VALUES (:user_id, :session_id, :total_price, 'pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function addOrderItems($order_id, $items) {
        $query = "INSERT INTO order_items (order_id, subject_id, price) VALUES (:order_id, :subject_id, :price)";
        $stmt = $this->conn->prepare($query);
        
        foreach ($items as $item) {
            $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->bindParam(':subject_id', $item['subject_id'], PDO::PARAM_INT);
            $stmt->bindParam(':price', $item['price']);
            $stmt->execute();
        }
        return true;
    }

    public function getOrdersByUser($user_id) {
        $query = "SELECT o.id, o.total_price, o.created_at, o.status,
                         GROUP_CONCAT(oi.subject_id) as subject_ids,
                         GROUP_CONCAT(oi.price) as item_prices
                  FROM orders o
                  LEFT JOIN order_items oi ON o.id = oi.order_id
                  WHERE o.user_id = :user_id
                  GROUP BY o.id, o.total_price, o.created_at, o.status
                  ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Phương thức cập nhật trạng thái đơn hàng
    public function updateOrderStatus($order_id, $status) {
        $query = "UPDATE orders SET status = :status WHERE id = :order_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Phương thức thêm đánh giá
    public function addReview($order_id, $user_id, $rating, $comment) {
        $query = "INSERT INTO reviews (order_id, user_id, rating, comment) VALUES (:order_id, :user_id, :rating, :comment)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        return $stmt->execute();
    }
// Phương thức kiểm tra xem đơn hàng đã được đánh giá chưa
    public function hasReview($order_id, $user_id) {
        $query = "SELECT COUNT(*) FROM reviews WHERE order_id = :order_id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function getAllOrders() {
        $query = "SELECT o.id, o.total_price, o.created_at, o.status,
                         GROUP_CONCAT(oi.subject_id) as subject_ids,
                         GROUP_CONCAT(oi.price) as item_prices
                  FROM orders o
                  LEFT JOIN order_items oi ON o.id = oi.order_id
                  GROUP BY o.id, o.total_price, o.created_at, o.status
                  ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllOrders1() {
        $query = "SELECT o.id, o.total_price, o.created_at, o.status,
                         GROUP_CONCAT(oi.subject_id) as subject_ids,
                         GROUP_CONCAT(oi.price) as item_prices
                  FROM orders o
                  LEFT JOIN order_items oi ON o.id = oi.order_id
                  GROUP BY o.id, o.total_price, o.created_at, o.status
                  ORDER BY o.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>