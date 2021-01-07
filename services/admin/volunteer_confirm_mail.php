<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');
require_once(__DIR__ . '/../../dao/UserDao.php');

    $mail = $_GET['mail'];

    echo $mail;

    DatabaseManager::getSharedInstance()->exec("UPDATE user SET status=1 WHERE mail=?", [$mail]);

    $header="MIME-Version: 1.0\r\n";
    $header.='From:"Samy"<samy@smtp.stopwaste.eu>'."\n";
    $header.='Content-Type:text/html; charset="uft-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';
    $message='
    <html>
        <body>
            <div align="center">
                Votre compte a été validé. Merci de votre colaboration.
            </div>
        </body>
    </html>
    ';
    mail($mail, "Stop Waste - Bienvenue chez StopWaste", $message, $header);
    header('Location: ../../pages/volunteerToValidate.php');