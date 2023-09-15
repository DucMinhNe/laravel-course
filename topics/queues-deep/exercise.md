# Exercise — Queues, deeper

1. Set up failed-jobs + batches tables:
   ```bash
   php artisan queue:failed-table
   php artisan queue:batches-table
   php artisan migrate
   ```
2. Write a job that `throw`s, with `public int $tries = 3;` and a `failed()`
   method that logs. Dispatch it, run `queue:work`, and watch it retry 3× then
   land in `queue:failed`.
3. Retry it: `php artisan queue:retry all`.
4. Dispatch a `Bus::batch([...])` of 3 jobs with `->then(...)` and confirm the
   callback fires only after all succeed.

**Done when:** a failing job retries and records in `failed_jobs`, you can retry
it, and a batch reports completion.
