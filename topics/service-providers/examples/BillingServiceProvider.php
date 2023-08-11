<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Services\StripeGateway;
use App\Contracts\PaymentGateway;

class BillingServiceProvider extends ServiceProvider
{
    // ONLY bind here — don't resolve other services yet.
    public function register(): void
    {
        $this->app->singleton(PaymentGateway::class, function ($app) {
            return new StripeGateway(config('services.stripe.key'));
        });
    }

    // Everything is registered now — safe to use other services.
    public function boot(): void
    {
        Blade::directive('money', function (string $expr) {
            return "<?php echo '$' . number_format($expr, 2); ?>";
        });
    }
}

// Register in config/app.php:
//   'providers' => [ ..., App\Providers\BillingServiceProvider::class ],
//
// Usage in Blade after boot():  @money($order->total)
