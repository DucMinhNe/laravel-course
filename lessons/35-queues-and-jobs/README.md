# Lesson 35: Queues & jobs

Push slow work (emails, image processing, API calls) off the request cycle.

## What you'll learn

- Generate: `php artisan make:job SendWelcomeEmail`. The class implements
  `ShouldQueue` and has a `handle()` method.
- Dispatch: `SendWelcomeEmail::dispatch($user)` — returns immediately; a worker
  runs `handle()` later. `dispatchSync(...)` to run inline.
- Configure the driver in `.env` (`QUEUE_CONNECTION=database|redis|sqs`). For
  `database`, run `php artisan queue:table && migrate`.
- Run a worker: `php artisan queue:work` (use `queue:listen` in dev).
- Reliability knobs: `public $tries = 3;`, `public $backoff = 10;`,
  `$timeout`, and a `failed()` method. Failed jobs land in `failed_jobs`;
  retry with `php artisan queue:retry all`.
- Constructor args are serialized — pass IDs or models (Laravel re-fetches them).

```php
class SendWelcomeEmail implements ShouldQueue {
    public function __construct(public User $user) {}
    public function handle(): void { Mail::to($this->user)->send(new Welcome()); }
}
SendWelcomeEmail::dispatch($user)->delay(now()->addMinute());
```

## Example

See `examples/SendWelcomeEmail.php`.

## Exercise

1. `php artisan make:job LogTaskCreated`.
2. In `handle()`, write a line to the log: `Log::info('Task created', [...])`.
3. Dispatch it from `TaskController@store`.
4. Set `QUEUE_CONNECTION=database`, run `queue:work`, create a task, and watch
   the worker process the job.
