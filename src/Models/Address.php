<?php

declare(strict_types=1);

namespace App\Models;

final class Address
{
    public function __construct(public readonly string $city)
    {
    }
}
