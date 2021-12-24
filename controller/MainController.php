<?php

require_once("model/ArticleDB.php");
//require_once("model/UserDB.php");
require_once("ViewHelper.php");

class MainController {

    public static function index() {
        echo ViewHelper::render("view/index.php", [
            "articles" => ArticleDB::getAll()
        ]);
    }

    public static function product() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        echo ViewHelper::render("view/product.php", [
            "article" => ArticleDB::get($data)
        ]);
    }

    public static function controlPanel() {
        echo ViewHelper::render("view/control-panel.php", [
            "articles" => ArticleDB::getAll()
        ]);
    }

    /**
      * Returns TRUE if given $input array contains no FALSE values
      * @param type $input
      * @return type
      */
      private static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }

    /**
      * Returns an array of filtering rules for manipulation books
      * @return type
      */
      private static function getRules() {
        return [
            'title' => FILTER_SANITIZE_SPECIAL_CHARS,
            'description' => FILTER_SANITIZE_SPECIAL_CHARS,
            'price' => FILTER_VALIDATE_FLOAT,
        ];
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

    public static function profile() {
        $id = $_SESSION["userId"];
        $params = ["id" => $id];
        $user = ArticleDB::getUserById($params);
        echo ViewHelper::render("view/profile.php", ["user" => $user]);
    }

    public static function change_password() {
        $rules = [
            "password" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];

        $filteredData = filter_input_array(INPUT_POST, $rules);
        $params = ["id" => $_SESSION["userId"], "password" => $filteredData["password"]];
        $user = ArticleDB::changePassword($params);
        return json_encode($user);
    }

    public static function update_user() {
        $rules = [
            "name" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "surname" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "email" => [
                'filter' => FILTER_VALIDATE_EMAIL
            ]
        ];

        $filteredData = filter_input_array(INPUT_POST, $rules);
        $params = ["name" => $filteredData["name"], "surname" => $filteredData["surname"], "email" => $filteredData["email"], "id" => 1];
        $user = ArticleDB::updateUser($params);
        return json_encode($user);
    }
}