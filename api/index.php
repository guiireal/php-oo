<?php

require_once './gateways/ProductGateway.php';

$product = new stdClass;

$product->description = 'Vinho Seco';
$product->qty = 15;
$product->cost_price = 20;
$product->sale_price = 22;
$product->bar_code = '7891234567892';
$product->origin = 'N';

try {
    $connection = new PDO('sqlite:./database/stock.db');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    ProductGateway::setConnection($connection);

    $productGateway = new ProductGateway;
    $productGateway->save($product);

    foreach($productGateway->all('qty <= 10') as $product) {
        print($product->description . "<br/>\n");
    }
} catch (Exception $e) {
    print($e->getMessage());
}
