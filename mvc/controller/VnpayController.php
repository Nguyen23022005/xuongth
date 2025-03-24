<?php
  class VnpayController {
    public function checkoutVnpay() {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://yourwebsite.com/carts/checkout"; // Thay bằng URL thực tế của bạn
        $vnp_TmnCode = "9MN5Z4ND"; // Mã website tại VNPAY
        $vnp_HashSecret = "XHUQBKQT84ZOAGST8NZOZQ64856U4BIR"; // Chuỗi bí mật

        // Lấy dữ liệu từ request
        $order_id = $_GET['order_id'] ?? rand(1000, 9999);
        $vnp_Amount = ($_GET['amount'] ?? 0) * 100; // Quy đổi sang đơn vị VNĐ x 100

        $vnp_TxnRef = $order_id; // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng #$order_id";
        $vnp_OrderType = "billpayment";
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
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
            "vnp_TxnRef"     => $vnp_TxnRef
        );

        if (!empty($vnp_BankCode)) {
            $inputData["vnp_BankCode"] = $vnp_BankCode;
        }

        // Sắp xếp theo key để tạo chuỗi kiểm tra hash
        ksort($inputData);
        $query = http_build_query($inputData);
        $hashdata = urldecode(http_build_query($inputData)); // Đúng format cho hash

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac("sha512", $hashdata, $vnp_HashSecret);
            $query .= "&vnp_SecureHash=" . $vnpSecureHash;
        }

        $vnp_Url .= "?" . $query;

        if (isset($_GET['redirect'])) {
            header("Location: " . $vnp_Url);
            exit();
        } else {
            echo json_encode([
                "code"    => "00",
                "message" => "success",
                "data"    => $vnp_Url
            ]);
        }
    }
}
