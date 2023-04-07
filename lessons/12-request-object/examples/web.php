<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Query string with a default
Route::get('/search', function (Request $request) {
    $q = $request->query('q', '');
    return "Searching for: {$q}";
});

// Echo the whole body back as JSON
Route::post('/echo', fn (Request $request) => $request->all());

// Presence + typed helpers
Route::post('/signup', function (Request $request) {
    return [
        'has_email'  => $request->has('email'),
        'filled'     => $request->filled('email'),
        'subscribed' => $request->boolean('subscribe'),  // "1","true","on" → true
    ];
});

// Request metadata
Route::get('/whoami', fn (Request $request) => [
    'ip'     => $request->ip(),
    'agent'  => $request->userAgent(),
    'method' => $request->method(),
    'path'   => $request->path(),
]);
