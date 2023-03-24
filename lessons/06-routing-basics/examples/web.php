<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Verb-specific routes
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::put('/posts/{post}', [PostController::class, 'update']);
Route::delete('/posts/{post}', [PostController::class, 'destroy']);

// Closure handler
Route::get('/about', fn () => 'About this site');

// Several verbs, one URI
Route::match(['get', 'post'], '/contact', fn () => 'Contact');

// Every verb
Route::any('/ping', fn () => 'pong');
