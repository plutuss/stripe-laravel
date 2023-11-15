<?php

declare(strict_types=1);


namespace Plutuss\Stripe\Faker;

use Plutuss\Stripe\Traits\HasOptionAttributeTrait;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use Plutuss\Stripe\PaymentMethod\PaymentMethod;
use Plutuss\Stripe\PaymentMethod\PaymentMethodInterface;

class Faker implements FakerInterface
{
    use HasOptionAttributeTrait;

    private StripeClient $client;

    public function __construct($client)
    {
        $this->client = $client;
    }


    /**
     * @return PaymentMethodInterface
     */
    public function generateValidatePaymentToken(string $typeCard = 'card'): PaymentMethodInterface
    {

        $params = array_merge([
            'type' => $typeCard,
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 7,
                'exp_year' => now()->addYear()->format('Y'),
                'cvc' => '314',
            ],
        ], $this->params);

        $payment_method = $this->client
            ->paymentMethods
            ->create($params);


        return new PaymentMethod([
            'id' => $payment_method->id,
            'data' => $payment_method
        ]);
    }

}