<?php

require_once __DIR__ . '/../utils/DatabaseManager.php';

class TourDao
{

    public static function createTour($mail,$truck,$orders){
        $res =  DatabaseManager::getSharedInstance()->exec("INSERT INTO tour (volunteerMail,car) VALUES (?,?)", [$mail,$truck]);
        $lastId = DatabaseManager::getSharedInstance()->lastInsertId();

        $usrBusy =  DatabaseManager::getSharedInstance()->exec("UPDATE user SET busy=1 WHERE mail=?",[$mail]);
        $truckBusy =  DatabaseManager::getSharedInstance()->exec("UPDATE trucks SET status=1 WHERE license_plate=?",[$truck]);

        foreach ($orders as $order){
            $res2 =  DatabaseManager::getSharedInstance()->exec("INSERT INTO tour_order (fk_order_name,fk_tour_id) VALUES (?,?)", [$order,$lastId]);
            $inProgressOrders = DatabaseManager::getSharedInstance()->exec("UPDATE orders SET status=2 WHERE num_order=? ", [$order]);
        }



        if ($res && $res2 && $truckBusy && $usrBusy && $inProgressOrders){

            return ["success" => "Tour créé !". " N°" .$lastId];

        }else{

            return ["error" => "Une erreur est survenue, le tour n'a pas été créé"];

        }

    }
}