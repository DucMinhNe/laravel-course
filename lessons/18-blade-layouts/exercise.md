# Exercise — Lesson 18

1. Create `resources/views/layouts/app.blade.php`:
   ```blade
   <title>@yield('title', 'My Site')</title>
   <main>@yield('content')</main>
   @stack('scripts')
   ```
2. Create `resources/views/about.blade.php`:
   ```blade
   @extends('layouts.app')
   @section('title', 'About')
   @section('content') <h1>About us</h1> @endsection
   @push('scripts') <script>console.log('about');</script> @endpush
   ```
3. Route to it: `Route::get('/about', fn () => view('about'));`

**Done when:** the page title says "About", the content renders inside the
layout, and the pushed `<script>` appears at the bottom.
