<?php

// Exercise — Lesson 15 (reference solution)

use Illuminate\Support\Facades\Route;

// 1. POST /items → 201 JSON
Route::post('/items', fn () => response()->json(['created' => true], 201));

// 2. GET /old → redirect to named route 'home'
Route::get('/old', fn () => redirect()->route('home'));
Route::get('/', fn () => 'Home')->name('home');

// 3. GET /secret → 403
Route::get('/secret', fn () => abort(403));
