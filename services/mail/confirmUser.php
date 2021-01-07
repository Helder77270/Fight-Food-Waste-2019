<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');

$token = $_GET['token'];
$mail = $_GET['mail'];

$verifToken = DatabaseManager::getSharedInstance()->selec('SELECT * FROM user WHERE mail=?', [$mail]);

if ($token == $verifToken[0]['token']){
    DatabaseManager::getSharedInstance()->exec("UPDATE user SET status=1 WHERE mail=?", [$mail]);
    echo "<html><div class='row' style='text-align: center'><div class='col-12' style='text-align: center; margin-top: 50px'><h1>Votre compte a été créé ! ".$verifToken[0]['mail']."</h1></div><div class='col-12'><a href='http://stopwaste.eu'>Cliquer ici</a></div></div></html>";
}

//sleep(20);
//header('Location: ../index.php');