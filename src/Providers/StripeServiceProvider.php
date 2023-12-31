<?php

namespace Plutuss\Providers;

use Illuminate\Support\ServiceProvider;
use Plutuss\Stripe\Contracts\StripeContract;
use Plutuss\Stripe\StripeService;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (!$this->app->runningInConsole()) {
            $stripe = new \Stripe\StripeClient(
                config('stripe-plutuss.stripe-secret')
            );

            $this->app->singleton(StripeContract::class, function ($app) use ($stripe) {
                return new StripeService($stripe);
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../config/stripe-plutuss.php' => config_path('stripe-plutuss.php'),
            __DIR__ . '/../Models/PaymentMethod.php.example' => app_path('Models/PaymentMethod.php'),
            __DIR__ . '/../Models/Plan.php.example' => app_path('Models/Plan.php'),
            __DIR__ . '/../Models/Subscription.php.example' => app_path('Models/Subscription.php'),
        ]);
    }
}
