<?php
require_once "model/CartModel.php";
require_once "model/SubjectModel.php";
require_once 'model/AuthModel.php';
require_once "model/ProgressModel.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer

class CartController
{
    private $cartModel;
    private $subjectModel;
    private $authModel;
    private $lessonModel;
    private $testModel;
    private $progressModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->subjectModel = new SubjectsModel();
        $this->authModel = new AuthModel();
        $this->lessonModel = new LessonsModel();
        $this->testModel = new TestModel();
        $this->progressModel = new Progress();

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
        $lessons = $this->lessonModel->getAllLessons();
        // Lấy bài kiểm tra theo id
        $tests = $this->testModel->getAlltests();

        // Kiểm tra nếu môn học không tồn tại
        if (!$subject) {
            die("Môn học không tồn tại!");
        }

        // Hiển thị thông tin môn học (có thể dùng view)
        renderView("view/Cart/checkout.php", compact('subject','lessons','tests'), "Edit Subject");
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
        $number_submit = 0;
        $progress     = 0;
        $number_test  = $_POST['number_test'] ?? null;

        $validate->checkRequired('subject_id', $subject_id, "Vui lòng chọn khóa học.");
        $validate->checkRequired('final_price', $price, "Giá không hợp lệ.");

        if (!$validate->passed()) {
            $errors = $validate->getErrors();
            renderView("view/Cart/checkout.php", compact('errors'), "Thanh toán");
            return;
        }

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

        $this->progressModel->createprogress($user_id, $subject_id, $number_test, $number_submit, $progress);

        switch ($pttt) {
            case 'vnpay':
                $this->processVNPay($order_id, $price);
                return;

            case 'momo':
                header("Location: /checkout/momo?order_id=$order_id&amount=$price");
                exit();

            case 'paypal':
                header("Location: /checkout/paypal?order_id=$order_id&amount=$price");
                exit();

            case 'cod':
            default:
                $_SESSION['success_message'] = "Đơn hàng đã được đặt thành công! Thanh toán khi nhận hàng.";
                renderView("view/Cart/camon.php");
                break;
        }

        // Gửi email sau khi xử lý thanh toán
        $this->sendOrderEmail($user_id, $order_id, $name, $price);
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
            $mail->Username   = 'ebanythanh1@gmail.com'; // Thay bằng email của bạn
            $mail->Password   = 'frfwivokncfsmqci'; // Thay bằng mật khẩu ứng dụng
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Thông tin người gửi và người nhận
            $mail->setFrom('ebanythanh1@gmail.com', 'E-Learning System');
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
    $vnp_TmnCode = "1VYBIYQP";
    $vnp_HashSecret = "NOH6MBGNLQL9O9OMMFMZ2AX8NIEP50W1";

    $vnp_TxnRef = time();
    $vnp_OrderInfo = "Thanh toán đơn hàng #$order_id";
    $vnp_OrderType = "billpayment";
    $vnp_Amount = $amount * 100;
    $vnp_Locale = "vn";
    $vnp_BankCode = "";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $vnp_CreateDate = date('YmdHis');
    $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

    $inputData = [
        "vnp_Version"    => "2.1.0",
        "vnp_TmnCode"    => $vnp_TmnCode,
        "vnp_Amount"     => $vnp_Amount,
        "vnp_Command"    => "pay",
        "vnp_CreateDate" => $vnp_CreateDate,
        "vnp_ExpireDate" => $vnp_ExpireDate,
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
    $hashdata = "";

    foreach ($inputData as $key => $value) {
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
        $hashdata .= $key . "=" . $value . '&';
    }

    // Xóa dấu & cuối cùng trong hashdata
    $hashdata = rtrim($hashdata, '&');

    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= "?" . $query . "vnp_SecureHash=" . $vnpSecureHash;

    // Chuyển hướng tới trang thanh toán VNPAY
    header('Location: ' . $vnp_Url);
    exit();
}

    
}
