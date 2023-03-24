# Lesson 11: Route model binding

Let Laravel fetch the model for you — or 404 if it doesn't exist.

## What you'll learn

- **Implicit binding**: type-hint a model whose variable name matches the route
  parameter. Laravel queries by primary key and injects it; a miss returns 404
  automatically.

  ```php
  Route::get('/posts/{post}', fn (Post $post) => $post);
  ```
- **Custom key**: bind by a column other than `id` with `{post:slug}`.
- **Scoped binding**: nested parameters can be scoped to the parent
  (`/users/{user}/posts/{post}` only finds posts belonging to that user).
- **Explicit binding** in `RouteServiceProvider` when you need custom logic.
- No more `findOrFail($id)` boilerplate in every action.

## Example

See `examples/web.php`.

## Exercise

1. Make a `Post` model + migration with a `slug` column.
2. `GET /posts/{post}` returning the model (bind by id).
3. `GET /p/{post:slug}` returning the same model bound by `slug`.
4. Request a non-existent post and confirm the automatic 404.
