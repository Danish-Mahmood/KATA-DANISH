<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use function App\add;

final class SmokeTest extends TestCase
{
    #[DataProvider('nonIntegers')]
    public function testStrictTypesRejectsNonIntegers(mixed $input): void
    {
        $this->expectException(\TypeError::class);

        self::assertSame(5, add($input, 3));
    }

    /** @return iterable<string, array{mixed}> */
    public static function nonIntegers(): iterable
    {
        yield 'numeric string' => ['2'];
        yield 'float' => [2.0];
    }
}
