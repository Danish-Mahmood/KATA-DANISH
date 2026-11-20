<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Shipped = 'shipped';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Payment awaited',
            self::Paid => 'Paid',
            self::Shipped => 'On the way',
        };
    }

    public function canCancel(): bool
    {
        return $this !== self::Shipped;
    }
}
