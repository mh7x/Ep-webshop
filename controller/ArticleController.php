<?php

require_once("model/ArticleDB.php");
require_once("ViewHelper.php");

class ArticleController {

    public static function addForm($values = [
                "title" => "",
                "price" => "",
                "description" => "",
                "photo" => "stolec.jpg"
            ]) {
        echo ViewHelper::render("view/add-article.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $id = ArticleDB::insert($data);
            echo ViewHelper::redirect(BASE_URL . "product?id=" . $id);
        } else {
            self::addForm($data);
        }
    }

    public static function editForm($article = []) {
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
        $rules = self::getRules();
        $rules["id"] = [
            "filter" => FILTER_VALIDATE_INT,
            "options" => ["min_range" => 1]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        if(self::checkValues($data)) {
            ArticleDB::update($data);
            ViewHelper::redirect(BASE_URL . "product?id=" . $data["id"]);
        } else {
            self::editForm($data);
        }
        
    }
    
    public static function delete() {
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
            $url = BASE_URL . "control-panel";
        } else {
            if (isset($data["id"])) {
                $url = BASE_URL . "product/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "";
            }
        }

        ViewHelper::redirect($url);
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

}
