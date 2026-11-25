<?php

declare(strict_types=1);

namespace App\Models;

final class Order
{
    public function __construct(public readonly ?Customer $customer = null)
    {
    }

    public function shippingCity(): string
    {
        // ?-> stops at the first null; inside ?? it would be redundant (?? already null-guards the chain)
        $city = $this->customer?->address?->city;

        return $city ?? 'Unknown';
    }
}
