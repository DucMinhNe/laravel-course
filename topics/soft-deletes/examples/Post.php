<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;   // requires a nullable deleted_at column ($table->softDeletes())
}

// Behaviour:
//   $post->delete();                 // sets deleted_at, row stays
//   Post::all();                     // excludes soft-deleted (global scope)
//   Post::withTrashed()->get();      // include them
//   Post::onlyTrashed()->get();      // only the deleted
//   $post->trashed();                // true
//   $post->restore();                // deleted_at = null
//   $post->forceDelete();            // really gone

// Migration:
//   Schema::table('posts', fn (Blueprint $t) => $t->softDeletes());
