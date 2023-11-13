<?php

namespace Plutuss\Stripe;


use Plutuss\Stripe\Billing\PaymentIntent;
use Plutuss\Stripe\Confirm\StripeConfirmService;
use Plutuss\Stripe\Contracts\StripeContract;
use Plutuss\Stripe\Contracts\StripeCustomerContract;
use Plutuss\Stripe\Contracts\StripeSubscriptionContract;
use Plutuss\Stripe\Customer\StripeCustomerService;
use Plutuss\Stripe\Faker\Faker;
use Plutuss\Stripe\Faker\FakerInterface;
use Plutuss\Stripe\PaymentMethod\PaymentMethod;
use Plutuss\Stripe\PaymentMethod\PaymentMethodInterface;
use Plutuss\Stripe\Price\StripePriceService;
use Plutuss\Stripe\Product\StripeProductService;
use Plutuss\Stripe\Subscription\StripeSubscriptionService;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeService implements StripeContract
{
    public function __construct(
        protected StripeClient $client
    )
    {
    }


    /**
     * @param int $amount
     * @param string $token
     * @return Billing\PaymentIntentInterface
     * @throws ApiErrorException
     */
    public function paymentIntent(int $amount, string $token): Billing\PaymentIntentInterface
    {

        $response = $this->client
            ->paymentIntents
            ->create([
                'amount' => $amount,
                'currency' => 'usd',
                'payment_method' => $token,
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

        return new PaymentIntent([
            'id' => $response->id,
            'amount' => $response->amount,
            'data' => $response
        ]);
    }

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
     * @return StripeConfirmService
     */
    public function confirm(): StripeConfirmService
    {
        return new StripeConfirmService($this->client);
    }

    /**
     * @return StripeProductService
     */
    public function product(): StripeProductService
    {
        return new StripeProductService($this->client);

    }


    /**
     * @return StripePriceService
     */
    public function price(): StripePriceService
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
