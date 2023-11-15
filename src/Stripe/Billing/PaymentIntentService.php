<?php

namespace Plutuss\Stripe\Billing;


use Plutuss\Stripe\Contracts\PaymentIntentContract;

class PaymentIntentService implements PaymentIntentContract
{

    private StripeClient $client;

    public function __construct(StripeClient $client)
    {
        $this->client = $client;

    }


    /**
     * @param int $amount
     * @param string $token
     * @return \Plutuss\Stripe\Billing\PaymentIntentInterface
     * @throws ApiErrorException
     */
    public function createPayment(int $amount, string $token): \Plutuss\Stripe\Billing\PaymentIntentInterface
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

}
