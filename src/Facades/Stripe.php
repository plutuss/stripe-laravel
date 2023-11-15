<?php

declare(strict_types=1);


namespace Plutuss\Facades;

use Illuminate\Support\Facades\Facade;
use Plutuss\Stripe\Billing\PaymentIntent;
use Plutuss\Stripe\Confirm\StripeConfirmService;
use Plutuss\Stripe\Contracts\StripeCustomerContract;
use Plutuss\Stripe\Faker\FakerInterface;
use Plutuss\Stripe\PaymentMethod\PaymentMethodInterface;
use Plutuss\Stripe\Price\StripePriceService;
use Plutuss\Stripe\Product\StripeProductService;
use Plutuss\Stripe\Subscription\StripeSubscriptionService;

/**
 * @method static PaymentIntent  paymentIntent(int $amount, string $token)
 * @method static FakerInterface faker()
 * @method static StripeSubscriptionService subscriptions()
 * @method static StripeConfirmService  confirm()
 * @method static StripeProductService product()
 * @method static StripePriceService price()
 * @method static StripeCustomerContract customer()
 * @method static PaymentMethodInterface paymentMethod($payment_method)
 *
 *
 * @see \Plutuss\Stripe\Contracts\StripeContract
 */
class Stripe extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'stripe.payments';
    }
}