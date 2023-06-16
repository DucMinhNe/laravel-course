# Exercise — Lesson 32

1. Register the API resource in `routes/api.php`:
   ```php
   Route::apiResource('tasks', App\Http\Controllers\TaskController::class);
   ```
2. Implement the controller actions:
   ```php
   public function index() { return Task::latest()->get(); }

   public function store(Request $request) {
       $data = $request->validate(['title' => 'required|string|max:255']);
       return response()->json(Task::create($data), 201);
   }

   public function destroy(Task $task) {
       $task->delete();
       return response()->noContent();
   }
   ```
3. Exercise it (the `Accept: application/json` header makes errors return JSON):
   ```bash
   curl -s localhost:8000/api/tasks -H "Accept: application/json"
   curl -s -X POST localhost:8000/api/tasks -H "Accept: application/json" -d "title=Read docs"
   curl -s -X POST localhost:8000/api/tasks -H "Accept: application/json"   # 422
   ```

**Done when:** GET lists tasks, POST creates (201), empty POST returns a JSON
`422`, and DELETE returns `204`.
