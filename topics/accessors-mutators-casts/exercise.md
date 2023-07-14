# Exercise — Accessors, mutators & casts

1. On a model with a `settings` JSON column, cast it to `array`:
   ```php
   protected $casts = ['settings' => 'array'];
   ```
   Then `$model->settings = ['theme' => 'dark']; $model->save();` and read it
   back as a real array.
2. Add a mutator that trims + lowercases an `email` attribute on write.
3. Add a computed `excerpt` accessor returning the first 100 chars of `body`
   (not a column).

**Done when:** the JSON column round-trips as an array, emails are normalised
on save, and `$model->excerpt` works without a matching column.
