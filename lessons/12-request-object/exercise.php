<?php

// Exercise — Lesson 12 (reference solution)

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 1. GET /search?q=...
Route::get('/search', fn (Request $r) => 'You searched: ' . $r->query('q', ''));

// 2. POST /echo → echo the body as JSON
Route::post('/echo', fn (Request $r) => $r->all());

// 3. GET /whoami
Route::get('/whoami', fn (Request $r) => [
    'ip'    => $r->ip(),
    'agent' => $r->userAgent(),
]);
