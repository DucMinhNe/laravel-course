# Exercise — Lesson 19

1. Create an anonymous component `resources/views/components/card.blade.php`:
   ```blade
   @props(['title'])
   <div {{ $attributes->merge(['class' => 'card']) }}>
       <h3>{{ $title }}</h3>
       <div>{{ $slot }}</div>
   </div>
   ```
2. Use it from a page:
   ```blade
   <x-card title="Welcome" class="featured">
       <p>Body content goes in the slot.</p>
   </x-card>

   <x-card title="Notes">
       <p>A second card, reusing the same component.</p>
   </x-card>
   ```

**Done when:** both cards render with their own titles/bodies, and the
`featured` class is merged onto the first card's root div.
