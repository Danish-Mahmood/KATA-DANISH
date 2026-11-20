<?php

declare(strict_types=1);

namespace App\Container;

use Closure;
use Psr\Container\ContainerInterface;
use RuntimeException;

final class SimpleContainer implements ContainerInterface
{
    /** @var array<string, Closure(self): mixed> */
    private array $factories = [];

    /** @var array<string, mixed> */
    private array $instances = [];

    /** @param Closure(self): mixed $factory */
    public function set(string $id, Closure $factory): void
    {
        $this->factories[$id] = $factory;
    }

    public function has(string $id): bool
    {
        return isset($this->factories[$id]);
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new RuntimeException("No entry for {$id}");
        }

        return $this->instances[$id] ??= ($this->factories[$id])($this);
    }
}
