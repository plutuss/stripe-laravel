<?php

namespace Plutuss\Stripe\Confirm;

use Plutuss\Stripe\Traits\HasPropertyTrait;

class Confirm implements ConfirmInterface
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
