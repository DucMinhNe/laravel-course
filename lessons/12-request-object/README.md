# Lesson 12: The Request object

Read input, headers, files, and metadata from the incoming HTTP request.

## What you'll learn

- Type-hint `Illuminate\Http\Request` in any action and the container injects it.
- Read input independent of method (query string or body):
  - `$request->input('title')` / `$request->input('title', 'default')`
  - `$request->query('page')` — query string only
  - `$request->only(['a','b'])` / `$request->except(['x'])`
  - `$request->all()`
- Presence checks: `$request->has('email')`, `$request->filled('email')`,
  `$request->boolean('subscribe')`.
- Other data: `$request->method()`, `$request->path()`, `$request->ip()`,
  `$request->header('Accept')`, `$request->file('avatar')`,
  `$request->user()`.

```php
public function store(Request $request)
{
    $title = $request->input('title', 'Untitled');
    $tags  = $request->only(['tags']);
    // ...
}
```

## Example

See `examples/web.php`.

## Exercise

1. `GET /search` reading `?q=` with a default of `''` — return what was searched.
2. `POST /echo` returning `$request->all()` as JSON.
3. Add `GET /whoami` returning `$request->ip()` and `$request->userAgent()`.
