<?php

declare(strict_types=1);

namespace Tests\Payments;

use App\Payments\PayPalGateway;
use PHPUnit\Framework\TestCase;

final class PayPalGatewayTest extends TestCase
{
    public function testChargeLogsWithPaypalPrefix(): void
    {
        $this->expectOutputString('[paypal] Charging 2499p' . PHP_EOL);

        $this->assertTrue((new PayPalGateway(apiKey: 'pp_test_123'))->charge(2499));
    }
}
