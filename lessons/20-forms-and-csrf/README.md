# Lesson 20: Forms & CSRF

Submit HTML forms safely and repopulate them after validation errors.

## What you'll learn

- Every POST/PUT/PATCH/DELETE form needs `@csrf` — it emits a hidden token that
  the `VerifyCsrfToken` middleware checks. Without it you get a **419** error.
- HTML forms only support GET/POST. For other verbs add `@method('PUT')` (or
  `DELETE`) and Laravel spoofs the method.
- Repopulate fields after a failed validation with `old('field')`.
- Show errors with the `$errors` bag: `@error('field') ... @enderror`.
- After redirecting back, flashed input + errors are available for one request.

```blade
<form method="POST" action="/posts">
    @csrf
    <input name="title" value="{{ old('title') }}">
    @error('title') <span>{{ $message }}</span> @enderror
    <button>Save</button>
</form>
```

## Example

See `examples/create.blade.php`.

## Exercise

1. Build a create-post form posting to `/posts` with `@csrf`.
2. Add a delete button as a tiny form using `@method('DELETE')`.
3. Wire `/posts` to validate `title` (required) and redirect back on error;
   confirm `old('title')` repopulates and `@error` shows the message.
