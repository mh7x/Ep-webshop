<?php

require_once 'model/AbstractDB.php';

class ArticleDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO article (title, description, price, photo, review) "
                        . " VALUES (:title, :description, :price, 'stolec.jpg', 0)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE article SET title = :title, "
                        . "description = :description, price = :price"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM article WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $articles = parent::query("SELECT id, title, description, price, photo, review"
                        . " FROM article"
                        . " WHERE id = :id", $id);
        
        if (count($articles) == 1) {
            return $articles[0];
        } else {
            throw new InvalidArgumentException("No such article");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, title, description, price, photo, review"
                        . " FROM article"
                        . " ORDER BY id ASC");
    }

    public static function getLoginUser(array $params){
        $user = parent::query("SELECT id, email FROM Oseba WHERE email = :email and geslo = :password", $params);
        return $user[0];
    }

    public static function getUserById(array $id) {
        $user = parent::query("SELECT * FROM Oseba WHERE id = :id", $id);
        if (count($user) == 1){
            return $user[0];
        }else{
            throw new InvalidArgumentException("No such user");
        }
    }

    public static function changePassword(array $params) {
        $user = parent::query("UPDATE Oseba SET geslo = :password WHERE id = :id", $params);
        return $user[0];
    }
}
