# Exercise — Lesson 14

1. Generate the request:
   ```bash
   php artisan make:request StoreTaskRequest
   ```
2. Fill it in:
   ```php
   public function authorize(): bool { return true; }

   public function rules(): array
   {
       return [
           'title' => ['required', 'string', 'max:255'],
           'due'   => ['nullable', 'date'],
       ];
   }
   ```
3. Use it in a controller:
   ```php
   public function store(StoreTaskRequest $request)
   {
       return $request->validated();
   }
   ```

**Done when:** the controller action receives only valid data, and invalid
requests are rejected before the action body runs.
