<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ProductController
{
    public function show(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $sku = $request->getQueryParams()['sku'] ?? null;

        if ($sku === null) {
            return $response->withStatus(400);
        }

        $response->getBody()->write(json_encode(['sku' => $sku], JSON_THROW_ON_ERROR));

        return $response
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }
}
