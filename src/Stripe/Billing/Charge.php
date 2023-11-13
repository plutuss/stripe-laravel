<?php

namespace Plutuss\Stripe\Billing;

use Plutuss\Stripe\Traits\HasPropertyTrait;

class Charge implements ChargeInterface
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
