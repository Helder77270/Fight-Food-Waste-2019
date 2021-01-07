<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');

$id_lesson = htmlspecialchars($_GET['id']);
$mail = htmlspecialchars($_POST['mail']);
$nbL = htmlspecialchars($_GET['nb']);

echo "nb : ".$nbL."<br>";

$count = DatabaseManager::getSharedInstance()->selec("SELECT * FROM lessonUser WHERE idLesson=? and status=1", [$id_lesson]);
$countMax = 0;
foreach ($count as $k){
    if ($count){
        $countMax ++;
    }
}
echo $countMax;
if ($countMax < $nbL) {

    $res = DatabaseManager::getSharedInstance()->exec('INSERT INTO lessonUser(mailUser, idLesson, status) VALUES (?, ?, ?)', [$mail, $id_lesson, 1]);

}

header('Location: ../../pages/lesson_profile.php?id='.$id_lesson);