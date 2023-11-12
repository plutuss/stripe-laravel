<?php

namespace Plutuss\Stripe\Customer;



use Plutuss\Stripe\Contracts\StripeResponseContract;
use Plutuss\Stripe\Traits\HasPropertyTrait;

class Customer implements StripeResponseContract, CustomerInterface
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
