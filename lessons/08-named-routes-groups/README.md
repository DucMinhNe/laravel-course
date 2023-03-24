# Lesson 08: Named routes & route groups

Stop hard-coding URLs, and stop repeating route options.

## What you'll learn

- **Named routes** with `->name('posts.index')`, then generate URLs with
  `route('posts.index')` — change the URI once, links update everywhere.
- Pass parameters: `route('posts.show', ['post' => 7])`.
- **Groups** share attributes across many routes:
  - `prefix('admin')` — URL prefix
  - `name('admin.')` — name prefix
  - `middleware('auth')` — shared middleware
  - `controller(PostController::class)` — shared controller

```php
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // URL:  /admin/posts     name: admin.posts.index
});
```

## Example

See `examples/web.php`.

## Exercise

1. Name a `GET /dashboard` route `dashboard`.
2. From another route, redirect to it with `redirect()->route('dashboard')`.
3. Wrap two routes in a group with `prefix('admin')` and `name('admin.')`,
   then confirm the names with `php artisan route:list`.
