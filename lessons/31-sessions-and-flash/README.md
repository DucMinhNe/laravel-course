# Lesson 31: Sessions & flash data

Persist small bits of state across requests for one user.

## What you'll learn

- Read/write the session:
  - `session(['key' => 'value'])` or `$request->session()->put('key', 'value')`
  - `session('key', 'default')` / `$request->session()->get('key')`
  - `$request->session()->forget('key')`, `->flush()`, `->has('key')`.
- **Flash data** lives for the *next request only* — perfect for "Saved!"
  messages after a redirect:
  - `->with('status', 'Saved!')` on a redirect, then read `session('status')`.
  - `$request->session()->flash('msg', '...')`.
- The session driver is set in `.env` (`SESSION_DRIVER=file|database|redis|cookie`).
  Use `database` or `redis` once you run more than one server.
- `@if (session('status')) ... @endif` to render flash messages in Blade.

```php
return redirect()->route('posts.index')->with('status', 'Post created!');
// next page:  @if (session('status')) <p>{{ session('status') }}</p> @endif
```

## Example

See `examples/web.php`.

## Exercise

1. `GET /visits` that increments a `visits` session counter and shows the count.
2. A POST route that redirects back `->with('status', 'Done!')`.
3. Render the flash in the target view; reload and confirm it disappears
   (flash = one request only).
