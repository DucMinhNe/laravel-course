<?php

// Reference query snippets (run in Tinker or a controller).

use App\Models\Post;
use App\Models\Task;

// Filtering
Post::where('published', true)->get();
Post::whereIn('id', [1, 2, 3])->get();
Post::whereNull('published_at')->get();
Post::where('views', '>', 100)->orWhere('featured', true)->get();

// Ordering + limiting
Post::latest()->take(5)->get();              // newest 5 by created_at
Post::orderBy('title')->get();

// Single values
Post::find(1);
Post::where('slug', 'hello')->first();
Post::where('id', 1)->value('title');        // just the column
Post::pluck('title');                        // collection of titles
Post::where('published', true)->count();
Post::where('slug', 'hello')->exists();      // bool

// Pagination (returns a LengthAwarePaginator)
Post::where('published', true)->paginate(10);

// Upserts
Task::firstOrCreate(['title' => 'Standup']);
Task::updateOrCreate(['title' => 'Standup'], ['done' => true]);

// Aggregates
Post::sum('views');
Post::avg('views');
