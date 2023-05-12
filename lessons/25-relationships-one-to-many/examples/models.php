<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    // One user → many posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}

class Post extends Model
{
    // Each post → one user (expects a user_id column)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

// Usage:
//
//   $user->posts;                                   // Collection (lazy load)
//   $user->posts()->where('published', true)->get(); // keep querying
//   $user->posts()->create(['title' => 'Hi', ...]); // sets user_id for you
//   $post->user;                                    // the owning User
//   User::with('posts')->get();                     // eager load → no N+1
