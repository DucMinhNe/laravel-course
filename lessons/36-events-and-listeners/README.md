# Lesson 36: Events & listeners

Decouple "something happened" from "what to do about it".

## What you'll learn

- An **event** is a plain data object (`php artisan make:event PostPublished`).
- A **listener** reacts to it (`php artisan make:listener NotifySubscribers
  --event=PostPublished`). Make a listener queued by implementing `ShouldQueue`.
- Register the mapping in `EventServiceProvider::$listen` (or rely on
  auto-discovery).
- Fire it: `PostPublished::dispatch($post)` or `event(new PostPublished($post))`.
  Every registered listener runs — one event, many reactions, no coupling.
- Eloquent fires **model events** too (`created`, `updated`, `deleted`); handle
  them with listeners or an **observer** (`make:observer`).

```php
class PostPublished { public function __construct(public Post $post) {} }

class NotifySubscribers implements ShouldQueue {
    public function handle(PostPublished $event): void { /* notify... */ }
}

PostPublished::dispatch($post);
```

## Example

See `examples/event-listener.php`.

## Exercise

1. `make:event TaskCompleted` carrying a `Task`.
2. `make:listener SendCompletionLog --event=TaskCompleted` that logs it.
3. Dispatch `TaskCompleted::dispatch($task)` when a task's `done` flips to true.
4. (Bonus) Make the listener `ShouldQueue` and watch it run on the worker.
