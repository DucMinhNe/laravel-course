# Topic: Rate limiting

Throttle abusive traffic and protect fragile endpoints.

## The throttle middleware

The quickest win: `throttle:max,perMinutes`.

```php
Route::middleware('throttle:60,1')->group(...);   // 60 requests / minute / client
```

On the `api` group, a default `throttle:api` is already applied. Exceeding it
returns `429 Too Many Requests` with `Retry-After` and `X-RateLimit-*` headers.

## Named limiters (the flexible way)

Define limiters in a service provider (`configureRateLimiting()` /
`RateLimiter::for`), keyed however you like — per user, per IP, per plan:

```php
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

RateLimiter::for('api', function (Request $request) {
    return $request->user()
        ? Limit::perMinute(120)->by($request->user()->id)   // by user
        : Limit::perMinute(30)->by($request->ip());          // by IP for guests
});

// Apply by name
Route::middleware('throttle:api')->group(...);
```

- Multiple limits: return an array of `Limit`s (e.g. per-minute AND per-day).
- Custom response: `->response(fn () => response('Slow down', 429))`.

## Manual limiting anywhere

For non-HTTP actions (login attempts, sending OTPs):

```php
RateLimiter::attempt("login:{$email}", 5, function () { /* do it */ }, 60);
// or: RateLimiter::tooManyAttempts($key, 5)
```

## Example

See `examples/limiters.php`.

## Exercise

See `exercise.md`.
