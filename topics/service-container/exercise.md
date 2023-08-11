# Exercise — The service container

1. Define an interface `Notifier` with `send(string $msg): void` and two
   implementations: `LogNotifier` (writes to the log) and `NullNotifier`.
2. In `AppServiceProvider::register()`, bind it:
   ```php
   $this->app->bind(\App\Contracts\Notifier::class, \App\Services\LogNotifier::class);
   ```
3. Type-hint `Notifier` in a controller constructor and call `send()` from an
   action — confirm the container injects `LogNotifier`.
4. In a test, `$this->app->bind(Notifier::class, NullNotifier::class)` and
   confirm the controller now uses the null version.

**Done when:** swapping the binding swaps the behaviour with zero changes to the
controller.
