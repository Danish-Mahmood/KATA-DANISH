<?php

declare(strict_types=1);

namespace App\Models;

final class Product
{
    public function __construct(
        public readonly string $sku,
        public readonly string $name,
        private float $price,
    ) {
    }

    public function price(): float
    {
        return $this->price;
    }

    public function withPrice(float $price): self
    {
        return new self($this->sku, $this->name, $price);
    }
}
