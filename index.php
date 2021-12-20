<?php

session_start();

require_once ("controller/MainController.php");

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