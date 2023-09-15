# Exercise — Mail & notifications

1. Set `MAIL_MAILER=log` in `.env` (emails get written to the log — no SMTP
   needed).
2. Create the notifications table:
   ```bash
   php artisan notifications:table && php artisan migrate
   ```
3. Generate and send a notification on both channels:
   ```bash
   php artisan make:notification TaskDue
   ```
   `via()` returns `['mail', 'database']`. Then `$user->notify(new TaskDue($task))`.
4. Confirm: the mail appears in `storage/logs/laravel.log`, and
   `$user->unreadNotifications` has one entry. Mark it read with
   `->markAsRead()`.
5. In a test: `Notification::fake();` then
   `Notification::assertSentTo($user, TaskDue::class);`.

**Done when:** one `notify()` call delivers to both the log-mailer and the
database, and the test asserts it was sent.
