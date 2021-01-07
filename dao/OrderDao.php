<?php

require_once __DIR__ . '/../utils/DatabaseManager.php';
require_once __DIR__ . '/../models/Order.php';

class OrderDao
{
    public static function listsNotRetrieved($offset,$limit){
        $db = DatabaseManager::getSharedInstance();
        $rows = $db->getAll("SELECT * FROM orders WHERE status=0 LIMIT $offset,$limit");
        $order = [];
        foreach ($rows as $row){
            $order[] = $row;
        }
        return $order;
    }

    public static function ordersToBeValidated(){
        $db = DatabaseManager::getSharedInstance();
        $statement = $db->getAll("SELECT * FROM orders WHERE status=0");

            foreach ($statement as $row){
                $order[] = $row;
            }
            return $order; // fetch_style : FETCH_ASSOC means you receive data in a associative array "Column name" => "Variable_result"

    }

    public static function numOrderByRegion($region){

        $db = DatabaseManager::getSharedInstance();
        $numOrder = $db->getAll("SELECT num_order FROM orders INNER JOIN user ON orders.fk_mail_user = user.mail WHERE user.region = ? LIMIT 0,5",[$region]);

        if ($numOrder){
            foreach ($numOrder as $row){
                $order[] = $row;
            }
            return $order;
        }else{
            return false;
        }
    }



}