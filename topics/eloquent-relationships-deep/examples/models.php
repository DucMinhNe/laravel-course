<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Country extends Model
{
    // country → users → posts
    public function posts(): HasManyThrough
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
}

class Comment extends Model
{
    // The "child" side of a polymorphic relation
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}

class Post extends Model
{
    // Both Post and Video can have comments via the same table
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

// Querying:
//   Post::has('comments', '>=', 3)->get();
//   Post::whereHas('comments', fn ($q) => $q->where('approved', true))->get();
//   Post::withCount('comments')->get();   // each ->comments_count
//   Post::doesntHave('comments')->get();
