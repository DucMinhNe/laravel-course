# Exercise — Lesson 26

1. Migrations:
   ```php
   // tags
   $table->id(); $table->string('name'); $table->timestamps();

   // post_tag (pivot)
   $table->foreignId('post_id')->constrained()->cascadeOnDelete();
   $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
   ```
2. Add `belongsToMany` on both models (see `examples/models.php`).
3. In Tinker:
   ```php
   $post = Post::first();
   $post->tags()->attach([1, 2]);
   $post->tags;                 // 2 tags
   $post->tags()->sync([2, 3]); // now exactly tags 2 and 3
   $post->tags()->detach();     // remove all
   ```

**Done when:** attach/sync/detach change the pivot rows as expected.
