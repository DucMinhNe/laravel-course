# Exercise — Lesson 10

1. Scaffold a resource controller:
   ```bash
   php artisan make:controller TaskController --resource
   ```
2. Register the routes in `routes/web.php`:
   ```php
   use App\Http\Controllers\TaskController;
   Route::resource('tasks', TaskController::class);
   ```
3. Inspect them:
   ```bash
   php artisan route:list --name=tasks
   ```
4. Swap to an API resource and compare:
   ```php
   Route::apiResource('tasks', TaskController::class);
   ```

**Done when:** you can name all seven RESTful routes and explain why
`apiResource` drops `create` and `edit`.
