<?php

namespace Plutuss\Stripe\Billing;

use Plutuss\Stripe\Contracts\PaymentIntentContract;
use Plutuss\Stripe\Traits\HasOptionAttributeTrait;
use Stripe\StripeClient;

class PaymentIntentService implements PaymentIntentContract
{

    use HasOptionAttributeTrait;

    private StripeClient $client;


    public function __construct(StripeClient $client)
    {
        $this->client = $client;

    }


    /**
     * @param int $amount
     * @param string $token
     * @return PaymentIntentInterface
     * @throws ApiErrorException
     */
    public function createPayment(int $amount, string $token, string $currency = 'usd'): PaymentIntentInterface
    {

        $params = array_merge([
            'amount' => $amount,
            'currency' => $currency,
            'payment_method' => $token,
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ], $this->params);

        $response = $this->client
            ->paymentIntents
            ->create($params);

        return new PaymentIntent([
            'id' => $response->id,
            'amount' => $response->amount,
            'data' => $response
        ]);
    }

}
