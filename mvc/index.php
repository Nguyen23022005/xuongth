<?php
session_start();

require_once "controller/AuthController.php";
require_once "controller/UserController.php";

require_once "router/Router.php";
require_once "middleware.php";


$router = new Router();
$userController = new UserController();
$authController = new AuthController();
$router->addMiddleware('logRequest');



//đăng nhập đăng ký , đăng xuất ...
$router->addRoute("/login", [$authController, "login"]);
$router->addRoute("/register", [$authController, "register"]);
$router->addRoute("/logout", [$authController, "logout"]);
$router->addRoute("/users", [$userController, "index"],  ['isAdmin']);
$router->addRoute("/users/create", [$userController, "create"], ['isAdmin']);
$router->addRoute("/users/{id}", [$userController, "show"], ['isUser'], ['isQuanly']);
$router->addRoute("/users/edit/{id}", [$userController, "edit"], ['isAdmin']);
$router->addRoute("/users/delete/{id}", [$userController, "delete"], ['isAdmin']);
$router->addRoute("/profile", [$userController, "profile"], ['isUser'], ['isQuanly']);



$router->dispatch();
?>