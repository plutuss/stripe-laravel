<?php

namespace Plutuss\Stripe\Webhook;

use Plutuss\Stripe\Traits\HasPropertyTrait;

class Webhook implements WebhookInterface

{
    use HasPropertyTrait;

    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }


}
