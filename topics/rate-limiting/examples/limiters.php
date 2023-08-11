<?php

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

// ── Define named limiters (App\Providers\AppServiceProvider::boot or RouteServiceProvider) ──
RateLimiter::for('api', function (Request $request) {
    return $request->user()
        ? Limit::perMinute(120)->by($request->user()->id)
        : Limit::perMinute(30)->by($request->ip());
});

// Two limits at once + custom 429 response
RateLimiter::for('uploads', function (Request $request) {
    return [
        Limit::perMinute(10)->by($request->user()->id),
        Limit::perDay(100)->by($request->user()->id),
    ];
});

// ── Apply to routes ──
//   Route::middleware('throttle:api')->group(...);
//   Route::post('/upload', ...)->middleware('throttle:uploads');
//   Route::get('/cheap', ...)->middleware('throttle:60,1');   // inline limit

// ── Manual limiting (e.g. login throttling) ──
//   $ok = RateLimiter::attempt("login:{$email}", maxAttempts: 5,
//       callback: fn () => attemptLogin($email, $password), decaySeconds: 60);
//   if (! $ok) abort(429, 'Too many attempts');
