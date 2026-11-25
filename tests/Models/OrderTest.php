<?php

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use PHPUnit\Framework\TestCase;

final class OrderTest extends TestCase
{
    public function testShippingCityComesFromCustomerAddress(): void
    {
        $order = new Order(new Customer(new Address('Manchester')));

        $this->assertSame('Manchester', $order->shippingCity());
    }

    public function testShippingCityIsUnknownWhenAddressIsNull(): void
    {
        $this->assertSame('Unknown', (new Order(new Customer()))->shippingCity());
    }

    public function testShippingCityIsUnknownWhenCustomerIsNull(): void
    {
        $this->assertSame('Unknown', (new Order())->shippingCity());
    }
}
