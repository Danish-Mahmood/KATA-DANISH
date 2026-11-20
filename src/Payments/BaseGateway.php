<?php

declare(strict_types=1);

namespace App\Payments;

abstract class BaseGateway implements PaymentGateway
{
    public function __construct(protected string $apiKey)
    {
    }

    abstract protected function name(): string;

    protected function log(string $message): void
    {
        echo "[{$this->name()}] {$message}" . PHP_EOL;
    }
}
