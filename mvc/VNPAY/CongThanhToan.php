<?php
//config
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$vnp_TmnCode = "HEDQ3E2I"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "H3E9ZUJ92KEGYSW8NK9HEJHZ2B3VLS3B"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "https://github.com/";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));


//vnpay_create
$vnp_TxnRef = isset($_GET['order_id']) ? $_GET['order_id'] : rand(1, 10000);
$vnp_Amount = isset($_GET['amount']) ? (int)$_GET['amount'] * 100 : 0; // Số tiền phải nhân 100 theo yêu cầu VNPAY
$vnp_Locale = "vn";
$vnp_BankCode = ""; // Không bắt buộc, để trống nếu không chọn ngân hàng
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toan GD: " . $vnp_TxnRef,
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);

if (!empty($vnp_BankCode)) {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

// Sắp xếp mảng theo key để tạo chữ ký
ksort($inputData); // Sắp xếp key theo thứ tự alphabet

$hashdata = "";
$query = "";
foreach ($inputData as $key => $value) {
    if ($hashdata != "") {
        $hashdata .= "&";
    }
    $hashdata .= $key . "=" . $value;

    if ($query != "") {
        $query .= "&";
    }
    $query .= urlencode($key) . "=" . urlencode($value);
}

// Tạo chữ ký chuẩn
$vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

// Tạo URL chuyển hướng
$vnp_Url .= "?" . $query . "&vnp_SecureHash=" . $vnp_SecureHash;

// Chuyển hướng người dùng
header("Location: " . $vnp_Url);
exit();
