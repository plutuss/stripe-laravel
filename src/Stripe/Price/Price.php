<?php

namespace Plutuss\Stripe\Price;



use Plutuss\Stripe\Contracts\StripeResponseContract;
use Plutuss\Stripe\Traits\HasPropertyTrait;

class Price implements StripeResponseContract, PriceInterface
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getAmount(): int
    {
        return $this->parameters['amount'];

    }

}
