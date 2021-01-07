<?php

require_once __DIR__ . '/../../models/Command.php';
require_once __DIR__ . '/../../utils/DatabaseManager.php';

class CommandService
{
    private static $instance;

    public function __construct(){ }

    public static function getCommandInstance(){
        if (!isset(self::$instance)){
            self::$instance = new CommandService();
        }
        return self::$instance;
    }

    public function createOrder(Command $command){
        $db = DatabaseManager::getSharedInstance();
        $affectedRows = $db->exec('INSERT INTO orders(num_order,fk_mail_user) VALUES (?,?)',[
            $command->getNumOrder(),
            $command->getFkMailUser()
        ]);
        if ($affectedRows > 0){
            return $command;
        }
        return NULL;
    }

    public function lists($offset,$limit){
        $db = DatabaseManager::getSharedInstance();
        $rows = $db->getAll("SELECT * FROM orders LIMIT $offset,$limit");
        $commands = [];
        foreach ($rows as $row){
            $commands[] = new Command($row);
        }
        return $commands;
    }

}
