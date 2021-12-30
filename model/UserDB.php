<?php

require_once 'model/AbstractDB.php';

class UserDB extends AbstractDB {

    public static function getLoginUser(array $params) {
        $user = parent::query("SELECT * FROM Oseba WHERE email = :email", $params);
        return $user[0];
    }

    public static function getUserById(array $id) {
        $user = parent::query("SELECT * FROM Oseba WHERE id = :id", $id);
        if (count($user) == 1) {
            return $user[0];
        } else {
            throw new InvalidArgumentException("No such user");
        }
    }

    public static function changePassword(array $params) {
        $user = parent::query("UPDATE Oseba SET geslo = :password WHERE id = :id", $params);
        return $user[0];
    }

    public static function updateUser(array $params) {
        $user = parent::query("UPDATE Oseba SET ime = :name, priimek = :surname, email = :email WHERE id = :id", $params);
        return $user[0];
    }

    public static function createUser(array $params) {
        // pogledamo, če pošta že obstaja
        $post_params = ["post_number" => $params["post_number"]];
        $post = parent::query("SELECT * FROM Posta WHERE stevilka = :post_number", $post_params);
        if (count($post) == 0) {
            // pošta še ne obstaja
            $post_params = ["post_number" => $params["post_number"], "post_city" => $params["post_city"]];
            parent::modify("INSERT INTO Posta(stevilka, kraj) VALUES(:post_number, :post_city)", $post_params);
            $post = parent::query("SELECT * FROM Posta WHERE stevilka = :post_number", ["post_number" => $params["post_number"]]);
        }

        // ustvarimo Osebo
        $person_params = ["name" => $params["name"], "surname" => $params["surname"], "email" => $params["email"], "password" => $params["password"], "status" => $params["status"], "active" => true];
        $person = parent::query("INSERT INTO Oseba (ime, priimek, email, geslo, aktiven, status, potrjen) VALUES (:name, :surname, :email, :password, :active, :status, false)", $person_params);
        $person = parent::query("SELECT * FROM Oseba WHERE email = :email", ["email" => $person_params["email"]]);

        // zdaj pa še stranko
        $user_params = ["person_id" => $person[0]["id"], "address" => $params["address"], "post_number" => $post[0]["stevilka"]];

        $user = parent::query("INSERT INTO Stranka(id_osebe, naslov, posta) VALUES(:person_id, :address, :post_number)", $user_params);
        $ret = ["id" => $person["id"], "email" => $person["email"]];
    }

    public static function createSeller(array $params) {
        $person_params = ["name" => $params["name"], "surname" => $params["surname"], "email" => $params["email"], "password" => $params["password"], "status" => $params["status"], "active" => true];
        $person = parent::query("INSERT INTO Oseba (ime, priimek, email, geslo, aktiven, status) VALUES (:name, :surname, :email, :password, :active, :status)", $person_params);
        return $person;
    }

    public static function getAllSellers() {
        $params = ["status" => "prodajalec"];
        return parent::query("SELECT * FROM Oseba WHERE status = :status", $params);
    }

    public static function updateSeller(array $params) {
        $person = parent::query("UPDATE Oseba SET ime = :name, priimek = :surname, aktiven = :active WHERE id = :id", $params);
        return $person;
    }

    public static function deleteSeller(array $params) {
        return parent::modify("DELETE FROM Oseba WHERE id = :id", $params);
    }

    public static function getCustomerById(array $params){
        return parent::query("SELECT * FROM Oseba o JOIN Stranka s ON o.id = s.id_osebe JOIN Posta p ON s.posta = p.stevilka WHERE o.status = 'stranka' and o.id = :id", $params);
    }

    public static function updateCustomer(array $params) {
        // pogledamo, če pošta že obstaja
        $post_params = ["post_number" => $params["post_number"]];
        $post = parent::query("SELECT * FROM Posta WHERE stevilka = :post_number", $post_params);
        if (count($post) == 0) {
            // pošta še ne obstaja
            $post_params = ["post_number" => $params["post_number"], "post_city" => $params["city"]];
            parent::modify("INSERT INTO Posta(stevilka, kraj) VALUES(:post_number, :post_city)", $post_params);
            $post = parent::query("SELECT * FROM Posta WHERE stevilka = :post_number", ["post_number" => $params["post_number"]]);
        }

        $customerParams = ["post_number" => $params["post_number"], "address" => $params["address"], "id" => $params["id"]];
        $customer = parent::query("UPDATE Stranka SET naslov = :address, posta = :post_number WHERE id_osebe = :id", $customerParams);
    }

    public static function getAllCustomers() {
        return parent::query("SELECT * FROM Oseba o JOIN Stranka s ON o.id = s.id_osebe JOIN Posta p ON s.posta = p.stevilka WHERE o.status = 'stranka'");
    }

    public static function deleteCustomer(array $params) {
        $uspeh = parent::query("DELETE FROM Stranka WHERE id_osebe = :id", $params);
        $uspeh = parent::query("DELETE FROM Oseba WHERE id = :id", $params);
    }
}
