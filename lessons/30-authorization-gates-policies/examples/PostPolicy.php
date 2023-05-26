<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    // Runs before every check — grant admins everything.
    public function before(User $user): ?bool
    {
        return $user->is_admin ? true : null;   // null = fall through to method
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;     // only the owner
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}

// In a controller:
//   public function update(Request $r, Post $post) {
//       $this->authorize('update', $post);   // 403 if not allowed
//       // ...
//   }
//
// In Blade:
//   @can('update', $post) <a href="...">Edit</a> @endcan
