<?php

use Illuminate\Support\Facades\Route;

// Required parameter
Route::get('/posts/{id}', function (string $id) {
    return "Post #{$id}";
});

// Numeric constraint — /posts/abc will 404
Route::get('/orders/{id}', fn (string $id) => "Order {$id}")
    ->whereNumber('id');

// Optional parameter with a default
Route::get('/users/{name?}', function (?string $name = 'guest') {
    return "Hello, {$name}";
});

// Multiple parameters + regex constraint
Route::get('/posts/{post}/comments/{comment}', function ($post, $comment) {
    return "Post {$post}, comment {$comment}";
})->where(['post' => '[0-9]+', 'comment' => '[0-9]+']);
