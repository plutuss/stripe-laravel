<?php

namespace Plutuss\Stripe\Product;



use Plutuss\Stripe\Contracts\StripeResponseContract;
use Plutuss\Stripe\Traits\HasPropertyTrait;

class Product implements StripeResponseContract, ProductInterface
{

    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
