<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // ---- Local scopes (opt-in, chainable) ----
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function scopePopular(Builder $query, int $min = 100): Builder
    {
        return $query->where('views', '>=', $min);
    }

    // ---- Global scope (always applied) ----
    protected static function booted(): void
    {
        static::addGlobalScope('notArchived', function (Builder $query) {
            $query->whereNull('archived_at');
        });
    }
}

// Usage:
//   Post::published()->popular(500)->latest()->get();
//   Post::withoutGlobalScope('notArchived')->get();   // include archived
