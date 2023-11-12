<?php

namespace Plutuss\Stripe\Subscription;

use Plutuss\Stripe\Contracts\StripeResponseContract;
use Plutuss\Stripe\Traits\HasPropertyTrait;

class Subscription implements StripeResponseContract
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }


}
