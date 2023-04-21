# Exercise — Lesson 20

1. Create `resources/views/posts/create.blade.php` with a POST form to `/posts`,
   including `@csrf`, an `old('title')` value, and an `@error('title')` block.
2. Add the routes:
   ```php
   Route::get('/posts/create', fn () => view('posts.create'));
   Route::post('/posts', function (Illuminate\Http\Request $r) {
       $r->validate(['title' => 'required|max:255']);
       return redirect('/posts/create')->with('ok', 'Saved!');
   });
   ```
3. Submit empty → redirected back, `@error` shows, `old('title')` keeps input.
4. Remove `@csrf` and submit → observe the **419 Page Expired** error, then put
   it back.

**Done when:** validation errors repopulate the form and the CSRF token is
required.
