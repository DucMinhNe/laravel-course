<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Named route
Route::get('/dashboard', fn () => 'Dashboard')->name('dashboard');

// Generate URLs by name instead of hard-coding paths
Route::get('/go', fn () => redirect()->route('dashboard'));

// A group sharing prefix + name prefix + middleware + controller
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->controller(PostController::class)
    ->group(function () {
        Route::get('/posts', 'index')->name('posts.index');   // /admin/posts  → admin.posts.index
        Route::get('/posts/{post}', 'show')->name('posts.show');
    });

// route('admin.posts.show', ['post' => 3]) === "/admin/posts/3"
