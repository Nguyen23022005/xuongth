<?php
session_start();

require_once "controller/AuthController.php";
require_once "controller/CategoryController.php";
require_once "controller/SubjectController.php";
require_once "controller/LessonController.php";
require_once "controller/CartController.php";
require_once "controller/DiscountController.php";
require_once "controller/TestController.php";
require_once "controller/UserController.php";
require_once "controller/CommentController.php";



require_once "router/Router.php";
require_once "middleware.php";


$router = new Router();
$authController = new AuthController();
$categoryController = new CategoryController();
$subjectsController = new SubjectController();
$lessonController = new LessonController();
$cartController = new CartController();
$discountController = new DiscountController();
$testController = new TestController();
$userController = new UserController();
$commentController = new CommentController();


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

$router->addRoute("/profile", [$userController, "index"]);
$router->addRoute("/profile/edit/{id}", [$userController, "edit"]);

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
$router->addRoute("/subjects/detail/{id}", [$subjectsController, "admin_index"]);
$router->addRoute("/subjects/quiz/{id}", [$subjectsController, "quiz_index"]);
$router->addRoute("/Course", [$subjectsController, "showCourse"]);
$router->addRoute("/", [$subjectsController, "shows"]);

$router->addRoute("/subjects_getall", [$subjectsController, "showAllByCategory"]);

//Danh mục bài học
$router->addRoute("/lessons", [$lessonController, "index"], ['isAdmin']);
$router->addRoute("/lessons/create", [$lessonController, "create"]);
$router->addRoute("/lessons/edit/{id}", [$lessonController, "edit"]);
$router->addRoute("/lessons/delete/{id}", [$lessonController, "delete"]);

//Giỏ hàng
$router->addRoute("/carts", [$cartController, "index"]);
$router->addRoute("/carts/add", [$cartController, "create"]);
$router->addRoute("/carts/delete/{id}", [$cartController, "delete"]);
$router->addRoute("/carts/checkout/{id}", [$cartController, "show"], ['isUser']);
$router->addRoute("/carts/create", [$cartController, "checkoutCreate"]);


// 

$router->addRoute("/discounts", [$discountController, "index"]);
$router->addRoute("/discounts/create", [$discountController, "create"]);
$router->addRoute("/discounts/edit/{id}", [$discountController, "edit"]);
$router->addRoute("/discounts/delete/{id}", [$discountController, "delete"]);

//Test
$router->addRoute("/tests", [$testController, "index"]);
$router->addRoute("/tests/setup/{id}", [$testController, "tests_index"]);
$router->addRoute("/tests/create", [$testController, "create"]);

// 

$router->addRoute("/questions", [$testController, "questions"]);
$router->addRoute("/questions/create", [$testController, "questions_create"]);
$router->addRoute("/questions/setup/{id}", [$testController, "questions_index"]);
$router->addRoute("/questions/delete/{id}", [$testController, "deletequestions"]);
$router->addRoute("/tests/results", [$testController, "results"]);

// Comment routes
// $router->addRoute("/comments", [$commentController, "index"]);
$router->addRoute("/comments/{lessonId}", [$commentController, "index"]);
$router->addRoute("/comments/edit/{id}", [$commentController, "edit"]);
$router->addRoute("/comments/delete/{id}", [$commentController, "delete"]);
$router->addRoute("/comments/create/{lessonId}", [$commentController, "create"]);


$router->dispatch();
