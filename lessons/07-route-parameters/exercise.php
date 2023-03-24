<?php

// Exercise — Lesson 07 (reference solution)

use Illuminate\Support\Facades\Route;

// 1. GET /square/{n} → n*n, numbers only
Route::get('/square/{n}', fn (int $n) => $n * $n)->whereNumber('n');

// 2. GET /greet/{name?} → defaults to "world"
Route::get('/greet/{name?}', fn (?string $name = 'world') => "Hi, {$name}");

// 3. /square/abc → 404 (fails whereNumber)
