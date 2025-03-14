<?php
session_start();

require_once "controller/AuthController.php";
require_once "controller/CategoryController.php";
require_once "controller/SubjectController.php";
require_once "controller/LessonController.php";

require_once "router/Router.php";
require_once "middleware.php";


$router = new Router();
$authController = new AuthController();
$categoryController = new CategoryController();
$subjectsController = new SubjectController();
$lessonController = new LessonController();

$router->addRoute("/admin", function () {
    renderAdminView("view/layouts/dashboard.php", [], "Admin Dashboard");
}, ['isAdmin']);

$router->addMiddleware('logRequest');

//đăng nhập đăng ký , đăng xuất ...
$router->addRoute("/auth", [$authController, "index"], ['isAdmin']);
$router->addRoute("/auth/create", [$authController, "create"], ['isAdmin']);
$router->addRoute("/auth/edit/{id}", [$authController, "edit"]);
$router->addRoute("/auth/delete/{id}", [$authController, "delete"], ['isAdmin']);
$router->addRoute("/auth/forgotPW", [$authController, "forgotPassword"]);
$router->addRoute("/auth/profile", [$authController, "profile"]);

$router->addRoute("/login", [$authController, "login"]);
$router->addRoute("/logout", [$authController, "logout"]);
$router->addRoute("/register", [$authController, "register"]);

// $router->addRoute("/auth", [$userController, "index"],  ['isAdmin']);
// $router->addRoute("/auths/create", [$userController, "create"], ['isAdmin']);
// $router->addRoute("/auths/{id}", [$userController, "show"], ['isUser'], ['isQuanly']);
// $router->addRoute("/auths/edit/{id}", [$userController, "edit"], ['isAdmin']);
// $router->addRoute("/auths/delete/{id}", [$userController, "delete"], ['isAdmin']);
// $router->addRoute("/profile", [$userController, "profile"], ['isUser'], ['isQuanly']);

//Danh mục khóa học
$router->addRoute("/categories", [$categoryController, "index"], ['isAdmin']);
$router->addRoute("/categories/create", [$categoryController, "create"], ['isAdmin']);
$router->addRoute("/categories/edit/{id}", [$categoryController, "edit"], ['isAdmin']);
$router->addRoute("/categories/delete/{id}", [$categoryController, "delete"], ['isAdmin']);

//Danh mục môn học
$router->addRoute("/subjects", [$subjectsController, "index"], ['isAdmin']);
$router->addRoute("/subjects/create", [$subjectsController, "create"], ['isAdmin']);
$router->addRoute("/subjects/{id}", [$subjectsController, "show"]);
$router->addRoute("/subjects/edit/{id}", [$subjectsController, "edit"], ['isAdmin']);
$router->addRoute("/subjects/delete/{id}", [$subjectsController, "delete"], ['isAdmin']);
$router->addRoute("/", [$subjectsController, "showAllByCategory"]);

//Danh mục bài học
$router->addRoute("/lessons", [$lessonController, "index"], ['isAdmin']);
$router->addRoute("/lessons/create", [$lessonController, "create"]);
$router->addRoute("/lessons/edit/{id}", [$lessonController, "edit"]);
$router->addRoute("/lessons/delete/{id}", [$lessonController, "delete"]);

$router->dispatch();
?>