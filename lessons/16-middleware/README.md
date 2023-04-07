# Lesson 16: Middleware

Run code before or after every matching request — auth, logging, headers, CORS.

## What you'll learn

- Middleware wraps the request/response. The `$next` closure passes control
  deeper into the app; what you do before/after `$next` is the filter.
- Generate one: `php artisan make:middleware EnsureTokenIsValid`.
- Register it in `app/Http/Kernel.php`:
  - global (`$middleware`), group (`$middlewareGroups['web'|'api']`), or
  - route (`$middlewareAliases`) then `->middleware('alias')` on a route.
- Built-ins you'll use: `auth`, `guest`, `throttle:60,1`, `verified`,
  `signed`.
- Parameters: `->middleware('throttle:10,1')` passes `10,1` to `handle()`.

```php
public function handle(Request $request, Closure $next): Response
{
    if ($request->header('X-Token') !== config('app.api_token')) {
        abort(401);
    }
    return $next($request);   // before logic above, after logic below
}
```

## Example

See `examples/EnsureTokenIsValid.php`.

## Exercise

1. `php artisan make:middleware EnsureTokenIsValid`.
2. Reject requests without header `X-Token: secret` (401).
3. Alias it as `token` in the Kernel and protect a `GET /private` route.
