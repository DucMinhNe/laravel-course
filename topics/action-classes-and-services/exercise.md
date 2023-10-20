# Exercise — Action & service classes

1. Extract a `CompleteTask` action:
   ```php
   class CompleteTask
   {
       public function execute(Task $task): Task
       {
           $task->update(['done' => true, 'completed_at' => now()]);
           TaskCompleted::dispatch($task);   // from the events lesson
           return $task;
       }
   }
   ```
2. Make the controller action thin:
   ```php
   public function complete(Task $task, CompleteTask $action)
   {
       $this->authorize('update', $task);
       return $action->execute($task);
   }
   ```
3. Call the **same** action from a queued job or an artisan command — proving
   it's reusable without HTTP.
4. Write a unit test that constructs the action, runs `execute()`, and asserts
   the task is marked done (no HTTP needed).

**Done when:** the operation lives in one testable class, the controller is a
thin adapter, and the action runs identically from HTTP, a job, and the CLI.
