# Topic: Mail & notifications

Send email — and the same message across many channels.

## Mailables

`php artisan make:mail OrderShipped --markdown=emails.orders.shipped`:

```php
class OrderShipped extends Mailable
{
    public function __construct(public Order $order) {}

    public function envelope(): Envelope { return new Envelope(subject: 'Your order shipped'); }
    public function content(): Content   { return new Content(markdown: 'emails.orders.shipped'); }
}

Mail::to($user)->send(new OrderShipped($order));
Mail::to($user)->queue(new OrderShipped($order));   // send via the queue
```

Configure the transport in `.env` (`MAIL_MAILER=smtp|ses|...`). In dev use
`MAIL_MAILER=log` (writes to the log) or Mailpit.

## Notifications (multi-channel)

One message, delivered via mail, database, Slack, SMS, broadcast — chosen per
user:

```php
class InvoicePaid extends Notification implements ShouldQueue
{
    public function via($notifiable): array { return ['mail', 'database']; }
    public function toMail($notifiable): MailMessage { return (new MailMessage)->line('Paid!'); }
    public function toArray($notifiable): array { return ['invoice' => $this->invoice->id]; }
}

$user->notify(new InvoicePaid($invoice));
```

- **Database channel**: stores to `notifications` table
  (`php artisan notifications:table`); read via `$user->notifications` and
  `$user->unreadNotifications`. Perfect for an in-app bell.
- Queue notifications (`ShouldQueue`) so sending never blocks the request.

## Testing

`Mail::fake()` + `Mail::assertSent(...)`; `Notification::fake()` +
`Notification::assertSentTo($user, InvoicePaid::class)`.

## Example

See `examples/InvoicePaid.php`.

## Exercise

See `exercise.md`.
