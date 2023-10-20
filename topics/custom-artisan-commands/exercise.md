# Exercise — Custom artisan commands

1. Generate a command:
   ```bash
   php artisan make:command StatsReport
   ```
2. Signature: `stats:report {--format=table : table or json}`.
3. In `handle()`, gather counts (`Task::count()`, done vs pending) and print
   either a `$this->table(...)` or `$this->line(json_encode(...))` based on the
   option.
4. Run both forms:
   ```bash
   php artisan stats:report
   php artisan stats:report --format=json
   ```

**Done when:** the command prints a table by default and JSON with the flag, and
appears in `php artisan list`.
