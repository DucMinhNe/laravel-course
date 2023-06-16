# Exercise — Lesson 35

1. Set up the database queue:
   ```bash
   php artisan queue:table
   php artisan migrate
   ```
   In `.env`: `QUEUE_CONNECTION=database`.
2. Generate a job:
   ```bash
   php artisan make:job LogTaskCreated
   ```
   ```php
   public function __construct(public int $taskId) {}
   public function handle(): void {
       \Log::info('Task created (from queue)', ['id' => $this->taskId]);
   }
   ```
3. Dispatch it when a task is created:
   ```php
   LogTaskCreated::dispatch($task->id);
   ```
4. Run a worker in a second terminal and create a task:
   ```bash
   php artisan queue:work
   ```

**Done when:** creating a task returns instantly, and the worker logs the
message a moment later (check `storage/logs/laravel.log`).
