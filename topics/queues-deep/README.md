# Topic: Queues, deeper

Retries, failures, batching, and running queues in production.

## Retries & failures

- `public int $tries = 3;` or `--tries=3` on the worker. After the last
  attempt, the job is marked **failed** and stored in `failed_jobs`.
- `public int $backoff = 10;` — seconds between retries (or
  `[10, 30, 60]` for escalating).
- `retryUntil()` — retry by a deadline instead of a count.
- `failed(Throwable $e)` method runs when a job exhausts retries — alert, clean
  up, refund.
- Manage failures: `queue:failed`, `queue:retry all`, `queue:flush`.
- `php artisan queue:retry-batchable` etc. Set up a `failed_jobs` table with
  `queue:failed-table`.

## Idempotency & uniqueness

Jobs can run more than once (retries, at-least-once delivery). Make `handle()`
idempotent. Implement `ShouldBeUnique` to prevent duplicate jobs being queued.

## Batching

Run many jobs as a unit with progress + completion callbacks:

```php
use Illuminate\Support\Facades\Bus;

Bus::batch([new Import(1), new Import(2)])
    ->then(fn ($batch) => Log::info('all done'))
    ->catch(fn ($batch, $e) => Log::error('a job failed'))
    ->finally(fn ($batch) => /* cleanup */)
    ->name('nightly-import')
    ->dispatch();
```

(Needs `php artisan queue:batches-table && migrate`.)

## Running in production

- Don't use `queue:work` raw — supervise it (Supervisor, systemd) so it
  restarts. After every deploy run `php artisan queue:restart` so workers pick
  up new code.
- `--timeout`, `--memory`, `--max-jobs`, `--sleep`, `--queue=high,default`
  (priority).
- **Laravel Horizon** (Redis) gives a dashboard, metrics, and auto-scaling.

## Example

See `examples/ImportUsers.php`.

## Exercise

See `exercise.md`.
