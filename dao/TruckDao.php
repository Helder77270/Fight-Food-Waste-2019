<?php

require_once __DIR__ . '/../utils/DatabaseManager.php';

class TruckDao
{

    public static function allTrucksName($status)
    {
        $db = DatabaseManager::getSharedInstance();
        $allName = $db->getAll("SELECT license_plate,brand FROM trucks WHERE status=?",[$status]);

        foreach ($allName as $row) {
            $trucks[] = $row;
        }
        return $trucks;
    }

}