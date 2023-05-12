# Lesson 25: One-to-many relationships

A user has many posts; a post belongs to a user.

## What you'll learn

- Define both sides as methods on the models:
  - `User`: `hasMany(Post::class)`
  - `Post`: `belongsTo(User::class)`
- Access them as **properties** (`$user->posts`, `$post->user`) — Eloquent runs
  the query lazily — or as **methods** to keep querying
  (`$user->posts()->where('published', true)->get()`).
- Create through the relation: `$user->posts()->create([...])` sets the foreign
  key for you.
- **Eager load** to avoid N+1: `User::with('posts')->get()`.
- `hasOne` / `belongsTo` is the one-to-one variant.

```php
class User extends Model {
    public function posts() { return $this->hasMany(Post::class); }
}
class Post extends Model {
    public function user() { return $this->belongsTo(User::class); }
}
```

## Example

See `examples/models.php`.

## Exercise

1. Give `User` a `tasks()` `hasMany` and `Task` a `user()` `belongsTo`
   (add `user_id` to the tasks table).
2. In Tinker: `$user->tasks()->create(['title' => 'X'])`.
3. Read `$user->tasks` and `$task->user`.
4. `User::with('tasks')->get()` and note it's 2 queries, not N+1.
