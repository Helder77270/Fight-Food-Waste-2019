<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../services/products/ProductService.php';


$json=file_get_contents('php://input');
$obj = json_decode($json, true);

var_dump($obj);
var_dump($json);



if($obj) {

    $newProduct = ProductService::getProductInstance()->createProduct(new Product($obj));

}
if ($newProduct) {
    http_response_code(201);
    echo json_encode($newProduct);
} else {
    http_response_code(400);
}

