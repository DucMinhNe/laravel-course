<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // A user with 5 posts attached
        User::factory()
            ->has(Post::factory()->count(5))
            ->create(['email' => 'demo@example.com']);

        // 20 more standalone posts, plus 5 explicit drafts
        Post::factory()->count(20)->create();
        Post::factory()->count(5)->draft()->create();
    }
}

// Run with:  php artisan db:seed
//      or:   php artisan migrate:fresh --seed
