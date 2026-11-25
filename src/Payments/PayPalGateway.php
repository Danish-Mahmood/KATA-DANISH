<?php

declare(strict_types=1);

namespace App\Payments;

final class PayPalGateway extends BaseGateway
{
    protected function name(): string
    {
        return 'paypal';
    }

    public function charge(int $amountInPence): bool
    {
        $this->log("Charging {$amountInPence}p");

        return true;
    }
}
