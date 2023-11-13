<?php

namespace Plutuss\Stripe\Subscription;

use Plutuss\Stripe\Traits\HasPropertyTrait;

class Subscription implements SubscriptionInterface
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }


}
