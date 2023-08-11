# Exercise — Middleware, deeper

1. Generate `EnsureRole` and accept variadic roles (see example).
2. Alias it as `role` in `app/Http/Kernel.php`.
3. Protect routes by role:
   ```php
   Route::get('/admin',   fn () => 'admin area')->middleware('role:admin');
   Route::get('/staff',   fn () => 'staff area')->middleware('role:admin,editor');
   ```
4. Add a `terminate()` method that logs the path + status, and confirm it runs
   after the response (the log line appears even though the user already got
   their page).

**Done when:** a user without the right role gets 403, and `terminate()` logs
after the response is sent.
