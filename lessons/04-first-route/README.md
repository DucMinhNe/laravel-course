# Lesson 04: Your first route & response

A Laravel app is, at its core, a map of URLs to responses.

## What you'll learn

- Browser routes live in `routes/web.php`.
- The basic shape: `Route::get($uri, $callback)`.
- A route closure can return:
  - a **string** → sent as HTML
  - an **array** → automatically serialised to JSON
  - a **view** → `view('welcome')`
- Other verbs: `Route::post`, `put`, `patch`, `delete`, and `Route::match` /
  `Route::any`.

```php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Hello, Laravel 10!';
});

Route::get('/json', function () {
    return ['framework' => 'Laravel', 'version' => 10];  // → JSON
});
```

## Example

See `examples/web.php` for several route styles in one file.

## Exercise

In `routes/web.php`, add:

1. `GET /hello` returning the string `Hello there`.
2. `GET /me` returning an array `['name' => 'your name', 'role' => 'student']`
   (open it and confirm the browser shows JSON).
3. `GET /now` returning the current time with `now()->toDateTimeString()`.

Start with `examples/web.php` as your reference.
