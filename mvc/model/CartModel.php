<?php
require_once "Database.php";

class CartModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy danh sách giỏ hàng
    public function getCart($user_id, $session_id)
    {
        $condition = !empty($user_id) ? "c.user_id = :user_id" : "c.cart_session = :cart_session";

        $query = "
        SELECT c.*, s.name as subject_name, s.image, s.price
        FROM carts c
        INNER JOIN subjects s ON c.subject_id = s.id
        WHERE $condition
        ";

        $stmt = $this->conn->prepare($query);
        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $session_id, PDO::PARAM_STR);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm khóa học vào giỏ hàng
    public function addCart($user_id, $cart_session, $subject_id)
    {
        // Kiểm tra xem khóa học đã tồn tại trong giỏ hàng chưa
        $query = "SELECT id FROM carts WHERE subject_id = :subject_id AND (user_id = :user_id OR cart_session = :cart_session)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetch()) {
            return false; // Đã tồn tại
        }

        // Thêm mới vào giỏ hàng
        $query = "INSERT INTO carts (user_id, cart_session, subject_id) VALUES (:user_id, :cart_session, :subject_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Xóa khóa học khỏi giỏ hàng
    public function deleteCart($id)
    {
        $query = "DELETE FROM carts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Xóa toàn bộ giỏ hàng
    public function clearCart($user_id, $cart_session)
    {
        $condition = !empty($user_id) ? "user_id = :user_id" : "cart_session = :cart_session";

        $query = "DELETE FROM carts WHERE $condition";
        $stmt = $this->conn->prepare($query);
        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            $stmt->bindParam(':cart_session', $cart_session, PDO::PARAM_STR);
        }
        return $stmt->execute();
    }

    // Tính tổng giá tiền của giỏ hàng
    public function getTotalPrice($user_id, $cart_session)
    {
        $condition = !empty($user_id) ? "user_id = ?" : "cart_session = ?";
        $query = "SELECT SUM(s.price) AS total_price FROM carts c INNER JOIN subjects s ON c.subject_id = s.id WHERE $condition";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id ?? $cart_session]);
        $result = $stmt->fetch();
        return $result['total_price'] ?? 0;
    }
    public function createcheckout($code, $discount_value, $usage_limit, $end_date)
    {
        $query = "INSERT INTO user_subject (code,discount_value,usage_limit,end_date ) VALUES (:code,:discount_value,:usage_limit,:end_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':discount_value', $discount_value);
        $stmt->bindParam(':usage_limit', $usage_limit);
        $stmt->bindParam(':end_date', $end_date);
        return $stmt->execute();
    }

    public function createUserSubject($subject_id,$user_id,$categories_id,$name, $image, $price, $sku, $description, $status,$pttt)
    {
        $query = "INSERT INTO user_subjects (subject_id,user_id,categories_id, name, image, price, sku, description, status,pttt ) VALUES (:subject_id, :user_id, :categories_id, :name, :image, :price, :sku, :description, :status, :pttt)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':categories_id', $categories_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':pttt', $pttt);
        return $stmt->execute();
    }
}
       
?>
