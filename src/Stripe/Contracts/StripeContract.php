<?php

namespace Plutuss\Stripe\Contracts;


use Plutuss\Stripe\Billing\PaymentIntentInterface;
use Plutuss\Stripe\Confirm\StripeConfirmService;
use Plutuss\Stripe\Customer\StripeCustomerService;
use Plutuss\Stripe\PaymentMethod\PaymentMethodInterface;
use Plutuss\Stripe\Price\StripePriceService;
use Plutuss\Stripe\Product\StripeProductService;
use Plutuss\Stripe\Subscription\StripeSubscriptionService;

interface StripeContract
{
    /**
     * @param int $amount
     * @param string $token
     * @return PaymentIntentInterface
     */
    public function paymentIntent(int $amount, string $token): PaymentIntentInterface;

    /**
     * @return PaymentMethodInterface
     */
    public function generateValidatePaymentToken(): PaymentMethodInterface;


    /**
     * @return StripeSubscriptionService
     */
    public function subscriptions(): StripeSubscriptionService;

    /**
     * @return StripeConfirmService
     */
    public function confirm(): StripeConfirmService;

    /**
     * @return StripeProductService
     */
    public function product(): StripeProductService;

    /**
     * @return StripePriceService
     */
    public function price(): StripePriceService;

    /**
     * @return StripeCustomerService
     */
    public function customer(): StripeCustomerService;

    /**
     * @param $payment_method
     * @return PaymentMethodInterface
     */
    public function paymentMethod($payment_method): PaymentMethodInterface;
}

