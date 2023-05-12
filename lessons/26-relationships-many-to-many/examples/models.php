<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    public function tags(): BelongsToMany
    {
        // Assumes a 'post_tag' pivot with post_id + tag_id.
        return $this->belongsToMany(Tag::class)
                    ->withPivot('priority')   // extra pivot column (optional)
                    ->withTimestamps();
    }
}

class Tag extends Model
{
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}

// Usage:
//
//   $post->tags()->attach($tagId);          // add one link
//   $post->tags()->attach([1, 2, 3]);       // add many
//   $post->tags()->detach($tagId);          // remove one (or detach() = all)
//   $post->tags()->sync([1, 2]);            // set the exact list
//   $post->tags;                            // Collection of Tag models
//   $post->tags->first()->pivot->priority;  // read pivot data
