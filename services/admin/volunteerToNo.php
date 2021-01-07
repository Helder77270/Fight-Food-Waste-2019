<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');
require_once(__DIR__ . '/../../dao/UserDao.php');

$mail = $_GET['mail'];

DatabaseManager::getSharedInstance()->exec("UPDATE user SET status=2 WHERE mail=?", [$mail]);

header('Location: ../../pages/volunteerToValidate.php');