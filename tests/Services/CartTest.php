<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Models\Product;
use App\Services\Cart;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CartTest extends TestCase
{
    public function testEmptyCartThrows(): void
    {
        $cart = new Cart(new FakeGateway());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cart is empty');
        $cart->total();
    }

    public function testTotalSumsProductPrices(): void
    {
        $cart = new Cart(new FakeGateway());
        $cart->add(new Product(sku: 'TM-001', name: 'Carrara Marble', price: 24.99));
        $cart->add(new Product(sku: 'TM-002', name: 'Slate Grey', price: 10.01));

        $this->assertEqualsWithDelta(35.0, $cart->total(), 0.0001);
    }

    public function testCheckoutChargesTotalInPence(): void
    {
        $gateway = new FakeGateway();
        $cart = new Cart($gateway);
        $cart->add(new Product(sku: 'TM-001', name: 'Carrara Marble', price: 24.99));

        $this->assertTrue($cart->checkout());
        $this->assertSame(2499, $gateway->charged);
    }
}
