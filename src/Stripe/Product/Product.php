<?php

namespace Plutuss\Stripe\Product;

use Plutuss\Stripe\Traits\HasPropertyTrait;

class Product implements ProductInterface
{

    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

}
