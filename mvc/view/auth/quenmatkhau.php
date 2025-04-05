<?php
$loi = "";
$thongbao = "";
if (isset($_POST['nutguiyeucau'])) {
    $email = $_POST['email'];
    $conn = new PDO("mysql:host=localhost;dbname=xuongth", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $cout = $stmt->rowCount();
    if ($cout == 0) {
        $loi = "Email không tồn tại trong hệ thống";
    } else {
        $matkhaumoi = substr( md5( rand(0,999999)) , 0, 8);
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$matkhaumoi, $email]);
        // echo "<script>alert('Mật khẩu mới của bạn là: $matkhaumoi');</script>";
        $kg = nickguimai($email, $matkhaumoi);
        if ($kg == true) {
            // header("location:thongbao.php");
            $thongbao = "Vui lòng kiểm tra email để lấy mật khẩu mới.";
        }


        

    }
}
?>
<?php
function nickguimai($email, $matkhaumoi){
    require "PHPMailer-master/src/PHPMailer.php"; 
    require "PHPMailer-master/src/SMTP.php"; 
    require 'PHPMailer-master/src/Exception.php'; 
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);//true:enables exceptions
    try {
        $mail->SMTPDebug = 0; //0,1,2: chế độ debug
        $mail->isSMTP();  
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';  //SMTP servers
        $mail->SMTPAuth = true; // Enable authentication
        $mail->Username = 'sangtmpk03780@gmail.com'; // SMTP username
        $mail->Password = 'kxhi khvj rkkq sfef';   // SMTP password
        $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
        $mail->Port = 465;  // port to connect to                
        $mail->setFrom('sangtmpk03780@gmail.com', 'nick final' ); 
        $mail->addAddress($email); 
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'gui lai mat khau';
        $noidungthu = "
        <h2>Yêu cầu đặt lại mật khẩu</h2>
        <p>Xin chào,</p>
        <p>Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản của mình. Dưới đây là mật khẩu mới của bạn:</p>
        <h3 style='color: red;'>Mật khẩu mới: <strong>{$matkhaumoi}</strong></h3>
        <hr>
        <p><strong>Chú ý:</strong> Đây là email tự động, vui lòng không trả lời.</p>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
    "; 
        $mail->Body = $noidungthu;
        $mail->smtpConnect( array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" >
<form style="width:500px;" class="border border-primary border-2 m-auto p-2" method="post">
  <h2 class="text-center">Quên mật khẩu</h2>
  <?php if ($loi != "") { ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $loi; ?>
  </div>
  <?php } ?>
    <?php if ($thongbao != ""): ?>
    <div class="alert alert-success" role="alert">
      <?= $thongbao ?>
    </div>
  <?php endif; ?>
  <div class="mb-3">
    <label for="email" class="form-label">nhap gmail</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <button type="submit" name="nutguiyeucau" class="btn btn-primary">Submit</button>
    <a href="/login" class="btn btn-primary">Quay lại</a>


</form>