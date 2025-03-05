<?php
require_once "model/UserModel.php";
require_once "view/helpers.php";

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Validation
            if (empty($name)) {
                $errors['name'] = "Name is required.";
            }
            if (empty($email)) {
                $errors['email'] = "Email is required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }
            if (empty($password)) {
                $errors['password'] = "Password is required.";
            } elseif (strlen($password) < 6) {
                $errors['password'] = "Password must be at least 6 characters long.";
            }
            

            if (empty($errors)) {
                if ($this->userModel->register($name, $email, $password)) {
                    header("Location: /login");
                    exit;
                } else {
                    $errors['general'] = "Registration failed. Email may already be in use.";
                }
            }
        }
        renderView("view/auth/register.php", compact('errors'), "Register");
    }

    public function login() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Validation
            if (empty($email)) {
                $errors['email'] = "Email is required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }
            if (empty($password)) {
                $errors['password'] = "Password is required.";
            }

            if (empty($errors)) {
                // Kiểm tra tài khoản quản trị cố định
                if ($email === 'admin@gmail.com' && $password === 'admin123') {
                    $_SESSION['user'] = [
                        'name' => 'Admin',
                        'email' => $email,
                        'role' => 'admin'
                    ];
                    header("Location: /products");
                    exit;
                }

                // Kiểm tra tài khoản từ cơ sở dữ liệu
                $user = $this->userModel->login($email, $password);
                if ($user) {
                    $_SESSION['user'] = $user;
                    header("Location: /users");
                    exit;
                } else {
                    $errors['general'] = "Invalid email or password.";
                }
            }
        }
        renderView("view/auth/login.php", compact('errors'), "Login");
    }

    public function logout() {
        session_destroy();
        header("Location: /login");
        exit;
    }

    public function dashboard() {
        if (!isset($_SESSION['user'])) {
            header("Location: /users");
            exit;
        }

        $user = $_SESSION['user'];
        renderView("googlelogin/dashboard.php", compact('user'), "Dashboard");
    }
}
