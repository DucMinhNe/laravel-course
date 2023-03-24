# Lesson 07: Route parameters

Capture parts of the URL and pass them to your handler.

## What you'll learn

- Required parameters: `/posts/{id}` → `function ($id) { ... }`.
- Optional parameters: `/users/{name?}` with a default value.
- Constraints with `->where(...)` or helpers like `->whereNumber('id')`.
- Parameter order matters; names are matched by position into the closure.

```php
Route::get('/posts/{id}', function (string $id) {
    return "Post #{$id}";
})->whereNumber('id');

Route::get('/users/{name?}', function (?string $name = 'guest') {
    return "Hello, {$name}";
});
```

## Example

See `examples/web.php`.

## Exercise

1. `GET /square/{n}` returning `n * n`, constrained to numbers only.
2. `GET /greet/{name?}` defaulting to `"world"`.
3. Try `/square/abc` and confirm it 404s because of the constraint.
