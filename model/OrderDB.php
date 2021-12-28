<?php

require_once 'model/AbstractDB.php';

class OrderDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO `order` (stranka, status, date) "
                        . "VALUES (:stranka, :status, :date)", $params);
    }

    public static function insertItem(array $params) {
        return parent::modify("INSERT INTO order_item (article, quantity, price, `order`)"
                        . " VALUES (:article, :quantity, :price, :order)", $params);
    }

    public static function updateStatus(array $params) {
        return parent::modify("UPDATE `order` SET status = :status WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM `order` WHERE id = :id", $params);
    }

    public static function get(array $id) {
        $orders = parent::query("SELECT id, stranka, status, date FROM `order` WHERE id = :id", $id);

        if (count($orders) == 1) {
            return $orders[0];
        } else {
            throw new InvalidArgumentException("No such order");
        }
    }
    
    public static function getLastId() {
        return parent::query("SELECT MAX(ID) FROM `order`");
    }

    public static function getAll() {
        return parent::query("SELECT id, stranka, status, date FROM `order` ORDER BY id ASC");
    }

    public static function getItems(array $id) {
        $items = parent::query("SELECT id, article, quantity, price, `order` FROM order_item WHERE `order` = :id", $id);
        
        return $items;
    }

}
