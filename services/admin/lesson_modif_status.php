<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');

$id = htmlspecialchars($_GET['id']);
$status = htmlspecialchars($_GET['status']);
$mail = htmlspecialchars($_GET['mail']);


$id_Lesson = DatabaseManager::getSharedInstance()->exec("SELECT FROM lesson WHERE id=?", [$id]);

echo $status." ".$mail." ".$id;
echo "<br>";
if ($status == 1){
    echo "Status : 1";
    $res = DatabaseManager::getSharedInstance()->exec("UPDATE lessonUser SET status=0 WHERE mailUser=?", [$mail]);
    echo "<br>";
    var_dump($res);
    echo "<br>Status : 0";
}else{
    echo "Status : 0";
    DatabaseManager::getSharedInstance()->exec("UPDATE lessonUser SET status=1 WHERE mailUser=?", [$mail]);
    echo "<br>Status : 1";
}

header('Location: ../../pages/lesson_inscription.php?id='.$id);
