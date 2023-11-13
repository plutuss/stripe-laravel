<?php

namespace Plutuss\Stripe;


use Plutuss\Stripe\Billing\PaymentIntent;
use Plutuss\Stripe\Confirm\StripeConfirmService;
use Plutuss\Stripe\Contracts\StripeContract;
use Plutuss\Stripe\Customer\StripeCustomerService;
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

    /**
     * @return PaymentMethodInterface
     * @throws ApiErrorException
     */
    public function generateValidatePaymentToken(): PaymentMethodInterface
    {
        $payment_method = $this->client
            ->paymentMethods
            ->create([
                'type' => 'card',
                'card' => [
                    'number' => '4242424242424242',
                    'exp_month' => 7,
                    'exp_year' => now()->addYear()->format('Y'),
                    'cvc' => '314',
                ],
            ]);


        return new PaymentMethod([
            'id' => $payment_method->id,
            'data' => $payment_method
        ]);
    }

    /**
     * @return StripeSubscriptionService
     */
    public function subscriptions(): StripeSubscriptionService
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
     * @return StripeCustomerService
     */
    public function customer(): StripeCustomerService
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
