<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // Allowlist for mass assignment (create/update with arrays)
    protected $fillable = ['title', 'slug', 'body', 'published', 'published_at'];

    // Automatic type conversion when reading/writing
    protected $casts = [
        'published'    => 'boolean',
        'published_at' => 'datetime',
    ];
}

// Tinker examples:
//
//   Post::create(['title' => 'Hi', 'slug' => 'hi', 'body' => '...']);
//   Post::find(1);
//   Post::where('published', true)->latest()->get();
//   $p = Post::findOrFail(1); $p->update(['published' => true]);
//   Post::destroy(2);
