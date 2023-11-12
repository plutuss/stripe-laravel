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
        $stripe = new \Stripe\StripeClient(
            config('stripe.stripe-secret')
        );

        $this->app->singleton(StripeContract::class, function ($app) use ($stripe) {
            return new StripeService($stripe);
        });

        $this->app->singleton(StripeService::class, function ($app) use ($stripe) {
            return new StripeService($stripe);
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/stripe.php' => config_path('stripe.php'),
        ]);
    }
}
