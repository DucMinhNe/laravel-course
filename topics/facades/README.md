# Topic: Facades

The `Cache::get()` static-looking calls — and what they really are.

## They're not really static

A facade is a thin class that proxies static calls to a **resolved container
instance**. `Cache::get('key')` is really `app('cache')->get('key')`. So you
get terse syntax *and* a real, swappable, testable object underneath.

```php
// These two lines are equivalent:
Cache::put('k', 'v', 60);
app('cache')->put('k', 'v', 60);
```

Each facade has an `getFacadeAccessor()` returning the container binding key.

## Why it matters for testing

Because the call routes through the container, facades are **mockable**:

```php
Cache::shouldReceive('get')->once()->with('k')->andReturn('v');
Mail::fake();        // swap the real mailer for a spy
Queue::fake();
Event::fake();
```

## Facade vs helper vs injection

- **Facade**: `Cache::get(...)` — terse, discoverable, fakeable.
- **Helper**: `cache()->get(...)` — same thing, function style.
- **Injection**: type-hint `Illuminate\Contracts\Cache\Repository` — most
  explicit; best when a class leans on a service heavily (visible dependency).

There's no wrong choice; for heavily-used dependencies in your own services,
constructor injection makes the dependency obvious. Facades shine for
occasional, cross-cutting calls.

## Real-time facades

Prefix any of your own classes with `Facades\` in the import to call it like a
facade without writing one:

```php
use Facades\App\Services\Weather;
Weather::forecast();   // resolves App\Services\Weather from the container
```

## Example

See `examples/facades.php`.

## Exercise

See `exercise.md`.
