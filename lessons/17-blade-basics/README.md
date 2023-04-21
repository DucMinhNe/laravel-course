# Lesson 17: Blade basics

Laravel's template engine: HTML with a little compiled PHP, safely escaped.

## What you'll learn

- Views live in `resources/views/*.blade.php`. Return one with
  `view('posts.index', ['posts' => $posts])` or `view('home', compact('posts'))`.
- Echo **escaped** output with `{{ $value }}` (protects against XSS).
- Echo **raw** HTML with `{!! $html !!}` — only for trusted content.
- Control structures: `@if / @elseif / @else / @endif`, `@foreach`, `@forelse`,
  `@for`, `@while`, `@isset`, `@empty`.
- Loop helper `$loop`: `$loop->index`, `->first`, `->last`, `->count`.
- `@php ... @endphp` for the rare inline PHP (use sparingly).

```blade
<h1>{{ $title }}</h1>
@forelse ($posts as $post)
    <li>{{ $post->title }}</li>
@empty
    <li>No posts yet.</li>
@endforelse
```

## Example

See `examples/page.blade.php`.

## Exercise

1. A view that takes `$name` and greets the user.
2. Loop over an array of `$items`; show "none" when empty (`@forelse`).
3. Show the row number using `$loop->iteration`.
