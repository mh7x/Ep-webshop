<?php

require_once("model/ArticleDB.php");
require_once("model/UserDB.php");
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

    public static function cart() {
        $method = filter_input(INPUT_SERVER, "REQUEST_METHOD", FILTER_SANITIZE_SPECIAL_CHARS);

        if ($method == "POST") {
            switch ($_POST["do"]) {
                case "add_into_cart":
                    try {
                        $article = ArticleDB::get(["id" => $_POST["id"]]);
                        if (isset($_SESSION["cart"][$article["id"]])) {
                            $_SESSION["cart"][$article["id"]]++;
                        } else {
                            $_SESSION["cart"][$article["id"]] = 1;
                        }
                    } catch (Exception $ex) {
                        die($ex->getMessage());
                    }
                    break;
                case "purge_cart":
                    unset($_SESSION["cart"]);
                    break;
                case "update_cart":
                    $value = $_POST["quantity"];
                    $article = ArticleDB::get(["id" => $_POST["id"]]);

                    if ($value == 0) {
                        unset($_SESSION["cart"][$article["id"]]);
                        if (empty($_SESSION["cart"])) {
                            unset($_SESSION["cart"]);
                        }
                    } else if ($value < 0) {
                        break;
                    } else {
                        $_SESSION["cart"][$article["id"]] = $value;
                    }
                    break;
                case "remove_item":
                    $article = ArticleDB::get(["id" => $_POST["id"]]);
                    unset($_SESSION["cart"][$article["id"]]);
                    if (empty($_SESSION["cart"])) {
                        unset($_SESSION["cart"]);
                    }
                    break;
                default:
                    break;
            }
        }

        $cart_articles = [];
        $values = [];
        $total_price = 0;
        $isEmpty = true;
        if (isset($_SESSION["cart"])) {
            $isEmpty = false;
            foreach ($_SESSION["cart"] as $id => $value) {
                $article = ArticleDB::get(["id" => $id]);
                $cart_articles[$id] = $article;
                $values[$id] = $value;
                $total_price += $article["price"] * $value;
            }
        } else if (empty($_SESSION["cart"])) {
            $isEmpty = true;
        }
        echo ViewHelper::render("view/cart.php", [
            "cart_articles" => $cart_articles,
            "total_price" => $total_price,
            "values" => $values,
            "isEmpty" => $isEmpty
        ]);
    }

    public static function checkout() {
        $cart_articles = [];
        $values = [];
        $total_price = 0;
        if (isset($_SESSION["cart"])) {
            foreach ($_SESSION["cart"] as $id => $value) {
                $article = ArticleDB::get(["id" => $id]);
                $cart_articles[$id] = $article;
                $values[$id] = $value;
                $total_price += $article["price"] * $value;
            }
        }

        $id = $_SESSION["userId"];
        $params = ["id" => $id];
        $user = UserDB::getUserById($params);

        echo ViewHelper::render("view/checkout.php", [
            "cart_articles" => $cart_articles,
            "total_price" => $total_price,
            "values" => $values,
            "user" => $user
        ]);
    }

    public static function summary() {
        if (empty($_SESSION["cart"])) {
            self::cart();
            exit;
        }
        
        $cart_articles = [];
        $values = [];
        $total_price = 0;
        if (isset($_SESSION["cart"])) {
            foreach ($_SESSION["cart"] as $id => $value) {
                $article = ArticleDB::get(["id" => $id]);
                $cart_articles[$id] = $article;
                $values[$id] = $value;
                $total_price += $article["price"] * $value;
            }
        }
        unset($_SESSION["cart"]);

        echo viewHelper::render("view/summary.php", [
            "cart_articles" => $cart_articles,
            "total_price" => $total_price,
            "values" => $values
        ]);
    }

    public static function signin() {
        echo ViewHelper::render("view/signin.php");
    }

    public static function signup() {
        echo ViewHelper::render("view/signup.php");
    }

    public static function controlPanelSeller() {
        echo ViewHelper::render("view/control-panel-seller.php", [
            "articles" => ArticleDB::getAll()
        ]);
    }

    public static function editFrom($article = []) {
        if (empty($article)) {
            $rules = [
                "id" => [
                    "filter" => FITLER_VALIDATE_INT,
                    "options" => ["min_range" => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);

            if (!self::checkValues($data)) {
                throw new InvalidArgumentException();
            }

            $article = ArticleDB::get($data);
        }

        echo ViewHelper::render("view/edit-article.php", ["article" => $article]);
    }

    public static function edit() {
        $rules = self::getRules();
        $rules["id"] = [
            'filter' => FILTER_VALIDATE_INT,
            'options' => ['min_range' => 1]
        ];

        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            ArticleDB::update($data);
            ViewHelper::redirect(BASE_URL . "product?id=" . $data["id"]);
        } else {
            self::editForm($data);
        }
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
        $params = ["email" => $filteredData["email"]];
        $user = UserDB::getLoginUser($params);
        if ($user == NULL) {
            $data = ["sporocilo" => "Uporabnik s tem e-naslovom ne obstaja."];
            echo ViewHelper::render("view/signin.php", ["data" => $data]);
        } else {
            if (($user["id"] == 1 && $user["geslo"] === $filteredData["password"]) || password_verify($filteredData["password"], $user["geslo"])) {
                $_SESSION["loggedIn"] = true;
                $_SESSION["userId"] = $user["id"];
                $_SESSION["userEmail"] = $user["email"];
                echo ViewHelper::redirect(BASE_URL);
            } else {
                $data = ["sporocilo" => "Vnesli ste napačno geslo."];
                echo ViewHelper::render("view/signin.php", ["data" => $data]);
            }
        }
    }

    public static function logout() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true) {
            $_SESSION["loggedIn"] = false;
            session_unset("userId");
            session_unset("userEmail");
        }

        #$data = ArticleDB::getAll();
        #echo ViewHelper::render("view/index.php", ["articles" => $data]);
        echo ViewHelper::redirect(BASE_URL);
    }

    public static function profile() {
        $id = $_SESSION["userId"];
        $params = ["id" => $id];
        $user = UserDB::getUserById($params);
        echo ViewHelper::render("view/profile.php", ["user" => $user]);
    }

    public static function change_password() {
        $rules = [
            "password" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];

        $filteredData = filter_input_array(INPUT_POST, $rules);
        $hashedPassword = password_hash($filteredData["password"], PASSWORD_DEFAULT);
        $params = ["id" => $_SESSION["userId"], "password" => $hashedPassword];
        $user = UserDB::changePassword($params);
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
        $params = ["name" => $filteredData["name"], "surname" => $filteredData["surname"], "email" => $filteredData["email"], "id" => $_SESSION["userId"]];
        $user = UserDB::updateUser($params);
        return json_encode($user);
    }

    public static function create_user() {
        $rules = [
            "name" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "surname" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "email" => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            "address" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "post_number" => [
                'filter' => FILTER_VALIDATE_INT
            ],
            "post_city" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "password" => [
                'filter' => FILTER_VALIDATE_STRING
            ],
            "status" => [
                'filter' => FILTER_VALIDATE_STRING
            ]
        ];
        $filteredData = filter_input_array(INPUT_POST, $rules);
        $password = $filteredData["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $filteredData["password"] = $hashedPassword;
        $user = UserDB::createUser($filteredData);
    }

}
