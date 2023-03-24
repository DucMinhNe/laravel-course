<?php

// Exercise — Lesson 06 (reference solution; paste into routes/web.php)

use Illuminate\Support\Facades\Route;

// 1. GET /about
Route::get('/about', fn () => 'A small Laravel 10 demo app.');

// 2. POST /feedback → 201 Created
Route::post('/feedback', fn () => response('thanks', 201));

// 3. Then run: php artisan route:list
