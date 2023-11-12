<?php

namespace Plutuss\Stripe\PaymentMethod;


use Plutuss\Stripe\Traits\HasPropertyTrait;


class PaymentMethod implements PaymentMethodInterface
{
    use HasPropertyTrait;


    public function __construct(
        private readonly array $parameters
    )
    {
    }


}
