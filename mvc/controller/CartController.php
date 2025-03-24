<?php
require_once "model/CartModel.php";
require_once "model/SubjectModel.php";

require_once 'model/AuthModel.php';

class CartController
{
    private $cartModel;
    private $subjectModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->subjectModel = new SubjectsModel();
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

    public function show($id)
    {
        // Kiểm tra ID hợp lệ
        if (!is_numeric($id) || $id <= 0) {
            die("ID môn học không hợp lệ!");
        }

        // Lấy thông tin môn học từ Model
        $subject = $this->subjectModel->getSubjectById($id);

        // Kiểm tra nếu môn học không tồn tại
        if (!$subject) {
            die("Môn học không tồn tại!");
        }

        // Hiển thị thông tin môn học (có thể dùng view)
        renderView("view/Cart/checkout.php", compact('subject'), "Edit Subject");
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
    // public function checkout($id)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $category_id = $_POST['category_id'] ?? '';
    //         $name = $_POST['name'] ?? '';
    //         $image = $_POST['image'] ?? '';
    //         $price = $_POST['price'] ?? 0;
    //         $sku = $_POST['sku'] ?? '';
    //         $status = $_POST['status'] ?? 'active';
    //         $description = $_POST['description'] ?? '';

    //         // Cập nhật môn học
    //         $this->subjectModel->updateSubject($id, $category_id, $name, $image, $price, $sku, $status, $description);
    //         $_SESSION['success_message'] = "Subject updated successfully!";
    //         header("Location: /subjects");
    //         exit;
    //     } else {
    //         // Lấy thông tin môn học và danh mục
    //         $subject = $this->subjectModel->getSubjectById($id);
    //         $categoryModel = new CategoryModel();
    //         // $categories = $categoryModel->getAllCategories();
    //         renderView("view/Cart/checkout.php", compact('subject'), "Edit Subject");
    //     }
    // }

    public function checkoutCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";

            $validate = new Validate();
            $subject_id = $_POST['subject_id'];
            $user_id = $_SESSION['user']['id'];
            $categories_id = $_POST['categories_id'];
            $name = $_POST['name'];
            $image = $_POST['image'];
            $price = $_POST['final_price'];
            $sku = $_POST['sku'];
            $description = $_POST['description'];
            $status = 'Đã Tham Gia';
            $pttt = $_POST['pttt'];

            $validate->checkRequired('subject_id', $subject_id, "Subject ID is required.");

            if ($validate->passed()) {
                // Lưu đơn hàng vào database trước khi thanh toán
                $order_id = $this->cartModel->createUserSubject(
                    $subject_id,
                    $user_id,
                    $categories_id,
                    $name,
                    $image,
                    $price,
                    $sku,
                    $description,
                    $status,
                    $pttt
                );

                $_SESSION['success_message'] = "Đơn hàng đã được tạo thành công!";

                // Xử lý thanh toán dựa trên phương thức được chọn
                switch ($pttt) {
                    case 'vnpay':
                        header("Location: /checkout/vnpay?order_id=$order_id&amount=$price");
                        exit();
                    case 'momo':
                        header("Location: /checkout/momo?order_id=$order_id&amount=$price");
                        exit();
                    case 'paypal':
                        header("Location: /checkout/paypal?order_id=$order_id&amount=$price");
                        exit();
                    case 'cod':
                    default:
                        $_SESSION['success_message'] = "Đơn hàng đã được đặt thành công! Thanh toán khi nhận hàng.";
                        header("Location: /order-success?order_id=$order_id");
                        exit();
                }
            } else {
                // Nếu có lỗi, hiển thị lại form
                $errors = $validate->getErrors();
                renderView("view/Cart/checkout.php", compact('errors'), "Create Subject");
            }
        } else {
            // Hiển thị form thanh toán
            renderView("view/Cart/checkout.php", [], "Create Subject");
        }
    }
}
