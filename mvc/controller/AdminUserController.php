<?php
require_once "model/UserModel.php";
require_once "model/AuthModel.php";
require_once "model/SubjectModel.php";
require_once "view/helpers.php";

class AdminUserController
{
    private $userModel;
    private $authModel;

    private $subjectsModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->subjectsModel = new SubjectsModel();
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        $users = $this->userModel->getAllUser();
        renderMasterView("view/crud_users/list.php", compact('users'), "User List");
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
                $this->userModel->createUser($name, $email, $password, $role);
                $_SESSION['success_message'] = "product created successfully!";
                header("Location: /users_admin");
                exit;
            } else {
                renderMasterView("view/crud_users/create.php", compact('errors', 'name', 'email', 'password'), "Create user");
            }
        } else {
            renderMasterView("view/crud_users/create.php", [], "Create user");
        }
    }

    public function edit($id)
    {
        $auth = $this->authModel->getAuthById($id);
        if (!$auth) {
            $_SESSION['error_message'] = "Tài khoản không tồn tại!";
            header("Location: /users_admin");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";
            $validate = new Validate();

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $role = $_POST['role'];

            $validate->checkRequired('name', $name, "Tên không được để trống.");
            $validate->checkEmail('email', $email, "Email không hợp lệ.");

            if ($this->authModel->checkEmailExists($email, $id)) {
                $validate->addError('email', "Email đã tồn tại trong hệ thống.");
            }

            if ($validate->passed()) {
                if (!empty($password)) {
                    $password = password_hash($password, PASSWORD_BCRYPT);
                } else {
                    $password = $auth['password'];
                }

                if ($this->authModel->updateAuth($id, $name, $email,$role)) {
                    $_SESSION['success_message'] = "Cập nhật tài khoản thành công!";
                    header("Location: /users_admin");
                    exit;
                } else {
                    $errors = ["general" => "Có lỗi xảy ra khi cập nhật tài khoản."];
                }
            } else {
                $errors = $validate->getErrors();
            }

            renderMasterView("view/crud_users/edit.php", compact('auth', 'errors'), "Chỉnh sửa tài khoản");
        } else {
            renderMasterView("view/crud_users/edit.php", compact('auth'), "Chỉnh sửa tài khoản");
        }
    }
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->authModel->deleteAuth($id)) {
                $_SESSION['success_message'] = "Xóa tài khoản thành công!";
            } else {
                $_SESSION['error_message'] = "Không thể xóa tài khoản.";
            }
        }
        header("Location: /users_admin");
        exit;
    }
}
