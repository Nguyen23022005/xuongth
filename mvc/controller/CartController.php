<?php
require_once "model/CartModel.php";
require_once "model/SubjectModel.php";
require_once 'model/AuthModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer

class CartController
{
    private $cartModel;
    private $subjectModel;
    private $authModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->subjectModel = new SubjectsModel();
        $this->authModel = new AuthModel();
    }

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
    public function checkoutCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";
            $validate = new Validate();

            $subject_id   = $_POST['subject_id'] ?? null;
            $user_id      = $_SESSION['user']['id'] ?? null;
            $categories_id = $_POST['categories_id'] ?? null;
            $name         = $_POST['name'] ?? '';
            $image        = $_POST['image'] ?? '';
            $price        = $_POST['final_price'] ?? 0;
            $sku          = $_POST['sku'] ?? '';
            $description  = $_POST['description'] ?? '';
            $status       = 'Đã Tham Gia';
            $pttt         = $_POST['pttt'] ?? 'cod';

            $validate->checkRequired('subject_id', $subject_id, "Vui lòng chọn khóa học.");
            $validate->checkRequired('final_price', $price, "Giá không hợp lệ.");

            if ($validate->passed()) {
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

                // Gửi email xác nhận đơn hàng
                $this->sendOrderEmail($user_id, $order_id, $name, $price);

                // Xử lý thanh toán theo phương thức
                switch ($pttt) {
                    case 'vnpay':
                        $this->processVNPay($order_id, $price);
                        break;
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
                $errors = $validate->getErrors();
                renderView("view/Cart/checkout.php", compact('errors'), "Thanh toán");
            }
        } else {
            renderView("view/Cart/checkout.php", [], "Thanh toán");
        }
    }

    private function sendOrderEmail($user_id, $order_id, $subject_name, $total_price)
    {
        $user = (new AuthModel())->getAuthById($user_id);
        if (!$user || empty($user['email'])) {
            return;
        }

        $mail = new PHPMailer(true);
        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'baotrinhvan54@gmail.com'; // Thay bằng email của bạn
            $mail->Password   = 'gwqnmcsoghpxxlwn'; // Thay bằng mật khẩu ứng dụng
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Thông tin người gửi và người nhận
            $mail->setFrom('baotrinhvan54@gmail.com', 'E-Learning System');
            $mail->addAddress($user['email'], $user['name']);

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = "Congratulations! You have successfully completed the course.";
            $mail->Body    = "
            <h3>Chào {$user['name']},</h3>
            <p>Bạn đã đăng ký khóa học <strong>$subject_name</strong> thành công!</p>
            <p>Chúng tôi hy vọng bạn sẽ có trải nghiệm học tập tuyệt vời.</p>
            <p>Trân trọng,<br>Hệ thống đào tạo</p>
            ";

            // Gửi email
            $mail->send();
        } catch (Exception $e) {
            error_log("Không thể gửi email: " . $mail->ErrorInfo);
        }
    }

    private function processVNPay($order_id, $amount)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/";
        $vnp_TmnCode = "HEDQ3E2I"; // Thay bằng mã của bạn
        $vnp_HashSecret = "H3E9ZUJ92KEGYSW8NK9HEJHZ2B3VLS3B"; // Thay bằng key của bạn

        $vnp_TxnRef = time();
        $vnp_OrderInfo = "Thanh toán đơn hàng #$order_id";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $amount * 100; // VNPAY yêu cầu đơn vị là VND x100
        $vnp_Locale = "vn";
        $vnp_BankCode = "";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $vnp_IpAddr,
            "vnp_Locale"     => $vnp_Locale,
            "vnp_OrderInfo"  => $vnp_OrderInfo,
            "vnp_OrderType"  => $vnp_OrderType,
            "vnp_ReturnUrl"  => $vnp_Returnurl,
            "vnp_TxnRef"     => $vnp_TxnRef,
        ];

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }
}
