<?php

require_once("model/ArticleDB.php");
require_once("ViewHelper.php");

class ArticleController {

    public static function addForm($values = [
                "title" => "",
                "price" => "",
                "description" => "",
                "photo" => ""
            ]) {
        echo ViewHelper::render("view/add-article.php", $values);
    }

    public static function add() {
        if ($_SESSION["userStatus"] != "prodajalec") {
            echo ViewHelper::redirect(BASE_URL);
        }

        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $name = $_FILES['photo']['name'];
            $target_dir = "public/assets/";
            $target_file = $target_dir . basename($name);

            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = array("jpg", "jpeg", "png");

            if (in_array($image_file_type, $extensions_arr)) {
                var_dump($target_dir);
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_dir . $name)) {
                    var_dump($target_dir);
                    $data["photo"] = $name;
                    $id = ArticleDB::insert($data);
                    echo ViewHelper::redirect(BASE_URL . "product?id=" . $id);
                }
            }
        } else {
            self::addForm($data);
        }
    }

    public static function editForm($article = []) {
        if ($_SESSION["userStatus"] != "prodajalec") {
            echo ViewHelper::redirect(BASE_URL);
        }

        if (empty($article)) {
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

            $article = ArticleDB::get($data);
        }


        echo ViewHelper::render("view/edit-article.php", ["article" => $article]);
    }

    public static function edit() {
        if ($_SESSION["userStatus"] != "prodajalec") {
            echo ViewHelper::redirect(BASE_URL);
        }

        $rules = self::getRules();
        $rules["id"] = [
            "filter" => FILTER_VALIDATE_INT,
            "options" => ["min_range" => 1]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            $name = $_FILES['photo']['name'];
            $target_dir = "public/assets/";
            $target_file = $target_dir . basename($name);

            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = array("jpg", "jpeg", "png");

            if (in_array($image_file_type, $extensions_arr)) {
                var_dump($target_dir);
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_dir . $name)) {
                    var_dump($target_dir);
                    $data["photo"] = $name;
                    ArticleDB::update($data);
                    ViewHelper::redirect(BASE_URL . "product?id=" . $data["id"]);
                }
            }
        } else {
            self::editForm($data);
        }
    }

    public static function delete() {
        if ($_SESSION["userStatus"] != "prodajalec") {
            echo ViewHelper::redirect(BASE_URL);
        }

        $rules = [
            "delete_confirmation" => FILTER_REQUIRE_SCALAR,
            "id" => [
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 1]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if (self::checkValues($data)) {
            ArticleDB::delete($data);
            $url = BASE_URL . "control-panel-seller";
        } else {
            if (isset($data["id"])) {
                $url = BASE_URL . "product/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "";
            }
        }

        ViewHelper::redirect($url);
    }

    public static function rate() {
        if ($_SESSION["loggedIn"] == false) {
            viewHelper::redirect(BASE_URL);
        }

        ArticleDB::rate([
            "sumReview" => $_POST["rating"],
            "id" => $_POST["id"]
        ]);
        echo ViewHelper::redirect(BASE_URL . "product?id=" . $_POST["id"]);
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
            'price' => FILTER_VALIDATE_FLOAT
        ];
    }

}
