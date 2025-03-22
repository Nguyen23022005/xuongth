<?php
require_once "model/ProfileModel.php"; // Giả sử bạn có một UserModel để xử lý dữ liệu người dùng
// require_once "model/OrderModel.php"; // Giả sử bạn có một OrderModel để xử lý đơn hàng
require_once "view/helpers.php"; // Hàm hỗ trợ render view

class ProfileController
{
    private $userModel;
    // private $orderModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        // $this->orderModel = new OrderModel();
    }

    public function profile()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            $_SESSION['error_message'] = "Vui lòng đăng nhập để xem hồ sơ!";
            header("Location: /login");
            exit;
        }

        // Lấy thông tin người dùng từ session
        $userId = $_SESSION['user']['id'];
        $profile = $this->userModel->getUserById($userId);

        if (!$profile) {
            $_SESSION['error_message'] = "Không tìm thấy thông tin người dùng!";
            header("Location: /");
            exit;
        }

        // Lấy lịch sử đơn hàng
       

        // Render view với dữ liệu profile và orders
        renderView("view/auth/profile.php", compact('profile'), "Hồ sơ cá nhân");
    }

        // Lấy lịch sử đơn hàng
        // $orders = $this->orderModel->getOrdersByUserId($userId);

        public function edit($id)
        {
            if (!isset($_SESSION['user']) || $_SESSION['user']['id'] != $id) {
                $_SESSION['error_message'] = "Bạn không có quyền chỉnh sửa hồ sơ này!";
                header("Location: /profile/{$id}");
                exit;
            }
        
            $profile = $this->userModel->getUserById($id);
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $phone = trim($_POST['phone']);
                $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $profile['password'];
                $image = $profile['image']; // Giữ ảnh cũ nếu không upload ảnh mới
            
        
                // Xử lý upload ảnh
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = 'uploads/'; // Thư mục lưu ảnh
                    $fileName = basename($_FILES['image']['name']);
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
        
                    // Kiểm tra định dạng file
                    if (in_array($fileExt, $allowedExt)) {
                        $newFileName = uniqid() . '.' . $fileExt; // Tạo tên file duy nhất
                        $uploadPath = $uploadDir . $newFileName;
        
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                            $image = $uploadPath; // Cập nhật đường dẫn ảnh mới
                        } else {
                            $errors['image'] = "Không thể tải ảnh lên.";
                        }
                    } else {
                        $errors['image'] = "Chỉ chấp nhận file JPG, JPEG, PNG hoặc GIF.";
                    }
                }
        
                // Cập nhật thông tin người dùng
                if (empty($errors) && $this->userModel->updateUser($id, $name, $email, $phone, $password, $image)) {
                    $_SESSION['success_message'] = "Cập nhật hồ sơ thành công!";
                    header("Location: /profile/{$id}");
                    exit;
                } else {
                    $errors['general'] = $errors['general'] ?? "Có lỗi xảy ra khi cập nhật hồ sơ.";
                }
            }
        
            renderView("view/auth/edit_profile.php", compact('profile'), "Chỉnh sửa hồ sơ");
        }
    }