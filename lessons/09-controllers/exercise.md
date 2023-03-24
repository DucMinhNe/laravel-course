# Exercise — Lesson 09

1. Generate a controller:
   ```bash
   php artisan make:controller PageController
   ```
2. Add two actions:
   ```php
   public function about()   { return 'About us'; }
   public function contact() { return ['email' => 'hi@example.com']; }
   ```
3. Wire them in `routes/web.php`:
   ```php
   use App\Http\Controllers\PageController;

   Route::get('/about',   [PageController::class, 'about']);
   Route::get('/contact', [PageController::class, 'contact']);
   ```

**Done when:** `/about` shows text and `/contact` returns JSON, both served by
`PageController`.
