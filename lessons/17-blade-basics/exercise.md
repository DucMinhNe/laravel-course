# Exercise — Lesson 17

1. Create `resources/views/greet.blade.php`:
   ```blade
   <h1>Hello, {{ $name }}!</h1>
   ```
   Return it: `Route::get('/greet/{name}', fn ($name) => view('greet', compact('name')));`
2. Create `resources/views/items.blade.php` that lists `$items` and shows
   "Nothing here" when empty:
   ```blade
   @forelse ($items as $item)
       <p>{{ $loop->iteration }}. {{ $item }}</p>
   @empty
       <p>Nothing here</p>
   @endforelse
   ```
3. Pass `['items' => ['a','b','c']]`, then an empty array, and compare.

**Done when:** both views render and the empty case shows the fallback.
