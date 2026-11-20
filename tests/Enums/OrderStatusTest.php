<?php

declare(strict_types=1);

namespace Tests\Enums;

use App\Enums\OrderStatus;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ValueError;

final class OrderStatusTest extends TestCase
{
    public function testItBuildsFromAStoredValue(): void
    {
        $this->assertSame(OrderStatus::Paid, OrderStatus::from('paid'));
    }

    #[DataProvider('unknownValues')]
    public function testTryFromReturnsNullForUnknownValue(string $input): void
    {
        $this->assertNull(OrderStatus::tryFrom($input));
    }

    /** @return iterable<string, array{string}> */
    public static function unknownValues(): iterable
    {
        yield 'refunded' => ['refunded'];
        yield 'wrong case' => ['PAID'];
    }

    public function testFromThrowsForUnknownValue(): void
    {
        $this->expectException(ValueError::class);
        OrderStatus::from('refunded');
    }

    public function testShippedOrdersCannotBeCancelled(): void
    {
        $this->assertFalse(OrderStatus::Shipped->canCancel());
    }

    public function testLabelUsesMatch(): void
    {
        $this->assertSame('Payment awaited', OrderStatus::Pending->label());
    }
}
