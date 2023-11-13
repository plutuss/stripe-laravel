<?php

namespace Plutuss\Stripe\Customer;


use Plutuss\Stripe\Traits\HasPropertyTrait;

class Customer implements CustomerInterface
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
