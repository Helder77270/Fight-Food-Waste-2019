<?php

require_once(__DIR__ . '/../../utils/DatabaseManager.php');
require_once(__DIR__ . '/../../dao/UserDao.php');

    $num_order = htmlspecialchars($_GET['num_order']);

    $mail = htmlspecialchars($_GET['mail']);

    echo $num_order . " et " . $mail;
    $info = DatabaseManager::getSharedInstance()->selec("SELECT * FROM product WHERE fk_num_order=?", [$num_order]);

    DatabaseManager::getSharedInstance()->exec("UPDATE orders SET status=1 WHERE num_order=?", [$num_order]);

    $header="MIME-Version: 1.0\r\n";
    $header.='From:"Samy"<samy@smtp.stopwaste.eu>'."\n";
    $header.='Content-Type:text/html; charset="uft-8"'."\n";
    $header.='Content-Transfer-Encoding: 8bit';
    $message='
    <html>
        <body>
            <div align="center">
                Votre panier a été validé, nous vous remercions de votre don.
                ';

                foreach ($info as $key){
                    $message.= "<br>".$key['name'];
                }
                $message.='
            </div>
        </body>
    </html>
    ';
    mail($mail, "Stop Waste - Validation de votre panier", $message, $header);
    header('Location: ../../pages/ordersToValidate.php');