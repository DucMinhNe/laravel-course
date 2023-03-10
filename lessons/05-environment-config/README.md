# Lesson 05: Environment & configuration

Keep secrets and per-machine settings out of your code.

## What you'll learn

- **`.env`** holds environment-specific values (DB password, API keys, app
  URL). It is **gitignored** — never commit it. `.env.example` is the committed
  template.
- **`config/`** files read from `.env` via the `env()` helper and expose values
  through the `config()` helper.
- **Rule:** call `env()` *only inside `config/` files*. Everywhere else use
  `config('...')`. Why? `php artisan config:cache` freezes config in production
  and `env()` returns `null` once cached.

```php
// config/services.php
return [
    'stripe' => [
        'key' => env('STRIPE_KEY'),   // env() lives here
    ],
];

// anywhere in the app
$key = config('services.stripe.key'); // config() everywhere else
```

- Common keys: `APP_ENV`, `APP_DEBUG`, `APP_KEY`, `APP_URL`, `DB_*`.
- `APP_DEBUG=true` only in local. In production it leaks stack traces.

## Example

See `examples/config-usage.php`.

## Exercise

1. Add `COURSE_NAME="Laravel 10 Course"` to `.env`.
2. In `config/app.php`, add `'course_name' => env('COURSE_NAME'),`.
3. Read it from a route: `return config('app.course_name');`.
4. Run `php artisan config:cache`, reload, then `php artisan config:clear`.
   Observe why `env('COURSE_NAME')` in a route would break after caching.
