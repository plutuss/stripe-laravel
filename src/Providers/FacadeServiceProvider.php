<?php

declare(strict_types=1);

namespace Plutuss\Providers;

use Illuminate\Support\ServiceProvider;
use Plutuss\Stripe\Contracts\StripeContract;

class FacadeServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->facades();
    }


    private function facades(): void
    {
        $this->app->bind('stripe.payments', StripeContract::class);
    }

}