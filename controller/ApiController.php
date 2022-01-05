<?php

require_once("model/ArticleDB.php");
require_once("ViewHelper.php");

class ApiController {

    public static function getAllProducts() {
        $data = ArticleDB::getAll();
        echo ViewHelper::renderJSON($data);
    }

    public static function getProduct () {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);
        $product = ArticleDB::get($data);
        echo ViewHelper::renderJSON($product);
    }
}
