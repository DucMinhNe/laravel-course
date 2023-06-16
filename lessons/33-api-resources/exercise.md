# Exercise — Lesson 33

1. Generate the resource:
   ```bash
   php artisan make:resource TaskResource
   ```
2. Shape the output:
   ```php
   public function toArray(Request $request): array
   {
       return [
           'id'    => $this->id,
           'title' => $this->title,
           'done'  => (bool) $this->done,
           'dueAt' => $this->due_at?->toDateString(),   // null-safe
       ];
   }
   ```
3. Return it from the API:
   ```php
   public function index() {
       return TaskResource::collection(Task::latest()->get());
   }
   ```

**Done when:** the response is wrapped in `{"data": [...]}`, `done` is a real
boolean, and `dueAt` is a clean date string (or `null`).
