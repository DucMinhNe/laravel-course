<?php

// Reference: this is what routes/web.php looks like.
// Copy these into a real app's routes/web.php to try them.

use Illuminate\Support\Facades\Route;

// 1. Return a string → rendered as HTML
Route::get('/', function () {
    return 'Hello, Laravel 10!';
});

// 2. Return an array → automatically JSON-encoded with the right headers
Route::get('/json', function () {
    return ['framework' => 'Laravel', 'version' => 10];
});

// 3. Return a view (resources/views/welcome.blade.php)
Route::get('/welcome', function () {
    return view('welcome');
});

// 4. A non-GET verb
Route::post('/submit', function () {
    return response('Created', 201);
});

// 5. Multiple verbs on one URI
Route::match(['get', 'post'], '/contact', function () {
    return 'Contact endpoint';
});
