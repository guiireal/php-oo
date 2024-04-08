<?php

require_once './gateways/ProductGateway.php';
require_once './domain/Product.php';

try {
    $connection = new PDO('sqlite:./database/stock.db');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    Product::setConnection($connection);

    $products = Product::all();

    /** @var Product $product */
    foreach($products as $product) {
        $product->delete();
    }

    $product = new Product;

    $product->description = 'Vinho Brasileiro Tinto Merlot';
    $product->qty = 10;
    $product->cost_price = 12;
    $product->sale_price = 18;
    $product->bar_code = '123456789';
    $product->origin = 'N';

    $product->save();

    /** @var Product $anotherProduct */
    $anotherProduct = Product::find(1);

    print("Descrição: {$anotherProduct->description}<br/>\n");
    print("Quantidade: {$anotherProduct->qty}<br/>\n");
    print("Preço de custo: {$anotherProduct->cost_price}<br/>\n");
    print("Preço de venda: {$anotherProduct->sale_price}<br/>\n");
    print("Código de barras: {$anotherProduct->bar_code}<br/>\n");
    print("Origem: {$anotherProduct->origin}<br/>\n");
    print("Lucro: {$anotherProduct->getProfitMargin()}<br/>\n");

    $anotherProduct->purchase(14, 5);
    $anotherProduct->save();

} catch (Exception $exception) {
    print($exception->getMessage());
}
