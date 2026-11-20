<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Product;
use App\Payments\StripeGateway;
use App\Services\Cart;

$cart = new Cart(new StripeGateway(apiKey: 'sk_test_123'));
$cart->add(new Product(sku: 'TM-001', name: 'Carrara Marble', price: 24.99));

echo $cart->total() . PHP_EOL;
