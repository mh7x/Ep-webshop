<?php

session_start();

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
        MainController::signin();
    },
    "signup" => function() {
        MainController::signup();
    },
    "control-panel" => function() {
        MainController::controlPanel();
    },
    "product/add" => function() {
        if  ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArticleController::add();
        } else {
            ArticleController::addForm();
        }
    },
    "product/edit" => function() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            ArticleController::edit();
        } else {
            ArticleController::editForm();
        }
    },
    "product/delete" => function() {
        ArticleController::delete();
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