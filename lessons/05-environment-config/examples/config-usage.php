<?php

// Reference — how config and env relate.

// ── In .env (NOT committed) ───────────────────────────────
// APP_NAME="My Blog"
// COURSE_NAME="Laravel 10 Course"
// STRIPE_KEY=sk_test_123

// ── In config/app.php ─────────────────────────────────────
return [
    'name'        => env('APP_NAME', 'Laravel'),   // 2nd arg = default
    'course_name' => env('COURSE_NAME'),
    // env() is ONLY safe inside config/* files.
];

// ── Anywhere else (controllers, routes, services) ─────────
// Always read through config(), never env():
//
//   $name   = config('app.name');
//   $course = config('app.course_name');
//   $key    = config('services.stripe.key');
//
// After `php artisan config:cache`, env() returns null outside config/*,
// but config() keeps working because the values were baked in.
