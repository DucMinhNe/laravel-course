# Topic: Middleware, deeper

Beyond `auth` — parameters, terminable middleware, groups, and ordering.

## Before vs after

What you do relative to `$next($request)` decides timing:

```php
public function handle($request, Closure $next)
{
    // BEFORE — runs on the way in (auth, redirects, rewrites)
    $response = $next($request);
    // AFTER — runs on the way out (add headers, tweak response)
    return $response;
}
```

## Parameters

Pass args after a colon; they arrive as extra `handle()` arguments:

```php
Route::get('/admin', ...)->middleware('role:admin,editor');

public function handle($request, Closure $next, string ...$roles) { /* ... */ }
```

## Terminable middleware

A `terminate($request, $response)` method runs **after the response is sent to
the browser** — good for logging or flushing without delaying the user.

## Registration & ordering

In `app/Http/Kernel.php`:
- `$middleware` — global, every request.
- `$middlewareGroups` — `web` and `api` stacks.
- `$middlewareAliases` — named, applied per route.
- `$middlewarePriority` — forces a sort order when several must run in sequence
  (e.g. `StartSession` before `Authenticate`).

## Common built-ins

`auth`, `auth:sanctum`, `guest`, `verified`, `signed`, `throttle:60,1`,
`can:update,post`, `password.confirm`.

## Example

See `examples/EnsureRole.php`.

## Exercise

See `exercise.md`.
