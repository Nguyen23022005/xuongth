<?php
require_once "model/UserModel.php";
require_once "view/helpers.php";

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->getAllUser();
        renderView("view/users/profile.php", compact('users'), "User List");
    }

    public function show($id)
    {
        $user = $this->userModel->getUserById($id);
        renderView("view/auth/detail.php", compact('user'), "User Detail");
    }

    public function create()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $role = trim($_POST['role']);

            // Validation
            if (empty($name)) {
                $errors['name'] = "Product name is required.";
            }
            if (empty($email)) {
                $errors['email'] = "user email is required.";
            }
            if (empty($password)) {
                $errors['password'] = "user email is required.";
            }
            if (empty($role)) {
                $errors['role'] = "user role is required.";
            }


            if (empty($errors)) {
                $this->userModel->createUser($name, $email, $password);
                $_SESSION['success_message'] = "product created successfully!";
                header("Location: /users");
                exit;
            } else {
                renderView("view/auth/create.php", compact('errors', 'name', 'email', 'password'), "Create user");
            }
        } else {
            renderView("view/auth/create.php", [], "Create user");
        }
    }

    public function edit($id)
{
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);

        // Lấy thông tin người dùng hiện tại
        $user = $this->userModel->getUserById($id);
        $image = $user['image']; // Giữ ảnh cũ nếu không upload ảnh mới

        // Kiểm tra nếu có file ảnh mới được tải lên
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "uploads/";
            $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            // Kiểm tra định dạng ảnh hợp lệ
            if (!in_array($imageFileType, $allowedTypes)) {
                $errors['image'] = "Chỉ chấp nhận các định dạng JPG, JPEG, PNG, GIF.";
            } else {
                $newFileName = uniqid() . "." . $imageFileType; // Tạo tên file mới tránh trùng lặp
                $targetFilePath = $targetDir . $newFileName;

                // Nếu có ảnh cũ thì xóa trước khi cập nhật ảnh mới
                if (!empty($user['image']) && file_exists($targetDir . $user['image'])) {
                    unlink($targetDir . $user['image']); // Xóa ảnh cũ
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                    $image = $newFileName; // Cập nhật tên ảnh mới
                } else {
                    $errors['image'] = "Có lỗi khi tải ảnh lên.";
                }
            }
        }

        // Validation
        if (empty($name)) {
            $errors['name'] = "Tên người dùng không được để trống.";
        }
        if (empty($email)) {
            $errors['email'] = "Email không được để trống.";
        }

        if (empty($errors)) {
            $this->userModel->updateUser($id, $name, $email, $image, $phone);
            $_SESSION['success_message'] = "Cập nhật thông tin thành công!";
            header("Location: /profile/edit/$id");
            exit;
        } else {
            renderView("view/users/profile_edit.php", compact('errors', 'name', 'email', 'image'), "Chỉnh sửa người dùng");
        }
    } else {
        $user = $this->userModel->getUserById($id);
        renderView("view/users/profile_edit.php", compact('user'), "Chỉnh sửa người dùng");
    }
}

    public function delete($id)
    {
        $this->userModel->deleteUser($id);
        $_SESSION['success_message'] = "user deleted successfully!";
        header("Location: /users");
        exit;
    }
}
