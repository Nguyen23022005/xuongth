<style>
    .certificate-success {
        max-width: 600px;
        margin: 60px auto;
        background: #f8fff9;
        border: 2px solid #5FCF80;
        border-radius: 16px;
        text-align: center;
        padding: 40px 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        animation: fadeIn 0.8s ease-in-out;
    }

    .certificate-success h2 {
        color: #2f855a;
        font-size: 28px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .certificate-success p {
        font-size: 16px;
        color: #444;
        margin-bottom: 30px;
    }

    .certificate-icon {
        font-size: 60px;
        color: #5FCF80;
        margin-bottom: 20px;
    }

    .btn-back-home {
        background-color: #5FCF80;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s ease-in-out;
    }

    .btn-back-home:hover {
        background-color: white;
        color: #5FCF80;
        border: 2px solid #5FCF80;
    }

    @keyframes fadeIn {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<div class="certificate-success">
    <div class="certificate-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <h2>Chúc mừng bạn!</h2>
    <p>Chứng chỉ đã được gửi đến email của bạn. Hãy kiểm tra hộp thư để nhận ngay!</p>
    <a href="/" class="btn-back-home">Quay về Trang Chủ</a>
</div>

<!-- Font Awesome Icon (chỉ cần thêm 1 lần ở header hoặc layout) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
