# Lesson 14: Form Request classes

Move validation (and authorization) out of the controller into a dedicated class.

## What you'll learn

- Generate one: `php artisan make:request StorePostRequest`.
- It has two methods:
  - `authorize()` — return `true`/`false` (or a Gate check). `false` → 403.
  - `rules()` — return the validation array.
- Type-hint the Form Request in the controller action. Validation runs
  **before** your code; if it fails the action never executes.
- Get clean data with `$request->validated()` (only the validated keys) or
  `$request->safe()->only([...])`.
- Customise with `messages()` and `attributes()`.

```php
public function store(StorePostRequest $request)
{
    return Post::create($request->validated());  // already validated + authorized
}
```

## Example

See `examples/StorePostRequest.php`.

## Exercise

1. `php artisan make:request StoreTaskRequest`.
2. `rules()`: `title` required|max:255, `due` nullable|date.
3. `authorize()`: return `true` for now.
4. Type-hint it in a `TaskController@store` and return `$request->validated()`.
