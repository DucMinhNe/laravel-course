# Topic: The service container

Laravel's engine for resolving classes and their dependencies.

## What it does

The container is a registry that knows how to **construct** objects and inject
their dependencies. When you type-hint a class in a controller, job, or
constructor, the container builds it for you — recursively resolving *its*
dependencies too. That's why controllers "just work" with a `Request` argument.

## Binding

Tell the container how to build something (usually in a service provider's
`register()`):

```php
// Simple bind — new instance each time
$this->app->bind(PaymentGateway::class, StripeGateway::class);

// Singleton — one shared instance
$this->app->singleton(PaymentGateway::class, fn ($app) => new StripeGateway(config('services.stripe.key')));

// Bind an interface to an implementation (the killer feature)
$this->app->bind(PaymentGateway::class, StripeGateway::class);
```

## Resolving

```php
$gateway = app(PaymentGateway::class);     // or app()->make(...)
```

But you rarely call `make()` yourself — you **type-hint** and let the container
inject:

```php
public function __construct(private PaymentGateway $gateway) {}
```

## Why interfaces matter

Bind an interface to a concrete class once, type-hint the interface everywhere.
Swap Stripe for PayPal by changing one binding — no controller edits, and tests
can bind a fake. This is dependency inversion, made trivial.

## Example

See `examples/binding.php`.

## Exercise

See `exercise.md`.
