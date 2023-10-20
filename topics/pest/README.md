# Topic: Pest

A friendlier testing syntax on top of PHPUnit — same power, less ceremony.

## Why

Pest tests are functions, not methods on a class. Less boilerplate, very
readable, and it runs your existing PHPUnit tests too.

```php
// PHPUnit
public function test_sum(): void { $this->assertSame(4, 2 + 2); }

// Pest
test('sum', fn () => expect(2 + 2)->toBe(4));
it('adds numbers', fn () => expect(2 + 2)->toBe(4));
```

## Setup

```bash
composer require pestphp/pest --dev --with-all-dependencies
php artisan pest:install
php artisan test          # or ./vendor/bin/pest
```

## Expectations

```php
expect($value)->toBe(4)->not->toBeNull();
expect($user->email)->toContain('@');
expect($list)->toHaveCount(3);
expect(fn () => risky())->toThrow(RuntimeException::class);
```

## Laravel plugin

The Laravel plugin gives you the full HTTP/DB test API as functions:

```php
it('lists tasks', function () {
    Task::factory()->count(3)->create();
    $this->getJson('/api/tasks')->assertOk()->assertJsonCount(3, 'data');
});
```

- `uses(RefreshDatabase::class)` at the top of a file applies a trait to every
  test in it.
- `beforeEach(fn () => ...)` for setup; `datasets` for parameterised tests.

## Example

See `examples/TaskTest.php`.

## Exercise

See `exercise.md`.
