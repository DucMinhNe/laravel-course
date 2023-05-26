<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Persistent session value across requests
Route::get('/visits', function (Request $request) {
    $count = $request->session()->increment('visits');  // starts at 1
    return "You've visited {$count} times this session.";
});

// Flash a message that survives exactly one redirect
Route::post('/save', function () {
    // ... do work ...
    return redirect('/result')->with('status', 'Saved successfully!');
});

Route::get('/result', function () {
    // session('status') exists on this request only, then is gone
    return session('status', 'Nothing flashed.');
});

// Manual session API
Route::get('/remember/{name}', function (Request $request, string $name) {
    $request->session()->put('name', $name);
    return "Stored {$name}";
});
Route::get('/recall', fn (Request $r) => $r->session()->get('name', 'guest'));
