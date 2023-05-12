<?php

use Illuminate\Support\Facades\DB;

// Plain rows (stdClass), not Eloquent models
DB::table('tasks')->where('done', false)->get();
DB::table('tasks')->where('done', false)->count();
DB::table('posts')->where('slug', 'hello')->value('title');

// Join
DB::table('posts')
    ->join('users', 'posts.user_id', '=', 'users.id')
    ->select('posts.title', 'users.name as author')
    ->get();

// Grouped aggregate report
DB::table('posts')
    ->select('user_id', DB::raw('count(*) as total'))
    ->groupBy('user_id')
    ->having('total', '>', 5)
    ->get();

// Writes
DB::table('tasks')->insert(['title' => 'Bulk task', 'done' => false]);
DB::table('tasks')->where('id', 1)->update(['done' => true]);
DB::table('tasks')->where('done', true)->delete();

// Atomic multi-write
DB::transaction(function () {
    DB::table('tasks')->insert(['title' => 'A']);
    DB::table('tasks')->insert(['title' => 'B']);
    // throw new \Exception('boom');  // → both inserts roll back
});

// Always bind params — never string-concatenate user input:
DB::select('select * from tasks where title = ?', [$userInput]);
