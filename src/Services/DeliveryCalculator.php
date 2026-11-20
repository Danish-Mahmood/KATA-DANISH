<?php

declare(strict_types=1);

namespace App\Services;

final class DeliveryCalculator
{
    public const FREE_DELIVERY_THRESHOLD = 300.0;

    public function costFor(float $orderTotal, bool $isExpress = false): float
    {
        if ($orderTotal >= self::FREE_DELIVERY_THRESHOLD) {
            return 0.0;
        }

        return $isExpress ? 14.99 : 6.99;
    }
}
