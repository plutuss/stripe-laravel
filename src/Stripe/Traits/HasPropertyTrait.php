<?php

namespace Plutuss\Stripe\Traits;

use Illuminate\Support\Collection;

trait HasPropertyTrait
{
    public function __get(string $name)
    {
        return $this->getData()->get($name);
    }

    public function getId(): string
    {
        return $this->parameters['id'];
    }


    public function getData(): Collection
    {
        return collect($this->parameters['data'] ?? []);

    }
}
