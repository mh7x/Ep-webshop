<?php

require_once("model/OrderDB.php");
require_once("ViewHelper.php");

class OrderController {

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
        if ($_SESSION["loggedIn"] == false) {
            echo viewHelper::redirect(BASE_URL . "signin");
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

        $id = $_SESSION["userId"];
        $params = ["id" => $id];
        $user = UserDB::getUserById($params);
        $customer = UserDB::getCustomerById($params);

        echo ViewHelper::render("view/checkout.php", [
            "cart_articles" => $cart_articles,
            "total_price" => $total_price,
            "values" => $values,
            "user" => $user,
            "customer" => $customer
        ]);
    }

    public static function summary() {
        if ($_SESSION["loggedIn"] == false) {
            echo viewHelper::redirect(BASE_URL . "signin");
        }
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

        self::add([
            "cart_articles" => $cart_articles,
            "total_price" => $total_price,
            "values" => $values
        ]);

        $temp = OrderDB::getLastId();
        $orderId = $temp[0];

        foreach ($cart_articles as $article) {
            OrderDB::insertItem([
                "article" => $article["id"],
                "quantity" => $values[$article["id"]],
                "price" => $article["price"],
                "order" => $orderId["MAX(ID)"]
            ]);
        };

        $order = OrderDB::get(["id" => $orderId["MAX(ID)"]]);
        $items = OrderDB::getItems(["id" => $orderId["MAX(ID)"]]);
        unset($_SESSION["cart"]);

        echo ViewHelper::render("view/summary.php", [
            "total_price" => $total_price,
            "items" => $items,
            "order" => $order,
            "id" => $orderId["MAX(ID)"]
        ]);
    }

    public static function add(array $data) {
        $date = date('m/d/Y h:i:s a', time());
        if (self::checkValues($data)) {
            OrderDB::insert([
                "stranka" => $_SESSION["userId"],
                "status" => "V obdelavi",
                "date" => $date
            ]);
        }
    }

    public static function order_details() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        echo ViewHelper::render("view/order-details.php", [
            "order" => OrderDB::get($data)
        ]);
    }

    public static function order_edit($order = []) {
        if ($_SESSION["userStatus"] == "prodajalec") {
            echo viewHelper::redirect(BASE_URL);
        }

        if (empty($order)) {
            $rules = [
                "id" => [
                    "filter" => FILTER_VALIDATE_INT,
                    "options" => ["min_range" => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);

            if (!self::checkValues($data)) {
                throw new InvalidArgumentException();
            }

            $order = OrderDB::get($data);
        }

        echo ViewHelper::render("view/order-edit.php", ["order" => $order]);
    }

    public static function edit_status() {
        if ($_SESSION["userStatus"] == "prodajalec") {
            echo viewHelper::redirect(BASE_URL);
        }

        $status = $_POST["status"];
        $id = $_POST["id"];

        if (self::checkValues($status)) {
            OrderDB::updateStatus(["status" => $status, "id" => $id]);
            ViewHelper::redirect(BASE_URL . "order-details?id=" . $id);
        } else {
            self::order_edit($status);
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
            'status' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }

}
