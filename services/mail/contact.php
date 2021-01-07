<?php

$mail = $_POST['email'];
$name = $_POST['name'];
$message = $_POST['message'];

//printf("Bonjour $name $mail mess : $mess");

$header="MIME-Version: 1.0\r\n";
$header.='From:"'. $name .'"<'. $mail .'>'."\n";
$header.='Content-Type:text/html; charset="uft-8"'."\n";
$header.='Content-Transfer-Encoding: 8bit';

mail("tomy@smtp.stopwaste.eu", "Help !", $message, $header);

header('Location: ../../index.php');