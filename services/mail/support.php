<?php

$mail = htmlspecialchars($_POST['email']);
$name = htmlspecialchars($_POST['name']);
$message = htmlspecialchars($_POST['message']);

if (!empty($mail) && !empty($pwd)) {

//printf("Bonjour $name $mail mess : $mess");

    $header="MIME-Version: 1.0\r\n";
    $header.='From:"'. $name .'"<'. $mail .'>'."\n";
    $header.='Content-Type:text/html; charset="uft-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';

    mail("tomy@smtp.stopwaste.eu", "Help !", $message, $header);

    // Heu... Help ?!
    echo json_encode(["success" => "Votre mail a été envoyé !"]);
}else {
    echo json_encode(["error" => "Aucune donnée envoyée"]);
}



