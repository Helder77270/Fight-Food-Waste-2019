<?php

require_once (__DIR__.'/../../utils/DatabaseManager.php');

$id = htmlspecialchars($_GET['id']);
$status = htmlspecialchars($_GET['status']);
$mail = htmlspecialchars($_GET['mail']);
$nb = htmlspecialchars($_GET['nb']);

$count = DatabaseManager::getSharedInstance()->selec("SELECT * FROM lessonUser WHERE idLesson=? and status=1", [$id]);
$countMax = 0;
foreach ($count as $k){
    if ($count){
        $countMax ++;
    }
}
echo "nb d'inscrits : ".$countMax."<br>";
echo "nb limit : ".$nb."<br>";

echo $status . " " . $mail . " " . $id."<br>";
if ($countMax < $nb) {
    echo "On a : ".$countMax."<".$nb."<br>";
    if ($status == 1) {
        echo "Status : 1";
        $res = DatabaseManager::getSharedInstance()->exec("UPDATE lessonUser SET status=0 WHERE mailUser=?", [$mail]);
        echo "<br>";
        var_dump($res);
        echo "<br>Status : 0";
    } else {
        echo "Status : 0";
        DatabaseManager::getSharedInstance()->exec("UPDATE lessonUser SET status=1 WHERE mailUser=?", [$mail]);
        echo "<br>Status : 1";
    }
}

header('Location: ../../pages/lesson_profile.php?id='.$id);