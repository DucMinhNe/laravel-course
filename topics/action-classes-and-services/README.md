# Topic: Action & service classes

Where business logic should live once controllers and models get crowded.

## The problem

"Fat controllers" and "fat models" both rot. Controllers should translate HTTP
↔ domain; models should represent data + persistence. Complex *operations*
(create an order, publish a post, onboard a user) belong somewhere else.

## Action classes (one job each)

A single-purpose class with one public method — small, named after the use case,
trivially testable and reusable from controllers, jobs, and commands.

```php
class PublishPost
{
    public function __construct(private Notifier $notifier) {}

    public function execute(Post $post): Post
    {
        $post->update(['published' => true, 'published_at' => now()]);
        $this->notifier->postPublished($post);
        return $post;
    }
}

// Controller becomes a thin adapter:
public function publish(Post $post, PublishPost $action)
{
    $this->authorize('update', $post);
    return $action->execute($post);   // container injects dependencies
}
```

## Service classes (a cohesive area)

When several related operations share state/dependencies, group them in a
service (`BillingService` with `charge()`, `refund()`, `invoice()`). Bind it in
the container and inject it.

## Guidelines

- Don't over-engineer: a 3-line controller action doesn't need an action class.
  Extract when logic is non-trivial, reused, or hard to test in place.
- Actions are great units to dispatch from a queue or call from an artisan
  command — no HTTP required.
- Keep them dependency-injected (constructor), not full of `new` — so they're
  testable and swappable.
- Repositories are optional in Laravel; Eloquent already abstracts the DB. Reach
  for the repository pattern only when you genuinely need to hide the data
  source.

## Example

See `examples/PublishPost.php`.

## Exercise

See `exercise.md`.
