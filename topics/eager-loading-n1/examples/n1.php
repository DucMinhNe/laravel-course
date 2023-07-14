<?php

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

// ❌ N+1: 1 query for posts, then 1 per post for its user
$posts = Post::all();
foreach ($posts as $post) {
    echo $post->user->name;
}

// ✅ Eager load: 2 queries total
$posts = Post::with('user')->get();
foreach ($posts as $post) {
    echo $post->user->name;       // already loaded, no extra query
}

// Nested + constrained eager loading
Post::with([
    'user',
    'comments' => fn ($q) => $q->where('approved', true),
    'comments.author',
])->get();

// Counts without loading the rows
Post::withCount('comments')->get();   // each ->comments_count

// Prove it: query count should be constant
DB::enableQueryLog();
Post::with('user')->get();
echo count(DB::getQueryLog());        // 2

// Make accidental lazy loading throw in dev (put in AppServiceProvider::boot)
Model::preventLazyLoading(! app()->isProduction());
