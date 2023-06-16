# Lesson 33: API resources

Control exactly what your JSON looks like — decouple it from the DB schema.

## What you'll learn

- Generate: `php artisan make:resource PostResource`. Its `toArray()` maps a
  model to the JSON shape you want to expose.
- Hide internal columns, rename fields, format dates, add computed values.
- Return one: `return new PostResource($post)`. Many:
  `PostResource::collection($posts)`.
- Conditionals: `$this->when($cond, value)`,
  `$this->whenLoaded('comments', ...)` (only include a relation if eager loaded).
- Nest resources: `'author' => new UserResource($this->whenLoaded('user'))`.
- Collections wrap in a `data` key and merge pagination meta automatically.

```php
public function toArray($request): array
{
    return [
        'id'        => $this->id,
        'title'     => $this->title,
        'published' => (bool) $this->published,
        'author'    => new UserResource($this->whenLoaded('user')),
        'createdAt' => $this->created_at->toIso8601String(),
    ];
}
```

## Example

See `examples/PostResource.php`.

## Exercise

1. `php artisan make:resource TaskResource`.
2. Expose `id`, `title`, `done` (cast to bool), and `dueAt` (ISO string or null).
3. Return `TaskResource::collection(Task::all())` from the API index and confirm
   the `data` wrapper and your custom field names.
