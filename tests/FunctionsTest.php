<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

use function App\add;
use function App\formatPrice;

final class FunctionsTest extends TestCase
{
    public function testAddSumsIntegers(): void
    {
        $this->assertSame(5, add(2, 3));
    }

    public function testFormatPriceDefaultsToGbp(): void
    {
        $this->assertSame('GBP 25.00', formatPrice(25));
    }

    public function testFormatPriceUsesGivenCurrency(): void
    {
        $this->assertSame('AED 19.50', formatPrice(19.5, 'AED'));
    }
}
