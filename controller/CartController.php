<?php
require_once "model/CartModel.php";
require_once 'model/AuthModel.php';
require_once 'model/OrderModel.php';

class CartController
{
    private $cartModel;
    private $orderModel;
    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel();
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
    public function orderList()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        
        if (!$user_id) {
            $_SESSION['error'] = "Vui lòng đăng nhập để xem danh sách đơn hàng!";
            header("Location: /login");
            exit();
        }

        $orders = $this->orderModel->getOrdersByUser($user_id);
        renderView("view/order/list.php", compact('orders'), "Danh sách đơn hàng");
    }
    public function orderListadmin()
    {
        $orders = $this->orderModel->getAllOrders1();
        renderView("view/order/listorderadmin.php", compact('orders'), "Danh sách đơn hàng
        ");
    }




    // Phương thức cập nhật trạng thái đơn hàng
    public function updateStatus($order_id) {
        $user_id = $_SESSION['user']['id'] ?? null;
        if (!$user_id) {
            $_SESSION['error'] = "Vui lòng đăng nhập!";
            header("Location: /login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? 'pending';
            if (in_array($status, ['pending', 'completed'])) {
                $this->orderModel->updateOrderStatus($order_id, $status);
                $_SESSION['success'] = "Cập nhật trạng thái thành công!";
            } else {
                $_SESSION['error'] = "Trạng thái không hợp lệ!";
            }
            header("Location: /orders");
            exit();
        }
    }

    // Phương thức xử lý đánh giá
    public function review($order_id) {
        $user_id = $_SESSION['user']['id'] ?? null;
        if (!$user_id) {
            $_SESSION['error'] = "Vui lòng đăng nhập để đánh giá!";
            header("Location: /login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->orderModel->hasReview($order_id, $user_id)) {
                $_SESSION['error'] = "Bạn đã đánh giá đơn hàng này rồi!";
            } else {
                $rating = (int)($_POST['rating'] ?? 0);
                $comment = $_POST['comment'] ?? '';
                if ($rating >= 1 && $rating <= 5) {
                    $this->orderModel->addReview($order_id, $user_id, $rating, $comment);
                    $_SESSION['success'] = "Đánh giá đã được gửi thành công!";
                } else {
                    $_SESSION['error'] = "Điểm đánh giá phải từ 1 đến 5!";
                }
}
            header("Location: /orders");
            exit();
        }
    }
    

    public function checkout() {
        $user_id = $_SESSION['user']['id'] ?? null;
        $session_id = session_id();
        $carts = $this->cartModel->getCart($user_id, $session_id);
        
        if (empty($carts)) {
            $_SESSION['error'] = "Giỏ hàng trống!";
            header("Location: /carts");
            exit();
        }

        $total_price = $this->cartModel->getTotalPrice($user_id, $session_id);
        renderView("view/checkout/checkout.php", compact('carts', 'total_price'), "Thanh toán");
    }

    public function processCheckout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user']['id'] ?? null;
            $session_id = session_id();
            $carts = $this->cartModel->getCart($user_id, $session_id);
            
            if (empty($carts)) {
                $_SESSION['error'] = "Giỏ hàng trống!";
                header("Location: /carts");
                exit();
            }

            $total_price = $this->cartModel->getTotalPrice($user_id, $session_id);
            
            // Create order
            $order_id = $this->orderModel->createOrder($user_id, $session_id, $total_price);
            
            // Prepare order items
            $order_items = array_map(function($cart) {
                return [
                    'subject_id' => $cart['subject_id'],
                    'price' => $cart['price']
                ];
            }, $carts);
            
            // Save order items
            $this->orderModel->addOrderItems($order_id, $order_items);
            
            // Clear cart after successful order
            $this->cartModel->clearCart($user_id, $session_id);
            
            $_SESSION['success'] = "Đơn hàng đã được đặt thành công!";
            header("Location: /order-success"); // You might want to create a success page
            exit();
        }
    }

    public function orderSuccess() {
        // Check if there's a success message from the checkout process
        if (!isset($_SESSION['success'])) {
            header("Location: /carts");
            exit();
        }
        renderView("view/checkout/success.php", [], "Đặt hàng thành công");
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
}