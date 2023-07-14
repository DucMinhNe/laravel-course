# Topic: Soft deletes

"Delete" a row without losing it — set a timestamp instead of removing it.

## Setup

1. Add the column in a migration: `$table->softDeletes();` (a nullable
   `deleted_at`).
2. Add the trait to the model:

```php
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
}
```

## How it behaves

- `$post->delete()` now sets `deleted_at = now()` instead of removing the row.
- A **global scope** hides soft-deleted rows from every normal query.
- Include them: `Post::withTrashed()->get()`.
- Only the deleted ones: `Post::onlyTrashed()->get()`.
- Restore: `$post->restore()` (or `Post::onlyTrashed()->restore()`).
- Permanently remove: `$post->forceDelete()`.
- Check: `$post->trashed()`.

## Gotchas

- Unique constraints don't know about `deleted_at` — a soft-deleted `slug`
  still occupies the unique index. Include `deleted_at` in the unique key or
  validate with `Rule::unique(...)->whereNull('deleted_at')`.
- Relationships: cascade on delete won't fire for soft deletes; clean up
  related rows yourself or use model events.

## Example

See `examples/Post.php`.

## Exercise

See `exercise.md`.
