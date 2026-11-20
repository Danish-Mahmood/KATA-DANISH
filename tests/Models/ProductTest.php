<?php

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Product;
use Error;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function testReadonlyPropertyCannotBeChanged(): void
    {
        $tile = new Product(name: 'Carrara Marble', sku: 'TM-001', price: 24.99);

        $this->expectException(Error::class);
        // @phpstan-ignore property.readOnlyAssignOutOfClass
        $tile->sku = 'TM-999';
    }

    public function testWithPriceReturnsNewObjectAndKeepsOriginal(): void
    {
        $tile = new Product(name: 'Carrara Marble', sku: 'TM-001', price: 24.99);

        $sale = $tile->withPrice(19.99);

        $this->assertNotSame($tile, $sale);
        $this->assertSame(24.99, $tile->price());
        $this->assertSame(19.99, $sale->price());
        $this->assertSame('TM-001', $sale->sku);
    }
}
