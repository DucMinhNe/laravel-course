# Lesson 10: Resource controllers

CRUD is so common Laravel scaffolds and routes it for you.

## What you'll learn

- `php artisan make:controller PhotoController --resource` generates seven
  actions: `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`.
- `Route::resource('photos', PhotoController::class)` registers all seven
  RESTful routes in one line.
- For JSON APIs use `Route::apiResource(...)` — it drops `create` and `edit`
  (the form pages) and keeps the five data actions.
- Limit or exclude with `->only([...])` / `->except([...])`.

| Verb | URI | Action | Name |
| --- | --- | --- | --- |
| GET | /photos | index | photos.index |
| GET | /photos/create | create | photos.create |
| POST | /photos | store | photos.store |
| GET | /photos/{photo} | show | photos.show |
| GET | /photos/{photo}/edit | edit | photos.edit |
| PUT/PATCH | /photos/{photo} | update | photos.update |
| DELETE | /photos/{photo} | destroy | photos.destroy |

## Example

See `examples/PhotoController.php`.

## Exercise

1. `php artisan make:controller TaskController --resource`.
2. Register `Route::resource('tasks', TaskController::class)`.
3. `php artisan route:list --name=tasks` — confirm all seven routes.
4. Re-register as `apiResource` and note which two routes disappear.
