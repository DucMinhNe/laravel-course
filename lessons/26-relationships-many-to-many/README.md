# Lesson 26: Many-to-many relationships

A post has many tags; a tag belongs to many posts — joined by a pivot table.

## What you'll learn

- Needs a **pivot table** named by the two singular models in alphabetical
  order: `post_tag` with `post_id` + `tag_id`.
- Both models declare `belongsToMany(...)`.
- Attach / detach / sync:
  - `$post->tags()->attach($tagId)` / `attach([1, 2, 3])`
  - `$post->tags()->detach($tagId)` / `detach()` (all)
  - `$post->tags()->sync([1, 2])` — make the set exactly these
  - `$post->tags()->toggle([...])`
- Pivot extra columns: `->withPivot('priority')->withTimestamps()`, read via
  `$tag->pivot->priority`.

```php
class Post extends Model {
    public function tags() { return $this->belongsToMany(Tag::class); }
}
class Tag extends Model {
    public function posts() { return $this->belongsToMany(Post::class); }
}
```

## Example

See `examples/models.php`.

## Exercise

1. Migrations for `tags` and the `post_tag` pivot
   (`post_id` + `tag_id`, both `foreignId`).
2. `belongsToMany` on both `Post` and `Tag`.
3. In Tinker: `$post->tags()->attach([1, 2])`, then `$post->tags`, then
   `$post->tags()->sync([2, 3])` and observe the change.
