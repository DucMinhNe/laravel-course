# Exercise — Relationships, deeper

1. Make a polymorphic `comments` table:
   ```php
   $table->id();
   $table->text('body');
   $table->morphs('commentable');   // commentable_id + commentable_type
   $table->boolean('approved')->default(false);
   $table->timestamps();
   ```
2. Add `morphMany` to `Post` and `morphTo` to `Comment` (see example).
3. In Tinker:
   ```php
   $post = Post::first();
   $post->comments()->create(['body' => 'Nice!', 'approved' => true]);
   $post->comments;                                  // Collection
   Post::withCount('comments')->first()->comments_count;
   Post::whereHas('comments', fn ($q) => $q->where('approved', true))->get();
   ```

**Done when:** a comment attaches to a post polymorphically and `whereHas` /
`withCount` filter correctly.
