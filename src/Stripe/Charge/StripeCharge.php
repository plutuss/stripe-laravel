<?php

declare(strict_types=1);


namespace Plutuss\Stripe\Charge;


use Plutuss\Stripe\Traits\HasPropertyTrait;

class StripeCharge implements StripeChargeInterface
{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }
}
