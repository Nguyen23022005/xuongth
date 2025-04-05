<?php
require_once "model/AuthModel.php";
require_once "view/helpers.php";

class AuthController
{
    private $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        $auth = $this->authModel->getAllAuth();
        renderAdminView("view/auth/list.php", compact('auth'), "Danh sách tài khoản");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";
            $validate = new Validate();

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $validate->checkRequired('name', $name, "Tên không được để trống.");
            $validate->checkEmail('email', $email, "Email không hợp lệ.");
            $validate->checkRequired('password', $password, "Mật khẩu không được để trống.");

            if ($this->authModel->checkEmailExists($email)) {
                $validate->addError('email', "Email đã tồn tại trong hệ thống.");
            }

            if ($validate->passed()) {
                if ($this->authModel->createAuth($name, $email, $password)) {
                    $_SESSION['success_message'] = "Tạo tài khoản thành công!";
                    header("Location: /auth");
                    exit;
                } else {
                    $errors = ["general" => "Có lỗi xảy ra khi tạo tài khoản."];
                }
            } else {
                $errors = $validate->getErrors();
            }

            renderAdminView("view/auth/create.php", compact('errors'), "Tạo tài khoản");
        } else {
            renderAdminView("view/auth/create.php", [], "Tạo tài khoản");
        }
    }

    public function edit($id)
    {
        $auth = $this->authModel->getAuthById($id);
        if (!$auth) {
            $_SESSION['error_message'] = "Tài khoản không tồn tại!";
            header("Location: /auth");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";
            $validate = new Validate();

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

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

                if ($this->authModel->updateAuth($id, $name, $email, $password)) {
                    $_SESSION['success_message'] = "Cập nhật tài khoản thành công!";
                    header("Location: /auth");
                    exit;
                } else {
                    $errors = ["general" => "Có lỗi xảy ra khi cập nhật tài khoản."];
                }
            } else {
                $errors = $validate->getErrors();
            }

            renderAdminView("view/auth/edit.php", compact('auth', 'errors'), "Chỉnh sửa tài khoản");
        } else {
            renderAdminView("view/auth/edit.php", compact('auth'), "Chỉnh sửa tài khoản");
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
        header("Location: /auth");
        exit;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";
            $validate = new Validate();

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $role = 'user';

            $validate->checkRequired('name', $name, "Tên không được để trống.");
            $validate->checkEmail('email', $email, "Email không hợp lệ.");
            $validate->checkRequired('password', $password, "Mật khẩu không được để trống.");

            if ($this->authModel->checkEmailExists($email)) {
                $validate->addError('email', "Email đã tồn tại trong hệ thống.");
            }

            if ($validate->passed()) {
                if ($this->authModel->register($name, $email, $password, $role)) {
                    $_SESSION['success_message'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                    header("Location: /login");
                    exit;
                } else {
                    $errors = ["general" => "Đăng ký thất bại."];
                }
            } else {
                $errors = $validate->getErrors();
            }

            renderView("view/auth/register.php", compact('errors'), "Đăng ký");
            return;
        }

        renderView("view/auth/register.php", [], "Đăng ký");
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";
            $validate = new Validate();

            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $validate->checkRequired('email', $email, "Email không được để trống.");
            $validate->checkEmail('email', $email, "Email không hợp lệ.");
            $validate->checkRequired('password', $password, "Mật khẩu không được để trống.");

            if ($validate->passed()) {
                $user = $this->authModel->login($email, $password);

                if ($user) {
                    $_SESSION['user'] = $user;
                    $_SESSION['user_id'] = $user['id'];
                    header("Location: /");
                    exit;
                } else {
                    $errors['login'] = "Sai email hoặc mật khẩu.";
                }
            } else {
                $errors = $validate->getErrors();
            }
        } else {
            $errors = [];
        }

        renderView("view/auth/login.php", compact('errors'), "Đăng nhập");
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit;
    }
}
