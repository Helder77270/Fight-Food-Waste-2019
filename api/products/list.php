<?php

require_once __DIR__.'/../../services/products/ProductService.php';

header('Content-Type: application/json');

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 7;

$ps = ProductService::getProductInstance();
$products = $ps->lists($offset,$limit);


echo json_encode($products);


?>


