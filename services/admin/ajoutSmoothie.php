<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');

$title = htmlspecialchars($_POST['title']);
$sub_title = htmlspecialchars($_POST['sub_title']);
$desc = ($_POST['desc']);
$desc2 = htmlspecialchars($_POST['desc2']);
$color = htmlspecialchars($_POST['color']);
$img = htmlspecialchars($_POST['img']);

echo $title . " " . $sub_title . " " . $desc . " " . $desc2 . " " . $color . " " . $img;

echo "<br>";

if (!empty($title) && !empty($sub_title) && !empty($desc) && !empty($desc2) && !empty($color) && !empty($img)) {
    if ($color == 1 || $color == 2 || $color == 3) {
        echo "<br>Couleur ok<br>";
        if ($img == 1 || $img == 2 || $img == 3 || $img == 4) {
            echo "Image ok";
            DatabaseManager::getSharedInstance()->exec('INSERT INTO smoothie(title, sub_title, description, description2, color, image, status) VALUES (?, ?, ?, ?, ?, ?, ?)', [$title, $sub_title, $desc, $desc2, $color, $img, 1]);
        }
    }
}
header('Location: ../../pages/adminAjoutSmoothie.php');