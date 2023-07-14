# Topic: Accessors, mutators & casts

Transform attributes between the database and your code.

## Accessors & mutators (Laravel 10 syntax)

One method per attribute returning an `Attribute` with a getter and/or setter.

```php
use Illuminate\Database\Eloquent\Casts\Attribute;

protected function name(): Attribute
{
    return Attribute::make(
        get: fn (string $value) => ucfirst($value),       // on read
        set: fn (string $value) => strtolower($value),    // on write
    );
}
```

A computed attribute that isn't a real column:

```php
protected function fullName(): Attribute
{
    return Attribute::make(
        get: fn () => "{$this->first_name} {$this->last_name}",
    )->shouldCache();
}
// $user->full_name
```

## Casts

Declarative conversions for whole columns — simpler than accessors when you just
need a type change:

```php
protected $casts = [
    'is_admin'   => 'boolean',
    'options'    => 'array',          // JSON column ⇄ PHP array
    'published_at' => 'datetime',
    'price'      => 'decimal:2',
    'status'     => Status::class,    // native PHP enum cast
];
```

For reusable logic (e.g. encrypting a column, money objects) write a **custom
cast** implementing `CastsAttributes` and reference the class in `$casts`.

## Example

See `examples/User.php`.

## Exercise

See `exercise.md`.
