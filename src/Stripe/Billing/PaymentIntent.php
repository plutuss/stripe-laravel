<?php

namespace Plutuss\Stripe\Billing;



use Plutuss\Stripe\Contracts\StripePaymentResponseContract;
use Plutuss\Stripe\Contracts\StripeResponseContract;
use Plutuss\Stripe\Traits\HasPropertyTrait;

class PaymentIntent implements StripeResponseContract, StripePaymentResponseContract, PaymentIntentInterface
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }


    /**
     * @return ?int
     */
    public function getAmount(): ?int
    {
        return $this->parameters['amount'];

    }

}
