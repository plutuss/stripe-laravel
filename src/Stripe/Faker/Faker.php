<?php

declare(strict_types=1);


namespace Plutuss\Stripe\Faker;

use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use Plutuss\Stripe\PaymentMethod\PaymentMethod;
use Plutuss\Stripe\PaymentMethod\PaymentMethodInterface;

class Faker implements FakerInterface
{

    private StripeClient $client;

    public function __construct($client)
    {
        $this->client = $client;
    }


    /**
     * @return PaymentMethodInterface
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

}