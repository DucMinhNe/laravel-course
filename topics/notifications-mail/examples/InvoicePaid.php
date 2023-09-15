<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public int $invoiceId, public int $amount) {}

    // Per-user channel selection
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Invoice paid')
            ->greeting("Hi {$notifiable->name},")
            ->line("We received your payment of \${$this->amount}.")
            ->action('View invoice', url("/invoices/{$this->invoiceId}"))
            ->line('Thank you!');
    }

    // Stored in the notifications table for an in-app bell
    public function toArray(object $notifiable): array
    {
        return ['invoice_id' => $this->invoiceId, 'amount' => $this->amount];
    }
}

// Send:  $user->notify(new InvoicePaid($invoice->id, 4999));
// Read:  $user->unreadNotifications;  $notification->markAsRead();
