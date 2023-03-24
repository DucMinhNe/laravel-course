<?php

// Exercise — Lesson 08 (reference solution)

use Illuminate\Support\Facades\Route;

// 1. Named route
Route::get('/dashboard', fn () => 'Dashboard')->name('dashboard');

// 2. Redirect to it by name
Route::get('/home', fn () => redirect()->route('dashboard'));

// 3. Group with shared prefix + name prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', fn () => 'Admin users')->name('users');     // admin.users
    Route::get('/settings', fn () => 'Admin settings')->name('settings'); // admin.settings
});
