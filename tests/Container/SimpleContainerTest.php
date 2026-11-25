<?php

declare(strict_types=1);

namespace Tests\Container;

use App\Container\SimpleContainer;
use App\Services\DeliveryCalculator;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class SimpleContainerTest extends TestCase
{
    public function testGetReturnsSameInstanceTwice(): void
    {
        $container = new SimpleContainer();
        $container->set(DeliveryCalculator::class, static fn () => new DeliveryCalculator());

        $this->assertSame(
            $container->get(DeliveryCalculator::class),
            $container->get(DeliveryCalculator::class),
        );
    }

    public function testGetThrowsForUnknownId(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('No entry for missing');

        (new SimpleContainer())->get('missing');
    }
}
