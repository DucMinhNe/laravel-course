<?php

// An interface and two implementations
interface PaymentGateway
{
    public function charge(int $cents): string;
}

class StripeGateway implements PaymentGateway
{
    public function __construct(private string $key) {}
    public function charge(int $cents): string { return "stripe:{$cents}"; }
}

class FakeGateway implements PaymentGateway
{
    public function charge(int $cents): string { return "fake:{$cents}"; }
}

// ── In a service provider's register() ─────────────────────
// $this->app->singleton(PaymentGateway::class, function ($app) {
//     return new StripeGateway(config('services.stripe.key'));
// });

// ── Inject it anywhere by type-hinting the INTERFACE ───────
class CheckoutController
{
    public function __construct(private PaymentGateway $gateway) {}

    public function pay()
    {
        return $this->gateway->charge(1999);   // container injected StripeGateway
    }
}

// ── In a test, swap the implementation ─────────────────────
// $this->app->bind(PaymentGateway::class, FakeGateway::class);
// Now CheckoutController gets the fake — no code changes.
