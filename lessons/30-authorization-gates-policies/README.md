# Lesson 30: Authorization — gates & policies

Authentication is *who you are*; authorization is *what you may do*.

## What you'll learn

- **Gates** — simple closures for app-wide checks, defined in a service
  provider. Good for one-off abilities not tied to a model.
  ```php
  Gate::define('access-admin', fn (User $u) => $u->is_admin);
  ```
- **Policies** — a class of rules for one model. Generate with
  `php artisan make:policy PostPolicy --model=Post`. Methods map to abilities
  (`view`, `create`, `update`, `delete`).
- Check authorization:
  - Controller: `$this->authorize('update', $post)` (403 on fail).
  - Anywhere: `$user->can('update', $post)`, `Gate::allows(...)`.
  - Blade: `@can('update', $post) ... @endcan`.
  - Route: `->middleware('can:update,post')`.
- Return `true`/`false` (or a `Response::deny('msg')`). `before()` can grant
  admins everything.

## Example

See `examples/PostPolicy.php`.

## Exercise

1. `php artisan make:policy PostPolicy --model=Post`.
2. `update()` returns `true` only if `$user->id === $post->user_id`.
3. In the controller's `update`, call `$this->authorize('update', $post)`.
4. Hide the edit button in Blade with `@can('update', $post)`.
