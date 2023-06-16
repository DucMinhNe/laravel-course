# Lesson 32: Building a JSON API

Stateless endpoints that return JSON, defined in `routes/api.php`.

## What you'll learn

- `routes/api.php` is auto-prefixed with `/api` and uses the `api` middleware
  group (no session/CSRF; throttled).
- Returning an Eloquent model/collection or an array → JSON automatically.
- Use `apiResource` for CRUD: `Route::apiResource('posts', PostController::class)`.
- Proper status codes: `201` created, `204` no content (delete), `422`
  validation, `404` not found, `401`/`403` auth.
- Validation errors already come back as JSON `422` with an `errors` object —
  no extra work.
- Consistent shape: wrap data with [API Resources](../33-api-resources/).

```php
// routes/api.php
Route::apiResource('posts', PostController::class);
// → GET/POST /api/posts, GET/PUT/DELETE /api/posts/{post}
```

## Example

See `examples/api.php`.

## Exercise

1. In `routes/api.php`, add `Route::apiResource('tasks', TaskController::class)`.
2. Implement `index` (return `Task::all()`), `store` (validate + create → 201),
   `destroy` (delete → 204).
3. Test with curl: `curl -X POST localhost:8000/api/tasks -H "Accept: application/json" -d "title=Hi"`.
