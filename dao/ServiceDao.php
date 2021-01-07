<?php

require_once __DIR__ . '/../utils/DatabaseManager.php';

class ServiceDao
{
    public static function createService($name,$description,$address,$city,$postalcode,$phone_number,$mail,$image,$date,$type){
        $res=  DatabaseManager::getSharedInstance()->exec("INSERT INTO services(name,description,address,city,postalcode,phone,mail,image,date,type) 
            VALUES (?,?,?,?,?,?,?,?,?,?)", [$name,$description,$address,$city,$postalcode,$phone_number,$mail,$image,$date,$type]);

        if ($res){

            return ["success" => "Service created"];

        }else{

            return ["error" => "Service not created"];
        }

    }
}