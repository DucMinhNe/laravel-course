# Lesson 18: Layouts & template inheritance

Define the page shell once; let each page fill in the gaps.

## What you'll learn

- Two styles in Laravel 10 — know both:
  - **Inheritance** (`@extends`): a parent defines `@yield('content')` and
    `@section('sidebar')`; children `@extends('layouts.app')` and fill
    `@section('content') ... @endsection`.
  - **Components** (`<x-layout>`): a layout component with `{{ $slot }}`. This
    is the modern default (see [Lesson 19](../19-blade-components/)).
- `@yield('title', 'Default')` — a placeholder with a fallback.
- `@stack('scripts')` + `@push('scripts')` — children contribute to a stack.
- `@include('partials.nav')` to pull in a partial.

```blade
{{-- layouts/app.blade.php --}}
<title>@yield('title', 'My Site')</title>
<main>@yield('content')</main>

{{-- home.blade.php --}}
@extends('layouts.app')
@section('title', 'Home')
@section('content') <h1>Welcome</h1> @endsection
```

## Example

See `examples/layout.blade.php` (parent) and `examples/home.blade.php` (child).

## Exercise

1. Build `layouts/app.blade.php` with a `@yield('content')` and a title yield.
2. Build `home.blade.php` that extends it and fills both.
3. Add a `@stack('scripts')` and push a `<script>` from the child.
