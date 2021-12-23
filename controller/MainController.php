<?php

require_once("model/ArticleDB.php");
//require_once("model/UserDB.php");
require_once("ViewHelper.php");

class MainController {

    public static function index() {
        $data = ArticleDB::getAll();
        echo ViewHelper::render("view/index.php", ["articles" => $data]);
    }

    public static function product() {
        echo ViewHelper::render("view/product.php");
    }

    public static function cart() {
        echo ViewHelper::render("view/cart.php");
    }

    public static function checkout() {
        echo ViewHelper::render("view/checkout.php");
    }

    public static function signin() {
        echo ViewHelper::render("view/signin.php");
    }

    public static function signup() {
        echo ViewHelper::render("view/signup.php");
    }
    public static function verifySignIn() {
        
        $rules = [
            "email" => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            "password" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];

        $filteredData = filter_input_array(INPUT_POST, $rules);
        $user = ArticleDB::getLoginUser($filteredData);
        if ($user == NULL){
            $data = ["sporocilo" => "Nepravilni podatki ob prijavi"];
            echo ViewHelper::render("view/signin.php", ["data" => $data]);
        }
        else{
            $_SESSION["loggedIn"] = true;
            $_SESSION["userId"] = $user["id"];
            $_SESSION["userEmail"] = $user["email"];
            $data = ArticleDB::getAll();
            echo ViewHelper::render("view/index.php", ["articles" => $data]);
        }
    }

    public static function logout() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            $_SESSION["loggedIn"] = false;
            session_unset("userId");
            session_unset("userEmail");
        }
        $data = ArticleDB::getAll();
        echo ViewHelper::render("view/index.php", ["articles" => $data]);
    }
}