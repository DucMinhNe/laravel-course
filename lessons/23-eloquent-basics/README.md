# Lesson 23: Eloquent model basics

One class per table, with CRUD built in.

## What you'll learn

- Generate: `php artisan make:model Post`. A model maps to a table by
  convention (`Post` → `posts`).
- Create: `Post::create([...])` (needs `$fillable`), or `new Post(); $p->save()`.
- Read: `Post::all()`, `Post::find($id)`, `Post::findOrFail($id)`,
  `Post::where('published', true)->get()`, `Post::first()`.
- Update: `$post->update([...])` or set attributes + `->save()`.
- Delete: `$post->delete()`, `Post::destroy($id)`.
- **Mass assignment guard**: declare `$fillable` (allowlist) or `$guarded`
  (blocklist). Without it `create()`/`update()` throw to protect you.
- `$casts` converts columns: `'published' => 'boolean'`, `'meta' => 'array'`.

```php
class Post extends Model
{
    protected $fillable = ['title', 'body', 'published'];
    protected $casts = ['published' => 'boolean'];
}
```

## Example

See `examples/Post.php`.

## Exercise

1. `make:model Task` (or reuse the migration from Lesson 22).
2. Set `$fillable = ['title', 'done', 'due_at']` and cast `done` to boolean,
   `due_at` to date.
3. In Tinker: create two tasks, fetch them, update one, delete the other.
