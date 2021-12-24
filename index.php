<?php

session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

require_once ("controller/MainController.php");
require_once ("controller/ArticleController.php");

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";


$urls = [
    "" => function () {
        MainController::index();
    },
    "product" => function () {
        MainController::product();
    },
    "checkout" => function() {
        MainController::checkout();
    },
    "cart" => function() {
        MainController::cart();
    },
    "signin" => function() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            MainController::verifySignIn();
        }
        else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            MainController::signin();
        }
    },
    "signup" => function() {
        MainController::signup();
    },
    "control-panel" => function() {
        MainController::controlPanel();
    },
    "add-article" => function() {
        if  ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArticleController::add();
        } else {
            ArticleController::addForm();
        }
    },
    "profile" => function() {
        MainController::profile();
    },
    "logout" => function() {
        MainController::logout();
    },
    "change_password" => function() {
        MainController::change_password();
    },
    "update_user" => function() {
        MainController::update_user();
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