# Topic: Relationships, deeper

Beyond `hasMany`/`belongsToMany` — the relations that trip people up.

## hasManyThrough

Reach a distant relation through an intermediate model. A country has many
posts *through* users:

```php
// Country.php
public function posts() {
    return $this->hasManyThrough(Post::class, User::class);
    // posts.user_id → users.id, users.country_id → countries.id
}
```

## Polymorphic relations

One relation that can belong to *several* model types. Comments on both posts
and videos:

```php
// Comment.php
public function commentable() { return $this->morphTo(); }
// Post.php  &  Video.php
public function comments() { return $this->morphMany(Comment::class, 'commentable'); }
```

The `comments` table gets `commentable_id` + `commentable_type`. Many-to-many
has a polymorphic variant too (`morphToMany`) — e.g. tags on anything.

## Querying relations

- `Post::has('comments')` — posts that have at least one comment.
- `Post::has('comments', '>=', 3)` — three or more.
- `Post::whereHas('comments', fn ($q) => $q->where('approved', true))` —
  posts with an *approved* comment.
- `Post::withCount('comments')` — adds a `comments_count` attribute (one query).
- `Post::doesntHave('comments')` — the inverse.

## Example

See `examples/models.php`.

## Exercise

See `exercise.md`.
