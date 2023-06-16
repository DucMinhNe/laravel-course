# Exercise — Lesson 36

1. Create the event + listener:
   ```bash
   php artisan make:event TaskCompleted
   php artisan make:listener SendCompletionLog --event=TaskCompleted
   ```
2. Event carries the task:
   ```php
   public function __construct(public \App\Models\Task $task) {}
   ```
3. Listener logs it:
   ```php
   public function handle(TaskCompleted $event): void {
       \Log::info('Task completed', ['id' => $event->task->id]);
   }
   ```
4. Dispatch when a task is marked done:
   ```php
   if ($task->wasChanged('done') && $task->done) {
       TaskCompleted::dispatch($task);
   }
   ```

**Bonus:** add `implements ShouldQueue` to the listener and run `queue:work` —
the reaction now happens off the request.

**Done when:** completing a task writes the log line, and you can add a second
listener to the same event without touching the first.
