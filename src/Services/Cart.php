<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Payments\PaymentGateway as Gateway;
use InvalidArgumentException;

final class Cart
{
    /** @var list<Product> */
    private array $items = [];

    public function __construct(private Gateway $gateway)
    {
    }

    public function add(Product $product): void
    {
        $this->items[] = $product;
    }

    public function total(): float
    {
        if ($this->items === []) {
            throw new InvalidArgumentException('Cart is empty');
        }

        return array_sum(array_map(fn (Product $p): float => $p->price(), $this->items));
    }

    public function checkout(): bool
    {
        return $this->gateway->charge((int) round($this->total() * 100));
    }
}
