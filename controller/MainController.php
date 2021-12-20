<?php

#require_once("model/JokeDB.php");
require_once("ViewHelper.php");

class MainController {

    public static function index() {
        echo ViewHelper::render("view/index.php");
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
}
