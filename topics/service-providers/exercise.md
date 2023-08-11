# Exercise — Service providers

1. Generate one:
   ```bash
   php artisan make:provider MacroServiceProvider
   ```
2. In `boot()`, register a Blade directive and a string macro:
   ```php
   Blade::directive('uppercase', fn ($e) => "<?php echo strtoupper($e); ?>");
   Str::macro('shout', fn ($s) => strtoupper($s) . '!');
   ```
3. Register the provider in `config/app.php`.
4. Use `@uppercase('hello')` in a view and `Str::shout('hi')` in Tinker.

**Done when:** the directive and macro work, and you can explain why the
directive must be registered in `boot()`, not `register()`.
