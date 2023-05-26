# Exercise — Lesson 30

1. Generate the policy:
   ```bash
   php artisan make:policy PostPolicy --model=Post
   ```
   (Laravel 10 auto-discovers `App\Policies\PostPolicy` for `App\Models\Post`.)
2. Implement ownership:
   ```php
   public function update(User $user, Post $post): bool
   {
       return $user->id === $post->user_id;
   }
   ```
3. Enforce it in the controller:
   ```php
   public function update(Request $request, Post $post)
   {
       $this->authorize('update', $post);   // 403 if not the owner
       $post->update($request->validated());
   }
   ```
4. Hide the UI:
   ```blade
   @can('update', $post)
       <a href="{{ route('posts.edit', $post) }}">Edit</a>
   @endcan
   ```

**Done when:** a non-owner editing another user's post gets a **403**, and the
Edit link only shows for owners.
