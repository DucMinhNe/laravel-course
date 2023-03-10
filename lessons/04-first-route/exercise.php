<?php

// Exercise — Lesson 04
// Paste these into routes/web.php of a real app, then visit each URL.
// (This file is a reference solution — it won't run on its own.)

use Illuminate\Support\Facades\Route;

// 1. GET /hello → "Hello there"
Route::get('/hello', function () {
    return 'Hello there';
});

// 2. GET /me → JSON
Route::get('/me', function () {
    return ['name' => 'your name', 'role' => 'student'];
});

// 3. GET /now → current time as a string
Route::get('/now', function () {
    return now()->toDateTimeString();
});
