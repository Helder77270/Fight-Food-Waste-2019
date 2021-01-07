<?php

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once (__DIR__.'/../../dao/OrderDao.php');
require_once __DIR__ . '/../../models/GoogleMapsAPIObject.php';

$obj = new GoogleMapsAPIObject("AIzaSyA1hXkyuahhWi93NaoeP-RtOSUJ7scK43c"); // API key qui nous est personnelle -> Permettra de faire des requetes https juste pour nous
$mail = htmlspecialchars($_POST['user']);

if (isset($mail)){

    $res = DatabaseManager::getSharedInstance()->selec("SELECT region FROM user WHERE mail=?",[$mail]);
    $region = $res[0]['region'];
    $order = OrderDao::numOrderByRegion($region);

    $newValue = array();
    $res = array();
    foreach ($order as $item){
        $orders[] = $item['num_order'];
        $res[] = DatabaseManager::getSharedInstance()->selec("SELECT housenumber,street,city,country FROM orders INNER JOIN user ON orders.fk_mail_user = user.mail WHERE orders.num_order = ? ",[$item['num_order']]);
    }


    foreach($res[0] as $element)
    {

        $points[] = $obj->getLatAndLng($element['housenumber'], $element['street'],$element['city'],$element['country']);

    }

    echo json_encode(array("points" => $points,"order_name" => $orders));
}

