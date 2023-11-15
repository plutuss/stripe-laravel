<?php

namespace Plutuss\Stripe\Billing;


use Plutuss\Stripe\Traits\HasPropertyTrait;

class PaymentIntent implements  PaymentIntentInterface
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
