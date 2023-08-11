# Topic: Service providers

The central place to bootstrap your application's services.

## The two methods

- **`register()`** — bind things into the container. **Only** bind here; don't
  resolve services or touch other bindings (they may not exist yet).
- **`boot()`** — runs after *all* providers are registered. Safe to use other
  services here: register view composers, Blade directives, validation rules,
  gates, event listeners, route-model-binding, macros.

```php
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Weather::class, fn () => new Weather(config('services.weather.key')));
    }

    public function boot(): void
    {
        Blade::directive('money', fn ($expr) => "<?php echo '$'.number_format($expr, 2); ?>");
        Gate::define('admin', fn ($user) => $user->is_admin);
        Model::preventLazyLoading(! app()->isProduction());
    }
}
```

## Creating one

`php artisan make:provider BillingServiceProvider`, then register it in
`config/app.php`'s `providers` array (or it's auto-discovered if a package).

## Deferred providers

If a provider only binds things that aren't needed every request, implement
`DeferrableProvider` and a `provides()` method — Laravel loads it lazily,
shaving bootstrap time.

## When to make your own

Group related bootstrapping: a `BillingServiceProvider` for payment bindings, a
`MacroServiceProvider` for collection/string macros. Keep `AppServiceProvider`
from becoming a junk drawer.

## Example

See `examples/BillingServiceProvider.php`.

## Exercise

See `exercise.md`.
