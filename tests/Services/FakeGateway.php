<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Payments\PaymentGateway;

final class FakeGateway implements PaymentGateway
{
    public ?int $charged = null;

    public function charge(int $amountInPence): bool
    {
        $this->charged = $amountInPence;

        return true;
    }
}
