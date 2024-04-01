<?php

declare(strict_types=1);

require_once 'classes/Product.php';
require_once 'classes/Service.php';
require_once 'classes/Cart.php';

$cart = new Cart;

$cart->addItem(new Product('Product 1', 1000));
$cart->addItem(new Product('Product 2', 2000));

$cart->addItem(new Service('Service 1', 500));
$cart->addItem(new Service('Service 2', 1000));

echo $cart->getTotal();