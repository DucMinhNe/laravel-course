<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $casts = [
        'is_admin'   => 'boolean',
        'settings'   => 'array',        // JSON ⇄ array
        'last_seen'  => 'datetime',
    ];

    // Accessor + mutator: store lowercase, display capitalised
    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtolower($value),
            set: fn (string $value) => strtolower(trim($value)),
        );
    }

    // Computed, not a column
    protected function initials(): Attribute
    {
        return Attribute::make(
            get: fn () => collect(explode(' ', $this->name))
                ->map(fn ($p) => strtoupper($p[0] ?? ''))
                ->join(''),
        )->shouldCache();
    }
}

// $user->settings['theme'] = 'dark'; $user->save();   // stored as JSON
// $user->initials;                                    // "ML"
