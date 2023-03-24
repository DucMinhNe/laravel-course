<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

// Implicit binding by primary key. {post} matches the $post variable name.
// Missing id → automatic 404, no findOrFail() needed.
Route::get('/posts/{post}', fn (Post $post) => $post);

// Bind by a custom column (slug) instead of id.
Route::get('/p/{post:slug}', fn (Post $post) => $post);

// Scoped nested binding: only finds a post that belongs to this user.
Route::get('/users/{user}/posts/{post}', function (User $user, Post $post) {
    return $post;   // 404 if the post isn't this user's
});
