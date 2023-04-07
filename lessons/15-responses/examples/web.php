<?php

use Illuminate\Support\Facades\Route;

// Explicit JSON + status + header
Route::post('/items', function () {
    return response()->json(['id' => 1, 'name' => 'Widget'], 201)
                     ->header('X-Created-By', 'laravel-course');
});

// 204 No Content (typical for DELETE)
Route::delete('/items/{id}', fn ($id) => response()->noContent());

// Redirect to a named route, flashing a one-request message
Route::get('/save', fn () => redirect()->route('home')->with('status', 'Saved!'));

// Named target for the redirect above
Route::get('/', fn () => session('status', 'Home'))->name('home');

// Bail out with an HTTP error
Route::get('/secret', function () {
    abort(403, 'Nope.');
});
