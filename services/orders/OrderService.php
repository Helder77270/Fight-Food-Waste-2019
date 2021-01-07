<?php

require_once __DIR__ . '/../../models/Order.php';
require_once __DIR__ . '/../../utils/DatabaseManager.php';

class OrderService
{
    private static $instance;

    public function __construct(){ }

    public static function getOrderInstance(){
        if (!isset(self::$instance)){
            self::$instance = new OrderService();
        }
        return self::$instance;
    }

    public function createOrder(Order $order){
        $db = DatabaseManager::getSharedInstance();
        $db->exec('INSERT INTO order(fk_mail,fk_order) VALUES (?,?)',[
            $order->getMail(),
            $order->getOrderName()
        ]);
        return $order;
    }

    public function lists($offset,$limit){
        $db = DatabaseManager::getSharedInstance();
        $rows = $db->getAll("SELECT * FROM order LIMIT $offset,$limit");
        $products = [];
        foreach ($rows as $row){
            $products[] = new product($row);
        }
        return $products;
    }
}
