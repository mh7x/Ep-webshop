<?php

require_once 'model/AbstractDB.php';

class UserDB extends AbstractDB {
    public static function getLoginUser(array $params){
        $user = parent::query("SELECT id, email FROM Oseba WHERE email = :email and geslo = :password", $params);
        return $user[0];
    }
}