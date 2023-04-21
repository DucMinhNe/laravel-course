# Lesson 19: Blade components

Reusable, self-contained UI pieces — the modern way to compose views.

## What you'll learn

- Generate: `php artisan make:component Alert` → a class
  (`app/View/Components/Alert.php`) + a view
  (`resources/views/components/alert.blade.php`).
- Use it as a tag: `<x-alert type="error" :message="$msg" />`.
- **Props** declared in the class constructor become variables in the view.
- `{{ $slot }}` renders the tag's inner content; named slots with
  `<x-slot:title>`.
- **Anonymous components** (view-only, no class) live in
  `resources/views/components/` and declare props via `@props([...])`.
- `$attributes` forwards extra HTML attributes (e.g. `class`) onto the root
  element with `{{ $attributes->merge([...]) }}`.

```blade
{{-- components/alert.blade.php (anonymous) --}}
@props(['type' => 'info'])
<div {{ $attributes->merge(['class' => "alert alert-$type"]) }}>
    {{ $slot }}
</div>

{{-- usage --}}
<x-alert type="error" class="mt-4">Something broke.</x-alert>
```

## Example

See `examples/alert.blade.php` and `examples/usage.blade.php`.

## Exercise

1. Create an anonymous `card` component with a `title` prop and a `{{ $slot }}`.
2. Use it twice with different titles and body content.
3. Forward a `class` attribute through `$attributes->merge(...)`.
