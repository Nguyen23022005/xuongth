<?php
require_once "model/CartModel.php";
require_once 'model/AuthModel.php';

class CartController
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    // Hiển thị giỏ hàng
    public function index()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $carts = $this->cartModel->getCart($user_id, $session_id);
        $total_price = $this->cartModel->getTotalPrice($user_id, $session_id);
        renderView("view/cart/list.php", compact('carts', 'total_price'), "Giỏ hàng");
    }

    // Thêm khóa học vào giỏ hàng
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user']['id'] ?? null;
            $cart_session = session_id();
            $subject_id = $_POST['subject_id'];

            if ($this->cartModel->addCart($user_id, $cart_session, $subject_id)) {
                $_SESSION['success'] = "Khóa học đã được thêm vào giỏ hàng!";
            } else {
                $_SESSION['error'] = "Khóa học này đã có trong giỏ hàng!";
            }

            header("Location: /carts");
            exit();
        }
    }

    // Xóa khóa học khỏi giỏ hàng
    public function delete($id)
    {
        $this->cartModel->deleteCart($id);
        $_SESSION['success'] = "Khóa học đã được xóa khỏi giỏ hàng!";
        header("Location: /carts");
        exit();
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $this->cartModel->clearCart($user_id, session_id());
        $_SESSION['success'] = "Đã xóa toàn bộ giỏ hàng!";
        header("Location: /carts");
        exit();
    }
}
?>
