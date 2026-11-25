<?php

declare(strict_types=1);

namespace Tests\Http;

use App\Http\ProductController;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;

final class ProductControllerTest extends TestCase
{
    private Psr17Factory $factory;

    protected function setUp(): void
    {
        $this->factory = new Psr17Factory();
    }

    public function testMissingSkuReturns400(): void
    {
        $request = $this->factory->createServerRequest('GET', '/products');

        $response = (new ProductController())->show($request, $this->factory->createResponse());

        $this->assertSame(400, $response->getStatusCode());
    }

    public function testSkuReturns200WithJson(): void
    {
        $request = $this->factory->createServerRequest('GET', '/products')
            ->withQueryParams(['sku' => 'TM-001']);

        $response = (new ProductController())->show($request, $this->factory->createResponse());

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame('{"sku":"TM-001"}', (string) $response->getBody());
    }
}
