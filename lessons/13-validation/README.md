# Lesson 13: Validation

Never trust input. Validate it at the edge and let Laravel handle the rest.

## What you'll learn

- The quickest path: `$request->validate([...])`. On failure it throws and
  Laravel redirects back with errors (web) or returns a `422` JSON body (API).
- Rules can be pipe strings or arrays:
  `'email' => 'required|email|unique:users,email'`.
- Common rules: `required`, `nullable`, `string`, `integer`, `min`, `max`,
  `in:a,b,c`, `confirmed`, `unique`, `exists`, `date`, `boolean`.
- `validate()` returns **only the validated data** — use that, not
  `$request->all()`, to avoid mass-assignment surprises.
- Custom messages via the third argument, or use [Form Requests](../14-form-requests/)
  for anything non-trivial.

```php
$data = $request->validate([
    'title' => ['required', 'string', 'max:255'],
    'email' => ['required', 'email'],
    'age'   => ['nullable', 'integer', 'min:0'],
]);
Post::create($data);
```

## Example

See `examples/PostController.php`.

## Exercise

1. `POST /register` validating `name` (required), `email` (required+email),
   `password` (required+min:8+confirmed).
2. Submit invalid data and inspect the `422` JSON error shape.
3. Submit valid data and return the validated array.
