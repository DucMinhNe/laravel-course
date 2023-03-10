# Exercise — Lesson 05

1. Add to `.env`:
   ```
   COURSE_NAME="Laravel 10 Course"
   ```
2. In `config/app.php`, expose it:
   ```php
   'course_name' => env('COURSE_NAME'),
   ```
3. Read it from a route in `routes/web.php`:
   ```php
   Route::get('/course', fn () => config('app.course_name'));
   ```
4. Cache and clear config, watching the behaviour:
   ```bash
   php artisan config:cache    # freezes config
   php artisan config:clear    # back to reading .env live
   ```

**Done when:** `/course` shows "Laravel 10 Course", and you can explain why
using `env('COURSE_NAME')` *directly in the route* would return `null` after
`config:cache`.
