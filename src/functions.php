<?php

declare(strict_types=1);

namespace App;

function add(int $a, int $b): int
{
    return $a + $b;
}

function formatPrice(int|float $amount, ?string $currency = null): string
{
    $currency ??= 'GBP';

    return sprintf('%s %.2f', $currency, $amount);
}
