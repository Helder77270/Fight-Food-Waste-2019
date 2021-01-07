<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');

$id = htmlspecialchars($_GET['id']);
$status = htmlspecialchars($_GET['status']);
echo "id : " . $id;
echo "<br>";

if ($status == 1) {
    echo "Status : 1";
    $res = DatabaseManager::getSharedInstance()->exec("UPDATE smoothie SET status=0 WHERE id=?", [$id]);
    echo "<br>";
    echo "<br>Status : 0";
} else {
    echo "Status : 0";
    $res = DatabaseManager::getSharedInstance()->exec("UPDATE smoothie SET status=1 WHERE id=?", [$id]);
    echo "<br>Status : 1";

}

var_dump($res);

header('Location: ../../pages/adminAjoutSmoothieChoice.php?id='.$id);