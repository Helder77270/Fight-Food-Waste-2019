<?php

require_once __DIR__ . '/../../services/orders/CommandService.php';

header('Content-Type: application/json');

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

$cs = CommandService::getCommandInstance();
$command = $cs->lists($offset,$limit);

//var_dump($command);
//var_dump($cs);

echo json_encode($command);

?>


