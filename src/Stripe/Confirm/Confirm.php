<?php

namespace Plutuss\Stripe\Confirm;



use Plutuss\Stripe\Contracts\StripeResponseContract;
use Plutuss\Stripe\Traits\HasPropertyTrait;

class Confirm implements StripeResponseContract, ConfirmInterface
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
