<?php

declare(strict_types=1);

namespace Tests\Services;

use App\Services\DeliveryCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class DeliveryCalculatorTest extends TestCase
{
    #[DataProvider('orders')]
    public function testCostFor(float $total, bool $isExpress, float $expected): void
    {
        $this->assertSame($expected, (new DeliveryCalculator())->costFor($total, $isExpress));
    }

    /** @return iterable<string, array{float, bool, float}> */
    public static function orders(): iterable
    {
        yield 'standard below threshold' => [299.99, false, 6.99];
        yield 'express below threshold' => [299.99, true, 14.99];
        yield 'free at threshold' => [300.0, true, 0.0];
    }
}
