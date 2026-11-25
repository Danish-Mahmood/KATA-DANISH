# KATA-DANISH

PHP 8 kata for JavaScript/TypeScript developers (Jira STAC-221, B1.1). Each topic has a small piece of tile-shop code in `src/` and a PHPUnit test in `tests/`.

## Setup

Requires PHP 8.2+ and Composer.

```bash
composer install
composer test      # PHPUnit
composer lint      # PSR-12 check (PHPCS)
composer lint:fix  # apply PSR-12 fixes (PHPCBF)
composer analyse   # PHPStan level 8
php public/index.php   # prints 24.99
```

## JS vs PHP, one line per topic

| Topic | JS / TS | PHP 8 | Code |
|---|---|---|---|
| Strict types | TS types vanish after build; JS coerces `'2' + 3` | `declare(strict_types=1)` checks types at runtime: `add('2', 3)` throws `TypeError` | `src/functions.php`, `tests/SmokeTest.php` |
| Union / nullable | `number \| string`, `x ??= 'GBP'` | `int\|float`, `?string`, same `??=` | `formatPrice()` in `src/functions.php` |
| Enums + match | `enum` / string unions + `switch` | Backed `enum` with methods; `match` is strict and returns a value; `from()` throws, `tryFrom()` returns `null` | `src/Enums/OrderStatus.php` |
| Nullsafe | `order?.customer?.address?.city ?? 'Unknown'` | Same operator: `$order?->customer?->address?->city` | `src/Models/Order.php` |
| Classes | Constructor + `this.x = x`; `readonly` is compile-time only | Constructor promotion; `readonly` throws `Error` on write at runtime; "wither" returns a new object | `src/Models/Product.php` |
| Interfaces / abstract | Interfaces are structural (shape match is enough) | Interfaces are nominal: the class must say `implements` | `src/Payments/` |
| Modules vs namespaces | `import { Cart } from './services/cart'` | `namespace App\Services;` + `use App\Models\Product;`, resolved by the PSR-4 autoloader | `src/Services/Cart.php` |
| Package manager | `package.json`, `npm install`, `node_modules/` | `composer.json`, `composer install`, `vendor/`; commit `composer.lock` | `composer.json` |
| Code style | ESLint / Prettier | PSR-12 enforced by PHPCS (same tool the Magento codebase uses) and PHPStan | `src/Services/DeliveryCalculator.php` |
| HTTP messages | Fetch API `Request` / `Response` | PSR-7 interfaces; immutable, so `withStatus()` returns a new response | `src/Http/ProductController.php` |
| DI container | InversifyJS / NestJS providers | PSR-11 `ContainerInterface` with `get()` / `has()` | `src/Container/SimpleContainer.php` |
| Testing | Jest / Vitest `expect(x).toBe(y)` | PHPUnit `$this->assertSame($y, $x)`; `#[DataProvider]` acts like `test.each` | `tests/` |

## Structure

```
src/
  Container/   PSR-11 container
  Enums/       OrderStatus
  Http/        PSR-7 controller
  Models/      Product, Order, Customer, Address
  Payments/    PaymentGateway, BaseGateway, Stripe, PayPal
  Services/    Cart, DeliveryCalculator
  functions.php
tests/         mirrors src/
public/        index.php entry point
```
