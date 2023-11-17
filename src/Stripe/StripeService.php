<?php

namespace Plutuss\Stripe;

use Plutuss\Stripe\Billing\PaymentIntentService;
use Plutuss\Stripe\Charge\StripeChargeService;
use Plutuss\Stripe\Charge\StripeChargeServiceInterface;
use Plutuss\Stripe\Confirm\StripeConfirmService;
use Plutuss\Stripe\Contracts\PaymentIntentContract;
use Plutuss\Stripe\Contracts\StripeConfirmContract;
use Plutuss\Stripe\Contracts\StripeContract;
use Plutuss\Stripe\Contracts\StripeCustomerContract;
use Plutuss\Stripe\Contracts\StripePriceContract;
use Plutuss\Stripe\Contracts\StripeProductContract;
use Plutuss\Stripe\Contracts\StripeSubscriptionContract;
use Plutuss\Stripe\Customer\StripeCustomerService;
use Plutuss\Stripe\Faker\Faker;
use Plutuss\Stripe\Faker\FakerInterface;
use Plutuss\Stripe\PaymentMethod\PaymentMethod;
use Plutuss\Stripe\PaymentMethod\PaymentMethodInterface;
use Plutuss\Stripe\Price\StripePriceService;
use Plutuss\Stripe\Product\StripeProductService;
use Plutuss\Stripe\Subscription\StripeSubscriptionService;
use Stripe\StripeClient;

class StripeService implements StripeContract
{
    public function __construct(
        protected StripeClient $client
    )
    {
    }

    public function paymentIntent(): PaymentIntentContract
    {
        return new PaymentIntentService($this->client);
    }

    /**
     * @return FakerInterface
     */
    public function faker(): FakerInterface
    {
        return new Faker($this->client);
    }

    /**
     * @return StripeSubscriptionContract
     */
    public function subscriptions(): StripeSubscriptionContract
    {
        return new StripeSubscriptionService($this->client);
    }

    /**
     * @return StripeConfirmContract
     */
    public function confirm(): StripeConfirmContract
    {
        return new StripeConfirmService($this->client);
    }

    /**
     * @return StripeProductContract
     */
    public function product(): StripeProductContract
    {
        return new StripeProductService($this->client);

    }


    /**
     * @return StripePriceContract
     */
    public function price(): StripePriceContract
    {
        return new StripePriceService($this->client);
    }


    /**
     * @return StripeCustomerContract
     */
    public function customer(): StripeCustomerContract
    {
        return new StripeCustomerService($this->client);
    }

    /**
     * @return StripeChargeServiceInterface
     */
    public function charge(): StripeChargeServiceInterface
    {
        return new StripeChargeService($this->client);
    }


    /**
     * @param $payment_method
     * @return PaymentMethodInterface
     */
    public function paymentMethod($payment_method): PaymentMethodInterface
    {
        return new PaymentMethod([
            'id' => $payment_method->id,
            'data' => $payment_method
        ]);
    }


}
