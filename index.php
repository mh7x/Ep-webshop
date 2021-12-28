<?php

session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

require_once ("controller/MainController.php");
require_once ("controller/ArticleController.php");
require_once ("controller/OrderController.php");
require_once ("controller/UserController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "" => function () {
        MainController::index();
    },
    "product" => function () {
        MainController::product();
    },
    "checkout" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            OrderController::add();
        } else {
            OrderController::checkout();
        }
    },
    "cart" => function () {
        OrderController::cart();
    },
    "summary" => function () {
        OrderController::summary();
    },
    "order-details" => function () {
        OrderController::order_details();
    },
    "order-edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            OrderController::edit_status();
        } else {
            OrderController::order_edit();
        }
    },
    "signin" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::verifySignIn();
        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            UserController::signin();
        }
    },
    "signup" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            UserController::signup();
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::create_user();
        }
    },
    "control-panel-seller" => function () {
        MainController::controlPanelSeller();
    },
    "control-panel-admin" => function () {
        MainController::controlPanelAdmin();
    },
    "add-seller" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            MainController::addSellerView();
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::addSeller();
        }
    },
    "product/add" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArticleController::add();
        } else {
            ArticleController::addForm();
        }
    },
    "profile" => function () {
        UserController::profile();
    },
    "logout" => function () {
        UserController::logout();
    },
    "change_password" => function () {
        UserController::change_password();
    },
    "update_user" => function () {
        UserController::update_user();
    },
    "update_customer" => function() {
        UserController::update_customer();
    },
    "product/edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArticleController::edit();
        } else {
            ArticleController::editForm();
        }
    },
    "product/delete" => function () {
        ArticleController::delete();
    },
    "product/rate" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArticleController::rate();
        }
    },
    "seller/edit" => function () {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            UserController::editSeller();
        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            UserController::editForm();
        }
    },
    "seller/delete" => function () {
        UserController::deleteSeller();
    }
];

try {
    if (isset($urls[$path])) {
        $urls[$path]();
    } else {
        echo "No controller for '$path'";
    }
} catch (InvalidArgumentException $e) {
    echo "$path";
    ViewHelper::error404();
} catch (Exception $e) {
    echo "An error occurred: <pre>$e</pre>";
} 