# Lesson 06: Routing basics

Map HTTP verbs and URLs to the code that handles them.

## What you'll learn

- One method per HTTP verb: `Route::get`, `post`, `put`, `patch`, `delete`,
  `options`.
- `Route::match(['get','post'], ...)` for several verbs; `Route::any(...)` for all.
- A route handler is either a **closure** or a **controller action**
  (`[PostController::class, 'index']`).
- `php artisan route:list` shows everything you've registered.
- `web.php` routes get session + CSRF; `api.php` routes are stateless and
  prefixed with `/api`.

```php
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
```

## Example

See `examples/web.php`.

## Exercise

1. Add a `GET /about` route returning a short string.
2. Add a `POST /feedback` route returning `response('thanks', 201)`.
3. Run `php artisan route:list` and find both.
