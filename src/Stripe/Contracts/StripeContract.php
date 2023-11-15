<?php

namespace Plutuss\Stripe\Contracts;


use Plutuss\Stripe\Billing\PaymentIntentInterface;
use Plutuss\Stripe\Faker\FakerInterface;
use Plutuss\Stripe\PaymentMethod\PaymentMethodInterface;

interface StripeContract
{

    /**
     * @return PaymentIntentContract
     */
    public function paymentIntent(): PaymentIntentContract;

    /**
     * @return StripeSubscriptionContract
     */
    public function subscriptions(): StripeSubscriptionContract;

    /**
     * @return StripeConfirmContract
     */
    public function confirm(): StripeConfirmContract;

    /**
     * @return StripeProductContract
     */
    public function product(): StripeProductContract;

    /**
     * @return StripePriceContract
     */
    public function price(): StripePriceContract;

    /**
     * @return StripeCustomerContract
     */
    public function customer(): StripeCustomerContract;

    /**
     * @param $payment_method
     * @return PaymentMethodInterface
     */
    public function paymentMethod($payment_method): PaymentMethodInterface;

    /**
     * @return FakerInterface
     */
    public function faker(): FakerInterface;
}

