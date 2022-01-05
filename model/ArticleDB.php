<?php

require_once 'model/AbstractDB.php';

class ArticleDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO article (title, description, price, photo, review, sumReview, numReview) "
                        . " VALUES (:title, :description, :price, :photo, 0, 0, 0)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE article SET title = :title, "
                        . "description = :description, price = :price, photo = :photo"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM article WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $articles = parent::query("SELECT id, title, description, price, photo, review, sumReview, numReview"
                        . " FROM article"
                        . " WHERE id = :id", $id); 
        
        if (count($articles) == 1) {
            return $articles[0];
        } else {
            throw new InvalidArgumentException("No such article");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, title, description, price, photo, review, sumReview, numReview"
                        . " FROM article"
                        . " ORDER BY id ASC");
    }
    
    public static function rate(array $params) {
        return parent::modify("UPDATE article SET sumReview = sumReview + :sumReview, numReview = numReview + 1, review = sumReview / numReview WHERE id = :id", $params);      
    }
    
    public static function search(array $params) {
        $temp = "%" . $params["searchq"] . "%";
        return parent::query("SELECT * FROM article WHERE title LIKE '%$temp%'");
    }
}
