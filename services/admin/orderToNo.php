<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');
require_once(__DIR__ . '/../../dao/UserDao.php');

$num_order = $_GET['num_order'];

$mail = $_GET['mail'];

echo $num_order . " et " . $mail;

DatabaseManager::getSharedInstance()->exec("UPDATE orders SET status=0 WHERE num_order=?", [$num_order]);

header('Location: ../../pages/ordersToValidate.php');