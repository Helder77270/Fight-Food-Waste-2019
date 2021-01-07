<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');

$id_lesson = htmlspecialchars($_GET['id']);
$mail = htmlspecialchars($_POST['mail']);

$res = DatabaseManager::getSharedInstance()->exec('INSERT INTO lessonUser(mailUser, idLesson, status) VALUES (?, ?, ?)', [$mail,$id_lesson,1]);

header('Location: ../../pages/lesson_inscription.php?id='.$id_lesson);