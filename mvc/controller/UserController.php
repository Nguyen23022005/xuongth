<?php
require_once "model/UserModel.php";
require_once "view/helpers.php";

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {
        $user = $this->userModel->getAllUser();
        renderView("view/auth/list.php", compact('user'), "User List");
    }

    public function show($id) {
        $user = $this->userModel->getUserById($id);
        renderView("view/auth/detail.php", compact('user'), "User Detail");
    }
   
    public function create() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

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

    public function edit($id) {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

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

            if (empty($errors)) {
                $this->userModel->createUser($name, $email, $password);
                $_SESSION['success_message'] = "user edit successfully!";
                header("Location: /users");
                exit;
            } else {
                $user = $this->userModel->getUserById($id);
                renderView("view/auth/edit.php", compact('errors',  'name', 'email', 'password'), "Edit user");
            }
        } else {
            $user = $this->userModel->getUserById($id);
            renderView("view/auth/edit.php", compact('user'), "Edit user");
        }
    }

    public function delete($id) {
        $this->userModel->deleteUser($id);
        $_SESSION['success_message'] = "user deleted successfully!";
        header("Location: /users");
        exit;
    }
}
