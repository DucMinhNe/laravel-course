# Topic: Query scopes

Name and reuse common query constraints instead of repeating `where(...)`.

## Local scopes

Prefix a model method with `scope`; call it without the prefix. Scopes are
chainable.

```php
class Post extends Model
{
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeOfType($query, string $type)   // with an argument
    {
        return $query->where('type', $type);
    }
}

// Usage — the "scope" prefix is dropped:
Post::published()->ofType('news')->latest()->get();
```

## Global scopes

Applied to **every** query on the model automatically — perfect for
multi-tenancy or always hiding archived rows. (Soft deletes is a built-in
global scope.)

```php
protected static function booted(): void
{
    static::addGlobalScope('published', function ($query) {
        $query->where('published', true);
    });
}

// Bypass when you need everything:
Post::withoutGlobalScope('published')->get();
```

For reusable global scopes, implement the `Scope` contract in its own class and
`addGlobalScope(new ArchivedScope)`.

## Example

See `examples/Post.php`.

## Exercise

See `exercise.md`.
