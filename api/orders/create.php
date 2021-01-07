<?php

header('Content-Type: application/json');


require_once __DIR__ . '/../../services/orders/CommandService.php';

$json=file_get_contents('php://input');
$obj = json_decode($json, true);

var_dump($obj);
var_dump($json);


if($obj) {
    $newOrder = CommandService::getCommandInstance()->createOrder(new Command($obj));
}
if ($newOrder) {
    http_response_code(201);
    echo json_encode($newOrder);
} else {
    http_response_code(400);
}

