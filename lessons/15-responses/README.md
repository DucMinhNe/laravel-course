# Lesson 15: Responses — JSON, redirects, status codes

Control exactly what goes back to the client.

## What you'll learn

- Return values are auto-converted: strings → HTML, arrays/Eloquent → JSON.
- For control, use the `response()` helper:
  - `response('Body', 201)` — custom status
  - `response()->json($data, 200)` — explicit JSON
  - `response()->noContent()` — 204
  - `->header('X-Foo', 'bar')` / `->withHeaders([...])`
- Redirects:
  - `redirect('/login')`, `redirect()->route('home')`
  - `redirect()->back()->with('status', 'Saved!')` — flash a message
  - `redirect()->away('https://...')` — off-site
- Other helpers: `response()->download($path)`, `->streamDownload(...)`,
  `abort(404)`, `abort_if($cond, 403)`.

```php
return response()->json(['ok' => true], 201)
                 ->header('X-Request-Id', $id);
```

## Example

See `examples/web.php`.

## Exercise

1. `POST /items` returning JSON with status `201`.
2. `GET /old` redirecting to a named route `home`.
3. `GET /secret` calling `abort(403)` and confirm the 403 page.
